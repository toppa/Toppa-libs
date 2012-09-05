<?php

require_once('ToppaAutoLoader.php');

class ToppaAutoLoaderWp implements ToppaAutoLoader {
    private $relativePath;
    private $className;
    private $fullPath;

    public function __construct($relativePath = null) {
        $this->relativePath = $relativePath;
        spl_autoload_register(array($this, 'loader'));
    }

    public function loader($className) {
        $this->setClassName($className);
        $this->setFullPath();
        $this->includeClass();
        return true;
    }

    public function setClassName($className) {
        $this->className = $className;
    }

    public function setFullPath() {
        $basePath = WP_PLUGIN_DIR . $this->relativePath;
        $classPath = str_replace('_', '/', $this->className) . '.php';
        $this->fullPath = $basePath . '/' . $classPath;
        return true;
    }

    public function includeClass() {
        if (class_exists($this->className, false)) {
            return true;
        }

        elseif (file_exists($this->fullPath)) {
            return @include($this->fullPath);
        }

        return false;
    }

    public function getFullPath() {
        return $this->fullPath;
    }

}
