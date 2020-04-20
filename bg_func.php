<?php

function draw_board($roomid, $userid, $turn)
{
	global $db,$ir;

	$drawb = $db->query("SELECT * FROM bg_game WHERE bg_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);
	
	$txt="<center>
<table bgcolor='#FFFFFF'><tr>";
if($draw['dselected']==1){$d1ext = "p";$nomoredsel=1;}
if($draw['dselected']==2 && !$nomoredsel){$d2ext = "p";$nomoredsel=1;}
if($draw['dselected']==3 && !$nomoredsel){$d3ext = "p";$nomoredsel=1;}
if($draw['dselected']==4 && !$nomoredsel){$d4ext = "p";$nomoredsel=1;}

if($draw['d1']>0)
{
$txt.="<td>
<form method='post' name='sdie1'>
<input type=hidden name='sdie' value='1'>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/d{$draw['d1']}{$d1ext}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'sdie1');return false;\" />
</form>
</td>";
}
if($draw['d2']>0)
{
$txt.="<td>
<form method='post' name='sdie2'>
<input type=hidden name='sdie' value='2'>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/d{$draw['d2']}{$d2ext}.png\" border=0 name='diebutton2' id='diebutton2' value='Click' onclick=\"postFormAjax('bg_play.php', 'sdie2');return false;\" />
</form>
</td>";
}
if($draw['d3']>0)
{
$txt.="
<td>
<form method='post' name='sdie3'>
<input type=hidden name='sdie' value='3'>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/d{$draw['d3']}{$d3ext}.png\" border=0 name='diebutton3' id='diebutton3' value='Click' onclick=\"postFormAjax('bg_play.php', 'sdie3');return false;\" />
</form>
</td>
";
}
if($draw['d4']>0)
{
$txt.="
<td>
<form method='post' name='sdie4'>
<input type=hidden name='sdie' value='4'>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/d{$draw['d4']}{$d4ext}.png\" border=0 name='diebutton4' id='diebutton4' value='Click' onclick=\"postFormAjax('bg_play.php', 'sdie4');return false;\" />
</form>
</td>
";
}

if($turn==$userid)
{
$txt.="<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>
<form method='post' name='endturn'>
<input type=hidden name='endturn' value=1><input type=hidden name='id' value='{$roomid}'>
<input type='submit' border=0 name='movebutton' id='movebutton' value='End Turn' onclick=\"postFormAjax('bg_play.php', 'endturn');return false;\" />
</form>
</td>";
}
$txt.="</tr></table>
<table BORDER='0' cellpadding=0 cellspacing=0 ><tr>
<td width='32' align=center>{$draw['b13']}|{$draw['a13']}</td><td width='32' align=center>{$draw['b14']}|{$draw['a14']}</td>
<td width='32' align=center>{$draw['b15']}|{$draw['a15']}</td><td width='32' align=center>{$draw['b16']}|{$draw['a16']}</td>
<td width='32' align=center>{$draw['b17']}|{$draw['a17']}</td><td width='32' align=center>{$draw['b18']}|{$draw['a18']}</td>
<td width='32' align=center>{$draw['abar']}</td><td width='32' align=center>{$draw['b19']}</td>
<td width='32' align=center>{$draw['b20']}|{$draw['a20']}</td><td width='32' align=center>{$draw['b21']}|{$draw['a21']}</td>
<td width='32' align=center>{$draw['b22']}|{$draw['a22']}</td><td width='32' align=center>{$draw['b23']}|{$draw['a23']}</td>
<td width='32' align=center>{$draw['b24']}|{$draw['a24']}</td><td width='32' align=center>{$draw['b25']}</td>
</tr>
<tr><td colspan=14>
<table BORDER='0' cellpadding=0 cellspacing=0 height = '374' width='476' style=\"background: url('images/bg/background.png') no-repeat;\">";

	//top
	$txt.="<tr>";

if($draw['b13']>0){if($draw['b13']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b13'];}}
else if($draw['a13']>0){if($draw['a13']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a13'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move13'>
<input type=hidden name='move' value=13>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move13');return false;\" />
</form>
<br /></td>";

if($draw['b14']>0){if($draw['b14']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b14'];}}
else if($draw['a14']>0){if($draw['a14']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a14'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move14'>
<input type=hidden name='move' value=14>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move14');return false;\" />
</form>
<br /></td>";

if($draw['b15']>0){if($draw['b15']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b15'];}}
else if($draw['a15']>0){if($draw['a15']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a15'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move15'>
<input type=hidden name='move' value=15>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move15');return false;\" />
</form>
<br /></td>";

if($draw['b16']>0){if($draw['b16']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b16'];}}
else if($draw['a16']>0){if($draw['a16']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a16'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move16'>
<input type=hidden name='move' value=16>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move16');return false;\" />
</form>
<br /></td>";

if($draw['b17']>0){if($draw['b17']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b17'];}}
else if($draw['a17']>0){if($draw['a17']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a17'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move17'>
<input type=hidden name='move' value=17>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move17');return false;\" />
</form>
<br /></td>";

if($draw['b18']>0){if($draw['b18']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b18'];}}
else if($draw['a18']>0){if($draw['a18']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a18'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move18'>
<input type=hidden name='move' value=18>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move18');return false;\" />
</form>
<br /></td>";

if($draw['abar']>0){if($draw['abar']>=5){$imgnum = "w5b";$disnum=1;}else{$imgnum = "w".$draw['abar']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move27'>
<input type=hidden name='move' value=27>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move27');return false;\" />
</form>
</td>";

if($draw['b19']>0){if($draw['b19']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b19'];}}
else if($draw['a19']>0){if($draw['a19']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a19'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move19'>
<input type=hidden name='move' value=19>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move19');return false;\" />
</form>
<br /></td>";

if($draw['b20']>0){if($draw['b20']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b20'];}}
else if($draw['a20']>0){if($draw['a20']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a20'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move20'>
<input type=hidden name='move' value=20>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move20');return false;\" />
</form>
<br /></td>";

if($draw['b21']>0){if($draw['b21']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b21'];}}
else if($draw['a21']>0){if($draw['a21']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a21'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move21'>
<input type=hidden name='move' value=21>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move21');return false;\" />
</form>
<br /></td>";

if($draw['b22']>0){if($draw['b22']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b22'];}}
else if($draw['a22']>0){if($draw['a22']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a22'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move22'>
<input type=hidden name='move' value=22>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move22');return false;\" />
</form>
<br /></td>";

if($draw['b23']>0){if($draw['b23']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b23'];}}
else if($draw['a23']>0){if($draw['a23']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a23'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move23'>
<input type=hidden name='move' value=23>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move23');return false;\" />
</form>
<br /></td>";

if($draw['b24']>0){if($draw['b24']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b24'];}}
else if($draw['a24']>0){if($draw['a24']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a24'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move24'>
<input type=hidden name='move' value=24>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move24');return false;\" />
</form>
<br /></td>";

$txt.="<td align=center style=\"font-size:0;\">";
$homeleft = $draw['b25'];
$blankleft = 16-$homeleft;
while($homeleft>0)
{
	$txt.="<img src='images/bg/bsingle.png'><br />";
	$homeleft--;
}
while($blankleft>0)
{
	$txt.="<img src='images/bg/blanksingle.png'><br />";
	$blankleft--;
}
$txt.="</td>";

	$txt.="</tr>";
	
	//bottom
	$txt.="<tr>";

if($draw['b12']>0){if($draw['b12']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b12']."b";}}
else if($draw['a12']>0){if($draw['a12']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a12']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move12'>
<input type=hidden name='move' value=12>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move12');return false;\" />
</form>
</td>";

if($draw['b11']>0){if($draw['b11']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b11']."b";}}
else if($draw['a11']>0){if($draw['a11']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a11']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move11'>
<input type=hidden name='move' value=11>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move11');return false;\" />
</form>
</td>";

if($draw['b10']>0){if($draw['b10']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b10']."b";}}
else if($draw['a10']>0){if($draw['a10']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a10']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move10'>
<input type=hidden name='move' value=10>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move10');return false;\" />
</form>
</td>";

if($draw['b9']>0){if($draw['b9']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b9']."b";}}
else if($draw['a9']>0){if($draw['a9']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a9']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move9'>
<input type=hidden name='move' value=9>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move9');return false;\" />
</form>
</td>";

if($draw['b8']>0){if($draw['b8']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b8']."b";}}
else if($draw['a8']>0){if($draw['a8']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a8']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move8'>
<input type=hidden name='move' value=8>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move8');return false;\" />
</form>
</td>";

if($draw['b7']>0){if($draw['b7']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b7']."b";}}
else if($draw['a7']>0){if($draw['a7']>=5){$imgnum = "w7";$disnum=1;}else{$imgnum = "w".$draw['a7']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move7'>
<input type=hidden name='move' value=7>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move7');return false;\" />
</form>
</td>";

if($draw['bbar']>0){if($draw['bbar']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['bbar'];}}
else{$imgnum = "blank";}
$txt.="<td align=center>
<form method='post' name='move26'>
<input type=hidden name='move' value=26>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move26');return false;\" />
</form>
<br /></td>";

if($draw['b6']>0){if($draw['b6']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b6']."b";}}
else if($draw['a6']>0){if($draw['a6']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a6']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move6'>
<input type=hidden name='move' value=6>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move6');return false;\" />
</form>
</td>";

if($draw['b5']>0){if($draw['b5']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b5']."b";}}
else if($draw['a5']>0){if($draw['a5']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a5']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move5'>
<input type=hidden name='move' value=5>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move5');return false;\" />
</form>
</td>";

if($draw['b4']>0){if($draw['b4']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b4']."b";}}
else if($draw['a4']>0){if($draw['a4']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a4']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move4'>
<input type=hidden name='move' value=4>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move4');return false;\" />
</form>
</td>";

if($draw['b3']>0){if($draw['b3']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b3']."b";}}
else if($draw['a3']>0){if($draw['a3']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a3']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move3'>
<input type=hidden name='move' value=3>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move3');return false;\" />
</form>
</td>";

if($draw['b2']>0){if($draw['b2']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b2']."b";}}
else if($draw['a2']>0){if($draw['a2']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a2']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move2'>
<input type=hidden name='move' value=2>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move2');return false;\" />
</form>
</td>";

if($draw['b1']>0){if($draw['b1']>=5){$imgnum = "b5";$disnum=1;}else{$imgnum = "b".$draw['b1']."b";}}
else if($draw['a1']>0){if($draw['a1']>=5){$imgnum = "w5";$disnum=1;}else{$imgnum = "w".$draw['a1']."b";}}
else{$imgnum = "blank";}
$txt.="<td align=center><br />
<form method='post' name='move1'>
<input type=hidden name='move' value=1>
<input type=hidden name='id' value='{$roomid}'><input type='image' src=\"images/bg/{$imgnum}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('bg_play.php', 'move1');return false;\" />
</form>
</td>";

$txt.="<td align=center style=\"font-size:0;\">";
$homeleft = $draw['a0'];
$blankleft = 16-$homeleft;
while($blankleft>0)
{
	$txt.="<img src='images/bg/blanksingle.png'><br />";
	$blankleft--;
}
while($homeleft>0)
{
	$txt.="<img src='images/bg/wsingle.png'><br />";
	$homeleft--;
}
$txt.="</td>";

	$txt.="</tr></table></td></tr>
<tr>
<td width='32' align=center>{$draw['b12']}|{$draw['a12']}</td><td width='32' align=center>{$draw['b11']}|{$draw['a11']}</td>
<td width='32' align=center>{$draw['b10']}|{$draw['a10']}</td><td width='32' align=center>{$draw['b9']}|{$draw['a9']}</td>
<td width='32' align=center>{$draw['b8']}|{$draw['a8']}</td><td width='32' align=center>{$draw['b7']}|{$draw['a7']}</td>
<td width='32' align=center>{$draw['bbar']}</td><td width='32' align=center>{$draw['b6']}|{$draw['a6']}</td>
<td width='32' align=center>{$draw['b5']}|{$draw['a5']}</td><td width='32' align=center>{$draw['b4']}|{$draw['a4']}</td>
<td width='32' align=center>{$draw['b3']}|{$draw['a3']}</td><td width='32' align=center>{$draw['b2']}|{$draw['a2']}</td>
<td width='32' align=center>{$draw['b1']}|{$draw['a1']}</td><td width='32' align=center>{$draw['a0']}</td>
</tr>
</table>";

$txt = str_replace("|0</td><td width='32'", "</td><td width='32'", $txt);
$txt = str_replace("|0</td>\n<td width='32'", "</td>\n<td width='32'", $txt);
$txt = str_replace("width='32' align=center>0|", "width='32' align=center>", $txt);
$txt = str_replace("<td width='32' align=center>0</td>", "<td width='32' align=center>&nbsp;</td>", $txt);

	print $txt;
}


function select_dice($sdie, $userid, $roomid)
{
	global $db,$ir;	

	$game=$db->query("SELECT * FROM bg_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);
	$turn = $ga['turn'];

	if($turn==$userid)
	{
		$ginfo = $db->query("SELECT * FROM bg_game WHERE bg_room=$roomid");
		$gin = $db->fetch_row($ginfo);
		if(($sdie==1 && $gin['d1']>0) || ($sdie==2 && $gin['d2']>0) || ($sdie==3 && $gin['d3']>0) || ($sdie==4 && $gin['d4']>0))
		{
			$db->query("UPDATE bg_game SET dselected=$sdie WHERE bg_room=$roomid");
		}

	}

}

function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game=$db->query("SELECT * FROM bg_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);
	$turn = $ga['turn'];
	$catch = 0;
	if($turn==$userid)
	{
		$ginfo = $db->query("SELECT * FROM bg_game WHERE bg_room=$roomid");
		$gin = $db->fetch_row($ginfo);
		
		if($userid == $gin['black']) {$movefrom = "b".$move;} 
		else {$movefrom = "a".$move;}
		
		$dsel = $gin['dselected']; // which dice is selected
		$dval = $gin["d".$dsel]; // value of dice selected
		$dname = "d".$dsel;

	

		if($gin["$movefrom"] > 0 || ($userid == $gin['black'] && $gin['bbar'] > 0 && $move == 26) || ($userid != $gin['black'] && $gin['abar'] > 0 && $move == 27) ) // they have at least one in the square
		{
			if($userid == $gin['black']) //black 
			{
				$nextspot = $move + $dval;
				//normal move
				if(($gin["a".$nextspot] <= 1) && ($nextspot < 25) && ($gin['bbar'] == 0)) // nothing on bbar
				{
					$temp = "b".$nextspot;
					$temp2 = "a".$nextspot;
					if($gin["a".$nextspot] == 1)
					{
						$db->query("UPDATE bg_game SET abar = abar + 1, $temp2=0 WHERE bg_room=$roomid");
					}
					$db->query("UPDATE bg_game SET $temp=$temp+1,$movefrom=$movefrom-1,$dname = 0,dselected = 0 WHERE bg_room=$roomid");
					$db->query("UPDATE bg_room SET play_time=unix_timestamp() WHERE id=$roomid");
					$gin["$dname"]=0;
				}
				//if they have pieces on the bar
				if($gin['bbar'] > 0 && $move == 26)
				{
					if($gin["a".$dval] <= 1)
					{
						$temp = "b".$dval;
						$temp2 = "a".$dval;
						if($gin["a".$dval] == 1)
						{
							$db->query("UPDATE bg_game SET abar = abar + 1, $temp2=0 WHERE bg_room=$roomid");
						}
						$db->query("UPDATE bg_game SET $temp=$temp+1,bbar=bbar-1,$dname = 0,dselected = 0 WHERE bg_room=$roomid");
						$db->query("UPDATE bg_room SET play_time=unix_timestamp() WHERE id=$roomid");
						$gin["$dname"]=0;
					}
				}
				//moving into home
				if($nextspot >= 25 && $move !=26 && $move !=27 && $gin['bbar'] == 0)
				{
					$temp = $gin['b19'] + $gin['b20'] + $gin['b21'] + $gin['b22'] + $gin['b23'] + $gin['b24']+ $gin['b25']; 
					if($temp == 15)
					{
						$temp = "b".$move;
						$db->query("UPDATE bg_game SET b25=b25+1, $temp = $temp -1,$dname = 0,dselected = 0 WHERE bg_room=$roomid");
						$db->query("UPDATE bg_room SET play_time=unix_timestamp() WHERE id=$roomid");			
						$gin["$dname"]=0;
					}
					$winner = check_win($roomid);
					
					if($winner != 0)
					{
						$catch = 1;
						award_win($roomid,$winner);
					}
				}
			}
			else //white
			{
				$nextspot = $move - $dval;
				//normal move
				if(($gin["b".$nextspot] <= 1) && ($nextspot > 0) && ($gin['abar'] == 0))
				{
					$temp = "a".$nextspot;
					$temp2 = "b".$nextspot;
					if($gin["b".$nextspot] == 1)
					{
						$db->query("UPDATE bg_game SET bbar = bbar + 1, $temp2=0 WHERE bg_room=$roomid");
					}
					$db->query("UPDATE bg_game SET $temp=$temp+1,$movefrom=$movefrom-1,$dname = 0,dselected = 0 WHERE bg_room=$roomid");
					$db->query("UPDATE bg_room SET play_time=unix_timestamp() WHERE id=$roomid");
					$gin["$dname"]=0;
				}
				//if they have pieces on the bar
				if($gin['abar'] > 0 && $move == 27)
				{
					$temp2 = 25 - $dval;
					$temp = "a".$temp2;
					$temp3 = "b".$temp2;
					if($gin["$temp3"] <= 1)
					{	
						if($gin["$temp3"] == 1)
						{
							$db->query("UPDATE bg_game SET bbar = bbar + 1, $temp3=0 WHERE bg_room=$roomid");
						}
						$db->query("UPDATE bg_game SET $temp=$temp+1,abar=abar-1,$dname = 0,dselected = 0 WHERE bg_room=$roomid");
						$db->query("UPDATE bg_room SET play_time=unix_timestamp() WHERE id=$roomid");
						$gin["$dname"]=0;
					}
				}
		
				//moving into home
				if($nextspot <= 0 && $move !=26 && $move !=27 && $gin['abar'] == 0)
				{
					$temp = $gin['a0'] + $gin['a1'] + $gin['a2'] + $gin['a3'] + $gin['a4'] + $gin['a5']+ $gin['a6']; 
					if($temp == 15)
					{
						$temp = "a".$move;
						$db->query("UPDATE bg_game SET a0=a0+1, $temp = $temp -1,$dname = 0,dselected = 0 WHERE bg_room=$roomid");
						$db->query("UPDATE bg_room SET play_time=unix_timestamp() WHERE id=$roomid");			
						$gin["$dname"]=0;
					}
					$winner = check_win($roomid);

					if($winner != 0)
					{
						$catch = 1;
						award_win($roomid,$winner);
					}
				}
			}
//check for end of turn

			if($gin['d1'] == 0 && $gin['d2'] ==0 && $gin['d3'] ==0 && $gin['d4'] ==0)
			{
				if($catch == 0){toggle_turn($roomid);} //only toggle turn if no win yet
			}
//select last die
			if($gin['d1'] > 0 && $gin['d2'] ==0 && $gin['d3'] == 0 && $gin['d4'] == 0)
			{
				$db->query("UPDATE bg_game SET dselected=1 WHERE bg_room=$roomid");
			}
			if($gin['d1'] == 0 && $gin['d2'] >0 && $gin['d3'] == 0 && $gin['d4'] == 0)
			{
				$db->query("UPDATE bg_game SET dselected=2 WHERE bg_room=$roomid");
			}
			if($gin['d1'] == 0 && $gin['d2'] ==0 && $gin['d3'] > 0 && $gin['d4'] == 0)
			{
				$db->query("UPDATE bg_game SET dselected=3 WHERE bg_room=$roomid");
			}
			if($gin['d1'] == 0 && $gin['d2'] ==0 && $gin['d3'] == 0 && $gin['d4'] > 0)
			{
				$db->query("UPDATE bg_game SET dselected=4 WHERE bg_room=$roomid");
			}

		}
	}

	else
	{

	//print "<a href=\"http://www.seanybob.net/fail.html\" onclick=\"window.open('http://www.seanybob.net/fail.html','popup','width=500,height=500,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=0,top=0'); return false\">About</a>";

	}
}


function end_turn($userid, $roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM bg_room WHERE id = $roomid"));
	if($ui['turn']==$userid)
	{
		$db->query("UPDATE bg_game SET d1=0,d2=0,d3=0,d4=0,dselected=0 WHERE bg_room=$roomid");
		toggle_turn($roomid);
	}
}

function roll_dice($roomid)
{
	global $db,$ir;
	$d1 = rand(1,6);
	$d2 = rand(1,6);
	$db->query("UPDATE bg_game SET d1=0,d2=0,d3 =0,d4=0 WHERE bg_room=$roomid");
	if($d1 == $d2)
	{
		$db->query("UPDATE bg_game SET d1=$d1,d2=$d1,d3=$d1,d4=$d1 WHERE bg_room=$roomid");
	}
	else
	{
		$db->query("UPDATE bg_game SET d1=$d1,d2=$d2 WHERE bg_room=$roomid");
	}
}
function check_win($roomid)
{
	global $db,$ir;

	$winner = 0;

	$ginf = $db->query("SELECT * FROM bg_game WHERE bg_room = $roomid");
	$gin = $db->fetch_row($ginf);

	if($gin['b25'] >= 15)
	{
		$winner = $gin['black'];
	}
	else if($gin['a0'] >= 15 )
	{
		if($gin['black'] == $gin['p1'])
		{
			$winner = $gin['p2'];
		}
		else
		{
			$winner = $gin['p1'];
		}
	}
	//Return the winner's userid
	return $winner;
}

function create_game($roomid)
{
	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT bg_room FROM bg_game WHERE bg_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM bg_room WHERE id=$roomid"));

		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		$db->query("UPDATE bg_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO bg_game (bg_room, {$firstmovemarkfield}, p1, p2) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']})");
	}
	roll_dice($roomid);
}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM bg_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE bg_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE bg_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	roll_dice($roomid);
}


?>