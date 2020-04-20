<?php

$gprefix = preg_replace("/[^a-z]/", "", $_GET['g']);
$gprefix = substr($gprefix, 0, 4); 

if (file_exists($gprefix."_config.php")) 
    include $gprefix."_config.php";
else 
    die("Error.");

include "globals.php";
$myrooms = check_room($gpres, $ir['userid']);
$_GET['act']=mysql_escape($_GET['act']);
print "<center><h3>{$gamename}</h3><br />";
if(is_array($myrooms) && $_GET['act']!="leave")
{
	print"<font color=green>Your are currently in the following room(s):</font><br /><table class='table'>
	<tr><th>Room Name</th><th>Opponent</th><th>Action</th></tr>";

	foreach ($myrooms as &$room) 
	{
		$tmrn=$db->fetch_row($db->query("SELECT name,p1,p2 FROM {$gpre}room WHERE id=$room"));
		if($tmrn['p1']==$ir['userid']){$unmtxt = userid_to_username($tmrn['p2']);}
		else{$unmtxt = userid_to_username($tmrn['p1']);}
		print"<tr><td>{$tmrn['name']}</td><td>{$unmtxt}</td>
		<td>&gt; <a href='sb_game.php?g={$gpre}&id=$room'>Go to room.</a></td>";
	}
	print"</table><br /><br /><b>Other Rooms</b><br /><br />";
}
else
{
	if($rules)
	{
		$extralinkhead = " | <a href='sb_rooms.php?g={$gpre}&act=rules'><b>View Rules</b></a> ";
	}
	if($gpres!="ttt"){$halloffame=" | <a href='sb_halloffame.php?g={$gpres}'><b>Hall of Fame</b></a>";}
	print "<center><a href='sb_rooms.php?g={$gpre}'><b>Home</b></a> | <a href='sb_rooms.php?g={$gpre}&act=create'><b>Create a Room</b></a> | <a href='sb_rooms.php?g={$gpre}&act=search'><b>Search For a Room</b></a>{$halloffame}{$extralinkhead}</center><br /><br />";
}
if($_GET['act']=='create')
{
	$_POST['name'] = preg_replace("/[^a-zA-Z0-9?!.,\s]/", "", $_POST['name']);
	$_POST['pass']=mysql_escape($_POST['pass']);
	if(!$_POST['name'])
	{
		print"<h4>Create a Room</h4>
		<form method='post' action='sb_rooms.php?g={$gpre}&act=create'><table>
		<tr><td>Name of room:</td><td><input type=text name='name'></td></tr>
		<tr><td>How long does each turn last?:</td><td><select name='turnlength'>
		<option value=30>30 seconds</option>
		<option value=86400>1 Day</option>
		<option value=259200>3 Days</option>
		<option value=604800>1 Week</option>
		</select></td></tr>
		<tr><td>Bet:<br /><font size=1>(Optional - awarded to winner)</font></td><td><input type=text name='bet' value='0'></td></tr>
		<tr><td>Password <br /><font size=1>(leave blank for none):</td><td><input type=text name='pass'></td></tr>
		<tr><td colspan=2><center><input type=submit value='Create Room'></td></tr></table></form>
		";		

	}
	else
	{
		if($ir["{$gpre}room"]==0)
		{
			if($_POST['name']==''){$_POST['name']='Unnamed';}
			if($_POST['bet']==''){$_POST['bet']=0;}
			$_POST['bet'] = abs((int)$_POST['bet']);
			if($_POST['turnlength']!=86400 && $_POST['turnlength']!=259200 && $_POST['turnlength']!=604800)
			{
				$turnlength = 30;
			}
			else
			{
				$turnlength = abs((int)$_POST['turnlength']);
			}
			if($_POST['bet']<=$ir['money'])
			{
				$db->query("INSERT INTO {$gpre}room (name,bet,pass, p1, create_time, time_left) VALUES('{$_POST['name']}',{$_POST['bet']},'{$_POST['pass']}',$userid,unix_timestamp(),$turnlength)") or die(mysql_error());
				$i=$db->insert_id();
				$ko=$db->query("UPDATE {$gpre}room SET p1=$userid WHERE id=$i",$c);
				$pok=$db->query("UPDATE users SET {$gpre}room=$i, money=money-{$_POST['bet']} WHERE userid=$userid",$c);
				print"You have created a room. <br /><a href=sb_game.php?g={$gpre}&id=$i>Redirecting to room (or click here)</a>...
				<META HTTP-EQUIV=\"refresh\" content=\"3;URL=sb_game.php?g={$gpre}&id=$i\">";
			}
			else
			{
				print"You can't bet more money than you have!<br />&gt;<a href=sb_rooms.php?g={$gpre}&act=create>Back</a>";
			}	
		}
		else
		{
			print"You are already in a room! Leave that room first before creating a new one.";
		}
	}
}
else if($_GET['act']=='rules')
{
	print "<table width=80%><tr><td>".$rules."</td></tr></table>";
print"<br /><br /><font size=1><font color=red>*Note</font> - You have about 30 seconds for each move in the game. If you miss 3 moves in a row, you forfeit the game.</font>";

}
else if($_GET['act']=='search')
{
	$_POST['squery']=mysql_escape($_POST['squery']);
	if($_POST['squery'])
	{
		$pok=$db->query("SELECT * FROM {$gpre}room WHERE name LIKE ('%{$_POST['squery']}%') AND play_time!=-1",$c);
		$nump=$db->num_rows($pok);
		if($nump==0){die("Sorry, no rooms found with a name similar to that. <br />&gt;<a href=sb_rooms.php?g={$gpre}&act=search>Back</a>");}
		print"<table class='table'><tr><th>Room Name</th><th>Bet</th><th>Password</th><th>Players</th><th>Join Table?</th></tr>";

		while($pokr=$db->fetch_row($pok))
		{
			$num2=$db->query("SELECT {$gpre}room,username,userid FROM users WHERE userid={$pokr['p1']} OR userid={$pokr['p2']}");
			$peeps = "";
			$num = $db->num_rows($num2);
			while($numm = $db->fetch_row($num2))
			{
				if($gpre == "ttt_")
				{
					if(!$peeps){$peeps=$numm['username'];}
					else{$peeps.=", ".$numm['username'];}
				}
				else
				{
					$uratd = $db->query("SELECT rating FROM {$gpre}ranks WHERE userid={$numm['userid']}");
					if(!$db->num_rows($uratd)){$urat['rating']=1200;}
					else{$urat=$db->fetch_row($uratd);}
					if(!$peeps){$peeps="<a href='sb_halloffame.php?g={$gpres}&userid={$numm['userid']}'>".$numm['username']."</a> ({$urat['rating']})";}
					else{$peeps.=", <a href='sb_halloffame.php?g={$gpres}&userid={$numm['userid']}'>".$numm['username']."</a> ({$urat['rating']})";}
				}
			}	
			if(!$pokr['pass']){$pass="<font color=green>No</font>";}else{$pass="<font color=red>Yes</font>";}
			if($num>=2){$space="<font color=red>Room Full</font>";}else{$space="<a href='sb_rooms.php?g={$gpre}&act=join&t={$pokr['id']}'><font color=green>Join!</font></a>";}
			print"<tr><td>{$pokr['name']}</td><td>\$".number_format($pokr['bet'])."</td><td>$pass</td><td>$peeps</td><td><center>$space</td></tr>";

		}
		print"</table>";
	}
	else
	{
		print"<center><form method='post' action='sb_rooms.php?g={$gpre}&act=search'>
		Room Name: <input type='text' name='squery'><br />
		<input type='submit' value='Search for Room'>
		</form></center>
		";
	}
}
else if($_GET['act']=='join')
{
	$_GET['t']=abs((int) $_GET['t']);
	$num2=$db->query("SELECT {$gpre}room FROM users WHERE {$gpre}room={$_GET['t']}");
	$nu=$db->num_rows($num2);
	$pok=$db->query("SELECT * FROM {$gpre}room WHERE id={$_GET['t']}");
	$nump=$db->num_rows($pok);
	if($nump<=0){die("Sorry, that room does not seem to exist. <br /><a href=sb_rooms.php?g={$gpre}>&gt;Back</a>");}

	$numf=$db->fetch_row($pok);

	if($numf['play_time']==-1)
	{
		die("Error, that room is trying to be reset. Try again in a minute.");
	}
	if($ir["{$gpre}room"]>0)
	{
		die("Sorry, you are already in a room.");
	}
	if($ir['money']<$numf['bet'])
	{
		die("Sorry, you don't have enough money to play at that table. The bet at this table is \$".$numf['bet'].".");
	}
	if($numf['pass'])
	{
		$_POST['pwd']=mysql_escape($_POST['pwd']);
		if(!$_POST['pwd'])
		{
			die("<form method=post action=sb_rooms.php?g={$gpre}&act=join&t={$_GET['t']}>Enter Password: <input type=text name=pwd><input type=submit value='Submit Pass'></form>");
		}
		else
		{
			if($numf['pass']!=$_POST['pwd']){die("That password was incorrect. Sorry.<br /><a href=sb_rooms.php?g={$gpre}>&gt;Back</a>");}
		}
	}
	if($nu>=2){die("Sorry, that room is full. <br /><a href=sb_rooms.php?g={$gpre}>&gt;Back</a>");}
	if($numf['p1']==0){$position='p1';$pp=1;}
	else if($numf['p2']==0){$position='p2';$pp=2;}
	else{die("Sorry, that room is full. <br /><a href=sb_rooms.php?g={$gpre}>&gt;Back</a>");}

	$db->query("UPDATE {$gpre}room SET $position=$userid,play_time=unix_timestamp() WHERE id={$_GET['t']}",$c); 
	$db->query("UPDATE users SET {$gpre}room={$_GET['t']}, money=money-{$numf['bet']} WHERE userid=$userid",$c);

	$txt = "{$ir['username']} has joined the table.";
	$db->query("INSERT INTO {$gpre}chat ({$gpre}room, timestamp, txt) VALUES({$numf['id']}, unix_timestamp(), '$txt')");

	print"You have joined {$numf['name']}. <br /><a href=sb_game.php?g={$gpre}&id={$_GET['t']}>Redirecting (or click here)</a>...
	<META HTTP-EQUIV=\"refresh\" content=\"3;URL=sb_game.php?g={$gpre}&id={$_GET['t']}\">";
}
else if($_GET['act']=='leave')
{
	$id = abs((int) $_GET['id']);
	$toleaverm = check_room($gpres, $ir['userid']);
	if(!is_array($toleaverm)){die("You aren't currently in a room. <br />&gt;<a href=sb_rooms.php?g={$gpre}>Back</a>");}
	if (!in_array($id, $toleaverm)) 
	{
	    {die("Bad room id. <br />&gt;<a href=sb_rooms.php?g={$gpre}>Back</a>");}
	}

	$num2=$db->query("SELECT * FROM {$gpre}room WHERE id=$id");
	$nu=$db->fetch_row($num2);
	
	$gamestarted = $db->num_rows($db->query("SELECT {$gpre}room FROM {$gpre}game WHERE {$gpre}room=$id"));

	if((!$gamestarted && (($nu['p1']==$ir['userid'] && $nu['p2']==0) || ($nu['p2']==$ir['userid'] && $nu['p1']==0))) || $nu['play_time']==0)
	{
		//person left before anyone else joined, give bet back OR if no moves yet made
		$db->query("UPDATE users SET money=money+{$nu['bet']} WHERE userid={$ir['userid']}");
	}
/*****NEW STUFF****/
if((($nu['p1']>0 && $nu['p2'] > 0) || ($nu['p1']>0 && $nu['p2'] > 0)) && $gamestarted==1 && $nu['play_time']>0)
{
	//game started, other player left, award win, unless no moves yet made
	$db->query("UPDATE {$gpre}room SET play_time=-1 WHERE id=$id");
}
/******************/
	
	$db->query("UPDATE users SET {$gpre}room=0 WHERE userid=$userid",$c);
	$db->query("UPDATE {$gpre}room SET p1=0,pleft=$userid WHERE p1=$userid AND id=$id",$c);
	$db->query("UPDATE {$gpre}room SET p2=0,pleft=$userid WHERE p2=$userid AND id=$id",$c);

	print"You have left the table.<br /><br />&gt;<a href=sb_rooms.php?g={$gpre}>Back</a>";
	$txt = "{$ir['username']} has left the table.";
	$db->query("INSERT INTO {$gpre}chat ({$gpre}room, timestamp, txt) VALUES($id, unix_timestamp(), '$txt')");

}
else
{
	$pok=$db->query("SELECT * FROM {$gpre}room WHERE play_time!=-1",$c);
	$anyrooms=$db->num_rows($pok);
	if(!$anyrooms)
	{
		print"There are currently no rooms available. Why don't you <a href=sb_rooms.php?g={$gpre}&act=create><font color=green>make one</font></a>?";
	}
	else
	{
		if(is_array($myrooms)){$gh="";}
		else{$gh="<th>Join Room?</th>";}

		print"<table class='table'><tr><th>Room Name</th><th>Bet</th><th>Password</th><th>Players</th><th>Last Action</th>$gh</tr>";
		$fifteenago = time() - (60*15);
		$hourago = time() - (60*60);
		while($pokr=$db->fetch_row($pok))
		{
			if($pokr['p1'] == 0 && $pokr['p2'] == 0) 
			{
				$db->query("DELETE FROM {$gpre}room WHERE id={$pokr['id']}");
				$db->query("DELETE FROM {$gpre}game WHERE {$gpre}room={$pokr['id']} AND winner=0");
				$db->query("DELETE FROM {$gpre}chat WHERE {$gpre}room={$pokr['id']}");
				$db->query("UPDATE users SET {$gpre}room=0 WHERE {$gpre}room={$pokr['id']}");	//just in case
			}
			else if(($pokr['play_time'] > 0 && $pokr['play_time']<$hourago && $pokr['time_left']<40) || ($pokr['play_time'] < 0 && $pokr['create_time']<$hourago  && $pokr['time_left']<40)) //added in patch 2
			{
				//kill rooms with no action in the last 1 hour
				$db->query("DELETE FROM {$gpre}room WHERE id={$pokr['id']}");
				$db->query("DELETE FROM {$gpre}game WHERE {$gpre}room={$pokr['id']}");
				$db->query("DELETE FROM {$gpre}chat WHERE {$gpre}room={$pokr['id']}");
				$db->query("UPDATE users SET {$gpre}room=0 WHERE {$gpre}room={$pokr['id']}");
			}
			else if(($pokr['p1'] > 0 && $pokr['p2'] == 0 && $pokr['play_time']<$fifteenago && $pokr['time_left']<40) || ($pokr['p1'] == 0 && $pokr['p2'] > 0 && $pokr['play_time']<$fifteenago  && $pokr['time_left']<40)) 
			{
				//kill rooms with 1 player, no action in 15 minutes
				if($pokr['p1'] > 0){$player=$pokr['p1'];}
				else{$player=$pokr['p2'];}
				$db->query("UPDATE users SET money=money+{$pokr['bet']} WHERE userid=$player");
				$db->query("DELETE FROM {$gpre}room WHERE id={$pokr['id']}");
				$db->query("DELETE FROM {$gpre}game WHERE {$gpre}room={$pokr['id']}");
				$db->query("DELETE FROM {$gpre}chat WHERE {$gpre}room={$pokr['id']}");
				$db->query("UPDATE users SET {$gpre}room=0 WHERE {$gpre}room={$pokr['id']}");
			}
			else
			{

	
				$num2=$db->query("SELECT {$gpre}room,username,userid FROM users WHERE userid={$pokr['p1']} OR userid={$pokr['p2']}");
				$peeps = "";
				$num = $db->num_rows($num2);
				while($numm = $db->fetch_row($num2))
				{
					if($gpre == "ttt_")
					{
						if(!$peeps){$peeps=$numm['username'];}
						else{$peeps.=", ".$numm['username'];}
					}
					else
					{
						$uratd = $db->query("SELECT rating FROM {$gpre}ranks WHERE userid={$numm['userid']}");
						if(!$db->num_rows($uratd)){$urat['rating']=1200;}
						else{$urat=$db->fetch_row($uratd);}
						if(!$peeps){$peeps="<a href='sb_halloffame.php?g={$gpres}&userid={$numm['userid']}'>".$numm['username']."</a> ({$urat['rating']})";}
						else{$peeps.=", <a href='sb_halloffame.php?g={$gpres}&userid={$numm['userid']}'>".$numm['username']."</a> ({$urat['rating']})";}
					}	
				}
				if(!$pokr['pass']){$pass="<font color=green>No</font>";}else{$pass="<font color=red>Yes</font>";}
				if($num>=2){$space="<font color=red>Room Full</font>";}else{$space="<a href='sb_rooms.php?g={$gpre}&act=join&t={$pokr['id']}'><font color=green>Join!</font></a>";}
				if($ir["{$gpre}room"]>0){$gh2="";}
				else{$gh2="<td><center>$space</td>";}
				if($pokr['play_time']>0){$lastaction=$pokr['play_time'];}else{$lastaction=$pokr['create_time'];}
				print"<tr><td>{$pokr['name']}</td><td>\$".number_format($pokr['bet'])."</td><td>$pass</td><td>$peeps</td><td>".nicetime($lastaction)."</td>$gh2</tr>";
	
			}
		}
	print"</table>";
	}
}

print"</center>";

function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
   
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
   
    $now             = time();
    $unix_date         = $date;
   
       // check validity of date
    if(empty($unix_date)) {   
        return "Bad date";
    }

    // is it future date or past date
    if($now >= $unix_date) {   
        $difference     = $now - $unix_date;
        $tense         = "ago";
       
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
   
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
   
    $difference = round($difference);
   
    if($difference != 1) {
        $periods[$j].= "s";
    }
   
    return "$difference $periods[$j] {$tense}";
}


$h->endpage();
?>