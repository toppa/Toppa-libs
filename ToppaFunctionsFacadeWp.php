<?php

require_once('ToppaFunctionsFacade.php');

class ToppaFunctionsFacadeWp implements ToppaFunctionsFacade {
    public function __construct() {

    }

    public function getUrlForCustomizableFile($fileName, $baseFile, $relativePath = null) {
        if (file_exists(get_stylesheet_directory() . '/' . $fileName)) {
            $url = get_bloginfo('stylesheet_directory') . '/' . $fileName;
        }

        else {
            $url = $this->getPluginsUrl($relativePath . $fileName, $baseFile);
        }

        return $url;
    }

    public function getPluginsUrl($relativePath, $baseFile) {
        return plugins_url($relativePath, $baseFile);
    }

    public function getPluginsPath() {
        return WP_PLUGIN_DIR;
    }

    public function checkFileExists($path) {
        return file_exists($path);
    }

    // unfortunately WP_Http is not written to a more generic interface
    public function getHttpRequestObject() {
        require_once(ABSPATH . WPINC . '/class-http.php');
        return new WP_Http();
    }

    // echoes input fields if $echoFormField == true; returns them otherwise
    public function createNonceFields($myActionName = null, $nonceFieldName = null, $validateReferrer = true, $echoFormField = true) {
        return wp_nonce_field($myActionName, $nonceFieldName, $validateReferrer, $echoFormField);
    }

    public function addNonceToUrl($url, $nonceName) {
        return wp_nonce_url($url, $nonceName);
    }

    // returns true if security check is successful; dies otherwise
    // the default $nonceFieldName is important for nonces on WP links, where it's always _wpnonce
    public function checkAdminNonceFields($myActionName = null, $nonceFieldName = '_wpnonce') {
        return check_admin_referer($myActionName, $nonceFieldName);
    }
}
