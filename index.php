<?php
if($_GET['action']=='arcade' || $_GET['act']=='Arcade' || $_GET['act']=='arcade' || $_POST['act']=='arcade' || $_POST['act']=='acrade' || $_POST['gname'])
{
	include "globals.php";
	if($_POST['game_name']){$_POST['game']=$_POST['game_name'];}
	$_POST['game']=mysql_escape($_POST['game']);
	$_POST['score']=abs($_POST['score']+0);
	if(!$_POST['score']){$_POST['score']=0;}
	if($_POST['gname'] && $_POST['gscore'])
	{
		$_POST['game']=mysql_escape($_POST['gname']);
		$_POST['score']=abs($_POST['gscore']+0);
	}
	if($_POST['game'] && $_POST['score'])
	{
	$_POST['score']=abs($_POST['score']);
	$q=$db->query("SELECT * FROM flash2 WHERE file='{$_POST['game']}' LIMIT 1");
	$r=$db->fetch_row($q);
	$q2=$db->query("SELECT id,startTime FROM flashscores WHERE userid='$userid' && gameid={$r['id']} && score=0 ORDER BY id DESC LIMIT 1");
	$r2=$db->fetch_row($q2);
	$rn=$db->num_rows($q2);
	if(!$rn){$bad="<center><font color=red>Game session error. <br />This may be caused by having multiple tabs opened on this game, logging into the site halfway through the game, or refreshing the page after your score was submitted.</font></center><br /><br />";}
	if(!$bad)
	{
	$db->query("UPDATE flash2 SET plays=plays+1 WHERE id={$r['id']}");
	if($dontsendscore!=1)
	{
	$db->query("UPDATE flashscores SET endTime=unix_timestamp(),score={$_POST['score']},scoreStatus=1 WHERE id={$r2['id']}");
	//update personal bests
	$n=$db->query("SELECT * FROM arcadepbest WHERE userid='$userid' && gameid={$r['id']}");
	$k=$db->num_rows($n);
	if($k)
	{
		$m=$db->fetch_row($n);
		if($m['score']<$_POST['score'])
		{
			$db->query("UPDATE arcadepbest SET score={$_POST['score']} WHERE userid='$userid' && gameid={$r['id']}");
		}
	}
	else
	{
		$db->query("INSERT INTO arcadepbest VALUES('','$userid',{$r['id']},{$_POST['score']},'{$r['game']}')");
	}
	
	//high score board
	$scor=$db->query("SELECT * FROM flashscores WHERE id={$r2['id']}");
	$scoreinfo=$db->fetch_row($scor);
	$nnn=$db->query("SELECT * FROM highscores WHERE userid='$userid' && gameid={$r['id']}");
	$hin=$db->num_rows($nnn);
	$hi=$db->fetch_row($nnn);
	if($hin)
	{
		if($hi['score']<$_POST['score'] && $r['id']!=125)
		{$db->query("UPDATE highscores SET score={$_POST['score']},endTime={$scoreinfo['endTime']},startTime={$scoreinfo['startTime']} WHERE userid='$userid' && gameid={$r['id']}");}
		else if($hi['score']>$_POST['score'] && $r['id']==125)
		{$db->query("UPDATE highscores SET score={$_POST['score']},endTime={$scoreinfo['endTime']},startTime={$scoreinfo['startTime']} WHERE userid='$userid' && gameid={$r['id']}");}


	}
	else 
	{
		$db->query("INSERT INTO highscores VALUES('','$userid',{$r['id']},{$_POST['score']},{$scoreinfo['startTime']},{$scoreinfo['endTime']})");
		$gameinfo = mysql_fetch_array(mysql_query("SELECT * FROM flash2 WHERE id={$r['id']}"));
		$stype=$gameinfo['sortmethod'];
		$sca = $db->query("SELECT * FROM highscores WHERE gameid = {$r['id']} ORDER BY score $stype LIMIT 30,100");
		while($scoa = $db->fetch_row($sca))
		{
			$db->query("DELETE FROM highscores WHERE id={$scoa['id']}");
		}
	}
	$weekago = time()-(60*60*24*7);
	$db->query("DELETE FROM flashscores WHERE (startTime<$weekago AND endTime=0) OR endTime<$weekago OR userid=0");

	}
	$tescore=number_format($_POST['score']);
	
	if($ir['guest']==0)
	{
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
			$optionsar[]="<option value='{$elementss[1]}'>{$elementss[0]}'s Profile</option>";
		}
		
		$selectstatement = "<select name=fid><option value='$userid'>My Profile</option>";
		foreach ($optionsar as $option)
		{
			$selectstatement.=$option;
		}
		$selectstatement.="</select>";
		
		
		
		$btext = "Show off your talent! Post your score to someone's profile as a brag or a challenge!<br />
			<form action='arcade.php' method='get'><input type='hidden' value='{$scoreinfo['id']}' name='fbpost'>
			Post to {$selectstatement}<br />
			Message of Victory: <input type='text' name='victory'> <i>(Optional)</i><br /><input type='submit' value='Post to Facebook'></form>";		
	}
	else
	{
		$btext = "Want to post your score on facebook? Log in to your Facebook Account<br />
			using the button on the left!";	
	}

	print "<center><font size=3 color=green>Your score of $tescore points for {$r['game']} has been submitted!</font>$txt<br />$btext</center>";
	}
	else{print "<font size=3 color=red>".$bad."</font>";}
	}
	$gb=1;
	include "arcade.php";
}
else
{
	$home=1;
	include "globals.php";
	$signedup=$ir['signedup'];
	$threedaysago=time() - (60 * 60 * 24 * 3);
	
	if($wbstw==1 && $signedup<$threedaysago)
	{
	print"<center><b>Welcome,  {$ir['username']}!</b><br />
	<em>Your last visit was: $lv.</em><hr width=98%></center>";
	}
	
	
	print"<center><h2>News</h2><hr width=98%><center>";
	$ac=$ir['new_announcements'];
	$q=$db->query("SELECT * FROM announcements ORDER BY a_time DESC LIMIT 10");
	print "<table width='80%' cellspacing='1' class='table'>
	<tr>
	<th>Time</th>
	<th>Announcement</th>
	</tr>";
	while($r=$db->fetch_row($q))
	{
	if($ac > 0)
	{
	$ac--;
	$new="<br /><b>New!</b>";
	}
	else
	{
	$new="";
	}
	print "<tr><td valign=top><font size=1><center>".date('F j Y, g:i:s a', $r['a_time']).$new."</font></td><td valign=top>&nbsp;<br />&nbsp;{$r['a_text']}<br />&nbsp;</td></tr>";
	}
	print "</table>";
	if($ir['new_announcements'])
	{
	$db->query("UPDATE users SET new_announcements=0 WHERE userid='{$userid}'");
	}
	print"</center><br /><br />";
	
	$h->endpage();
}
?>
