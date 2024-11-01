<?php
/*
Plugin Name: wp-reactions
Plugin URI: http://theflyingdeveloper.com/wordpress-plugins/wp_reactions/
Description: Adds reactions similar to those found on Blogger to your posts
Version: 0.6.6
Author: David Underwood
Author URI: http://theflyingdeveloper.com

Copyright 2009 David Underwood  (email : davefp@gmail.com)

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
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

#Function: Admin menu definition
add_action('admin_menu', 'reactions_plugin_menu');
function reactions_plugin_menu() { 
	add_options_page('Reactions Plugin Options', 'Reactions', 8, 'wp-reactions/reactions_options.php');
}

#Function: Add link to the javascript file to the page header
add_action('wp_head', 'add_reactions_js');
function add_reactions_js() {
	echo '<script type="text/javascript" src="' . WP_PLUGIN_URL . '/wp-reactions/reactions_js.php"></script>';
}

#Function: Add custom fields for reactions
add_action('publish_post', 'add_reaction_fields');
function add_reaction_fields($post_ID) {
	$reactions = get_option('reactions');
	if($reactions != null) {
		$newpostmeta = array();
		foreach ($reactions as $name) {
			$newpostmeta[$name] = 0;
		}
		add_post_meta($post_ID, '_reactions', $newpostmeta, true);
	}	
}

#Function: show the reactions mini-poll on the post
function the_reactions() {
	global $id;
	$reactions = get_post_meta($id, '_reactions', true);
	if($reactions != null) {
		echo '<form class="wp-reactions-form postmetadata" action="#"><span class="wp-reactions">';
		echo get_option('reactions_text');
		foreach ($reactions as $key => $value) {
			echo '<input class="wp-reactions-input" type="checkbox" onclick="updateFeedback(' . $id . ', \'' . $key . '\', this);" />';
			echo '<span class="wp-reactions-key">' . $key . ': <span id="reac_' . $id . '_' . $key . '"class="wp-reactions-value">' . $value . '</span></span>';
		}
		echo '</span></form>';
	}
}
?>
