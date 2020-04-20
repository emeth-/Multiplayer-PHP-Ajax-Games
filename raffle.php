<?php
include "globals.php";
$costperticket = 10;
$numoftickets=abs((int)$_POST['numoftickets']);
print"
<center><h2>Raffle</h2><hr width=98%>
<center><br />";
die("The raffle is temporarily out of order. We're working on sorting out some bugs.");
$rfs=$db->query("SELECT * FROM raffle_stats LIMIT 1");
$rf=$db->fetch_row($rfs);
$tottickets = number_format($rf['tottickets']);

if($numoftickets>0)
{
	$totalcost=$costperticket*$numoftickets;
	$jackpot=$totalcost/2;
	if($totalcost>$ir['points']){print"Sorry, you do not have $totalcost points.";$h->endpage();die();}
	$db->query("UPDATE users SET points=points-$totalcost WHERE userid={$ir['userid']}");
	$db->query("UPDATE raffle_stats SET tottickets=tottickets+$numoftickets, jackpot=jackpot+$jackpot");
	print"You bought $numoftickets raffle tickets for $totalcost points.<br />&gt;<a href=raffle.php>Back</a>";
	while($numoftickets>0)
	{
		$db->query("INSERT INTO raffle (userid) VALUES({$ir['userid']})");
		$numoftickets = $numoftickets - 1;
	}
}
else
{
	print"<font size=2><b>Current Prizes:</b> $5 paypal, $20 paypal, $100 paypal, <a href='http://www.apple.com/ipodshuffle/features.html' target='_blank'>2 gig Ipod Shuffle</a></font><br />
	<br /><font size=1.5>Raffle tickets cost $costperticket points ".helplink(2)." each. At the end of each month, winners are chosen.</font>
	<br /><br />
	<b><font size=2>Buy Raffle Tickets</font></b><br />
	<form method=post action='raffle.php'>
	How many: <input type=text name='numoftickets' value=1><br />
	<input type=submit value='Buy Raffle Tickets'>
	</form>
	<br /><br />
	Currently there have been $tottickets raffle tickets bought.
	";
}
$h->endpage();
?>