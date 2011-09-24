<?php

interface ToppaFunctionsFacade {
    public function __construct();
    public function getSiteUrl($pathToAppendToUrl = null, $schemeOverride = null);
    public function getUrlForCustomizableFile($fileName, $baseFile, $relativePath = null);
    public function getPluginsUrl($relativePath, $baseFile);
    public function getPluginsPath();
    public function getPluginDirectoryName($path);
    public function enqueueStylesheet($handle, $relativePath, $dependencies = false, $version = null, $media = null);
    public function getPermalink();
    public function isPage($anyPageIdentifier);
    public function checkFileExists($path);
    public function getHttpRequestObject();
    public function createNonceFields($myActionName = null, $nonceFieldName = null, $validateReferrer = true, $echoFormField = true);
    public function addNonceToUrl($url, $nonceName);
    public function checkAdminNonceFields($myActionName = null, $nonceFieldName = '_wpnonce');
    public function checkPublicNonceField($nonce, $nonceName = -1);
    public function setShortcodeAttributes(array $shortcodeDefaults, $userShortcode);
    public function checkEmailHasValidFormat($email);
    public function sendEmail($to, $subject = null, $message = null, $headers = null, array $attachments = null);
    public function sanitizeString($string);
    public function dateI18n($dateFormat, $timestamp = false, $convertToGmt = false);
    public function getSetting($setting);
    public function setSetting($setting, $value);
    public function deleteSetting($setting);
}
