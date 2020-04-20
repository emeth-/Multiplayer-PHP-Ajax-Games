<?php
if($blackjackjs)
{
	$roul=$db->query("SELECT * FROM blackjack_stats LIMIT 1");
	$rou=$db->fetch_row($roul);
	$yomon=$db->query("SELECT money FROM users WHERE userid='{$ir['userid']}' LIMIT 1");
	$yomoney=$db->fetch_row($yomon);
	$roulf=$db->query("SELECT * FROM blackjack WHERE userid='{$ir['userid']}' LIMIT 1");
	$rouf=$db->fetch_row($roulf);
	$blackjackjs = str_replace("{USERCASH}", $ir['money'], $blackjackjs);
	$blackjackjs = str_replace("{MAXBET}", $rou['maxbet'], $blackjackjs);
	$blackjackjs = str_replace("{MINBET}", $rou['minbet'], $blackjackjs);
	if($_GET['act']=='stand' || $_GET['act']=='double')
	{
		$c1=$rouf['c1n'];
		$c2=$rouf['c2n'];
		$c3=$rouf['c3n'];
		$c4=$rouf['c4n'];
		$c5=$rouf['c5n'];
	
		if($c1>10 && $c1 != 14){$c1=10;}
		if($c2>10 && $c2 != 14){$c2=10;}
		if($c3>10 && $c3 != 14){$c3=10;}
		if($c4>10 && $c4 != 14){$c4=10;}
		if($c5>10 && $c5 != 14){$c5=10;}
		$ace=0;
		if($c1==14){$c1=11;$ace++;}
		if($c2==14){$c2=11;$ace++;}
		$score1=$c1+$c2;



		if($score1>21 && $ace>0)
		{
			$ace2=$ace;
			while($ace2>0)
			{
				$ace2--;
				$score1-=10;
			}
		}

		if($c3==14){$c3=11;$ace++;}
		$score2=$score1+$c3;
		if($score2>21 && $ace>0)
		{
			while($ace>0)
			{
				$ace--;
				$score2-=10;
			}
		}

		if($c4==14){$c4=11;$ace++;}
		$score3=$score2+$c4;
		if($score3>21 && $ace>0)
		{
			while($ace>0)
			{
				$ace--;
				$score3-=10;
			}
		}

		if($c5==14){$c5=11;$ace++;}
		$score4=$score3+$c5;
		if($score4>21 && $ace>0)
		{
			while($ace>0)
			{
				$ace--;
				$score4-=10;
			}
		}
		$txt1score="Dealer has ".$score1.".";
		$txt2score="Dealer has ".$score2.".";
		$txt3score="Dealer has ".$score3.".";
		$txt4score="Dealer has ".$score4.".";
		$blackjackjs = str_replace("{DCARD1}", dealercards($rouf['c1n'], $rouf['c1s']), $blackjackjs);
		$blackjackjs = str_replace("{DCARD3}", dealercards($rouf['c3n'], $rouf['c3s']), $blackjackjs);
		$blackjackjs = str_replace("{DCARD4}", dealercards($rouf['c4n'], $rouf['c4s']), $blackjackjs);
		$blackjackjs = str_replace("{DCARD5}", dealercards($rouf['c5n'], $rouf['c5s']), $blackjackjs);
		$blackjackjs = str_replace("{TXT1}", $txt1score, $blackjackjs);
		$blackjackjs = str_replace("{TXT2}", $txt2score, $blackjackjs);
		$blackjackjs = str_replace("{TXT3}", $txt3score, $blackjackjs);
		$blackjackjs = str_replace("{TXT4}", $txt4score, $blackjackjs);
		$blackjackjs = str_replace("{SCORE1}", $score1, $blackjackjs);
		$blackjackjs = str_replace("{SCORE2}", $score2, $blackjackjs);
		$blackjackjs = str_replace("{SCORE3}", $score3, $blackjackjs);
		$blackjackjs = str_replace("{SCORE4}", $score4, $blackjackjs);
	}

}

function dealercards($num, $suit)
{
	if($num==11){$num="jack";}
	if($num==12){$num="queenof";}
	if($num==13){$num="king";}
	if($num==1 || $num==14){$num="ace";}
	if($suit=="d"){$suit="diamonds";}
	if($suit=="c"){$suit="clubs";}
	if($suit=="s"){$suit="spades";}
	if($suit=="h"){$suit="hearts";}
	$cardlink="images/cards/".$num.$suit.".gif";
	return $cardlink;
}
?>