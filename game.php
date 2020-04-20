<?PHP
$forums=1;
require "globals.php";
$_GET['id']=abs((int)$_GET['id']);
// Arrange url variables
$gameid = $_GET['id'];

// Security check
$gameinfo = mysql_fetch_array(mysql_query("SELECT * FROM flash2 WHERE id = '$gameid'"));

if(!$gameinfo[id])
{
print"game not found";
}
if($_GET['go']!=0)
{
print"<center><table><tr><td>";
include "sidebanner.php";
echo <<<EOF
</td><td>
<a href=game.php?id=$gameinfo[id]&go=1><center><font size=2>Click <br>here <br>to <br>continue <br>to <br>the <br>game...</font></a>
</td><td>
EOF;
include "sidebanner2.php";
echo <<<EOF
</td></tr></table>
EOF;
$h->endpage();
die("");
}
echo "<center>
<h1 style=\"padding: 0;margin:0; padding-top: 15px\">$gameinfo[game]</h1>
<table cellspacing=0 cellpadding=3 border=0>
<tr>
<td>

<table width=560 height=150 style=\"border: 1px solid #000000\" cellspacing=0 cellpadding=1>

<tr><td align=center valign=middle bordercolor=\"#000000\" bgcolor=\"#FFFFFF\" height=23>
<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"$gameinfo[width]\" height=\"$gameinfo[height]\">
<PARAM name=\"movie\" value=\"arcadefiles/$gameinfo[file].swf\">
<PARAM NAME=scale VALUE=noscale> 
<PARAM NAME=menu VALUE=false>
<PARAM name=\"quality\" value=\"high\">
<EMBED src=\"arcadefiles/$gameinfo[file].swf\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"$gameinfo[width]\" height=\"$gameinfo[height]\"></EMBED>
</OBJECT>
<br><br>";


$your = mysql_fetch_array(mysql_query("SELECT score FROM arcadepbest WHERE gameid=$gameid && userid='$userid'"));
$gameinfo[plays]=number_format($gameinfo[plays]);
$stype=$gameinfo['sortmethod'];
echo "<table width=95%><tr>
<td width=50%><center>";

$sc = $db->query("SELECT * FROM highscores WHERE gameid = '$gameid' && score!=0 ORDER BY score $stype, id ASC LIMIT 5");
print"<table width=80% class='table'>
<tr><th colspan=3>Top Scores</th></tr>
<tr><th>&nbsp;Rank&nbsp;<br /><img src=images/rank.jpg></th><th width=70%>Name</th><th>&nbsp;Score&nbsp;<br /><img src=images/rank.jpg></th>";
print"</tr>";
$i=0;
while($sco = $db->fetch_row($sc))
{
$i++;
$u = $db->query("SELECT username FROM users WHERE userid='{$sco['userid']}'");
$u2 = $db->fetch_row($u);
$sco['score']=number_format($sco['score']);
print"<tr><td><center>$i.</td><td width=70%><center>{$u2['username']}</center></td><td><center>{$sco['score']}</center></td></tr>";
}
print"</table><br />
<a href=highscores.php?id=$gameid>&gt;View All High Scores!</a>
";
print"</td>
<td width=50%><center><br />";
if($gameinfo[description] != "")
{
echo "<font color=black><b>Description:</b> $gameinfo[description]<br />";
}
if($your['score']){print"<strong>Your Best Score:</strong> ".number_format($your['score'])." points<br /><br />";}
echo "<strong>Total Plays:</strong> $gameinfo[plays] times<br />";
//if($gameinfo[minscore]){echo "<strong>Minimum score to earn points:</strong> $gameinfo[minscore] points<br />";}
/*
$sc2 = $db->query("SELECT * FROM arcadetrophy WHERE gameid = '$gameid' ORDER BY id DESC LIMIT 3");
print"<br /><br /><table width=80% class='table'>
<tr><th colspan=3>Last Month's winners</th></tr>
<tr><th>Place<br /><img src=images/rank.jpg></th><th width=70%>Name</th><th>&nbsp;Score&nbsp;<br /><img src=images/rank.jpg></th>";
print"</tr>";
$i=4;
$it=0;
while($sco2 = $db->fetch_row($sc2))
{
$i--;
$u = $db->query("SELECT username FROM users WHERE userid='{$sco2['userid']}'");
$u2 = $db->fetch_row($u);
$sco2['score']=number_format($sco2['score']);
$scp[$it]="<tr><td><center>$i</td><td width=70%><center>{$u2['username']}</center></td><td><center>{$sco2['score']}</center></td></tr>";
$it++;
}
print"{$scp[2]}{$scp[1]}{$scp[0]}</table><br /><br />";
 */
echo <<<EOF
</td>
</tr></table>
<br /><br />
Having trouble viewing the game? <a href=http://www.mozilla.com/en-US/firefox/>Get Firefox!</a><br /><br />
</td></tr></table>

</td></tr></table><br>
&gt;<a href=arcade.php>Back to Arcade</a>
<br /><br />
EOF;

// start score record
mysql_query("INSERT INTO flashscores VALUES('','$userid',$gameinfo[id],0,unix_timestamp(),0,0,'',0)");
$h->endpage();

?>