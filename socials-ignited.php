<?php
/*
Plugin Name: Socials Ignited
Description: The Socials Ignited plugin gives you a widget, allowing you to display and link icons on your website of more than 50 social networks. Once activated go to Settings > Socials Ignited to add your social profiles and then to Appearance > Widgets to use the widget :)
Version: 1.9
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

if(!defined('CISIW_BASENAME')) {
	define('CISIW_BASENAME', plugin_basename(__FILE__));
}

load_plugin_textdomain('cisiw', false, dirname(plugin_basename(__FILE__)).'/languages/');


// Includes
include('includes/admin-page.php');
include('includes/widget.php');

if( !function_exists('cisiw_get_services') ):
function cisiw_get_services()
{
	$services = apply_filters('cisiw_services', array(
		'addthis'		=> _x('AddThis', 'website name', 'cisiw'),
		'amazon'		=> _x('Amazon', 'website name', 'cisiw'),
		'amazon_alt'	=> _x('Amazon (alternative icon)', 'website name', 'cisiw'),
		'apple'			=> _x('Apple', 'website name', 'cisiw'),
		'apple_alt'		=> _x('Apple (alternative icon)', 'website name', 'cisiw'),
		'blogger'		=> _x('Blogger', 'website name', 'cisiw'),
		'behance'		=> _x('Behance', 'website name', 'cisiw'),
		'delicious'		=> _x('Delicious', 'website name', 'cisiw'),
		'designfloat'	=> _x('Design Float', 'website name', 'cisiw'),
		'designbump'	=> _x('Design Bump', 'website name', 'cisiw'),
		'deviantart'	=> _x('DeviantArt', 'website name', 'cisiw'),
		'digg'			=> _x('Digg', 'website name', 'cisiw'),
		'dopplr'		=> _x('Dopplr', 'website name', 'cisiw'),
		'dribbble' 		=> _x('Dribbble', 'website name', 'cisiw'),
		'email'			=> _x('Email', 'website name', 'cisiw'),
		'evernote'		=> _x('Evernote', 'website name', 'cisiw'),
		'facebook' 		=> _x('Facebook', 'website name', 'cisiw'),
		'flickr' 		=> _x('Flickr', 'website name', 'cisiw'),
		'forrst'		=> _x('Forrst', 'website name', 'cisiw'),
		'friendfeed'	=> _x('FriendFeed', 'website name', 'cisiw'),
		'github'		=> _x('GitHub', 'website name', 'cisiw'),
		'github_alt'	=> _x('GitHub (alternative icon)', 'website name', 'cisiw'),
		'gplus' 		=> _x('Google+', 'website name', 'cisiw'),
		'grooveshark'	=> _x('Grooveshark', 'website name', 'cisiw'),
		'gtalk'			=> _x('Gtalk', 'website name', 'cisiw'),
		'instagram'		=> _x('Instagram', 'website name', 'cisiw'),
		'lastfm'		=> _x('LastFM', 'website name', 'cisiw'),
		'linkedin' 		=> _x('LinkedIn', 'website name', 'cisiw'),
		'myspace' 		=> _x('MySpace', 'website name', 'cisiw'),
		'netvibes'		=> _x('Netvibes', 'website name', 'cisiw'),
		'newsvine'		=> _x('Newsvine', 'website name', 'cisiw'),
		'orkut'			=> _x('Orkut', 'website name', 'cisiw'),
		'path'			=> _x('Path', 'website name', 'cisiw'),		
		'paypal'		=> _x('Paypal', 'website name', 'cisiw'),
		'picasa' 		=> _x('Picasa', 'website name', 'cisiw'),
		'pinterest' 	=> _x('Pinterest', 'website name', 'cisiw'),
		'posterous'		=> _x('Posterous', 'website name', 'cisiw'),
		'reddit'		=> _x('Reddit', 'website name', 'cisiw'),
		'rss'			=> _x('RSS', 'website name', 'cisiw'),
		'sharethis'		=> _x('ShareThis', 'website name', 'cisiw'),
		'skype'			=> _x('Skype', 'website name', 'cisiw'),
		'soundcloud'	=> _x('SoundCloud', 'website name', 'cisiw'),
		'spotify'		=> _x('Spotify', 'website name', 'cisiw'),
		'stumble'		=> _x('StumbleUpon', 'website name', 'cisiw'),
		'technorati'	=> _x('Technorati', 'website name', 'cisiw'),
		'tumblr'		=> _x('Tumblr', 'website name', 'cisiw'),
		'twitter' 		=> _x('Twitter', 'website name', 'cisiw'),
		'viddler'		=> _x('Viddler', 'website name', 'cisiw'),
		'vimeo'			=> _x('Vimeo', 'website name', 'cisiw'),
		'virb'			=> _x('Virb', 'website name', 'cisiw'),
		'virb_alt'		=> _x('Virb (alternative icon)', 'website name', 'cisiw'),
		'yahoo'			=> _x('Yahoo', 'website name', 'cisiw'),
		'yahoo_alt'		=> _x('Yahoo (alternative icon)', 'website name', 'cisiw'),
		'youtube' 		=> _x('YouTube', 'website name', 'cisiw'),
		'youtube_alt' 	=> _x('YouTube (alternative icon)', 'website name', 'cisiw'),
		'windows'		=> _x('Windows', 'website name', 'cisiw'),
		'wordpress'		=> _x('WordPress', 'website name', 'cisiw'),
		'zerply'		=> _x('Zerply', 'website name', 'cisiw')
	));
	return $services;
}
endif;

if( !function_exists('cisiw_get_icon_sets') ):
function cisiw_get_icon_sets()
{
	// Note that the set's names, variations and sizes must match the folder value.
	$icon_sets = apply_filters('cisiw_icon_sets', array(
		// First level is the set's name.
		'square' => array(
			// Second level are the available variations
			'default' => array(
				// Third level are the available sizes for the specific variation.
				'16', '24', '32', '48', '64'
			)
		),
		'round' => array(
			'dark' => array('32'),
			'light' => array('32')
		)
	));
	return $icon_sets;
}
endif;

if( !function_exists('cisiw_get_icon_set_names') ):
function cisiw_get_icon_set_names()
{
	$icon_set_names = apply_filters('cisiw_icon_set_names', array(
		'square' => _x('Square', 'icons set name', 'cisiw'),
		'round' => _x('Round', 'icons set name', 'cisiw')
	));
	return $icon_set_names;
}
endif;

if( !function_exists('cisiw_get_lookup_paths') ):
function cisiw_get_lookup_paths()
{
	$lookup_paths = apply_filters('cisiw_lookup_paths', array(
		// icon_set => base_path, base_url
		'dir' => array(CISIW_PLUGIN_PATH),
		'url' => array(CISIW_PLUGIN_URL)
	));
	return $lookup_paths;
}
endif;

// The icon should be passed in the form  set/variation/size/service.png
if( !function_exists('cisiw_get_icon_path') ):
function cisiw_get_icon_path($icon)
{
	$lookup_paths = cisiw_get_lookup_paths();
	
	$icon = 'images/'.$icon;
	
	$i = 0;
	$found = false;
	foreach($lookup_paths['dir'] as $path)
	{
		if( is_readable($path.$icon) )
		{
			$found = $i;
			break;
		}
		$i++;
		
	}
	if($found!==false)
	{
		$icon_url = $lookup_paths['url'][$found].$icon;
		return $icon_url;
	}

	return false;
	
}
endif;

add_filter('plugin_action_links_'.CISIW_BASENAME, 'cisiw_plugin_action_links');
if( !function_exists('cisiw_plugin_action_links') ):
function cisiw_plugin_action_links($links) {
	$url = admin_url( 'options-general.php?page=cisiw-options' );
	array_unshift( $links, '<a href="' . esc_url( $url ) . '">' . __( 'Settings', 'cisiw' ) . '</a>' );
	return $links;
}
endif;

add_action('in_plugin_update_message-'.CISIW_BASENAME, 'cisiw_plugin_update_message', 10, 2);
if( !function_exists('cisiw_plugin_update_message') ):
function cisiw_plugin_update_message($plugin_data, $r) {
	if ( !empty( $r->upgrade_notice ) ) {
		printf( '<p style="margin: 3px 0 0 0; border-top: 1px solid #ddd; padding-top: 3px">%s</p>', $r->upgrade_notice );
	}
}
endif;


if ( !function_exists('cisiw_sanitize_hex_color') ):
/**
 * Returns a sanitized hex color code.
 *
 * @param string $str The color string to be sanitized.
 * @param bool $return_hash Whether to return the color code prepended by a hash.
 * @param string $return_fail The value to return on failure.
 * @return string A valid hex color code on success, an empty string on failure.
 */
function cisiw_sanitize_hex_color($str, $return_hash = true, $return_fail = '')
{

	// Include the hash if not there.
	// The regex below depends on in.
	if(substr($str, 0, 1)!='#')
	{
		$str = '#' . $str;
	}

	$matches = array();
	/*
	 * Example on success:
	 * $matches = array(
	 * 		[0] => #1a2b3c
	 * 		[1] => #
	 * 		[2] => 1a2b3c
	 * )
	 *
	 */
	preg_match('/(#)([0-9a-fA-F]{6})/', $str, $matches);

	if(count($matches) == 3)
	{
		if($return_hash)
			return $matches[1] . $matches[2];
		else
			return $matches[2];
	}
	else
	{
		return $return_fail;
	}
}
endif;

if( !function_exists('cisiw_absint_or_empty')):
/**
 * Return a positive integer value, or an empty string instead of zero.
 *
 * @uses absint()
 *
 * @param mixed $value A value to convert to integer.
 * @return mixed Empty string on zero, or a positive integer.
 */
function cisiw_absint_or_empty($value)
{
	$value = absint($value);
	if($value == 0)
		return '';
	else
		return $value;
}
endif;

if( !function_exists('cisiw_sanitize_checkbox')):
/**
 * Sanitizes a checkbox value, by comparing $input with $allowed_value
 *
 * @param string $input The checkbox value that was sent through the form.
 * @param string $allowed_value The only value that the checkbox can have (default 'on').
 * @return string The $allowed_value on success, or an empty string on failure.
 */
function cisiw_sanitize_checkbox(&$input, $allowed_value = 'on')
{
	if(isset($input) and $input == $allowed_value)
		return $allowed_value;
	else
		return '';
}
endif;
