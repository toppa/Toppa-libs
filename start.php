<?php
/*
Plugin Name: Toppa Plugins Libraries for WordPress
Plugin URI: http://www.toppa.com/toppa-plugin-libraries-for-wordpress/
Description: Libraries to facilitate the use of Agile coding techniques for developing WordPress plugins. Contains required libraries for using plugins from toppa.com
Author: Michael Toppa
Version: 1.1.1
Author URI: http://www.toppa.com
*/

// solution for possible missing PHP constants, for WP 3.0 and higher only
// http://codex.wordpress.org/Determining_Plugin_and_Content_Directories
if (!defined('WP_CONTENT_URL')) define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if (!defined('WP_PLUGIN_URL')) define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
if (!defined('WP_PLUGIN_DIR')) define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
if (!defined('WPMU_PLUGIN_URL')) define('WPMU_PLUGIN_URL', WP_CONTENT_URL. '/mu-plugins');
if (!defined('WPMU_PLUGIN_DIR')) define('WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins');

load_plugin_textdomain('toppalibs', false, basename(dirname(__FILE__)) . '/languages/');
register_activation_hook(__FILE__, 'toppaLibsActivate');

function toppaLibsActivate() {
    if (!function_exists('spl_autoload_register')) {
        toppaLibsCancelActivation(__('You must have at least PHP 5.1.2 to use Toppa Plugin Libraries for WordPress', 'toppalibs'));
    }

    elseif (version_compare(get_bloginfo('version'), '3.0', '<')) {
        toppaLibsCancelActivation(__('You must have at least WordPress 3.0 to use Toppa Plugin Libraries for WordPress', 'toppalibs'));
    }
}

function toppaLibsCancelActivation($message) {
    deactivate_plugins(basename(__FILE__));
    wp_die($message);
}