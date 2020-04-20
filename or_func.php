<?php

function draw_board($roomid, $userid, $turn)
{

	global $db,$ir;

	$drawb = $db->query("SELECT * FROM or_game WHERE or_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);

	$black = $draw['black'];
	
	if($draw['black'] == $draw['p1']){$white = $draw['p2'];}
	else{$white = $draw['p1'];}
	
//row 1

if($draw['b11']==$black){$b11 = "<form method='post' name='m11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='mb11' id='mb11' value='Click' onclick=\"postFormAjax('or_play.php', 'm11');return false;\" /></form>";} 
else if($draw['b11']==$white){$b11 = "<form method='post' name='m11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='mb11' id='mb11' value='Click' onclick=\"postFormAjax('or_play.php', 'm11');return false;\" /></form>";} 
else{$b11 = "<form method='post' name='m11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='mb11' id='mb11' value='Click' onclick=\"postFormAjax('or_play.php', 'm11');return false;\" /></form>";} 

if($draw['b12']==$black){$b12 = "<form method='post' name='m12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton12' id='movebutton12' value='Click' onclick=\"postFormAjax('or_play.php', 'm12');return false;\" /></form>";} 
else if($draw['b12']==$white){$b12 = "<form method='post' name='m12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton12' id='movebutton12' value='Click' onclick=\"postFormAjax('or_play.php', 'm12');return false;\" /></form>";} 
else{$b12 = "<form method='post' name='m12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton12' id='movebutton12' value='Click' onclick=\"postFormAjax('or_play.php', 'm12');return false;\" /></form>";} 

if($draw['b13']==$black){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move13');return false;\" /></form>";} 
else if($draw['b13']==$white){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move13');return false;\" /></form>";} 
else{$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move13');return false;\" /></form>";} 

if($draw['b14']==$black){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move14');return false;\" /></form>";} 
else if($draw['b14']==$white){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move14');return false;\" /></form>";} 
else{$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move14');return false;\" /></form>";} 

if($draw['b15']==$black){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move15');return false;\" /></form>";} 
else if($draw['b15']==$white){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move15');return false;\" /></form>";} 
else{$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move15');return false;\" /></form>";} 
	
if($draw['b16']==$black){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move16');return false;\" /></form>";} 
else if($draw['b16']==$white){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move16');return false;\" /></form>";} 
else{$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move16');return false;\" /></form>";} 
	
if($draw['b17']==$black){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move17');return false;\" /></form>";} 
else if($draw['b17']==$white){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move17');return false;\" /></form>";} 
else{$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move17');return false;\" /></form>";} 
	
if($draw['b18']==$black){$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move18');return false;\" /></form>";} 
else if($draw['b18']==$white){$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move18');return false;\" /></form>";} 
else{$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move18');return false;\" /></form>";} 
	
//row 2
if($draw['b21']==$black){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move21');return false;\" /></form>";} 
else if($draw['b21']==$white){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move21');return false;\" /></form>";} 
else{$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move21');return false;\" /></form>";} 

if($draw['b22']==$black){$b22 = "<form method='post' name='m22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'm22');return false;\" /></form>";} 
else if($draw['b22']==$white){$b22 = "<form method='post' name='m22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'm22');return false;\" /></form>";} 
else{$b22 = "<form method='post' name='m22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'm22');return false;\" /></form>";} 

if($draw['b23']==$black){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move23');return false;\" /></form>";} 
else if($draw['b23']==$white){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move23');return false;\" /></form>";} 
else{$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move23');return false;\" /></form>";} 

if($draw['b24']==$black){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move24');return false;\" /></form>";} 
else if($draw['b24']==$white){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move24');return false;\" /></form>";} 
else{$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move24');return false;\" /></form>";} 

if($draw['b25']==$black){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move25');return false;\" /></form>";} 
else if($draw['b25']==$white){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move25');return false;\" /></form>";} 
else{$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move25');return false;\" /></form>";} 
	
if($draw['b26']==$black){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move26');return false;\" /></form>";} 
else if($draw['b26']==$white){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move26');return false;\" /></form>";} 
else{$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move26');return false;\" /></form>";} 
	
if($draw['b27']==$black){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move27');return false;\" /></form>";} 
else if($draw['b27']==$white){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move27');return false;\" /></form>";} 
else{$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move27');return false;\" /></form>";} 
	
if($draw['b28']==$black){$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move28');return false;\" /></form>";} 
else if($draw['b28']==$white){$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move28');return false;\" /></form>";} 
else{$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move28');return false;\" /></form>";} 

//row 3
if($draw['b31']==$black){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move31');return false;\" /></form>";} 
else if($draw['b31']==$white){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move31');return false;\" /></form>";} 
else{$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move31');return false;\" /></form>";} 

if($draw['b32']==$black){$b32 = "<form method='post' name='move32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move32');return false;\" /></form>";} 
else if($draw['b32']==$white){$b32 = "<form method='post' name='move32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move32');return false;\" /></form>";} 
else{$b32 = "<form method='post' name='move32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move32');return false;\" /></form>";} 

if($draw['b33']==$black){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move33');return false;\" /></form>";} 
else if($draw['b33']==$white){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move33');return false;\" /></form>";} 
else{$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move33');return false;\" /></form>";} 

if($draw['b34']==$black){$b34 = "<form method='post' name='move34'><input type=hidden name='move' value=34><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move34');return false;\" /></form>";} 
else if($draw['b34']==$white){$b34 = "<form method='post' name='move34'><input type=hidden name='move' value=34><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move34');return false;\" /></form>";} 
else{$b34 = "<form method='post' name='move34'><input type=hidden name='move' value=34><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move34');return false;\" /></form>";} 

if($draw['b35']==$black){$b35 = "<form method='post' name='move35'><input type=hidden name='move' value=35><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move35');return false;\" /></form>";} 
else if($draw['b35']==$white){$b35 = "<form method='post' name='move35'><input type=hidden name='move' value=35><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move35');return false;\" /></form>";} 
else{$b35 = "<form method='post' name='move35'><input type=hidden name='move' value=35><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move35');return false;\" /></form>";} 
	
if($draw['b36']==$black){$b36 = "<form method='post' name='move36'><input type=hidden name='move' value=36><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move36');return false;\" /></form>";} 
else if($draw['b36']==$white){$b36 = "<form method='post' name='move36'><input type=hidden name='move' value=36><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move36');return false;\" /></form>";} 
else{$b36 = "<form method='post' name='move36'><input type=hidden name='move' value=36><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move36');return false;\" /></form>";} 
	
if($draw['b37']==$black){$b37 = "<form method='post' name='move37'><input type=hidden name='move' value=37><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move37');return false;\" /></form>";} 
else if($draw['b37']==$white){$b37 = "<form method='post' name='move37'><input type=hidden name='move' value=37><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move37');return false;\" /></form>";} 
else{$b37 = "<form method='post' name='move37'><input type=hidden name='move' value=37><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move37');return false;\" /></form>";} 
	
if($draw['b38']==$black){$b38 = "<form method='post' name='move38'><input type=hidden name='move' value=38><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move38');return false;\" /></form>";} 
else if($draw['b38']==$white){$b38 = "<form method='post' name='move38'><input type=hidden name='move' value=38><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move38');return false;\" /></form>";} 
else{$b38 = "<form method='post' name='move38'><input type=hidden name='move' value=38><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move38');return false;\" /></form>";} 

//row 4
if($draw['b41']==$black){$b41 = "<form method='post' name='move41'><input type=hidden name='move' value=41><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move41');return false;\" /></form>";} 
else if($draw['b41']==$white){$b41 = "<form method='post' name='move41'><input type=hidden name='move' value=41><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move41');return false;\" /></form>";} 
else{$b41 = "<form method='post' name='move41'><input type=hidden name='move' value=41><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move41');return false;\" /></form>";} 

if($draw['b42']==$black){$b42 = "<form method='post' name='move42'><input type=hidden name='move' value=42><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move42');return false;\" /></form>";} 
else if($draw['b42']==$white){$b42 = "<form method='post' name='move42'><input type=hidden name='move' value=42><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move42');return false;\" /></form>";} 
else{$b42 = "<form method='post' name='move42'><input type=hidden name='move' value=42><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move42');return false;\" /></form>";} 

if($draw['b43']==$black){$b43 = "<form method='post' name='move43'><input type=hidden name='move' value=43><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move43');return false;\" /></form>";} 
else if($draw['b43']==$white){$b43 = "<form method='post' name='move43'><input type=hidden name='move' value=43><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move43');return false;\" /></form>";} 
else{$b43 = "<form method='post' name='move43'><input type=hidden name='move' value=43><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move43');return false;\" /></form>";} 

if($draw['b44']==$black){$b44 = "<form method='post' name='move44'><input type=hidden name='move' value=44><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move44');return false;\" /></form>";} 
else if($draw['b44']==$white){$b44 = "<form method='post' name='move44'><input type=hidden name='move' value=44><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move44');return false;\" /></form>";} 
else{$b44 = "<form method='post' name='move44'><input type=hidden name='move' value=44><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move44');return false;\" /></form>";} 

if($draw['b45']==$black){$b45 = "<form method='post' name='move45'><input type=hidden name='move' value=45><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move45');return false;\" /></form>";} 
else if($draw['b45']==$white){$b45 = "<form method='post' name='move45'><input type=hidden name='move' value=45><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move45');return false;\" /></form>";} 
else{$b45 = "<form method='post' name='move45'><input type=hidden name='move' value=45><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move45');return false;\" /></form>";} 
	
if($draw['b46']==$black){$b46 = "<form method='post' name='move46'><input type=hidden name='move' value=46><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move46');return false;\" /></form>";} 
else if($draw['b46']==$white){$b46 = "<form method='post' name='move46'><input type=hidden name='move' value=46><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move46');return false;\" /></form>";} 
else{$b46 = "<form method='post' name='move46'><input type=hidden name='move' value=46><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move46');return false;\" /></form>";} 
	
if($draw['b47']==$black){$b47 = "<form method='post' name='move47'><input type=hidden name='move' value=47><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move47');return false;\" /></form>";} 
else if($draw['b47']==$white){$b47 = "<form method='post' name='move47'><input type=hidden name='move' value=47><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move47');return false;\" /></form>";} 
else{$b47 = "<form method='post' name='move47'><input type=hidden name='move' value=47><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move47');return false;\" /></form>";} 
	
if($draw['b48']==$black){$b48 = "<form method='post' name='move48'><input type=hidden name='move' value=48><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move48');return false;\" /></form>";} 
else if($draw['b48']==$white){$b48 = "<form method='post' name='move48'><input type=hidden name='move' value=48><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move48');return false;\" /></form>";} 
else{$b48 = "<form method='post' name='move48'><input type=hidden name='move' value=48><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move48');return false;\" /></form>";} 
	
//row 5
if($draw['b51']==$black){$b51 = "<form method='post' name='move51'><input type=hidden name='move' value=51><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move51');return false;\" /></form>";} 
else if($draw['b51']==$white){$b51 = "<form method='post' name='move51'><input type=hidden name='move' value=51><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move51');return false;\" /></form>";} 
else{$b51 = "<form method='post' name='move51'><input type=hidden name='move' value=51><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move51');return false;\" /></form>";} 

if($draw['b52']==$black){$b52 = "<form method='post' name='move52'><input type=hidden name='move' value=52><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move52');return false;\" /></form>";} 
else if($draw['b52']==$white){$b52 = "<form method='post' name='move52'><input type=hidden name='move' value=52><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move52');return false;\" /></form>";} 
else{$b52 = "<form method='post' name='move52'><input type=hidden name='move' value=52><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move52');return false;\" /></form>";} 

if($draw['b53']==$black){$b53 = "<form method='post' name='move53'><input type=hidden name='move' value=53><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move53');return false;\" /></form>";} 
else if($draw['b53']==$white){$b53 = "<form method='post' name='move53'><input type=hidden name='move' value=53><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move53');return false;\" /></form>";} 
else{$b53 = "<form method='post' name='move53'><input type=hidden name='move' value=53><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move53');return false;\" /></form>";} 

if($draw['b54']==$black){$b54 = "<form method='post' name='move54'><input type=hidden name='move' value=54><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move54');return false;\" /></form>";} 
else if($draw['b54']==$white){$b54 = "<form method='post' name='move54'><input type=hidden name='move' value=54><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move54');return false;\" /></form>";} 
else{$b54 = "<form method='post' name='move54'><input type=hidden name='move' value=54><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move54');return false;\" /></form>";} 

if($draw['b55']==$black){$b55 = "<form method='post' name='move55'><input type=hidden name='move' value=55><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move55');return false;\" /></form>";} 
else if($draw['b55']==$white){$b55 = "<form method='post' name='move55'><input type=hidden name='move' value=55><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move55');return false;\" /></form>";} 
else{$b55 = "<form method='post' name='move55'><input type=hidden name='move' value=55><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move55');return false;\" /></form>";} 
	
if($draw['b56']==$black){$b56 = "<form method='post' name='move56'><input type=hidden name='move' value=56><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move56');return false;\" /></form>";} 
else if($draw['b56']==$white){$b56 = "<form method='post' name='move56'><input type=hidden name='move' value=56><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move56');return false;\" /></form>";} 
else{$b56 = "<form method='post' name='move56'><input type=hidden name='move' value=56><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move56');return false;\" /></form>";} 
	
if($draw['b57']==$black){$b57 = "<form method='post' name='move57'><input type=hidden name='move' value=57><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move57');return false;\" /></form>";} 
else if($draw['b57']==$white){$b57 = "<form method='post' name='move57'><input type=hidden name='move' value=57><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move57');return false;\" /></form>";} 
else{$b57 = "<form method='post' name='move57'><input type=hidden name='move' value=57><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move57');return false;\" /></form>";} 
	
if($draw['b58']==$black){$b58 = "<form method='post' name='move58'><input type=hidden name='move' value=58><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move58');return false;\" /></form>";} 
else if($draw['b58']==$white){$b58 = "<form method='post' name='move58'><input type=hidden name='move' value=58><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move58');return false;\" /></form>";} 
else{$b58 = "<form method='post' name='move58'><input type=hidden name='move' value=58><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move58');return false;\" /></form>";} 

//row 6
if($draw['b61']==$black){$b61 = "<form method='post' name='move61'><input type=hidden name='move' value=61><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move61');return false;\" /></form>";} 
else if($draw['b61']==$white){$b61 = "<form method='post' name='move61'><input type=hidden name='move' value=61><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move61');return false;\" /></form>";} 
else{$b61 = "<form method='post' name='move61'><input type=hidden name='move' value=61><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move61');return false;\" /></form>";} 

if($draw['b62']==$black){$b62 = "<form method='post' name='move62'><input type=hidden name='move' value=62><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move62');return false;\" /></form>";} 
else if($draw['b62']==$white){$b62 = "<form method='post' name='move62'><input type=hidden name='move' value=62><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move62');return false;\" /></form>";} 
else{$b62 = "<form method='post' name='move62'><input type=hidden name='move' value=62><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move62');return false;\" /></form>";} 

if($draw['b63']==$black){$b63 = "<form method='post' name='move63'><input type=hidden name='move' value=63><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move63');return false;\" /></form>";} 
else if($draw['b63']==$white){$b63 = "<form method='post' name='move63'><input type=hidden name='move' value=63><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move63');return false;\" /></form>";} 
else{$b63 = "<form method='post' name='move63'><input type=hidden name='move' value=63><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move63');return false;\" /></form>";} 

if($draw['b64']==$black){$b64 = "<form method='post' name='move64'><input type=hidden name='move' value=64><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move64');return false;\" /></form>";} 
else if($draw['b64']==$white){$b64 = "<form method='post' name='move64'><input type=hidden name='move' value=64><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move64');return false;\" /></form>";} 
else{$b64 = "<form method='post' name='move64'><input type=hidden name='move' value=64><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move64');return false;\" /></form>";} 

if($draw['b65']==$black){$b65 = "<form method='post' name='move65'><input type=hidden name='move' value=65><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move65');return false;\" /></form>";} 
else if($draw['b65']==$white){$b65 = "<form method='post' name='move65'><input type=hidden name='move' value=65><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move65');return false;\" /></form>";} 
else{$b65 = "<form method='post' name='move65'><input type=hidden name='move' value=65><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move65');return false;\" /></form>";} 
	
if($draw['b66']==$black){$b66 = "<form method='post' name='move66'><input type=hidden name='move' value=66><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move66');return false;\" /></form>";} 
else if($draw['b66']==$white){$b66 = "<form method='post' name='move66'><input type=hidden name='move' value=66><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move66');return false;\" /></form>";} 
else{$b66 = "<form method='post' name='move66'><input type=hidden name='move' value=66><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move66');return false;\" /></form>";} 
	
if($draw['b67']==$black){$b67 = "<form method='post' name='move67'><input type=hidden name='move' value=67><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move67');return false;\" /></form>";} 
else if($draw['b67']==$white){$b67 = "<form method='post' name='move67'><input type=hidden name='move' value=67><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move67');return false;\" /></form>";} 
else{$b67 = "<form method='post' name='move67'><input type=hidden name='move' value=67><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move67');return false;\" /></form>";} 
	
if($draw['b68']==$black){$b68 = "<form method='post' name='move68'><input type=hidden name='move' value=68><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move68');return false;\" /></form>";} 
else if($draw['b68']==$white){$b68 = "<form method='post' name='move68'><input type=hidden name='move' value=68><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move68');return false;\" /></form>";} 
else{$b68 = "<form method='post' name='move68'><input type=hidden name='move' value=68><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move68');return false;\" /></form>";} 
	
//row 7
if($draw['b71']==$black){$b71 = "<form method='post' name='move71'><input type=hidden name='move' value=71><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move71');return false;\" /></form>";} 
else if($draw['b71']==$white){$b71 = "<form method='post' name='move71'><input type=hidden name='move' value=71><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move71');return false;\" /></form>";} 
else{$b71 = "<form method='post' name='move71'><input type=hidden name='move' value=71><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move71');return false;\" /></form>";} 

if($draw['b72']==$black){$b72 = "<form method='post' name='move72'><input type=hidden name='move' value=72><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move72');return false;\" /></form>";} 
else if($draw['b72']==$white){$b72 = "<form method='post' name='move72'><input type=hidden name='move' value=72><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move72');return false;\" /></form>";} 
else{$b72 = "<form method='post' name='move72'><input type=hidden name='move' value=72><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move72');return false;\" /></form>";} 

if($draw['b73']==$black){$b73 = "<form method='post' name='move73'><input type=hidden name='move' value=73><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move73');return false;\" /></form>";} 
else if($draw['b73']==$white){$b73 = "<form method='post' name='move73'><input type=hidden name='move' value=73><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move73');return false;\" /></form>";} 
else{$b73 = "<form method='post' name='move73'><input type=hidden name='move' value=73><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move73');return false;\" /></form>";} 

if($draw['b74']==$black){$b74 = "<form method='post' name='move74'><input type=hidden name='move' value=74><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move74');return false;\" /></form>";} 
else if($draw['b74']==$white){$b74 = "<form method='post' name='move74'><input type=hidden name='move' value=74><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move74');return false;\" /></form>";} 
else{$b74 = "<form method='post' name='move74'><input type=hidden name='move' value=74><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move74');return false;\" /></form>";} 

if($draw['b75']==$black){$b75 = "<form method='post' name='move75'><input type=hidden name='move' value=75><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move75');return false;\" /></form>";} 
else if($draw['b75']==$white){$b75 = "<form method='post' name='move75'><input type=hidden name='move' value=75><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move75');return false;\" /></form>";} 
else{$b75 = "<form method='post' name='move75'><input type=hidden name='move' value=75><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move75');return false;\" /></form>";} 
	
if($draw['b76']==$black){$b76 = "<form method='post' name='move76'><input type=hidden name='move' value=76><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move76');return false;\" /></form>";} 
else if($draw['b76']==$white){$b76 = "<form method='post' name='move76'><input type=hidden name='move' value=76><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move76');return false;\" /></form>";} 
else{$b76 = "<form method='post' name='move76'><input type=hidden name='move' value=76><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move76');return false;\" /></form>";} 
	
if($draw['b77']==$black){$b77 = "<form method='post' name='move77'><input type=hidden name='move' value=77><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move77');return false;\" /></form>";} 
else if($draw['b77']==$white){$b77 = "<form method='post' name='move77'><input type=hidden name='move' value=77><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move77');return false;\" /></form>";} 
else{$b77 = "<form method='post' name='move77'><input type=hidden name='move' value=77><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move77');return false;\" /></form>";} 
	
if($draw['b78']==$black){$b78 = "<form method='post' name='move78'><input type=hidden name='move' value=78><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move78');return false;\" /></form>";} 
else if($draw['b78']==$white){$b78 = "<form method='post' name='move78'><input type=hidden name='move' value=78><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move78');return false;\" /></form>";} 
else{$b78 = "<form method='post' name='move78'><input type=hidden name='move' value=78><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move78');return false;\" /></form>";} 

//row 8
if($draw['b81']==$black){$b81 = "<form method='post' name='move81'><input type=hidden name='move' value=81><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move81');return false;\" /></form>";} 
else if($draw['b81']==$white){$b81 = "<form method='post' name='move81'><input type=hidden name='move' value=81><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move81');return false;\" /></form>";} 
else{$b81 = "<form method='post' name='move81'><input type=hidden name='move' value=81><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move81');return false;\" /></form>";} 

if($draw['b82']==$black){$b82 = "<form method='post' name='move82'><input type=hidden name='move' value=82><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move82');return false;\" /></form>";} 
else if($draw['b82']==$white){$b82 = "<form method='post' name='move82'><input type=hidden name='move' value=82><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move82');return false;\" /></form>";} 
else{$b82 = "<form method='post' name='move82'><input type=hidden name='move' value=82><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move82');return false;\" /></form>";} 

if($draw['b83']==$black){$b83 = "<form method='post' name='move83'><input type=hidden name='move' value=83><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move83');return false;\" /></form>";} 
else if($draw['b83']==$white){$b83 = "<form method='post' name='move83'><input type=hidden name='move' value=83><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move83');return false;\" /></form>";} 
else{$b83 = "<form method='post' name='move83'><input type=hidden name='move' value=83><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move83');return false;\" /></form>";} 

if($draw['b84']==$black){$b84 = "<form method='post' name='move84'><input type=hidden name='move' value=84><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move84');return false;\" /></form>";} 
else if($draw['b84']==$white){$b84 = "<form method='post' name='move84'><input type=hidden name='move' value=84><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move84');return false;\" /></form>";} 
else{$b84 = "<form method='post' name='move84'><input type=hidden name='move' value=84><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move84');return false;\" /></form>";} 

if($draw['b85']==$black){$b85 = "<form method='post' name='move85'><input type=hidden name='move' value=85><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move85');return false;\" /></form>";} 
else if($draw['b85']==$white){$b85 = "<form method='post' name='move85'><input type=hidden name='move' value=85><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move85');return false;\" /></form>";} 
else{$b85 = "<form method='post' name='move85'><input type=hidden name='move' value=85><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move85');return false;\" /></form>";} 
	
if($draw['b86']==$black){$b86 = "<form method='post' name='move86'><input type=hidden name='move' value=86><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move86');return false;\" /></form>";} 
else if($draw['b86']==$white){$b86 = "<form method='post' name='move86'><input type=hidden name='move' value=86><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move86');return false;\" /></form>";} 
else{$b86 = "<form method='post' name='move86'><input type=hidden name='move' value=86><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move86');return false;\" /></form>";} 
	
if($draw['b87']==$black){$b87 = "<form method='post' name='move87'><input type=hidden name='move' value=87><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move87');return false;\" /></form>";} 
else if($draw['b87']==$white){$b87 = "<form method='post' name='move87'><input type=hidden name='move' value=87><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move87');return false;\" /></form>";} 
else{$b87 = "<form method='post' name='move87'><input type=hidden name='move' value=87><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move87');return false;\" /></form>";} 
	
if($draw['b88']==$black){$b88 = "<form method='post' name='move88'><input type=hidden name='move' value=88><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/black.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move88');return false;\" /></form>";} 
else if($draw['b88']==$white){$b88 = "<form method='post' name='move88'><input type=hidden name='move' value=88><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move88');return false;\" /></form>";} 
else{$b88 = "<form method='post' name='move88'><input type=hidden name='move' value=88><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/or/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('or_play.php', 'move88');return false;\" /></form>";} 

if($turn==$userid)
{
	$availablemoves = get_available_moves($roomid, $userid);
	$atext = implode("|", $availablemoves);

	for($i=11;$i<=88;$i++)
	{
		if(in_array($i, $availablemoves))
		{

			$name = "b".$i;
			$$name = str_replace("images/or/blank.png", "images/or/possible.png", $$name);
		}
	}
}

if($draw['lastmove']>0)
{
	$name = "b".$draw['lastmove'];
	$$name = str_replace("images/or/black.png", "images/or/pblack.png", $$name);
	$$name = str_replace("images/or/white.png", "images/or/pwhite.png", $$name);
}

//layout
	
	$txt="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '300' width='350' style=\"background: url('images/or/background.png') no-repeat;\">";
	$txt.="<tr><td>$b11</td><td>$b12</td><td>$b13</td><td>$b14</td><td>$b15</td><td>$b16</td><td>$b17</td><td>$b18</td></tr>";
	$txt.="<tr><td>$b21</td><td>$b22</td><td>$b23</td><td>$b24</td><td>$b25</td><td>$b26</td><td>$b27</td><td>$b28</td></tr>";
	$txt.="<tr><td>$b31</td><td>$b32</td><td>$b33</td><td>$b34</td><td>$b35</td><td>$b36</td><td>$b37</td><td>$b38</td></tr>";
	$txt.="<tr><td>$b41</td><td>$b42</td><td>$b43</td><td>$b44</td><td>$b45</td><td>$b46</td><td>$b47</td><td>$b48</td></tr>";
	$txt.="<tr><td>$b51</td><td>$b52</td><td>$b53</td><td>$b54</td><td>$b55</td><td>$b56</td><td>$b57</td><td>$b58</td></tr>";
	$txt.="<tr><td>$b61</td><td>$b62</td><td>$b63</td><td>$b64</td><td>$b65</td><td>$b66</td><td>$b67</td><td>$b68</td></tr>";
	$txt.="<tr><td>$b71</td><td>$b72</td><td>$b73</td><td>$b74</td><td>$b75</td><td>$b76</td><td>$b77</td><td>$b78</td></tr>";
	$txt.="<tr><td>$b81</td><td>$b82</td><td>$b83</td><td>$b84</td><td>$b85</td><td>$b86</td><td>$b87</td><td>$b88</td></tr>";
	

	
	for($i=11; $i<=88; $i++)
	{
		if($draw["b".$i]>0)
		{
			$fullsquares++;
			if($draw["b".$i] == $draw['p1'])
			{
				$p1tot++;
			}
			if($draw["b".$i] == $draw['p2'])
			{
				$p2tot++;
			}
		}
	}

	if($draw['black']==$draw['p1']){$blacktxt = "$p1tot";$whitetxt = "$p2tot";}
	else if($draw['black']==$draw['p2']){$blacktxt = "$p2tot";$whitetxt = "$p1tot";}

	if(!$whitetxt){$whitetxt="0";}
	if(!$blacktxt){$blacktxt="0";}
	
	$txt.="</table><br />
	<b>Black: {$blacktxt} | White: {$whitetxt}</b>
	</center>";
	
	print $txt;
	
}


function get_available_moves($roomid, $who)
{
	global $db,$ir;
	$game=$db->query("SELECT * FROM or_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);

	$game2=$db->query("SELECT * FROM or_game WHERE or_room=$roomid", $c) or die("1");
	$gin=$db->fetch_row($game2);

	$userid=$who;
	$allmoves = array();

	$blanks = array();
	for($i=11; $i<=88; $i++)
	{
		if(ctype_digit($gin["b".$i]) && $gin["b".$i]==0)
		{
			$blanks[]=$i;
		}
	}

	foreach ($blanks as &$blank) 
	{
		$move = $blank;
	
		//horizontal right
		$good=0;
		$loop=1;
		$goodmove=0;
		$finishturn = 0;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace+1;
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;

			}
		}
		if($goodmove == 1)
		{
			$finishturn = 1;
		}
	
		//horizontal left
		$good=0;
		$goodmove=0;
		$loop=1;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace-1;
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;
			}
		}
		if($goodmove == 1)
		{
			$begin=$move;
			$end = $endloc;
			$finishturn = 1;
		}
	
		//vertical down
		$good=0;
		$loop=1;
		$goodmove=0;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace+10;
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;
			}
		}
		if($goodmove == 1)
		{
			$begin=$move;
			$end = $endloc;
			$finishturn = 1;
		}
	
		//vertical up
		$good=0;
		$loop=1;
		$goodmove=0;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace-10;
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;
			}
		}
		if($goodmove == 1)
		{
			$begin=$move;
			$end = $endloc;
			$finishturn=1;
		}
	
	
		//diagnol down right
		$good=0;
		$loop=1;
		$goodmove=0;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace+11;
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;
			}
		}
		if($goodmove == 1)
		{
			$begin=$move;
			$end = $endloc;
			$finishturn = 1;
		}
	
	
		//diagnol down left
		$good=0;
		$loop=1;
		$goodmove=0;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace+9;
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;
			}
		}
		if($goodmove == 1)
		{
			$begin=$move;
			$end = $endloc;
			$finishturn = 1;
		}
	
		//diagnol up right
		$good=0;
		$loop=1;
		$goodmove=0;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace-9;
	
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;
			}
		}
		if($goodmove == 1)
		{
			$begin=$move;
			$end = $endloc;
			$finishturn=1;
		}
	
	
		//diagnol up left
		$good=0;
		$loop=1;
		$goodmove=0;
		$nextspace = $move;
		while($loop)
		{
			$loop=0;
			$nextspace = $nextspace-11;
			$gin["b".$nextspace];
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
			{
				if(!$good){$good=1;} //set flag for valid moves. 
	
				$loop=1;
			}
			if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
			{
				//valid move
				$goodmove = 1;
				$endloc = $nextspace;
			}
		}
		if($goodmove == 1)
		{
			$begin=$move;
			$end = $endloc;
			$finishturn=1;
		}
		

	
		if($finishturn == 1)
		{
			$allmoves[]=$move;
		}
	}

	return $allmoves;

}

function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game=$db->query("SELECT * FROM or_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);
	$turn = $ga['turn'];
	if($turn!=$userid){die();} //not your turn

	$ginf = $db->query("SELECT * FROM or_game WHERE or_room = $roomid");
	$gin = $db->fetch_row($ginf);

	if($gin["b".$move]>0){die();} //square not empty


	//horizontal right
	$good=0;
	$loop=1;
	$goodmove=0;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace+1;
		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn = 1;
		$updatearr = array();
		for($i=$move;$i<$endloc; $i++)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}

	//horizontal left
	$good=0;
	$goodmove=0;
	$loop=1;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace-1;
		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn = 1;
		$updatearr = array();
		for($i=$move;$i>$endloc; $i--)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}

	//vertical down
	$good=0;
	$loop=1;
	$goodmove=0;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace+10;
		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn = 1;
		$updatearr = array();
		for($i=$move;$i<$endloc; $i+=10)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}

	//vertical up
	$good=0;
	$loop=1;
	$goodmove=0;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace-10;
		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn=1;
		$updatearr = array();
		for($i=$move;$i>$endloc; $i-=10)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}


	//diagnol down right
	$good=0;
	$loop=1;
	$goodmove=0;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace+11;
		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn = 1;
		$updatearr = array();
		for($i=$move;$i<$endloc; $i+=11)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}


	//diagnol down left
	$good=0;
	$loop=1;
	$goodmove=0;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace+9;
		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn = 1;
		$updatearr = array();
		for($i=$move;$i<$endloc; $i+=9)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}

	//diagnol up right
	$good=0;
	$loop=1;
	$goodmove=0;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace-9;

		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn=1;
		$updatearr = array();
		for($i=$move;$i>$endloc; $i-=9)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}


	//diaganol up left
	$good=0;
	$loop=1;
	$goodmove=0;
	$nextspace = $move;
	while($loop)
	{
		$loop=0;
		$nextspace = $nextspace-11;
		$gin["b".$nextspace];
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]!=$userid)
		{
			if(!$good){$good=1;} //set flag for valid moves. 

			$loop=1;
		}
		if($gin["b".$nextspace]>0 && $gin["b".$nextspace]==$userid && $good==1)
		{
			//valid move
			$goodmove = 1;
			$endloc = $nextspace;
		}
	}
	if($goodmove == 1)
	{
		$begin=$move;
		$end = $endloc;
		$finishturn=1;
		$updatearr = array();
		for($i=$move;$i>$endloc; $i-=11)
		{
			$updatearr[]= "b{$i}=$userid";
		}
		$updatestr = implode(",", $updatearr);
		$db->query("UPDATE or_game SET $updatestr WHERE or_room=$roomid");
	}


	if($finishturn == 1)
	{
		$db->query("UPDATE or_game SET lastmove=$move WHERE or_room=$roomid");
		$winner = check_win($roomid);
		if($winner != 0)
			award_win($roomid,$winner);
		else
			toggle_turn($roomid); //only toggle turn if no win yet
	}

}


function end_turn($userid, $roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM or_room WHERE id = $roomid"));
	if($ui['turn']==$userid)
	{
		toggle_turn($roomid);
	}
}


function check_win($roomid)
{
	global $db,$ir;

	$winner = 0;

	$ginf = $db->query("SELECT * FROM or_game WHERE or_room = $roomid");
	$gin = $db->fetch_row($ginf);


	$ginf2 = $db->query("SELECT turn FROM or_room WHERE id = $roomid");
	$gin2 = $db->fetch_row($ginf2);

	$turn=$gin2['turn'];


	if($turn==$gin['p1']){$check = $gin['p2'];$winav=$gin['p1'];}
	if($turn==$gin['p2']){$check = $gin['p1'];$winav=$gin['p2'];}

	$availablemoves = get_available_moves($roomid, $check);
	$anyavail = count($availablemoves);
	if($anyavail==0)
	{

		$availablemoves2 = get_available_moves($roomid, $winav);
		$anyavail2 = count($availablemoves2);
		if($anyavail2==0)
		{
			$_POST['chattxt']="Both players have no legal moves left.";
			$db->query("INSERT INTO or_chat (or_room, timestamp, txt) VALUES($roomid, unix_timestamp(), '{$_POST['chattxt']}')");
			$getwhohasmore = 1;				
		}
	}


	$p1 = $gin['p1'];
	$p2 = $gin['p2'];
	$p1tot = 0;
	$p2tot = 0;

	$fullsquares = 0;	
	for($i=11; $i<=88; $i++)
	{
		if($gin["b".$i]>0)
		{
			$fullsquares++;
			if($gin["b".$i] == $p1)
			{
				$p1tot++;
			}
			if($gin["b".$i] == $p2)
			{
				$p2tot++;
			}
		}
	}

	//one player eliminated
	if($p2tot==0 && $p1tot>3){return $p1;}
	if($p1tot==0 && $p1tot>3){return $p2;}

	//full board
	if($fullsquares >= 64)
	{
		if($p1tot>$p2tot)
		{
			return $p1;
		}
		if($p2tot>$p1tot)
		{
			return $p2;
		}
		if($p1tot==$p2tot)
		{
			return -1;
		}
	}

	if($getwhohasmore)
	{
		if($p1tot>$p2tot)
		{
			return $p1;
		}
		if($p2tot>$p1tot)
		{
			return $p2;
		}
		if($p1tot==$p2tot)
		{
			return -1;
		}
	}


	//Return the winner's userid
	return $winner;
}

function create_game($roomid)
{

	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT or_room FROM or_game WHERE or_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM or_room WHERE id=$roomid"));

		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		$turnuid = p_to_uid($turn, $roomid);
		if($turn==1){$other=2;}else{$other=1;}
		$otheruid = p_to_uid($other, $roomid);
		$db->query("UPDATE or_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO or_game (or_room, {$firstmovemarkfield}, p1, p2) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']})");
		board_setup($roomid,$turnuid,$otheruid);
	}
}

function board_setup($roomid,$p1,$p2)
{
	global $db;
	$db->query("UPDATE or_game SET b44=$p1,b45=$p2, b54 = $p2,b55=$p1 WHERE or_room=$roomid");
}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM or_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE or_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
		$availablemoves = get_available_moves($roomid, $ui['p2']);
		$anyavail = count($availablemoves);
		if($anyavail==0)
		{
			$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid={$ui['p2']}"));
			$_POST['chattxt']="{$uname['username']} has no legal moves and passed their turn.";
			$db->query("INSERT INTO or_chat (or_room, timestamp, txt) VALUES($roomid, unix_timestamp(), '{$_POST['chattxt']}')");
			toggle_turn($roomid); //only toggle turn if no win yet
		}
	}
	else
	{
		$db->query("UPDATE or_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
		$availablemoves = get_available_moves($roomid, $ui['p1']);
		$anyavail = count($availablemoves);
		if($anyavail==0)
		{
			$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid={$ui['p1']}"));
			$_POST['chattxt']="{$uname['username']} has no legal moves and passed their turn.";
			$db->query("INSERT INTO or_chat (or_room, timestamp, txt) VALUES($roomid, unix_timestamp(), '{$_POST['chattxt']}')");
			toggle_turn($roomid); //only toggle turn if no win yet
		}
	}
}

?>