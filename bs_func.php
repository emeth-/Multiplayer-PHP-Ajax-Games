<?php


function gamestart_option($roomid)
{
	global $db,$ir;
	return "<form method='post' name='gamestart'><input type=hidden name='gamestart' value=1><input type=hidden name='id' value='{$roomid}'>
	<input type='button' value='I am ready, begin the game!' border=0 name='replaybutton' id='replaybutton' onclick=\"postFormAjax('bs_play.php', 'gamestart');return false;\" /></form>";
}

function check_win($roomid)
{
	global $db,$ir;

	$winner = 0;

	$ginf = $db->query("SELECT * FROM bs_game WHERE bs_room = $roomid");
	$gin = $db->fetch_row($ginf);

	$icoppboard1 = explode('|', $gin['p1bo']);
	$icoppboard2 = explode('|', $gin['p2bo']);

	$wincnt1=0;
	$wincnt2=0;
	for($j=0; $j<100; $j++)
	{
		if($icoppboard1[$j]!=-1 && !ctype_digit($icoppboard1[$j])){$wincnt1++;}
		if($icoppboard2[$j]!=-1 && !ctype_digit($icoppboard2[$j])){$wincnt2++;}
	}

	if($wincnt1==17)
		return $gin['p1'];
	if($wincnt2==17)
		return $gin['p2'];

	//Return the winner's userid
	return $winner;
}

function make_move($move, $userid, $roomid)
{
	$move--;
	if(!is_numeric($move)){die();}

	global $db,$ir;
	$game = $db->query("SELECT * FROM bs_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);
	$turn = $ga['turn'];

	if($turn==$userid)
	{
		$ginfo = $db->query("SELECT * FROM bs_game WHERE bs_room=$roomid");
		$gin = $db->fetch_row($ginfo);

		if($gin['p1']==$userid)
		{
			$oppboard = explode('|', $gin['p2b']);
			$icoppboard = explode('|', $gin['p1bo']);
			$boardfield = "p1bo";
		}
		else if($gin['p2']==$userid)
		{
			$oppboard = explode('|', $gin['p1b']);
			$icoppboard = explode('|', $gin['p2bo']);
			$boardfield = "p2bo";
		}
		if($icoppboard[$move] == 0)
		{
			if($oppboard[$move]==0 && ctype_digit($oppboard[$move])){$oppboard[$move]=-1;}
			$icoppboard[$move] = $oppboard[$move];

			$uicoppboard = implode("|", $icoppboard);

			$db->query("UPDATE bs_game SET $boardfield = '$uicoppboard' WHERE bs_room = $roomid");
			$db->query("UPDATE bs_room SET play_time=unix_timestamp() WHERE id=$roomid");
			
			$winner = check_win($roomid);
			if($winner != 0)
				award_win($roomid,$winner);
			else
				toggle_turn($roomid); //only toggle turn if no win yet
		}

	}
}

function draw_board($roomid, $userid, $turn)
{
	global $db,$ir;

	$drawb = $db->query("SELECT * FROM bs_game WHERE bs_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);
	print"<table><tr><td><b>Your Fleet</b><br />";

	//Your Board
	if($draw['p1']==$userid){$whichboard = "p1b";$whichboard2 = "p2bo";}
	if($draw['p2']==$userid){$whichboard = "p2b";$whichboard2 = "p1bo";}
	$board = $draw["$whichboard"];
	$board2 = $draw["$whichboard2"];
	$boardsq = explode("|", $board);
	$board2sq = explode("|", $board2);

	$yourcar = 0;
	$yourbat = 0;
	$yourdest = 0;
	$yoursdest = 0;
	$yourpat = 0;
	//check for sunk ships
	for($i=0; $i<100;$i++)
	{
		if(!ctype_digit($board2sq["$i"]) && $board2sq["$i"]!=-1)
		{
			//hit
			//b1-h|b2-h|b3-h|b4-
			$shiptype = substr($board2sq["$i"], 0, 1); 
			if($shiptype == "c"){$yourcar++;}
			if($shiptype == "b"){$yourbat++;}
			if($shiptype == "d"){$yourdest++;}
			if($shiptype == "s"){$yoursdest++;}
			if($shiptype == "p"){$yourpat++;}
		}
	}
	
	if($yourcar==5){$csunk=1;}
	if($yourbat==4){$bsunk=1;}
	if($yourdest==3){$dsunk=1;}
	if($yoursdest==3){$ssunk=1;}
	if($yourpat==2){$psunk=1;}

	print"<table cellspacing=0 cellpadding=0 border=0><tr>";
	for($i=0; $i<100;$i++)
	{
		$ximage="";
		$mark = $i+1;
		if($board2sq["$i"]==-1 && $draw['gamestart']==-1){$ximage="<img src='images/bs/miss.gif'>";}
		else if(!ctype_digit($board2sq["$i"]) && $draw['gamestart']==-1){$ximage="<img src='images/bs/hit.gif'>";}
		else{$ximage="&nbsp;";}
		if ($boardsq["$i"]==0 && ctype_digit($boardsq["$i"]))
		{

			if($draw['gamestart']==-1)
			{
				print"<td width=16 height=16 style=\"background: url('images/bs/water.gif') no-repeat;font-size:0;\">{$ximage}</td>
";
			}
			else
			{
				print"<td>
				<form method='post' name='water{$mark}'>
				<input type=hidden name='placeship' value='$mark'><input type=hidden name='id' value='{$roomid}'>
				<input type='image' class='sbmult' src=\"images/bs/water.gif\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'water{$mark}');return false;\" />
				</form></td>";
			}
		}
		else
		{
			$spoti = explode("-",$boardsq["$i"]);
			$direction = $spoti['1'];
			$ship = $spoti['0'];
			$type = preg_replace("/[^a-z]/", "", $ship);
			$shipimage = get_ship_image($ship, $direction);
			$sunk = $type."sunk";
			if($$sunk == 1){$ximage="&nbsp;";$shipimage=get_sunk_ship_image($ship, $direction);}
			print "<td width=16 height=16 style=\"background: url('images/bs/$shipimage') no-repeat;font-size:0;\">{$ximage}</td>
";
		}
		if(($i+1) % 10 == 0)
			print "</tr><tr>";

		
	}
	print"</table>";

	if($draw['gamestart']==-1)
	{
		print"</td><td><b>Opponent's Fleet</b><br />";
		//Opponent's Board
		if($draw['p1']==$userid){$whichboard = "p1bo";}
		if($draw['p2']==$userid){$whichboard = "p2bo";}
		$board = $draw["$whichboard"];
		$boardsq = explode("|", $board);

		$oppcar = 0;
		$oppbat = 0;
		$oppdest = 0;
		$oppsdest = 0;
		$opppat = 0;
		//check for sunk ships
		for($i=0; $i<100;$i++)
		{
			if(!ctype_digit($boardsq["$i"]) && $boardsq["$i"]!=-1)
			{
				//hit
				$shiptype = substr($boardsq["$i"], 0, 1); 
				if($shiptype == "c"){$oppcar++;}
				if($shiptype == "b"){$oppbat++;}
				if($shiptype == "d"){$oppdest++;}
				if($shiptype == "s"){$oppsdest++;}
				if($shiptype == "p"){$opppat++;}
			}
		}
		
		if($oppcar==5){$csunko=1;}
		if($oppbat==4){$bsunko=1;}
		if($oppdest==3){$dsunko=1;}
		if($oppsdest==3){$ssunko=1;}
		if($opppat==2){$psunko=1;}


		print"<table cellspacing=0 cellpadding=0 border=0><tr>";
		for($i=0; $i<100;$i++)
		{
			$mark = $i+1;
			if ($boardsq["$i"]==0 && ctype_digit($boardsq["$i"]))
			{
					print"<td>
					<form method='post' name='water{$mark}'>
					<input type=hidden name='move' value='$mark'><input type=hidden name='id' value='{$roomid}'>
					<input type='image' class='sbmult' src=\"images/bs/water.gif\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'water{$mark}');return false;\" />
					</form></td>";
			}
			else if ($boardsq["$i"]==-1)
			{
					print"<td style=\"font-size:0;\"><img src='images/bs/miss.gif'></td>";
			}
			else
			{
				$spoti = explode("-",$boardsq["$i"]);
				$direction = $spoti['1'];
				$ship = $spoti['0'];
				$type = preg_replace("/[^a-z]/", "", $ship);
				$shipimage = get_ship_image($ship, $direction);
				$sunk = $type."sunko";
				if($$sunk == 1)
				{
					$ximage="$nbsp;";$shipimage=get_sunk_ship_image($ship, $direction);
					print "<td style=\"font-size:0;\"><img src='images/bs/".$shipimage."'></td>";
				}
				else
				{
					print "<td style=\"font-size:0;\"><img src='images/bs/hit.gif'></td>";
				}
			}
			if(($i+1) % 10 == 0)
				print "</tr><tr>";
	
			
		}
		print"</table>";
	}
	else
	{

		if($draw['p1']==$userid)
		{
			if($draw['p1ss']=='ch'){$chf = "f";}
			if($draw['p1ss']=='bh'){$bhf = "f";}
			if($draw['p1ss']=='dh'){$dhf = "f";}
			if($draw['p1ss']=='sh'){$shf = "f";}
			if($draw['p1ss']=='ph'){$phf = "f";}
			if($draw['p1ss']=='cv'){$cvf = "f";}
			if($draw['p1ss']=='bv'){$bvf = "f";}
			if($draw['p1ss']=='dv'){$dvf = "f";}
			if($draw['p1ss']=='sv'){$svf = "f";}
			if($draw['p1ss']=='pv'){$pvf = "f";}
		}
		else if($draw['p2']==$userid)
		{
			if($draw['p2ss']=='ch'){$chf = "f";}
			if($draw['p2ss']=='bh'){$bhf = "f";}
			if($draw['p2ss']=='dh'){$dhf = "f";}
			if($draw['p2ss']=='sh'){$shf = "f";}
			if($draw['p2ss']=='ph'){$phf = "f";}
			if($draw['p2ss']=='cv'){$cvf = "f";}
			if($draw['p2ss']=='bv'){$bvf = "f";}
			if($draw['p2ss']=='dv'){$dvf = "f";}
			if($draw['p2ss']=='sv'){$svf = "f";}
			if($draw['p2ss']=='pv'){$pvf = "f";}
		}

		print"</td><td><b>Place Your Fleet</b><br />";

print"<table><tr><td>
<form method='post' name='sship1'>
<input type=hidden name='selectship' value='ch'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/ch{$chf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship1');return false;\" />
</form>
</td></tr><tr><td>";
print"
<form method='post' name='sship2'>
<input type=hidden name='selectship' value='bh'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/bh{$bhf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship2');return false;\" />
</form>
</td></tr><tr><td>";
print"
<form method='post' name='sship3'>
<input type=hidden name='selectship' value='dh'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/dh{$dhf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship3');return false;\" />
</form>
</td></tr><tr><td>";
print"
<form method='post' name='sship4'>
<input type=hidden name='selectship' value='sh'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/dh{$shf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship4');return false;\" />
</form>
</td></tr><tr><td>";
print"
<form method='post' name='sship5'>
<input type=hidden name='selectship' value='ph'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/ph{$phf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship5');return false;\" />
</form>
</td></tr></table>";
		print"<br /><table><tr><td>";
print"
<form method='post' name='sship6'>
<input type=hidden name='selectship' value='cv'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/cv{$cvf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship6');return false;\" />
</form>
</td><td>";
print"
<form method='post' name='sship7'>
<input type=hidden name='selectship' value='bv'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/bv{$bvf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship7');return false;\" />
</form>
</td><td>";
print"
<form method='post' name='sship8'>
<input type=hidden name='selectship' value='dv'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/dv{$dvf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship8');return false;\" />
</form>
</td><td>";
print"
<form method='post' name='sship9'>
<input type=hidden name='selectship' value='sv'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/dv{$svf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship9');return false;\" />
</form>
</td><td>";
print"
<form method='post' name='sship10'>
<input type=hidden name='selectship' value='pv'><input type=hidden name='id' value='{$roomid}'>
<input type='image' class='sbmult' src=\"images/bs/pv{$pvf}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bs_play.php', 'sship10');return false;\" />
</form>
</td><td></tr></table>";
	}

	print"</td></tr></table>";

}


function set_opp_boards($roomid)
{
	global $db,$ir;
	$drawb = $db->query("SELECT p1b,p2b FROM bs_game WHERE bs_room=$roomid");
	if(!$db->num_rows($drawb)){die();}	//game not yet created
	$draw = $db->fetch_row($drawb);
	$blankboard = "0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0";
	$db->query("UPDATE bs_game SET p1bo='$blankboard',p2bo='$blankboard' WHERE bs_room=$roomid");
}
function select_ship($selectship, $userid, $roomid)
{
	global $db,$ir;

	$drawb = $db->query("SELECT p1,p2 FROM bs_game WHERE bs_room=$roomid");
	if(!$db->num_rows($drawb)){die();}	//game not yet created
	$draw = $db->fetch_row($drawb);

	if($selectship == 'ch' || $selectship == 'cv' || $selectship == 'bh'  || $selectship == 'sh'  || $selectship == 'sv' 
		|| $selectship == 'bv' || $selectship == 'dh' || $selectship == 'dv' 
		|| $selectship == 'ph' || $selectship == 'pv')
	{
		if($draw['p1']==$userid)
		{
			$db->query("UPDATE bs_game SET p1ss='$selectship' WHERE bs_room=$roomid");
		}
		if($draw['p2']==$userid)
		{
			$db->query("UPDATE bs_game SET p2ss='$selectship' WHERE bs_room=$roomid");
		}
	}
}

function place_ship($placeship, $userid, $roomid)
{
	global $db,$ir;
	$placeship--;
	$drawb = $db->query("SELECT * FROM bs_game WHERE bs_room=$roomid");
	if(!$db->num_rows($drawb)){die();}	//game not yet created
	$draw = $db->fetch_row($drawb);
	$spot = $placeship;
	if($draw['p1']==$userid)
	{
		$ship = $draw['p1ss'];
		$board = explode("|", $draw['p1b']);
		$boardfield = "p1b";
	}
	if($draw['p2']==$userid)
	{
		$ship = $draw['p2ss'];
		$board = explode("|", $draw['p2b']);
		$boardfield = "p2b";
	}
	$shiptype = substr($ship, 0, 1); 
	$shipdir = substr($ship, 1, 1); 
	$shiplength = get_ship_length($shiptype);


	$i=1;
	$bad=0;
	if($shipdir=='h')
	{
		//test for failure (multiple rows
		$tempshipl = $shiplength;
		$tempspot = $spot;
		$tempcount = 1;

		while($tempshipl > 0)
		{
			$tempshipl--;
			$tempspot++;
			if($tempspot%10==1 && $tempcount!=1){$bad=1;}
			if(!ctype_digit($board[$tempspot-1])){$bad=1;$from=1;}
			$tempcount++;
		}

		//remove duplicate ships from board
		for($j = 0; $j < 100 && !$bad; $j++)
		{
			$spoti = explode("-",$board[$j]);
			$direction = $spoti['1'];
			$ship = $spoti['0'];
			$type = preg_replace("/[^a-z]/", "", $ship);
			if($type == $shiptype)
			{
				//we are replacing this ship
				$board[$j]=0;
			}
		}

		//do it
		while($shiplength > 0 && !$bad)
		{

			$board[$spot]=$shiptype.$i."-".$shipdir;
			$shiplength--;
			$spot++;
			$i++;
		}
		
	}

	if($shipdir=='v')
	{

		//test for failure (multiple rows
		$tempshipl = $shiplength;
		$tempspot = $spot;
		$tempcount = 1;
		while($tempshipl > 0)
		{
			$tempshipl--;
			if(!ctype_digit($board[$tempspot])){$bad=1;}
			$tempspot+=10;
			$tempcount++;
		}

		//remove duplicate ships from board
		for($j = 0; $j < 100 && !$bad; $j++)
		{
			$spoti = explode("-",$board[$j]);
			$direction = $spoti['1'];
			$ship = $spoti['0'];
			$type = preg_replace("/[^a-z]/", "", $ship);
			if($type == $shiptype)
			{
				//we are replacing this ship
				$board[$j]=0;
			}
		}


		//do it
		while($shiplength > 0 && !$bad)
		{

			$board[$spot]=$shiptype.$i."-".$shipdir;
			$shiplength--;
			$spot+=10;
			$i++;
		}
		
	}

	$boardupload = implode("|", $board);
	$db->query("UPDATE bs_game SET {$boardfield}='$boardupload' WHERE bs_room=$roomid");
}

function get_ship_length($shiptype)
{
	if($shiptype == "c")
	{
		return 5;
	}
	if($shiptype == "b")
	{
		return 4;
	}
	if($shiptype == "d")
	{
		return 3;
	}
	if($shiptype == "s")
	{
		return 3;
	}
	if($shiptype == "p")
	{
		return 2;
	}
	return 0;
}
function get_ship_image($ship, $direction)
{
	$type = preg_replace("/[^a-z]/", "", $ship);
	$spot = preg_replace("/[^0-9]/", "", $ship);
	if($type == "c")
	{
		//carrier, use all 5
		$spot = $spot; //this will change for other ships
	}
	if($type == "b")
	{
		//battleship, use 4
		if($spot==4)
			$spot=5;
		else
			$spot = $spot; 
	}
	if($type == "d")
	{
		//destroyer, use 3
		if($spot==3)
			$spot=5;
		else
			$spot = $spot; 
	}
	if($type == "s")
	{
		//second destroyer, use 3
		if($spot==3)
			$spot=5;
		else
			$spot = $spot; 
		$type="d";
	}
	if($type == "p")
	{
		//patrol, use 2
		if($spot==2)
			$spot=5;
		else
			$spot = $spot; 
	}
	return "s".$direction.$spot.".gif";
}

function get_sunk_ship_image($ship, $direction)
{
	$type = preg_replace("/[^a-z]/", "", $ship);
	$spot = preg_replace("/[^0-9]/", "", $ship);
	if($type == "c")
	{
		if($spot==4 || $spot==3 || $spot==2)
			$spot=2;
		if($spot==5)
			$spot=3;
	}
	if($type == "b")
	{
		if($spot==3)
			$spot=2;
		if($spot==4)
			$spot=3;
	}
	if($type == "p")
	{
		if($spot==2)
			$spot=3;
	}
	return "sunk".$direction.$spot.".gif";
}

function create_game($roomid)
{
	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT bs_room FROM bs_game WHERE bs_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM bs_room WHERE id=$roomid"));

		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		$db->query("UPDATE bs_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO bs_game (bs_room, {$firstmovemarkfield}, p1, p2) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']})");
		$blankboard = "c1-h|c2-h|c3-h|c4-h|c5-h|b1-h|b2-h|b3-h|b4-h|0|d1-h|d2-h|d3-h|s1-h|s2-h|s3-h|p1-h|p2-h|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0";
		$db->query("UPDATE bs_game SET p1b='$blankboard',p2b='$blankboard' WHERE bs_room=$roomid");
	}
}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM bs_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE bs_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE bs_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	
}



?>