<?php

/*
 * This is a pretty generic user object.
 * Connect is intended to fit into an existing login system,
 * so you would use whatever your site already uses for this.
 *
 */

class User {
	public $fbc_uid;
	public $fbc_first_name;
	public $fbc_last_name;
	public $fbc_name;
	public $fbc_email;

	/* FUNCTION OVERVIEW
	* __construct($data)					POPULATES CLASS DATA FROM DATA ARRAY
	* fbc_getLoggedIn()							LOGS USER IN BY CREATING NEW USER CLASS IF FACEBOOK SESSION IS ACTIVE
	* fbc_getLoggedInNative() 					ORIGINAL LOGIN FUNCTION, COOKIE BASED
	* fbc_getFacebookUserEmailHashes($fbc_uid)	RETURNS FACEBOOK USERID FROM EMAIL HASH
	* fbc_is_facebook_user()					CHECKS IF FBUID IS SET WITHIN CLASS
	* fbc_getName()								RETURNS NAME FROM FACEBOOK PROFILE
	* fbc_getEmail()							RETURNS EMAIL HASH FROM FACEBOOK PROFILE
	* fbc_getFacebookBadge()					RETURNS FACEBOOK BADGE IMG HTML
	* fbc_getProfilePic($show_logo=false)		RETURNS FACEBOOK PROFILE PICTURE
	* fbc_getStatus() 							GRABS FACEBOOK STATUS
	* fbc_setStatus() 							SETS FACEBOOK STATUS
	* fbc_publishFeedStory($template_bundle_id, $template_data, $target_ids=array(), $body_general='', $story_size=1)	PUBLISHES FEED STORY TO PROFILE
	* fbc_disconnectFromFacebook()				UNREGISTERS USER
	* fbc_register_user() 						SAVES NEW USER AND REGISTERS WITH FACEBOOK
	* fbc_is_session_active()					CHECKS IF FACEBOOK SESSION IS ACTIVE
	* fbc_getExtendedPermission($ext_perm='offline_access')	RETRIEVES EXTENDED PERMISSION SETTINGS
	* fbc_get_all_friends($user, $all_rows=TRUE, $row_start=0, $num_rows=10) 				RETURNS ALL FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
	* fbc_get_all_friends_fbxml($user, $all_rows=TRUE, $row_start=0, $num_rows=10) 			RETURNS ALL FRIENDS ASSOCIATED WITH FBUID FOR USE WITH XFBML RENDER
	* fbc_get_connected_friends($user, $all_rows=TRUE, $row_start=0, $num_rows=10) 			RETURNS ALL CONNECTED FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
	* fbc_get_connected_friends_fbxml($user, $all_rows=TRUE, $row_start=0, $num_rows=10)		RETURNS ALL CONNECTED FRIENDS ASSOCIATED WITH FBUID FOR USE WITH XFBML RENDER
	* fbc_get_unconnected_friends($user, $all_rows=TRUE, $row_start=0, $num_rows=10) 		RETURNS ALL UNCONNECTED FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
	* fbc_get_unconnected_friends_fbxml($user, $all_rows=TRUE, $row_start=0, $num_rows=10)	RETURNS ALL UNCONNECTED FRIENDS ASSOCIATED WITH FBUID FOR USE WITH XFBML RENDER
	*/

	function __construct($data) {
		foreach ($data as $row) {
			foreach ($row as $key => $value) {
				if ($key == "uid") { $this->fbc_uid = $value; }
				if ($key == "first_name") { $this->fbc_name = $value; $this->fbc_first_name = $value; }
				if ($key == "last_name") { $this->fbc_name .= " " . $value; $this->fbc_last_name = $value; }
			}
		}

		if ($this->fbc_uid == '') {
			throw new Exception("Can not create user, no user id.");
		}
	}
	
	/*
	 * Figure out who the logged in user is.
	 *
	 * There are two ways of doing this:
	 *
	 * 1. Use the site-specific cookie auth system. Every site has one
	 * for managing their users; if someone is logged in with that method, great
	 *
	 * 2. If the user is logged in with Facebook, then return that associated account.
	 * The site-specific auth doesn't factor in.
	 *
	 * The philosophy here is that Facebook constitutes a "single-sign-on" experience:
	 * once you've connected your account to a site, whenever you visit that site again,
	 * it should just automatically know who you are. Therefore, logout logs you out
	 * of Facebook, and just being logged into Facebook is sufficient to log you in here.
	 *
	 * We achieve that through the Javascript API (see facebook_onload() function). The JS
	 * retrieves the session and sets some cookies; the PHP client lib verifies those
	 * cookies and returns the logged in user. If we are able to get a user, then it means
	 * that the user has already authorized the app, so just load their account (or
	 * create a new one) and log them in.
	 *
	*/

	static function fbc_getLoggedIn() {
		// LOGS USER IN BY CREATING NEW USER CLASS IF FACEBOOK SESSION IS ACTIVE
		$fbc_uid = facebook_client()->get_loggedin_user();

		if ($fbc_uid) {
			$fql_query = 'SELECT uid, first_name, last_name FROM user WHERE uid=' . $fbc_uid;
			try {
				$fql_result = facebook_client()->api_client->fql_query($fql_query);
			} catch (Exception $e) {
				// PROBABLY AN EXPIRED SESSION
				return null;
			}
			if (is_array($fql_result)) { return new User($fql_result); } else { return null; }
		} else {
			return null;
		}
	}

	/*
	 * This is the original getLoggedIn function, before Facebook Connect.
	 * Retrieve the current active user based on our custom cookie.
	 */

	static function fbc_getLoggedInNative() {
		// CHECK THE LOGGED-IN USERNAME FIRST
		$username = $_COOKIE[rb_current_user];
		return ($username && $username != 'unknown') ? User::getByUsername($username) : null;
	}

	/*
	 * If a Facebook user already has an account with this site, then
	 * their email hash will be returned.
	 *
	 * This only works because the site calls facebook.connect.registerUsers
	 * on every registration.
	 */

	static function fbc_getFacebookUserEmailHashes($fbc_uid) {
		// GRABS EMAIL HASHES FROM A USER'S ACCOUNT
		if (!$fbc_uid) {
		  return null;
		}
		$fb_query = 'SELECT email_hashes FROM user WHERE uid=\''.$fbc_uid.'\'';
		try {
			$rows = facebook_client()->api_client->fql_query($fb_query);
		} catch (Exception $e) {
			// PROBABLY AN EXPIRED SESSION
			return null;
		}
		if (is_array($rows) && (count($rows) == 1) && is_array($rows[0]['email_hashes'])) {
			return $rows[0]['email_hashes'];
		} else {
			return null;
		}
	}

	function fbc_is_facebook_user() {
		return ($this->fbc_uid > 0);
	}

	function fbc_getName() {
		// OVERRIDE THE USER'S NAME IF IT IS A FACEBOOK USER, REGARDLESS
		if ($this->fbc_is_facebook_user()) {
			$info = facebook_get_fields($this->fbc_uid, array('name'));
			if (!empty($info)) {
				return $info['name'];
			}
		}
		return $this->fbc_name;
	}

	function fbc_getEmail() {
		// USER CAN OVERRIDE THEMSELVES IF THEY WANT TO
		$this->fbc_email = fbc_getFacebookUserEmailHashes($this->fbc_uid);
		return ($this->fbc_is_facebook_user() && !$this->fbc_email) ? '' : $this->fbc_email;
	}

	function fbc_getFacebookBadge() {
		// RETURNS LITTLE FACEBOOK BADGE IMAGE
		return ($this->fbc_is_facebook_user()) ?
			'<img src="http://static.ak.fbcdn.net/images/icons/favicon.gif" />'
			: '&nbsp;';
	}

	function fbc_getProfilePic_xfbml($show_logo=false) {
		// RETURNS XFBML RENDERED PROFILE PICTURE
		return ($this->fbc_is_facebook_user()) ?
			('<fb:profile-pic uid="'.$this->fbc_uid.'" size="square" ' . ($show_logo ? ' facebook-logo="true"' : '') . '></fb:profile-pic>')
			: '<img src="http://static.ak.fbcdn.net/pics/q_default.gif" />';
	}

	function fbc_getStatus_xfbml() {
		// RETURNS USERS FACEBOOK STATUS RENDERED IN XFBML
		return ($this->fbc_is_facebook_user()) ?
			'<fb:user-status uid="'.$this->fbc_uid.'" ></fb:user-status>'
			: '';
	}

	function fbc_getStatus($return_array=FALSE) {
		// RETURNS EITHER LATEST STATUS OF ARRAY OF STATUS MESSAGES
		$fb_query = 'SELECT message FROM status WHERE uid=' . $this->fbc_uid . ' ';
		try {
			$fql_result = facebook_client()->api_client->fql_query($fb_query);
		} catch (Exception $e) {
			// PROBABLY AN EXPIRED SESSION
			return null;
		}
		if (!is_array($fql_result)) { return null; }
		if ($return_array) { return $fql_result; } else { return $fql_result[0][message]; }
	}


	function fbc_setStatus($status=null) {
		/* SETS USERS FACEBOOK STATUS
		 * USER MUST ALLOW STATUS_UPDATE EXTENDED PERMISSIONS BEFORE STATUS CAN BE SET
		*/
		try {
			$status_result = facebook_client()->api_client->call_method('facebook.users_setStatus',array('status' => $status, 'uid' => $this->fbc_uid));
		} catch (Exception $e) {
			// PROBABLY AN EXPIRED SESSION
			echo $e;
			return FALSE;
		}
		return TRUE;
	}

	function fbc_publishFeedStory() {
		// AUTOMATIC PUBLISHING OF FEED STORIES WILL ONLY WORK IF THE USER GRANTS YOUR APPLICATION OFFLINE ACCESS
		// STORY_SIZE OPTIONS ARE 1=ON LINE STORY, 2=SHORT STORY
		try 
		{
$message = 'Check out this cute pic.';
$attachment = array(
      'name' => 'i\'m bursting with joy',
      'href' => 'http://icanhascheezburger.com/2009/04/22/funny-pictures-bursting-with-joy/',
      'caption' => '{*actor*} rated the lolcat 5 stars',
      'description' => 'a funny looking cat',
      'properties' => array('category' => array(
                            'text' => 'humor',
                            'href' => 'http://www.icanhascheezburger.com/category/humor'),
                            'ratings' => '5 stars'),
      'media' => array(array('type' => 'image',
                             'src' => 'http://icanhascheezburger.files.wordpress.com/2009/03/funny-pictures-your-cat-is-bursting-with-joy1.jpg',
                             'href' => 'http://icanhascheezburger.com/2009/04/22/funny-pictures-bursting-with-joy/')),
      'latitude' => '41.4',     //Let's add some custom metadata in the form of key/value pairs
      'longitude' => '2.19');
$action_links = array(
                      array('text' => 'Recaption this',
                            'href' => 'http://mine.icanhascheezburger.com/default.aspx?tiid=1192742&recap=1#step2'));
$attachment = json_encode($attachment);
$action_links = json_encode($action_links);
$feed_result = facebook_client()->api_client->stream_publish($message, $attachment, $action_links);

		} catch (Exception $e) {
			// PROBABLY BECAUSE USER HAS NOT ACCEPTED OFFLINE PERMISSSIONS
			return $feed_result;
		}
		return $feed_result;
	}
	
	/*
	 * RESTORE THE ACCOUNT TO ITS ORIGINAL SELF, REMOVING ALL FACEBOOK INFO
	 */

	function fbc_disconnectFromFacebook() {
		$this->fbc_email = $this->fbc_getFacebookUserEmailHashes($this->fbc_uid);
		if ($this->fbc_email) {
			try {
				facebook_unregisterUsers($this->fbc_email);
			} catch (Exception $e) {
				// PROBABLY AN EXPIRED SESSION
				return null;
			}
		} else {
			return FALSE;
		}
		$this->fbc_uid = 0;
		return TRUE;
	}

	function fbc_register_user($email) {
		// REGISTER USER WITH FACEBOOK, REQUIRES EMAIL ADDRESS
		$email_hash = email_get_public_hash();
		$accounts = array(array('email_hash' => $email_hash, 'account_id' => $this->fbc_uid));
		return facebook_registerUsers($accounts);
	}

	function fbc_is_session_active() {
		// VERIFIES IF FACEBOOK SESSION IS ACTIVE
		$query = 'SELECT uid FROM user WHERE uid =' . $this->fbc_uid . ' ';
		try {
			$fql_result = facebook_client()->api_client->fql_query($query);
		} catch (Exception $e) {
			// PROBABLY AN EXPIRED SESSION
			return FALSE;
		}
		return TRUE;
	}
	
	function fbc_getExtendedPermission($ext_perm='offline_access') {
		/* GETS EXTENDED PERMISSION SETTING FOR A PARTICULAR USER FOR THIS APPLICATION
		 * RETURNS 1 FOR ENABLED, 2 FOR DISABLED
		 * EXTENDED PERMISSIONS OPTIONS ARE ONE OF THE FOLLOWING email, offline_access, status_update, photo_upload, create_listing, create_event, rsvp_event, sms
		*/
		try {
			$permission = facebook_client()->api_client->call_method('facebook.users_hasAppPermission',array('ext_perm' => $ext_perm,'uid' => $this->fbc_uid));
		} catch (Exception $e) {
			// PROBABLY AN EXPIRED SESSION
			return FALSE;
		}
		return $permission;
	}

	function fbc_get_friend_name($friendid, $row_start=0, $num_rows=10) {
		// RETURNS ALL FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
		$fql_query = 'SELECT uid, first_name, last_name FROM user WHERE uid ='.$friendid;
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		return $fql_result;
	}

	function fbc_get_all_friends($all_rows=TRUE, $row_start=0, $num_rows=10) {
		// RETURNS ALL FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
		$fql_query = 'SELECT uid, first_name, last_name, pic_small FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=' . $this->fbc_uid . ') ';
		if (!$all_rows) {
			$fql_query .= 'LIMIT ' . $row_start . ', ' . $num_rows;
		}
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		return $fql_result;
	}
	
	function fbc_get_connected_friends_sb($all_rows=TRUE, $row_start=0, $num_rows=10) {
		// RETURNS ALL CONNECTED FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
		$fql_query = 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=' . $this->fbc_uid . ') AND has_added_app=1 ';
		if (!$all_rows) {
			$fql_query .= 'LIMIT ' . $row_start . ', ' . $num_rows;
		}
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		$results = array();
		foreach($fql_result as $fq)
		{
			$results[]=$fq['uid'];
		}
		return $results;
	}
	function fbc_get_all_friends_xfbml($all_rows=TRUE, $row_start=0, $num_rows=10) {
		// RETURNS ALL FRIENDS ASSOCIATED WITH FBUID FOR USE WITH XFBML RENDER
		$fql_query = 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=' . $this->fbc_uid . ') ';
		if (!$all_rows) {
			$fql_query .= 'LIMIT ' . $row_start . ', ' . $num_rows;
		}
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		return $fql_result;
	}
	
	function fbc_get_connected_friends($all_rows=TRUE, $row_start=0, $num_rows=10) {
		// RETURNS ALL CONNECTED FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
		$fql_query = 'SELECT uid, first_name, last_name, pic_small FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=' . $this->fbc_uid . ') AND has_added_app=1 ';
		if (!$all_rows) {
			$fql_query .= 'LIMIT ' . $row_start . ', ' . $num_rows;
		}
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		return $fql_result;
	}
	
	function fbc_get_connected_friends_xfbml($all_rows=TRUE, $row_start=0, $num_rows=10) {
		// RETURNS ALL CONNECTED FRIENDS ASSOCIATED WITH FBUID FOR USE WITH XFBML RENDER
		$fql_query = 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=' . $this->fbc_uid . ') AND has_added_app=1 ';
		if (!$all_rows) {
			$fql_query .= 'LIMIT ' . $row_start . ', ' . $num_rows;
		}
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		return $fql_result;
	}
	
	function fbc_get_unconnected_friends($all_rows=TRUE, $row_start=0, $num_rows=10) {
		// RETURNS ALL UNCONNECTED FRIENDS ASSOCIATED WITH FBUID, GRABS UID, FIRST NAME, LAST NAME, AND SMALL PROFILE PICTURE
		$fql_query = 'SELECT uid, first_name, last_name, pic_small FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=' . $this->fbc_uid . ') AND has_added_app=0 ';
		if (!$all_rows) {
			$fql_query .= 'LIMIT ' . $row_start . ', ' . $num_rows;
		}
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		return $fql_result;
	}
	
	function fbc_get_unconnected_friends_xfbml($all_rows=TRUE, $row_start=0, $num_rows=10) {
		// RETURNS ALL UNCONNECTED FRIENDS ASSOCIATED WITH FBUID FOR USE WITH XFBML RENDER
		$fql_query = 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=' . $this->fbc_uid . ') AND has_added_app=0 ';
		if (!$all_rows) {
			$fql_query .= 'LIMIT ' . $row_start . ', ' . $num_rows;
		}
		try {
			$fql_result = facebook_client()->api_client->fql_query($fql_query);
		} catch (Exception $e) {
			// probably an expired session
			return null;
		}
		return $fql_result;
	}
}