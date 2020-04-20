<?php
	function draw_board($userid, $gameid, $view=0)
	{
		global $db,$ir;
		if($view==1)
		{
			$drawb = $db->query("SELECT * FROM pp_game WHERE id=$gameid");
		}
		else
		{
			$drawb = $db->query("SELECT * FROM pp_game WHERE id=$gameid AND userid=$userid");
		}

		if(!$db->num_rows($drawb)){die();}//game not yet created
	
		$draw = $db->fetch_row($drawb);
		$board = $draw['layout'];
		$board = explode("/",$board);
		$countLR = $draw['count'];
		
		$countLR = explode("|",$countLR);
		$countL = $countLR[0];
		$countR = $countLR[1];
		
		$spotLR = $draw['spotindeck'];
		$spotLR = explode("|",$spotLR);
		$spotL = $spotLR[0];
		$spotR = $spotLR[1];
		$deck = $draw['deck'];
		$deck = explode("/",$deck);
		
		//card to play
		// style=\"background: url('images/pp/top.jpg') no-repeat;\"
		
		if($draw['gameover']==0)
		{
			$txt="<center><table BORDER='0' cellspacing = '0' cellpadding='0'>";
			$txt.="<tr>";
			while($countL >0)
			{
				$txt .= "<td rowspan=2 valign=top><img src='images/pp/blcard.gif'></td>";
				$countL--;
			}
			$leftcard = $deck["$spotL"];
			$leftcard = explode("|",$leftcard);
			$lcn = $leftcard[0];
			$lcs = $leftcard[1];
			$txt .= "<td>
			<form method='post' name='s1'>
			<input type=hidden name='select' value=1>
			<input type='image' class='sbmult' src=\"images/pp/{$lcs}{$lcn}.gif\" border=0 name='select1b' id='select1b' value='Click' onclick=\"postFormAjax('s_pp_play.php?act=play', 's1');return false;\" />
			</form>
			</td>";

			
			$txt .= "<td rowspan=2><img src='images/pp/space.png'></td>";
			$rightcard = $deck["$spotR"];	
			$rightcard = explode("|",$rightcard);
			$rcn = $rightcard[0];
			$rcs = $rightcard[1];
			
			//$txt .= "<td><form method='post' action='?act=play'><input type=hidden name = 'select' value = 2><input type='image' class='sbmult' src=\"images/pp/{$rcs}{$rcn}.gif\"></form></td>";
			$txt .= "<td>
			<form method='post' name='s2'>
			<input type=hidden name='select' value=2>
			<input type='image' class='sbmult' src=\"images/pp/{$rcs}{$rcn}.gif\" border=0 name='select2b' id='select2b' value='Click' onclick=\"postFormAjax('s_pp_play.php?act=play', 's2');return false;\" />
			</form>
			</td>";
			
			while($countR >0)
			{
				$txt .= "<td rowspan=2 valign=top><img src='images/pp/brcard.gif'></td>";
				$countR--;
			}
			if($draw['cardselect']==1){$csonearr = "<img src='images/pp/arrow.png'>";$cstwoarr = "&nbsp;";}
			else if($draw['cardselect']==2){$cstwoarr = "<img src='images/pp/arrow.png'>";$csonearr = "&nbsp;";}
			$txt.="</tr><tr><td align=center>{$csonearr}</td><td align=center>{$cstwoarr}</td></tr></table></center>";
		}
		// play board
		for($i=1; $i <=25; $i++)
		{
				$array_number = $i-1;
				$spot = "b".$i;
				$Card = $board["$array_number"];
				$CardNS = explode("|",$Card);
				$CardN= $CardNS[0];
				$CardS= $CardNS[1];
				if($CardN == 0 && $CardS == 0)
				{
					//$$spot = "<form method='post' action='?act=play'><input type=hidden name = 'move' value = $i><input type='image' class='sbmult' src=\"images/pp/cardplace.gif\"></form>";
					$$spot = "<form method='post' name='move{$i}'>
					<input type=hidden name='move' value=$i>
					<input type='image' class='sbmult' src=\"images/pp/cardplace.gif\" border=0 name='move{$i}b' id='move{$i}b' value='Click' onclick=\"postFormAjax('s_pp_play.php?act=play', 'move{$i}');return false;\" />
					</form>";
				}
				else{
					//$$spot = "<form method='post' action='?act=play'><input type=hidden name = 'move' value = $i><input type='image' class='sbmult' src=\"images/pp/{$CardS}{$CardN}.gif\"></form>";
					$$spot = "<img src=\"images/pp/{$CardS}{$CardN}.gif\">";
				}	
		}
		$scoreh1 = best_hand($board[0],$board[1],$board[2],$board[3],$board[4]);
		$scoreh2 = best_hand($board[5],$board[6],$board[7],$board[8],$board[9]);
		$scoreh3 = best_hand($board[10],$board[11],$board[12],$board[13],$board[14]);
		$scoreh4 = best_hand($board[15],$board[16],$board[17],$board[18],$board[19]);
		$scoreh5 = best_hand($board[20],$board[21],$board[22],$board[23],$board[24]);
		
		$scorev1 = best_hand($board[0],$board[5],$board[10],$board[15],$board[20]);
		$scorev2 = best_hand($board[1],$board[6],$board[11],$board[16],$board[21]);
		$scorev3 = best_hand($board[2],$board[7],$board[12],$board[17],$board[22]);
		$scorev4 = best_hand($board[3],$board[8],$board[13],$board[18],$board[23]);
		$scorev5 = best_hand($board[4],$board[9],$board[14],$board[19],$board[24]);
		
		$scored2 = best_hand($board[0],$board[6],$board[12],$board[18],$board[24]);
		$scored1 = best_hand($board[4],$board[8],$board[12],$board[16],$board[20]);
		
		$score = array($scoreh1[2],$scoreh2[2],$scoreh3[2],$scoreh4[2],$scoreh5[2],$scorev1[2],$scorev2[2], $scorev3[2],$scorev4[2],$scorev5[2],$scored1[2],$scored2[2]);
		$score = implode("|",$score);
		$db->query("UPDATE pp_game SET score = '$score' WHERE gameover=0 AND userid=$userid");

		if($scoreh1){$scoreh1[2]="(".$scoreh1[2]." points)";}
		if($scoreh2){$scoreh2[2]="(".$scoreh2[2]." points)";}
		if($scoreh3){$scoreh3[2]="(".$scoreh3[2]." points)";}
		if($scoreh4){$scoreh4[2]="(".$scoreh4[2]." points)";}
		if($scoreh5){$scoreh5[2]="(".$scoreh5[2]." points)";}
		if($scorev1){$scorev1[2]="(".$scorev1[2]." points)";}
		if($scorev2){$scorev2[2]="(".$scorev2[2]." points)";}
		if($scorev3){$scorev3[2]="(".$scorev3[2]." points)";}
		if($scorev4){$scorev4[2]="(".$scorev4[2]." points)";}
		if($scorev5){$scorev5[2]="(".$scorev5[2]." points)";}
		if($scored2){$scored2[2]="(".$scored2[2]." points)";}
		if($scored1){$scored1[2]="(".$scored1[2]." points)";}

		// style=\"background: url('images/pp/board.jpg') no-repeat;\"
		$txt.="<center><table BORDER='0' cellspacing = '3' cellpadding='3' height = '500'>";
		$txt.="<tr><td>&nbsp;</td><td>$b1</td><td>$b2</td><td>$b3</td><td>$b4</td><td>$b5</td><td align=center width='70'>$scoreh1[0]<br>$scoreh1[2]</td><td>&nbsp;</td></tr>";
		$txt.="<tr><td>&nbsp;</td><td>$b6</td><td>$b7</td><td>$b8</td><td>$b9</td><td>$b10</td><td align=center width='70'>$scoreh2[0]<br>$scoreh2[2]</td><td>&nbsp;</td></tr>";
		$txt.="<tr><td>&nbsp;</td><td>$b11</td><td>$b12</td><td>$b13</td><td>$b14</td><td>$b15</td><td align=center width='70'>$scoreh3[0]<br>$scoreh3[2]</td><td>&nbsp;</td></tr>";
		$txt.="<tr><td>&nbsp;</td><td>$b16</td><td>$b17</td><td>$b18</td><td>$b19</td><td>$b20</td><td align=center width='70'>$scoreh4[0]<br>$scoreh4[2]</td><td>&nbsp;</td></tr>";
		$txt.="<tr><td>&nbsp;</td><td>$b21</td><td>$b22</td><td>$b23</td><td>$b24</td><td>$b25</td><td align=center width='70'>$scoreh5[0]<br>$scoreh5[2]</td><td>&nbsp;</td></tr>";
		$txt.="<tr><td align=center width='70'>$scored1[0]<br>$scored1[2]</td><td align=center width='70'>$scorev1[0]<br>$scorev1[2]</td><td align=center width='70'>$scorev2[0]<br>$scorev2[2]</td><td align=center width='70'>$scorev3[0]<br>$scorev3[2]</td><td align=center width='70'>$scorev4[0]<br>$scorev4[2]</td><td align=center width='70'>$scorev5[0]<br>$scorev5[2]</td><td align=center width='70'>$scored2[0]<br>$scored2[2]</td></tr>";
		$txt.="</table></center>";

		return $txt;
	}
	function make_move($move,$userid)
	{
		global $db;
		$joshn = $db->query("SELECT * FROM pp_game WHERE gameover=0 AND userid=$userid");
		
		if(!$db->num_rows($joshn)){die();}//game not yet created
		$move--;
		$josh = $db->fetch_row($joshn);
		$board = $josh['layout'];
		$board = explode("/",$board);
	
		if($board["$move"] == "0|0"){
	
		$selectedcard = $josh['cardselect'];
		if($selectedcard == 0){die();}
		$count = $josh['count'];
		$count = explode("|",$count);
		if($selectedcard ==1)
		{
			$count[0]--;
			$count = implode("|",$count);
		}
		else
		{
			$count[1]--;
			$count = implode("|",$count);
		}
		$newspot = $josh['spotindeck'];
		$newspot = explode("|",$newspot);
		if($selectedcard ==1)
		{
			$spot = $newspot[0];
			$newspot[0]+=2;
			$newspot = implode("|",$newspot);
		}
		else
		{
			$spot = $newspot[1];
			$newspot[1]+=2;
			$newspot = implode("|",$newspot);
		}

		$deck = $josh['deck'];
		$deck = explode("/",$deck);
		$cardtoplace = $deck["$spot"];
		$board[$move] = $cardtoplace;
		$board = implode("/",$board);

		$db->query("UPDATE pp_game SET count = '$count', spotindeck = '$newspot', layout = '$board' WHERE gameover=0 AND userid=$userid");
		}
	}
	function setup_game($userid)
	{
		global $db;

		$deck = deck_create();
		$deck = deck_shuffle($deck);
		$deck = implode("/",$deck);

		$count = array("25","25");
		$count = implode("|",$count);

		$spotindeck = array("0","1");
		$spotindeck = implode("|",$spotindeck);
		
		$board = board_create();
		$board = implode("/",$board);

		$db->query("UPDATE pp_game SET deck ='$deck', layout = '$board', count = '$count', spotindeck = '$spotindeck' WHERE gameover=0 AND userid=$userid");
			
	}
	function card_select($select,$userid)
	{
		global $db;
		$db->query("UPDATE pp_game SET cardselect=$select WHERE gameover=0 AND userid=$userid");
	}
	function deck_shuffle($deck)
	{
		$shuffled_deck = array();
		for($i = 0; $i < 52; $i++)
		{
			$card=rand(0,(count($deck)-1));
			$shuffled_deck[$i] = $deck["$card"];
			unset($deck["$card"]);
			rsort($deck);
		}
		return $shuffled_deck;
	}
	function deck_create()
	{
		$deckofcards= array("14|h", "14|c", "14|d", "14|s",
               "2|h", "2|c", "2|d", "2|s",
               "3|h", "3|c", "3|d", "3|s",
               "4|h", "4|c", "4|d", "4|s",
               "5|h", "5|c", "5|d", "5|s",
               "6|h", "6|c", "6|d", "6|s",
               "7|h", "7|c", "7|d", "7|s",
               "8|h", "8|c", "8|d", "8|s",
               "9|h", "9|c", "9|d", "9|s",
               "10|h", "10|c", "10|d", "10|s",
               "11|h", "11|c", "11|d", "11|s",
               "12|h", "12|c", "12|d", "12|s",
               "13|h", "13|c", "13|d", "13|s");
        return $deckofcards;  
	}
	function board_create()
	{
		$boardsetup= array("0|0", "0|0", "0|0", "0|0",
               "0|0", "0|0", "0|0", "0|0",
               "0|0", "0|0", "0|0", "0|0",
               "0|0", "0|0", "0|0", "0|0",
               "0|0", "0|0", "0|0", "0|0",
               "0|0", "0|0", "0|0", "0|0",
               "0|0");
        return $boardsetup;  
	}
	function best_hand($c1,$c2,$c3,$c4,$c5)
	{
		//Global variables
		//point values for each pair, so i can easily update in the future.
			$Royalpoints			=100;
			$Straightflushpoints		=75;
			$Fourpoints			=50;
			$Fullhousepoints		=25;
			$Flushpoints			=20;
			$Straightpoints			=15;
			$Threepoints			=10;
			$Twopairpoints			=5;
			$Pairpoints			=2;

		$c1 = explode("|", $c1);
		$c2 = explode("|", $c2);
		$c3 = explode("|", $c3);
		$c4 = explode("|", $c4);
		$c5 = explode("|", $c5);
		$best = array();
		// return array, best hand (ex two pair) and of what (ex 2's and 4's) amount of points it is worth
		//royal flush
		if($c1[1] == $c2[1] && $c2[1] == $c3[1] && $c3[1] == $c4[1] && $c4[1] == $c5[1] && $c1[0]!=0)
		{
			$straight = array("{$c1[0]}","{$c2[0]}","{$c3[0]}","{$c4[0]}","{$c5[0]}");
			sort($straight);
			if((($straight[0]+1) == $straight[1]) && (($straight[1]+1) == $straight[2]) && (($straight[2]+1) == $straight[3]) && (($straight[3]+1) == $straight[4]) && $straight[0]!=0)
			{
				if($straight[4] == 14)
				{
				$best[0] = "Royal Flush";	
				$best[1] = $c5[0];						//value of the pair
				$best[2] = $Royalpoints; 				//amount of points it is worth
				return $best;
				}
			}
		}
		//Straight Flush
		if($c1[1] == $c2[1] && $c2[1] == $c3[1] && $c3[1] == $c4[1] && $c4[1] == $c5[1] && $c1[0]!=0)
		{
			//Straight Ace high
			$straight = array("{$c1[0]}","{$c2[0]}","{$c3[0]}","{$c4[0]}","{$c5[0]}");
			sort($straight);
			if((($straight[0]+1) == $straight[1]) && (($straight[1]+1) == $straight[2]) && (($straight[2]+1) == $straight[3]) && (($straight[3]+1) == $straight[4]) && $straight[0]!=0)
			{
				$best[0] = "Straight flush to " .num_to_name($straight[4]);	
				$best[1] = $straight[4];			//value of the pair
				$best[2] = $Straightflushpoints; 						//amount of points it is worth
				return $best;
			}
			//Straight Ace low
			$straight = array("{$c1[0]}","{$c2[0]}","{$c3[0]}","{$c4[0]}","{$c5[0]}");
			if($c1[0] == 14){$straight[0] = 1;}
			if($c2[0] == 14){$straight[1] = 1;}
			if($c3[0] == 14){$straight[2] = 1;}
			if($c4[0] == 14){$straight[3] = 1;}
			if($c5[0] == 14){$straight[4] = 1;}
			sort($straight);
			if((($straight[0]+1) == $straight[1]) && (($straight[1]+1) == $straight[2]) && (($straight[2]+1) == $straight[3]) && (($straight[3]+1) == $straight[4]) && $straight[0]!=0)
			{
				$best[0] = "Straight flush to " .num_to_name($straight[4]);	
				$best[1] = $straight[4];				//value of the pair
				$best[2] = $Straightflushpoints; 						//amount of points it is worth
				return $best;
			}
		}
		//Four of a Kind
		if(	(($c1[0] == $c2[0] && $c1[0] == $c3[0] && $c1[0] == $c4[0]) || ($c1[0] == $c2[0] && $c1[0] == $c3[0] && $c1[0] == $c5[0]) || ($c1[0] == $c2[0] && $c1[0] == $c4[0] && $c1[0] == $c5[0]) || ($c1[0] == $c3[0] && $c1[0] == $c4[0] && $c1[0] == $c5[0])) && $c1[0]!=0)
		{
			$best[0] = "Four " .num_to_name($c1[0]) . "'s";	
			$best[1] = "$c1[0]";							//Four of a Kind
			$best[2] = $Fourpoints; 						//amount of points it is worth
			return $best;
		}
		if(($c2[0] == $c3[0] && $c2[0] == $c4[0] && $c2[0] == $c5[0]) && $c2[0]!=0)
		{
			$best[0] = "Four " .num_to_name($c2[0]) . "'s";		
			$best[1] = "$c2[0]";							//Four of a kind
			$best[2] = $Fourpoints; 						//amount of points it is worth
			return $best;
		}
		//Full House
		if($c1[0] == $c2[0] && $c1[0] == $c3[0] && $c1[0]!=0) 
		{
			if($c4[0] == $c5[0] && $c4[0]!=0) 
			{
				$best[0] = "Full House";	
				$best[1] = "{$c1[0]} | {$c4[0]}";				// numbers full of numbers
				$best[2] = $Fullhousepoints; 					//amount of points it is worth
				return $best;
			}
		}
		if($c1[0] == $c3[0] && $c1[0] == $c4[0] && $c1[0]!=0)
		{
			if($c2[0] == $c5[0] && $c2[0]!=0) 
			{
				$best[0] = "Full House";	
				$best[1] = "{$c1[0]} | {$c2[0]}";				// numbers full of numbers
				$best[2] = $Fullhousepoints; 					//amount of points it is worth
				return $best;
			}
		}
		if($c1[0] == $c4[0] && $c1[0] == $c5[0] && $c1[0]!=0)
		{
			if($c2[0] == $c3[0] && $c2[0]!=0) 
			{
				$best[0] = "Full House";	
				$best[1] = "{$c1[0]} | {$c2[0]}";				// numbers full of numbers
				$best[2] = $Fullhousepoints; 					//amount of points it is worth
				return $best;
			}
		}
		if($c1[0] == $c4[0] && $c1[0] == $c2[0] && $c1[0]!=0)
		{
			if($c3[0] == $c5[0] && $c3[0]!=0) 
			{
				$best[0] = "Full House";	
				$best[1] = "{$c1[0]} | {$c3[0]}";				// numbers full of numbers
				$best[2] = $Fullhousepoints; 					//amount of points it is worth
				return $best;
			}
		}
		if($c1[0] == $c2[0] && $c1[0] == $c5[0] && $c1[0]!=0)
		{
			if($c3[0] == $c4[0] && $c3[0]!=0) 
			{
				$best[0] = "Full House";	
				$best[1] = "{$c1[0]} | {$c4[0]}";				// numbers full of numbers
				$best[2] = $Fullhousepoints; 					//amount of points it is worth
				return $best;
			}
		}
		if($c1[0] == $c3[0] && $c1[0] == $c5[0] && $c1[0]!=0)
		{
			if($c2[0] == $c4[0] && $c4[0]!=0) 
			{
				$best[0] = "Full House";	
				$best[1] = "{$c1[0]} | {$c4[0]}";				// numbers full of numbers
				$best[2] = $Fullhousepoints; 					//amount of points it is worth
				return $best;
			}
		}
		if($c2[0] == $c3[0] && $c2[0] == $c4[0] && $c2[0]!=0)
		{
			if($c1[0] == $c5[0] && $c1[0]!=0) 
			{
				$best[0] = "Full House";	
				$best[1] = "{$c2[0]} | {$c1[0]}";				// numbers full of numbers
				$best[2] = $Fullhousepoints; 					//amount of points it is worth
				return $best;
			}
		}
		if($c2[0] == $c4[0] && $c2[0] == $c5[0] && $c2[0]!=0)
		{
			if($c1[0] == $c3[0] && $c1[0]!=0) 
			{
			$best[0] = "Full House";	
			$best[1] = "{$c2[0]} | {$c1[0]}";				// numbers full of numbers
			$best[2] = $Fullhousepoints; 					//amount of points it is worth
			return $best;
			}
		}
		if($c2[0] == $c3[0] && $c2[0] == $c5[0] && $c2[0]!=0)
		{
			if($c1[0] == $c4[0] && $c4[0]!=0) 
			{
			$best[0] = "Full House";	
			$best[1] = "{$c2[0]} | {$c1[0]}";				// numbers full of numbers
			$best[2] = $Fullhousepoints; 					//amount of points it is worth
			return $best;
			}
		}
		if($c3[0] == $c4[0] && $c3[0] == $c5[0] && $c3[0]!=0)
		{
			if($c1[0] == $c2[0] && $c1[0]!=0) 
			{
			$best[0] = "Full House";	
			$best[1] = "{$c3[0]} | {$c1[0]}";				// numbers full of numbers
			$best[2] = $Fullhousepoints; 					//amount of points it is worth
			return $best;
			}
		}
		//Flush
		if($c1[1] == $c2[1] && $c2[1] == $c3[1] && $c3[1] == $c4[1] && $c4[1] == $c5[1] && $c1[0]!=0)
		{
			$best[0] = "Flush";	
			$best[1] = "$c1[1]";				//suit of flush
			$best[2] = $Flushpoints; 						//amount of points it is worth
			return $best;
		}
		//Straight Ace high
		$straight = array("{$c1[0]}","{$c2[0]}","{$c3[0]}","{$c4[0]}","{$c5[0]}");
		sort($straight);
		if((($straight[0]+1) == $straight[1]) && (($straight[1]+1) == $straight[2]) && (($straight[2]+1) == $straight[3]) && (($straight[3]+1) == $straight[4]) && $straight[0]!=0)
		{
			$best[0] = "Straight to " .num_to_name($straight[4]);	
			$best[1] = $c5[0];					//value of the pair
			$best[2] = $Straightpoints;						//amount of points it is worth
			return $best;
		}
		//Straight Ace low
		$straight = array("{$c1[0]}","{$c2[0]}","{$c3[0]}","{$c4[0]}","{$c5[0]}");
		if($c1[0] == 14){$straight[0] = 1;}
		if($c2[0] == 14){$straight[1] = 1;}
		if($c3[0] == 14){$straight[2] = 1;}
		if($c4[0] == 14){$straight[3] = 1;}
		if($c5[0] == 14){$straight[4] = 1;}
		sort($straight);
		if((($straight[0]+1) == $straight[1]) && (($straight[1]+1) == $straight[2]) && (($straight[2]+1) == $straight[3]) && (($straight[3]+1) == $straight[4]) && $straight[0]!=0)
		{
			$best[0] = "Straight to " .num_to_name($straight[4]);	
			$best[1] = $straight[4];				//value of the pair
			$best[2] = $Straightpoints; 						//amount of points it is worth
			return $best;
		}

		//Three of a kind
		if(	(($c1[0] == $c2[0] && $c1[0] == $c3[0]) || ($c1[0] == $c3[0] && $c1[0] == $c4[0]) || ($c1[0] == $c4[0] && $c1[0] == $c5[0]) || ($c1[0] == $c4[0] && $c1[0] == $c2[0]) || ($c1[0] == $c2[0] && $c1[0] == $c5[0]) || ($c1[0] == $c3[0] && $c1[0] == $c5[0])) && $c1[0]!=0)
		{
			$best[0] = "Three " .num_to_name($c1[0]) . "'s";	
			$best[1] = $c1[0];					//value of the pair
			$best[2] = $Threepoints; 						//amount of points it is worth
			return $best;
		}
		if(	(($c2[0] == $c3[0] && $c2[0] == $c4[0]) || ($c2[0] == $c4[0] && $c2[0] == $c5[0]) || ($c2[0] == $c3[0] && $c2[0] == $c5[0])) && $c2[0]!=0)
		{
			$best[0] = "Three " .num_to_name($c2[0]) . "'s";	
			$best[1] = $c2[0];					//value of the pair
			$best[2] = $Threepoints; 						//amount of points it is worth
			return $best;
		}
		if(	($c3[0] == $c4[0] && $c3[0] == $c5[0]) && $c3[0]!=0)
		{
			$best[0] = "Three " .num_to_name($c3[0]) . "'s";	
			$best[1] = $c3[0];					//value of the pair
			$best[2] = $Threepoints; 						//amount of points it is worth
			return $best;
		}
		//Two pair
		if(($c1[0] == $c2[0] || $c1[0] == $c3[0] || $c1[0] == $c4[0] || $c1[0] == $c5[0]) && $c1[0]!=0)
		{
			if(($c2[0] == $c3[0] || $c2[0] == $c4[0] || $c2[0] == $c5[0]) && $c2[0]!=0)
			{
				$best[0] = "Two pair ". num_to_name($c1[0]) . "'s and ".num_to_name($c2[0])."'s";
				$best[1] = "{$c1[0]} |{$c3[0]}";	//value of the pairs
				$best[2] = $Twopairpoints; 						//amount of points it is worth
				return $best;
			}
			if(($c3[0] == $c4[0] || $c3[0] == $c5[0]) && $c3[0]!=0)
			{
				$best[0] = "Two pair ". num_to_name($c1[0]) . "'s and ".num_to_name($c3[0])."'s";
				$best[1] = "{$c1[0]} |{$c3[0]}";	//value of the pairs
				$best[2] = $Twopairpoints; 						//amount of points it is worth
				return $best;
			}
			if($c4[0] == $c5[0] && $c4[0]!=0)
			{
				$best[0] = "Two pair ". num_to_name($c1[0]) . "'s and ".num_to_name($c4[0]) ."'s";
				$best[1] = "{$c1[0]} |{$c4[0]}";	//value of the pair
				$best[2] = $Twopairpoints; 						//amount of points it is worth
				return $best;
			}
		}
		if(($c2[0] == $c3[0] || $c2[0] == $c4[0] || $c2[0] == $c5[0]) && $c2[0]!=0)
		{
			if($c4[0] == $c5[0] && $c4[0]!=0)
			{
				$best[0] = "Two pair ". num_to_name($c2[0]) . "'s and ".num_to_name($c4[0]) ."'s";
				$best[1] = "{$c2[0]} |{$c4[0]}";													//value of the pair
				$best[2] = $Twopairpoints; 															//amount of points it is worth
				return $best;		
			}
		}
	//Pair
		if(($c1[0] == $c2[0] || $c1[0] == $c3[0] || $c1[0] == $c4[0] || $c1[0] == $c5[0]) && ($c1[0] !=0))
		{
			$best[0] = "A pair of ".num_to_name($c1[0])."'s";	
			$best[1] = $c1[0];		//value of the pair
			$best[2] = $Pairpoints; 			//amount of points it is worth
			return $best;
		}
		if(($c2[0] == $c3[0] || $c2[0] == $c4[0] || $c2[0] == $c5[0]) && $c2[0] !=0)
		{
			$best[0] = "A pair of ".num_to_name($c2[0])."'s";	
			$best[1] = $c2[0];		//value of the pair
			$best[2] = $Pairpoints; 			//amount of points it is worth
			return $best;
		}
		if(($c3[0] == $c4[0] || $c3[0] == $c5[0]) && $c3[0] !=0)
		{
			$best[0] = "A pair of ".num_to_name($c3[0])."'s";	
			$best[1] = $c3[0];		//value of the pair
			$best[2] = $Pairpoints; 			//amount of points it is worth
			return $best;
		}
		if(($c4[0] == $c5[0]) && $c4[0] !=0)
		{
			$best[0] = "A pair of ".num_to_name($c4[0])."'s";	
			$best[1] = $c4[0];		//value of the pair
			$best[2] = $Pairpoints; 			//amount of points it is worth
			return $best;
		}
	}
function num_to_name($num)
{
	switch($num)
	{
		case 11:
			$num = "Jacks";
			break;
		case 12:
			$num = "Queen";
			break;
		case 13:
			$num = "King";
			break;
		case 14:
			$num = "Ace";
			break;
		case 1:
			$num = "Ace";
			break;
	}
	return $num;
}
function check_win($userid)
{
	global $db;
		
	$mudd = $db->query("SELECT * FROM pp_game WHERE gameover=0 AND userid=$userid");
	if(!$db->num_rows($mudd)){die();}//game not yet created

	$mud = $db->fetch_row($mudd);
	$score2 = $mud['score'];
	$score = explode("|",$score2);
	
	$board = $mud['layout'];
	$board = explode("/",$board);
	
	$finished = 1;
	
	for($i=0; $i < 25; $i++)
	{
		$value = $board[$i];
		$value = explode("|",$value);
		if($value[0] == 0)
		{
			$finished = 0;
		}
	}
	if($finished == 1)
	{
		//re-update scores
		$scoreh1 = best_hand($board[0],$board[1],$board[2],$board[3],$board[4]);
		$scoreh2 = best_hand($board[5],$board[6],$board[7],$board[8],$board[9]);
		$scoreh3 = best_hand($board[10],$board[11],$board[12],$board[13],$board[14]);
		$scoreh4 = best_hand($board[15],$board[16],$board[17],$board[18],$board[19]);
		$scoreh5 = best_hand($board[20],$board[21],$board[22],$board[23],$board[24]);
		
		$scorev1 = best_hand($board[0],$board[5],$board[10],$board[15],$board[20]);
		$scorev2 = best_hand($board[1],$board[6],$board[11],$board[16],$board[21]);
		$scorev3 = best_hand($board[2],$board[7],$board[12],$board[17],$board[22]);
		$scorev4 = best_hand($board[3],$board[8],$board[13],$board[18],$board[23]);
		$scorev5 = best_hand($board[4],$board[9],$board[14],$board[19],$board[24]);
		
		$scored2 = best_hand($board[0],$board[6],$board[12],$board[18],$board[24]);
		$scored1 = best_hand($board[4],$board[8],$board[12],$board[16],$board[20]);
		
		$score = array($scoreh1[2],$scoreh2[2],$scoreh3[2],$scoreh4[2],$scoreh5[2],$scorev1[2],$scorev2[2], $scorev3[2],$scorev4[2],$scorev5[2],$scored1[2],$scored2[2]);
		for($i=0; $i < 12; $i++)
		{
			$finalscore += $score[$i];
		}
		$db->query("UPDATE pp_game SET gameover=1, score = $finalscore WHERE gameover=0 AND userid=$userid");
		return $finalscore;
	}
	return 0;
}
?>