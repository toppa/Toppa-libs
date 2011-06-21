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

    public function getPluginDirectoryName($path) {
        return dirname(plugin_basename($path));
    }

    public function enqueueStylesheet($handle, $relativePath, $dependencies = false, $version = null, $media = null) {
        return wp_enqueue_style($handle, $relativePath, $dependencies, $version, $media);
    }

    // works with page slug, ID, or title
    public function isPage($anyPageIdentifier) {
        return is_page($anyPageIdentifier);
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

    public function checkPublicNonceField($nonce, $nonceName = -1) {
        return wp_verify_nonce($nonce, $nonceName);
    }

    public function setShortcodeAttributes(array $shortcodeDefaults, $userShortcode) {
        return shortcode_atts($shortcodeDefaults, $userShortcode);
    }

    public function checkEmailHasValidFormat($email) {
        return is_email($email);
    }

    public function sendEmail($to, $subject = null, $message = null, $headers = null, array $attachments = null) {
        return wp_mail($to, $subject, $message, $headers, $attachments);
    }

    /*
     * WordPress function checks for invalid UTF-8, Convert single < characters to entity,
     * strip all tags,remove line breaks, tabs and extra white space, strip octets.
     */
    public function sanitizeString($string) {
        return sanitize_text_field($string);
    }

    // Managing settings: http://www.presscoders.com/wordpress-settings-api-explained/
    // http://striderweb.com/nerdaphernalia/2008/07/consolidate-options-with-arrays/
    public function getSetting($setting) {
        return get_option($setting);
    }

    public function setSetting($setting, $value) {
        // true if value was changed, false otherwise
        return update_option($setting, $value);
    }

    public function deleteSetting($setting) {
        // true if successful, false if not
        return delete_option($setting);
    }
}
