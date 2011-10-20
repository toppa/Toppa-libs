<?php

interface ToppaDatabaseFacade {
    public function __construct(ToppaAutoLoader &$autoLoader);
    public function getTableNamePrefix();
    public function createTable($tableName, array $refData);
    public function verifyTableExists($tableName, array $refData);
    public function dropTable($tableName);
    public function sqlSelectRow($tableName, array $fieldsToSelect = null, array $whereKeysAndValues = null, $otherConditions = null);
    public function sqlSelectMultipleRows($tableName, array $fieldsToSelect = null, array $whereKeysAndValues = null, $otherConditions = null);
    public function generateSqlSelectStatement($tableName, array $fieldsToSelect = null, array $whereKeysAndValues = null, $otherConditions = null);
    public function sqlInsert($tableName, array $keysAndValues, $onDuplicateKeyUpdate = false);
    public function generateSqlInsertStatement($tableName, array $keysAndValues, $onDuplicateKeyUpdate = false);
    public function getLastInsertedId();
    public function sqlUpdate($tableName, array $keysAndValues, array $whereKeysAndValues = null);
    public function generateSqlUpdateStatement($tableName, array $keysAndValues, array $whereKeysAndValues = null);
    public function sqlDelete($tableName, array $whereKeysAndValues);
    public function generateSqlDeleteStatement($tableName, array $whereKeysAndValues);
    public function executeQuery($sql, $callType = 'query', $returnType = ARRAY_A);
    public function sqlEscapeCallback(&$string, $key);
    public function checkIsStringAndEscape($string);
    public function getIntTypes();
}
