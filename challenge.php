<?php
global $challengeheadertext;
if($_GET['act']=='prechallenge' || $_GET['act']=='challenge')
{
	include "globals.php";
}
//data sent
if($_POST['player']){$_GET['player']=$_POST['player'];}
$action = $_GET['act']; //what action they are doing
$userid = $ir['userid']; 		//id of player submitting action
$otheruser = preg_replace("/[^0-9]/", "", $_GET['player']); //id of player recieving
$time = time();					//time
$game = preg_replace("/[^a-zA-Z\s]/", "", $_POST['game']); //game type
$gameg = preg_replace("/[^a-zA-Z\s]/", "", $_GET['game']); //game type
$challengeid = abs($_GET['challengeid']);
//actual code
switch($action)
{
	case "joining";
		//challenge id
		$existchallenge = $db->num_rows($db->query("SELECT id FROM challenge WHERE ((`from`=$userid OR `to`=$userid) AND id=$challengeid)"));
		// if there is a id set players = 0
		if($existchallenge != 0)
		{$db->query("DELETE FROM challenge WHERE id=$challengeid");}
		break;
	case "prechallenge":
		if($otheruser>0)
		{
			$cuinf = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$otheruser"));
			print"<center><h3>Challenge {$cuinf['username']}!</h3>
			<form method=post action=challenge.php?act=challenge&player=$otheruser>
			What 2-player game do you wish to challenge your friend in?<br /><select name=game>
			<option value='st'>Strategy</option>
			<option value='ck'>Checkers</option>
			<option value='ms'>Minesweeper</option>
			<option value='or'>Othello</option>
			<option value='bs'>Battleship</option>
			<option value='bg'>Backgammon</option>
			<option value='cf'>Connect 4</option>
			<option value='man'>Mancala</option>
			<option value='ttt'>Tic-Tac-Toe</option>
			</select>
			<br />
			How long should each turn last?<br />
			<select name='turnlength'>
			<option value=30>30 seconds</option>
			<option value=86400>1 Day</option>
			<option value=259200>3 Days</option>
			<option value=604800>1 Week</option>
			</select>
			<br />
			Post challenge to friend's profile?<br />
			<select name='post'>
			<option value=1>Yes</option>
			<option value=0>No</option>
			</select>
			<br />
			<input type=submit value='Challenge!'></form></center>";
		}
		else if($gameg=='st' || $gameg=='ck' || $gameg=='ms' || $gameg=='or' || $gameg=='bs' || $gameg=='bg' || $gameg=='cf' || $gameg=='man' || $gameg=='ttt')
		{
			$gnaio = $db->fetch_row($db->query("SELECT name FROM multgames WHERE short='$gameg'"));
			print"<center>
			<form method=post action=challenge.php?act=challenge>
			<h3>Challenge your friend to a game of <b>{$gnaio['name']}</b></h3>
			<img src='images/{$gnaio['name']}.png'><br />";
				//make friends list. Should really add this to global_func
				$friends = $user->fbc_get_all_friends();
				$optionsarr = array();
				foreach ($friends as $friend)
				{
					$optionsarr[]=$friend['first_name']." ".$friend['last_name']."-".$friend['uid'];
				}
				sort($optionsarr);
				
				$optionsar = array();
				foreach ($optionsarr as $optionsele)
				{
					$elementss = explode("-", $optionsele);
					$optionsar[]="<option value='{$elementss[1]}'>{$elementss[0]}</option>";
				}
				
				$selectstatement = "<select name='player'>";
				foreach ($optionsar as $option)
				{
					$selectstatement.=$option;
				}
				$selectstatement.="</select>";
				
				print"Which friend? <br />{$selectstatement}";
			print"<br /><br />
			How long should each turn last?<br />
			<select name='turnlength'>
			<option value=30>30 seconds</option>
			<option value=86400>1 Day</option>
			<option value=259200>3 Days</option>
			<option value=604800>1 Week</option>
			</select><input type=hidden value='{$gameg}' name=game>
			<br /><br />
			Post challenge to friend's profile?<br />
			<select name='post'>
			<option value=1>Yes</option>
			<option value=0>No</option>
			</select>
			<br /><br />
			<input type=submit value='Challenge!'></form></center>";
		}
		break;
	case "challenge":
		if($game!='st' && $game!='ck' && $game!='ms' && $game!='or' && $game!='bs' && $game!='bg' && $game!='cf' && $game!='man' && $game!='ttt'){die();}
		if($_POST['turnlength']!=86400 && $_POST['turnlength']!=259200 && $_POST['turnlength']!=604800)
		{
			$turnlength = 30;
		}
		else
		{
			$turnlength = abs((int)$_POST['turnlength']);
		}
		$existgame = $db->num_rows($db->query("SELECT id FROM challenge WHERE `from`=$userid AND game='$game'"));
		//allowed options for challenges - creates challenge
		//$alreadyplaying = $db->fetch_row($db->query("SELECT * FROM users WHERE userid=$otheruser"));
		//if($alreadyplaying["{$game}_room"]>0)
		//{
		//	print"Sorry, your friend is already playing that game!";
		//}
		//else 
		if($existgame == 0)
		{
			$db->query("INSERT INTO challenge (time, `from`, `to`,game, time_left) VALUES($time, $userid, $otheruser,'$game', $turnlength)");
			print "Challenge created. You will be notified when it will be accepted.";
			if($_POST['post']==1)
			{
				if ($user->fbc_getExtendedPermission('publish_stream') < 1) 
				{
					print"<center>To post your challenge to Facebook, please click the button below:<br /><br />";
					print "<div><input type='button' name='fbconnect_oad_submit' class='fbconnect_button' onclick='fbc_show_publish_stream_permission_dialog();' value='Authorize Stream Publishing'>";
					print "</div></center>";
				}
				else
				{
					$gna=$db->fetch_row($db->query("SELECT * FROM multgames WHERE short='{$game}'"));
					//facebook post goes here
				    require 'fb-profilepost/facebook.php';
				
					$facepost = new Facebook2($api_key, $secret);
					$game = $gna['name'];
					 $attachment = array( 
					'name' => "{$ir['username']} just challenged you to a game of $game.", 
					'href' => "http://mrwq.com/twoplayergames.php", 
					'caption' => $defmsg, 
					'properties' => array("Care for a game?" => array( 
						'text' => "Click here to accept or reject the challenge.", 
						'href' => "http://mrwq.com/twoplayergames.php")), 
					'media' => array(array(
						'type' => 'image', 
						'src' => "http://mrwq.com/images/{$game}.png", 
						'href' => "http://mrwq.com/twoplayergames.php")), 
					'latitude' => '41.4', //Let's add some custom metadata in the form of key/value pairs 
					'longitude' => '2.19');
					$action_links = array( array(
						'text' => 'Go to MrWQ.com!', 
						'href' => "http://mrwq.com/"));
					
					$attachment = json_encode($attachment); 
					
					$action_links = json_encode($action_links); 
					$facepost->api_client->stream_publish($message, $attachment, $action_links, $otheruser);
				}
			}
		}
	
		break;
	case "accept":
		$existgame = $db->num_rows($db->query("SELECT id FROM challenge WHERE (`from`=$userid OR `to`=$userid) AND id=$challengeid"));
		if($existgame > 0)
		{
			$ticks=$db->query("SELECT * FROM challenge WHERE id=$challengeid");
			$ticc=$db->fetch_row($ticks);
			$game = $ticc['game'];
			$gpre = $game . "_"; // game prefix may just be $game depends how you tag it, easily altered here though
			$gamename = "Private Room"; // creates a name for the room based on challenge id, other ideas? or is it ok
			//create a room for the players
			$people = array();
			$people[]=$ticc['from'];
			$people[]=$ticc['to'];
			sort($people);
			$newpasss = md5($people[1].$people[2]);
			$db->query("INSERT INTO {$gpre}room (name, p1, p2,create_time,pass,time_left) VALUES('$gamename', {$ticc['to']}, {$ticc['from']},unix_timestamp(), '$newpasss',{$ticc['time_left']})");
			$i=$db->insert_id();
			// update the players user info for the new game
			$db->query("UPDATE users SET {$gpre}room=$i WHERE userid={$ticc['to']}");
			$db->query("UPDATE users SET {$gpre}room=$i WHERE userid={$ticc['from']}");
			$db->query("UPDATE challenge SET accepted=$userid WHERE id=$challengeid");
			$challengeheadertext="<center>You have accepted a challenge. <br /><a href=sb_game.php?g={$gpre}>Redirecting (or click here)</a>...
			<META HTTP-EQUIV=\"refresh\" content=\"3;URL=sb_game.php?g={$gpre}\"></center><br /><br />";
		}
		break;
	case "reject":
	case "cancel";
		//challenge id
		$existchallenge = $db->num_rows($db->query("SELECT id FROM challenge WHERE ((`from`=$userid OR `to`=$userid) AND id=$challengeid)"));
		// if there is a id set players = 0
		if($existchallenge != 0)
		{$db->query("DELETE FROM challenge WHERE id=$challengeid");}
		break;
}


if($_GET['act']=='prechallenge' || $_GET['act']=='challenge')
{
	$h->endpage();
}
?>
