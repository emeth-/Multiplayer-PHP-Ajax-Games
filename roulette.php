<?php

$roulettejs="
<SCRIPT LANGUAGE=\"JavaScript\">
<!-- Begin

var interval = 1; 
var random_display = 1; 
var userCash = {USERCASH}; 
var maxBet = {MAXBET};
var minBet = {MINBET};
var randomnumber=Math.floor(Math.random()*5);
randomnumber = randomnumber + 2;
var totalDisplayed = 0; 
var winnum = {WINNUM}; 
interval *= 1000;

var image_index = 0;
image_list = new Array();
image_list[image_index++] = new imageItem(\"images/roulette/0.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/1.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/2.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/3.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/4.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/5.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/6.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/7.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/8.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/9.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/10.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/11.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/12.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/13.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/14.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/15.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/16.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/17.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/18.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/19.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/20.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/21.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/22.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/23.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/24.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/25.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/26.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/27.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/28.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/29.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/30.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/31.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/32.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/33.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/34.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/35.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/36.GIF\");
image_list[image_index++] = new imageItem(\"images/roulette/00.GIF\");
var number_of_image = image_list.length;

function imageItem(image_location) 
{
	this.image_item = new Image();
	this.image_item.src = image_location;
}
function get_ImageItemLocation(imageObj) 
{
	return(imageObj.image_item.src)
}
function generate(x, y) 
{
	var range = y - x + 1;
	return Math.floor(Math.random() * range) + x;
}
function getNextImage() 
{
	if (random_display) 
	{
		image_index = generate(0, number_of_image-1);
	}
	else 
	{
		image_index = (image_index+1) % number_of_image;
	}
	var new_image = get_ImageItemLocation(image_list[image_index]);
	return(new_image);
}
function rotateImage(place) 
{
	if(totalDisplayed==0)
	{
		document.getElementById('spinbut').disabled = true;
		document.getElementById('txtstatus').innerHTML =\"The wheel begins to spin!\";
	}
	var new_image = getNextImage();
	document[place].src = new_image;
	var recur_call = \"rotateImage('\"+place+\"')\";
	var win_call = \"winningImage('\"+place+\"')\";
	totalDisplayed=totalDisplayed+1;
	if(totalDisplayed<randomnumber)
	{
		setTimeout(recur_call, interval);
	}
	else
	{
		setTimeout(win_call, interval);
	}
}
function winningImage(place) 
{
	var new_image = get_ImageItemLocation(image_list[winnum]);
	document[place].src = new_image;
	document.cashin.cashinsub.disabled=false;
	if(winnum==37)
	{
		document.getElementById('txtstatus').innerHTML =\"The ball landed on 00.\";
	}
	else
	{
		document.getElementById('txtstatus').innerHTML =\"The ball landed on \"+winnum+\".\";
	}
}

function checkform ( form )
{
	if(form.amountBet.value == \"\") 
	{
		alert( \"You must enter a bet amount!\" );
		form.amountBet.focus();
		return false ;
	}
	else if(parseInt(form.amountBet.value) > userCash) 
	{
		alert( \"You don't have that much cash!\" );
		form.amountBet.focus();
		return false ;
	}
	else if(parseInt(form.amountBet.value) > maxBet) 
	{
		alert( \"That's higher than the bet limit!\" );
		form.amountBet.focus();
		return false ;
	}
	else if(parseInt(form.amountBet.value) < minBet) 
	{
		alert( \"That's lower than the bet limit!\" );
		form.amountBet.focus();
		return false ;
	}
	return true ;
}
//  End -->
</script>
";
///////////////////////////////////////////End JS///////////////////////////

global $error;
include "roulette_func.php";
include "globals.php";
$roul2=$db->query("SELECT * FROM roulette_stats LIMIT 1");
$rou2=$db->fetch_row($roul2);
print"<center>";

print"<h2>Roulette</h2>";

if($ir['user_level']==2)
{
	if($_GET['act']=='admin') 
	{
		$_POST['minbet']=abs(intval($_POST['minbet']));
		$_POST['maxbet']=abs(intval($_POST['maxbet']));
		$db->query("UPDATE roulette_stats SET minbet={$_POST['minbet']}, maxbet={$_POST['maxbet']}");
		$rou2['minbet']=$_POST['minbet'];
		$rou2['maxbet']=$_POST['maxbet'];
		
		print"<b>Min and Max Bets updated.</b><br /><br />";
	}
		$adst=$db->query("SELECT * FROM roulette_stats LIMIT 1");
		$adsta=$db->fetch_row($adst);
		print"<b>House Profit:</b> $".number_format($adsta['totHouseProfit'])."<br />";
		print"<b>Total Plays:</b> ".number_format($adsta['totPlays'])."<br />";
		print"<form action=roulette.php?act=admin method=post>
		Min Bet: $<input type=text name=minbet value={$adsta['minbet']} size=6><br />
		Max Bet: $<input type=text name=maxbet value={$adsta['maxbet']} size=6><br />
		<input type=submit value='Submit Change'>
		</form>";
}
print"<hr />";

if($_GET['act']=='bet') //spin wheel
{
	$betamt = abs(intval($_POST['amountBet']));
	if($_GET['type']) {$type = abs(intval($_GET['type']));}
	if($_POST['type']) {$type = abs(intval($_POST['type']));}
	$_POST['beton'] = abs(intval($_POST['beton']));
	if(!$error)
	{
		$_GET['type']=abs(intval($_GET['type']));
		$db->query("UPDATE users SET money=money-$betamt WHERE userid={$ir['userid']}");
		$db->query("UPDATE roulette_stats SET totHouseProfit=totHouseProfit+$betamt, totPlays=totPlays+1");
		$bettots=betToText($userid);
		$bettalk=explode(".", $bettots);
echo <<<EOF
		$bettalk[0].<br /><br />
		<img name="rImage" src="images/roulette/roulettewheel.gif"><br />
		<span id='txtstatus'>Your bet has been placed.</span>
		<br /><br />
		<button name='spinbut' id='spinbut' onClick="rotateImage('rImage')">Spin the Wheel!</button><br />
		<form action=roulette.php?act=cashin method=post name='cashin'>
		<input type=hidden name=type value=$type>
		<input type=hidden name=beton value={$_POST['beton']}>
		<input type=submit name='cashinsub' value='Cash In' disabled></form>
EOF;
	}
	else
	{
		print $error;
	}
}
else //bet
{
	$type = abs(intval($_POST['type']));
	$_POST['beton'] = abs(intval($_POST['beton']));
	if($_GET['act']=='cashin') //get cash
	{
		$realrou=$db->query("SELECT * FROM roulette WHERE userid=$userid");
		$doesitexistroul=$db->num_rows($realrou);
		$rouly=$db->fetch_row($realrou);
		if($doesitexistroul <= 0) 
		$error="You do not have any roulette games pending!";
		if(!$error)
		{
			$wincash = cashIn($userid);
			$db->query("UPDATE users SET money=money+$wincash WHERE userid=$userid");
			$db->query("UPDATE roulette_stats SET totHouseProfit=totHouseProfit-$wincash");
			$bettot=betToText($userid);
			print "<font size=2><b>$bettot";
			print "<br />You won $".number_format($wincash).".</b></font><br />
			<form action=roulette.php?act=bet&type=$type method=post><input type=hidden name='beton' value={$_POST['beton']}>
			<input type=hidden name=amountBet value={$rouly['betAmount']}><input type=submit value='Repeat Same Bet'></form>
			<br /><br />";
			$db->query("DELETE FROM roulette WHERE userid={$ir['userid']}");
		}
	}

	print"<font size=3><b>Betting</b></font><br />
	Min Bet: $".number_format($rou2['minbet'])." <br />
	Max Bet: $".number_format($rou2['maxbet']);

	print "<br /><br /><img src='images/roulette/roulettebetting.gif'><br /><br />
	<table><tr><td>
	<table class='table' width='200px'><tr><th colspan=2>Single Numbers (Payout: 35 to 1)</th></tr>
	<tr><td align=center><form action='roulette.php?act=bet&type=1' method='post' onsubmit='return checkform(this);'>
	Number: ".numbersDropDown(abs((int)$_GET['number']))."<br />
	Bet Amount: <input type=text name='amountBet' size=5><br />
	<input type=submit value='Place Bet!'></form></td></tr>
	</table><br /><br /></td>";

	print "<td>
	<table class='table' width='200px'><tr><th colspan=2>Columns (Payout: 2 to 1)</th></tr>
	<tr><td align=center><form action='roulette.php?act=bet&type=2' method='post' onsubmit='return checkform(this);'>
	Column #: <select name='beton' type='dropdown'>
	<option value='1'>1st Column</option>
	<option value='2'>2nd Column</option>
	<option value='3'>3rd Column</option>
	</select><br />
	Bet Amount: <input type=text name='amountBet' size=5><br />
	<input type=submit value='Place Bet!'></form></td></tr>
	</table><br /><br /></td></tr>";
	
	print "<tr><td>
	<table class='table' width='200px'><tr><th colspan=2>
	<form action='roulette.php?act=bet&type=3' method='post' onsubmit='return checkform(this);'>
	Rows (Payout: 2 to 1)</th></tr>
	<tr><td align=center>Row #: <select name='beton' type='dropdown'>
	<option value='1'>1st Row</option>
	<option value='2'>2nd Row</option>
	<option value='3'>3rd Row</option>
	</select><br />
	Bet Amount: <input type=text name='amountBet' size=5><br />
	<input type=submit value='Place Bet!'></form></td></tr>
	</table><br /><br /></td>";
	
	print "<td>
	<table class='table' width='200px'><tr><th colspan=2>
	<form action='roulette.php?act=bet&type=4' method='post' onsubmit='return checkform(this);'>
	Number Range (Payout: 1 to 1)</th></tr>
	<tr><td align=center>Range: <select name='beton' type='dropdown'>
	<option value='1'>1 - 18</option>
	<option value='2'>19 - 36</option>
	</select><br />
	Bet Amount: <input type=text name='amountBet' size=5><br />
	<input type=submit value='Place Bet!'></form></td></tr>
	</table><br /><br /></td></tr>";

	print "<tr><td>
	<table class='table' width='200px'><tr><th colspan=2>
	<form action='roulette.php?act=bet&type=5' method='post' onsubmit='return checkform(this);'>
	Even/Odd (Payout: 1 to 1)</th></tr>
	<tr><td align=center>Type: <select name='beton' type='dropdown'>
	<option value='1'>Even</option>
	<option value='2'>Odd</option>
	</select><br />
	Bet Amount: <input type=text name='amountBet' size=5><br />
	<input type=submit value='Place Bet!'></form></td></tr>
	</table><br /><br /></td>";
	
	print "<td>
	<table class='table' width='200px'><tr><th colspan=2>
	<form action='roulette.php?act=bet&type=6' method='post' onsubmit='return checkform(this);'>
	Color (Payout: 1 to 1)</th></tr>
	<tr><td align=center>Color: <select name='beton' type='dropdown'>
	<option value='1'>Red</option>
	<option value='2'>Black</option>
	</select><br />
	Bet Amount: <input type=text name='amountBet' size=5><br />
	<input type=submit value='Place Bet!'></form></td></tr>
	</table><br /><br /></td></tr></table>";
}
print"</center>";
$h->endpage();

?>