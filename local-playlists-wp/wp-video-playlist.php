<?php
/*
 * Plugin Name: Local Playlists WP
 * Description: Create local video playlists.
 * Version: 0.0.1
 * Tags: Video, Videos, Video Player, Video Playlist, Playlist
 * License: GPLv2 or later
 * Text Domain: wp-local-playlists
 * 
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 * 
 * This plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *  
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this.
*/

// Prevent direct call this file.
defined('ABSPATH') or die("No access");

// Composer Autoload. 
if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')):
	require_once dirname(__FILE__) . '/vendor/autoload.php';
endif;

function wp_mediaActive()
{
	$default = array();

	flush_rewrite_rules();
	if(!get_option('videoFields')):
		update_option('videoFields', $default);
	endif;
}
function wp_mediaDeactive()
{
	flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'wp_mediaActive');
register_deactivation_hook(__FILE__, 'wp_mediaDeactive');

if(class_exists('Inc\\Init')):
	Inc\Init::register_services();
endif;
