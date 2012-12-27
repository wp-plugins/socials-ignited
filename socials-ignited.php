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
		'twitter_alt'	=> _x('Twitter (alternative icon)', 'website name', 'cisiw'),
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
				'32', '48', '64'
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


?>