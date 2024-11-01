<?php
### Load WP-Config File If This File Is Called Directly
if (!function_exists('update_option')) {
	$wp_root = '../../..';
	if (file_exists($wp_root . '/wp-load.php')) {
		require_once($wp_root . '/wp-load.php');
	} else {
		require_once($wp_root . '/wp-config.php');
	}
}

if ( !current_user_can('manage_options') )
	wp_die(__('Cheatin&#8217; uh?'));

$newValues =  $_REQUEST['reactions'];
update_option('reactions_text', $_REQUEST['reactions_text']);

if(get_option('reactions') == null) {
	update_option('reactions', array());
}

if( ($newValues != null) && (array_keys(get_option('reactions')) != array_keys($newValues)) ) {
	update_option('reactions', $newValues);
	$newpostmeta = array();
	foreach ($newValues as $value) {
		$newpostmeta[$value] = 0;
	}
	$posts = get_posts('numberposts=-1');
	foreach($posts as $post) {
		$postID = $post->ID;
		update_post_meta($postID, '_reactions', $newpostmeta, get_post_meta($postID, '_reactions', true));
	}
}

$goback = add_query_arg( 'updated', 'true', wp_get_referer() );
wp_redirect( $goback );
?>