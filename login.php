<?php
session_start();

include_once 'lib/config.php';

$user = User::fbc_getLoggedIn();
($user) ? $fb_active_session = $user->fbc_is_session_active() : $fb_active_session = FALSE;


if ($user) {
	//header redirect to a logged in page
	header('Location: index.php');
}
else
{
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
	$randnum = rand(1,1000000);
	while($db->num_rows($db->query("SELECT userid FROM users WHERE userid=$randnum"))>0)
	{
		$randnum = rand(1,1000000);
	}
	$db->query("INSERT INTO users (username, userid, guest, money) VALUES('Guest #{$randnum}', '{$randnum}', 1, 100)");
	$_SESSION['loggedin']=1;
	$_SESSION['loggedin']=1;
	$_SESSION['userid']=$randnum;
	
	$thirtyma = time() - (60*15); //thirty minutes ago
	$dgaatl = $db->query("SELECT * FROM users WHERE guest=1 AND laston<$thirtyma AND userid!=$randnum LIMIT 3");
	while($dga=$db->fetch_row($dgaatl))
	{
		$db->query("DELETE FROM arcadepbest WHERE userid={$dga['userid']}");
		$db->query("DELETE FROM arcadetrophy WHERE userid={$dga['userid']}");
		$db->query("DELETE FROM users WHERE userid={$dga['userid']}");
		$db->query("DELETE FROM highscores WHERE userid={$dga['userid']}");
		$db->query("DELETE FROM flashscores WHERE userid={$dga['userid']}");
		$db->query("DELETE FROM pp_scores WHERE userid={$dga['userid']}");
		
		$db->query("DELETE FROM bg_ranks WHERE userid={$dga['userid']}");
		$db->query("UPDATE bg_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE bg_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE bg_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE bg_game SET p2=0 WHERE p2={$dga['userid']}");
		
		$db->query("DELETE FROM bs_ranks WHERE userid={$dga['userid']}");
		$db->query("UPDATE bs_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE bs_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE bs_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE bs_game SET p2=0 WHERE p2={$dga['userid']}");
		
		$db->query("DELETE FROM cf_ranks WHERE userid={$dga['userid']}");
		$db->query("UPDATE cf_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE cf_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE cf_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE cf_game SET p2=0 WHERE p2={$dga['userid']}");
		
		$db->query("DELETE FROM ck_ranks WHERE userid={$dga['userid']}");
		$db->query("UPDATE ck_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE ck_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE ck_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE ck_game SET p2=0 WHERE p2={$dga['userid']}");
		
		$db->query("DELETE FROM man_ranks WHERE userid={$dga['userid']}");
		$db->query("UPDATE man_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE man_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE man_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE man_game SET p2=0 WHERE p2={$dga['userid']}");
		
		$db->query("DELETE FROM ms_ranks WHERE userid={$dga['userid']}");
		$db->query("UPDATE ms_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE ms_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE ms_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE ms_game SET p2=0 WHERE p2={$dga['userid']}");
		
		$db->query("DELETE FROM or_ranks WHERE userid={$dga['userid']}");
		$db->query("UPDATE or_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE or_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE or_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE or_game SET p2=0 WHERE p2={$dga['userid']}");
		
		$db->query("UPDATE ttt_room SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE ttt_room SET p2=0 WHERE p2={$dga['userid']}");
		$db->query("UPDATE ttt_game SET p1=0 WHERE p1={$dga['userid']}");
		$db->query("UPDATE ttt_game SET p2=0 WHERE p2={$dga['userid']}");
		
		
	}
	//delete from ALL other tables where userid=this.
	if($_SESSION['redirectURL'])
	{
		header('Location: '.$_SESSION['redirectURL']);
	}
	else
	{
		header('Location: index.php');
	}
}

if(!$at)
{
$currhome = " class=\"current\"";
$currreg = "";
$currfaq = "";
$currcontact = "";
}
//if($at=='aboutus'){$yes=1;}
if($at=='tos'){$yes=1;}
if($at=='validate'){$yes=1;}
if($at=='privacypolicy'){$yes=1;}
if($at=='faq')
{
$yes=1;
$currhome = "";
$currreg = "";
$currfaq = " class=\"current\"";
$currcontact = "";
}
if($at=='contactus')
{
$yes=1;
$currhome = "";
$currreg = "";
$currfaq = "";
$currcontact = " class=\"current\"";
}
if($at=='resendval'){$yes=1;}
if($at=='forgot'){$yes=1;}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MrWQ</title>
<link type="text/css" rel="Stylesheet" href="./css/master.css" />
</head>

<body>
<div id="wrapper">
	<div id="nav">

<?php

if (!$user) {
	// DISPLAY PAGE WHEN USER IS NOT LOGGED IN TO FB CONNECT
	print '<div class="fbconnect_login">';
	print render_fbconnect_button('medium');
	print '</div>';
}
?>

	</div>
	<div id="graphic">
		<img src="./img/top-graphic.jpg" width="874" height="168" alt="MrQW" />
	</div>
	<div id="main_links">
		<ul>
			<li <?php print $currhome; ?>><a href="login.php"><span>Home</span></a></li>
			<li <?php print $currreg; ?>><a href="#"><span>#</span></a></li>
			<li <?php print $currfaq; ?>><a href="#"><span>#</span></a></li>
			<li <?php print $currcontact; ?>><a href="#"><span>#</span></a></li>
		</ul>
	</div>
	<div id="left_nav">

	</div>
	<div id="content">
<?php
if($yes==1){include "$at.php";}
else
{  
?>
		<h1>Click the "Connect with Facebook" button at the top left of this page to login.</h1>
<?php
}
?>
	</div>
	<div class="push"></div>
</div>
<div id="footer">
	<div id="sock">Copyright <strong>©</strong> 2009 <a href="index.php">mrwq.com</a>.
 | <a href=login.php?a=privacypolicy>Privacy Policy</a> | 
<a href=login.php?a=tos>Terms Of Service</a></div>
</div>

<?
	echo render_footer();
?>

</body>
</html>

