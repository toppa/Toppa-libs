<?php

require_once(dirname(__FILE__) . '/../ToppaWpDatabaseFacade.php');

class UnitToppaWpDatabaseFacade extends UnitTestCase {
    private $dbFacade;

    public function __construct() {
        $this->UnitTestCase();
    }

    public function setUp() {
        $this->dbFacade = new ToppaWpDatabaseFacade();
    }

    public function testGenerateSqlSelectStatement() {
        $tableName = "test_table";
        $fieldsToSelect = array('first_name', 'middle_name', 'last_name', 'age');
        $whereKeysAndValues = array('first_name' => 'Michael', 'last_name' => "O'Shea", 'age' => 40);
        $whereOtherConditions = 'order by last_name';
        $sql = $this->dbFacade->generateSqlSelectStatement($tableName, $fieldsToSelect, $whereKeysAndValues, $whereOtherConditions);
        $expectedSql = "select first_name, middle_name, last_name, age from test_table where first_name = 'Michael' and last_name = 'O\'Shea' and age = 40 order by last_name;";
        $this->assertEqual($sql, $expectedSql);
    }

    public function testGenerateSqlInsertStatement() {
        $tableName = "test_table";
        $keysAndValues = array('first_name' => 'Michael', 'last_name' => "O'Shea", 'age' => 40);
        $sql = $this->dbFacade->generateSqlInsertStatement($tableName, $keysAndValues, false);
        $expectedSql = "insert into test_table (first_name,last_name,age) values ('Michael','O\'Shea',40);";
        $this->assertEqual($sql, $expectedSql);
    }

    public function testGenerateSqlInsertStatementWithOnDuplicateKeyUpdate() {
        $tableName = "test_table";
        $keysAndValues = array('first_name' => 'Michael', 'last_name' => "O'Shea", 'age' => 40);
        $sql = $this->dbFacade->generateSqlInsertStatement($tableName, $keysAndValues, true);
        $expectedSql = "insert into test_table (first_name,last_name,age) values ('Michael','O\'Shea',40) on duplicate key update first_name = 'Michael', last_name = 'O\'Shea', age = 40;";
        $this->assertEqual($sql, $expectedSql);
    }

}