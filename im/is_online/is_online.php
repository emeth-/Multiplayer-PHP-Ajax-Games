<?php
///////////////////////////////////
//          ajax im 3.4          //
//    AJAX Instant Messenger     //
//   Copyright (c) 2006-2008     //
//    http://www.ajaxim.com/     //
//   Do not remove this notice   //
///////////////////////////////////

require('../config.php');

// checks if a user is online or not //
function is_online($username) {
   $query = @mysql_query("SELECT is_online FROM ".SQL_PREFIX."users WHERE username='".mysql_real_escape_string($username)."'");
   $result = @mysql_fetch_assoc($query);
   return $result['is_online'];
}

// connect to database //
$link = mysql_connect($sql_host, $sql_user, $sql_pass);
mysql_select_db($sql_db);

header("Content-type: image/gif");

$isonline = is_online($_GET['user']);
switch($isonline) {
   case 1:
      readfile('images/online.gif');
      break;
   case 2:
      readfile('images/away.gif');
      break;
   case 0:
   case 50:
   case 100:
      readfile('images/offline.gif');
      break;
}

mysql_close($link);
?>
