<?php

require_once(dirname(__FILE__) . '/../ToppaWpDatabaseFacade.php');

class IntegrationToppaWpDatabaseFacade extends UnitTestCase {
    private $dbFacade;
    private $tableName = 'delete_me';
    private $refData =
        array('test_column' => array(
            'db' => array(
                'type' => 'varchar',
                'length' => '20',
                'not_null' => true)
            ),
        );

    public function __construct() {
        $this->UnitTestCase();
        $this->dbFacade = new ToppaWpDatabaseFacade();
    }

    public function setUp() {

    }

    public function testGetSetting() {
        // check a setting that no one is likely to change
        $this->assertEqual($this->dbFacade->getSetting('html_type'), 'text/html');
    }

    public function testSetSetting() {
        $setting = 'delete_me';
        $value = 'hello world';
        $this->dbFacade->setSetting($setting, $value);
        $this->assertEqual($this->dbFacade->getSetting($setting), $value);
    }

    public function testDeleteSetting() {
        $this->assertTrue($this->dbFacade->deleteSetting('delete_me'));
    }

    public function testGetTableNamePrefix() {
        $this->assertEqual($this->dbFacade->getTableNamePrefix(), 'wp_');
    }

    public function testCreateTable() {
        // the underlying WP dbDelta function returns an array of strings - hard to test
        $result = $this->dbFacade->createTable($this->tableName, $this->refData);
        $this->assertTrue(is_array($result));
    }

    public function testVerifyTableExists() {
        $this->assertTrue($this->dbFacade->verifyTableExists($this->tableName, $this->refData));
    }

    public function testDropTable() {
        // unfortunately, the underlying WP call always returns 0 - hard to test
        $this->assertEqual($this->dbFacade->dropTable($this->tableName), 0);
        $this->assertFalse($this->dbFacade->verifyTableExists($this->tableName, $this->refData));
    }
}