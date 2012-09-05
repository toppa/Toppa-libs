=== Toppa Plugins Libraries for WordPress ===
Contributors: toppa
Donate link: http://www.toppa.com/toppa-plugin-libraries-for-wordpress/
Tags: agile, database, unit test, testing, autoload, autoloader, facade
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 1.3.6
License: GPLv2 or later

Facilitates the use of Agile coding techniques in developing WordPress plugins. Contains required libraries for using plugins from toppa.com

== Description ==

**Overview**

The Toppa Plugin Libraries for WordPress include several utilities for plugin developers. They facilitate the use of Agile coding techniques for developing WordPress plugins. This library is required for use of [toppa.com plugins](http://www.toppa.com/wordpress-plugins). The following libraries are included:

* ToppaAutoloader: gives you an easy way to autoload class files for WordPress plugins. It conforms to the [PSR-0 standard for autoloading in PHP](http://groups.google.com/group/php-standards/web/psr-0-final-proposal), except it does not yet support namespaces (since WordPress currently is not intended for use with features that were introduced in PHP 5.3).
* ToppaSettings: simplifies the management of plugin settings.
* ToppaFunctionsFacade: creates a facade (wrapper) for functions that are custom to WordPress, and provides enhanced functionality for certain tasks (such as multisite plugin installations). This allows you to write your plugins without calling WordPress functions directly. This gives you the power to do two things: 1. write unit tests for your plugin, and 2. make your plugin potentially usable outside of WordPress.
* ToppaDatabaseFacade: similar in concept to ToppaFunctionsFacade, but focuses on database interactions. In addition to creating wrappers for WordPress database calls, it includes enhanced functionality for tasks such as creating custom tables.
* ToppaHtmlFormField: a lightweight utility for creating HTML form fields. It is not a complete form builder. Instead it is intended to make it very easy to create form fields in a standardized way, and then lets you use them however you like.

See the [Toppa Plugin Libraries for WordPress page on my website](http://www.toppa.com/toppa-plugin-libraries-for-wordpress/) for more details and usage examples.

== Installation ==

Upload to your plugin folder just like any other plugin, and activate.

== Frequently Asked Questions ==

* Requires PHP 5.1.2 or higher.
* Requires WordPress 3.0 or higher.
* See the [Toppa Plugin Libraries for WordPress page on my website](http://www.toppa.com/toppa-plugin-libraries-for-wordpress/) for more details and usage examples.
* For troubleshooting help, please [post a comment in my latest post on WordPress plugins](http://www.toppa.com/category/technical/wordpress-plugins/).

== Changelog ==

= 1.3.6 =

* In the autoloader, check that a class file exists before loading, instead of just suppressing any include errors (this fixes a warnings issue with PHP on Windows)
* In the settings manager, add handling for nested arrays in settings

= 1.3.5 = Bug fix: assign defualt value to $outputType param in getPost() in ToppaFunctionsFacade (was causing an error in PHP 5.2.1)

= 1.3.4 =
* Added registerStylesheet(), getPost(), and getScriptsObject() to ToppaFunctionsFacade
* Added default value for 2nd argument for enqueueStylesheet() in ToppaFunctionsFacade
* Added sanitizeStringCallback() to ToppaFunctions
* Removed unneeded autoLoader param in constructor for ToppaDatabaseFacade
* Added support for hidden fields to ToppaHtmlFormField

= 1.3.3 = Save version number to the options table

= 1.3.2 = Added createAdminHioddenInputFields() to ToppaFunctionsFacade

= 1.3.1 =
* Suppress $wpdb error when trying to verify if table exists in verifyTableExists()
* Append primary key sql correctly in createTable()

= 1.3 =
* Added followRedirect() to ToppaFunctions
* Added arrayMergeRecursiveForSettings() to ToppaFunctions
* Added htmlSpecialCharsOnce() to ToppaFunctionsFacade
* Cleanup of PHP warnings in ToppaHtmlFormFields when running WP in debug mode
* Cleanup createTable() in ToppaDatabaseFacade

= 1.2 =
* Added callFunctionForNetworkSites() to ToppaFunctionsFacade
* Apply wpdb charset and collate defaults, if available, when creating a table
* Better error reporting if there is a db error

= 1.1.1 = Added filesystem functions to ToppaFunctionsFacade

= 1.1 =
* Added ToppaSettings interface and abstract class, for facilitating management of plugin settings
* Bug fix to ToppaFunctionsFacadeWp->getAdminUrl()

= 1.0.7 = Bug fix: don't add slashes to hardcoded quoted strings for db queries

= 1.0.6 = Added getIntTypes() to ToppaDatabaseFacade

= 1.0.5 = Added 9 more functions to ToppaFunctionsFacade

= 1.0.4 =
* More user friendly handling of activation errors
* Added .pot language translation file

= 1.0.3 =
* Added 6 more functions to ToppaFunctionsFacade
* Added fixed html ids for radio buttons in ToppaHtmlFormField::buildRadioGroup()
* Debugged ToppaHtmlFormField::buildCheckboxGroup()
* Debugged ToppaHtmlFormField::closeTag()

= 1.0.2 =
* Moved settings functions from database facade to ToppaFunctionsFacade
* Added 8 more functions to ToppaFunctionsFacade

= 1.0.1 =
* Added WP constants definitions
* Added activation function to make compatibility checks

= 1.0 = First version



