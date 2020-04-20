<?php

//had to edit header file
$blackjackjs="
<SCRIPT LANGUAGE=\"JavaScript\">
<!-- Begin

var interval = 1.5; 
var random_display = 1; 
var userCash = {USERCASH}; 
var imagenumber = 0;
var txt1 = \"{TXT1}\";
var txt2 = \"{TXT2}\";
var txt3 = \"{TXT3}\";
var txt4 = \"{TXT4}\";
var scor1 = {SCORE1};
var scor2 = {SCORE2};
var scor3 = {SCORE3};
var scor4 = {SCORE4};
var maxBet = {MAXBET};
var minBet = {MINBET};
var randomnumber=Math.floor(Math.random()*5);
randomnumber = randomnumber + 2;
interval *= 1000;

var image_index = 0;
image_list = new Array();
image_list[image_index++] = new imageItem(\"{DCARD1}\");
image_list[image_index++] = new imageItem(\"{DCARD3}\");
image_list[image_index++] = new imageItem(\"{DCARD4}\");
image_list[image_index++] = new imageItem(\"{DCARD5}\");
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
function rotateImage(place) 
{
	document.getElementById('dealersbutton').disabled = true;
	var new_image = get_ImageItemLocation(image_list[imagenumber]);
	document[place].src = new_image;
	imagenumber++;
	if(imagenumber==1)
	{
		if(scor1>=17){imagenumber=4;}
		document.getElementById('txtstatus').innerHTML = txt1;
		place=\"dealer3\";
	}
	if(imagenumber==2)
	{
		if(scor2>=17){imagenumber=4;}
		document.getElementById('txtstatus').innerHTML = txt2;
		place=\"dealer4\";
	}
	if(imagenumber==3)
	{
		if(scor3>=17){imagenumber=4;}
		document.getElementById('txtstatus').innerHTML = txt3;
		place=\"dealer5\";
	}
	if(imagenumber==4)
	{
		if(scor3>=17){imagenumber=4;}
		else{document.getElementById('txtstatus').innerHTML = txt4;}
		document.getElementById('end1').disabled = false;
		document.getElementById('end2').disabled = false;
		document.getElementById('finaltext').style.visibility = \"visible\";
	}
	var recur_call = \"rotateImage('\"+place+\"')\";
	if(imagenumber<=3)
	{
		setTimeout(recur_call, interval);
	}
}

function checkform ( form )
{
	if(form.betamount.value == \"\") 
	{
		alert( \"You must enter a bet amount!\" );
		form.betamount.focus();
		return false ;
	}
	else if(parseInt(form.betamount.value) > userCash) 
	{
		alert( \"You don't have that much cash!\" );
		form.betamount.focus();
		return false ;
	}
	else if(parseInt(form.betamount.value) > maxBet) 
	{
		alert( \"That's higher than the bet limit!\" );
		form.betamount.focus();
		return false ;
	}
	else if(parseInt(form.betamount.value) < minBet) 
	{
		alert( \"That's lower than the bet limit!\" );
		form.betamount.focus();
		return false ;
	}
	return true ;
}
//  End -->
</script>
";
///////////////////////////////////////////End JS///////////////////////////

//SIMULATE DEALER PLAYING WITH JAVASCRIPT
//PLAYER LOSS WITH JAVASCRIPT (PHP BACKUP)
include "blackjack_func.php";
include "globals.php";
print"<center><h2>Blackjack</h2>";
$adst=$db->query("SELECT * FROM blackjack_stats LIMIT 1");
$bjstats=$db->fetch_row($adst);
if($ir['user_level']==2)
{
	print"<hr />
	Stats:<br />
	<b>House Profit:</b> $".number_format($bjstats['houseProfit'])."<br />
	<b>Total Plays:</b> ".number_format($bjstats['totalPlays'])."<br />
	<hr />";
}
print"<b>Blackjack Pays 3 to 2 -- Dealer Stands On All 17 -- No Splits</b>";
$pcar=$db->query("SELECT * FROM blackjack WHERE userid='$userid'");
$bb=$db->fetch_row($pcar);
$playingbj=$db->num_rows($pcar);
	print"<br /><br />";
if(!$_GET['act'] || $_GET['act']=='admin')
{
	if($ir['user_level']==1)
	{
		print"<br /><b>Minimum Bet:</b> $".number_format($bjstats['minbet'])."<br />
		<b>Maximum Bet:</b> $".number_format($bjstats['maxbet']);
	}
	else if($ir['user_level']==2)
	{
		if($_GET['act']=='admin')
		{
			$minbeta=abs(intval($_POST['minbet']));
			$maxbeta=abs(intval($_POST['maxbet']));
			$db->query("UPDATE blackjack_stats SET minbet=$minbeta, maxbet=$maxbeta");
			print"<br /><b>Betting info updated!</b><br />";
			$bjstats['minbet']=$minbeta;
			$bjstats['maxbet']=$maxbeta;
		}
		print"<br /><form method=post action=blackjack.php?act=admin>
		<b>Minimum Bet:</b> <input type=text name=minbet value={$bjstats['minbet']}><br />
		<b>Maximum Bet:</b> <input type=text name=maxbet value={$bjstats['maxbet']}>
		<br /><input type=submit value='Submit Changes'></form>";
	}
	print"<br /><br />";
	$defaultbet = ((int)($ir['money']/1000));
	if($defaultbet<$bjstats['minbet']){$defaultbet=$bjstats['minbet'];}
	print"<form action=blackjack.php?act=deal method=post onsubmit='return checkform(this);'>
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
		$error='Sorry, you do not have that much money.<br />&gt;<a href=blackjack.php>Back</a>';
	}	
	if($betamt < $bjstats['minbet'])
	{
		$error='Sorry, that is lower than the minimum bet.<br />&gt;<a href=blackjack.php>Back</a>';
	}
	if($betamt > $bjstats['maxbet'])
	{
		$error='Sorry, that is greater than the maximum bet.<br />&gt;<a href=blackjack.php>Back</a>';
	}
	if($betamt <= 0)
	{
		$error='Sorry, you must bet more than $0.<br />&gt;<a href=blackjack.php>Back</a>';
	}
	if(!$error)
	{
		$db->query("UPDATE users SET money=money-$betamt WHERE userid='$userid'");
		$db->query("UPDATE blackjack_stats SET houseProfit=houseProfit+$betamt, totalPlays=totalPlays+1");
		$db->query("DELETE FROM blackjack WHERE userid='$userid'");
		print"You bet: <b>$".number_format($betamt)."</b>.<br /><br />";
		deal_cards($userid, $betamt);
		$cards=show_cards($userid, 1);
		print"$cards<br />";
		print"<form method=post action='blackjack.php?act=hit'><input type=submit value='Hit'></form>
		&nbsp;&nbsp;<form method=post action='blackjack.php?act=stand'><input type=submit value='Stand'></form>";
		if($betamt*2<$ir['money'])print"&nbsp;&nbsp;<form method=post action='blackjack.php?act=double'><input type=submit value='Double Down'></form>";
	}
	else
	{
		print $error;
	}
}
else if($_GET['act']=='hit')
{
	if(!$playingbj)
	{
		$error="You do not have an active blackjack game. Begin a new one <a href=blackjack.php>HERE</a>.";
	}
	if(!$error)
	{
		print"You bet: <b>$".number_format($bb['betAmount'])."</b>.<br /><br />";
		$db->query("UPDATE blackjack SET uNumHits=uNumHits+1 WHERE userid='$userid'");
		$cards=show_cards($userid, 1);
		$playerhas = calc_playerscore($userid);
		print"$cards<br />";
		if($playerhas > 21)
		{
			print "You went bust.";
			$db->query("DELETE FROM blackjack WHERE userid='$userid'");
			print"<form method=post action='blackjack.php?act=deal'><input type=hidden name=betamount value={$bb['betAmount']}><input type=submit value='New Game Same Bet'></form>
			&nbsp;&nbsp;<form method=post action='blackjack.php'><input type=submit value='New Game Change Bet'></form>";
		}
		else
		{
			print"<form method=post action='blackjack.php?act=hit'><input type=submit value='Hit'></form>
			&nbsp;&nbsp;<form method=post action='blackjack.php?act=stand'><input type=submit value='Stand'></form>";
			//<input type=submit value='Double'>
		}
	}
	else
	{
		print $error;
	}
}
else if($_GET['act']=='double')///////////////////////////////////////////////////////////////////////////////////////////////
{
	if($bb['betAmount'] * 2 > $ir['points'])
	{
	   $fix_1 = "DELETE FROM blackjack WHERE userid = '{$ir['userid']}'";
	   $db->query($fix_1);
	   $error="You do not have that much money. Click <a href=blackjack.php>HERE</a> to start over.";
	}
	if(!$playingbj)
	{
		$error="You do not have an active blackjack game. Begin a new one <a href=blackjack.php>HERE</a>.";
	}
	if($bb['uNumHits']>0)
	{
		$error="You cannot double down after you have hit.";
	}
	if(!$error)
	{
		$oldbet=$bb['betAmount'];
		$bb['betAmount']=$bb['betAmount']*2;
		$db->query("UPDATE blackjack SET betAmount={$bb['betAmount']} WHERE userid='$userid'");
		$db->query("UPDATE users SET money=money-$oldbet WHERE userid='$userid'");
		print"You bet: <b>$".number_format($bb['betAmount'])." (Doubled Down)</b>.<br /><br />";
		$db->query("UPDATE blackjack SET uNumHits=uNumHits+1 WHERE userid='$userid'");
		$playerhas = calc_playerscore($userid);
		if($playerhas > 21)
		{
			$cards=show_cards($userid, 1);
			print"$cards<br />";
			print "You went bust.";
			$db->query("DELETE FROM blackjack WHERE userid='$userid'");
			print"<form method=post action='blackjack.php?act=deal'><input type=hidden name=betamount value=$oldbet><input type=submit value='New Game Same Bet'></form>
			&nbsp;&nbsp;<form method=post action='blackjack.php'><input type=submit value='New Game Change Bet'></form>";
		}
		else
		{
			dealer_play($userid);
			$dscore=calc_dealerscore($userid);	
			$cards=show_cards($userid, 2);
			print"<button name='dealersbutton' id='dealersbutton' onClick=\"rotateImage('dealer1')\">Click to begin dealer's turn</button><br />";
			print"$cards<br />";
			$win=find_winner($userid);
			if($win==-1) //push
			{
				$winamt=$bb['betAmount'];
				$wtxt="You and the dealer tied. You received your bet amount back.";
				$db->query("UPDATE users SET money=money+$winamt WHERE userid='$userid'");
			}
			else if($win==1) //reg win
			{
				$winamt=$bb['betAmount']*2;
				$wtxt="Your hand beat the dealer's!";
				$db->query("UPDATE users SET money=money+$winamt WHERE userid='$userid'");
			}
			else if($win==2) //blackjack
			{
				$winamt=($bb['betAmount']*2)+($bb['betAmount']/2);
				$wtxt="Your blackjack beat the dealer's hand!";
				$db->query("UPDATE users SET money=money+$winamt WHERE userid='$userid'");
			}
			else //no win
			{
				$wtxt="You lost to the dealer!";
				$winamt=0;
			}
			print"<div id=\"finaltext\" style=\"visibility:hidden\">$wtxt <br /><b>$".number_format($winamt)."</b> was added to your wallet!<br /><br /></div>";
			$db->query("DELETE FROM blackjack WHERE userid='$userid'");
			print"<form method=post action='blackjack.php?act=deal'><input type=hidden name=betamount value=$oldbet>
			<input type=submit id='end1' disabled=true value='New Game Same Bet'></form>
			&nbsp;&nbsp;<form method=post action='blackjack.php'><input type=submit id='end2' disabled=true value='New Game Change Bet'></form>";
		}
	}
	else
	{
		print $error;
	}
}
else if($_GET['act']=='stand')
{
	$playerhas = calc_playerscore($userid);
	if($playerhas > 21) //to prevent cheaters.
	{
		$error= "You went bust.";
		$db->query("DELETE FROM blackjack WHERE userid='$userid'");
	}
	if(!$playingbj)
	{
		$error="You do not have an active blackjack game. Begin a new one <a href=blackjack.php>HERE</a>.";
	}
	if(!$error)
	{
		print"You bet: <b>$".number_format($bb['betAmount'])."</b>.<br /><br />";
		dealer_play($userid);
		$dscore=calc_dealerscore($userid);	
		$cards=show_cards($userid, 2);
		print"<button name='dealersbutton' id='dealersbutton' onClick=\"rotateImage('dealer1')\">Click to begin dealer's turn</button><br />";
		print"$cards<br />";
		$win=find_winner($userid);
		if($win==-1) //push
		{
			$winamt=$bb['betAmount'];
			$wtxt="You and the dealer tied. You received your bet amount back.";
			$db->query("UPDATE users SET money=money+$winamt WHERE userid='$userid'");
		}
		else if($win==1) //reg win
		{
			$winamt=$bb['betAmount']*2;
			$wtxt="Your hand beat the dealer's!";
			$db->query("UPDATE users SET money=money+$winamt WHERE userid='$userid'");
		}
		else if($win==2) //blackjack
		{
			$winamt=($bb['betAmount']*2)+($bb['betAmount']/2);
			$wtxt="Your blackjack beat the dealer's hand!";
			$db->query("UPDATE users SET money=money+$winamt WHERE userid='$userid'");
		}
		else //no win
		{
			$wtxt="You lost to the dealer!";
			$winamt=0;
		}
		print"<div id=\"finaltext\" style=\"visibility:hidden\">$wtxt <br /><b>$".number_format($winamt)."</b> was added to your wallet!<br /><br /></div>";
		$db->query("DELETE FROM blackjack WHERE userid='$userid'");
		print"<form method=post action='blackjack.php?act=deal'><input type=hidden name=betamount value={$bb['betAmount']}>
		<input type=submit id='end1' disabled=true value='New Game Same Bet'></form>
		&nbsp;&nbsp;<form method=post action='blackjack.php'><input type=submit disabled=true id='end2' value='New Game Change Bet'></form>";
	}
	else
	{
		print $error;
	}
}

print"</center>";
$h->endpage();

?>