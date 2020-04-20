<?php
//To make Ajax works:
// 1) Created file s_pp_header.php
// 2) Edited header.php, added $sppjs to globals declarations,
//	included s_pp_header.php in appropriate spot,
//	printed out $sppjs in appropriate spot.
// 3) Put s_pp_play.php code into s_pp_game.php.
// 4) Made s_pp_play.php the code that receives the input from ajax and draws board
$sppjs=1;

$gpre = "pp_";

/*
	functions left
	check/award win
*/

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");

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
$is=$db->query("SELECT * FROM users WHERE userid={$_SESSION['userid']}");
$ir=$db->fetch_row($is);
$userid=$ir['userid'];

include "s_{$gpre}func.php";

$pp = $db->query("SELECT * FROM {$gpre}game WHERE gameover=0 AND userid=$userid");
$pany = $db->num_rows($pp);
$move = abs((int)$_POST['move']);
$select = abs((int)$_POST['select']);
print"<center>";
//This code is essentially the code that executes in the if($pany && $_GET['act']=='play') statement within s_pp_game.php
if($pany)
{
	$p = $db->fetch_row($pp);
	print "<h2>Poker Patience</h2><a href='s_pp_game.php?act=highscores'><b><font color=green>View Highscores</font></b></a> | 
	<b>How to play:</b><br /><font size=1> Get the best 5 card hand possible on each row, column, and the two diagonals. <br />
	Your final score is the total points you earned from all 12 of those hands.<br />
	Click one of the two decks at top to select a card to play, and click an open square to play it.</font><br /><br />
	<div id = \"gamediv\">";
	$gameid = $p['id'];
	$boardtxt = draw_board($userid,$gameid);
	if($move != 0 && $p['gameover']==0)
	{
		make_move($move,$userid);
		$points =check_win($userid);
		if($points > 0)
		{
			$ins= $db->query("SELECT * FROM pp_scores WHERE userid=$userid AND $points<score");
			$insn = $db->num_rows($ins);
			//keep old score only if there's a score in the DB that has a higher value than $points
			if(!$insn)
			{
				$db->query("DELETE FROM pp_scores WHERE userid=$userid");	
				$db->query("DELETE FROM pp_game WHERE userid=$userid AND id!=$gameid");	
				$db->query("INSERT INTO pp_scores (userid, score, gameid) VALUES($userid, $points, $gameid)");	
			}
			print "Game over, you got <b>{$points} points</b>  <br /><br>";
			print"<form method='post' action='?act=replay'>
			<input type='submit' value='New Game?'>
			</form><br /><br />";
			print"<form method='post' action='?act=post'>
			Victory Message (optional): <input type=text name='victory'><br />
			<input type='submit' value='Post to Facebook?'>
			</form>";
		}
	}
	if($select !=0)
	{
		card_select($select,$userid);
	}
	$boardtxt = draw_board($userid,$gameid);
	print $boardtxt;
	print"</div>";
}
print"</center>";
?>