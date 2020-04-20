<?php

function check_win($roomid)
{
	global $db,$ir;

	$winner = 0;

	$ginf = $db->query("SELECT * FROM cf_game WHERE cf_room = $roomid");
	$gin = $db->fetch_row($ginf);

	$b11 = $gin['b11'];
	$b12 = $gin['b12'];
	$b13 = $gin['b13'];
	$b14 = $gin['b14'];
	$b15 = $gin['b15'];
	$b16 = $gin['b16'];
	$b17 = $gin['b17'];

	$b21 = $gin['b21'];
	$b22 = $gin['b22'];
	$b23 = $gin['b23'];
	$b24 = $gin['b24'];
	$b25 = $gin['b25'];
	$b26 = $gin['b26'];
	$b27 = $gin['b27'];

	$b31 = $gin['b31'];
	$b32 = $gin['b32'];
	$b33 = $gin['b33'];
	$b34 = $gin['b34'];
	$b35 = $gin['b35'];
	$b36 = $gin['b36'];
	$b37 = $gin['b37'];

	$b41 = $gin['b41'];
	$b42 = $gin['b42'];
	$b43 = $gin['b43'];
	$b44 = $gin['b44'];
	$b45 = $gin['b45'];
	$b46 = $gin['b46'];
	$b47 = $gin['b47'];

	$b51 = $gin['b51'];
	$b52 = $gin['b52'];
	$b53 = $gin['b53'];
	$b54 = $gin['b54'];
	$b55 = $gin['b55'];
	$b56 = $gin['b56'];
	$b57 = $gin['b57'];

	$b61 = $gin['b61'];
	$b62 = $gin['b62'];
	$b63 = $gin['b63'];
	$b64 = $gin['b64'];
	$b65 = $gin['b65'];
	$b66 = $gin['b66'];
	$b67 = $gin['b67'];

//hor
	if($b11 == $b12 && $b12 == $b13 && $b13 == $b14 && $b14!=0){$winner = $b11;}
	if($b12 == $b13 && $b13 == $b14 && $b14 == $b15 && $b15!=0){$winner = $b12;}
	if($b13 == $b14 && $b14 == $b15 && $b15 == $b16 && $b16!=0){$winner = $b13;}
	if($b14 == $b15 && $b15 == $b16 && $b16 == $b17 && $b17!=0){$winner = $b14;}
	if($b21 == $b22 && $b22 == $b23 && $b23 == $b24 && $b24!=0){$winner = $b21;}
	if($b22 == $b23 && $b23 == $b24 && $b24 == $b25 && $b25!=0){$winner = $b22;}
	if($b23 == $b24 && $b24 == $b25 && $b25 == $b26 && $b26!=0){$winner = $b23;}
	if($b24 == $b25 && $b25 == $b26 && $b26 == $b27 && $b27!=0){$winner = $b24;}
	if($b31 == $b32 && $b32 == $b33 && $b33 == $b34 && $b34!=0){$winner = $b31;}
	if($b32 == $b33 && $b33 == $b34 && $b34 == $b35 && $b35!=0){$winner = $b32;}
	if($b33 == $b34 && $b34 == $b35 && $b35 == $b36 && $b36!=0){$winner = $b33;}
	if($b34 == $b35 && $b35 == $b36 && $b36 == $b37 && $b37!=0){$winner = $b34;}
	if($b41 == $b42 && $b42 == $b43 && $b43 == $b44 && $b44!=0){$winner = $b41;}
	if($b42 == $b43 && $b43 == $b44 && $b44 == $b45 && $b45!=0){$winner = $b42;}
	if($b43 == $b44 && $b44 == $b45 && $b45 == $b46 && $b46!=0){$winner = $b43;}
	if($b44 == $b45 && $b45 == $b46 && $b46 == $b47 && $b47!=0){$winner = $b44;}
	if($b51 == $b52 && $b52 == $b53 && $b53 == $b54 && $b54!=0){$winner = $b51;}
	if($b52 == $b53 && $b53 == $b54 && $b54 == $b55 && $b55!=0){$winner = $b52;}
	if($b53 == $b54 && $b54 == $b55 && $b55 == $b56 && $b56!=0){$winner = $b53;}
	if($b54 == $b55 && $b55 == $b56 && $b56 == $b57 && $b57!=0){$winner = $b54;}
	if($b61 == $b62 && $b62 == $b63 && $b63 == $b64 && $b64!=0){$winner = $b61;}
	if($b62 == $b63 && $b63 == $b64 && $b64 == $b65 && $b65!=0){$winner = $b62;}
	if($b63 == $b64 && $b64 == $b65 && $b65 == $b66 && $b66!=0){$winner = $b63;}
	if($b64 == $b65 && $b65 == $b66 && $b66 == $b67 && $b67!=0){$winner = $b64;}
//vert
	if($b11 == $b21 && $b21 == $b31 && $b31 == $b41 && $b41!=0){$winner = $b11;}
	if($b21 == $b31 && $b31 == $b41 && $b41 == $b51 && $b51!=0){$winner = $b21;}
	if($b31 == $b41 && $b41 == $b51 && $b51 == $b61 && $b61!=0){$winner = $b31;}
	if($b12 == $b22 && $b22 == $b32 && $b32 == $b42 && $b42!=0){$winner = $b12;}
	if($b22 == $b32 && $b32 == $b42 && $b42 == $b52 && $b52!=0){$winner = $b22;}
	if($b32 == $b42 && $b42 == $b52 && $b52 == $b62 && $b62!=0){$winner = $b32;}
	if($b13 == $b23 && $b23 == $b33 && $b33 == $b43 && $b43!=0){$winner = $b13;}
	if($b23 == $b33 && $b33 == $b43 && $b43 == $b53 && $b53!=0){$winner = $b23;}
	if($b33 == $b43 && $b43 == $b53 && $b53 == $b63 && $b63!=0){$winner = $b33;}
	if($b14 == $b24 && $b24 == $b34 && $b34 == $b44 && $b44!=0){$winner = $b14;}
	if($b24 == $b34 && $b34 == $b44 && $b44 == $b54 && $b54!=0){$winner = $b24;}
	if($b34 == $b44 && $b44 == $b54 && $b54 == $b64 && $b64!=0){$winner = $b34;}
	if($b15 == $b25 && $b25 == $b35 && $b35 == $b45 && $b45!=0){$winner = $b15;}
	if($b25 == $b35 && $b35 == $b45 && $b45 == $b55 && $b55!=0){$winner = $b25;}
	if($b35 == $b45 && $b45 == $b55 && $b55 == $b65 && $b65!=0){$winner = $b35;}
	if($b16 == $b26 && $b26 == $b36 && $b36 == $b46 && $b46!=0){$winner = $b16;}
	if($b26 == $b36 && $b36 == $b46 && $b46 == $b56 && $b56!=0){$winner = $b26;}
	if($b36 == $b46 && $b46 == $b56 && $b56 == $b66 && $b66!=0){$winner = $b36;}
	if($b37 == $b47 && $b47 == $b57 && $b57 == $b67 && $b67!=0){$winner = $b37;}
	if($b37 == $b47 && $b47 == $b57 && $b57 == $b27 && $b27!=0){$winner = $b27;}
	if($b37 == $b47 && $b47 == $b17 && $b17 == $b27 && $b27!=0){$winner = $b17;}
//diaganols
//$b14 diagnol
	if($b14 == $b23 && $b23 == $b32 && $b32 == $b41 && $b41!=0){$winner = $b14;}
	//$b15 diagnol
	if($b15 == $b24 && $b24 == $b33 && $b33 == $b42 && $b42!=0){$winner = $b15;}
	if($b51 == $b24 && $b24 == $b33 && $b33 == $b42 && $b42!=0){$winner = $b24;}
	//$b16 diagnol
	if($b16 == $b25 && $b25 == $b34 && $b34 == $b43 && $b43!=0){$winner = $b16;}
	if($b52 == $b25 && $b25 == $b34 && $b34 == $b43 && $b43!=0){$winner = $b52;}
	if($b52 == $b61 && $b61 == $b34 && $b34 == $b43 && $b43!=0){$winner = $b61;}
	//$b17 diagnol
	if($b17 == $b26 && $b26 == $b35 && $b35 == $b44 && $b44!=0){$winner = $b17;}
	if($b53 == $b26 && $b26 == $b35 && $b35 == $b44 && $b44!=0){$winner = $b53;}
	if($b53 == $b62 && $b62 == $b35 && $b35 == $b44 && $b44!=0){$winner = $b62;}
	//$b27 diagnol
	if($b27 == $b36 && $b36 == $b45 && $b45 == $b54 && $b54!=0){$winner = $b27;}
	if($b63 == $b36 && $b36 == $b45 && $b45 == $b54 && $b54!=0){$winner = $b63;}
	//$b37 diagnol
	if($b37 == $b46 && $b46 == $b55 && $b55 == $b64 && $b64!=0){$winner = $b37;}
	//$b14 diagnol
	if($b14 == $b25 && $b25 == $b36 && $b36 == $b47 && $b47!=0){$winner = $b14;}
	//$b13 diagnol
	if($b13 == $b24 && $b24 == $b35 && $b35 == $b46 && $b46!=0){$winner = $b13;}
	if($b57 == $b24 && $b24 == $b35 && $b35 == $b46 && $b46!=0){$winner = $b24;}
	//$b12 diagnol
	if($b12 == $b23 && $b23 == $b34 && $b34 == $b45 && $b45!=0){$winner = $b12;}
	if($b56 == $b23 && $b23 == $b34 && $b34 == $b45 && $b45!=0){$winner = $b34;}
	if($b56 == $b67 && $b67 == $b34 && $b34 == $b45 && $b45!=0){$winner = $b34;}
	//$b31 diagnol
	if($b31 == $b42 && $b42 == $b53 && $b53 == $b64 && $b64!=0){$winner = $b31;}
	//$b21 diagnol
	if($b21 == $b32 && $b32 == $b43 && $b43 == $b54 && $b54!=0){$winner = $b21;}
	if($b65 == $b32 && $b32 == $b43 && $b43 == $b54 && $b54!=0){$winner = $b65;}
	//$b11 diagnol
	if($b11 == $b22 && $b22 == $b33 && $b33 == $b44 && $b44!=0){$winner = $b11;}
	if($b55 == $b22 && $b22 == $b33 && $b33 == $b44 && $b44!=0){$winner = $b55;}
	if($b66 == $b55 && $b55 == $b33 && $b33 == $b44 && $b44!=0){$winner = $b55;}



	//check for tie game
	if($b11 > 0 && $b12 > 0 && $b13 > 0 && $b14 > 0 && $b15 > 0 && $b16 > 0 && $b17 > 0 && $b21 > 0 && $b22 > 0 && $b23 > 0 && $b24 > 0 && $b25 > 0 && $b26 > 0 && $b27 > 0 && $b31 > 0 && $b32 > 0 && $b33 > 0 && $b34 > 0 && $b35 > 0 && $b36 > 0 && $b37 > 0 && $b41 > 0 && $b42 > 0 && $b43 > 0 && $b44 > 0 && $b45 > 0 && $b46 > 0 && $b47 > 0 && $b51 > 0 && $b52 > 0 && $b53 > 0 && $b54 > 0 && $b55 > 0 && $b56 > 0 && $b57 > 0 && $b61 > 0 && $b62 > 0 && $b63 > 0 && $b64 > 0 && $b65 > 0 && $b66 > 0 && $b67 > 0)
	{//are they are filled?
		if($winner==0)
		{//and is the winner not set?
			$winner=-1;
		}
	}

	//Return the winner's userid
	return $winner;
}

function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game = $db->query("SELECT * FROM cf_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);
	$turn = $ga['turn'];
	if($turn==$userid)
	{
		$ginfo = $db->query("SELECT * FROM cf_game WHERE cf_room=$roomid");
		$gin = $db->fetch_row($ginfo);


		for($i = 6; $i>0; $i--)
		{
			$field = "b".$i.$move;
			
			if($gin[$field] == 0)
			{
				$db->query("UPDATE cf_game SET $field = $userid WHERE cf_room = $roomid");
				$db->query("UPDATE cf_room SET play_time=unix_timestamp() WHERE id=$roomid");
				
				$winner = check_win($roomid);
				if($winner != 0)
					award_win($roomid,$winner);
				else
					toggle_turn($roomid); //only toggle turn if no win yet
				break;
			}
		}

	}
}

function draw_board($roomid, $userid, $turn)
{
	global $db,$ir;

	$drawb = $db->query("SELECT * FROM cf_game WHERE cf_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);


	if($draw['b11']==$draw['red']){$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move11');return false;\" /></form>";} 
	else if($draw['b11']>0){$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move11');return false;\" /></form>";} 
	else{$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move11');return false;\" /></form>";} 

	if($draw['b12']==$draw['red']){$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move12');return false;\" /></form>";} 
	else if($draw['b12']>0){$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move12');return false;\" /></form>";} 
	else{$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move12');return false;\" /></form>";} 

	if($draw['b13']==$draw['red']){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move13');return false;\" /></form>";} 
	else if($draw['b13']>0){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move13');return false;\" /></form>";} 
	else{$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move13');return false;\" /></form>";} 

	if($draw['b14']==$draw['red']){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move14');return false;\" /></form>";} 
	else if($draw['b14']>0){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move14');return false;\" /></form>";} 
	else{$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move14');return false;\" /></form>";} 

	if($draw['b15']==$draw['red']){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move15');return false;\" /></form>";} 
	else if($draw['b15']>0){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move15');return false;\" /></form>";} 
	else{$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move15');return false;\" /></form>";} 

	if($draw['b16']==$draw['red']){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move16');return false;\" /></form>";} 
	else if($draw['b16']>0){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move16');return false;\" /></form>";} 
	else{$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move16');return false;\" /></form>";} 

	if($draw['b17']==$draw['red']){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move17');return false;\" /></form>";} 
	else if($draw['b17']>0){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move17');return false;\" /></form>";} 
	else{$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move17');return false;\" /></form>";} 

//break
	if($draw['b21']==$draw['red']){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move21');return false;\" /></form>";} 
	else if($draw['b21']>0){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move21');return false;\" /></form>";} 
	else{$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move21');return false;\" /></form>";} 

	if($draw['b22']==$draw['red']){$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move22');return false;\" /></form>";} 
	else if($draw['b22']>0){$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move22');return false;\" /></form>";} 
	else{$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move22');return false;\" /></form>";} 

	if($draw['b23']==$draw['red']){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move23');return false;\" /></form>";} 
	else if($draw['b23']>0){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move23');return false;\" /></form>";} 
	else{$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move23');return false;\" /></form>";} 

	if($draw['b24']==$draw['red']){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move24');return false;\" /></form>";} 
	else if($draw['b24']>0){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move24');return false;\" /></form>";} 
	else{$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move24');return false;\" /></form>";} 

	if($draw['b25']==$draw['red']){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move25');return false;\" /></form>";} 
	else if($draw['b25']>0){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move25');return false;\" /></form>";} 
	else{$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move25');return false;\" /></form>";} 

	if($draw['b26']==$draw['red']){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move26');return false;\" /></form>";} 
	else if($draw['b26']>0){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move26');return false;\" /></form>";} 
	else{$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move26');return false;\" /></form>";} 

	if($draw['b27']==$draw['red']){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move27');return false;\" /></form>";} 
	else if($draw['b27']>0){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move27');return false;\" /></form>";} 
	else{$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move27');return false;\" /></form>";} 

//break

	if($draw['b31']==$draw['red']){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move31');return false;\" /></form>";} 
	else if($draw['b31']>0){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move31');return false;\" /></form>";} 
	else{$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move31');return false;\" /></form>";} 

	if($draw['b32']==$draw['red']){$b32 = "<form method='post' name='move32'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move32');return false;\" /></form>";} 
	else if($draw['b32']>0){$b32 = "<form method='post' name='move32'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move32');return false;\" /></form>";} 
	else{$b32 = "<form method='post' name='move32'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move32');return false;\" /></form>";} 

	if($draw['b33']==$draw['red']){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move33');return false;\" /></form>";} 
	else if($draw['b33']>0){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move33');return false;\" /></form>";} 
	else{$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move33');return false;\" /></form>";} 

	if($draw['b34']==$draw['red']){$b34 = "<form method='post' name='move34'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move34');return false;\" /></form>";} 
	else if($draw['b34']>0){$b34 = "<form method='post' name='move34'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move34');return false;\" /></form>";} 
	else{$b34 = "<form method='post' name='move34'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move34');return false;\" /></form>";} 

	if($draw['b35']==$draw['red']){$b35 = "<form method='post' name='move35'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move35');return false;\" /></form>";} 
	else if($draw['b35']>0){$b35 = "<form method='post' name='move35'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move35');return false;\" /></form>";} 
	else{$b35 = "<form method='post' name='move35'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move35');return false;\" /></form>";} 

	if($draw['b36']==$draw['red']){$b36 = "<form method='post' name='move36'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move36');return false;\" /></form>";} 
	else if($draw['b36']>0){$b36 = "<form method='post' name='move36'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move36');return false;\" /></form>";} 
	else{$b36 = "<form method='post' name='move36'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move36');return false;\" /></form>";} 

	if($draw['b37']==$draw['red']){$b37 = "<form method='post' name='move37'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move37');return false;\" /></form>";} 
	else if($draw['b37']>0){$b37 = "<form method='post' name='move37'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move37');return false;\" /></form>";} 
	else{$b37 = "<form method='post' name='move37'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move37');return false;\" /></form>";} 


//break

	if($draw['b41']==$draw['red']){$b41 = "<form method='post' name='move41'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move41');return false;\" /></form>";} 
	else if($draw['b41']>0){$b41 = "<form method='post' name='move41'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move41');return false;\" /></form>";} 
	else{$b41 = "<form method='post' name='move41'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move41');return false;\" /></form>";} 

	if($draw['b42']==$draw['red']){$b42 = "<form method='post' name='move42'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move42');return false;\" /></form>";} 
	else if($draw['b42']>0){$b42 = "<form method='post' name='move42'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move42');return false;\" /></form>";} 
	else{$b42 = "<form method='post' name='move42'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move42');return false;\" /></form>";} 

	if($draw['b43']==$draw['red']){$b43 = "<form method='post' name='move43'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move43');return false;\" /></form>";} 
	else if($draw['b43']>0){$b43 = "<form method='post' name='move43'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move43');return false;\" /></form>";} 
	else{$b43 = "<form method='post' name='move43'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move43');return false;\" /></form>";} 

	if($draw['b44']==$draw['red']){$b44 = "<form method='post' name='move44'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move44');return false;\" /></form>";} 
	else if($draw['b44']>0){$b44 = "<form method='post' name='move44'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move44');return false;\" /></form>";} 
	else{$b44 = "<form method='post' name='move44'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move44');return false;\" /></form>";} 

	if($draw['b45']==$draw['red']){$b45 = "<form method='post' name='move45'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move45');return false;\" /></form>";} 
	else if($draw['b45']>0){$b45 = "<form method='post' name='move45'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move45');return false;\" /></form>";} 
	else{$b45 = "<form method='post' name='move45'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move45');return false;\" /></form>";} 

	if($draw['b46']==$draw['red']){$b46 = "<form method='post' name='move46'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move46');return false;\" /></form>";} 
	else if($draw['b46']>0){$b46 = "<form method='post' name='move46'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move46');return false;\" /></form>";} 
	else{$b46 = "<form method='post' name='move46'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move46');return false;\" /></form>";} 

	if($draw['b47']==$draw['red']){$b47 = "<form method='post' name='move47'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move47');return false;\" /></form>";} 
	else if($draw['b47']>0){$b47 = "<form method='post' name='move47'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move47');return false;\" /></form>";} 
	else{$b47 = "<form method='post' name='move47'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move47');return false;\" /></form>";} 

//break

	
	if($draw['b51']==$draw['red']){$b51 = "<form method='post' name='move51'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move51');return false;\" /></form>";} 
	else if($draw['b51']>0){$b51 = "<form method='post' name='move51'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move51');return false;\" /></form>";} 
	else{$b51 = "<form method='post' name='move51'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move51');return false;\" /></form>";} 

	if($draw['b52']==$draw['red']){$b52 = "<form method='post' name='move52'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move52');return false;\" /></form>";} 
	else if($draw['b52']>0){$b52 = "<form method='post' name='move52'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move52');return false;\" /></form>";} 
	else{$b52 = "<form method='post' name='move52'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move52');return false;\" /></form>";} 

	if($draw['b53']==$draw['red']){$b53 = "<form method='post' name='move53'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move53');return false;\" /></form>";} 
	else if($draw['b53']>0){$b53 = "<form method='post' name='move53'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move53');return false;\" /></form>";} 
	else{$b53 = "<form method='post' name='move53'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move53');return false;\" /></form>";} 

	if($draw['b54']==$draw['red']){$b54 = "<form method='post' name='move54'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move54');return false;\" /></form>";} 
	else if($draw['b54']>0){$b54 = "<form method='post' name='move54'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move54');return false;\" /></form>";} 
	else{$b54 = "<form method='post' name='move54'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move54');return false;\" /></form>";} 

	if($draw['b55']==$draw['red']){$b55 = "<form method='post' name='move55'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move55');return false;\" /></form>";} 
	else if($draw['b55']>0){$b55 = "<form method='post' name='move55'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move55');return false;\" /></form>";} 
	else{$b55 = "<form method='post' name='move55'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move55');return false;\" /></form>";} 

	if($draw['b56']==$draw['red']){$b56 = "<form method='post' name='move56'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move56');return false;\" /></form>";} 
	else if($draw['b56']>0){$b56 = "<form method='post' name='move56'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move56');return false;\" /></form>";} 
	else{$b56 = "<form method='post' name='move56'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move56');return false;\" /></form>";} 

	if($draw['b57']==$draw['red']){$b57 = "<form method='post' name='move57'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move57');return false;\" /></form>";} 
	else if($draw['b57']>0){$b57 = "<form method='post' name='move57'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move57');return false;\" /></form>";} 
	else{$b57 = "<form method='post' name='move57'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move57');return false;\" /></form>";} 

//break

	if($draw['b61']==$draw['red']){$b61 = "<form method='post' name='move61'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move61');return false;\" /></form>";} 
	else if($draw['b61']>0){$b61 = "<form method='post' name='move61'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move61');return false;\" /></form>";} 
	else{$b61 = "<form method='post' name='move61'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move61');return false;\" /></form>";} 

	if($draw['b62']==$draw['red']){$b62 = "<form method='post' name='move62'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move62');return false;\" /></form>";} 
	else if($draw['b62']>0){$b62 = "<form method='post' name='move62'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move62');return false;\" /></form>";} 
	else{$b62 = "<form method='post' name='move62'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move62');return false;\" /></form>";} 

	if($draw['b63']==$draw['red']){$b63 = "<form method='post' name='move63'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move63');return false;\" /></form>";} 
	else if($draw['b63']>0){$b63 = "<form method='post' name='move63'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move63');return false;\" /></form>";} 
	else{$b63 = "<form method='post' name='move63'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move63');return false;\" /></form>";} 

	if($draw['b64']==$draw['red']){$b64 = "<form method='post' name='move64'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move64');return false;\" /></form>";} 
	else if($draw['b64']>0){$b64 = "<form method='post' name='move64'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move64');return false;\" /></form>";} 
	else{$b64 = "<form method='post' name='move64'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move64');return false;\" /></form>";} 

	if($draw['b65']==$draw['red']){$b65 = "<form method='post' name='move65'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move65');return false;\" /></form>";} 
	else if($draw['b65']>0){$b65 = "<form method='post' name='move65'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move65');return false;\" /></form>";} 
	else{$b65 = "<form method='post' name='move65'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move65');return false;\" /></form>";} 

	if($draw['b66']==$draw['red']){$b66 = "<form method='post' name='move66'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move66');return false;\" /></form>";} 
	else if($draw['b66']>0){$b66 = "<form method='post' name='move66'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move66');return false;\" /></form>";} 
	else{$b66 = "<form method='post' name='move66'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move66');return false;\" /></form>";} 

	if($draw['b67']==$draw['red']){$b67 = "<form method='post' name='move67'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move67');return false;\" /></form>";} 
	else if($draw['b67']>0){$b67 = "<form method='post' name='move67'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blue.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move67');return false;\" /></form>";} 
	else{$b67 = "<form method='post' name='move67'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/cf/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('cf_play.php', 'move67');return false;\" /></form>";} 


	$txt="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '300' width='350' style=\"background: url('images/cf/board.png') no-repeat;\">";
	$txt.="<tr><td>$b11</td><td>$b12</td><td>$b13</td><td>$b14</td><td>$b15</td><td>$b16</td><td>$b17</td></tr>";
	$txt.="<tr><td>$b21</td><td>$b22</td><td>$b23</td><td>$b24</td><td>$b25</td><td>$b26</td><td>$b27</td></tr>";
	$txt.="<tr><td>$b31</td><td>$b32</td><td>$b33</td><td>$b34</td><td>$b35</td><td>$b36</td><td>$b37</td></tr>";
	$txt.="<tr><td>$b41</td><td>$b42</td><td>$b43</td><td>$b44</td><td>$b45</td><td>$b46</td><td>$b47</td></tr>";
	$txt.="<tr><td>$b51</td><td>$b52</td><td>$b53</td><td>$b54</td><td>$b55</td><td>$b56</td><td>$b57</td></tr>";
	$txt.="<tr><td>$b61</td><td>$b62</td><td>$b63</td><td>$b64</td><td>$b65</td><td>$b66</td><td>$b67</td></tr>";
	$txt.="</table></center>";
	
	print $txt;
}

function create_game($roomid)
{
	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT cf_room FROM cf_game WHERE cf_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM cf_room WHERE id=$roomid"));

		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		$db->query("UPDATE cf_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO cf_game (cf_room, {$firstmovemarkfield}, p1, p2) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']})");
	}
}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM cf_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE cf_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE cf_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	
}

?>