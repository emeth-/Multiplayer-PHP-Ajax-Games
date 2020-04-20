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

$dd=$db->query("SELECT * FROM cashin");
$ss=$db->fetch_row($dd);
$db->query("UPDATE cashin SET totmembership=totmembership+{$ss['membership']},membership=0,totreferral=totreferral+{$ss['referral']},referral=0,totads=totads+{$ss['ads']},ads=0,totbidvert=totbidvert+{$ss['bidvert']},bidvert=0,paid=0");

$hy=$db->fetch_row($db->query("SELECT topscore FROM cashin"));
$x=$hy['topscore'];
$a=$db->query("SELECT id,game FROM flash2 WHERE accepted=1");
while($b=$db->fetch_row($a))
{
	$i=0;
	$c=$db->query("SELECT * from highscores WHERE gameid={$b['id']} ORDER BY score DESC LIMIT 3");
	while($d=$db->fetch_row($c))
	{
		$i++; // place of person
		//$db->query("INSERT INTO arcadetrophy VALUES('',{$d['userid']},{$d['gameid']},{$d['score']},$i,unix_timestamp(),'{$b['game']}')");
		//determine $x or money by place
		if($i==1){$x=50;$pla='1st';}
		if($i==2){$x=25;$pla='2nd';}
		if($i==3){$x=10;$pla='3rd';}
		$db->query("UPDATE users SET points=points+$x WHERE userid={$d['userid']}");
		//send message
		$db->query("UPDATE users SET new_event=new_event+1 WHERE userid={$d['userid']}");
		$msg="Congrats! You won a $pla place trophy for your score of {$d['score']} on {$b['game']}. You received a $x point reward!";
		$db->query("INSERT INTO events VALUES ('',{$d['userid']},unix_timestamp(),0,'$msg')") or die(mysql_error());

	}
}

//clear all arcade scores
$db->query("TRUNCATE TABLE flashscores");
$db->query("TRUNCATE TABLE highscores");

$IP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
$db->query("INSERT INTO stafflog VALUES(NULL, 13, unix_timestamp(), 'cron months ran', '$IP')");


?>