<?php

global $gpre,$gamename;

function p_to_uid($turn, $roomid)
{
	global $db,$ir,$gpre;
	$field = "p".$turn;
	$uid=$db->fetch_row($db->query("SELECT $field FROM {$gpre}room WHERE id = $roomid"));
	$turnuid = $uid["$field"];
	return $turnuid;
}

function replay_option($roomid)
{
	global $db,$ir,$gpre;
	print"<form method='post' name='replay'><input type=hidden name='replay' value=1><input type='hidden' name='id' value='$roomid'><input type='button' value='Play again?' border=0 name='replaybutton' id='replaybutton' onclick=\"postFormAjax('{$gpre}play.php', 'replay');return false;\" /></form>";
}

function set_up_replay($roomid, $p1, $p2, $bet)
{
	//take bets from users again
	global $db,$ir,$gpre;

	$db->query("UPDATE {$gpre}game SET {$gpre}room=-1 WHERE {$gpre}room=$roomid");
	$db->query("UPDATE {$gpre}room SET play_time=0 WHERE id=$roomid");
	$db->query("UPDATE users SET money=money-$bet WHERE userid=$p1 OR userid=$p2");

}


function award_win($roomid,$winner)
{
	global $db,$ir,$gpre,$gamename;

	$betinfo = $db->fetch_row($db->query("SELECT bet,p1,p2,pleft,play_time FROM {$gpre}room WHERE id=$roomid"));
	$bet = $betinfo['bet'];
	if($betinfo['p1']==0 && $betinfo['p2']>0){$betinfo['p1']=$betinfo['pleft'];$db->query("UPDATE {$gpre}room SET pleft=0 WHERE id=$roomid");}
	if($betinfo['p2']==0 && $betinfo['p1']>0){$betinfo['p2']=$betinfo['pleft'];$db->query("UPDATE {$gpre}room SET pleft=0 WHERE id=$roomid");}
	$totwin = $bet*2;
	if($betinfo['play_time']>0){$uptt = ",create_time=".$betinfo['play_time'];}
	$db->query("UPDATE {$gpre}room SET turn=-1{$uptt} WHERE id=$roomid");
	$db->query("UPDATE {$gpre}game SET winner=$winner WHERE {$gpre}room=$roomid");
	if($winner>0)
	{
		$db->query("UPDATE users SET money=money+$totwin WHERE userid=$winner");
		$wininfr = $db->query("SELECT wins,losses,userid,rating,totgames FROM {$gpre}ranks WHERE userid=$winner");
		$winex = $db->num_rows($wininfr);
		if($winex>0)
		{

			$winir = $db->fetch_row($wininfr);
			$winnerrating = $winir['rating'];
			$winnertotgames = $winir['totgames'];
			$ratio = (float) ($winir['wins']+1)/($winir['wins']+$winir['losses']+1);
			$db->query("UPDATE {$gpre}ranks SET wins=wins+1,totgames=totgames+1,ratio=$ratio WHERE userid=$winner");

		}
		else
		{
			$winnerrating = 1200;
			$winnertotgames = 1;
			$db->query("INSERT INTO {$gpre}ranks (userid, rating, wins, totgames, ratio) VALUES($winner, 1200, 1, 1, 1)");
		}
		if($winner==$betinfo['p1']){$loser=$betinfo['p2'];}
		else{$loser=$betinfo['p1'];}
		
		$db->query("INSERT INTO multihistory (game, winner, loser, timestamp) VALUES('$gamename', $winner, $loser, unix_timestamp())");
		
		$lossinfr = $db->query("SELECT wins,losses,userid,rating,totgames FROM {$gpre}ranks WHERE userid=$loser");
		$lossex = $db->num_rows($lossinfr);
		if($lossex>0)
		{
			$lossir = $db->fetch_row($lossinfr);
			$loserrating = $lossir['rating'];
			$losertotgames = $lossir['totgames'];
			$ratio = (float) $lossir['wins']/($lossir['wins']+$lossir['losses']+1);
			$db->query("UPDATE {$gpre}ranks SET losses=losses+1,totgames=totgames+1,ratio=$ratio WHERE userid=$loser");
		}
		else
		{
			$loserrating = 1200;
			$losertotgames = 1;
			$db->query("INSERT INTO {$gpre}ranks (userid, rating, losses, totgames, ratio) VALUES($loser, 1200, 1, 1, 0)");
		}
		
		adjust_rating($roomid, $loser,$loserrating, $losertotgames, $winnerrating, $winnertotgames, 0);
		adjust_rating($roomid, $winner,$winnerrating, $winnertotgames, $loserrating, $losertotgames, 1);
	}
	else if($winner==-1)
	{
		//tie game, return bets
		$db->query("UPDATE users SET money=money+$bet WHERE userid={$betinfo['p1']}");
		$db->query("UPDATE users SET money=money+$bet WHERE userid={$betinfo['p2']}");
		$lossinfr = $db->query("SELECT wins,losses,userid,rating,totgames FROM {$gpre}ranks WHERE userid={$betinfo['p1']}");
		$lossex = $db->num_rows($lossinfr);

		if($lossex>0)
		{
			$lossir = $db->fetch_row($lossinfr);
			$loserrating = $lossir['rating'];
			$losertotgames = $lossir['totgames'];
			$db->query("UPDATE {$gpre}ranks SET ties=ties+1,totgames=totgames+1 WHERE userid={$betinfo['p1']}");
		}
		else
		{
			$loserrating = 1200;
			$losertotgames = 1;
			$db->query("INSERT INTO {$gpre}ranks (userid, rating, ties, totgames) VALUES({$betinfo['p1']}, 1200, 1, 1)");
		}

		$lossinfr2 = $db->query("SELECT wins,losses,userid,totgames,rating FROM {$gpre}ranks WHERE userid={$betinfo['p2']}");
		$lossex2 = $db->num_rows($lossinfr2);
		if($lossex2>0)
		{
			$lossir2 = $db->fetch_row($lossinfr2);
			$loserrating2 = $lossir2['rating'];
			$losertotgames2 = $lossir2['totgames'];
			$db->query("UPDATE {$gpre}ranks SET ties=ties+1,totgames=totgames+1 WHERE userid={$betinfo['p2']}");
		}
		else
		{
			$loserrating2 = 1200;
			$losertotgames2 = 1;
			$db->query("INSERT INTO {$gpre}ranks (userid, rating, ties, totgames) VALUES({$betinfo['p2']}, 1200, 1, 1)");
		}

		adjust_rating($roomid, $betinfo['p1'],$loserrating, $losertotgames, $loserrating2, $losertotgames2, 0.5);
		adjust_rating($roomid, $betinfo['p2'],$loserrating2, $losertotgames2, $loserrating, $losertotgames, 0.5);

	}
}


function adjust_rating($roomid, $userid,$myrating, $mytotgames, $opprating, $opptotgames, $gameresult)
{
	global $db,$ir,$gpre;

	//FIDE method
	$kfactor = 15;
	if($mytotgames < 30){$kfactor = 25;}
	if($myrating > 2400){$kfactor = 10;}
	
	$winprob = 0;
	$difference = $myrating - $opprating;
	if($difference < 0) //opponent stronger
	{
		$difference = abs($difference);
		if($difference >= 400){$winprob = 0.08;}
		else if($difference >= 350){$winprob = 0.11;}
		else if($difference >= 300){$winprob = 0.15;}
		else if($difference >= 250){$winprob = 0.19;}
		else if($difference >= 200){$winprob = 0.24;}
		else if($difference >= 150){$winprob = 0.30;}
		else if($difference >= 100){$winprob = 0.36;}
		else if($difference >= 50){$winprob = 0.43;}
		else if($difference >= 25){$winprob = 0.47;}
		else if($difference >= 0){$winprob = 0.50;}
	}
	else //I'm stronger
	{
		if($difference >= 400){$winprob = 0.92;}
		else if($difference >= 350){$winprob = 0.89;}
		else if($difference >= 300){$winprob = 0.85;}
		else if($difference >= 250){$winprob = 0.81;}
		else if($difference >= 200){$winprob = 0.76;}
		else if($difference >= 150){$winprob = 0.70;}
		else if($difference >= 100){$winprob = 0.64;}
		else if($difference >= 50){$winprob = 0.57;}
		else if($difference >= 25){$winprob = 0.53;}
		else if($difference >= 0){$winprob = 0.50;}
	}

	//K-factor * ( Result - winprob )

	$ratingchange = (int) ($kfactor * ($gameresult - $winprob));
	$mynewrating = (int) ($myrating + $ratingchange);
	$db->query("UPDATE {$gpre}ranks SET rating=$mynewrating WHERE userid=$userid");
	$ujn = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$userid"));
	$txt = "{$ujn['username']} rating change of {$ratingchange}. New rating is {$mynewrating}.";
	$db->query("INSERT INTO {$gpre}chat ({$gpre}room, timestamp, txt) VALUES($roomid, unix_timestamp(), '$txt')");

}

?>