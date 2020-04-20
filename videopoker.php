<?php
include "videopoker_func.php";
include "globals.php";
print"<center><h2>Video Poker</h2><hr />";
$adst=$db->query("SELECT * FROM videopoker_stats LIMIT 1");
$adsta=$db->fetch_row($adst);
if($ir['user_level']==2)
{
	$minbeta=abs(intval($_POST['minbet']));
	$maxbeta=abs(intval($_POST['maxbet']));
	print"<hr />
	Stats:<br />
	<b>House Profit:</b> $".number_format($adsta['houseProfit'])."<br />
	<b>Total Plays:</b> ".number_format($adsta['totalPlays'])."<br />";
	if($_GET['act']=='admin' && $minbeta && $maxbeta)
	{
		$db->query("UPDATE videopoker_stats SET minbet=$minbeta, maxbet=$maxbeta");
		print"<br /><b>Betting info updated!</b><br />";
		$adsta['minbet']=$minbeta;
		$adsta['maxbet']=$maxbeta;
	}
	print"<br /><form method=post action=videopoker.php?act=admin>
	<b>Minimum Bet:</b> <input type=text name=minbet value={$adsta['minbet']}><br />
	<b>Maximum Bet:</b> <input type=text name=maxbet value={$adsta['maxbet']}>
	<br /><input type=submit value='Submit Changes'></form>
	<hr />";

}
print"
Minimum Bet: \$".number_format($adsta['minbet'])."<br />
Maximum Bet: \$".number_format($adsta['maxbet'])."<br /><br />
<b>Payout Multiplier:</b><br /><img src=images/scores.PNG><br /><br />";
$pcar=$db->query("SELECT * FROM videopoker WHERE userid='$userid'");
$bb=$db->fetch_row($pcar);
$playingpoker=$db->num_rows($pcar);
if(!$_GET['act'] || $_GET['act']=='admin')
{
	$defaultbet = ((int)($ir['money']/1000));
	if($defaultbet<=0){$defaultbet=1;}
	print"<form action=videopoker.php?act=deal method=post>
	Amount to risk each round:<br />
	$<input type=text name=betamount value=$defaultbet size=6><br /><br />
	<input type=submit value='Set Bet And Start Playing!'>
	</form>";
}
else if($_GET['act']=='deal')
{
	$betamt=abs(intval($_POST['betamount']));
	if($betamt > $ir['money'])
	{
		$error='Sorry, you do not have that much money.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if($betamt > $adsta['maxbet'])
	{
		$error='Sorry, that is greater than the maximum allowed bet.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if($betamt < $adsta['minbet'])
	{
		$error='Sorry, that is lower than the minimum required bet.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if($betamt <= 0)
	{
		$error='Sorry, you must bet more than $0.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if(!$error)
	{
		$db->query("UPDATE users SET money=money-$betamt WHERE userid='$userid'");
		$db->query("UPDATE videopoker_stats SET houseProfit=houseProfit+$betamt, totalPlays=totalPlays+1");
		print"You bet: <b>$".number_format($betamt)."</b>.<br /><br />";
		deal_cards($userid, $betamt);
		$cards=show_cards($userid, 1);
		print"$cards<br />";
	}
	else
	{
		print $error;
	}
}
else if($_GET['act']=='newdeal')
{
	$betamt=abs(intval($_GET['bet']));
	if($betamt > $ir['money'])
	{
		$error='Sorry, you do not have that much money.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if($betamt > $adsta['maxbet'])
	{
		$error='Sorry, that is greater than the maximum allowed bet.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if($betamt < $adsta['minbet'])
	{
		$error='Sorry, that is lower than the minimum required bet.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if($betamt <= 0)
	{
		$error='Sorry, you must bet more than $0.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if(!$error)
	{
		$db->query("UPDATE users SET money=money-$betamt WHERE userid='$userid'");
		$db->query("UPDATE videopoker_stats SET houseProfit=houseProfit+$betamt, totalPlays=totalPlays+1");
		print"You bet: <b>$".number_format($betamt)."</b>.<br /><br />";
		deal_cards($userid, $betamt);
		$cards=show_cards($userid, 1);
		print"$cards<br />";
	}
	else
	{
		print $error;
	}
}
else if($_GET['act']=='draw')
{
	if(!$playingpoker)
	{
		$error='Sorry, you do not have a currently active poker game.<br />&gt;<a href=videopoker.php>Back</a>';
	}
	if(!$error)
	{
		if(!$_POST['hold1'])
		{
			replace_card(1, $userid);
		}
		if(!$_POST['hold2'])
		{
			replace_card(2, $userid);
		}
		if(!$_POST['hold3'])
		{
			replace_card(3, $userid);
		}
		if(!$_POST['hold4'])
		{
			replace_card(4, $userid);
		}
		if(!$_POST['hold5'])
		{
			replace_card(5, $userid);
		}
		$cards=show_cards($userid, 2);
		print"$cards<br />";
		$scoreArray=calc_score($userid);
		$winMultiplier = find_winnings($scoreArray[1], $scoreArray[2]);
		$bet=$bb['betAmount'];
		$totalwin = $bet * $winMultiplier;
		if($totalwin!=0)
		{
			print "With your {$scoreArray[0]}, you won {$winMultiplier}x your original bet of $".number_format($bet).". <br /><br />";
			print "<b>$".number_format($totalwin)." has been added to your wallet.</b>";
			$db->query("UPDATE users SET money=money+$totalwin WHERE userid='$userid'");
			$db->query("UPDATE videopoker_stats SET houseProfit=houseProfit-$totalwin");
		}
		else
		{
			print "<b>With your {$scoreArray[0]}, you lost your original bet of $".number_format($bet).".</b> <br /><br />";
			print "(Need pair of jacks or better to win)";
		}
		$db->query("DELETE FROM videopoker WHERE userid='$userid'");
	}
	else
	{
		print $error;
	}
}
print"</center>";
$h->endpage();
?>