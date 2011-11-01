<?php

class ToppaDatabaseFacadeWp implements ToppaDatabaseFacade {
    private $autoLoader;

    public function __construct(ToppaAutoLoader &$autoLoader) {
        $this->autoLoader = $autoLoader;
    }

    public function getTableNamePrefix() {
        global $wpdb;
        return $wpdb->prefix;
    }

    public function createTable($tableName, array $refData) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $sql = "CREATE TABLE $tableName (\n";

        foreach ($refData as $k=>$v) {
            $sql .= $k . " " . $v['db']['type'];

            if (strlen($v['db']['length'])) {
                $sql .= "(" . $v['db']['length'];

                if (strlen($v['db']['precision'])) {
                    $sql .= "," . $v['db']['precision'];
                }

                $sql .= ")";
            }

            if ($v['db']['not_null']) {
                $sql .= " NOT NULL";
            }

            // dbDelta requires 2 spaces in front of primary key declaration
            if ($v['db']['primary_key']) {
                $sql .= "  PRIMARY KEY";
            }

            if (strlen($v['db']['other'])) {
                $sql .= " " . $v['db']['other'];
            }

            $sql .= ",\n";

            // dbDelta requires unique indexes declared at the end, using KEY
            if ($v['db']['unique_key']) {
                $sql .= "UNIQUE KEY $k ($k),\n";
            }
        }

        // strip trailing comma and linebreak
        $sql = substr($sql, 0, -2);
        $sql .= "\n)\nDEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";

        // dbDelta returns an array of strings - won't tell you if there
        // was an error
        return dbDelta($sql, true);
    }

    public function verifyTableExists($tableName, array $refData) {
        global $wpdb;
        $tableName = $this->checkIsStringAndEscape($tableName);
        $described = $wpdb->get_results("DESCRIBE $tableName;", ARRAY_A);

        if ($described[0]['Field'] == key($refData)) {
            return true;
        }

        return false;
    }

    public function dropTable($tableName) {
        global $wpdb;
        $tableName = $this->checkIsStringAndEscape($tableName);
        $sql = "drop table if exists $tableName;";
        return $wpdb->query($sql); // always returns 0
    }

    public function sqlSelectRow($tableName, array $fieldsToSelect = null, array $whereKeysAndValues = null, $otherConditions = null) {
        $sql = $this->generateSqlSelectStatement($tableName, $fieldsToSelect, $whereKeysAndValues, $otherConditions);
        return $this->executeQuery($sql, 'get_row');
    }

    public function sqlSelectMultipleRows($tableName, array $fieldsToSelect = null, array $whereKeysAndValues = null, $otherConditions = null) {
        $sql = $this->generateSqlSelectStatement($tableName, $fieldsToSelect, $whereKeysAndValues, $otherConditions);
        return $this->executeQuery($sql, 'get_results');
    }

    public function generateSqlSelectStatement($tableName, array $fieldsToSelect = null, array $whereKeysAndValues = null, $otherConditions = null) {
        $tableName = $this->checkIsStringAndEscape($tableName);
        $sql = "select ";

        if (is_array($fieldsToSelect)) {
            $fields = implode(", ", $fieldsToSelect);
            $fields = $this->checkIsStringAndEscape($fields);
            $sql .= $fields;
        }

        else {
            $sql .= '* ';
        }

        $sql .= " from $tableName ";

        if (is_array($whereKeysAndValues)) {
            $sql .= "where ";
            array_walk($whereKeysAndValues, array($this, 'sqlEscapeCallback'));

            foreach($whereKeysAndValues as $k=>$v) {
                $sql .= "$k = $v and ";
            }

            $sql = substr($sql, 0, -4);
        }

        if ($otherConditions) {
            ToppaFunctions::throwExceptionIfNotString($otherConditions);
            $sql .= $otherConditions;
        }

        $sql .= ";";
        return $sql;
    }

    public function sqlInsert($tableName, array $keysAndValues, $onDuplicateKeyUpdate = false) {
        global $wpdb;
        $sql = $this->generateSqlInsertStatement($tableName, $keysAndValues, $onDuplicateKeyUpdate);
        $this->executeQuery($sql, 'query');
        return $wpdb->insert_id;
    }

    public function generateSqlInsertStatement($tableName, array $keysAndValues, $onDuplicateKeyUpdate = false) {
        $tableName = $this->checkIsStringAndEscape($tableName);
        $keys = array_keys($keysAndValues);
        $values = array_values($keysAndValues);
        array_walk($values, array($this, 'sqlEscapeCallback'));

        $sql = "insert into $tableName (";
        $sql .= implode(",", $keys);
        $sql .= ") values (";
        $sql .= implode(",", $values);
        $sql .= ")";

        if ($onDuplicateKeyUpdate) {
            $sql .= " on duplicate key update ";

            for ($i = 0; $i < count($keys); $i++) {
                $sql .= "$keys[$i] = $values[$i], ";
            }

            $sql = substr($sql, 0, -2);
        }

        $sql .= ";";
        return $sql;
    }

    public function getLastInsertedId() {
        global $wpdb;
        return $wpdb->insert_id;
    }

    public function sqlUpdate($tableName, array $keysAndValues, array $whereKeysAndValues = null) {
        $sql = $this->generateSqlUpdateStatement($tableName, $keysAndValues, $whereKeysAndValues);
        return $this->executeQuery($sql, 'query');
    }

    public function generateSqlUpdateStatement($tableName, array $keysAndValues, array $whereKeysAndValues = null) {
        $tableName = $this->checkIsStringAndEscape($tableName);
        $sql = "update $tableName set ";
        array_walk($keysAndValues, array($this, 'sqlEscapeCallback'));

        foreach($keysAndValues as $k=>$v) {
            $sql .= "$k = $v, ";
        }

        $sql = substr($sql, 0, -2);

        if (is_array($whereKeysAndValues)) {
            $sql .= " where ";
            array_walk($whereKeysAndValues, array($this, 'sqlEscapeCallback'));

            foreach($whereKeysAndValues as $k=>$v) {
                $sql .= "$k = $v and ";
            }

            $sql = substr($sql, 0, -5);
        }

        $sql .=";";
        return $sql;
    }

    public function sqlDelete($tableName, array $whereKeysAndValues) {
        $sql = $this->generateSqlDeleteStatement($tableName, $whereKeysAndValues);
        return $this->executeQuery($sql, 'query');
    }

    public function generateSqlDeleteStatement($tableName, array $whereKeysAndValues) {
        $tableName = $this->checkIsStringAndEscape($tableName);
        $sql = "delete from $tableName where ";
        array_walk($whereKeysAndValues, array($this, 'sqlEscapeCallback'));

        foreach($whereKeysAndValues as $k=>$v) {
            $sql .= "$k = $v and ";
        }

        $sql = substr($sql, 0, -5);
        $sql .=";";
        return $sql;
    }

    public function executeQuery($sql, $callType = 'query', $returnType = ARRAY_A) {
        global $wpdb;
        $result = false;

        switch ($callType) {
        case "get_results":
            $result = $wpdb->get_results($sql, $returnType);
            break;
        case "get_col":
            $result = $wpdb->get_col($sql);
            break;
        case "get_var":
            $result = $wpdb->get_var($sql);
            break;
        case "get_row":
            $result = $wpdb->get_row($sql, $returnType);
            break;
        case "query":
            $result = $wpdb->query($sql);
            break;
        }

        if ($result === false) {
            throw new Exception(__('Database query failed for SQL statement: ', 'toppalibs') . $sql);
        }

        return $result;
    }

    public function sqlEscapeCallback(&$string, $key) {
        global $wpdb;
        $string = (is_numeric($string) ? $string : ("'" . $wpdb->escape($string) . "'"));
    }

    public function checkIsStringAndEscape($string) {
        global $wpdb;
        ToppaFunctions::throwExceptionIfNotString($string);
        return $wpdb->escape($string);
    }

    public function getIntTypes() {
        return array(
            'tinyint', 'smallint', 'mediumint', 'int', 'bigint',
            'tinyint unsigned', 'smallint unsigned', 'mediumint unsigned', 'int unsigned', 'bigint unsigned'
        );
    }
}
