<?php

require_once(dirname(__FILE__) . '/../ToppaHtmlFormField.php');

class UnitToppaHtmlFormField extends UnitTestCase {
    private $refData = array(
        'rss_url' => array(
            'db' => array(
                'type' => 'varchar',
                'length' => '255',
                'not_null' => true),
            'input' => array(
                'type' => 'text',
                'size' => 100),
        ),
        'include_in_random' => array(
            'db' => array(
                'type' => 'char',
                'length' => '1',
                'other' => "default 'Y'"),
            'input' => array(
                'type' => 'radio',
                'subgroup' => array('Y' => 'Yes', 'N' => 'No')),
            )
        );

    public function __construct() {
        $this->UnitTestCase();
    }

    public function setUp() {
    }

    public function testBuildTextInput() {
        $toppaHtmlFormField = new ToppaHtmlFormField('rss_url', $this->refData['rss_url']);
        $this->assertEqual(
            '<input type="text" name="rss_url" id="rss_url" size="100" maxlength="255" />' . PHP_EOL,
            $toppaHtmlFormField->build()
        );
    }

    public function testBuildRadioInput() {
        $toppaHtmlFormField = new ToppaHtmlFormField('include_in_random', $this->refData['include_in_random']);
        $this->assertEqual(
            '<input type="radio" name="include_in_random" id="include_in_random" value="Y" /> Yes' . PHP_EOL
            . '<input type="radio" name="include_in_random" id="include_in_random" value="N" /> No' . PHP_EOL,
            $toppaHtmlFormField->build()
        );
    }
}