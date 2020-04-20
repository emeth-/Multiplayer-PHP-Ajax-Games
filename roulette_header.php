<?php
if($roulettejs)
{
	$roul=$db->query("SELECT * FROM roulette_stats LIMIT 1");
	$rou=$db->fetch_row($roul);
	$yomon=$db->query("SELECT money FROM users WHERE userid={$ir['userid']} LIMIT 1");
	$yomoney=$db->fetch_row($yomon);
	if($_GET['act']=='' || $_GET['act']=='bet')
	{
		$db->query("DELETE FROM roulette WHERE userid={$ir['userid']}");
	}
	if($_GET['act']=='bet') //spin wheel
	{
		$betamt = abs(intval($_POST['amountBet']));
		if($betamt=='')
		{
			$error="Cannot have an empty bet";	
		}	
		else if($betamt > $yomoney['money'])
		{
			$error="You do not have that much money.";	
		}
		else if($betamt > $rou['maxbet'])
		{
			$error="Bet amount is higher than acceptable max bet.";	
		}
		else if($betamt < $rou['minbet'])
		{
			$error="Bet amount is lower than acceptable min bet.";	
		}
		if(!$error)
		{
			$betnum = -1;
			$betcolumnum = -1;
			$betrownum = -1;
			$betrangenum = -1;
			$betevenoddnum = -1;
			$betcolornum = -1;
			if($_GET['type']==1)
			{
				$betnum = abs(intval($_POST['beton']));
			}
			else if($_GET['type']==2)
			{
				$betcolumnum = abs(intval($_POST['beton']));
			}
			else if($_GET['type']==3)
			{
				$betrownum = abs(intval($_POST['beton']));
			}
			else if($_GET['type']==4)
			{
				$betrangenum = abs(intval($_POST['beton']));
			}
			else if($_GET['type']==5)
			{
				$betevenoddnum = abs(intval($_POST['beton']));
			}
			else if($_GET['type']==6)
			{
				$betcolornum = abs(intval($_POST['beton']));
			}
			$db->query("INSERT INTO roulette Values('', {$ir['userid']}, 0, 0, 0, 0, 0, 0, $betnum, $betamt, $betcolumnum, $betrownum, $betrangenum, $betevenoddnum, $betcolornum)");
			spinWheel($ir['userid']);
		}
	}
	$roulf=$db->query("SELECT * FROM roulette WHERE userid={$ir['userid']} LIMIT 1");
	$rouf=$db->fetch_row($roulf);
	$roulettejs = str_replace("{USERCASH}", $ir['money'], $roulettejs);
	$roulettejs = str_replace("{MAXBET}", $rou['maxbet'], $roulettejs);
	$roulettejs = str_replace("{MINBET}", $rou['minbet'], $roulettejs);
	$roulettejs = str_replace("{WINNUM}", $rouf['winnum'], $roulettejs);
}
?>