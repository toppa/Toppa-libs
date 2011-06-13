<?php

interface ToppaAutoLoader {
    public function __construct($relativePath = null);
    public function loader($className);
    public function setClassName($className);
    public function setFullPath();
    public function includeClass();
    public function getFullPath();
}
