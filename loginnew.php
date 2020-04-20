<?php

include_once 'lib/config.php';

$user = User::fbc_getLoggedIn();
($user) ? $fb_active_session = $user->fbc_is_session_active() : $fb_active_session = FALSE;

if (!$user) {
	// DISPLAY PAGE WHEN USER IS NOT LOGGED IN TO FB CONNECT
	echo render_header($user);
	echo render_logged_out_index();
	echo render_footer();
	exit;
}

// USER CONNECTED TO APPLICATION
if ($user->fbc_is_facebook_user()) {

	if ($_POST["comment"] != "") {
		// PUBLISH STORY TO PROFILE FEED
		$template_data = array(
			'post-title'=>idx($GLOBALS, 'sample_post_title'), 
			'post-url'=>idx($GLOBALS, 'sample_post_url'), 
			'post'=>$_POST["comment"]);			
		$target_ids = array();
		$body_general = '';
		$publish_success = $user->fbc_publishFeedStory(idx($GLOBALS, 'feed_bundle_id'), $template_data);
		if ($publish_success) { $publish_result = "Published story via PHP to your profile feed!"; } else { $publish_result = "Error publishing story!"; }
	}

	if ($_POST["status"] != "") {
		// PUBLISH STORY TO PROFILE FEED
		$status_success = $user->fbc_setStatus($_POST["status"]);
		if ($status_success) { $status_result = "Updated your status via PHP!"; } else { $status_result = "Error updating your status!"; }
	}

	echo render_header($user);

	// SHOW FACEBOOK STATUS
	echo render_status($user, $status_result);

	// POST FEED TO PROFILE
	echo render_feed_form($user, $publish_result);

	// SHOW ALL FRIENDS
	$friends = $user->fbc_get_all_friends(TRUE);
	echo render_friends_table_html($friends, 0, 10, "fbconnect_friend", "All Friends");

	// SHOW ALL CONNECTED FRIENDS TO APPLICATION
	$friends = $user->fbc_get_connected_friends(FALSE);
	echo render_friends_table_html($friends, 0, 10, "fbconnect_friend", "Connected Friends");

	// SHOW ALL UNCONNECTED FRIENDS TO APPLICATION
	$friends = $user->fbc_get_unconnected_friends_xfbml(TRUE);
	echo render_friends_table_xfbml($friends, 3, 5, "fbconnect_friend", "Unconnected Friends");
	
	echo render_footer();
} else {
	echo render_header($user);
	echo render_footer();
}

?>