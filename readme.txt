=== Socials Ignited ===
Plugin Name: Socials Ignited
Plugin URI: http://www.cssigniter.com/ignite/socials-ignited/
Author URI: http://www.cssigniter.com/
Author: The CSSigniter Team
Contributors: anastis, tsiger, silencerius
Tags: social, widget, icons, round, square, light, dark, fontawesome
Requires at least: 3.8
Tested up to: 4.0
Stable tag: 1.7.4
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Socials Ignited plugin gives you a widget, allowing you to display and link icons on your website of more than 50 social networks.

== Description ==

Brought to you by the [CSSIgniter](http://www.cssigniter.com "Premium WordPress Themes") folks, the Socials Ignited
plugin allows you to display and link icons on your website of more than 50 social networks, just by dragging a widget.

There are icons for:

*   Facebook
*   Twitter
*   Digg
*   Flickr
*   And much, much more... (any of the [439 Font Awesome icons](http://fortawesome.github.io/Font-Awesome/icons/) actually)

Of course, there are more features to come. Check the *To Do* section for what is coming.

== Installation ==

1. Upload the folder `socials-ignited/` into the `/wp-content/plugins/` directory
2. Activate the plugin through the *Plugins* menu in WordPress
3. Set your defaults from *Settings -> Socials Ignited*
4. Drag the *Socials Ignited* widget into the widget area of your choice. 
5. Set the icons you want, their links and optional titles, color and size.
6. Press Save.
7. Done. 

For in-depth details, tips and tricks, visit [the plugin's homepage](http://www.cssigniter.com/ignite/socials-ignited/ "Socials Ignited")

== Screenshots ==

1. Socials Ignited options
2. Widget options
3. Actual output

== Changelog ==

= 1.7.4 =
* Made the bundled version of FontAwesome override any pre-existing ones with the handle ‘font-awesome’. Some themes provide an older version of the font and that was used instead, resulting in non-working icons.

= 1.7.3 =
* Updated FontAwesome to v4.2.0

= 1.7.2 =
* Now all options have user-supplied default from the options page.
* Optimized output of CSS rules for each widgets. This also fixes some edge cases where invalid rules would get outputted.
* The default option values are now only used when creating new widgets, rather than determining the outcome of the CSS generation.

= 1.7.1 =
* Fixed a bug where only the generated CSS of the first Socials Ignited widget would get outputted (when multiple widgets existed).
* Added a "Settings" link into the plugins' listing page.
* The plugin's Upgrade Notice, if available, is now shown into the plugins listing page.

= 1.7 =
* Renamed *-= CI Socials Ignited =-* class from *CI_Socials_Ignited_Fontawesome* to *Socials_Ignited_Widget* .
* Changed *-= CI Socials Ignited =-* HTML IDs to *socials-ignited* .
* Changed *-= CI Socials Ignited =-* HTML class to *widget_socials_ignited* .

= 1.6 =
* Added more options to the *-= CI Socials Ignited =-* widget like background color, size, opacity.

= 1.5 =
* Added Font Awesome support as *-= CI Socials Ignited =-* widget.
* Renamed old *-= CI Socials Ignited =-* widget to *Socials Ignited (deprecated)*
* Added various deprecation messages. No functions/files have actually been marked deprecated though.

= 1.4 =
* Fixed an issue where the Customizer screen would not work because jquery.chained.js wasn’t loaded.
* Updated jquery.chained.js to v0.9.10.
* Worked around an issue where the chained dropdowns wouldn’t work before Save was pressed.
* Added more round dark icons (addthis, amazon_alt, behance, soundcloud).
* Improved sanitization.
* Labels are now properly associated to fields.
* Title now goes through the widget_title filter.
* Updated language files.

= 1.3 =
* Added a Custom CSS option for easy customization, and in order to preserve custom styling betweet updates.
* Updated language files.

= 1.2.1 =
* Removed some styles that caused existing instances to show up wrongly.

= 1.2 =
* Added 16x16 and 24x24 square icons.
* Added button to reset custom order of icons.
* Internationalized plugin's settings title.
* Fixed an issue where a label would prompt for a "http://" on the Email field.
* Added Path (path.com) icon.
* Updated language files.

= 1.1.2 =
* Removed align attribute from img elements.
* Added alt attribute to img elements.

= 1.1.1 =
* Fixed an issue where the URL would appear on the "Enter your URL" prompt.
* Updated language files as they seemed to be empty.

= 1.1 =
* Fixed an issue where the icons looked huge in mobile devices.
* Support for user-defined services, icons and icon sets.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.7.2 =
This version improves the use of defaults, and fixes some edge cases with the generated front-end CSS.

= 1.7.1 =
This version fixes a bug where only the generated CSS of the first Socials Ignited widget would get outputted (when multiple widgets existed).

= 1.7 =
WARNING - UPDATING FROM <= v1.6 TO >= v1.7 WILL RESULT IN YOUR FONT-BASED SOCIALS-IGNITED WIDGETS TO BE PERMANENTLY LOST.
FURTHERMORE, CUSTOM STYLES APPLYING TO THE FONT-WIDGET MAY NO LONGER WORK AND WILL NEED RETARGETING.
Please keep note of your widgets' settings, remove them (the widgets), and then update the plugin.
