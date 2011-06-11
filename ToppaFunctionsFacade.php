<?php

interface ToppaFunctionsFacade {
    public function __construct();
    public function getUrlForCustomizableFile($fileName, $baseFile, $relativePath = null);
    public function getPluginsUrl($relativePath, $baseFile);
    public function getPluginsPath();
    public function checkFileExists($path);
    public function getHttpRequestObject();
    public function createNonceFields($myActionName = null, $nonceFieldName = null, $validateReferrer = true, $echoFormField = true);
    public function addNonceToUrl($url, $nonceName);
    public function checkAdminNonceFields($myActionName = null, $nonceFieldName = '_wpnonce');
}
