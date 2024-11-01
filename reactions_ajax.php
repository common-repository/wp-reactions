<?php
/*
* Function called by the ajax form to update the reactions for a post.
* This script is passed the postID and the reactionID.
* The postID is the unique id WordPress gives to each post.
* The feedbackID is the name of the feedback we are updating.
*/


### Load WP-Config File If This File Is Called Directly
if (!function_exists('get_post_meta')) {
	$wp_root = '../../..';
	if (file_exists($wp_root . '/wp-load.php')) {
		require_once($wp_root . '/wp-load.php');
	} else {
		require_once($wp_root . '/wp-config.php');
	}
}


#grab the relevant info from the request
$feedbackID = $_REQUEST["feedbackID"];
$postID = $_REQUEST["postID"];

#grab the existing feedback info from the post
$reactions = get_post_meta($postID, '_reactions', true);

#echo the updated info back to the user in the form postID, feedbackID, number oif responses
echo $postID . ',' . $feedbackID . ',' . ++$reactions[$feedbackID];

#finally, update the feedback data in the post with the new info
update_post_meta($postID, '_reactions', $reactions);
?>