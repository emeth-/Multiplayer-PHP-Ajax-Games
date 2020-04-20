<?php

function show_cards($user, $type)
{
	global $db,$ir;
	$pcr=$db->query("SELECT * FROM blackjack WHERE userid='$user'", $c) or die(mysql_error());
	$pcr2=mysql_fetch_assoc($pcr);

	//player
	$c5=$pcr2['c6n'];
	$c6=$pcr2['c6s'];
	$c7=$pcr2['c7n'];
	$c8=$pcr2['c7s'];
	$c9=$pcr2['c8n'];
	$c10=$pcr2['c8s'];
	$c11=$pcr2['c9n'];
	$c12=$pcr2['c9s'];
	$c13=$pcr2['c10n'];
	$c14=$pcr2['c10s'];

	//dealer
	$c1=$pcr2['c1n'];
	$c2=$pcr2['c1s'];
	$c3=$pcr2['c2n'];
	$c4=$pcr2['c2s'];
	$c15=$pcr2['c3n'];
	$c16=$pcr2['c3s'];
	$c17=$pcr2['c4n'];
	$c18=$pcr2['c4s'];
	$c19=$pcr2['c5n'];
	$c20=$pcr2['c5s'];

	$d1=return_cardpic($c1, $c2, 'dealer1');
	$d2=return_cardpic($c3, $c4, 'dealer2');
	$d3=return_cardpic($c15, $c16, 'dealer3');
	$d4=return_cardpic($c17, $c18, 'dealer4');
	$d5=return_cardpic($c19, $c20, 'dealer5');
	$u1=return_cardpic($c5, $c6, 'player1');
	$u2=return_cardpic($c7, $c8, 'player2');
	$u3=return_cardpic($c9, $c10, 'player3');
	$u4=return_cardpic($c11, $c12, 'player4');
	$u5=return_cardpic($c13, $c14, 'player5');
	$playerhas = calc_playerscore($user);
	$firstfivecards="<table>
	<tr><th colspan=100%>Dealer</th></tr><tr><td align=center>";
	if($type==1)
	{
		$firstfivecards.="<img name='dealer1' src='images/cards/blankcard.gif'>";
	}
	else 
	{
		$dealerhas = calc_dealerscore($user);
		//$firstfivecards.="$d1";
		$firstfivecards.="<img name='dealer1' src='images/cards/blankcard.gif'>";
	}
	$firstfivecards.="</td><td align=center>$d2</td>";
	$dhits=$pcr2['dNumHits'];
	if($dhits>=1)
	{
		$firstfivecards.="<td align=center><img name='dealer3' src='images/cards/idontexist.gif'></td>";
	}
	if($dhits>=2)
	{
		$firstfivecards.="<td align=center><img name='dealer4' src='images/cards/idontexist.gif'></td>";
	}
	if($dhits>=3)
	{
		$firstfivecards.="<td align=center><img name='dealer5' src='images/cards/idontexist.gif'></td>";
	}
	$firstfivecards.="</tr>";
	if($type==1)
	{
		$firstfivecards.="<tr><td align=center colspan=100%>Dealer shows ".bjvardvalue($pcr2['c2n']).".</td></tr>";
	}
	if($type==2)
	{
		$firstfivecards.="<tr><td align=center colspan=100%><span id='txtstatus'>Dealer has ".bjvardvalue($pcr2['c2n']).".</span></td></tr>";
	}
	$firstfivecards.="
	<tr><td colspan=100%>&nbsp;</td></tr>
	<tr><th colspan=100%>Player</th></tr><tr>
	<td align=center>$u1</td>
	<td align=center>$u2</td>";
	$hits=$pcr2['uNumHits'];
	if($hits>=1)
	{
		$firstfivecards.="<td align=center>$u3</td>";
	}
	if($hits>=2)
	{
		$firstfivecards.="<td align=center>$u4</td>";
	}
	if($hits>=3)
	{
		$firstfivecards.="<td align=center>$u5</td>";
	}
	$firstfivecards.="</tr><tr><td align=center colspan=100%>Player has $playerhas.</td></tr></table>";
	return $firstfivecards;
}

function find_winner($userid)
{
	global $db,$ir;
	$pscore=calc_playerscore($userid);
	$dscore=calc_dealerscore($userid);
	if($pscore==$dscore)
	{
		return -1; //push
	}
	if($pscore>$dscore && $pscore<=21) //player has higher score than dealer
	{
		if($pscore==21) //player has blackjack
		{
			return 2;//blackjack, 3 to 2 payout
		}
		else //player has regular high score
		{
			return 1;//no blackjack, 1 to 1 payout
		}
	}
	if($dscore>21) //dealer bust
	{
		return 1;//1 to 1 payout
	}
}

function calc_playerscore($userid)
{
	global $db,$ir;
	$lp=$db->query("SELECT * FROM blackjack WHERE userid='$userid'", $c) or die(mysql_error());
	$pcr2=mysql_fetch_assoc($lp);
	$c1=$pcr2['c6n'];
	$c2=$pcr2['c7n'];
	$c3=$pcr2['c8n'];
	$c4=$pcr2['c9n'];
	$c5=$pcr2['c10n'];

	$hits=$pcr2['uNumHits'];
	if($c1>10 && $c1 != 14){$c1=10;}
	if($c2>10 && $c2 != 14){$c2=10;}
	if($c3>10 && $c3 != 14){$c3=10;}
	if($c4>10 && $c4 != 14){$c4=10;}
	if($c5>10 && $c5 != 14){$c5=10;}
	$ace=0;
	if($c1==14){$c1=11;$ace++;}
	if($c2==14){$c2=11;$ace++;}
	$score=$c1+$c2;
	if($hits==1)
	{
		if($c3==14){$c3=11;$ace++;}
		$score+=$c3;
	}
	if($hits==2)
	{
		if($c3==14){$c3=11;$ace++;}
		if($c4==14){$c4=11;$ace++;}
		$score+=$c3 + $c4;
	}
	if($hits==3)
	{
		if($c3==14){$c3=11;$ace++;}
		if($c4==14){$c4=11;$ace++;}
		if($c5==14){$c5=11;$ace++;}
		$score+=$c3 + $c4 + $c5;
	}
	if($score>21 && $ace>0)
	{
		while($ace>0)
		{
			$ace--;
			$score-=10;
		}
	}
	return $score;
}
function bjvardvalue($cardnum)
{
	if($cardnum==14){return 11;}
	else if($cardnum>10){return 10;}
	else{return $cardnum;}
}

function dealer_play($userid)
{
	global $db,$ir;
	$i=0;
	$dscore=calc_dealerscore($userid);	
	while($dscore<17 && $i <= 3)
	{
		$i++;
		$db->query("UPDATE blackjack SET dNumHits=dNumHits+1 WHERE userid='$userid'");
		$dscore=calc_dealerscore($userid);
	}
}

function calc_dealerscore($userid)
{
	global $db,$ir;
	$lp=$db->query("SELECT * FROM blackjack WHERE userid='$userid'", $c) or die(mysql_error());
	$pcr2=mysql_fetch_assoc($lp);
	$c1=$pcr2['c1n'];
	$c2=$pcr2['c2n'];
	$c3=$pcr2['c3n'];
	$c4=$pcr2['c4n'];
	$c5=$pcr2['c5n'];

	$hits=$pcr2['dNumHits'];
	if($c1>10 && $c1 != 14){$c1=10;}
	if($c2>10 && $c2 != 14){$c2=10;}
	if($c3>10 && $c3 != 14){$c3=10;}
	if($c4>10 && $c4 != 14){$c4=10;}
	if($c5>10 && $c5 != 14){$c5=10;}
	$ace=0;
	if($c1==14){$c1=11;$ace++;}
	if($c2==14){$c2=11;$ace++;}
	$score=$c1+$c2;
	if($hits==1)
	{
		if($c3==14){$c3=11;$ace++;}
		$score+=$c3;
	}
	if($hits==2)
	{
		if($c3==14){$c3=11;$ace++;}
		if($c4==14){$c4=11;$ace++;}
		$score+=$c3 + $c4;
	}
	if($hits==3)
	{
		if($c3==14){$c3=11;$ace++;}
		if($c4==14){$c4=11;$ace++;}
		if($c5==14){$c5=11;$ace++;}
		$score+=$c3 + $c4 + $c5;
	}
	if($score>21 && $ace>0)
	{
		while($ace>0)
		{
			$ace--;
			$score-=10;
		}
	}
	return $score;
}

function deal_cards($userid, $betamt)
{
	global $db,$ir;
	$alreadyplaying=$db->num_rows($db->query("SELECT * FROM blackjack WHERE userid='$userid'"));
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
		$c1n=intval($cardvals[0]);//$c1n=2;
		$c1s="{$cardvals[1]}";//$c1s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,51);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c2n=intval($cardvals[0]);//$c2n=12;
		$c2s="{$cardvals[1]}";//$c2s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,50);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c3n=intval($cardvals[0]);//$c3n=14;
		$c3s="{$cardvals[1]}";//$c3s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,49);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c4n=intval($cardvals[0]);//$c4n=14;
		$c4s="{$cardvals[1]}";//$c4s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,48);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c5n=intval($cardvals[0]);//$c5n=13;
		$c5s="{$cardvals[1]}";//$c5s="s";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,47);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c6n=intval($cardvals[0]);//$c6n=14;
		$c6s="{$cardvals[1]}";
		unset($deckofcards["$card"]);rsort($deckofcards);
		$card=rand(1,46);$card--;
		$cardvals= explode("|", $deckofcards["$card"]);
		$c7n=intval($cardvals[0]);//$c7n=10;
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

		mysql_query("INSERT INTO blackjack VALUES('', '$userid', $betamt, 0, 0, $c1n, '$c1s', $c2n, '$c2s', $c3n, '$c3s', $c4n, '$c4s', $c5n, '$c5s', $c6n, '$c6s', $c7n, '$c7s', $c8n, '$c8s', $c9n, '$c9s', $c10n, '$c10s')") or die(mysql_error());
	}
}
function return_cardpic($num, $suit, $name)
{
	if($num==11){$num="jack";}
	if($num==12){$num="queenof";}
	if($num==13){$num="king";}
	if($num==1 || $num==14){$num="ace";}
	if($suit=="d"){$suit="diamonds";}
	if($suit=="c"){$suit="clubs";}
	if($suit=="s"){$suit="spades";}
	if($suit=="h"){$suit="hearts";}
	$cardlink="<img name='$name' src='images/cards/".$num.$suit.".gif'>";
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

?>