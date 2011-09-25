<?php

class ToppaFunctions {
    public static function isPositiveNumber($number) {
        if (is_numeric($number) && $number > 0) {
            return true;
        }

        return false;
    }

    public static function trimCallback(&$string, $key = null) {
        $string = trim($string);
    }

    public static function strtolowerCallback(&$string, $key = null) {
        $string = strtolower($string);
    }

    public static function stripslashesCallback(&$string, $key = null) {
        $string = stripslashes($string);
    }

    public static function htmlentitiesCallback(&$string, $key = null) {
        $string = htmlentities($string);
    }

    public static function makeTimestampPhpSafe($timestamp = null) {
        // if timestamp comes in as a float, it'll be translated to, e.g. 1.30152466512E+13
        // and casting it to an int will not give us the original number
        if ($timestamp) {
            ToppaFunctions::throwExceptionIfNotString($timestamp);
        }

        switch (strlen($timestamp)) {
            case 14:
                $timestamp = substr($timestamp,0,11);
                break;
            case 13:
                $timestamp = substr($timestamp,0,10);
                break;
            case 12:
                $timestamp = substr($timestamp,0,9);
                break;
            case 11:
                $timestamp = substr($timestamp,0,8);
                break;
            case 0:
                $timestamp = 0;
                break;
            default:
                $timestamp = $timestamp;

        }

        return $timestamp;
    }

    public static function throwExceptionIfNotString($expectedString) {
        if (!is_string($expectedString)) {
             throw new Exception(__('Not a string', 'toppalibs'));
        }


        return true;
    }

    public static function throwExceptionIfNotArray($expectedArray) {
        if (!is_array($expectedArray)) {
             throw new Exception(__('Not an array', 'toppalibs'));
        }
        return true;
    }

    public static function path() {
        return dirname(__FILE__);
    }

    public static function getFileExtension($fileName) {
        ToppaFunctions::throwExceptionIfNotString($fileName);
        $fileNameParts = explode('.', $fileName);
        $lastIndexPosition = count($fileNameParts) - 1;

        if (!$lastIndexPosition) {
            return null;
        }

        return $fileNameParts[$lastIndexPosition];
    }
}