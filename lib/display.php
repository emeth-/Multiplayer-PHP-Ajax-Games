<?php

/*
 *   SAMPLE PRESENTATION LAYER FUNCTIONS TO WORK WITH FB CONNECT
 */

/*   FUNCTION OVERVIEW
 *   prevent_cache_headers()						PREVENTS BROWSER FROM CACHING
 *   render_header()								RENDERS HEADER AND BODY TAGS
 *   onloadRegister($js)							JAVASCRIPT TO INCLUDE WHEN PAGE HAS LOADED
 *   render_footer()								RENDERS FOOTER INCLUDING FB CONNECT JS INCLUDE
 *   render_logged_out_index()						RENDERS PAGE WHEN USER HAS LOGGED OUT
 *	 render_status($user, $status_result)			RENDERS USERS PROFILE STATUS
 *   render_feed_form($user, $publish_result='')	RENDERS FORM FOR SUBMITTING FEED STORIES
 *   showing_results($row_start, $num_rows, $max_rows, $label)
 *   render_friends_table_html($friend, $row_start, $num_rows, $class_namespace='', $title='')		RENDERS TABLE OF FRIENDS USING HTML APPROACH
 *   render_friends_table_xfbml($friend, $row_start, $num_rows, $class_namespace='', $title='')		RENDERS TABLE OF FRIENDS USING XFBML
 *   render_connect_invite_link($has_existing_friends = false)	RENDERS CONNECT INVITE LINK FOR FRIENDS
 *   render_error($msg)								RENDERS ERROR MESSAGE
 */

/*
 * Prevent caching of pages. When the Javascript needs to refresh a page,
 * it wants to actually refresh it, so we want to prevent the browser from
 * caching them.
 */

function prevent_cache_headers() {
	header('Cache-Control: private, no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	header('Pragma: no-cache');
}

/*
 * Show the header that goes at the top of each page.
 */

function render_header($user=null) {
	// Might want to serve this out of a canvas sometimes to test
	// out fbml, so if so then don't serve the JS stuff
	if (isset($_POST['fb_sig_in_canvas'])) {
		return;
	}

	prevent_cache_headers();

	$html = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="KEYWORDS" content="facebook connect php tutorial"/>
			<meta name="description" content="Demo of facebook connect using php and javascript"/>
			<title>Facebook Connect Demo</title>
			<link type="text/css" rel="stylesheet" href="' . CONNECT_CSS_PATH . 'style.css" />
		</head>
		<body>
	';

	if (is_fbconnect_enabled()) {
		ensure_loaded_on_correct_url();
	}

	$html .='<div class="header">';

	if ($user) {
		// USER LOGGED IN
		if ($user->fbc_is_facebook_user()) {
			$html .= '<div id="header-profilepic">';
			$html .= $user->fbc_getProfilePic_xfbml(true);
			$html .= '</div>';
		}
		$html .= '<div id="header-account">';
		$html .= '<b>Welcome, '.$user->fbc_getName().'</b>';
		$html .= '<div class="account_links">';
		if ($user->fbc_is_facebook_user()) {
			$html .= sprintf('<a href="#" onClick="FB.Connect.logout(function() { refresh_page(); })">'
											 .'Logout of Facebook'
											 //.'<img src="images/fbconnect_logout.png">'
											 .'</a>',
											 $_SERVER['REQUEST_URI']);
		} else {
			// PUT YOUR SITES LOGOUT URL HERE
		}
		$html .= '</div>';
		$html .= '</div>';
	} else {
		// NOT LOGGED IN
		$html .= '<div id="header-account">';
		$html .= 'Hello Guest ';
		$html .= '</div>';
	}

	$html .= '</div>'; // header & header_content
	$html .= '<div class="content">';
	$html .= "<div class='fbconnect_welcome'>";
	$html .= "<img src='" . CONNECT_IMG_PATH . "connect_logo.jpg' class='logo' />";
	$html .= "Welcome to a demo of the Quick Start Facebook Connect PHP API.  This is an optimized version of Facebook's Runaround demo that allows you to quickly implement the FB Connect PHP library onto your website.<br/><br/>";
	$html .= "You can also check out a FB Connect <a href='http://www.pakt.com/pakt/?id=5e17b48f5679ab47&t=How_to_add_Facebook_Connect_to_your_website_using_PHP_API' title='Facebook Connect Tutorial'>setup tutorial</a> as well as the <a href='http://code.google.com/p/facebook-connect-php5-library/downloads/list' title='Facebook Connect PHP library'>code library</a> used for this demo.";
	$html .= "</div>";
	
	// Catch misconfiguration errors.
	if (!is_config_setup()) {
		$html .= render_error('Your FB Connect configuration is not complete.');
		$html .= '</body>';
		echo $html;
		exit;
	}

	return $html;
}

/*
 * Register a bit of javascript to be executed on page load.
 *
 * This is printed in render_footer(), so make sure to include that on all pages.
 */

function onloadRegister($js) {
	global $onload_js;
	$onload_js .= $js;
}

/*
 * Print the unified footer for all pages. Includes all onloadRegister'ed Javascript for the page.
 *
 */

function render_footer() {
	global $onload_js;
	// the init js needs to be at the bottom of the document, within the </body> tag
	// this is so that any xfbml elements are already rendered by the time the xfbml
	// rendering takes over. otherwise, it might miss some elements in the doc.

	if (is_fbconnect_enabled()) {
		$html .= render_fbconnect_init_js();
	}

	// Print out all onload function calls
	if ($onload_js) {
		$html .= '<script type="text/javascript">'
			.'window.onload = function() { ' . $onload_js . ' };'
			.'</script>';
	}


	return $html;
}

/*
 * Default index for logged out or new users.
 *
 */

function render_logged_out_index() {

	$html = '<div class="fbconnect_title_wrapper">';
	$html .= '<h2>Login to this application using facebook</h2>';
	$html .= '</div>';
	
	if (is_fbconnect_enabled()) {
		$html .= '<div class="fbconnect_login">';
		$html .= render_fbconnect_button('medium');
		$html .= '</div>';
	}

	return $html;
}

function render_status($user, $status_result) {
	$html = "<div class='fbconnect_title_wrapper'>";
	$html .= "<h2>My Status</h2>";
	$html .= '<div class="fbconnect_status"><b>' . $user->fbc_first_name . '</b> ' . $user->fbc_getStatus() . '</div>';
	$html .= "<div class='fbconnect_text'>In order to update a status directly from PHP, you must have the user authorize status_update extended permissions to your application.";
	if ($user->fbc_getExtendedPermission('status_update') < 1) {
		$html .= '  Click the button below to authorize status updating.<br/><br/>';
		$html .= "<input type='button' name='fbconnect_spd_submit' class='fbconnect_button' onclick='fbc_show_status_update_permission_dialog();' value='Authorize Status Updates'>";
		$html .= "</div>";
	} else {
		$html .= '<br/><br/>Status Updating Permissions have been granted.<br/><br/>';
		$html .= "<form name='status_form' method='POST'>";
		$html .= "<div id='fbconnect_status_result'>" . $status_result . "</div>";
		$html .= $user->fbc_first_name . " is <input id='fbconnect_input' name='status' size='50' maxlength='160' />";
		$html .= "<input type='submit' name='fbconnect_php_status_submit' class='fbconnect_button' value='Update Status via PHP'>";
		$html .= "</form>";
		$html .= "</div>";
	}
	$html .= "</div>";
	return $html;
}

function render_feed_form($user, $publish_result='') {
	$html = "<div class='fbconnect_title_wrapper'>";
	$html .= "<h2>Post Feed Story</h2>";
	$html .= "<form name='feed_form' method='POST'>";
	$html .= "<div id='fbconnect_result'>" . $publish_result . "</div>";
	$html .= "<textarea id='fbconnect_textarea' name='comment' rows='5' cols='30'></textarea>";
	$html .= "<input type='button' name='fbconnect_js_submit' class='fbconnect_button' onclick='publish_js_comment(\"" . idx($GLOBALS, 'feed_bundle_id') . "\", \"" . idx($GLOBALS, 'sample_post_title') . "\",  \"" . idx($GLOBALS, 'sample_post_url') . "\");' value='Post via JS'>";

	if ($user->fbc_getExtendedPermission('offline_access') < 1) {
		$html .= '  Click the button below to authorize offline access.<br/><br/>';
		$html .= "<input type='button' name='fbconnect_oad_submit' class='fbconnect_button' onclick='fbc_show_offline_access_permission_dialog();' value='Authorize Offline Access'>";
		$html .= "</div>";
	}
	else if ($user->fbc_getExtendedPermission('publish_stream') < 1) {
		$html .= "<input type='button' name='fbconnect_oad_submit' class='fbconnect_button' onclick='fbc_show_publish_stream_permission_dialog();' value='Authorize Stream Publishing'>";
		$html .= "</div>";
	}
 else {
		$html .= '<br/><br/>Offline Access has been granted.<br/><br/>';
		$html .= "</div>";
		$html .= "<input type='submit' name='fbconnect_php_submit' class='fbconnect_button' value='Post via PHP'>";
	}
	$html .= "</form>";
	return $html;
}

function showing_results($row_start, $num_rows, $max_rows, $label) {
	// SHOWS HOW MANY AND WHICH RECORDS ARE BEING DISPLAYED
	if (($row_start != "") && ($row_start > 0)) { $limit_low = $row_start+1;} else { $limit_low = 1;}
	$limit_high = $num_rows + $limit_low - 1;					
	if ($limit_high > $max_rows) { $limit_high = $max_rows; }
	if ($num_rows > 0) {						
		$html = "Showing " . $label;
		$html .= " " . $limit_low . " through " . $limit_high . " of " . $max_rows;
	}
	return $html;
}
function render_friends_table_all_names_only_html($friend, $class_namespace='', $title='') {
	global $db;
	if (empty($friend)) { 
		$html = '<table>';
		$html .= '<tr><td class="header" colspan="2">' . $title . '</td></tr>';
		$html .= '<tr><td class="sub" colspan="2">No friends here!</td></tr>';
		$html .= '</table>';
		return $html;
	}
	$max_rows = sizeof($friend);
	
	$html = '<table>';
	$html .= '<tr><td class="header" colspan="2"><center>' . $title . '</center></td></tr>';
	for ($i=0;$i<$max_rows;$i++) {
		$uin = $db->query("SELECT laston FROM users WHERE userid={$friend[$i][uid]} LIMIT 1");
		if($db->num_rows($uin)>0)
		{
			$un = $db->fetch_row($uin);
			$laston = $un['laston'];
			$ctime = time();
			$last15 = time() - 60 * 15;
			$last60 = time() - 60 * 60;
			if($laston > $last15)
			{
				$lastonimg = "<img src='images/online.png'> ";
			}
			else if($laston > $last60)
			{
				$lastonimg = "<img src='images/idle.png'> ";
			}
			else
			{
				$lastonimg = "<img src='images/offline.png'> ";
			}
		}
		$html .= '<tr><td class="sub" colspan="2">'.$lastonimg.
		'<a href="javascript:void(0)" onclick="javascript:chatWith(\''.$friend[$i][first_name].'_'.$friend[$i][last_name].'\');">
		' . $friend[$i][first_name] . ' ' . $friend[$i][last_name] . '</a>
		[<a href="challenge.php?act=prechallenge&player='.$friend[$i][uid].'">C</a>] 
		[<a target="_blank" href="http://www.facebook.com/profile.php?id=' . $friend[$i][uid] . '">P</a>]</td></tr>';
		//<img src="images/challenge.png">
		
	}
	$html .= '<tr><td class="sub" colspan="2" align="center"><b>C</b> = Challenge | <b>P</b> = Profile</td></tr>
	<tr><td class="sub" colspan="2" align="center">Click a friend\'s name to chat.</td></tr></table>';
	return $html;
}



function render_friends_table_html($friend, $row_start, $num_rows, $class_namespace='', $title='') {
	if (empty($friend)) { 
		$html = '<div class="fbconnect_title_wrapper">';
		$html .= '<h2>' . $title . '</h2>';
		$html .= '<h3>No friends here!</h3>';
		$html .= '</div>';
		return $html;
	}
	$max_rows = sizeof($friend);
	if ($row_start > $max_rows) { $row_start = 0; }
	if (($num_rows+$row_start) > $max_rows){ $num_rows = $max_rows-$row_start; }
	
	$html = '<div class="fbconnect_title_wrapper">';
	$html .= '<h2>' . $title . '</h2>';
	$html .= '<h3>' . showing_results($row_start, $num_rows, $max_rows, "friends") . '</h3>';
	for ($i=$row_start;$i<($num_rows+$row_start);$i++) {
		$html .= '<div class="' . $class_namespace . '_wrapper">';
		$html .= '<div class="' . $class_namespace . '_name"><a href="http://www.facebook.com/profile.php?id=' . $friend[$i][uid] . '">' . $friend[$i][first_name] . ' ' . $friend[$i][last_name] . '</a></div>';
		if ($friend[$i][pic_small] == "") {
			$html .= '<div class="' . $class_namespace . '_pic"><a href="http://www.facebook.com/profile.php?id=' . $friend[$i][uid] . '"><img src="' . CONNECT_IMG_PATH . 'fb_silhouette_logo.gif" /></a></div>';
		} else {
			$html .= '<div class="' . $class_namespace . '_pic"><a href="http://www.facebook.com/profile.php?id=' . $friend[$i][uid] . '"><img src="' . $friend[$i][pic_small] . '" /></a></div>';
		}
		$html .= "</div>";
	}
	$html .= '</div>';
	return $html;
}

function render_friends_table_xfbml($friend, $row_start, $num_rows, $class_namespace='', $title='') {
	if (empty($friend)) { 
		$html = '<div class="fbconnect_title_wrapper">';
		$html .= '<h2>' . $title . '</h2>';
		$html .= '<h3>No friends here!</h3>';
		$html .= '</div>';
		return $html;
	}
	$max_rows = sizeof($friend);
	if ($row_start > $max_rows) { $row_start = 0; }
	if (($num_rows+$row_start) > $max_rows){ $num_rows = $max_rows-$row_start; }

	$html = '<div class="fbconnect_title_wrapper">';
	$html .= '<h2>' . $title . '</h2>';
	$html .= '<h3>' . showing_results($row_start, $num_rows, $max_rows, "friends") . '</h3>';
	for ($i=$row_start;$i<($num_rows+$row_start);$i++) {
		$html .= '<div class="' . $class_namespace . '_wrapper">';
		$html .= '<div class="' . $class_namespace . '_name">';
		$html .= '<fb:name uid="' . $friend[$i][uid] . '"></fb:name>';
		$html .= '</div>';
		$html .= '<div class="' . $class_namespace . '_pic">';
		$html .= '<fb:profile-pic uid="' . $friend[$i][uid] . '" size="square"  facebook-logo="true"></fb:profile-pic>';
		$html .= '</div>';
		$html .= "</div>";
	}
	$html .= '</div>';
	return $html;
}

function render_connect_invite_link($has_existing_friends = false) {
	$more = $has_existing_friends ? ' more' : '';
	$num = '<fb:unconnected-friends-count></fb:unconnected-friends-count>';

	$one_friend_text = 'You have one'.$more.' Facebook friend that also uses this application. ';
	$multiple_friends_text = 'You have '.$num.$more.' Facebook friends that also uses this application. ';
	$invite_link = '<a onClick="FB.Connect.inviteConnectUsers(); return false;">Invite them to Connect.</a>';

	$html = '';
	$html .= '<fb:container class="HideUntilElementReady" condition="FB.XFBML.Operator.equals(FB.XFBML.Context.singleton.get_unconnectedFriendsCount(), 1)" >';
	$html .= '<span>'.$one_friend_text.' '.$invite_link.'</span>';
	$html .= '</fb:container>';
	$html .= '<fb:container class="HideUntilElementReady" condition="FB.XFBML.Operator.greaterThan(FB.XFBML.Context.singleton.get_unconnectedFriendsCount(), 1)" >';
	$html .= '<span>'.$multiple_friends_text.' '.$invite_link.'</span>';
	$html .= '</fb:container>';
	return $html;
}

function render_error($msg) {
	return '<div class="error">'.$msg.'</div>';
}

?>