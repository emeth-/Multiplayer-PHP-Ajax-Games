<?php
require 'encryptor.php';
$crypt = new encryption_class;

ini_set('session.gc_maxlifetime', 36000);
session_start();
if(get_magic_quotes_gpc() == 0)
{
foreach($_POST as $k => $v)
{
  $_POST[$k]=addslashes($v);
}
foreach($_GET as $k => $v)
{
  $_GET[$k]=addslashes($v);
}
}

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
$IP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
while($r=$db->fetch_row($settq))
{
$set[$r['conf_name']]=$r['conf_value'];
}
if ($_POST['email'] == "" || $_POST['password'] == "")
{
die("<h3>{$set['game_name']} Error</h3>
You did not fill in the login form!<br>
<a href=login.php>&gt; Back</a>");
}
$_POST['email']=mysql_real_escape_string($_POST['email']);
$encpass = $crypt->encrypt($_POST['email'], $_POST['password']);
$encpass=addslashes($encpass);
$uq=$db->query("SELECT userid FROM users WHERE email='{$_POST['email']}' AND `userpass`='$encpass'");
$la=$db->fetch_row($db->query("SELECT * FROM loginattempts WHERE ip='$IP'"));
if ($db->num_rows($uq)==0 && $la['times']<10)
{
$lat=$db->num_rows($db->query("SELECT * FROM loginattempts WHERE ip='$IP'"));
if(!$lat){$db->query("INSERT INTO loginattempts VALUES('','$IP',1)");}
else{$db->query("UPDATE loginattempts SET times=times+1 WHERE ip='$IP'");}
die("<h3>{$set['game_name']} Error</h3>
Invalid email or password!<br>
<a href=login.php>&gt; Back</a>");
}
else if ($la['times']>9)
{
die("<h3>{$set['game_name']} Error</h3>
You have tried to login the maximum number of times for this hour. Please wait 1 hour and try again.<br>
<a href=login.php>&gt; Back</a>");
}
else
{
$_SESSION['loggedin']=1;
$mem=$db->fetch_row($uq);
$_SESSION['userid']=$mem['userid'];
$db->query("UPDATE users SET lastip_login='$IP',last_login=unix_timestamp() WHERE userid={$mem['userid']}");
if($set['validate_period'] == "login" && $set['validate_on'])
{
$db->query("UPDATE users SET verified=0 WHERE userid={$mem['userid']}");
}
$irt=$db->fetch_row($db->query("SELECT laston FROM users WHERE userid={$mem['userid']}"));

if($irt['laston']==0)
{
header("Location: introvid.php");
}
else
{
header("Location: loggedin.php");
}
//header("Location: sig.php?v={$mem['userid']}");


}

?>
