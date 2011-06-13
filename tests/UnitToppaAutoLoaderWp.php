<?php

require_once(dirname(__FILE__) . '/../ToppaAutoLoaderWp.php');

class UnitToppaAutoLoaderWp extends UnitTestCase {
    public function __construct() {
        $this->UnitTestCase();
    }

    public function setUp() {
    }

    public function testHappyPath() {
        $autoLoader = new ToppaAutoLoaderWp('/toppa-plugin-libraries-for-wordpress');
        $autoLoader->setClassname('ToppaHtmlFormField');
        $autoLoader->setFullPath();
        $expectedFullPath = WP_PLUGIN_DIR . '/toppa-plugin-libraries-for-wordpress/ToppaHtmlFormField.php';
        $this->assertEqual($autoLoader->getFullPath(), $expectedFullPath);
        $this->assertEqual(1, $autoLoader->includeClass());
    }

    public function testNonExistentClass() {
        $autoLoader = new ToppaAutoLoaderWp('/roo');
        $autoLoader->setClassname('Foo_Bar');
        $autoLoader->setFullPath();
        $expectedFullPath = WP_PLUGIN_DIR . '/roo/Foo/Bar.php';
        $this->assertEqual($autoLoader->getFullPath(), $expectedFullPath);
        $this->assertFalse($autoLoader->includeClass());
    }
}