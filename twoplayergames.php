<?php
$twoplayer=1;
include "globals.php";
print"<center>";
if($ir['guest']==0){$achist = "<a href='multihistory.php?act=viewrecent'>View your 2-player game history.</a><br /><br />";}

print"{$achist}";

$muga = $db->query("SELECT * FROM multgames ORDER BY name ASC");
while($mug = $db->fetch_row($muga))
{
    
print"<table class='table'>";
print"<tr><th colspan=6><h3>{$mug['name']}</h3>";
print"<a href='challenge.php?act=prechallenge&game={$mug['short']}'>Challenge a friend!</a> | <a href='sb_rooms.php?g={$mug['short']}'>Rooms</a> | 
<a href='sb_halloffame.php?g={$mug['short']}'>Hall of Fame</a> | <a href='sb_rooms.php?g={$mug['short']}&act=rules'>Rules</a><br />&nbsp;</th>
<td rowspan=3 width=100 align=center style=\"background-color: #FFFFFF;\"><img src='images/{$mug['name']}.png'></td></tr>";
$stranks = $db->query("SELECT * FROM {$mug['short']}_ranks WHERE userid='$userid'");
if($db->num_rows($stranks)>0)
{
    $mymsr = $db->fetch_row($stranks);
    $rating = $mymsr['rating'];
    $wins = $mymsr['wins'];
    $losses = $mymsr['losses'];
    $ties = $mymsr['ties'];
    $totgames = $mymsr['totgames'];
    $ratio = $mymsr['ratio'];
}
else
{
    $rating = 1200;
    $wins = 0;
    $losses = 0;
    $ties = 0;
    $totgames = 0;
    $ratio = 0;
}
if($totgames > 0){$ratio = ($wins / $totgames) * 100;$ratio=number_format($ratio);}
else{$ratio=0;}
$ratio = "{$ratio}%";
print"<tr><th>My Rating</th><th>Win Ratio</th><th>Wins</th><th>Losses</th><th>Ties</th><th>Total Games</th></tr>";
print"<tr><td align='center'>$rating</td><td align='center'>$ratio</td><td align='center'>$wins</td><td align='center'>$losses</td><td align='center'>$ties</td><td align='center'>$totgames</td></tr>";
print"</table><br /><br />";
}

print"<table class='table'>";
print"<tr><th colspan=6><a href='sb_rooms.php?g=ttt'><h3>Tic-Tac-Toe</h3></a></th></tr>";
print"</table><br /><br />";

print"</center>";


$h->endpage();
?>
