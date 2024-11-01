<?php
Header("content-type: application/x-javascript");

### Load WP-Config File If This File Is Called Directly
if (!function_exists('get_post_meta')) {
	$wp_root = '../../..';
	if (file_exists($wp_root . '/wp-load.php')) {
		require_once($wp_root . '/wp-load.php');
	} else {
		require_once($wp_root . '/wp-config.php');
	}
}
?>

//Browser Support Code
function updateFeedback(postID, feedbackID, element){
	element.disabled = true;
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	
	
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function() {
		if(ajaxRequest.readyState == 4) {
			//update the totals on the post
			var temp = new Array();
			temp = ajaxRequest.responseText.split(',');
			var reac = document.getElementById('reac_' + temp[0] + '_' + temp[1]);
			reac.innerHTML = temp[2];
		}
	}
	ajaxRequest.open("POST", "<?php echo WP_PLUGIN_URL; ?>/wp-reactions/reactions_ajax.php", true);
	var params = 'feedbackID=' + feedbackID + '&postID=' + postID;
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.setRequestHeader("Content-length", params.length);
	ajaxRequest.setRequestHeader("Connection", "close");
	ajaxRequest.send(params);
}