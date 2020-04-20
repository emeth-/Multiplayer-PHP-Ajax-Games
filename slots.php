<?php
include "globals.php";

$sst=$db->fetch_row($db->query("SELECT * FROM slots_stats LIMIT 1"));
$betamt=abs((int)$_GET['betamount']);
print"<center>
<h2>7's and Stripes Slots</h2>";

$adst=$db->query("SELECT * FROM slots_stats LIMIT 1");
$adsta=$db->fetch_row($adst);
if($ir['user_level']==2)
{
	$minbeta=abs(intval($_POST['minbet']));
	$maxbeta=abs(intval($_POST['maxbet']));
	print"<hr />
	Stats:<br />
	<b>House Profit:</b> ".number_format($adsta['houseprofit'])." money<br />
	<b>Total Plays:</b> ".number_format($adsta['plays'])."<br />";
	if($_GET['act']=='admin' && $minbeta && $maxbeta)
	{
		$db->query("UPDATE slots_stats SET minbet=$minbeta, maxbet=$maxbeta");
		print"<br /><b>Betting info updated!</b><br />";
		$adsta['minbet']=$minbeta;
		$adsta['maxbet']=$maxbeta;
	}
	print"<br /><form method=post action=slots.php?act=admin>
	<b>Minimum Bet:</b> <input type=text name=minbet value={$adsta['minbet']}><br />
	<b>Maximum Bet:</b> <input type=text name=maxbet value={$adsta['maxbet']}>
	<br /><input type=submit value='Submit Changes'></form>";
}

print"<hr width=98%>
<b>Jackpots:</b><br />
<font size=1.5>Red 7 / White 7 / Blue 7</font> - <b>\$".number_format($sst['jackpot7'])."</b><br />
<font size=1.5>1 Bar / 2 Bar / 3 Bar</font> - <b>\$".number_format($sst['jackpotbar'])."</b><br /><br />";

if($betamt>0)
{
	if($ir['money']<$betamt){print"You don't have that much money.<br /><br />";}
	else if($adsta['maxbet']<$betamt){print"Your bet is higher than the maximum bet amount.<br /><br />";}
	else if($adsta['minbet']>$betamt){print"Your bet need to be more than the minimum bet amount.<br /><br />";}
	else
	{	
		$randomincident=rand(1,500);
		if($randomincident==13)
		{//5 credit bonus
			print"<b>SOMETHING HAPPENED!</b><br /> <font size=1.5>A random bystander watches you play the slots for a few minutes, then <i>hands you 5 dollars</i> and shakes his head sadly while walking away.</font><br /><br />";
			$db->query("UPDATE users SET money=money+5 WHERE userid='{$ir['userid']}'");
			$db->query("UPDATE slots_stats SET houseprofit=houseprofit-5");
		}
		if($randomincident==11 || $randomincident==43 || $randomincident==14)
		{//1 credit bonus
			print"<b>SOMETHING HAPPENED!</b><br /> <font size=1.5>You see a dollar lying on the floor... nobody is looking, so you pick it up. Woot! You just got one dollar!</font><br /><br />";
			$db->query("UPDATE users SET money=money+1 WHERE userid='{$ir['userid']}'");
			$db->query("UPDATE slots_stats SET houseprofit=houseprofit-1");
		}
		


		print"You bet \$$betamt.<br /><br />";
		$db->query("UPDATE users SET money=money-$betamt WHERE userid='{$ir['userid']}'");
		$db->query("UPDATE slots_stats SET plays=plays+1, houseprofit=houseprofit+$betamt");
		$reel1=rand(1,64);
		$reel2=rand(1,64);
		$reel3=rand(1,64);
		$re1=$db->query("SELECT reel1,reel1aft,reel1bef FROM slot_reel WHERE id=$reel1");
		$r1=$db->fetch_row($re1);
		$re2=$db->query("SELECT reel2,reel2aft,reel2bef FROM slot_reel WHERE id=$reel2");
		$r2=$db->fetch_row($re2);
		$re3=$db->query("SELECT reel3,reel3aft,reel3bef FROM slot_reel WHERE id=$reel3");
		$r3=$db->fetch_row($re3);
		$score=getscore($r1['reel1'], $r2['reel2'], $r3['reel3']);
		$winamount = $score[1] * $betamt;
		$r1img=$r1['reel1'];
		$r2img=$r2['reel2'];
		$r3img=$r3['reel3'];
?>
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td colspan=5>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><img src="images/slots/<?php print $r1['reel1bef']; ?>btm.PNG" border="0"></td><td width="9"></td><td><img src="images/slots/<?php print $r2['reel2bef']; ?>btm.PNG" border="0"></td><td width="9"></td><td><img src="images/slots/<?php print $r3['reel3bef']; ?>btm.PNG" border="0"></td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><img src="images/slots/<?php print $r1img; ?>.PNG" border="0"></td><td width="9"></td><td><img src="images/slots/<?php print $r2img; ?>.PNG" border="0"></td><td width="9"></td><td><img src="images/slots/<?php print $r3img; ?>.PNG" border="0"></td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><img src="images/slots/<?php print $r1['reel1aft']; ?>top.PNG" border="0"></td><td width="9"></td><td><img src="images/slots/<?php print $r2['reel2aft']; ?>top.PNG" border="0"></td><td width="9"></td><td><img src="images/slots/<?php print $r3['reel3aft']; ?>top.PNG" border="0"></td><td>&nbsp;</td></tr>
<tr><td colspan=5>&nbsp;</td></tr>
</table>
<?php
//{$r1['reel1']} - {$r2['reel2']} - {$r3['reel3']}<br />
		if($winamount>0){$outcome="<b>You won \$$winamount.</b>";}
		else{$outcome="Sorry, you didn't win anything.";}
		print"
			$score[0]<br />$outcome<br /><br />";
		if($winamount>0)
		{
			$db->query("UPDATE slots_stats SET houseprofit=houseprofit-$winamount LIMIT 1");
			$db->query("UPDATE users SET money = money + $winamount WHERE userid='{$ir['userid']}'");
		}
		print"
		<form method=post action=slots.php?betamount=$betamt><input type=submit value='Play Again'></form><br /><br />";
	}

}
else
{
?>
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td colspan=5>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><img src="images/slots/2barbtm.PNG" name="r0top" border="0"></td><td width="9"></td><td><img src="images/slots/3barbtm.PNG" name="r1top" border="0"></td><td width="9"></td><td><img src="images/slots/1barbtm.PNG" name="r2top" border="0"></td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><img src="images/slots/red7.PNG" name="r0main" border="0"></td><td width="9"></td><td><img src="images/slots/white7.PNG" name="r1main" border="0"></td><td width="9"></td><td><img src="images/slots/blue7.PNG" name="r2main" border="0"></td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><img src="images/slots/3bartop.PNG" name="r0btm" border="0"></td><td width="9"></td><td><img src="images/slots/1bartop.PNG" name="r1btm" border="0"></td><td width="9"></td><td><img src="images/slots/2bartop.PNG" name="r2btm" border="0"></td><td>&nbsp;</td></tr>
<tr><td colspan=5>&nbsp;</td></tr>
</table><br /><br />
<?php
	print"
	<form method=get action='slots.php'>
	How many money do you want to bet per spin?<br /> <br /> 
	\$<input size=3 type=text name='betamount' value={$adsta['minbet']}><br />
	<input type=submit value='Start Playing the Slots!'>
	</form>
	<br /><br />
	Minimum Bet: \$".number_format($adsta['minbet'])."<br />
	Maximum Bet: \$".number_format($adsta['maxbet'])."<br />
	<br />
	";
}

print"
<img src='images/slotspayout.png'><center><br /><br />";

$h->endpage();


function getscore($r1, $r2, $r3)
{
	global $db;
/*
single bar red
double bar white
triple bar blue
*/
	//red 7, white 7, blue 7
	if($r1=='red7' && $r2=='white7' && $r3 == 'blue7')
	{
		$sst2=$db->fetch_row($db->query("SELECT * FROM slots_stats LIMIT 1"));
		$score[0]="JACKPOT!";$score[1]=$sst2['jackpot7'];
		$db->query("UPDATE slots_stats SET jackpot7=2400 LIMIT 1");
	}

	//red 7, red 7, red 7
	else if($r1=='red7' && $r2=='red7' && $r3 == 'red7')
	{
		$score[0]="Triple Red Sevens!";$score[1]=1200;
		$bonus=$score[1]/3;
		$db->query("UPDATE slots_stats SET jackpot7=jackpot7+$bonus LIMIT 1");
	}

	//white 7, white 7, white 7
	else if($r1=='white7' && $r2=='white7' && $r3 == 'white7')
	{
		$score[0]="Triple White Sevens!";$score[1]=200;
		$bonus=$score[1]/3;
		$db->query("UPDATE slots_stats SET jackpot7=jackpot7+$bonus LIMIT 1");
	}


	//blue 7, blue 7, blue 7
	else if($r1=='blue7' && $r2=='blue7' && $r3 == 'blue7')
	{
		$score[0]="Triple Blue Sevens!";$score[1]=150;
		$bonus=$score[1]/3;
		$db->query("UPDATE slots_stats SET jackpot7=jackpot7+$bonus LIMIT 1");
	}


	//any 3 sevens
	else if(($r1=='red7' || $r1=='white7' || $r1 == 'blue7')
	 && ($r2=='red7' || $r2=='white7' || $r2 == 'blue7')
	 && ($r3=='red7' || $r3=='white7' || $r3 == 'blue7'))
	{
		$score[0]="Triple Sevens!";$score[1]=80;
		$bonus=$score[1]/3;
		$db->query("UPDATE slots_stats SET jackpot7=jackpot7+$bonus LIMIT 1");
	}

	//1 Bar, 2 Bar, 3 Bar
	else if($r1=='1bar' && $r2=='2bar' && $r3 == '3bar')
	{
		$sst2=$db->fetch_row($db->query("SELECT * FROM slots_stats LIMIT 1"));
		$score[0]="Easy as 1-2-3! JACKPOT!";$score[1]=$sst2['jackpotbar'];
		$db->query("UPDATE slots_stats SET jackpotbar=50 LIMIT 1");
	}


	//3 Bar, 3 Bar, 3 Bar
	else if($r1=='3bar' && $r2=='3bar' && $r3 == '3bar')
	{
		$score[0]="Triple 3-bars!";$score[1]=40;
		$bonus=$score[1]/2;
		$db->query("UPDATE slots_stats SET jackpotbar=jackpotbar+$bonus LIMIT 1");

	}

	//2 Bar, 2 Bar,2 Bar
	else if($r1=='2bar' && $r2=='2bar' && $r3 == '2bar')
	{
		$score[0]="Triple 2-bars!";$score[1]=25;
		$bonus=$score[1]/2;
		$db->query("UPDATE slots_stats SET jackpotbar=jackpotbar+$bonus LIMIT 1");
	}
/*
	//Any red, any white,any blue
	else if(($r1=='1bar' || $r1=='red7')
	 && ($r1=='2bar' || $r1=='white7')
	 && ($r1=='3bar' || $r1=='blue7'))
	{
		$score[0]="Red, White and Blue!";$score[1]=20;
	}
*/
	//1 Bar, 1 Bar,1 Bar
	else if($r1=='1bar' && $r2=='1bar' && $r3 == '1bar')
	{
		$score[0]="Triple 1-bars!";$score[1]=10;
		$bonus=$score[1]/2;
		$db->query("UPDATE slots_stats SET jackpotbar=jackpotbar+$bonus LIMIT 1");
	}


	//any 3 bars
	else if(($r1=='1bar' || $r1=='2bar' || $r1 == '3bar')
	 && ($r2=='1bar' || $r2=='2bar' || $r2 == '3bar')
	 && ($r3=='1bar' || $r3=='2bar' || $r3 == '3bar'))
	{
		$score[0]="Three different bars!";$score[1]=5;
		$bonus=$score[1]/2;
		$db->query("UPDATE slots_stats SET jackpotbar=jackpotbar+$bonus LIMIT 1");
	}


	//any 3 reds
	else if(($r1=='1bar' || $r1=='red7')
	 && ($r2=='1bar' || $r2=='red7')
	 && ($r3=='1bar' || $r3=='red7'))
	{
		$score[0]="I'm seeing red...";$score[1]=2;
	}


	//any 3 whites
	else if(($r1=='2bar' || $r1=='white7')
	 && ($r2=='2bar' || $r2=='white7')
	 && ($r3=='2bar' || $r3=='white7'))
	{
		$score[0]="Everything is white!";$score[1]=2;
	}



	//any 3 blues
	else if(($r1=='3bar' || $r1=='blue7')
	 && ($r2=='3bar' || $r2=='blue7')
	 && ($r3=='3bar' || $r3=='blue7'))
	{
		$score[0]="Feeling a little blue?";$score[1]=2;
	}



	//3 blanks
	else if($r1=='blank' && $r2=='blank' && $r3 == 'blank')
	{
		$score[0]="3 Blanks. How sad. Here's a pity bonus.";$score[1]=1;
	}


	return $score;
}

print"</center>";
$h->endpage();

?>