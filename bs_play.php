<?php
include "bs_config.php";

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");

$gamepage=$gpres;
session_start();
require_once "config.php";
require_once "global_func.php";
global $_CONFIG;
define("MONO_ON", 1);
require_once "class/class_db_mysql.php";
$db=new database;
$db->configure($_CONFIG['hostname'],
 $_CONFIG['username'],
 $_CONFIG['password'],
 $_CONFIG['database'],
 $_CONFIG['persistent']);
$db->connect();
$c=$db->connection_id;

include_once 'lib/config.php';
  $user = User::fbc_getLoggedIn();
  ($user) ? $fb_active_session = $user->fbc_is_session_active() : $fb_active_session = FALSE;


include "sb_func.php";
include $gpre."func.php";

$currenttime=time();
$is=$db->query("SELECT * FROM users WHERE userid={$_SESSION['userid']}");
$ir=$db->fetch_row($is);

$userid=$ir['userid'];
$roomid=abs((int)$_POST['id']);
if(!$roomid){$roomid=abs((int)$_GET['id']);}
if($roomid) //take this out once fully working
{
	$goodroom = $db->num_rows($db->query("SELECT id FROM {$gpre}room WHERE (p1=$userid OR p2=$userid) AND id=$roomid"));
	if(!$goodroom){die('Error. Bad room ID.');}
}
else
{
	$roomid=$ir["{$gpre}room"];
}

$move = abs((int)$_POST['move']);
$selectship = $_POST['selectship'];
$placeship = $_POST['placeship'];
$_POST['chattxt']=mysql_escape($_POST['chattxt']);

$game=$db->query("SELECT * FROM {$gpre}room WHERE id=$roomid", $c) or die("1");
if($db->num_rows($game)==0){die("You are not currently in a room... <a href=sb_rooms.php?g={$gpre}>Click here to pick a room</a><meta http-equiv=\"refresh\" content=\"0;url=sb_rooms.php?g={$gpre}\" />");}
$ga=$db->fetch_row($game);

$roomid = $ga['id'];


if($_POST['chattxt'])
{
	$_POST['chattxt'] = preg_replace("/[^a-zA-Z0-9?!.'\",\s]/", "", $_POST['chattxt']);
	$_POST['chattxt'] = addslashes($_POST['chattxt']);
	$_POST['chattxt']="<b>".$ir['username']." said: </b>".$_POST['chattxt'];
	$db->query("INSERT INTO {$gpre}chat ({$gpre}room, timestamp, txt) VALUES($roomid, unix_timestamp(), '{$_POST['chattxt']}')");

	die();
}
if($_POST['notify']==1 && $ga['turn']!=$ir['userid'] && ($ga['p1']==$ir['userid'] || $ga['p2']==$ir['userid']))
{
	$db->query("UPDATE {$gpre}room SET notifyturn=1 WHERE id=$roomid");


	if ($user->fbc_getExtendedPermission('publish_stream') < 1) 
	{
		$db->query("UPDATE {$gpre}room SET notifyturn=-1 WHERE id=$roomid");
		die();
	}

	$db->query("UPDATE {$gpre}room SET notifyturn=1 WHERE id=$roomid");

	//facebook post goes here
    require 'fb-profilepost/facebook.php';

	$facepost = new Facebook2($api_key, $secret);
	 $attachment = array( 
	'name' => "{$ir['username']} wants to let you know that it's your turn in {$gamename}!", 
	'href' => "http://mrwq.com/sb_game.php?g={$gpres}", 
	'caption' => $defmsg, 
	'properties' => array("Want to take your turn?" => array( 
		'text' => "Click here to make your move.", 
		'href' => "http://mrwq.com/sb_game.php?g={$gpres}")), 
	'media' => array(array(
		'type' => 'image', 
		'src' => "http://mrwq.com/images/{$gamename}.png", 
		'href' => "http://mrwq.com/twoplayergames.php")), 
	'latitude' => '41.4', //Let's add some custom metadata in the form of key/value pairs 
	'longitude' => '2.19');
	$action_links = array( array(
		'text' => 'Go to MrWQ.com!', 
		'href' => "http://mrwq.com/"));
	
	$attachment = json_encode($attachment); 
	
	$action_links = json_encode($action_links); 
	$facepost->api_client->stream_publish($message, $attachment, $action_links, $ga['turn']);
	die();
}

$gia = $db->query("SELECT * FROM {$gpre}game WHERE {$gpre}room=$roomid");
$gi = $db->fetch_row($gia);
$gamerunning = $db->num_rows($gia);


if($ga['play_time']>0 && $gi['winner']==0) //only if the game has started / first move made
{
	$uin=$db->fetch_row($db->query("SELECT username FROM users WHERE userid={$ga['turn']}"));
	$username = $uin['username'];
	if($username)
	{
		//Check the clock - 35 seconds per move
		//UPDATE - now time is a variable amount set by user
		$turntime = $ga['time_left'];
		if($turntime<35){$turntime=35;}

		$lastmove = $ga['play_time'];
		$ctime = time();
		$timespent = $ctime - $lastmove;
		$timeleft = $turntime - $timespent;
		if($timeleft <= 0)
		{
			//lost their turn
			toggle_turn($roomid);
			$txt = "$username ran out of time and lost his/her move.";
			$db->query("INSERT INTO bs_chat (bs_room, timestamp, txt) VALUES($roomid, unix_timestamp(), '$txt')");

			if($ga['turn']==$ga['p1']){$missfield = "p1missed";$missuserid = $ga['p1'];}
			if($ga['turn']==$ga['p2']){$missfield = "p2missed";$missuserid = $ga['p2'];}
			if($ga["$missfield"]>=2)	//3 turns missed in a row, kick from table
			{
				$db->query("UPDATE {$gpre}room SET p1missed=0,p2missed=0,pleft=$missuserid WHERE id=$roomid");
			
				$db->query("UPDATE users SET {$gpre}room=0 WHERE userid=$missuserid",$c);
				$db->query("UPDATE {$gpre}room SET p1=0 WHERE p1=$missuserid",$c);
				$db->query("UPDATE {$gpre}room SET p2=0 WHERE p2=$missuserid",$c);
			
				print"You have left the table.<br /><br />&gt;<a href=sb_rooms.php?g={$gpre}>Back</a>";
				$txt = "Opponent has left the table.";
				$db->query("INSERT INTO {$gpre}chat ({$gpre}room, timestamp, txt) VALUES($roomid, unix_timestamp(), '$txt')");
				die();
			}
			else if($missfield != '')
			{
				$db->query("UPDATE {$gpre}room SET $missfield=$missfield+1 WHERE id=$roomid");
			}
			

			$game=$db->query("SELECT * FROM {$gpre}room WHERE id=$roomid", $c) or die("1");
			$ga=$db->fetch_row($game);
	
		}
		else if($ga['turn']==$ir['userid'])
		{
			$timeleft = timeleft(time()+$timeleft);
			$timetxt = "<br />You have <b><div id='timeleft' style='display: inline;'>{$timeleft}</div></b> to make a move.";
		}
		else
		{
			$timeleft = timeleft(time()+$timeleft);
			$timetxt = "<br />Your opponent has <b><div id='timeleft' style='display: inline;'>{$timeleft}</div></b> to make a move.";
			if($ga['time_left'] > 40)
			{
				if($ga['notifyturn']==0)
				{
					$timetxt .="<form method='post' name='n1'><input type=hidden name='notify' value=1><input type='submit' border=0 name='nbutton' id='nbutton' value='Notify opponent via Facebook it&lsquo;s their turn!' onclick=\"postFormAjax('bs_play.php', 'n1');return false;\" /></form>";
				}
				else if($ga['notifyturn']==-1)
				{
					$timetxt .="<br /><i>Sorry, you haven't given us permission yet to post on Facebook for you.</i>";
				}
				else
				{
					$timetxt .="<br /><i>Opponent notified it's their turn on Facebook.</i>";
				}
			}
		}
	}
}

if($ga['p1']==$ir['userid']){$opuid = $ga['p2'];}
if($ga['p2']==$ir['userid']){$opuid = $ga['p1'];}

$oun = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$opuid"));
$opponent = $oun['username'];

$wintxt = "";
if($gi['winner']!=0)
{

	if($gi['winner']==$ir['userid'])
	{
		if($ga['bet']>0){$winamt = $ga['bet']*2;$bettxt = " (Received \$".number_format($winamt).")";}
		$wintxt = "<h3>{$ir['username']} won!{$bettxt} | <a target='_blank' href='multihistory.php?act=viewrecent'>Post to Facebook</a></h3>";
	}
	else if($gi['winner']==$opuid)
	{
		if($ga['bet']>0){$winamt = $ga['bet']*2;$bettxt = " (Received \$".number_format($winamt).")";}
		$wintxt = "<h3>{$opponent} won!{$bettxt}</h3>";
	}
	else
	{
		if($ga['bet']>0){$winamt = $ga['bet'];$bettxt = " (Both received \$".number_format($winamt).")";}
		$wintxt = "<h3>Tie game!{$bettxt}</h3>";
	}
	$displayreplay = 1;
	if($_POST['replay']==1)
	{
		if($ga['bet']<=$ir['money'])
		{
			if($gi['replay']==$opuid)
			{
				set_up_replay($roomid, $opuid, $ir['userid'], $ga['bet']);
			}
			else
			{
				$db->query("UPDATE {$gpre}game SET replay={$ir['userid']} WHERE {$gpre}room=$roomid");
			}
		}
	}
	if($ga['bet']>$ir['money'])
	{
			$badreplaymsg=1;
	}
}


$turntxt = "";
if($gi['gamestart']==-1)
{
	if($ga['turn']==$ir['userid'])
	{
		$turntxt = "<h3><font color=green>Your Turn!</font></h3><font size=1>Click somewhere on your opponent's board.</font><br />";
	}
	else if($gi['winner']==0 && $gamerunning>0) 
	{
		$turntxt = "<h3><font color=red>Opponent's Turn.</font></h3>";
	}
}
else
{
	if($_POST['gamestart']==1)
	{
		if($gi['gamestart']==$opuid)
		{
			$db->query("UPDATE {$gpre}game SET gamestart=-1 WHERE {$gpre}room=$roomid");
			set_opp_boards($roomid);
		}
		else
		{
			$db->query("UPDATE {$gpre}game SET gamestart={$ir['userid']} WHERE {$gpre}room=$roomid");
		}
	}
	if($gi['gamestart']==$ir['userid'])
	{
		$turntxt = "<h3><font color=red>Waiting for opponent to be ready...</font></h3><br />";
	}
	else
	{
		$turntxt = gamestart_option($roomid);
	}
}

$rat1 = $db->query("SELECT rating FROM bs_ranks WHERE userid={$ga['p1']}");
$rat1n = $db->num_rows($rat1);
if($rat1n>0)
{
	$rat1ra = $db->fetch_row($rat1);
	$rat1rat = $rat1ra['rating'];
}
else
{
	$rat1rat = 1200;
}

$rat2 = $db->query("SELECT rating FROM bs_ranks WHERE userid={$ga['p2']}");
$rat2n = $db->num_rows($rat2);
if($rat2n>0)
{
	$rat2ra = $db->fetch_row($rat2);
	$rat2rat = $rat2ra['rating'];
}
else
{
	$rat2rat = 1200;
}

if($gi['p1']==$ir['userid']){$myrating = $rat1rat;$opprating = $rat2rat;}
else{$myrating = $rat2rat;$opprating = $rat1rat;}

if($gi["$firstmovemarkfield"]==$ir['userid']){$mymark = " {$person1mark}";$oppmark = " {$person2mark}";}
else{$mymark = " {$person2mark}";$oppmark = " {$person1mark}";}

$vstxt = "<h3>{$ir['username']} ({$myrating}) vs. {$opponent} ({$opprating})</h3>";

if($ga['p1']>0 && $ga['p2'] > 0 && $gamerunning==0)
{
	//game not yet started
	create_game($ga['id']);
}
else if((($ga['p1']>0 && $ga['p2'] == 0) || ($ga['p1']==0 && $ga['p2'] > 0)) && $gamerunning==1 && $ga['play_time']!=0)
{
	//game started, other player left, award win, unless no moves yet made
	if($ga['p1']>0){$winner=$ga['p1'];}else{$winner=$ga['p2'];}
	if($gi['winner']==0)
	{
	award_win($roomid, $winner);
	$defaultwin = "Opponent left, so you won the game (along with any bets).";
	}
	else
	{
	$defaultwin = "Opponent left.";
	}
	set_up_replay($roomid, $winner, -1, $ga['bet']);
}
else if(($ga['p1']>0 && $ga['p2'] == 0) || ($ga['p1']==0 && $ga['p2'] > 0))
{
	$waittxt = "Waiting for another person to join...";
	$vstxt = "";
}


if($move)
{
	if($userid==$ga['p1']){$missfield = "p1missed";}
	if($userid==$ga['p2']){$missfield = "p2missed";}
	$db->query("UPDATE {$gpre}room SET $missfield=0 WHERE id=$roomid");
	make_move($move, $userid, $roomid);
}

if($selectship)
{
	select_ship($selectship, $userid, $roomid);
}

if($placeship)
{
	place_ship($placeship, $userid, $roomid);
}


print"<h1>{$gamename}</h1>";
if($waittxt)
{
	print"{$waittxt}";
}
else if($defaultwin)
{
	print"{$defaultwin}";
}
else
{
	print"{$vstxt}{$wintxt}{$turntxt}";
	if($gi['gamestart']!=-1)
	{
		print"<font size=1>Click a ship to select it, then click the spot on the board where you want to place the leftmost/topmost part of the ship.</font><br />";
	}
	if($displayreplay)
	{
		if($badreplaymsg)
		{
			print"You don't have enough money to play again.<br />";
		}
		else if($gi['replay']==$ir['userid'])
		{
			print"Asking opponent to play again...<br />";
		}
		else
		{
			replay_option($roomid);
		}
	}
	draw_board($roomid, $userid, $ga['turn']);


	print $timetxt;
	//print"<br /><font size=1>To make your move, click an open square <u>once</u>!</font>";
}

?>