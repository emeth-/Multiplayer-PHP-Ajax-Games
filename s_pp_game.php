<?php
//What I did to make Ajax work:
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
	hall of fame
*/

include "globals.php";

include "s_{$gpre}func.php";

print"<center>";
$pp = $db->query("SELECT * FROM {$gpre}game WHERE gameover=0 AND userid=$userid");
$pany = $db->num_rows($pp);
$move = abs((int)$_POST['move']);
$select = abs((int)$_POST['select']);
if(!$_GET['act'])
{
	if(!$pany)
	{
		$_GET['act']='new';
	}
	else{
		
		$txt = "You are already in a game";
		print $txt;
		print"<form method='post' action='?act=play'>
		<input type='submit' value='Continue Game'>
		</form>";
		print"<form method='post' action='?act=new'>
		<input type='submit' value='Restart Game'>
		</form>";
	}
}
if($_GET['act']=='post')
{
	if ($user->fbc_getExtendedPermission('publish_stream') < 1) 
	{
		print"<center>To post your game results to Facebook, please click the button below:<br /><br />";
		print "<div><input type='button' name='fbconnect_oad_submit' class='fbconnect_button' onclick='fbc_show_publish_stream_permission_dialog();' value='Authorize Stream Publishing'>";
		print "</div></center>";
	}
	else
	{
		$pinf = $db->query("SELECT * FROM pp_game WHERE userid={$ir['userid']} ORDER BY id DESC LIMIT 1");
		$pin2 = $db->num_rows($pin);
		if($pin2)
		{
			$pin = $db->fetch_row($pinf);
			//facebook post goes here
		    require 'fb-profilepost/facebook.php';
		
			$facepost = new Facebook2($api_key, $secret);
			
			$defmsg = "MrWQ Flash Arcade is a social gaming site where you can play games with your facebook friends!";
			$_GET['victory']=$_POST['victory'];
			$message = stripslashes($_GET['victory']);
			 $attachment = array( 
			'name' => "I just scored {$pin['score']} points in Poker Patience!", 
			'href' => "http://mrwq.com/s_pp_game.php", 
			'caption' => $defmsg, 
			'properties' => array('Try this game' => array( 
				'text' => "Click here to try to beat my score!", 
				'href' => "http://mrwq.com/s_pp_game.php")), 
			'media' => array(array(
				'type' => 'image', 
				'src' => "http://mrwq.com/images/pp/s14.gif", 
				'href' => "http://mrwq.com/s_pp_game.php")), 
			'latitude' => '41.4', //Let's add some custom metadata in the form of key/value pairs 
			'longitude' => '2.19');
			$action_links = array( array(
				'text' => 'Care to play?', 
				'href' => "http://mrwq.com/s_pp_game.php"));
			
			$attachment = json_encode($attachment); 
			
			$action_links = json_encode($action_links); 
			
			    $facepost->api_client->stream_publish($message, $attachment, $action_links);
			print"<center>Posted to your Facebook profile.</center>";
		}
	}
}
if(!$pany && $_GET['act']!='new' && $_GET['act']!='replay' && $_GET['act']!='highscores')
{
	//no game made, make new one
	print"<form method='post' action='?act=new'>
	<input type='submit' value='New Game'>
	</form>";
}
if($_GET['act']=='new')
{
	if(!$pany)
	{
		$db->query("INSERT INTO {$gpre}game (userid) VALUES($userid)");
		setup_game($userid);
		$_GET['act']='play';
		$pany=1;
	}
	else
	{
		$db->query("UPDATE {$gpre}game SET gameover = 1 WHERE gameover=0 AND userid=$userid");
		$db->query("INSERT INTO {$gpre}game (userid) VALUES($userid)");	
		setup_game($userid);
		$_GET['act']='play';
	}
}
if($_GET['act']=='highscores')
{
	print"<h2>Poker Patience</h2><a href='s_pp_game.php'>Play Game!</a><br /><br />
	<table class='table'><tr><th colspan=3>HighScores</th></tr><tr><th>User</th><th>Score</th><th>Action</th></tr>";
	$scora = $db->query("SELECT * FROM pp_scores ORDER BY score DESC LIMIT 20");
	while($scor = $db->fetch_row($scora))
	{
		$unams = $db->fetch_row($db->query("SELECT username FROM users WHERE userid={$scor['userid']}"));
		print"<tr><td>{$unams['username']}</td><td>{$scor['score']} points</td><td>&nbsp;<a href=?act=view&id={$scor['gameid']}>View</a>&nbsp;</td></tr>";
	}
	print"</table>";
}
if($_GET['act']=='replay')
{
		$gameid = $_GET['id'];
		$db->query("INSERT INTO {$gpre}game (userid) VALUES($userid)");
		$pp = $db->query("SELECT * FROM {$gpre}game WHERE gameover=0 AND userid=$userid");
		setup_game($userid);
		$_GET['act']='play';
		$pany=1;
}
$id=abs((int)$_GET['id']);
if($_GET['act']=='view')
{
	$vgs = $db->query("SELECT * FROM {$gpre}scores WHERE gameid=$id");
	if(!$db->num_rows($vgs)){die();}
	$vg = $db->fetch_row($vgs);
	print"<h2>".userid_to_username($vg['userid'])." scored ".number_format($vg['score'])."</h2>
	&gt; <a href='s_pp_game.php?act=highscores'>Back to High Scores</a><br />";
	draw_board($ir['userid'],$id,1);
}
if($pany && $_GET['act']=='play')
{
	$p = $db->fetch_row($pp);
	$gameid = $p['id'];
        print"
        <center><div id = \"gamediv\">
        <img src='images/pp/s14.gif' onerror=\"refreshPage();\" onload=\"refreshPage();\" onclick=\"refreshPage();\">
        <br /><button type=\"button\" onclick=\"refreshPage();\">Begin Playing</button>
        </div>";
}
print"</center>";
$h->endpage();
?>