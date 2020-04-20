<?php
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

require "global_func.php";
if($_SESSION['loggedin']==0) { header("Location: login.php");exit; }
$userid=$_SESSION['userid'];
$staff=1;
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
$domain=$_SERVER['HTTP_HOST'];

$is=$db->query("SELECT * FROM users WHERE userid=$userid");
$ir=$db->fetch_row($is);
if($ir['user_level'] <= 1)
{
print("403: Access Denied");
$h->endpage();
exit;
}
$h = new headers;
$h->startheaders();
$fm=number_format($ir['money'],2);
$fm="\$".$fm;
$lv=date('F j, Y, g:i a',$ir['laston']);
$staffpage=1;
$h->userdata($ir,$lv,$fm,$cm);

$h->menuarea();



?>