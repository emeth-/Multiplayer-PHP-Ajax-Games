<?php


function replay_option($roomid)
{
	global $db,$ir;
	print"<form method='post' name='replay'><input type=hidden name='replay' value=1><input type='button' value='Play again?' border=0 name='replaybutton' id='replaybutton' onclick=\"postFormAjax('ttt_play.php', 'replay');return false;\" /></form>";
}

function set_up_replay($roomid, $p1, $p2, $bet)
{
	//take bets from users again
	global $db,$ir;
	$db->query("UPDATE ttt_game SET ttt_room=-1 WHERE ttt_room=$roomid");
	$db->query("UPDATE ttt_room SET play_time=0 WHERE id=$roomid");
	$db->query("UPDATE users SET money=money-$bet WHERE userid=$p1 OR userid=$p2");
}

function award_win($roomid,$winner)
{
	global $db,$ir;
	$betinfo = $db->fetch_row($db->query("SELECT bet,p1,p2 FROM ttt_room WHERE id=$roomid"));
	$bet = $betinfo['bet'];
	$totwin = $bet*2;
	$db->query("UPDATE ttt_room SET turn=-1 WHERE id=$roomid");
	$db->query("UPDATE ttt_game SET winner=$winner WHERE ttt_room=$roomid");
	if($winner>0)
	{
		$db->query("UPDATE users SET money=money+$totwin WHERE userid=$winner");
	}
	else if($winner==-1)
	{
		//tie game, return bets
		$db->query("UPDATE users SET money=money+$bet WHERE userid={$betinfo['p1']}");
		$db->query("UPDATE users SET money=money+$bet WHERE userid={$betinfo['p2']}");
	}
}

function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game=$db->query("SELECT * FROM ttt_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);
	$turn = $ga['turn'];
	if($turn==$userid)
	{
		$ginfo = $db->query("SELECT * FROM ttt_game WHERE ttt_room=$roomid");
		$gin = $db->fetch_row($ginfo);
		$field = "b".$move;
	
		if($gin[$field] == 0)
		{
			$ctime = time();
			$db->query("UPDATE ttt_game SET $field = $userid WHERE ttt_room = $roomid");
			$db->query("UPDATE ttt_room SET play_time=unix_timestamp() WHERE id=$roomid");
			$winner = check_win($roomid);

			if($winner != 0)
				award_win($roomid,$winner);
			else
				toggle_turn($roomid); //only toggle turn if no win yet

		}
	}
}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM ttt_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE ttt_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE ttt_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	
}

function create_game($roomid)
{
	global $db,$ir;
	$alreadymade = $db->num_rows($db->query("SELECT ttt_room FROM ttt_game WHERE ttt_room = $roomid"));
	if(!$alreadymade)
	{
		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		if($turn==1){$other=2;}else{$other=1;}
		$otheruid = p_to_uid($other, $roomid);
		$db->query("UPDATE ttt_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO ttt_game (ttt_room, x, p1, p2) VALUES ($roomid, $turnuid, $turnuid, $otheruid)");
	}
}

function p_to_uid($turn, $roomid)
{
	global $db,$ir;
	$field = "p".$turn;
	$uid=$db->fetch_row($db->query("SELECT $field FROM ttt_room WHERE id = $roomid"));
	$turnuid = $uid["$field"];
	return $turnuid;
}

function draw_board($roomid, $userid, $turn)
{
	global $db,$ir;

	$drawb = $db->query("SELECT * FROM ttt_game WHERE ttt_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);

	for($i=1; $i <=9; $i++)
	{
		$t = "b".$i;
		$t1 = "{$i}";
		$t2 = $draw[$t];

		if($t2 == $draw['x'])
			{$$t = "<img src='images/ttt/X.png'>";}
		else if($t2 >0 )
			{$$t = "<img src='images/ttt/O.png'>";}
		else if($userid != $turn)
			{$$t = "<img src='images/ttt/blank.png'>";}
		else
			{$$t = "<form method='post' name='move{$t1}'><input type=hidden name='move' value=$t1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' height = '50' width='50' src=\"images/ttt/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ttt_play.php', 'move{$t1}');return false;\" /></form>";}
	}

	$txt="<center><table BORDER='0' cellpadding=0 cellspacing=4 style=\"background: url('images/ttt/background.jpg') no-repeat;\">";
	$txt.="<tr><td style=\"font-size:0;\">$b1</td><td style=\"font-size:0;\">$b2</td><td style=\"font-size:0;\">$b3</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$b4</td><td style=\"font-size:0;\">$b5</td><td style=\"font-size:0;\">$b6</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$b7</td><td style=\"font-size:0;\">$b8</td><td style=\"font-size:0;\">$b9</td></tr>";
	$txt.="</table></center>";
	
	print $txt;
}

function check_win($roomid)
{
	global $db,$ir;

	$winner = 0;

	$ginf = $db->query("SELECT * FROM ttt_game WHERE ttt_room = $roomid");
	$gin = $db->fetch_row($ginf);

	for($i = 0; $i <= 9; $i++)
	{
		$t = "b".$i;
		$$t = $gin[$t];
	}

	if($b1 == $b2 && $b2 == $b3 && $b1 != 0){$winner = $b1;}
	if($b4 == $b5 && $b5 == $b6 && $b4 != 0){$winner = $b4;}
	if($b7 == $b8 && $b8 == $b9 && $b7 != 0){$winner = $b7;}

	if($b1 == $b4 && $b4 == $b7 && $b1 != 0){$winner = $b1;}
	if($b2 == $b5 && $b5 == $b8 && $b2 != 0){$winner = $b2;}
	if($b3 == $b6 && $b6 == $b9 && $b3 != 0){$winner = $b3;}

	if($b1 == $b5 && $b5 == $b9 && $b1 != 0){$winner = $b1;}
	if($b3 == $b5 && $b5 == $b7 && $b3 != 0){$winner = $b3;}

	if($b1 > 0 && $b2 > 0 && $b3 > 0 && $b4 > 0 && $b5 > 0 && $b6 > 0 && $b7 > 0 && $b8 > 0 && $b9 > 0)
	{
		if($winner==0)
		{$winner=-1;}
	}
	return $winner;
}

?>