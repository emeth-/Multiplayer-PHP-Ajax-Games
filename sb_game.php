<?php

$gprefix = preg_replace("/[^a-z]/", "", $_GET['g']);
$gprefix = substr($gprefix, 0, 4); 


if (file_exists($gprefix."_config.php")) 
    include $gprefix."_config.php";
else 
    die("Error.");

$gamepage=$gpres;
$gameroomid=abs((int)$_GET['id']);
include "globals.php";
$id=$gameroomid;
print"
<center><div id = \"gamediv\">
<img src='{$teaser_image}' onerror=\"beginGameAjax({$id});\" onload=\"beginGameAjax({$id});\" onclick=\"beginGameAjax({$id});\">
<br /><button type=\"button\" onclick=\"beginGameAjax({$id});\">Begin Playing</button>
</div><br /><br /><br /><a href='sb_rooms.php?act=leave&g={$gpre}&id=$id'>&gt;Leave Room</a>";



print"<br /><br /><table class='table'><tr><th colspan=2>Game Chat</th></tr>";
print"<tr><td colspan=2>
<form method='post' name='postchat' onsubmit=\"return false;\" >
<center>
<input type='text' id='chattxtinput' name='chattxt' onKeyPress=\"if(enter_pressed(event)){ postFormAjax('{$gpre}play.php', 'postchat') }\">
<input type='hidden' id='gamename' name='game' value='{$gpres}'>
<input type='hidden' id='id' name='id' value='{$id}'>
<input type='button' name='buttonchat' id='buttonchat' value='Shout out' onclick=\"postFormAjax('{$gpre}play.php', 'postchat');\" />
</form>
</td></tr>
<tr><td>
<div id=\"gamechat\">
</div>
</td></tr>
</table></center>";


$h->endpage();
?>