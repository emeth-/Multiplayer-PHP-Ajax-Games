<?php
$arcade=1;
if($gb!=1)
{
require "globals.php";
}
$fbpost = preg_replace("/[^0-9]/", "", $_GET['fbpost']); //id of player recieving
if($fbpost)
{

	
	if ($user->fbc_getExtendedPermission('publish_stream') < 1) 
	{
		print"<center>To post your scores to Facebook, please click the button below:<br /><br />";
		print "<div><input type='button' name='fbconnect_oad_submit' class='fbconnect_button' onclick='fbc_show_publish_stream_permission_dialog();' value='Authorize Stream Publishing'>";
		print "</div></center>";
	}
	else
	{
                $friendid = $_GET['fid']."";
		$fbp = $db->query("SELECT * FROM flashscores WHERE userid=$userid AND id=$fbpost");
		$fpg = $db->num_rows($fpb);
		if($fpg)
		{
			$fp = $db->fetch_row($fbp);
			//facebook post goes here
		    require 'fb-profilepost/facebook.php';
		
			$facepost = new Facebook2($api_key, $secret);
                        
			$gam=$db->fetch_row($db->query("SELECT imagename,game FROM flash2 WHERE id={$fp['gameid']}"));
                        
                        $defmsg = "MrWQ Flash Arcade is a social gaming site where you can play games with your facebook friends!";
                        if($friendid != $userid && is_numeric($friendid)) //check to see if post id has a lower score
                        {
                            $bahsd = $db->query("SELECT * FROM highscores WHERE userid=$friendid AND gameid={$fp['gameid']}");
                            if($db->num_rows($bahsd)>0)
                            {
                                $fsce = $db->fetch_row($bahsd);
                                if($fsce['score'] > 0 && $fsce['score']<$fp['score'])
                                {
                                    $oppusn = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$friendid"));
                                    $defmsg = "{$ir['username']} just annihilated {$oppusn['username']}'s high score of ".number_format($fsce['score'])." on the game {$gam['game']}. MrWQ Flash Arcade is a social gaming site where you can play games with your facebook friends!"; 
                                }
                            }
                        }
	
                        if(!$_GET['victory']){$_GET['victory']="I just scored ".number_format($fp['score'])." points on the game {$gam['game']}.";}
			$message = stripslashes($_GET['victory']);
			 $attachment = array( 
			'name' => "I just scored ".number_format($fp['score'])." points on the game {$gam['game']}. Can you beat me?", 
			'href' => "http://mrwq.com/game.php?id={$fp['gameid']}", 
			'caption' => $defmsg, 
			'properties' => array('Try this game!' => array( 
				'text' => "Click here to play {$gam['game']}", 
				'href' => "http://mrwq.com/game.php?id={$fp['gameid']}")), 
			'media' => array(array(
				'type' => 'image', 
				'src' => "http://mrwq.com/arcadefiles/{$gam['imagename']}", 
				'href' => "http://mrwq.com/game.php?id={$fp['gameid']}")), 
			'latitude' => '41.4', //Let's add some custom metadata in the form of key/value pairs 
			'longitude' => '2.19');
			$action_links = array( array(
				'text' => 'Try to beat my score!', 
				'href' => "http://mrwq.com/game.php?id={$fp['gameid']}"));
			
			$attachment = json_encode($attachment); 
			
			$action_links = json_encode($action_links); 
			
                        if($friendid != $userid)
                        {
                            $whos = "your friend's";
                            $facepost->api_client->stream_publish($message, $attachment, $action_links, $friendid);
                        }
                        else
                        {
                            $whos = "your";
                            $facepost->api_client->stream_publish($message, $attachment, $action_links);
                        }
			//$db->query("DELETE FROM flashscores WHERE userid=$userid AND id=$fbpost");
			print"<center>Posted to {$whos} Facebook profile.</center>";
		}
	}
}
$accU=1;
if($ir['user_level']==2){$accU="1 or accepted = 0";}
if($ir['guest']==0){$achist = "<a href='arcadehistory.php?act=viewrecent'>See what your friend's have been playing!</a><br /><br />";}
print"
<br />
<center><h2>Arcade</h2> {$achist}";
//$v=$db->query("SELECT * FROM arcadewarn WHERE user={$_SESSION['userid']} OR ip='{$ir['lastip']}'");
//$f=$db->num_rows($v);
if($f)
{
print"<b><font color=red>You have $f warning(s).</font></b><br />
<font size=1>(If you get 3 warnings, you will be banned from the arcade)</font><br /><br />";
}
if($f>=3)
{
die("<font color=red>You have been banned from the arcade for cheating.</font><br /><br />");
}
$perday = 10;
if($ir['donatordays']>0){$perday = 25;}
//print" <br /><font size=2>
//You have <b>{$ir['dailygames']}</b> paid games left today! (You get $perday per day)<br /></font>";
//if($ir['dailygames']>0){print"<font size=1.5>Earn 1 point for each game you play!</font><br />";}

//print"<br /><font size=1>Top 3 scores for each game get a bonus at the end of each month.</font>";
print"<hr color=black noshade width=98%>";
$cntr=0;
print"<center>
<table width=90% style='border: 1px solid black' bgcolor=#99CCFF cellspacing=0 cellpadding=2 align=center>
";
while($cntr<2)
{
if($cntr==1){$titlegames='Random Games';$query="SELECT imagename,game,id FROM flash2 WHERE accepted=$accU  ORDER BY rand() LIMIT 4";}
elseif($cntr==0){$titlegames='Most Played Games';$query="SELECT imagename,game,id FROM flash2 WHERE accepted=$accU ORDER BY plays DESC LIMIT 4";}
$counter = 0;

print "<tr>";
if($cntr==0){print"<th align=center bgcolor='$cSecondary' style='border-bottom: 1px solid black' colspan='1'>";}
if($cntr==1){print"<th align=center bgcolor='$cSecondary' style='border-top: 1px solid black;border-bottom: 1px solid black' colspan='1'>";}

print"<b>$titlegames</b></th></tr>
<tr><td width=75% bgcolor=#99CCFF><center><table><tr>";

//picks the newest 5 games and displays them
$findgames = mysql_query($query);

while($game = mysql_fetch_array($findgames))
{
$glink = "game.php?id=$game[id]";
$hlink = "highscores.php?id=$game[id]";
echo "<td>&nbsp;</td>
<td>
<table>
<tr><td><a href='$glink' title='Play $game[game]'><img src=arcadefiles/{$game['imagename']} height=60 width=60></a></td></tr>
<tr><td><a href='$glink' title='Play $game[game]'><font size=1><li>Play $game[game]</font></a></td></tr>
<tr><td><a href='$hlink'><font size=1><li>High Scores</font></a></td></tr>
</table>
</td>
<td>&nbsp;</td>";
}

echo "</tr></table></td></tr>";

$cntr++;
}

print"
</table><hr color=black noshade width=100%>
<font size=5>Games</font>
<hr color=black noshade width=100%>
";

// Determine amount of games
$numrows = mysql_num_rows(mysql_query("SELECT id FROM flash2 WHERE accepted=$accU{$spec}"));

// how many rows to show per page
$rowsPerPage = 20;

// by default we show first page
$pageNum = 1;

// if $page defined, use it as page number
if(isset($_GET['page']))
{
$page=abs((int)$_GET['page']);
$pageNum = $page;
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

$findgames = @mysql_query("SELECT game,id,imagename FROM flash2 WHERE accepted=$accU{$spec} ORDER BY id DESC LIMIT $offset,$rowsPerPage");

$counter = 0;

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

for($page = 1; $page <= $maxPage; $page++)
{

if($page == $pageNum)
{
$nav = $nav . " $page ";
}
else
{
$nav = $nav .  " <a href=\"arcade.php?page=$page\">$page</a> ";
} 
}

echo "<br /><table border=0 cellspacing=10 cellpadding=0 border=0><tr><td colspan=2>
<center><b>Browse Flash Game Pages:</b><br> $nav <br>
</td><td colspan=3>
<form action=flashsearchdos.php?page=search method=post style=\"padding: 0; margin: 0;\">
<input type=text name=search size=16><br><input type=submit value=\"Game Search\"></form></td></tr><tr><td colspan=5>
<hr color=black noshade width=100%>
</td></tr></table><table border=0 cellspacing=10 cellpadding=0 border=0><tr>";

while($game = @mysql_fetch_array($findgames))
{
// Next row
if($counter == 5)
{
echo "</tr><tr>";

// Reset counter
$counter = 0;
}

// Replace game link
$gamelink = "game.php?id=$game[id]";
$highlink = "highscores.php?id=$game[id]";


echo "<td><table>
<tr><td>
</td>

<td>

<b><a href=$gamelink title='Play $game[game]'>
<img src=arcadefiles/{$game['imagename']} height=60 width=60><br />
<font size=1><li>Play $game[game]</font>
</a></b><a href=$highlink><font size=1><li>High Scores</font></a></center>

</td>
</tr>						
</table></td>";

$counter ++;
}
print"</tr></table><br /><br />";

//least played games

if($ir['user_level']==2)
{
$query="SELECT imagename,game,id FROM flash2 WHERE accepted=1 ORDER BY plays ASC LIMIT 5";
$findgames = mysql_query($query);
$o=0;
print"<table width=50% style='border: 1px solid black' bgcolor=#99CCFF cellspacing=0 cellpadding=2 align=center><tr><th><b>Least Played Games:</b></th></tr><tr><td>";
while($game = mysql_fetch_array($findgames))
{
$o++;
if($o==1 || $o==2 || $o==3){$tl=" <i>(danger of deletion)</i>";}
else{$tl='';}
$glink = "game.php?id=$game[id]";
$hlink = "highscores.php?id=$game[id]";
echo "<center><a href='$glink' title='Play $game[game]'><font size=1><li>$game[game]</a>{$tl}</font></center>";
}
print"</td></tr></table>";
}


$h->endpage();
?>