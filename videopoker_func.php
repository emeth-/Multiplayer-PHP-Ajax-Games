<?php

function find_winnings($score, $score2)
{
	global $db;
	if(intval($score)==1) //high card
	{
		return 0;
	}
	else if(intval($score)==2) //pair
	{
		if(intval($score2)>=11)	//jacks or better
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	else if(intval($score)==3) //two pair
	{
		return 2;
	}
	else if(intval($score)==4) //three of a kind
	{
		return 3;
	}
	else if(intval($score)==5) //straight
	{
		return 4;
	}
	else if(intval($score)==6) //flush
	{
		return 6;
	}
	else if(intval($score)==7) //full house
	{
		return 9;
	}
	else if(intval($score)==8) //four of a kind
	{
		return 25;
	}
	else if(intval($score)==9) //straight flush
	{
		return 50;
	}
	else if(intval($score)==10) //royal flush
	{
		return 250;
	}
}

function replace_card($whichcard, $user)
{
	global $db;
	$pcr=$db->query("SELECT * FROM videopoker WHERE userid='$user'", $c) or die(mysql_error());
	$cc=mysql_fetch_assoc($pcr);
	if($whichcard == 1)
	{
		if($cc['c6n']!=0)
		{
			$db->query("UPDATE videopoker SET c1n={$cc['c6n']}, c1s='{$cc['c6s']}', c6n=0 WHERE userid='$user'");
		}	
		else if($cc['c7n']!=0)
		{
			$db->query("UPDATE videopoker SET c1n={$cc['c7n']}, c1s='{$cc['c7s']}', c7n=0 WHERE userid='$user'");
		}	
		else if($cc['c8n']!=0)
		{
			$db->query("UPDATE videopoker SET c1n={$cc['c8n']}, c1s='{$cc['c8s']}', c8n=0 WHERE userid='$user'");
		}	
		else if($cc['c9n']!=0)
		{
			$db->query("UPDATE videopoker SET c1n={$cc['c9n']}, c1s='{$cc['c9s']}', c9n=0 WHERE userid='$user'");
		}	
		else if($cc['c10n']!=0)
		{
			$db->query("UPDATE videopoker SET c1n={$cc['c10n']}, c1s='{$cc['c10s']}', c10n=0 WHERE userid='$user'");
		}	
	}
	if($whichcard == 2)
	{
		if($cc['c6n']!=0)
		{
			$db->query("UPDATE videopoker SET c2n={$cc['c6n']}, c2s='{$cc['c6s']}', c6n=0 WHERE userid='$user'");
		}	
		else if($cc['c7n']!=0)
		{
			$db->query("UPDATE videopoker SET c2n={$cc['c7n']}, c2s='{$cc['c7s']}', c7n=0 WHERE userid='$user'");
		}	
		else if($cc['c8n']!=0)
		{
			$db->query("UPDATE videopoker SET c2n={$cc['c8n']}, c2s='{$cc['c8s']}', c8n=0 WHERE userid='$user'");
		}	
		else if($cc['c9n']!=0)
		{
			$db->query("UPDATE videopoker SET c2n={$cc['c9n']}, c2s='{$cc['c9s']}', c9n=0 WHERE userid='$user'");
		}	
		else if($cc['c10n']!=0)
		{
			$db->query("UPDATE videopoker SET c2n={$cc['c10n']}, c2s='{$cc['c10s']}', c10n=0 WHERE userid='$user'");
		}	
	}
	if($whichcard == 3)
	{
		if($cc['c6n']!=0)
		{
			$db->query("UPDATE videopoker SET c3n={$cc['c6n']}, c3s='{$cc['c6s']}', c6n=0 WHERE userid='$user'");
		}	
		else if($cc['c7n']!=0)
		{
			$db->query("UPDATE videopoker SET c3n={$cc['c7n']}, c3s='{$cc['c7s']}', c7n=0 WHERE userid='$user'");
		}	
		else if($cc['c8n']!=0)
		{
			$db->query("UPDATE videopoker SET c3n={$cc['c8n']}, c3s='{$cc['c8s']}', c8n=0 WHERE userid='$user'");
		}	
		else if($cc['c9n']!=0)
		{
			$db->query("UPDATE videopoker SET c3n={$cc['c9n']}, c3s='{$cc['c9s']}', c9n=0 WHERE userid='$user'");
		}	
		else if($cc['c10n']!=0)
		{
			$db->query("UPDATE videopoker SET c3n={$cc['c10n']}, c3s='{$cc['c10s']}', c10n=0 WHERE userid='$user'");
		}	
	}
	if($whichcard == 4)
	{
		if($cc['c6n']!=0)
		{
			$db->query("UPDATE videopoker SET c4n={$cc['c6n']}, c4s='{$cc['c6s']}', c6n=0 WHERE userid='$user'");
		}	
		else if($cc['c7n']!=0)
		{
			$db->query("UPDATE videopoker SET c4n={$cc['c7n']}, c4s='{$cc['c7s']}', c7n=0 WHERE userid='$user'");
		}	
		else if($cc['c8n']!=0)
		{
			$db->query("UPDATE videopoker SET c4n={$cc['c8n']}, c4s='{$cc['c8s']}', c8n=0 WHERE userid='$user'");
		}	
		else if($cc['c9n']!=0)
		{
			$db->query("UPDATE videopoker SET c4n={$cc['c9n']}, c4s='{$cc['c9s']}', c9n=0 WHERE userid='$user'");
		}	
		else if($cc['c10n']!=0)
		{
			$db->query("UPDATE videopoker SET c4n={$cc['c10n']}, c4s='{$cc['c10s']}', c10n=0 WHERE userid='$user'");
		}	
	}
	if($whichcard == 5)
	{
		if($cc['c6n']!=0)
		{
			$db->query("UPDATE videopoker SET c5n={$cc['c6n']}, c5s='{$cc['c6s']}', c6n=0 WHERE userid='$user'");
		}	
		else if($cc['c7n']!=0)
		{
			$db->query("UPDATE videopoker SET c5n={$cc['c7n']}, c5s='{$cc['c7s']}', c7n=0 WHERE userid='$user'");
		}	
		else if($cc['c8n']!=0)
		{
			$db->query("UPDATE videopoker SET c5n={$cc['c8n']}, c5s='{$cc['c8s']}', c8n=0 WHERE userid='$user'");
		}	
		else if($cc['c9n']!=0)
		{
			$db->query("UPDATE videopoker SET c5n={$cc['c9n']}, c5s='{$cc['c9s']}', c9n=0 WHERE userid='$user'");
		}	
		else if($cc['c10n']!=0)
		{
			$db->query("UPDATE videopoker SET c5n={$cc['c10n']}, c5s='{$cc['c10s']}', c10n=0 WHERE userid='$user'");
		}	
	}
}

function show_cards($user, $type)
{
	global $db,$ir;
	$pcr=$db->query("SELECT * FROM videopoker WHERE userid='$user'", $c) or die(mysql_error());
	$pcr2=mysql_fetch_assoc($pcr);

	$c1=$pcr2['c1n'];
	$c2=$pcr2['c1s'];
	$c3=$pcr2['c2n'];
	$c4=$pcr2['c2s'];
	$c5=$pcr2['c3n'];
	$c6=$pcr2['c3s'];
	$c7=$pcr2['c4n'];
	$c8=$pcr2['c4s'];
	$c9=$pcr2['c5n'];
	$c10=$pcr2['c5s'];
	$card1=return_cardpic($c1, $c2);
	$card2=return_cardpic($c3, $c4);
	$card3=return_cardpic($c5, $c6);
	$card4=return_cardpic($c7, $c8);
	$card5=return_cardpic($c9, $c10);
	if($type==1)
	{
		$firstfivecards="<form action=videopoker.php?act=draw method=post><table>
		<tr><td align=center>$card1<br /><input type='checkbox' name='hold1' value=true><br />Hold?
		</td><td align=center>$card2<br /><input type='checkbox' name='hold2' value=true><br />Hold?
		</td><td align=center>$card3<br /><input type='checkbox' name='hold3' value=true><br />Hold?
		</td><td align=center>$card4<br /><input type='checkbox' name='hold4' value=true><br />Hold?
		</td><td align=center>$card5<br /><input type='checkbox' name='hold5' value=true><br />Hold?
		</td></tr></table><input type=submit value='Discard and Draw'></form>";
	}
	else
	{
		$firstfivecards="<table>
		<tr><td align=center>$card1
		</td><td align=center>$card2
		</td><td align=center>$card3
		</td><td align=center>$card4
		</td><td align=center>$card5
		</td></tr></table>
		<form action=videopoker.php?act=newdeal&bet={$pcr2['betAmount']} method=post>
		<input type=submit value='New Deal'></form>";
	}
	return $firstfivecards;
}

function deal_cards($userid, $betamt)
{
	global $db,$ir;
	$alreadyplaying=$db->num_rows($db->query("SELECT * FROM videopoker WHERE userid='$userid'"));
	if(!$alreadyplaying)
	{
		srand(time());
		$_SESSION['blankcard']="<img src='images/cards/blankcard.gif'>";
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
		$card=rand(1,52);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c1n=intval($cardvals[0]);//$c1n=3;
		$c1s="{$cardvals[1]}";//$c1s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,51);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c2n=intval($cardvals[0]);//$c2n=4;
		$c2s="{$cardvals[1]}";//$c2s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,50);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c3n=intval($cardvals[0]);//$c3n=5;
		$c3s="{$cardvals[1]}";//$c3s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,49);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c4n=intval($cardvals[0]);//$c4n=6;
		$c4s="{$cardvals[1]}";//$c4s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,48);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c5n=intval($cardvals[0]);//$c5n=7;
		$c5s="{$cardvals[1]}";//$c5s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,47);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c6n=intval($cardvals[0]);
		$c6s="{$cardvals[1]}";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,46);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c7n=intval($cardvals[0]);
		$c7s="{$cardvals[1]}";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,45);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c8n=intval($cardvals[0]);
		$c8s="{$cardvals[1]}";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,44);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c9n=intval($cardvals[0]);
		$c9s="{$cardvals[1]}";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,43);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c10n=intval($cardvals[0]);
		$c10s="{$cardvals[1]}";
		unset($deckofcards["$card"]);rsort($deckofcards);
		
		mysql_query("INSERT INTO videopoker VALUES('', '$userid', $betamt, $c1n, '$c1s', $c2n, '$c2s', $c3n, '$c3s', $c4n, '$c4s', $c5n, '$c5s', $c6n, '$c6s', $c7n, '$c7s', $c8n, '$c8s', $c9n, '$c9s', $c10n, '$c10s')") or die(mysql_error());
	}
}
function return_cardpic($num, $suit)
{
	if($num==11){$num="jack";}
	if($num==12){$num="queenof";}
	if($num==13){$num="king";}
	if($num==1 || $num==14){$num="ace";}
	if($suit=="d"){$suit="diamonds";}
	if($suit=="c"){$suit="clubs";}
	if($suit=="s"){$suit="spades";}
	if($suit=="h"){$suit="hearts";}
	$cardlink="<img src='images/cards/".$num.$suit.".gif'>";
	return $cardlink;
}
function num_2_name($num)
{

	global $db,$ir;
	if($num==11){$num="Jack";}
	if($num==12){$num="Queen";}
	if($num==13){$num="King";}
	if($num==1 || $num==14){$num="Ace";}
	return $num;
}
function num_to_suit($num)
{
	if($num==1){$suit="d";}
	if($num==2){$suit="c";}
	if($num==3){$suit="s";}
	if($num==4){$suit="h";}
	return $suit;
}
function calc_score($uid)
{
	global $db,$ir;
	$lp=$db->query("SELECT * FROM videopoker WHERE userid='$uid'", $c) or die(mysql_error());
	$pcr2=mysql_fetch_assoc($lp);
	$c1n=$pcr2['c1n'];
	$c1s=$pcr2['c1s'];
	$c2n=$pcr2['c2n'];
	$c2s=$pcr2['c2s'];
	$c3n=$pcr2['c3n'];
	$c3s=$pcr2['c3s'];
	$c4n=$pcr2['c4n'];
	$c4s=$pcr2['c4s'];
	$c5n=$pcr2['c5n'];
	$c5s=$pcr2['c5s'];
	/*$t1=$yc[0];$c1n=$pcr2['c1n'];
	$t1=$yc[1];$c1s=$pcr2[$t1];
	$t1=$yc[2];$c2n=$pcr2[$t1];
	$t1=$yc[3];$c2s=$pcr2[$t1];
	$t1=$yc[4];$ac1n=$pcr2[$t1];
	$t1=$yc[5];$ac1s=$pcr2[$t1];
	$t1=$yc[6];$ac2n=$pcr2[$t1];
	$t1=$yc[7];$ac2s=$pcr2[$t1];
	$t1=$yc[8];$ac3n=$pcr2[$t1];
	$t1=$yc[9];$ac3s=$pcr2[$t1];
	$t1=$yc[10];$ac4n=$pcr2[$t1];
	$t1=$yc[11];$ac4s=$pcr2[$t1];
	$t1=$yc[12];$ac5n=$pcr2[$t1];
	$t1=$yc[13];$ac5s=$pcr2[$t1];*/
	/****************
	**Three of a kind
	*****************/
	if(($c1n==$c2n && $c2n==$c3n) || ($c1n==$c2n && $c2n==$c4n) || ($c1n==$c2n && $c2n==$c5n)){$threeofkind=$c1n;}
	if(($c1n==$c3n && $c3n==$c4n) || ($c1n==$c3n && $c3n==$c5n)){$threeofkind=$c1n;}
	if($c1n==$c4n && $c4n==$c5n){$threeofkind=$c1n;}
	if(($c2n==$c3n && $c3n==$c4n) || ($c2n==$c3n && $c3n==$c5n)){$threeofkind=$c2n;}
	if($c2n==$c4n && $c4n==$c5n){$threeofkind=$c2n;}
	if($c3n==$c4n && $c4n==$c5n){$threeofkind=$c3n;}
	
	$threeokna=num_2_name($threeofkind);
	if($threeofkind!=0){$score[0]="Three-of-a-kind in ".$threeokna."'s";$score[1]=4;$score[2]=$threeofkind;}
	
	/********************
	**End three of a kind
	*********************/
	
	/****************
	**Four of a kind
	*****************/
	if($c1n==$c2n && $c2n==$c3n && $c3n==$c4n){$fourofkind=$c1n;}
	if($c1n==$c2n && $c2n==$c3n && $c3n==$c5n){$fourofkind=$c1n;}
	if($c1n==$c2n && $c2n==$c4n && $c4n==$c5n){$fourofkind=$c1n;}
	if($c1n==$c3n && $c3n==$c4n && $c4n==$c5n){$fourofkind=$c1n;}
	if($c2n==$c3n && $c3n==$c4n && $c4n==$c5n){$fourofkind=$c2n;}
	
	$fourofkindna=num_2_name($fourofkind);
	if($fourofkind){$score[0]="Four-of-a-kind in ".$fourofkindna."'s";$score[1]=8;$score[2]=$fourofkind;}
	
	/********************
	**End four of a kind
	*********************/
	
	/*******Pair checks******
	***Check for pairs, two-pairs
	*************************/
	if($threeofkind!=$c1n && $threeofkind2!= $c1n && $fourofkind!= $c1n && $c1n==$c2n){$pair=$c1n;}
	if($threeofkind!=$c1n && $threeofkind2!= $c1n && $fourofkind!= $c1n && $c1n==$c3n){if(!$pair){$pair=$c1n;}else{$pair2=$c1n;}}
	if($threeofkind!=$c1n && $threeofkind2!= $c1n && $fourofkind!= $c1n && $c1n==$c4n){if(!$pair){$pair=$c1n;}else{$pair2=$c1n;}}
	if($threeofkind!=$c1n && $threeofkind2!= $c1n && $fourofkind!= $c1n && $c1n==$c5n){if(!$pair){$pair=$c1n;}else{$pair2=$c1n;}}
	
	if($threeofkind!=$c2n && $threeofkind2!= $c2n && $fourofkind!= $c2n && $c2n==$c3n){if(!$pair){$pair=$c2n;}else{$pair2=$c2n;}}
	if($threeofkind!=$c2n && $threeofkind2!= $c2n && $fourofkind!= $c2n && $c2n==$c4n){if(!$pair){$pair=$c2n;}else{$pair2=$c2n;}}
	if($threeofkind!=$c2n && $threeofkind2!= $c2n && $fourofkind!= $c2n && $c2n==$c5n){if(!$pair){$pair=$c2n;}else{$pair2=$c2n;}}
	
	if($threeofkind!=$c3n && $threeofkind2!= $c3n && $fourofkind!= $c3n && $c3n==$c4n){if(!$pair){$pair=$c3n;}else{$pair2=$c3n;}}
	if($threeofkind!=$c3n && $threeofkind2!= $c3n && $fourofkind!= $c3n && $c3n==$c5n){if(!$pair){$pair=$c3n;}else{$pair2=$c3n;}}
	
	if($threeofkind!=$c4n && $threeofkind2!= $c4n && $fourofkind!= $c4n && $c4n==$c5n){if(!$pair){$pair=$c4n;}else{$pair2=$c4n;}}
	
	
	$pairsarr = array(0, 0);
	
	if($pair){$pairsarr[0]=$pair;}
	if($pair2){$pairsarr[1]=$pair2;}
	rsort($pairsarr);
	
	$pairsarrna=num_2_name($pairsarr[0]);
	$pairsarr1na=num_2_name($pairsarr[1]);
	if($pairsarr[0]!=0 && $pairsarr[1]==0){$score[0].="Pair of ".$pairsarrna."'s";$score[1]=2;$score[2]=$pairsarr[0];}
	if($pairsarr[1]!=0){$score[0].="Two-Pair of ".$pairsarrna."'s and ".$pairsarr1na."'s";$score[1]=3;$score[2]=$pairsarr[0];}
	
	/***********************************
	***End pair checks 
	************************************/
	
	
	
	/********************
	**Full house
	*********************/
	$fullhouse = array(0, 0);
	if($threeofkind)
	{
		$full=$threeofkind;
		if($pair!=0 && $pair!=$threeofkind)
		{
			$fullof=$pair;
			if($pair>$threeofkind)
			{
				$fullhouse[0]=$pair;
				$fullhouse[1]=$threeofkind;
			}
			else
			{
				$fullhouse[0]=$threeofkind;
				$fullhouse[1]=$pair;
			}
		}
		if($pair2!=0 && $pair2!=$threeofkind)
		{
			$fullof=$pair2;
			if($pair2>$threeofkind)
			{
				$fullhouse[0]=$pair2;
				$fullhouse[1]=$threeofkind;
			}
			else
			{
				$fullhouse[0]=$threeofkind;
				$fullhouse[1]=$pair2;
			}
		}
	}
	if($threeofkind2)
	{
		$full=$threeofkind2;
		if($pair!=0 && $pair!=$threeofkind2)
		{
			$fullof=$pair;
			if($pair>$threeofkind2)
			{
				$fullhouse[0]=$pair;
				$fullhouse[1]=$threeofkind2;
			}
			else
			{
				$fullhouse[0]=$threeofkind2;
				$fullhouse[1]=$pair;
			}
		}
		if($pair2!=0 && $pair2!=$threeofkind2)
		{
			$fullof=$pair2;
			if($pair2>$threeofkind2)
			{
				$fullhouse[0]=$pair2;
				$fullhouse[1]=$threeofkind2;
			}
			else
			{
				$fullhouse[0]=$threeofkind2;
				$fullhouse[1]=$pair2;
			}
		}
	}
	
	$fullna=num_2_name($full);
	$fullofna=num_2_name($fullof);
	
	if($fullhouse[0]>0){$score[0]="Full house - ".$fullna."'s full of ".$fullofna."'s";$score[1]=7;$score[2]=$full;}
	
	/********************
	**End full house 
	*********************/
	
	
	/********************
	**Straight
	*********************/
	
	$straight = array($c1n,$c2n,$c3n,$c4n,$c5n);
	if (in_array(14, $straight)) 
	{
		//if there is an ace on the board, add a new card with value 1 at end of array
	    $straight[]=1;
	}
	
	//make a new array that will contain only one of each card (for use when more than 5 cards, like texas hold em or no peakies)
	$straight2 = array();
	
	foreach ($straight as $val) 
	{
	    $key = array_search($val, $straight2);
		if(!$key || $key==0 || $key==""){$straight2[]=$val;}
	}
	$straight2[]=-1;
	
	rsort($straight2);
	
	$cnt=1;
	$oldval=0;
	foreach ($straight2 as $car) 
	{
		if($cnt==5){$highs=$oldval+4;}
		if($oldval==$car+1)
		{$cnt+=1;}
		else
		{$cnt=1;}
		$oldval=$car;
	}
	
	$highsna=num_2_name($highs);
	if($highs){$score[0]=$highsna." high straight";$score[1]=5;$score[2]=$highs;}
	
	/********************
	**End straight
	*********************/
	
	/********************
	**Flush
	*********************/
	$flush = array($c1s,$c2s,$c3s,$c4s,$c5s);
	$flush2 = array($c1n,$c2n,$c3n,$c4n,$c5n);
	$hearts = array();
	$clubs = array();
	$spades = array();
	$diamonds = array();
	$hic = array();
	$hic2 = array();
	
	for($i=0;$i<8;$i++)
	{
		if($flush[$i]=="h"){$hearts[]=$i;}
		if($flush[$i]=="d"){$diamonds[]=$i;}
		if($flush[$i]=="s"){$spades[]=$i;}
		if($flush[$i]=="c"){$clubs[]=$i;}
	}
	$numh=count($hearts);
	$numd=count($diamonds);
	$nums=count($spades);
	$numc=count($clubs);
	//Don't bother if you have a full house or 4 of a kind - don't want to overwrite higher score
	if($numh>=5 && $score[1]!=7 && $score[1]!=8){$score[0]="Flush in hearts";$hic=$hearts;$yflu=1;}
	if($numd>=5 && $score[1]!=7 && $score[1]!=8){$score[0]="Flush in diamonds";$hic=$diamonds;$yflu=1;}
	if($nums>=5 && $score[1]!=7 && $score[1]!=8){$score[0]="Flush in spades";$hic=$spades;$yflu=1;}
	if($numc>=5 && $score[1]!=7 && $score[1]!=8){$score[0]="Flush in clubs";$hic=$clubs;$yflu=1;}
	foreach ($hic as $valu) 
	{
		$hic2[]=$flush2[$valu];
	}
	rsort($hic2);
	$hic2na=num_2_name($hic2[0]);
	if($yflu==1 && $score[1]!=7 && $score[1]!=8){$score[0].=" ($hic2na high)";$score[1]=6;$score[2]=$hic2[0];}
	
	/********************
	**End flush
	*********************/
	
	/********************
	**Straight and Royal flush
	*********************/
	if (in_array(14, $hic2)) 
	{
	    $hic2[]=1;
	}
	$hic2[]=-1;
	rsort($hic2);
	$cnt=1;
	$oldval=0;
	foreach ($hic2 as $car) 
	{
		if($cnt==5){$highssr=$oldval+4;}
		if($oldval==$car+1)
		{$cnt+=1;}
		else
		{$cnt=1;}
		$oldval=$car;
	}
	
	
	$highssrna=num_2_name($highssr);
	if($highssr==14){$score[0]="<font color=blue>Royal Flush</font>";$score[1]=10;}
	else if($highssr!=14 && $highssr!=0){$score[0]=$highssrna." high <font color=blue>Straight Flush</font>";$score[1]=9;$score[2]=$highssr;}
	
	/********************
	**End Straight and Royal flush
	*********************/
	
	
	if($score[0]=="")
	{
		$hicar = array($c1n,$c2n,$c3n,$c4n,$c5n);
		rsort($hicar);
		$hicarna=num_2_name($hicar[0]);
		$score[0].="High Card - ".$hicarna;$score[1]=1;$score[2]=$hicar[0];
	}
	return $score;
}

//Level for each score
/*
-Royal Flush (10)
-Straight Flush (9)
-Four of a Kind (8)
-Full House (7)
-Flush (6)
-Straight (5)
-Three of a Kind (4)
-Two Pair (3)
-One Pair (2)
-High Card (1)
*/

//SCORE ARRAY
//0-text
//1-level
//2-high card/defining factor (if levels are the same)
?>