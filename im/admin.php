<?php
///////////////////////////////////
//         ajax im 3.41          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

/**
 * ajax im - admin panel script
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

session_start();

/**
 * ajax im, admin class.
 *
 * @package ajax_im
 * @author Joshua Gross / unwieldy studios
 **/
class Ajax_IM_Admin {
   /**
    * Constructor.
    *
    * @return void
    * @author Joshua Gross
    */
   function Ajax_IM_Admin($call) {
      if($_SESSION['admin'] == 0) print 'access_denied';
    
      $this->json = new JSON_obj();

      $this->username = $_SESSION['username'];
      $this->password = $_SESSION['password'];

      if($this->checkInfo($this->username, $this->password)) {
         switch($call) {
            case 'search':
               print $this->search(strtolower($_POST['by']), $_POST['for']);
            break;
            
            case 'kick':
               print $this->kickUser($_POST['user']);
            break;
            
            case 'ban':
               print $this->banUser($_POST['user']);
            break;
            
            case 'admin':
               print $this->adminUser($_POST['user']);
            break;
         }
      }
   }

   /**
    * Searches the user database by the method specified, for the keyword specified
    *
    * @return void
    * @author Joshua Gross
    **/
   function search($by, $for) {
      if($by != 'email' && $by != 'username') return '[]';
      
      $search_query = mysql_query('SELECT username, email, last_ip, last_ping, is_online, admin, banned FROM ' . SQL_PREFIX . 'users WHERE ' . $by . ' LIKE \'' . mysql_real_escape_string(str_replace('*', '%', $for)) . '\'');

      $found = array();
      while($row = mysql_fetch_assoc($search_query)) {
         $found[] = array('username'=>$row['username'], 'email'=>$row['email'], 'lastKnownIP'=>$row['last_ip'], 'lastActive'=>$row['last_ping'],
                          'currentStatus'=>$row['is_online'], 'banned'=>($row['banned']==1?'true':'false'), 'admin'=>($row['admin']==1?'true':'false'));
      }
      
      return $this->json->encode($found);
   }

   /**
    * Kick the user from the server (log him off)
    *
    * @return "kicked"
    * @author Joshua Gross
    **/
   function kickUser($user) {
      mysql_query('INSERT INTO ' . SQL_PREFIX . "messages (message, type, sender, recipient, stamp) VALUES ('kick', 'server', '{$this->username}', '" . mysql_real_escape_string($user) . "', '" . time() . "')");
      return 'kicked';
   }
   
   /**
    * Ban & kick the user from the server
    *
    * @return "true" if banned, "false" if unbanned, "no_such_user" if the user doesn't exist
    * @author Joshua Gross
    **/
   function banUser($user) {
      $ban_status = mysql_query('SELECT banned FROM ' . SQL_PREFIX . 'users WHERE username=\'' . mysql_real_escape_string($user) . '\'');
      if(mysql_num_rows($ban_status) == 0)
         return 'no_such_user';
         
      $is = mysql_fetch_assoc($ban_status);
      if($is['banned'] == 1) {
         mysql_query('UPDATE ' . SQL_PREFIX . 'users SET banned=0 WHERE username=\'' . mysql_real_escape_string($user) . '\'');
         return 'false';
      } else {
         $this->kickUser(mysql_real_escape_string($user));
         mysql_query('UPDATE ' . SQL_PREFIX . 'users SET banned=1 WHERE username=\'' . mysql_real_escape_string($user) . '\'');
         return 'true';
      }
   }
   
   /**
    * Toggle on/off the admin status of a user.
    *
    * @return "on" if now an admin, "off" if not, "no_such_user" if the user doesn't exist
    * @author Joshua Gross
    **/
   function adminUser($user) {
      $admin_status = mysql_query('SELECT admin FROM ' . SQL_PREFIX . 'users WHERE username=\'' . mysql_real_escape_string($user) . '\'');
      if(mysql_num_rows($admin_status) == 0)
         return 'no_such_user';
         
      $is = mysql_fetch_assoc($admin_status);
      if($is['admin'] == 1) {
         mysql_query('UPDATE ' . SQL_PREFIX . 'users SET admin=0 WHERE username=\'' . mysql_real_escape_string($user) . '\'');
         return 'false';
      } else {
         mysql_query('UPDATE ' . SQL_PREFIX . 'users SET admin=1 WHERE username=\'' . mysql_real_escape_string($user) . '\'');
         return 'true';
      }
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
}

$admin = new Ajax_IM_Admin($_POST['call']);
?>
You don't want to be here...(this is not the admin panel!)