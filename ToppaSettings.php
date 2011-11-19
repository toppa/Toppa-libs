<?php

interface ToppaSettings {
    public function __get($name);
    public function refresh();
    public function set(array $newSettings, $preferExisting = false);
    public function delete();
}
