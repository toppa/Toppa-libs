<?php

if (!class_exists('ToppaFunctions')) {
    require_once(dirname(__FILE__) . '/../Lib/ToppaFunctions.php');
}

class UnitToppaFunctions extends UnitTestCase {
    public function __construct() {
        $this->UnitTestCase();
    }

    public function setUp() {
    }

    public function testIsPositiveNumber() {
        $this->assertTrue(ToppaFunctions::isPositiveNumber(5));
        $this->assertFalse(ToppaFunctions::isPositiveNumber(-5));
        $this->assertFalse(ToppaFunctions::isPositiveNumber(0));
        $this->assertFalse(ToppaFunctions::isPositiveNumber('ahoy'));
    }

    public function testTrimCallback() {
        $testIn = array('ahoy1', ' ahoy2 ', "ahoy3\n", 'ahoy ahoy');
        $testOut = array('ahoy1', 'ahoy2', 'ahoy3', 'ahoy ahoy');
        $this->assertEqual($testOut, array_walk($testIn, array('ToppaFunctions', 'trimCallback')));

    }

    public function testStrtolowerCallback() {
        $testIn = array('ahoy1', ' AHOY2 ', 'Ahoy3');
        $testOut = array('ahoy1', 'ahoy2', 'ahoy3');
        $this->assertEqual($testOut, array_walk($testIn, array('ToppaFunctions', 'strtolowerCallback')));
    }

    public function testMakeTimestampPhpSafe() {
        $this->assertEqual(ToppaFunctions::makeTimestampPhpSafe('13015246650000'), '13015246650');
        $this->assertEqual(ToppaFunctions::makeTimestampPhpSafe('13015246650'), '13015246');
        $this->assertEqual(ToppaFunctions::makeTimestampPhpSafe(null), '0');
    }

    public function testThrowExceptionIfNotString() {
        $aString = 'hello, world';
        $this->assertTrue(ToppaFunctions::throwExceptionIfNotString($aString));

        try {
            $aNumber = 5;
            ToppaFunctions::throwExceptionIfNotString($aNumber);
        }

        catch (Exception $e) {
            $this->pass();
        }

        try {
            $anArray = array('hello world');
            ToppaFunctions::throwExceptionIfNotString($anArray);
        }

        catch (Exception $e) {
            $this->pass();
        }
    }

    public function testThrowExceptionIfNotArray() {
        $anArray = array('hello world');
        $this->assertTrue(ToppaFunctions::throwExceptionIfNotArray($anArray));


        try {
            $aNumber = 5;
            ToppaFunctions::throwExceptionIfNotArray($aNumber);
        }

        catch (Exception $e) {
            $this->pass();
        }

        try {
            $aString = 'hello, world';
            $this->assertTrue(ToppaFunctions::throwExceptionIfNotArray($aString));
        }

        catch (Exception $e) {
            $this->pass();
        }
    }

    public function testGetFileExtensionUsingNameWithMultipleDots() {
        $extension = ToppaFunctions::getFileExtension('video.test.name.mpg');
        $this->assertEqual('mpg', $extension);
    }

    public function testGetFileExtensionUsingNameWithNoDots() {
        $extension = ToppaFunctions::getFileExtension('video');
        $this->assertEqual(null, $extension);
    }
}