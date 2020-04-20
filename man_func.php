<?php

function check_win($roomid)
{
	global $db,$ir;

	$winner = 0;

	$ginf = $db->query("SELECT * FROM man_game WHERE man_room = $roomid");
	$gin = $db->fetch_row($ginf);


	if(($gin['b1'] == 0 && $gin['b2'] == 0 && $gin['b3'] == 0 
		&& $gin['b4'] == 0 && $gin['b5'] == 0 && $gin['b6'] == 0) ||
		($gin['b8'] == 0 && $gin['b9'] == 0 && $gin['b10'] == 0 
				&& $gin['b11'] == 0 && $gin['b12'] == 0 && $gin['b13'] == 0))
	{
		$gin['b0'] = $gin['b0'] + $gin['b13'] + $gin['b12'] + $gin['b11'] + $gin['b10'] + $gin['b9'] + $gin['b8'];
		$gin['b7'] = $gin['b7'] + $gin['b6'] + $gin['b5'] + $gin['b4'] + $gin['b3'] + $gin['2'] + $gin['1'];
	
		
		$b0 = $gin['b0']; //player top/left
		$b7 = $gin['b7']; //player bottom/right
	
		$db->query("UPDATE man_game SET b0=$b0,b7=$b7,b1=0,b2=0,b3=0,b4=0,b5=0,b6=0,b8=0,b9=0,b10=0,b11=0,b12=0,b13=0 WHERE man_room=$roomid");

		if($b7 > $b0)
		{
			//bottom wins
			$winner = $gin['bottom'];
		}
		if($b0 > $b7)
		{
			//top wins
			if($gin['bottom']==$gin['p1'])
			{
				$winner = $gin['p2'];
			}
			else
			{
				$winner = $gin['p1'];
			}
		}
		if($b0 == $b7)
		{
			$winner=-1;
		}
	}
	//Return the winner's userid
	return $winner;
}

function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game=$db->query("SELECT * FROM man_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);
	$turn = $ga['turn'];

	if($turn==$userid)
	{
		$ginfo = $db->query("SELECT * FROM man_game WHERE man_room=$roomid");
		$gin = $db->fetch_row($ginfo);
		$movefrom = "b".$move;
		
		//make sure square is not empty
		if($gin["$movefrom"] > 0)
		{
			//make sure square is on their side of the board
			if(($gin['bottom']==$userid && $move > 0 && $move < 7) OR ($gin['bottom']!=$userid && $move > 7 && move < 14))
			{
				$totstones = $gin["$movefrom"];
				$gin["$movefrom"]=0;
				$spot = ($move+1)%14;
				while($totstones>0)
				{
					if(($spot != 7 && $spot != 0) || (($spot==7 && $gin['bottom']==$userid) || $spot==0 && $gin['bottom']!=$userid))
					{
						$totstones--;
						$gin["b".$spot]+=1;
						$finalspot = $spot;
						$spot++;
					}
					if(($spot==7 && $gin['bottom']!=$userid) || ($spot==0 && $gin['bottom']==$userid))
					{
						$spot++;
					}
					$spot = $spot % 14;
				}
				if($finalspot == 0 || $finalspot == 7)
				{
					$notoggle=1;

				}
				if($gin["b".$finalspot]==1 && $finalspot!=0 && $finalspot!=7)
				{
					$oppspot = get_opp($finalspot);
					if($gin["b".$oppspot]>0) //only if seeds in opposite square
					{
						//only if on your side of the board
						if(($finalspot > 0 && $finalspot < 7 && $gin['bottom']==$userid) ||
							($finalspot > 7 && $finalspot < 14 && $gin['bottom']!=$userid))
						{
							$wonstones = 1 + $gin["b".$oppspot];
							if($gin['bottom']==$userid)
							{
								$gin['b7']+=$wonstones;
							}
							if($gin['bottom']!=$userid)
							{
								$gin['b0']+=$wonstones;
							}
							$gin["b".$oppspot] = 0;
							$gin["b".$finalspot] = 0;
						}
					}
				}

				$db->query("UPDATE man_game SET b0={$gin['b0']},b1={$gin['b1']},b2={$gin['b2']},b3={$gin['b3']},b4={$gin['b4']},b5={$gin['b5']},b6={$gin['b6']},b7={$gin['b7']},b8={$gin['b8']},b9={$gin['b9']},b10={$gin['b10']},b11={$gin['b11']},b12={$gin['b12']},b13={$gin['b13']} WHERE man_room=$roomid");
				$db->query("UPDATE man_room SET play_time=unix_timestamp() WHERE id=$roomid");

				$winner = check_win($roomid);
	
				if($winner != 0)
				{
					award_win($roomid,$winner);
				}
				else
				{
					if(!$notoggle)
					{
						toggle_turn($roomid); 
					}
				}

			}
		}

	}
}

function get_opp($spot)
{
	if($spot == 1){return 13;}
	if($spot == 2){return 12;}
	if($spot == 3){return 11;}
	if($spot == 4){return 10;}
	if($spot == 5){return 9;}
	if($spot == 6){return 8;}

	if($spot == 8){return 6;}
	if($spot == 9){return 5;}
	if($spot == 10){return 4;}
	if($spot == 11){return 3;}
	if($spot == 12){return 2;}
	if($spot == 13){return 1;}

	return 0;
}

function draw_board($roomid, $userid, $turn)
{
	global $db,$ir;

	$drawb = $db->query("SELECT * FROM man_game WHERE man_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);
	
	if($draw['bottom'] == $userid){$bb="<b>";$bbe="</b>";}
	if($draw['bottom'] != $userid){$tb="<b>";$tbe="</b>";}

	if($draw['b13']>6){$drawb13=6;}else{$drawb13=$draw['b13'];}
	if($draw['b12']>6){$drawb12=6;}else{$drawb12=$draw['b12'];}
	if($draw['b11']>6){$drawb11=6;}else{$drawb11=$draw['b11'];}
	if($draw['b10']>6){$drawb10=6;}else{$drawb10=$draw['b10'];}
	if($draw['b9']>6){$drawb9=6;}else{$drawb9=$draw['b9'];}
	if($draw['b8']>6){$drawb8=6;}else{$drawb8=$draw['b8'];}

	if($draw['b6']>6){$drawb6=6;}else{$drawb6=$draw['b6'];}
	if($draw['b5']>6){$drawb5=6;}else{$drawb5=$draw['b5'];}
	if($draw['b4']>6){$drawb4=6;}else{$drawb4=$draw['b4'];}
	if($draw['b3']>6){$drawb3=6;}else{$drawb3=$draw['b3'];}
	if($draw['b2']>6){$drawb2=6;}else{$drawb2=$draw['b2'];}
	if($draw['b1']>6){$drawb1=6;}else{$drawb1=$draw['b1'];}
	
	$txt="<center><table BORDER='0' cellpadding=0 cellspacing=0><tr><td align=center width=72 style=\"background: url('images/man/home.png') no-repeat;\"><font size=5><b>{$draw['b0']}</b></font></td><td><table BORDER='0' cellpadding=0 cellspacing=1>";
	
	$txt.="<tr>
	<td><center>{$tb}{$draw['b13']} stones{$tbe}</center><form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb13}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move13');return false;\" /></form></td>
	<td><center>{$tb}{$draw['b12']} stones{$tbe}</center><form method='post' name='move12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb12}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move12');return false;\" /></form></td>
	<td><center>{$tb}{$draw['b11']} stones{$tbe}</center><form method='post' name='move11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb11}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move11');return false;\" /></form></td>
	<td><center>{$tb}{$draw['b10']} stones{$tbe}</center><form method='post' name='move10'><input type=hidden name='move' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb10}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move10');return false;\" /></form></td>
	<td><center>{$tb}{$draw['b9']} stones{$tbe}</center><form method='post' name='move9'><input type=hidden name='move' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb9}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move9');return false;\" /></form></td>
	<td><center>{$tb}{$draw['b8']} stones{$tbe}</center><form method='post' name='move8'><input type=hidden name='move' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb8}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move8');return false;\" /></form></td>
	</tr>";
	
	$txt.="<tr>
	<td><form method='post' name='move1'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb1}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move1');return false;\" /></form><center>{$bb}{$draw['b1']} stones{$bbe}</center></td>
	<td><form method='post' name='move2'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb2}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move2');return false;\" /></form><center>{$bb}{$draw['b2']} stones{$bbe}</center></td>
	<td><form method='post' name='move3'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb3}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move3');return false;\" /></form><center>{$bb}{$draw['b3']} stones{$bbe}</center></td>
	<td><form method='post' name='move4'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb4}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move4');return false;\" /></form><center>{$bb}{$draw['b4']} stones{$bbe}</center></td>
	<td><form method='post' name='move5'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb5}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move5');return false;\" /></form><center>{$bb}{$draw['b5']} stones{$bbe}</center></td>
	<td><form method='post' name='move6'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/man/stone{$drawb6}.jpg\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('man_play.php', 'move6');return false;\" /></form><center>{$bb}{$draw['b6']} stones{$bbe}</center></td>
	</tr>";
	
	
	$txt.="</table></td><td align=center width=72 style=\"background: url('images/man/home.png') no-repeat;\"><font size=5><b>{$draw['b7']}</b></font></td></tr></table></center>";
		
	print $txt;
}

function create_game($roomid)
{
	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT man_room FROM man_game WHERE man_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM man_room WHERE id=$roomid"));

		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		$db->query("UPDATE man_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO man_game (man_room, {$firstmovemarkfield}, p1, p2) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']})");
	}
}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM man_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE man_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE man_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	
}

?>