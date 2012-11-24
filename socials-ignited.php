<?php
/*
Plugin Name: Socials Ignited
Description: The Socials Ignited plugin gives you a widget, allowing you to display and link icons on your website of more than 50 social networks. Once activated go to Settings > Socials Ignited to add your social profiles and then to Appearance > Widgets to use the widget :)
Version: 1.0
License: GPL
Plugin URI: http://www.cssigniter.com/ignite/socials-ignited
Author: The CSSIgniter Team
Author URI: http://www.cssigniter.com/
Text Domain: cisiw

==========================================================================

Copyright 2011-2012  CSSIgniter

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// plugin folder url
if(!defined('CISIW_PLUGIN_URL')) {
	define('CISIW_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

// plugin folder path
if(!defined('CISIW_PLUGIN_PATH')) {
	define('CISIW_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
}

// plugin root file
if(!defined('CISIW_PLUGIN_FILE')) {
	define('CISIW_PLUGIN_FILE', __FILE__);
}

load_plugin_textdomain('cisiw', false, dirname(plugin_basename(__FILE__)).'/languages/');


// Includes
include('includes/admin-page.php');
include('includes/widget.php');

?>