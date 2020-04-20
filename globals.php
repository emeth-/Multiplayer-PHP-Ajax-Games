<?php
if(!$_SESSION['userid'])
{
session_start();
}
ob_start();
if(get_magic_quotes_gpc() == 0)
{
  foreach($_POST as $k => $v)
  {
    $_POST[$k]=addslashes($v);
	$_POST[$k]=str_replace(array("meta","onload","onerror","onLoad","onError","xml","null", "alert(","eval(","innerHTML","innerhtml","onreadystatechange","var "),array("","","","","","","","","","","","",""),$_POST[$k]); 
	$_POST[$k]=str_replace(array("<script", "applet", "embed", "<form", "union","--", "../","/*","java"),array("","","","","","","","","",""),$_POST[$k]); 
  }
  foreach($_GET as $k => $v)
  {
    $_GET[$k]=addslashes($v);
	$_GET[$k]=str_replace(array("meta","onload","onerror","onLoad","onError","xml","null", "alert(","eval(","innerHTML","innerhtml","onreadystatechange","var "),array("","","","","","","","","","","","",""),$_GET[$k]); 
	$_GET[$k]=str_replace(array("<script", "applet", "embed", "<form", "union","--", "../","/*","java"),array("","","","","","","","","",""),$_GET[$k]); 

  }
}
global $user;

require "global_func.php";

include_once 'lib/config.php';

  $user = User::fbc_getLoggedIn();
  ($user) ? $fb_active_session = $user->fbc_is_session_active() : $fb_active_session = FALSE;

if($user)
{
  //facebook
  $userid=$user->fbc_uid;
  $_SESSION['userid'] = $user->fbc_uid;
  if (!$_SESSION['userid']) 
	{
		$_SESSION['redirectURL']=$_SERVER["REQUEST_URI"];
		header("Location: login.php");exit; 
	}
}
else
{
  //guest
  if (!$_SESSION['userid']) 
	{ 
		$_SESSION['redirectURL']=$_SERVER["REQUEST_URI"];
		header("Location: login.php");exit; 
	}
  $userid = $_SESSION['userid'];
  $guest=1;
}


require "header.php";

include "config.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_mysql.php";
$db=new database;
$db->configure($_CONFIG['hostname'],
 $_CONFIG['username'],
 $_CONFIG['password'],
 $_CONFIG['database'],
 $_CONFIG['persistent']);
$db->connect();
$c=$db->connection_id;
$set=array();
$settq=$db->query("SELECT * FROM settings");
while($r=$db->fetch_row($settq))
{
$set[$r['conf_name']]=$r['conf_value'];
}
$domain=$set['domain'];

if($_SESSION['userid'])
{
  if($guest){$gutxt=" AND guest=1";}
  $is=$db->query("SELECT * FROM users WHERE userid='$userid'{$gutxt}");
  $useex = $db->num_rows($is);
  if($useex>0)
  {
    $ir=$db->fetch_row($is);
    $namenospaces = str_replace(" ", "_", $ir['username']);
    $_SESSION['username']=$namenospaces;
  }
  else if(!$userid)
  {
    die('error');
  }
  else
  {
    if($guest==1)
    {
	header('Location: login.php');
    }
    else
    {
      $name=$user->fbc_name;
      $db->query("INSERT INTO users (userid, username, money) VALUES('$userid', '$name', 1000)");
      $is=$db->query("SELECT * FROM users WHERE userid='$userid'");
      $ir=$db->fetch_row($is);
    }
  }
}
$h = new headers;
$h->startheaders();
$fm="\$".number_format($ir['money']);
$lv=date('F j, Y, g:i a',$ir['laston']);
$h->userdata($ir,$lv,$fm);

?>