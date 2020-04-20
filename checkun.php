<?php
include "config.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_{$_CONFIG['driver']}.php";
$db=new database;
$db->configure($_CONFIG['hostname'],
 $_CONFIG['username'],
 $_CONFIG['password'],
 $_CONFIG['database'],
 $_CONFIG['persistent']);
$db->connect();
$c=$db->connection_id;
if(!$_GET['password']) { die("<font color='red'>Invalid - Blank</font>"); }
if(strlen($_GET['password']) < 4) { die("<font color='red'>Invalid - Too Short</font>"); }
$un=$_GET['password'];
$q=$db->query("SELECT * FROM users WHERE username='$un'");
if (!preg_match("/^[a-zA-Z0-9]*$/", trim($un))) 
{
$bad=1;
}
if($db->num_rows($q)) { die("<font color='red'>Invalid - Taken</font>"); }
if($bad) { die("<font color='red'>Invalid Characters</font>"); }
print "<font color='green'>Valid</font>";
?>