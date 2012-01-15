<?php

interface ToppaFunctionsFacade {
    public function __construct();
    public function useHook($hook, $customFunctionToCall, $priority = null, $numberOfAcceptedArgs = null);
    public function useFilter($filter, $customFunctionToCall, $priority = null, $numberOfAcceptedArgs = null);
    public function getSiteUrl($pathToAppendToUrl = null, $scheme = null);
    public function getAdminUrl($pathToAppendToUrl = null, $scheme = null);
    public function getUrlForCustomizableFile($fileName, $baseFile, $relativePath = null);
    public function getPluginsUrl($relativePath, $baseFile);
    public function getPluginsPath();
    public function getBasePath();
    public function getPluginDirectoryName($path);
    public function enqueueStylesheet($handle, $relativePath, $dependencies = false, $version = null, $media = null);
    public function enqueueScript($handle, $relativePath, $dependencies = false, $version = null, $media = null);
    public function localizeScript($handle, $objectName, $data);
    public function isPage($anyPageIdentifier);
    public function getPermalink();
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
    public function checkFileExists($path);
    public function requireOnce($path);
    public function directoryName($path);
}
