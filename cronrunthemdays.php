<?php
//BETA - CURRENTLY DISABLED
session_start();
if($_SESSION['loggedin']!=0) { header("Location: news.php");exit; }
include "config.php";
global $_CONFIG,$affID;
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
if($_GET['p']!='jillybeanroxmysox'){die("nogo");}



$twodaysbe=time() - (60 * 60 * 24 * 2);
$db->query("DELETE FROM flashscores WHERE startTime<$twodaysbe",$c);
$db->query("DELETE FROM fbflashscores WHERE startTime<$twodaysbe",$c);


?>