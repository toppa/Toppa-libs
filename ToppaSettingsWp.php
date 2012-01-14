<?php

abstract class ToppaSettingsWp implements ToppaSettings {
    private $functionsFacade;
    private $name;
    private $data = array();

    public function __construct($name, ToppaFunctionsFacade $functionsFacade) {
        $this->name = $name;
        $this->functionsFacade = $functionsFacade;
    }

    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        else {
            $this->refresh();
        }

        // and try again...
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        throw New Exception(__('Invalid data property __get for ', 'toppalibs') . htmlentities($name));
    }

    public function refresh() {
        $currentSettings = $this->functionsFacade->getSetting($this->name);

        if (is_array($currentSettings)) {
            $this->data = $currentSettings;
        }

        return $this->data;
    }

    public function set(array $newSettings, $preferExisting = false) {
        $this->refresh();

        if ($preferExisting) {
            $this->data = array_merge($newSettings, $this->data);
        }

        else {
            $this->data = array_merge($this->data, $newSettings);
        }

        $this->functionsFacade->setSetting($this->name, $this->data);
        return $this->data;
    }

    public function delete() {
        $this->functionsFacade->deleteSetting($this->name);

        if ($this->functionsFacade->getSetting($this->name)) {
            throw new Exception(__('Failed to delete settings', 'toppalibs'));
        }

        return true;
    }
}


