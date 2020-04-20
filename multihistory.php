<?php
require "globals.php";
print"
<br />
<center><h2>2-Player Games History</h2> &gt;<a href='twoplayergames.php'>Go Play!</a><br /><br />";
$postid = abs((int) $_GET['postid']);
if($postid)
{
	if(!$_GET['victory'] && !$_GET['vics'])
	{
		print"What would you like your 'victory message' to be?<br />
		<form method=get action='multihistory.php'>
		<input type=hidden name=postid value=$postid>
		<input type=hidden name=vics value=1>
		<input type=text name='victory'><br />
		<input type=submit value='Post to Facebook'>
		</form><br /><br />";
	}
	else
	{
	
		if ($user->fbc_getExtendedPermission('publish_stream') < 1) 
		{
			print"<center>To post your game results to Facebook, please click the button below:<br /><br />";
			print "<div><input type='button' name='fbconnect_oad_submit' class='fbconnect_button' onclick='fbc_show_publish_stream_permission_dialog();' value='Authorize Stream Publishing'>";
			print "</div></center>";
		}
		else
		{
			$fbp = $db->query("SELECT * FROM multihistory WHERE (winner={$ir['userid']} OR loser={$ir['userid']}) AND id=$postid");
			$fpg = $db->num_rows($fpb);
			if($fpg)
			{
				$fp = $db->fetch_row($fbp);
				$usrwfb=$db->fetch_row($db->query("SELECT username FROM users WHERE userid={$fp['winner']}"));
				$usrlfb=$db->fetch_row($db->query("SELECT username FROM users WHERE userid={$fp['loser']}"));
				//facebook post goes here
			    require 'fb-profilepost/facebook.php';
			
				$facepost = new Facebook2($api_key, $secret);
				
				$defmsg = "MrWQ Flash Arcade is a social gaming site where you can play games with your facebook friends!";
	
				if(!$_GET['victory'] && $_GET['vics']){$_GET['victory']="{$usrwfb['username']} just beat {$usrlfb['username']} in a game of {$fp['game']}.";}
				$message = stripslashes($_GET['victory']);
				 $attachment = array( 
				'name' => "{$usrwfb['username']} just beat {$usrlfb['username']} in a game of {$fp['game']}.", 
				'href' => "http://mrwq.com/twoplayergames.php", 
				'caption' => $defmsg, 
				'properties' => array('Try this game!' => array( 
					'text' => "Click here to play against me.", 
					'href' => "http://mrwq.com/twoplayergames.php")), 
				'media' => array(array(
					'type' => 'image', 
					'src' => "http://mrwq.com/images/{$fp['game']}.png", 
					'href' => "http://mrwq.com/twoplayergames.php")), 
				'latitude' => '41.4', //Let's add some custom metadata in the form of key/value pairs 
				'longitude' => '2.19');
				$action_links = array( array(
					'text' => 'Play this game with me!', 
					'href' => "http://mrwq.com/twoplayergames.php"));
				
				$attachment = json_encode($attachment); 
				
				$action_links = json_encode($action_links); 
				
				    $whos = "your";
				    $facepost->api_client->stream_publish($message, $attachment, $action_links);
				print"<center>Posted to {$whos} Facebook profile.</center>";
			}
		}
	}
}

$friends = $user->fbc_get_connected_friends_sb(FALSE);
$friends[] = $ir['userid'];
$friendids = implode(",", $friends);
//userid IN ($friendids)
$ahc = $db->query("SELECT * FROM multihistory WHERE winner={$ir['userid']} OR loser={$ir['userid']} ORDER BY timestamp DESC LIMIT 100");
$howmany = $db->num_rows($ahc);
if(!$howmany)
{
	print"You have no activity in 2-player games yet! <a href='twoplayergames.php'>Go play some games!</a>";
}
else
{
	print"<table class='table'><tr><th colspan=2>Last $howmany games played</th><th>Action</th></tr>";
	while($ah = $db->fetch_row($ahc))
	{
		$usrw=$db->fetch_row($db->query("SELECT username FROM users WHERE userid={$ah['winner']}"));
		$usrl=$db->fetch_row($db->query("SELECT username FROM users WHERE userid={$ah['loser']}"));
		print"<tr><td align='center'>".nicetime($ah['timestamp'])."</td>
		<td><a href='http://www.facebook.com/profile.php?id={$ah['winner']}' target='_blank'>{$usrw['username']}</a> just beat <a href='http://www.facebook.com/profile.php?id={$ah['loser']}' target='_blank'>{$usrl['username']}</a> in a game of {$ah['game']}.</td>
		<td><a href='?postid={$ah['id']}'>Post to FB</a></td>
		</tr>";
	}
	print"</table>";
}

$h->endpage();




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



?>