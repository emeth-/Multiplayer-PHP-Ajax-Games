<?php
///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

/**
 * ajax im
 *
 * @author  Joshua Gross, unwieldy studios
 * @version 3.4
 * @copyright 2006 - 2008
 * @package ajax_im
 **/

require('config.php');

// begin code                        //
// note: do not edit below unless    //
//       you know what you're doing! //

// JSON Class //
include('json.php');

// connect to database //
$link = mysql_connect($sql_host, $sql_user, $sql_pass);
mysql_select_db($sql_db);
mysql_query('SET NAMES \'utf8\'');

// Turn off magic_quotes_runtime //
set_magic_quotes_runtime(0);

// Strip slashes from GET/POST/COOKIE (if magic_quotes_gpc is enabled) //
if ( get_magic_quotes_gpc() ) {
	function stripslashes_array($array) {
		return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);
	}

	$_GET = stripslashes_array($_GET);
	$_POST = stripslashes_array($_POST);
	$_COOKIE = stripslashes_array($_COOKIE);
}

session_start();

/**
 * ajax im, main execution class.
 *
 * @package ajax_im
 * @author Joshua Gross / unwieldy studios
 **/
class Ajax_IM {
   /**
    * Constructor.
    *
    * @return void
    * @author Joshua Gross
    **/
   function Ajax_IM($call) {
      $this->json = new JSON_obj();

      $this->username = $_SESSION['username'];
      $this->password = $_SESSION['password'];
      
      // run the garbage collector (chance run)
      $this->gc();
   
      // figure out which action we need to execute,
      // then execute it and print the output
      switch($call) {
         case 'login':
            print $this->login(strtolower($_POST['username']), $_POST['password']);
         break;
         
         case 'logout':
            print $this->logout();
         break;
         
         case 'ping':
            print $this->ping($_POST['away']);
         break;
         
         case 'send':
            print $this->send($_POST['recipient'], $_POST['message'], $_POST['font'], $_POST['fontsize'], $_POST['fontcolor'], $_POST['bold'], $_POST['italic'], $_POST['underline'], $_POST['chatroom']);
         break;
         
         case 'addbuddy':
            print $this->addBuddy(strtolower($_POST['username']), $_POST['group']);
         break;
         
         case 'removebuddy':
            print $this->removeBuddy($_POST['username']);
         break;
         
         case 'blockbuddy':
            print $this->blockBuddy($_POST['username'], ($_POST['status']?$_POST['status']:0));
         break;
         
         case 'removegroup':
            print $this->removeGroup($_POST['group']);
         break;
         
         case 'register':
            print $this->register($_POST['username'], $_POST['password'], $_POST['email']);
         break;
         
         case 'isuser':
            print $this->isUser(strtolower($_POST['username']));
         break;
         
         case 'reset':
            print $this->reset($_POST['email']);
         break;
         
         case 'pwdchange':
            print $this->passwordChange($_POST['password'], $_POST['newpwd']);
         break;
         
         case 'joinroom':
            print $this->joinRoom($_POST['room']);
         break;
         
         case 'leaveroom':
            print $this->leaveRoom($_POST['room']);
         break;

         case 'roomlist':
            print $this->roomList();
         break;

         case 'changeicon':
            print $this->changeIcon();
         break;

         case 'changeprofile':
            print $this->changeProfile($_POST['profile']);
         break;

         case 'getprofile':
            print $this->getProfile($_POST['user']);
         break;
      }
   }
   
   /**
    * Logs the user in and sets the session for the user.
    *
    * @return JSON object of buddies/blocked users if it usr was successfully logged in, error string otherwise
    * @author Joshua Gross
    **/
   function login($username, $password) {
      $user = $this->checkInfo($username, $password, array('admin', 'banned'));
      if(!$user) return 'invalid';
      if($user['banned'] == 1) return 'banned';

      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      $_SESSION['admin']    = $user['admin'];

      $set_status = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET is_online=1, last_ip=\'' . $_SERVER['REMOTE_ADDR'] . '\' WHERE username=\'' . $username . '\'');

      $buddylist = $this->getBuddylist($username, false);
      $blocklist = $this->getBlocklist($username);
               
      $this->userEvent($username, $buddylist, 'status', array('status'=>1));         

      $buddylist = $this->getBuddylistOnline($username);
      if(count($buddylist) > 0)
         $output['buddy'] = $this->json->encode($buddylist);
      else
         $output['buddy'] = array();

      $output['blocked'] = $this->json->encode($blocklist);
      
      $output['admin'] = $user['admin'];
      
      return $this->json->encode($output);
   }
   
   /**
    * Logs the user out and destroys the session.
    *
    * @return String 'logged_out'
    * @author Joshua Gross
    **/
   function logout() {
      if(!$this->checkInfo($this->username, $this->password)) return 'invalid';

      $buddylist = $this->getBuddylist($this->username, false);
      
      $set_status = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET is_online=0, last_ping=\'' . time() . '\' WHERE username=\'' . mysql_real_escape_string($this->username) . '\'');
      
      $in_chatrooms = mysql_query('SELECT room FROM ' . SQL_PREFIX . 'chats WHERE user=\'' . mysql_real_escape_string($this->username) . '\'');
      while($row = mysql_fetch_assoc($in_chatrooms)) {
         $buddylist['users'] = $this->getChatlist($row['room']);
         $this->userEvent($this->username, $buddylist, 'chat', array('action'=>'left', 'room'=>$row['room']));
      }
      
      $exit_rooms = mysql_query('DELETE FROM ' . SQL_PREFIX . 'chats WHERE user=\'' . mysql_real_escape_string($this->username) . '\'');
      
      $notify_buddies = $this->userEvent($this->username, $buddylist, 'status', array('status'=>0));
      
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
      session_destroy();
      
      return 'logged_out';
   }
   
   /**
    * Checks the database for new messages and events.
    *
    * @return JSON object of new messages/events if any, otherwise nothing
    * @author Joshua Gross
    **/
   function ping($away) {
      $user = $this->checkInfo($this->username, $this->password, array('is_online', 'last_ping'));
      if(!$user) {
         $set_status = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET is_online=0, last_ping=\'' . time() . '\' WHERE username=\'' . mysql_real_escape_string($this->username) . '\'');
         return 'not_logged_in';
      }

      $buddylist = $this->getBuddylist($this->username, false);

      $set_status = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET is_online=\'' . mysql_real_escape_string($away + 1) . '\', last_ping=\'' . time() . '\' WHERE username=\'' . mysql_real_escape_string($this->username) . '\'');
      if($user['is_online'] != ($away + 1)) $this->userEvent($this->username, $buddylist, 'status', array('status'=>($away + 1)));
      
      foreach($buddylist as $group => $users) {
         $user_count = count($users);   
         
         $reverse_list = array();
         for($i = 0; $i < $user_count; $i++)
            $reverse_list[$users[$i]] = $group;
      }
      
      $query = mysql_query('SELECT id, message, type, sender, recipient FROM ' . SQL_PREFIX . 'messages WHERE (recipient=\'' . mysql_real_escape_string($this->username) . '\') GROUP BY sender, message, recipient ORDER BY id ASC');

      $i=0; $j=0;
      $to_delete = array();
      $output = array();
      while ($row = mysql_fetch_assoc($query)) {
         if(strpos($row['type'], 'msg') !== false) {
            if($row['sender'] != $this->username || $row['sender'] == $row['recipient']) {
               $output['messages'][$i++] = array('message'   => $row['message'],
                                                 'sender'    => $row['sender'],
                                                 'recipient' => $row['recipient'],
                                                 'chatroom'  => ($row['type'] == 'chatmsg' ? 1 : 0));
               
               $to_delete[] = $row['id'];
            }
         } else if($row['type'] == 'event') {
            $output['events'][$j++] = array('event'     => $row['message'],
                                            'sender'    => $row['sender'],
                                            'recipient' => $row['recipient']);
                                            
            $event = explode(',', $row['message']);
            if($event[0] == 'status') $output['events'][$j-1]['group'] = $reverse_list[$row['sender']];
            
            $to_delete[] = $row['id'];
         } else if($row['type'] == 'server') {
            switch($row['message']) {
               case 'kick':
                  $this->logout();
                  print 'not_logged_in';
               break;
            }
            
            $to_delete[] = $row['id'];
         }
      }

      if(count($to_delete) > 0)
         $delete_new = mysql_query('DELETE FROM ' . SQL_PREFIX . 'messages WHERE id IN(' . implode(',', $to_delete) . ')');         

      return $this->json->encode($output);
   }
   
   /**
    * Sends a message to another user.
    *
    * @return String 'sent' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function send($to, $message, $font, $font_size, $font_color, $bold, $italic, $underline, $is_chat) {
      $to = mysql_real_escape_string($to);
      
      if(!$this->checkInfo($this->username, $this->password)) {
         $set_status = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET is_online=0, last_ping=\'' . time() . '\' WHERE username=\'' . mysql_real_escape_string($this->username) . '\'');
         return 'not_logged_in';
      }
      
      $is_online = $this->isOnline($to);
      if($is_online > 0 || $is_chat == 'true') {
         if($is_online == 100) {
            $check_friendship = mysql_query('SELECT is_online FROM ' . SQL_PREFIX . 'users WHERE username IN(SELECT user FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . strtolower($to) . '\' AND buddy=\'' . mysql_real_escape_string($this->username) . '\')');
            if(mysql_num_rows($check_friendship) == 0)
               return 'not_online';
         }

         $check_blocked = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'blocklists WHERE user=\'' . strtolower($to) . '\' AND buddy=\'' . mysql_real_escape_string($this->username) . '\'');
         if(mysql_num_rows($check_blocked) > 0)
            return 'not_online';

         $check_blocked = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'blocklists WHERE buddy=\'' . strtolower($to) . '\' AND user=\'' . mysql_real_escape_string($this->username) . '\'');
         if(mysql_num_rows($check_blocked) > 0)
            return 'not_online';

         if(strlen(trim($message)) > 0 && strlen($message) <= 1500) {
            $message = ('<span style="font-family:' . mysql_real_escape_string($font) . ',sans-serif;font-size:' . mysql_real_escape_string($font_size > 24 ? 24 : $font_size) . 'px;color:' . mysql_real_escape_string($font_color) . ';">') .
                       ($bold == 'true' ? '<b>' : '') . ($italic == 'true' ? '<i>' : '') . ($underline == 'true' ? '<u>' : '') .
                       $message .
                       ($bold == 'true' ? '</b>' : '') . ($italic == 'true' ? '</i>' : '') . ($underline == 'true' ? '</u>' : '') .
                       ('</span>');
                       
            if($is_chat == 'true') {
               $where_to_send = $this->getChatlist($to);
               
               $to_insert = '';
               foreach($where_to_send as $username)
                  if($username != $this->username) $to_insert .= "('" . mysql_real_escape_string($message) . "', 'chatmsg', '" . $to . '.' . mysql_real_escape_string($this->username) . "', '" . strtolower($username) . "', " . time() . "),";
                  
               $to_insert = substr($to_insert, 0, strlen($to_insert) - 1);
            } else {
               $to_insert = "('" . mysql_real_escape_string($message) . "', 'msg', '" . mysql_real_escape_string($this->username) . "', '" . strtolower($to) . "', " . time() . ")";
            }
            
            $query = mysql_query('INSERT INTO ' . SQL_PREFIX . 'messages (message, type, sender, recipient, stamp) VALUES ' . $to_insert);
         } else {
            if(strlen($message) > 1500)
               return 'too_long';
         }
         
         return 'sent';
      } else {
         return 'not_online';
      }
   }
   
   /**
    * Adds the buddy to the user's buddylist, if possible.
    *
    * @return String 'added' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function addBuddy($username, $group) {
      if(!$this->checkInfo($this->username, $this->password)) return 'not_added';
      
      $query = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND buddy=\'' . mysql_real_escape_string($username) . '\' LIMIT 1');
      
      if(mysql_num_rows($query) == 0) {
         $add_buddy = mysql_query('INSERT INTO ' . SQL_PREFIX . 'buddylists (user, buddy, `group`) VALUES(\'' . mysql_real_escape_string($this->username) . '\', \'' . mysql_real_escape_string($username) . '\', \'' . mysql_real_escape_string($group) . '\')');
         return 'added';
      } else {
         return 'already_on_buddylist';
      }
   }
   
   /**
    * Removes the buddy from the user's buddylist, if possible.
    *
    * @return String 'removed' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function removeBuddy($username) {
      if(!$this->checkInfo($this->username, $this->password)) return 'not_removed';
      
      $query = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND buddy=\'' . mysql_real_escape_string($username) . '\' LIMIT 1');
      
      if(mysql_num_rows($query) > 0) {
         $remove_buddy = mysql_query('DELETE FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND buddy=\'' . mysql_real_escape_string($username) . '\'');
         return 'removed';
      } else {
         return 'no_user_on_buddylist';
      }  
   }
   
   /**
    * Blocks the user from being able to contact the user if blocked. Unblocks the user if blocked.
    *
    * @return String 'blocked' if not blocked, 'unblocked' if blocked, 'not_blocked' on error
    * @author Joshua Gross
    **/
   function blockBuddy($username, $status) {
      if(!$this->checkInfo($this->username, $this->password)) return 'not_blocked';
      
      $query = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'blocklists WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND buddy=\'' . mysql_real_escape_string($username) . '\' LIMIT 1');
      
      if(mysql_num_rows($query) == 0) {
         $block_buddy = mysql_query('INSERT INTO ' . SQL_PREFIX . 'blocklists (user, buddy) VALUES(\'' . mysql_real_escape_string($this->username) . '\', \'' . mysql_real_escape_string($username) . '\')');
         
         $this->userEvent($this->username, array('block'=>array(mysql_real_escape_string($username))), 'status', array('status'=>0));
         return 'blocked';
      } else {
         $unblock_buddy = mysql_query('DELETE FROM ' . SQL_PREFIX . 'blocklists WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND buddy=\'' . mysql_real_escape_string($username) . '\' LIMIT 1');
         
         $this->userEvent($this->username, array('block'=>array(mysql_real_escape_string($username))), 'status', array('status'=>mysql_real_escape_string($status)));
         return 'unblocked';
      }
   }
   
   /**
    * Removes the group (and all buddies of group) from a user's buddylist.
    *
    * @return String 'removed' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function removeGroup($group) {
      if(!$this->checkInfo($this->username, $this->password)) return 'not_removed';
      
      $query = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND `group`=\'' . mysql_real_escape_string($group) . '\' LIMIT 1');
      if(mysql_num_rows($query) > 0) {
         $remove_buddy = mysql_query('DELETE FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND `group`=\'' . mysql_real_escape_string($group) . '\'');
         return 'removed';
      } else {
         return 'no_group_on_buddylist';
      }  
   }
   
   /**
    * Registers a user.
    *
    * @return String 'registered' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function register($username, $password, $email) {
      $username = strtolower($username);
   
      if(preg_match('/^[a-z0-9_\\d]+$/', $username) !== false && strlen($username) >= 3 && strlen($username) <= 16) {
         if(preg_match('/^([a-zA-Z0-9_\\.\\-])+\\@(([a-zA-Z0-9\\-])+\\.)+([a-zA-Z0-9]{2,4})+$/', $email) !== false) {
            if(strlen($password) >= 6 && strlen($password) <= 20) {
               if(mysql_num_rows(mysql_query('SELECT email FROM ' . SQL_PREFIX . 'users WHERE email=\'' . mysql_real_escape_string($email) . '\'')) == 0) {
                  $query = mysql_query('SELECT username FROM ' . SQL_PREFIX . 'users WHERE username=\'' . mysql_real_escape_string($username) . '\'');
                  if(mysql_num_rows($query) == 0) {
                     $query = mysql_query('INSERT INTO ' . SQL_PREFIX . 'users (username, password, email) VALUES (\'' . mysql_real_escape_string($username) . '\', \'' . md5($password) . '\', \'' . mysql_real_escape_string($email) . '\')');
                     print 'user_registered';
                  } else {
                     print 'username_taken';
                  }
               } else {
                  print 'email_already_used';
               }
            } else {
               print 'password_bad_length';
            }
         } else {
            print 'invalid_email';
         }
      } else {
         print 'username_bad';
      }
   }
   
   /**
    * Check if a certain user exists (only works when authenticated).
    *
    * @return String 'exists' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function isUser($username) {
      if(!$this->checkInfo($this->username, $this->password)) return 'not_logged_in';

      $query = mysql_query('SELECT is_online FROM ' . SQL_PREFIX . 'users WHERE username=\'' . mysql_real_escape_string($username) . '\'');
      
      if(mysql_num_rows($query) > 0) {
         $userinfo = mysql_fetch_assoc($query);
         
         if($userinfo['is_online'] == 100) {
            $check_friendship = mysql_query('SELECT is_online FROM ' . SQL_PREFIX . 'users WHERE username IN(SELECT user FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . mysql_real_escape_string($username) . '\' AND buddy=\'' . mysql_real_escape_string($this->username) . '\')');
           
            if(mysql_num_rows($check_friendship) == 0) return '0';
            else return $userinfo['is_online'];
         } else {
            return $userinfo['is_online'];
         }
      } else {
         return 'not_exists';
      }
   }
   
   /**
    * Resets a user's password based on their email address.
    *
    * @return String 'reset' if successful, 'no_email_on_record' otherwise
    * @author Joshua Gross
    **/
   function reset($email) {
      $email = urldecode($email);
      
      $query = mysql_query('SELECT email FROM ' . SQL_PREFIX . 'users WHERE email=\'' . mysql_real_escape_string($email) . '\'');
      if(mysql_num_rows($query) > 0) {
         $new_pass = $this->generatePassword();
         $query = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET password=\'' . md5($new_pass) . '\' WHERE email=\'' . mysql_real_escape_string($email) . '\'');
         mail($email, 'Your Reset Password', "You requested that your password be reset, your new password is below.\n\nNew Password: $new_pass", 'From: Reset Password <reset_password@'.$_SERVER['HTTP_HOST'].'>');
         return 'pw_reset';
      } else {
         return 'no_email_on_record';
      }   
   }
   
   /**
    * Changes the user's password.
    *
    * @return String 'changed' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function passwordChange($password, $new_password) {
      if(!$this->checkInfo($this->username, $password)) return 'invalid_pw';

      if(strlen($new_password) >= 6 && strlen($new_password) <= 20) {
         $query = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET password=\'' . md5($new_password) . '\' WHERE username=\'' . mysql_real_escape_string($this->username) . '\'');
         return 'pw_changed';
      } else {
         return 'password_bad_length';
      }
   }
   
   /**
    * Adds a user to a chatroom.
    *
    * @return String 'joined' if successful, error string otherwise
    * @author Joshua Gross
    **/
   function joinRoom($room) {
      $room = mysql_real_escape_string(strtolower($room));
      
      $query = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'chats WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND room=\'' . $room . '\'');
      
      if(mysql_num_rows($query) > 0) {
         return 'already_joined';
      } else {
         if(preg_match('/^[^a-z0-9_\d]+$/', $room) == false) {
            $query = mysql_query('INSERT INTO ' . SQL_PREFIX . 'chats (room, user) VALUES (\'' . $room . '\', \'' . mysql_real_escape_string($this->username) . '\')');
            
            $output['users'] = $this->getChatlist($room);
            $notify_buddies = $this->userEvent($this->username, $output, 'chat', array('action'=>'join', 'room'=>$room));
            
            return $this->json->encode($output);
         } else {
            return 'invalid_chars';
         }
      }
   }
   
   /**
    * Removes a user from a chatroom.
    *
    * @return String 'left' if successful, 'not_left' otherwise
    * @author Joshua Gross
    **/
   function leaveRoom($room) {
      $room = mysql_real_escape_string(strtolower($room));
      
      $query = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'chats WHERE user=\'' . mysql_real_escape_string($this->username) . '\' AND room=\'' . $room . '\'') ;

      if(mysql_num_rows($query) > 0) { 
         $row = mysql_fetch_assoc($query);
         $query = mysql_query('DELETE FROM ' . SQL_PREFIX . 'chats WHERE id=\'' . $row['id'] . '\'');
         
         $output['users'] = $this->getChatlist($room);
         $notify_buddies = $this->userEvent($this->username, $output, 'chat', array('action'=>'left', 'room'=>$room));
         
         return 'left';
      } else {
         return 'not_left';
      }
   }
   
   /**
    * Retrieves a list of room names and returns them to the user as a JSON object.
    *
    * @return JSON object
    * @author Joshua Gross
    **/
   function roomList() {
      $rooms_query = mysql_query('SELECT room FROM ' . SQL_PREFIX . 'chats GROUP BY room ORDER BY room ASC');
      
      $rooms = array();
      while($row = mysql_fetch_assoc($rooms_query))
         $rooms[] = $row['room'];
         
      return $this->json->encode($rooms);
   }

   /**
    * Proccesses the upload of the new Buddy Icon for the user.
    *
    * @return JSON object
    * @author Benjamin Hutchins
    **/
   function changeIcon() {
      global $maxBuddyIconSize;

      if (!isset($maxBuddyIconSize) || $maxBuddyIconSize == 0) {
         return "unkown";
      }

      /*
      @ini_set('file_uploads', 'On');
      @ini_set('upload_max_filesize', $maxBuddyIconSize.'M');
      @ini_set('post_max_size', $maxBuddyIconSize.'M');
      */

      $allowed_types = array("image/x-ms-bmp", "image/x-icon", "image/jpeg", "image/x-png", "image/gif", "image/png", "image/tiff");
      $allowed_files = array('jpeg', 'jpg', 'jpe', 'bmp', 'png', 'gif', 'ico', "tif", "tiff");

      if (empty($_FILES['icon']['tmp_name'])) {
         return "nofile";
      }
      if ($_FILES['icon']['size'] > $maxBuddyIconSize*1024) {
         return "size";
      }
      if (!in_array($_FILES['icon']['type'], $allowed_types)) {
         return "bad_type";
      }
      $filename = $_FILES['icon']['name'];
      $extension = strtolower(end(explode(".", $filename)));
      if (!in_array($extension, $allowed_files)) {
         return "bad_extension";
      }
      if (move_uploaded_file($_FILES['icon']['tmp_name'], "./buddyicons/".$this->username.".".$extension)) {
         if (mysql_query('UPDATE ' . SQL_PREFIX . 'users SET buddyicon=\'' . mysql_real_escape_string($extension) . '\' WHERE username=\'' . mysql_real_escape_string($this->username) . '\'')) {
            return "success";
         } else {
            return "unkown";
         }
      } else {
         return "unkown";
      }
   }

   /**
    * Updates a user's profile.
    *
    * @return success value
    * @author Benjamin Hutchins
    **/
   function changeProfile($profile) {
      if (mysql_query('UPDATE ' . SQL_PREFIX . 'users SET profile=\'' . mysql_real_escape_string(strip_tags($profile)) . '\' WHERE username=\'' . mysql_real_escape_string($this->username) . '\'')) {
         return 'success';
      } else {
         return 'failed';
      }
   }

   /**
    * Returns a user's profile.
    *
    * @return HTML content
    * @author Benjamin Hutchins
    **/
   function getProfile($username) {
      $query = mysql_query('SELECT profile FROM ' . SQL_PREFIX . 'users WHERE username=\'' . mysql_real_escape_string($username) . '\'');

      $result = mysql_fetch_assoc($query);     
      return $result['profile'];
   }
   
   /* Begin private functions */
   
   /**
    * Return a user's status.
    *
    * @return Integer representing user's status
    * @author Joshua Gross
    **/
   function isOnline($username) {
      $query = mysql_query('SELECT is_online FROM ' . SQL_PREFIX . 'users WHERE username=\'' . mysql_real_escape_string($username) . '\'');
      
      $result = mysql_fetch_assoc($query);
      return $result['is_online'];
   }
   
   /**
    * Check to see if the supplied user information is valid, and if so return specific information.
    *
    * @return false if information is invalid, array of data otherwise
    * @author Joshua Gross
    **/
   function checkInfo($username, $password, $return=array()) {
      if(count($return) > 0)
         $columns = implode(',', $return);
      else
         $columns = 'id';
      
      $username = mysql_real_escape_string($username);
      $password = mysql_real_escape_string($password);
      
      $query = mysql_query('SELECT ' . $columns . ' FROM ' . SQL_PREFIX . 'users WHERE username=\'' . $username . '\' AND password=\'' . $password . '\' LIMIT 1');
      
      if(mysql_num_rows($query) > 0)
         return mysql_fetch_assoc($query);
      else
         return false;
   }

   /**
    * Retrieves a list of users in a specific chatroom.
    *
    * @return Array of users
    * @author Joshua Gross
    **/
   function getChatlist($room) {
      $query = mysql_query('SELECT DISTINCT user FROM ' . SQL_PREFIX . 'chats WHERE room=\'' . mysql_real_escape_string(strtolower($room)) . '\'');
      
      while ($row = mysql_fetch_assoc($query))
         $userlist[]=$row['user'];
      return $userlist;
   }

   /**
    * Retrieves a list of all of the user's buddies.
    *
    * @return Array of buddies by group
    * @author Joshua Gross
    * @update Benjamin Hutchins - returns none-blocked buddies if $inc_blocked = false
    **/
   function getBuddylist($username, $inc_blocked=true) {
      $username = mysql_real_escape_string($username);

      $query = mysql_query('SELECT ' . SQL_PREFIX . 'buddylists.buddy AS buddy, `group` FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . $username . '\' AND ' . SQL_PREFIX . 'buddylists.buddy NOT IN(SELECT user FROM ' . SQL_PREFIX . 'blocklists WHERE buddy=\'' . $username . '\')' . ($inc_blocked ? "" : ' AND ' . SQL_PREFIX . 'buddylists.buddy NOT IN(SELECT buddy FROM ' . SQL_PREFIX . 'blocklists WHERE user=\'' . $username . '\')'));
   
      $buddylist = array();
      while($row = mysql_fetch_assoc($query))
         $buddylist[$row['group']][] = $row['buddy'];
      
      return $buddylist;
   }

   /**
    * Retrieves a list of the user's buddies that are online (with any status).
    *
    * @return Array of buddies by group with status information
    * @author Joshua Gross
    * @update Benjamin Hutchins - only returns buddies that did not block user.
    **/
   function getBuddylistOnline($username) {
      $username = mysql_real_escape_string($username);
   
      //$query = mysql_query('SELECT ' . SQL_PREFIX . 'buddylists.buddy, `group`, buddyicon, is_online FROM ' . SQL_PREFIX . 'buddylists LEFT JOIN ' . SQL_PREFIX . 'users ON ' . SQL_PREFIX . 'buddylists.buddy = ' . SQL_PREFIX . 'users.username WHERE ' . SQL_PREFIX . 'buddylists.user=\'' . $username . '\' AND ' . SQL_PREFIX . 'buddylists.buddy NOT IN(SELECT user FROM ' . SQL_PREFIX . 'blocklists WHERE buddy=\'' . $username . '\')');
      $query = mysql_query('SELECT ' . SQL_PREFIX . 'buddylists.buddy, `group`, buddyicon, is_online, ' . SQL_PREFIX . 'buddylists.buddy IN(SELECT user FROM ' . SQL_PREFIX . 'blocklists WHERE buddy=\'' . $username . '\') AS blocked FROM ' . SQL_PREFIX . 'buddylists LEFT JOIN ' . SQL_PREFIX . 'users ON ' . SQL_PREFIX . 'buddylists.buddy = ' . SQL_PREFIX . 'users.username WHERE ' . SQL_PREFIX . 'buddylists.user=\'' . $username . '\'');
   
      $buddylist = array();
      while($row = mysql_fetch_assoc($query)) {
         $buddylist[$row['group']][] = array('username'=>$row['buddy'], 'icon'=>$row['buddyicon'], 'is_online'=>($row['blocked'] ? 0 : $row['is_online']));
      }
      return $buddylist;
   }
   
   /**
    * Retrieves the list of blocked buddies from the database.
    *
    * @return Array of buddies
    * @author Joshua Gross
    **/
   function getBlocklist($username) {
      $username = mysql_real_escape_string($username);
   
      $query = mysql_query('SELECT buddy FROM ' . SQL_PREFIX . 'blocklists WHERE user=\'' . $username . '\'');
   
      $blocklist = array();
      while($row = mysql_fetch_assoc($query))
         $blocklist[] = $row['buddy'];
      
      return $blocklist;
   }
      
   /**
    * Event handler for status or chat status updates.
    *
    * @return void
    * @author Joshua Gross
    **/
   function userEvent($username, $buddylist, $event, $args) {      
      $username = mysql_real_escape_string($username);
   
      switch($event) {
         case 'chat':
            $users = $buddylist['users'];
            $users_str = @implode("','", $users);
            
            $query = mysql_query('SELECT username, is_online FROM ' . SQL_PREFIX . 'users WHERE username IN(\'' . $users_str . '\') AND is_online > 0 ORDER BY username ASC');
   
            while ($row = mysql_fetch_assoc($query))
               if(strlen($to_insert[$row['username']]) == 0) $to_insert[$row['username']] = mysql_real_escape_string($event . ',' . $args['action'] . ',' . $args['room']);
         break;
         
         case 'status':
            if($args['status'] == 100) {
               $args['status'] = 0;                 // we're going to do this backwards
                                                    // instead of broadcasting a positive message to our buddies
                                                    // we will send a negative (offline) message to all our non-buddies
                                                    // who have us on their buddylist
               $query_string = 'username IN(SELECT user FROM ' . SQL_PREFIX . 'buddylists WHERE buddy=\'' . $username . '\') AND ' .
                               'username NOT IN(\''; 
            } else {
               $query_string = '(username IN(SELECT user FROM ' . SQL_PREFIX . 'buddylists WHERE buddy=\'' . $username . '\') AND username NOT IN(SELECT buddy FROM ' . SQL_PREFIX . 'blocklists WHERE user=\'' . $username . '\')) OR ' .
                               'username IN(\'';
            }
            
            if(count($buddylist) == 0) $buddylist[''] = array('');
            
            foreach($buddylist as $group => $users) {
               $users_str = implode("','", $users);
               
               $query = mysql_query('SELECT username, is_online FROM ' . SQL_PREFIX . 'users WHERE (' . $query_string . $users_str . '\')) GROUP BY username');
   
               while($row = mysql_fetch_assoc($query)) {
                  if(in_array($row['username'], $users) !== false) {
                     if($row['is_online'] == 100) {
                        $friend_query = mysql_query('SELECT id FROM ' . SQL_PREFIX . 'buddylists WHERE user=\'' . $row['username'] . '\' AND buddy=\'' . $username . '\' LIMIT 1');
                        if(mysql_num_rows($friend_query) == 0) $row['is_online'] = 0;
                     }   
                  }
                  
                  if($row['is_online'] != 0 && strlen($to_insert[$row['username']]) == 0) $to_insert[$row['username']] = mysql_real_escape_string($event . ',' . $args['status']);
               }
            }
         break;
      }
            
      if(count($to_insert) > 0) {
         $time_cur = time();
         foreach($to_insert as $user => $evt)
            $insert_str .= "('" . $evt . "', 'event', '" . $username . "', '" . mysql_real_escape_string($user) . "', " . $time_cur . "),";
         
         $insert_str = substr($insert_str, 0, strlen($insert_str) - 1);
         $query = @mysql_query('INSERT INTO ' . SQL_PREFIX . 'messages (message, type, sender, recipient, stamp) VALUES ' . $insert_str);
      }
   }
   
   /**
    * Generates a random string of the specified length (default = 10).
    *
    * @return String
    * @author Joshua Gross
    **/
   function generatePassword($length=10) {
      $randstr='';
      srand((double)microtime()*1000000);
   
      $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      while(strlen($randstr)<$length) {
         $randstr.=substr($chars,(rand()%(strlen($chars))),1);
      } 
      return $randstr;
   }

   /**
    * Garbage collector. Resets users who have been inactive for more than 5 minutes.
    *
    * @return void
    * @author Joshua Gross
    **/
   function gc() {
      // cleanup logged-in users in database? [30% chance]
      if(rand(1, 100) <= 30) {
         // yes, cleanup! //
         $expire_time = time() - 30; // idle for more than 30 seconds?
         
         $cleanup_event = mysql_query('SELECT username FROM ' . SQL_PREFIX . 'users WHERE last_ping < ' . $expire_time . ' AND is_online > 0');
         if(mysql_num_rows($cleanup_event) > 0) {
            while($row = mysql_fetch_assoc($cleanup_event))
               $notify_buddies = $this->userEvent($row['username'], $this->getBuddylist($row['username']), 'status', array('status'=>0));
         }
         
         $cleanup_event2 = mysql_query('SELECT user, room FROM ' . SQL_PREFIX . 'chats WHERE user IN(SELECT username FROM ' . SQL_PREFIX . 'users WHERE last_ping < ' . $expire_time . ' AND is_online > 0)');
         if(mysql_num_rows($cleanup_event2) > 0) {
            while($row = mysql_fetch_assoc($cleanup_event2)) {
               $room = mysql_query('SELECT user FROM ' . SQL_PREFIX . 'chats WHERE room=\'' . $row['room'] . '\'');
               
               if(mysql_num_rows($room) > 0) {
                  while($row2 = mysql_fetch_assoc($room))
                     $chatusers['users'][] = $row2['user'];
               }
               
               $notify_chatusers = $this->userEvent($row['user'], $chatusers, 'chat', array('action'=>'left', 'room'=>$row['room']));
            }
         }
        
         $cleanup_chats = mysql_query('DELETE FROM ' . SQL_PREFIX . 'chats WHERE user IN(SELECT username FROM ' . SQL_PREFIX . 'users WHERE last_ping < ' . $expire_time . ' AND is_online > 0)');
         $cleanup_msgs  = mysql_query('DELETE FROM ' . SQL_PREFIX . 'messages WHERE stamp < ' . (time() - 300));
         $cleanup = mysql_query('UPDATE ' . SQL_PREFIX . 'users SET is_online=0 WHERE last_ping < ' . $expire_time . ' AND is_online > 0');
      }
   }
}

$ajax_im = new Ajax_IM($_POST['call']);

mysql_close();
?>
