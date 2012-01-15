=== Toppa Plugins Libraries for WordPress ===
Contributors: toppa
Donate link: http://www.toppa.com/toppa-plugin-libraries-for-wordpress/
Tags: agile, database, unit test, testing, autoload, autoloader, facade
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 1.1.1

Facilitates the use of Agile coding techniques in developing WordPress plugins. Contains required libraries for using plugins from toppa.com

== Description ==

**Overview**

The Toppa Plugin Libraries for WordPress include several utilities for plugin developers. They facilitate the use of Agile coding techniques for developing WordPress plugins. This library is required for use of upcoming plugins from toppa.com. Each is written to conform to an object interface. This means that if you code your plugin against the interfaces, you can write unit tests for your plugin, and potentially use it outside of WordPress (you would need to write non-WordPress specific versions of the Toppa Library classes that conform to the interfaces, but you would not need to alter your plugin itself). The following libraries are included.

* ToppaAutoloader: gives you an easy way to autoload class files for WordPress plugins. It conforms to the [PSR-0 standard for autoloading in PHP](http://groups.google.com/group/php-standards/web/psr-0-final-proposal), except it does not yet support namespaces (since WordPress currently is not intended for use with features that were introduced in PHP 5.3).
* ToppaFunctionsFacade: creates a facade (wrapper) for functions that are custom to WordPress. This allows you to write your plugins without calling WordPress functions directly. This gives you the power to do two things: 1. write unit tests for your plugin, and 2. make your plugin potentially usable outside of WordPress.
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



