<?php

class ToppaWpHooksFacade {
    public function __construct() {

    }

    public function enqueueStylesheet($id, $url, $version = null) {
        return wp_enqueue_style($id, $url, false, $version);
    }

    public function enqueueScript($id, $url, $dependencies = null, $version = null) {
        return wp_enqueue_script($id, $url, $dependencies, $version);
    }

    public function localizeScript($handle, $objectName, $data) {
        return wp_localize_script($handle, $objectName, $data);
    }

    public function addShortcode($shortcodeName, $callback) {
        return add_shortcode($shortcodeName, $callback);
    }

    public function addAction($action, $callback) {
        return add_action($action, $callback);
    }

    public function createManagementPage($pageTitle, $menuTitle, $capability, $menuSlug, $function = null) {
        return add_management_page($pageTitle, $menuTitle, $capability, $menuSlug, $function);
    }
}
