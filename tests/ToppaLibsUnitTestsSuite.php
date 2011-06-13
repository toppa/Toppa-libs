<?php

// this is needed for simpletest's addFile method
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__));

require_once(dirname(__FILE__) . '/../ToppaAutoLoaderWp.php');

class ToppaLibsUnitTestsSuite extends TestSuite {
   function __construct() {
       parent::__construct();
       $this->addFile('UnitToppaAutoLoaderWp.php');
       $this->addFile('UnitToppaDatabaseFacadeWp.php');
       $this->addFile('UnitToppaFunctions.php');
       $this->addFile('UnitToppaHtmlFormField.php');
   }
}

