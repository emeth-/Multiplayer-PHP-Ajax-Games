<?php

// function all_basic($move, $red, $userid)  	 	- gives all possibilities for a basic piece non-jump
// function king_basic($move, $red, $userid) 		- gives all possibilities for a king piece non-jump
// function second_jump($lastmove, $red, $userid)	- gives all possibilities for a basic piece jump
// function king_second($lastmove, $red, $userid) 	- gives all possibilities for a king jump
// function valid_move($userid,$red,$move,$pselect) - valid normal move
// jump_move($userid,$red,$white,$move,$pselect)	- valid jump move
// king_jump($userid,$red,$white,$move,$pselect)   	- valid king jump
function draw_board($roomid, $userid, $turn)
{

	global $db,$ir;

	$drawb = $db->query("SELECT * FROM ck_game WHERE ck_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);

	$red = $draw['red'];
	if($draw['red'] == $draw['p1']){$white = $draw['p2'];}
	else{$white = $draw['p1'];}


if($draw['b33']==$red){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move33');return false;\" /></form>";} 
else if($draw['b33']==$white){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move33');return false;\" /></form>";} 
else if($draw['b33']=="-".$red){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move33');return false;\" /></form>";} 
else if($draw['b33']=="-".$white){$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move33');return false;\" /></form>";} 
else{$b33 = "<form method='post' name='move33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move33');return false;\" /></form>";} 

if($draw['b1']==$red){$b1 = "<form method='post' name='move1'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move1');return false;\" /></form>";} 
else if($draw['b1']==$white){$b1 = "<form method='post' name='move1'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move1');return false;\" /></form>";} 
else if($draw['b1']=="-".$red){$b1 = "<form method='post' name='move1'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move1');return false;\" /></form>";} 
else if($draw['b1']=="-".$white){$b1 = "<form method='post' name='move1'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move1');return false;\" /></form>";} 
else{$b1 = "<form method='post' name='move1'><input type=hidden name='move' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move1');return false;\" /></form>";} 

if($draw['b2']==$red){$b2 = "<form method='post' name='move2'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move2');return false;\" /></form>";} 
else if($draw['b2']==$white){$b2 = "<form method='post' name='move2'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move2');return false;\" /></form>";} 
else if($draw['b2']=="-".$red){$b2 = "<form method='post' name='move2'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move2');return false;\" /></form>";} 
else if($draw['b2']=="-".$white){$b2 = "<form method='post' name='move2'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move2');return false;\" /></form>";} 
else{$b2 = "<form method='post' name='move2'><input type=hidden name='move' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move2');return false;\" /></form>";} 

if($draw['b3']==$red){$b3 = "<form method='post' name='move3'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move3');return false;\" /></form>";} 
else if($draw['b3']==$white){$b3 = "<form method='post' name='move3'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move3');return false;\" /></form>";} 
else if($draw['b3']=="-".$red){$b3 = "<form method='post' name='move3'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move3');return false;\" /></form>";} 
else if($draw['b3']=="-".$white){$b3 = "<form method='post' name='move3'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move3');return false;\" /></form>";} 
else{$b3 = "<form method='post' name='move3'><input type=hidden name='move' value=3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move3');return false;\" /></form>";} 

if($draw['b4']==$red){$b4 = "<form method='post' name='move4'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move4');return false;\" /></form>";} 
else if($draw['b4']==$white){$b4 = "<form method='post' name='move4'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move4');return false;\" /></form>";} 
else if($draw['b4']=="-".$red){$b4 = "<form method='post' name='move4'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move4');return false;\" /></form>";} 
else if($draw['b4']=="-".$white){$b4 = "<form method='post' name='move4'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move4');return false;\" /></form>";} 
else{$b4 = "<form method='post' name='move4'><input type=hidden name='move' value=4><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move4');return false;\" /></form>";} 

if($draw['b5']==$red){$b5 = "<form method='post' name='move5'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move5');return false;\" /></form>";} 
else if($draw['b5']==$white){$b5 = "<form method='post' name='move5'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move5');return false;\" /></form>";} 
else if($draw['b5']=="-".$red){$b5 = "<form method='post' name='move5'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move5');return false;\" /></form>";} 
else if($draw['b5']=="-".$white){$b5 = "<form method='post' name='move5'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move5');return false;\" /></form>";} 
else{$b5 = "<form method='post' name='move5'><input type=hidden name='move' value=5><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move5');return false;\" /></form>";} 

if($draw['b6']==$red){$b6 = "<form method='post' name='move6'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move6');return false;\" /></form>";} 
else if($draw['b6']==$white){$b6 = "<form method='post' name='move6'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move6');return false;\" /></form>";} 
else if($draw['b6']=="-".$red){$b6 = "<form method='post' name='move6'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move6');return false;\" /></form>";} 
else if($draw['b6']=="-".$white){$b6 = "<form method='post' name='move6'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move6');return false;\" /></form>";} 
else{$b6 = "<form method='post' name='move6'><input type=hidden name='move' value=6><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move6');return false;\" /></form>";} 

if($draw['b7']==$red){$b7 = "<form method='post' name='move7'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move7');return false;\" /></form>";} 
else if($draw['b7']==$white){$b7 = "<form method='post' name='move7'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move7');return false;\" /></form>";} 
else if($draw['b7']=="-".$red){$b7 = "<form method='post' name='move7'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move7');return false;\" /></form>";} 
else if($draw['b7']=="-".$white){$b7 = "<form method='post' name='move7'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move7');return false;\" /></form>";} 
else{$b7 = "<form method='post' name='move7'><input type=hidden name='move' value=7><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move7');return false;\" /></form>";} 

if($draw['b8']==$red){$b8 = "<form method='post' name='move8'><input type=hidden name='move' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move8');return false;\" /></form>";} 
else if($draw['b8']==$white){$b8 = "<form method='post' name='move8'><input type=hidden name='move' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move8');return false;\" /></form>";} 
else if($draw['b8']=="-".$red){$b8 = "<form method='post' name='move8'><input type=hidden name='move' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move8');return false;\" /></form>";} 
else if($draw['b8']=="-".$white){$b8 = "<form method='post' name='move8'><input type=hidden name='move' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move8');return false;\" /></form>";} 
else{$b8 = "<form method='post' name='move8'><input type=hidden name='move' value=8><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move8');return false;\" /></form>";} 

if($draw['b9']==$red){$b9 = "<form method='post' name='move9'><input type=hidden name='move' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move9');return false;\" /></form>";} 
else if($draw['b9']==$white){$b9 = "<form method='post' name='move9'><input type=hidden name='move' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move9');return false;\" /></form>";} 
else if($draw['b9']=="-".$red){$b9 = "<form method='post' name='move9'><input type=hidden name='move' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move9');return false;\" /></form>";} 
else if($draw['b9']=="-".$white){$b9 = "<form method='post' name='move9'><input type=hidden name='move' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move9');return false;\" /></form>";} 
else{$b9 = "<form method='post' name='move9'><input type=hidden name='move' value=9><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move9');return false;\" /></form>";} 

if($draw['b10']==$red){$b10 = "<form method='post' name='move10'><input type=hidden name='move' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move10');return false;\" /></form>";} 
else if($draw['b10']==$white){$b10 = "<form method='post' name='move10'><input type=hidden name='move' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move10');return false;\" /></form>";} 
else if($draw['b10']=="-".$red){$b10 = "<form method='post' name='move10'><input type=hidden name='move' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move10');return false;\" /></form>";} 
else if($draw['b10']=="-".$white){$b10 = "<form method='post' name='move10'><input type=hidden name='move' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move10');return false;\" /></form>";} 
else{$b10 = "<form method='post' name='move10'><input type=hidden name='move' value=10><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move10');return false;\" /></form>";} 

if($draw['b11']==$red){$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move11');return false;\" /></form>";} 
else if($draw['b11']==$white){$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move11');return false;\" /></form>";} 
else if($draw['b11']=="-".$red){$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move11');return false;\" /></form>";} 
else if($draw['b11']=="-".$white){$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move11');return false;\" /></form>";} 
else{$b11 = "<form method='post' name='move11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move11');return false;\" /></form>";} 

if($draw['b12']==$red){$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move12');return false;\" /></form>";} 
else if($draw['b12']==$white){$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move12');return false;\" /></form>";} 
else if($draw['b12']=="-".$red){$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move12');return false;\" /></form>";} 
else if($draw['b12']=="-".$white){$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move12');return false;\" /></form>";} 
else{$b12 = "<form method='post' name='move12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move12');return false;\" /></form>";} 

if($draw['b13']==$red){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move13');return false;\" /></form>";} 
else if($draw['b13']==$white){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move13');return false;\" /></form>";} 
else if($draw['b13']=="-".$red){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move13');return false;\" /></form>";} 
else if($draw['b13']=="-".$white){$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move13');return false;\" /></form>";} 
else{$b13 = "<form method='post' name='move13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move13');return false;\" /></form>";} 

if($draw['b14']==$red){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move14');return false;\" /></form>";} 
else if($draw['b14']==$white){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move14');return false;\" /></form>";} 
else if($draw['b14']=="-".$red){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move14');return false;\" /></form>";} 
else if($draw['b14']=="-".$white){$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move14');return false;\" /></form>";} 
else{$b14 = "<form method='post' name='move14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move14');return false;\" /></form>";} 

if($draw['b15']==$red){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move15');return false;\" /></form>";} 
else if($draw['b15']==$white){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move15');return false;\" /></form>";} 
else if($draw['b15']=="-".$red){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move15');return false;\" /></form>";} 
else if($draw['b15']=="-".$white){$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move15');return false;\" /></form>";} 
else{$b15 = "<form method='post' name='move15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move15');return false;\" /></form>";} 

if($draw['b16']==$red){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move16');return false;\" /></form>";} 
else if($draw['b16']==$white){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move16');return false;\" /></form>";} 
else if($draw['b16']=="-".$red){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move16');return false;\" /></form>";} 
else if($draw['b16']=="-".$white){$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move16');return false;\" /></form>";} 
else{$b16 = "<form method='post' name='move16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move16');return false;\" /></form>";} 

if($draw['b17']==$red){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move17');return false;\" /></form>";} 
else if($draw['b17']==$white){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move17');return false;\" /></form>";} 
else if($draw['b17']=="-".$red){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move17');return false;\" /></form>";} 
else if($draw['b17']=="-".$white){$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move17');return false;\" /></form>";} 
else{$b17 = "<form method='post' name='move17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move17');return false;\" /></form>";} 

if($draw['b18']==$red){$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move18');return false;\" /></form>";} 
else if($draw['b18']==$white){$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move18');return false;\" /></form>";} 
else if($draw['b18']=="-".$red){$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move18');return false;\" /></form>";} 
else if($draw['b18']=="-".$white){$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move18');return false;\" /></form>";} 
else{$b18 = "<form method='post' name='move18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move18');return false;\" /></form>";} 

if($draw['b19']==$red){$b19 = "<form method='post' name='move19'><input type=hidden name='move' value=19><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move19');return false;\" /></form>";} 
else if($draw['b19']==$white){$b19 = "<form method='post' name='move19'><input type=hidden name='move' value=19><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move19');return false;\" /></form>";} 
else if($draw['b19']=="-".$red){$b19 = "<form method='post' name='move19'><input type=hidden name='move' value=19><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move19');return false;\" /></form>";} 
else if($draw['b19']=="-".$white){$b19 = "<form method='post' name='move19'><input type=hidden name='move' value=19><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move19');return false;\" /></form>";} 
else{$b19 = "<form method='post' name='move19'><input type=hidden name='move' value=19><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move19');return false;\" /></form>";} 

if($draw['b20']==$red){$b20 = "<form method='post' name='move20'><input type=hidden name='move' value=20><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move20');return false;\" /></form>";} 
else if($draw['b20']==$white){$b20 = "<form method='post' name='move20'><input type=hidden name='move' value=20><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move20');return false;\" /></form>";} 
else if($draw['b20']=="-".$red){$b20 = "<form method='post' name='move20'><input type=hidden name='move' value=20><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move20');return false;\" /></form>";} 
else if($draw['b20']=="-".$white){$b20 = "<form method='post' name='move20'><input type=hidden name='move' value=20><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move20');return false;\" /></form>";} 
else{$b20 = "<form method='post' name='move20'><input type=hidden name='move' value=20><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move20');return false;\" /></form>";} 

if($draw['b21']==$red){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move21');return false;\" /></form>";} 
else if($draw['b21']==$white){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move21');return false;\" /></form>";} 
else if($draw['b21']=="-".$red){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move21');return false;\" /></form>";} 
else if($draw['b21']=="-".$white){$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move21');return false;\" /></form>";} 
else{$b21 = "<form method='post' name='move21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move21');return false;\" /></form>";} 

if($draw['b22']==$red){$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move22');return false;\" /></form>";} 
else if($draw['b22']==$white){$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move22');return false;\" /></form>";} 
else if($draw['b22']=="-".$red){$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move22');return false;\" /></form>";} 
else if($draw['b22']=="-".$white){$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move22');return false;\" /></form>";} 
else{$b22 = "<form method='post' name='move22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move22');return false;\" /></form>";} 

if($draw['b23']==$red){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move23');return false;\" /></form>";} 
else if($draw['b23']==$white){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move23');return false;\" /></form>";} 
else if($draw['b23']=="-".$red){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move23');return false;\" /></form>";} 
else if($draw['b23']=="-".$white){$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move23');return false;\" /></form>";} 
else{$b23 = "<form method='post' name='move23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move23');return false;\" /></form>";} 

if($draw['b24']==$red){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move24');return false;\" /></form>";} 
else if($draw['b24']==$white){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move24');return false;\" /></form>";} 
else if($draw['b24']=="-".$red){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move24');return false;\" /></form>";} 
else if($draw['b24']=="-".$white){$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move24');return false;\" /></form>";} 
else{$b24 = "<form method='post' name='move24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move24');return false;\" /></form>";} 

if($draw['b25']==$red){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move25');return false;\" /></form>";} 
else if($draw['b25']==$white){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move25');return false;\" /></form>";} 
else if($draw['b25']=="-".$red){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move25');return false;\" /></form>";} 
else if($draw['b25']=="-".$white){$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move25');return false;\" /></form>";} 
else{$b25 = "<form method='post' name='move25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move25');return false;\" /></form>";} 

if($draw['b26']==$red){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move26');return false;\" /></form>";} 
else if($draw['b26']==$white){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move26');return false;\" /></form>";} 
else if($draw['b26']=="-".$red){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move26');return false;\" /></form>";} 
else if($draw['b26']=="-".$white){$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move26');return false;\" /></form>";} 
else{$b26 = "<form method='post' name='move26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move26');return false;\" /></form>";} 

if($draw['b27']==$red){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move27');return false;\" /></form>";} 
else if($draw['b27']==$white){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move27');return false;\" /></form>";} 
else if($draw['b27']=="-".$red){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move27');return false;\" /></form>";} 
else if($draw['b27']=="-".$white){$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move27');return false;\" /></form>";} 
else{$b27 = "<form method='post' name='move27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move27');return false;\" /></form>";} 

if($draw['b28']==$red){$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move28');return false;\" /></form>";} 
else if($draw['b28']==$white){$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move28');return false;\" /></form>";} 
else if($draw['b28']=="-".$red){$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move28');return false;\" /></form>";} 
else if($draw['b28']=="-".$white){$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move28');return false;\" /></form>";} 
else{$b28 = "<form method='post' name='move28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move28');return false;\" /></form>";} 

if($draw['b29']==$red){$b29 = "<form method='post' name='move29'><input type=hidden name='move' value=29><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move29');return false;\" /></form>";} 
else if($draw['b29']==$white){$b29 = "<form method='post' name='move29'><input type=hidden name='move' value=29><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move29');return false;\" /></form>";} 
else if($draw['b29']=="-".$red){$b29 = "<form method='post' name='move29'><input type=hidden name='move' value=29><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move29');return false;\" /></form>";} 
else if($draw['b29']=="-".$white){$b29 = "<form method='post' name='move29'><input type=hidden name='move' value=29><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move29');return false;\" /></form>";} 
else{$b29 = "<form method='post' name='move29'><input type=hidden name='move' value=29><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move29');return false;\" /></form>";} 

if($draw['b30']==$red){$b30 = "<form method='post' name='move30'><input type=hidden name='move' value=30><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move30');return false;\" /></form>";} 
else if($draw['b30']==$white){$b30 = "<form method='post' name='move30'><input type=hidden name='move' value=30><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move30');return false;\" /></form>";} 
else if($draw['b30']=="-".$red){$b30 = "<form method='post' name='move30'><input type=hidden name='move' value=30><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move30');return false;\" /></form>";} 
else if($draw['b30']=="-".$white){$b30 = "<form method='post' name='move30'><input type=hidden name='move' value=30><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move30');return false;\" /></form>";} 
else{$b30 = "<form method='post' name='move30'><input type=hidden name='move' value=30><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move30');return false;\" /></form>";} 

if($draw['b31']==$red){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/red.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move31');return false;\" /></form>";} 
else if($draw['b31']==$white){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/white.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move31');return false;\" /></form>";} 
else if($draw['b31']=="-".$red){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move31');return false;\" /></form>";} 
else if($draw['b31']=="-".$white){$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move31');return false;\" /></form>";} 
else{$b31 = "<form method='post' name='move31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move31');return false;\" /></form>";} 


$blank = "<img src='images/ck/blank.png'>";

$t1="b".$draw["pselect"];
$t4=$draw[$t1];

if($t4 > 0)
{
$$t1 = "<form method='post' name='m32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/green.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'm32');return false;\" /></form>";
}
else
{
$$t1 = "<form method='post' name='m32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/kgreen.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'm32');return false;\" /></form>";

}
$t2="b".$draw["lastmove2"];

$t3=$draw[$t2];
if(abs($t3) == $red){
if($t3 > 0){
$$t2 = "<form method='post' name='move32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/lred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move32');return false;\" /></form>";
}
else{
$$t2 = "<form method='post' name='move32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/lkred.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move32');return false;\" /></form>";
}
}
else{
if($t3 > 0){
$$t2 = "<form method='post' name='move32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/lwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move32');return false;\" /></form>";
}
else{
$$t2 = "<form method='post' name='move32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ck/lkwhite.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ck_play.php', 'move32');return false;\" /></form>";
}
}


//layout
	
if($userid == $white)
	{
	$txt="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '400' width='400' style=\"background: url('images/ck/background.png') no-repeat;\">";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b33</td><td style=\"font-size:0;\">$blank</td><td>$b1</td><td style=\"font-size:0;\">$blank</td><td>$b2</td><td style=\"font-size:0;\">$blank</td><td>$b3</td></tr>";
	$txt.="<tr><td>$b4</td><td style=\"font-size:0;\">$blank</td><td>$b5</td><td style=\"font-size:0;\">$blank</td><td>$b6</td><td style=\"font-size:0;\">$blank</td><td>$b7</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b8</td><td style=\"font-size:0;\">$blank</td><td>$b9</td><td style=\"font-size:0;\">$blank</td><td>$b10</td><td style=\"font-size:0;\">$blank</td><td>$b11</td></tr>";
	$txt.="<tr><td>$b12</td><td style=\"font-size:0;\">$blank</td><td>$b13</td><td style=\"font-size:0;\">$blank</td><td>$b14</td><td style=\"font-size:0;\">$blank</td><td>$b15</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b16</td><td style=\"font-size:0;\">$blank</td><td>$b17</td><td style=\"font-size:0;\">$blank</td><td>$b18</td><td style=\"font-size:0;\">$blank</td><td>$b19</td></tr>";
	$txt.="<tr><td>$b20</td><td style=\"font-size:0;\">$blank</td><td>$b21</td><td style=\"font-size:0;\">$blank</td><td>$b22</td><td style=\"font-size:0;\">$blank</td><td>$b23</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b24</td><td style=\"font-size:0;\">$blank</td><td>$b25</td><td style=\"font-size:0;\">$blank</td><td>$b26</td><td style=\"font-size:0;\">$blank</td><td>$b27</td></tr>";
	$txt.="<tr><td>$b28</td><td style=\"font-size:0;\">$blank</td><td>$b29</td><td style=\"font-size:0;\">$blank</td><td>$b30</td><td style=\"font-size:0;\">$blank</td><td>$b31</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="</table></center>";
	}
else{
	$txt="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '400' width='400' style=\"background: url('images/ck/background.png') no-repeat;\">";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b31</td><td style=\"font-size:0;\">$blank</td><td>$b30</td><td style=\"font-size:0;\">$blank</td><td>$b29</td><td style=\"font-size:0;\">$blank</td><td>$b28</td></tr>";
	$txt.="<tr><td>$b27</td><td style=\"font-size:0;\">$blank</td><td>$b26</td><td style=\"font-size:0;\">$blank</td><td>$b25</td><td style=\"font-size:0;\">$blank</td><td>$b24</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b23</td><td style=\"font-size:0;\">$blank</td><td>$b22</td><td style=\"font-size:0;\">$blank</td><td>$b21</td><td style=\"font-size:0;\">$blank</td><td>$b20</td></tr>";
	$txt.="<tr><td>$b19</td><td style=\"font-size:0;\">$blank</td><td>$b18</td><td style=\"font-size:0;\">$blank</td><td>$b17</td><td style=\"font-size:0;\">$blank</td><td>$b16</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b15</td><td style=\"font-size:0;\">$blank</td><td>$b14</td><td style=\"font-size:0;\">$blank</td><td>$b13</td><td style=\"font-size:0;\">$blank</td><td>$b12</td></tr>";
	$txt.="<tr><td>$b11</td><td style=\"font-size:0;\">$blank</td><td>$b10</td><td style=\"font-size:0;\">$blank</td><td>$b9</td><td style=\"font-size:0;\">$blank</td><td>$b8</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="<tr><td style=\"font-size:0;\">$blank</td><td>$b7</td><td style=\"font-size:0;\">$blank</td><td>$b6</td><td style=\"font-size:0;\">$blank</td><td>$b5</td><td style=\"font-size:0;\">$blank</td><td>$b4</td></tr>";
	$txt.="<tr><td>$b3</td><td style=\"font-size:0;\">$blank</td><td>$b2</td><td style=\"font-size:0;\">$blank</td><td>$b1</td><td style=\"font-size:0;\">$blank</td><td>$b33</td><td style=\"font-size:0;\">$blank</td></tr>";
	$txt.="</table></center>";
	}
	print $txt;
	
}


function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game=$db->query("SELECT * FROM ck_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);


	$game2=$db->query("SELECT * FROM ck_game WHERE ck_room=$roomid", $c) or die("1");
	$gijoe=$db->fetch_row($game2);

	$turn = $ga['turn'];

	if($turn == $userid)
	{
		$vnam = "b".$move;
		if($move==32){$db->query("UPDATE ck_game SET pselect = 0 WHERE ck_room=$roomid");die();}
		if($gijoe["$vnam"]==$userid){$db->query("UPDATE ck_game SET pselect=$move WHERE ck_room=$roomid");die();}
		if($gijoe["$vnam"]=="-".$userid){$db->query("UPDATE ck_game SET pselect=$move WHERE ck_room=$roomid");die();}
	
		$red = $gijoe['red']; // get red player (used for direction on board)
		
		if($gijoe['red'] == $gijoe['p1']){$white = $gijoe['p2'];}
		else{$white = $gijoe['p1'];}
		
		$pselect = $gijoe['pselect'];

//basic move no capture no king
		$valid = valid_move($userid,$red,$move,$pselect);
		$bmove = $gijoe[b."$move"];
		$lastmove = $gijoe['lastmove'];
		$t = "b".$gijoe[pselect];
		$user = $gijoe["$t"];
		if($valid > 0 && $bmove == 0 && $lastmove == 0 && $user >0)
		{
			$temp = "b".$gijoe[pselect];
			$temp2 = "b".$move;
			$db->query("UPDATE ck_game SET $temp=0, $temp2=$userid,pselect = $temp2,lastmove = $move, lastmove2 = $move WHERE ck_room=$roomid");
			
			$gijoe["$temp2"] = $userid;
			$value = king_me($userid,$red, $move);
			if($value == 1)
			{
				$temp3 = "-".$gijoe["$temp2"];
				$db->query("UPDATE ck_game SET $temp2=$temp3 WHERE ck_room=$roomid");
			}
			end_turn($userid, $roomid);
		}
//capture a piece

		$valid2 = jump_move($userid,$red,$white,$move,$pselect);
		$jumpedspot = $gijoe[b."$move"];
		$newspot = "b".$move;
		$jumpsomeone = $gijoe[b."$valid2"];
		$user = $gijoe[b."$pselect"];
		if($valid2 > 0 && $jumpedspot == 0 && (abs($jumpsomeone) >0 && abs($jumpsomeone) != $userid) && $user >0)
		{

			$temp = "b".$gijoe[pselect]; // was
			$temp2 = "b".$move; // going
			$temp3 = "b".$valid2; //spot jumped
			$db->query("UPDATE ck_game SET $temp=0, $temp2=$userid, pselect = $move ,lastmove = $move,lastmove2 = $move, $temp3 = 0 WHERE ck_room=$roomid");
			$gijoe["$temp2"] = $userid;
			$value = king_me($userid,$red, $move);
			
			if($value == 1)
			{
				$temp4 = "-".$gijoe["$temp2"];
				$db->query("UPDATE ck_game SET $temp2=$temp4 WHERE ck_room=$roomid");
			}
			$secondjump = array();
			$secondjump = second_jump($move, $red, $userid); //possible spots to
			$valid1 = jump_move($userid,$red,$white,$secondjump["d1"],$move);
			$valid2 = jump_move($userid,$red,$white,$secondjump["d2"],$move);
	
			$start = "b".$move;
			$spotjumped1 = $gijoe[b."$valid1"];
			$spotjumped2 = $gijoe[b."$valid2"];
			$temp1 = $secondjump["d1"];
			$temp2 = $secondjump["d2"];
			$finish1 =$gijoe[b."$temp1"];
			$finish2 = $gijoe[b."$temp2"];
				
			if( ($valid1 > 0 && $finish1 == 0 && ($spotjumped1 != 0 && abs($spotjumped1) != $userid)) || ($valid2 > 0 && $finish2 == 0 && ($spotjumped2 != 0 && abs($spotjumped2) != $userid)))
			{
				$themissionary = 69;
				$db->query("UPDATE ck_game SET lastmove2=0 WHERE ck_room=$roomid");
			}
			else{
				end_turn($userid, $roomid);
			}	
		}
		//king moves normal move

		$valid = valid_king_move($userid,$red,$move,$pselect);
		$bmove = $gijoe[b."$move"];
		$lastmove = $gijoe['lastmove'];
		$isaking = $gijoe[pselect];
		$kingvalue = $gijoe[b."$isaking"];

		if($valid > 0 && $bmove == 0 && $lastmove == 0 && $kingvalue < 0)
		{
			$temp = "b".$gijoe[pselect];
			$temp2 = "b".$move;
			$user = $gijoe["$temp"];

			$db->query("UPDATE ck_game SET $temp=0, $temp2='$user',pselect = $temp2,lastmove = $move, lastmove2 = $move WHERE ck_room=$roomid");
			$gijoe["$temp2"] = $userid;
			end_turn($userid, $roomid);
		}
		//king jump
		//king_second($lastmove, $red, $userid) // possible moves
		//function king_jump($userid,$red,$white,$move,$pselect)

		$valid = king_jump($userid,$red,$white,$move,$pselect);
		$jumptoo = $gijoe[b."$move"]; 			//value of new spot
		$newspot = "b".$move;					//name of new spot
		$spotjumped = $gijoe[b."$valid"];		//value of spot jumped
		$user = abs($gijoe[b."$pselect"]);			//user value of starting spot
		$isaking = $gijoe[pselect];
		$kingvalue = $gijoe[b."$isaking"];

		if(($valid > 0 && $jumptoo == 0 && (abs($spotjumped) >0 && abs($spotjumped) != $userid) && abs($user) >0) && $kingvalue < 0)
		{
			$temp = "b".$gijoe[pselect]; // was
			$temp2 = "b".$move; // going
			$temp3 = "b".$valid; //spot jumped
			$neguser = "-".$userid;
			

			$db->query("UPDATE ck_game SET $temp=0, $temp2=$neguser, pselect = $move ,lastmove = $move,lastmove2 = $move, $temp3 = 0 WHERE ck_room=$roomid");
			$gijoe["$temp2"] = "-".$userid;
		
			//second jump
			$secondjump = array();
			$secondjump = king_second($move, $red, $userid); //possible spots to

			$valid1 = king_jump($userid,$red,$white,$secondjump["d1"],$move);
			$valid2 = king_jump($userid,$red,$white,$secondjump["d2"],$move);
			$valid3 = king_jump($userid,$red,$white,$secondjump["d3"],$move);
			$valid4 = king_jump($userid,$red,$white,$secondjump["d4"],$move);

			$start = "b".$move;
	
			$spotjumped1 = $gijoe[b."$valid1"];
			$spotjumped2 = $gijoe[b."$valid2"];
			$spotjumped3 = $gijoe[b."$valid3"];
			$spotjumped4 = $gijoe[b."$valid4"];
	
			$temp1 = $secondjump["d1"];
			$temp2 = $secondjump["d2"];
			$temp3 = $secondjump["d3"];
			$temp4 = $secondjump["d4"];
	
			$finish1 = $gijoe[b."$temp1"];
			$finish2 = $gijoe[b."$temp2"];
			$finish3 = $gijoe[b."$temp3"];
			$finish4 = $gijoe[b."$temp4"];

		if( ($valid1 > 0 && $finish1 == 0 && ($spotjumped1 >0 && abs($spotjumped1) != $userid)) ||	
			($valid2 > 0 && $finish2 == 0 && ($spotjumped2 >0 && abs($spotjumped2) != $userid)) ||
			($valid3 > 0 && $finish3 == 0 && ($spotjumped3 >0 && abs($spotjumped3) != $userid)) ||
			($valid4 > 0 && $finish4 == 0 && ($spotjumped4 >0 && abs($spotjumped4) != $userid)) )
			{
				$themissionary = 69;
				$db->query("UPDATE ck_game SET lastmove2=0 WHERE ck_room=$roomid");
			}
			else{
				end_turn($userid, $roomid);
			}	

		}
	$winner = check_win($roomid);
	if($winner != 0)
	{award_win($roomid,$winner);}
	}
		
}

function end_turn($userid, $roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM ck_room WHERE id = $roomid"));
	if($ui['turn']==$userid)
	{
		toggle_turn($roomid);
	}
}
function check_win($roomid)
{
	global $db,$ir;

	$winner = 0;

	$ginf = $db->query("SELECT * FROM ck_game WHERE ck_room = $roomid");
	$gin = $db->fetch_row($ginf);
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM ck_room WHERE id = $roomid"));
	$turn = $ui['turn'];
	$red = $gin['red'];

	if($turn == $ui['p1']) {$user = $ui['p1']; $playersturn = $ui['p2']; }
	else{$user = $ui['p2']; $playersturn = $ui['p1'];}
	
	if($red == $ui['p1']){$white == $ui['p1'];}
	else{$white == $ui['p2'];}
	
	$hasamove = 0;
	for($i = 0; $i <= 31; $i++){
		if($i == 0){$i = 33;}
		$piece = $gin["b".$i];
	if(abs($piece) == $user) // if the piece is there
	{
		if($piece >0) // piece is a normal piece 
		{
			// function all_basic($move, $red, $userid)  	 	- gives all possibilities for a basic piece non-jump
			// function king_basic($move, $red, $userid) 		- gives all possibilities for a king piece non-jump
			// function second_jump($lastmove, $red, $userid)	- gives all possibilities for a basic piece jump
			// function king_second($lastmove, $red, $userid) 	- gives all possibilities for a king jump
			// function valid_move($userid,$red,$move,$pselect) - valid normal move
			// jump_move($userid,$red,$white,$move,$pselect)	- valid jump move
			// king_jump($userid,$red,$white,$move,$pselect)   	- valid king jump

			//does player have any normal moves
			$possible_moves = all_basic($i, $red, $turn);

		
			$valid1 = valid_move($turn,$red,$possible_moves["d1"],$i);
			$valid2 = valid_move($turn,$red,$possible_moves["d2"],$i);
			
			$temp1 = $possible_moves["d1"];
			$temp2 = $possible_moves["d2"];
			
			$openspot1 = $gin[b."$temp1"];
			$openspot2 = $gin[b."$temp2"];
			
			/// 1 -- 0 -- -- 
			if(($valid1 > 0 && $openspot1 == 0) ||($valid2 > 0 && $openspot2 == 0))
			{$hasamove = 1;}
			

			//does player have any normal jumps
			$possible_moves = second_jump($i, $red, $turn);	// gives all possibilities for a basic piece jump
			$valid1 = jump_move($turn,$red,$white,$possible_moves["d1"],$i); // spot jumped
			$valid2 = jump_move($turn,$red,$white,$possible_moves["d2"],$i); //spot jumped
			
			$spotjumped1 = $gin[b."$valid1"]; //value of spot jumped
			$spotjumped2 = $gin[b."$valid2"]; //value of spot jumped
			
			$temp1 = $possible_moves["d1"];
			$temp2 = $possible_moves["d2"];
			
			$finish1 = $gin[b."$temp1"]; // spot landing
			$finish2 = $gin[b."$temp2"]; // spot landing

			if(	($valid1 > 0 && $finish1 == 0 && ($spotjumped1 >0 && abs($spotjumped1) != $turn))	||
				($valid2 > 0 && $finish2 == 0 && ($spotjumped2 >0 && abs($spotjumped2) != $turn)))
			{$hasamove = 1;}
		}
		else
		{
			//does player have any king moves
			$possible_moves = king_basic($i, $red, $turn);
			$valid1 = valid_king_move($turn,$red,$possible_moves["d1"],$i);
			$valid2 = valid_king_move($turn,$red,$possible_moves["d2"],$i);
			$valid3 = valid_king_move($turn,$red,$possible_moves["d3"],$i);
			$valid4 = valid_king_move($turn,$red,$possible_moves["d4"],$i);

			$temp1 = $possible_moves["d1"];
			$temp2 = $possible_moves["d2"];
			$temp3 = $possible_moves["d3"];
			$temp4 = $possible_moves["d4"];
			
			$openspot1 = $gin["b".$temp1];
			$openspot2 = $gin["b".$temp2];
			$openspot3 = $gin["b".$temp3];
			$openspot4 = $gin["b".$temp4];
			
			if(($valid1 > 0 && $openspot1 == 0) ||($valid2 > 0 && $openspot2 == 0) || ($valid3 > 0 && $openspot3 == 0) || ($valid4 > 0 && $openspot4 == 0) )
			{$hasamove = 1;}
			//does player have any king jumps

			$possible_moves = king_second($i, $red, $turn);	// gives all possibilities for a basic piece jump
			
			$valid1 = king_jump($turn,$red,$white,$possible_moves["d1"],$i); // spot jumped
			$valid2 = king_jump($turn,$red,$white,$possible_moves["d2"],$i); //spot jumped
			$valid3 = king_jump($turn,$red,$white,$possible_moves["d3"],$i); // spot jumped
			$valid4 = king_jump($turn,$red,$white,$possible_moves["d4"],$i); //spot jumped
			
			$spotjumped1 = $gin[b."$valid1"]; //value of spot jumped
			$spotjumped2 = $gin[b."$valid2"]; //value of spot jumped
			$spotjumped3 = $gin[b."$valid3"]; //value of spot jumped
			$spotjumped4 = $gin[b."$valid4"]; //value of spot jumped
			
			$temp1 = $possible_moves["d1"];
			$temp2 = $possible_moves["d2"];
			$temp3 = $possible_moves["d3"];
			$temp4 = $possible_moves["d4"];
			
			$finish1 = $gin[b."$temp1"]; // spot landing
			$finish2 = $gin[b."$temp2"]; // spot landing
			$finish3 = $gin[b."$temp3"]; // spot landing
			$finish4 = $gin[b."$temp4"]; // spot landing
			
			if(	($valid1 > 0 && $finish1 == 0 && ($spotjumped1 != 0 && abs($spotjumped1) != $turn))	||
				($valid2 > 0 && $finish2 == 0 && ($spotjumped2 != 0 && abs($spotjumped2) != $turn))	||
				($valid3 > 0 && $finish3 == 0 && ($spotjumped3 != 0 && abs($spotjumped3) != $turn))	||
				($valid4 > 0 && $finish4 == 0 && ($spotjumped4 != 0 && abs($spotjumped4) != $turn))  	)
			{$hasamove = 1;}
		}
		}
		if($i == 33){$i = 0;}
	}
	//Return the winner's userid	
	if($hasamove == 0)
	{
		$winner = $playersturn;
	}
	return $winner;
}

function valid_move($userid,$red,$move,$pselect)
{	
	if($userid == $red)
	{
		switch($pselect)
		{
			case "1":
				if($move == 5 || $move == 6)
				return 1;
				break;
			case "2":
				if($move == 6 || $move == 7)
				return 1;
				break;			
			case "3":
				if($move == 7)
				return 1;
				break;
			case "4":
				if($move == 8)
				return 1;
				break;
			case "5":
				if($move == 8 || $move == 9)
				return 1;
				break;			
			case "6":
				if($move == 9|| $move == 10)
				return 1;
				break;
			case "7":
				if($move == 10 || $move == 11)
				return 1;
				break;
			case "8":
				if($move == 12 || $move == 13)
				return 1;
				break;			
			case "9":
				if($move == 13|| $move == 14)
				return 1;
				break;
			case "10":
				if($move == 14 || $move == 15)
				return 1;
				break;
			case "11":
				if($move == 15)
				return 1;
				break;			
			case "12":
				if($move == 16)
				return 1;
				break;
			case "13":
				if($move == 16 || $move == 17)
				return 1;
				break;
			case "14":
				if($move == 17 || $move == 18)
				return 1;
				break;			
			case "15":
				if($move == 18 || $move == 19)
				return 1;
				break;
			case "16":
				if($move == 20 || $move == 21)
				return 1;
				break;
			case "17":
				if($move == 21|| $move == 22)
				return 1;
				break;			
			case "18":
				if($move == 22 || $move == 23)
				return 1;
				break;
			case "19":
				if($move == 23)
				return 1;
				break;
			case "20":
				if($move == 24)
				return 1;
				break;			
			case "21":
				if($move == 24 || $move == 25)
				return 1;
				break;
			case "22":
				if($move == 25|| $move == 26)
				return 1;
				break;
			case "23":
				if($move == 26 || $move == 27)
				return 1;
				break;			
			case "24":
				if($move == 28 || $move == 29)
				return 1;
				break;
			case "25":
				if($move == 29 || $move == 30)
				return 1;
				break;
			case "26":
				if($move == 30 || $move == 31)
				return 1;
				break;			
			case "27":
				if($move == 31)
				return 1;
				break;
			case "33":	
				if($move == 4 || $move == 5)
				return 1;
				break;
			default:
				return false;
		}
	}
	else
	{
		switch($pselect)
		{
			case "4":
				if($move == 33)
				return 1;
				break;
			case "5":
				if($move == 33 || $move == 1)
				return 1;
				break;			
			case "6":
				if($move == 1|| $move == 2)
				return 1;
				break;
			case "7":
				if($move == 2 || $move == 3)
				return 1;
				break;
			case "8":
				if($move == 4 || $move == 5)
				return 1;
				break;			
			case "9":
				if($move == 5|| $move == 6)
				return 1;
				break;
			case "10":
				if($move == 6 || $move == 7)
				return 1;
				break;
			case "11":
				if($move == 7)
				return 1;
				break;			
			case "12":
				if($move == 8)
				return 1;
				break;
			case "13":
				if($move == 8 || $move == 9)
				return 1;
				break;
			case "14":
				if($move == 9 || $move == 10)
				return 1;
				break;			
			case "15":
				if($move == 10 || $move == 11)
				return 1;
				break;
			case "16":
				if($move == 12 || $move == 13)
				return 1;
				break;
			case "17":
				if($move == 13|| $move == 14)
				return 1;
				break;			
			case "18":
				if($move == 14 || $move == 15)
				return 1;
				break;
			case "19":
				if($move == 15)
				return 1;
				break;
			case "20":
				if($move == 16)
				return 1;
				break;			
			case "21":
				if($move == 16 || $move == 17)
				return 1;
				break;
			case "22":
				if($move == 17|| $move == 18)
				return 1;
				break;
			case "23":
				if($move == 18 || $move == 19)
				return 1;
				break;			
			case "24":
				if($move == 20 || $move == 21)
				return 1;
				break;
			case "25":
				if($move == 21 || $move == 22)
				return 1;
				break;
			case "26":
				if($move == 22 || $move == 23)
				return 1;
				break;			
			case "27":
				if($move == 23)
				return 1;
				break;
			case "28":
				if($move == 24)
				return 1;
				break;
			case "29":
				if($move == 24 || $move == 25)
				return 1;
				break;			
			case "30":
				if($move == 25 || $move == 26)
				return 1;
				break;	
			case "31":
				if($move == 26 || $move == 27)
				return 1;
				break;
			default:
				return false;							
		}
	}
}

function jump_move($userid,$red,$white,$move,$pselect)
{	
	if($userid == $red)
	{
		switch($pselect)
		{
			case "1":
				if($move == 8)
				return 5;
				if($move == 10)
				return 6;
				break;
			case "2":
				if($move == 9)
				return 6;
				 if($move == 11)
				 return 7;
				break;			
			case "3":
				if($move == 10)
				return 7;
				break;
			case "4":
				if($move == 13)
				return 8;
				break;
			case "5":
				if($move == 12)
				return 8;
				if($move == 14)
				return 9;
				break;			
			case "6":
				if($move == 13)
				return 9;
				if($move == 15)
				return 10;
				break;
			case "7":
				if($move == 14)
				return 10;
				break;
			case "8":
				if($move == 17)
				return 13;
				break;			
			case "9":
				if($move == 16)
				return 13;
				if($move == 18)
				return 14;
				break;
			case "10":
				if($move == 17)
				return 14;
				 if($move == 19)
				 return 15;
				break;
			case "11":
				if($move == 18)
				return 15;
				break;			
			case "12":
				if($move == 21)
				return 16;
				break;
			case "13":
				if($move == 20)
				return 16;
				if($move == 22)
				return 17;
				break;
			case "14":
				if($move == 21)
				return 17;
				if($move == 23)
				return 18;
				break;			
			case "15":
				if($move == 22)
				return 18;
				break;
			case "16":
				if($move == 25)
				return 21;
				break;
			case "17":
				if($move == 24) 
				return 21;
				if($move == 26)
				return 22;
				break;			
			case "18":
				if($move == 25)
				return 22;
				if($move == 27)
				return 23;
				break;
			case "19":
				if($move == 26)
				return 23;
				break;
			case "20":
				if($move == 29)
				return 24;
				break;			
			case "21":
				if($move == 28)
				return 24;
				if($move == 30)
				return 25;
				break;
			case "22":
				if($move == 29)
				return 25;
				if($move == 31)
				return 26;
				break;
			case "23":
				if($move == 30)
				return 26;
				break;			
			case "33":	
				if($move == 9)
				return 5;
				break;
			default:
				return 0;
		}
	}
	else
	{
		switch($pselect)
		{
			case "8":
				if($move == 1)
				return 5;
				break;			
			case "9":
				if($move == 33)
				return 5;
				if($move == 2)
				return 6;
				break;
			case "10":
				if($move == 1)
				return 6;
				if($move == 3)
				return 7;
				break;
			case "11":
				if($move == 2)
				return 7;
				break;			
			case "12":
				if($move == 5)
				return 8;
				break;
			case "13":
				if($move == 4)
				return 8;
				 if($move == 6)
				return 9;
				break;
			case "14":
				if($move == 5)
				return 9;
				if($move == 7)
				return 10;
				break;			
			case "15":
				if($move == 6)
				return 10;
				break;
			case "16":
				if($move == 9)
				return 13;
				break;
			case "17":
				if($move == 8)
				return 13;
				if($move == 10)
				return 14;
				break;			
			case "18":
				if($move == 9)
				return 14;
				if($move == 11)
				return 15;
				break;
			case "19":
				if($move == 10)
				return 15;
				break;
			case "20":
				if($move == 13)
				return 16;
				break;			
			case "21":
				if($move == 12)
				return 16;
				if($move == 14)
				return 17;
				break;
			case "22":
				if($move == 13)
				return 17;
				if($move == 15)
				return 18;
				break;
			case "23":
				if($move == 14)
				return 18;
				break;	
			case "24":
				if($move == 17)
				return 21;
				break;	
			case "25":
				if($move == 16)
				return 21;
				if($move == 18)
				return 22;
				break;
			case "26":
				if($move == 17) 
				return 22;
				if($move == 19)
				return 23;
				break;	
			case "27":
				if($move == 18)
				return 23;
				break;	
			case "28":
				if($move == 21)
				return 24;
				break;	
			case "29":
				if($move == 20) 
				return 24;;
				if($move == 22)
				return 25;
				break;	
			case "30":
				if($move == 21) 
				return 25;
				if($move == 23)
				return 26;
				break;	
			case "31":
				if($move == 22)
				return 26;
				break;			
			default:
				return 0;
		}
	}
}
function king_me($userid,$red, $move)
{
	if($userid == $red)
	{
		if($move == 28 || $move == 29 || $move == 30 || $move == 31)
			{return 1;}	

	}
	else{
		if($move == 33 || $move == 1 || $move == 2 || $move == 3)
			{return 1;}	
	}

	return 0;
}
function second_jump($lastmove, $red, $userid)
{
$var=array();
	if($userid==$red)
	{
		switch($lastmove)
		{
			case "33":
				$var["d1"] = 9;
				$var["d2"] = 0; 
				break;
			case "1":
				$var["d1"] = 8;
				$var["d2"] = 10; 
				break;
			case "2":
				$var["d1"] = 9;
				$var["d2"] = 11; 
				break;
			case "3":
				$var["d1"] = 10;
				$var["d2"] = 0; 
				break;
			case "4":
				$var["d1"] = 13;
				$var["d2"] = 0; 
				break;
			case "5":
				$var["d1"] = 12;
				$var["d2"] = 14; 
				break;
			case "6":
				$var["d1"] = 13;
				$var["d2"] = 15; 
				break;
			case "7":
				$var["d1"] = 14;
				$var["d2"] = 0; 
				break;
			case "8":
				$var["d1"] = 17;
				$var["d2"] = 0; 
				break;
			case "9":
				$var["d1"] = 16;
				$var["d2"] = 18; 
				break;
			case "10":
				$var["d1"] = 17;
				$var["d2"] = 19; 
				break;
			case "11":
				$var["d1"] = 18;
				$var["d2"] = 0; 
				break;
			case "12":
				$var["d1"] = 21;
				$var["d2"] = 0; 
				break;
			case "13":
				$var["d1"] = 20;
				$var["d2"] = 22; 
				break;
			case "14":
				$var["d1"] = 21;
				$var["d2"] = 23; 
				break;
			case "15":
				$var["d1"] = 22;
				$var["d2"] = 0; 
				break;
			case "16":
				$var["d1"] = 25;
				$var["d2"] = 0; 
				break;
			case "17":
				$var["d1"] = 24;
				$var["d2"] = 26; 
				break;
			case "18":
				$var["d1"] = 25;
				$var["d2"] = 27; 
				break;
			case "19":
				$var["d1"] = 26;
				$var["d2"] = 0; 
				break;
			case "20":
				$var["d1"] = 29;
				$var["d2"] = 0; 
				break;
			case "21":
				$var["d1"] = 28;
				$var["d2"] = 30; 
				break;
			case "22":
				$var["d1"] = 29;
				$var["d2"] = 31; 
				break;
			case "23":
				$var["d1"] = 30;
				$var["d2"] = 0; 
				break;
			default:
				$var["d1"] = 0;
				$var["d2"] = 0; 
		}
	}
	else{
		switch($lastmove)
		{
			case "8":
				$var["d1"] = 1;
				$var["d2"] = 0; 
				break;
			case "9":
				$var["d1"] = 33;
				$var["d2"] = 2; 
				break;
			case "10":
				$var["d1"] = 1;
				$var["d2"] = 3; 
				break;
			case "11":
				$var["d1"] = 2;
				$var["d2"] = 0; 
				break;
			case "12":
				$var["d1"] = 5;
				$var["d2"] = 0; 
				break;
			case "13":
				$var["d1"] = 4;
				$var["d2"] = 6; 
				break;
			case "14":
				$var["d1"] = 5;
				$var["d2"] = 7; 
				break;
			case "15":
				$var["d1"] = 6;
				$var["d2"] = 0; 
				break;
			case "16":
				$var["d1"] = 9;
				$var["d2"] = 0; 
				break;
			case "17":
				$var["d1"] = 8;
				$var["d2"] = 10; 
				break;
			case "18":
				$var["d1"] = 9;
				$var["d2"] = 11; 
				break;
			case "19":
				$var["d1"] = 10;
				$var["d2"] = 0; 
				break;
			case "20":
				$var["d1"] = 13;
				$var["d2"] = 0; 
				break;
			case "21":
				$var["d1"] = 12;
				$var["d2"] = 14; 
				break;
			case "22":
				$var["d1"] = 13;
				$var["d2"] = 15; 
				break;
			case "23":
				$var["d1"] = 14;
				$var["d2"] = 0; 
				break;
			case "24":
				$var["d1"] = 17;
				$var["d2"] = 0; 
				break;
			case "25":
				$var["d1"] = 16;
				$var["d2"] = 18; 
				break;
			case "26":
				$var["d1"] = 17;
				$var["d2"] = 19; 
				break;
			case "27":
				$var["d1"] = 18;
				$var["d2"] = 0; 
				break;
			case "28":
				$var["d1"] = 21;
				$var["d2"] = 0; 
				break;
			case "29":
				$var["d1"] = 20;
				$var["d2"] = 22; 
				break;
			case "30":
				$var["d1"] = 23;
				$var["d2"] = 21; 
				break;
			case "31":
				$var["d1"] = 22;
				$var["d2"] = 0; 
				break;
			default:
				$var["d1"] = 0;
				$var["d2"] = 0; 
		}
	}
	return $var;
}
function valid_king_move($userid,$red,$move,$pselect)
{
               switch($pselect)
               {
                       case "1":
                               if($move == 5 || $move == 6)
                               return 1;
                               break;
                       case "2":
                               if($move == 6 || $move == 7)
                               return 1;
                               break;
                       case "3":
                               if($move == 7)
                               return 1;
                               break;
                       case "4":
                               if($move == 8 || $move == 33)
                               return 1;
                               break;
                       case "5":
                               if($move == 8 || $move == 9 || $move == 1 || $move == 33)
                               return 1;
                               break;
                       case "6":
                               if($move == 9 || $move == 10 || $move == 1 || $move == 2)
                               return 1;
                               break;
                       case "7":
                               if($move == 10 || $move == 11 || $move == 2 || $move == 3)
                               return 1;
                               break;
                       case "8":
                               if($move == 12 || $move == 13 || $move == 4 || $move == 5)
                               return 1;
                               break;
                       case "9":
                               if($move == 13|| $move == 14 || $move == 5 || $move == 6)
                               return 1;
                               break;
                       case "10":
                               if($move == 14 || $move == 15 || $move == 6 || $move == 7)
                               return 1;
                               break;
                       case "11":
                               if($move == 15 || $move == 7)
                               return 1;
                               break;
                       case "12":
                               if($move == 16 || $move == 8)
                               return 1;
                               break;
                       case "13":
                               if($move == 16 || $move == 17 || $move == 8 || $move == 9)
                               return 1;
                               break;
                       case "14":
                               if($move == 17 || $move == 18 || $move == 9 || $move == 10)
                               return 1;
                               break;
                       case "15":
                               if($move == 18 || $move == 19 || $move == 10 || $move == 11)
                               return 1;
                               break;
                       case "16":
                               if($move == 20 || $move == 21 || $move == 12 || $move == 13)
                               return 1;
                               break;
                       case "17":
                               if($move == 21|| $move == 22 || $move == 13 || $move == 14)
                               return 1;
                               break;
                       case "18":
                               if($move == 22 || $move == 23 || $move == 14 || $move == 15)
                               return 1;
                               break;
                       case "19":
                               if($move == 23 || $move == 15)
                               return 1;
                               break;
                       case "20":
                               if($move == 24 || $move == 16)
                               return 1;
                               break;
                       case "21":
                               if($move == 24 || $move == 25 || $move == 16 || $move == 17)
                               return 1;
                               break;
                       case "22":
                               if($move == 25|| $move == 26 || $move == 17 || $move == 18)
                               return 1;
                               break;
                       case "23":
                               if($move == 26 || $move == 27 || $move == 18 || $move == 19)
                               return 1;
                               break;
                       case "24":
                               if($move == 28 || $move == 29 || $move == 20 || $move == 21)
                               return 1;
                               break;
                       case "25":
                               if($move == 29 || $move == 30 || $move == 21 || $move == 22)
                               return 1;
                               break;
                       case "26":
                               if($move == 30 || $move == 31 || $move == 22 || $move == 23)
                               return 1;
                               break;
                       case "27":
                               if($move == 31 || $move == 23)
                               return 1;
                               break;
                       case "33":
                               if($move == 4 || $move == 5)
                               return 1;
                               break;
                       case "28":
                               if($move == 24)
                               return 1;
                               break;
                       case "29":
                               if($move == 24 || $move == 25)
                               return 1;
                               break;
                       case "30":
                               if($move == 25 || $move == 26)
                               return 1;
                               break;
                       case "31":
                               if($move == 26 || $move == 27)
                               return 1;
                               break;
                       default:
                               return false;
       }

}
function king_jump($userid,$red,$white,$move,$pselect)
{	
		switch($pselect)
		{
			case "1":
				if($move == 8)
				return 5;
				if($move == 10)
				return 6;
				break;
			case "2":
				if($move == 9)
				return 6;
				 if($move == 11)
				 return 7;
				break;			
			case "3":
				if($move == 10)
				return 7;
				break;
			case "4":
				if($move == 13)
				return 8;
				break;
			case "5":
				if($move == 12)
				return 8;
				if($move == 14)
				return 9;
				break;			
			case "6":
				if($move == 13)
				return 9;
				if($move == 15)
				return 10;
				break;
			case "7":
				if($move == 14)
				return 10;
				break;
			case "8":
				if($move == 17)
				return 13;
				if($move == 1)
				return 5;
				break;			
			case "9":
				if($move == 16)
				return 13;
				if($move == 18)
				return 14;
				if($move == 33)
				return 5;
				if($move == 2)
				return 6;
				break;
			case "10":
				if($move == 17)
				return 14;
				 if($move == 19)
				 return 15;
				 if($move == 1)
				return 6;
				if($move == 3)
				return 7;
				break;
			case "11":
				if($move == 18)
				return 15;
				if($move == 2)
				return 7;
				break;			
			case "12":
				if($move == 21)
				return 16;
				if($move == 5)
				return 8;
				break;
			case "13":
				if($move == 20)
				return 16;
				if($move == 22)
				return 17;
				if($move == 4)
				return 8;
				if($move == 6)
				return 9;
				break;
			case "14":
				if($move == 21)
				return 17;
				if($move == 23)
				return 18;
				if($move == 5)
				return 9;
				if($move == 7)
				return 10;
				break;			
			case "15":
				if($move == 22)
				return 18;
				if($move == 6)
				return 10;
				break;
			case "16":
				if($move == 25)
				return 21;
				if($move == 9)
				return 13;
				break;
			case "17":
				if($move == 24) 
				return 21;
				if($move == 26)
				return 22;
				if($move == 8)
				return 13;
				if($move == 10)
				return 14;
				break;			
			case "18":
				if($move == 25)
				return 22;
				if($move == 27)
				return 23;
				if($move == 9)
				return 14;
				if($move == 11)
				return 15;
				break;
			case "19":
				if($move == 26)
				return 23;
				if($move == 10)
				return 15;
				break;
			case "20":
				if($move == 29)
				return 24;
				if($move == 13)
				return 16;
				break;			
			case "21":
				if($move == 28)
				return 24;
				if($move == 30)
				return 25;
				if($move == 12)
				return 16;
				if($move == 14)
				return 17;
				break;
			case "22":
				if($move == 29)
				return 25;
				if($move == 31)
				return 26;
				if($move == 13)
				return 17;
				if($move == 15)
				return 18;
				break;
			case "23":
				if($move == 30)
				return 26;
				if($move == 14)
				return 18;
				break;			
			case "24":
				if($move == 17)
				return 21;
				break;	
			case "25":
				if($move == 16)
				return 21;
				if($move == 18)
				return 22;
				break;
			case "26":
				if($move == 17) 
				return 22;
				if($move == 19)
				return 23;
				break;	
			case "27":
				if($move == 18)
				return 23;
				break;	
			case "28":
				if($move == 21)
				return 24;
				break;	
			case "29":
				if($move == 20) 
				return 24;;
				if($move == 22)
				return 25;
				break;	
			case "30":
				if($move == 21) 
				return 25;
				if($move == 23)
				return 26;
				break;	
			case "31":
				if($move == 22)
				return 26;
				break;
			case "33":	
				if($move == 9)
				return 5;
				break;		
			default:
				return 0;
		}
	}
function king_second($lastmove, $red, $userid)
{
$var=array();
		switch($lastmove)
		{
			case "33":
				$var["d1"] = 9;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "1":
				$var["d1"] = 8;
				$var["d2"] = 10;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "2":
				$var["d1"] = 9;
				$var["d2"] = 11; 
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "3":
				$var["d1"] = 10;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "4":
				$var["d1"] = 13;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "5":
				$var["d1"] = 12;
				$var["d2"] = 14;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "6":
				$var["d1"] = 13;
				$var["d2"] = 15;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "7":
				$var["d1"] = 14;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "8":
				$var["d1"] = 17;
				$var["d2"] = 0;
				$var["d3"] = 1;
				$var["d4"] = 0; 
				break;
			case "9":
				$var["d1"] = 16;
				$var["d2"] = 18;
				$var["d3"] = 33;
				$var["d4"] = 2; 
				break;
			case "10":
				$var["d1"] = 17;
				$var["d2"] = 19;
				$var["d3"] = 1;
				$var["d4"] = 3;
				break;
			case "11":
				$var["d1"] = 18;
				$var["d2"] = 0;
				$var["d3"] = 2;
				$var["d4"] = 0; 
				break;
			case "12":
				$var["d1"] = 21;
				$var["d2"] = 0;
				$var["d3"] = 5;
				$var["d4"] = 0; 
				break;
			case "13":
				$var["d1"] = 20;
				$var["d2"] = 22;
				$var["d3"] = 4;
				$var["d4"] = 6;
				break;
			case "14":
				$var["d1"] = 21;
				$var["d2"] = 23;
				$var["d3"] = 5;
				$var["d4"] = 7; 
				break;
			case "15":
				$var["d1"] = 22;
				$var["d2"] = 0;
				$var["d3"] = 6;
				$var["d4"] = 0; 
				break;
			case "16":
				$var["d1"] = 25;
				$var["d2"] = 0;
				$var["d3"] = 9;
				$var["d4"] = 0; 
				break;
			case "17":
				$var["d1"] = 24;
				$var["d2"] = 26;
				$var["d3"] = 8;
				$var["d4"] = 10; 
				break;
			case "18":
				$var["d1"] = 25;
				$var["d2"] = 27;
				$var["d3"] = 9;
				$var["d4"] = 11; 
				break;
			case "19":
				$var["d1"] = 26;
				$var["d2"] = 0;
				$var["d3"] = 10;
				$var["d4"] = 0; 
				break;
			case "20":
				$var["d1"] = 29;
				$var["d2"] = 0;
				$var["d3"] = 13;
				$var["d4"] = 0; 
				break;
			case "21":
				$var["d1"] = 28;
				$var["d2"] = 30;
				$var["d3"] = 12;
				$var["d4"] = 14; 
				break;
			case "22":
				$var["d1"] = 29;
				$var["d2"] = 31;
				$var["d3"] = 13;
				$var["d4"] = 15;
				break;
			case "23":
				$var["d1"] = 30;
				$var["d2"] = 0;
				$var["d3"] = 14;
				$var["d4"] = 0; 
				break;
			case "24": //here
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 17;
				$var["d4"] = 0; 
				break;
			case "25":
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 16;
				$var["d4"] = 18; 
				break;
			case "26":
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 17;
				$var["d4"] = 19; 
				break;
			case "27":
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 18;
				$var["d4"] = 0; 
				break;
			case "28":
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 21;
				$var["d4"] = 0; 
				break;
			case "29":
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 20;
				$var["d4"] = 22; 
				break;
			case "30":
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 23;
				$var["d4"] = 21; 
				break;
			case "31":
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 22;
				$var["d4"] = 0; 
			default:
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0;
		}
	return $var;
}
function king_basic($move, $red, $userid)
{
$var=array();
		switch($move)
		{
			case "33":
				$var["d1"] = 4;
				$var["d2"] = 5;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "1":
				$var["d1"] = 5;
				$var["d2"] = 6;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "2":
				$var["d1"] = 6;
				$var["d2"] = 7; 
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "3":
				$var["d1"] = 7;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "4":
				$var["d1"] = 33;
				$var["d2"] = 8;
				$var["d3"] = 0;
				$var["d4"] = 0;
				break;
			case "5":
				$var["d1"] = 33;
				$var["d2"] = 1;
				$var["d3"] = 8;
				$var["d4"] = 9;
				break;
			case "6":
				$var["d1"] = 1;
				$var["d2"] = 2;
				$var["d3"] = 9;
				$var["d4"] = 10; 
				break;
			case "7":
				$var["d1"] = 2;
				$var["d2"] = 3;
				$var["d3"] = 10;
				$var["d4"] = 11;
				break;
			case "8":
				$var["d1"] = 4;
				$var["d2"] = 5;
				$var["d3"] = 12;
				$var["d4"] = 13; 
				break;
			case "9":
				$var["d1"] = 5;
				$var["d2"] = 6;
				$var["d3"] = 13;
				$var["d4"] = 14; 
				break;
			case "10":
				$var["d1"] = 6;
				$var["d2"] = 7;
				$var["d3"] = 14;
				$var["d4"] = 15;
				break;
			case "11":
				$var["d1"] = 7;
				$var["d2"] = 15;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "12":
				$var["d1"] = 8;
				$var["d2"] = 16;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "13":
				$var["d1"] = 8;
				$var["d2"] = 9;
				$var["d3"] = 16;
				$var["d4"] = 17;
				break;
			case "14":
				$var["d1"] = 9;
				$var["d2"] = 10;
				$var["d3"] = 17;
				$var["d4"] = 18; 
				break;
			case "15":
				$var["d1"] = 10;
				$var["d2"] = 11;
				$var["d3"] = 18;
				$var["d4"] = 19; 
				break;
			case "16":
				$var["d1"] = 12;
				$var["d2"] = 13;
				$var["d3"] = 20;
				$var["d4"] = 21; 
				break;
			case "17":
				$var["d1"] = 13;
				$var["d2"] = 14;
				$var["d3"] = 21;
				$var["d4"] = 22; 
				break;
			case "18":
				$var["d1"] = 14;
				$var["d2"] = 15;
				$var["d3"] = 22;
				$var["d4"] = 23; 
				break;
			case "19":
				$var["d1"] = 15;
				$var["d2"] = 13;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "20":
				$var["d1"] = 16;
				$var["d2"] = 24;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "21":
				$var["d1"] = 16;
				$var["d2"] = 17;
				$var["d3"] = 24;
				$var["d4"] = 25; 
				break;
			case "22":
				$var["d1"] = 17;
				$var["d2"] = 18;
				$var["d3"] = 25;
				$var["d4"] = 26;
				break;
			case "23":
				$var["d1"] = 18;
				$var["d2"] = 19;
				$var["d3"] = 26;
				$var["d4"] = 27; 
				break;
			case "24": 
				$var["d1"] = 20;
				$var["d2"] = 21;
				$var["d3"] = 28;
				$var["d4"] = 29; 
				break;
			case "25":
				$var["d1"] = 21;
				$var["d2"] = 22;
				$var["d3"] = 29;
				$var["d4"] = 30; 
				break;
			case "26":
				$var["d1"] = 22;
				$var["d2"] = 23;
				$var["d3"] = 30;
				$var["d4"] = 31; 
				break;
			case "27":
				$var["d1"] = 23;
				$var["d2"] = 31;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "28":
				$var["d1"] = 24;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "29":
				$var["d1"] = 24;
				$var["d2"] = 25;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "30":
				$var["d1"] = 25;
				$var["d2"] = 26;
				$var["d3"] = 0;
				$var["d4"] = 0; 
				break;
			case "31":
				$var["d1"] = 26;
				$var["d2"] = 27;
				$var["d3"] = 0;
				$var["d4"] = 0; 
			default:
				$var["d1"] = 0;
				$var["d2"] = 0;
				$var["d3"] = 0;
				$var["d4"] = 0;
		}
	return $var;
}
function all_basic($move, $red, $userid)
{
$var=array();
	if($userid == $red)
	{
			switch($move)
			{
				case "33":
					$var["d1"] = 4;
					$var["d2"] = 5;
					break;
				case "1":
					$var["d1"] = 5;
					$var["d2"] = 6; 
					break;
				case "2":
					$var["d1"] = 6;
					$var["d2"] = 7;
					break;
				case "3":
					$var["d1"] = 7;
					$var["d2"] = 0;
					break;
				case "4":
					$var["d1"] = 8;
					$var["d2"] = 0;
					break;
				case "5":
					$var["d1"] = 8;
					$var["d2"] = 9;
					break;
				case "6":
					$var["d1"] = 9;
					$var["d2"] = 10;
					break;
				case "7":
					$var["d1"] = 10;
					$var["d2"] = 11;
					break;
				case "8":
					$var["d1"] = 12;
					$var["d2"] = 13;
					break;
				case "9":
					$var["d1"] = 13;
					$var["d2"] = 14;
					break;
				case "10":
					$var["d1"] = 14;
					$var["d2"] = 15;
					break;
				case "11":
					$var["d1"] = 15;
					$var["d2"] = 0;
					break;
				case "12":
					$var["d1"] = 16;
					$var["d2"] = 0;
					break;
				case "13":
					$var["d1"] = 16;
					$var["d2"] = 17;
					break;
				case "14":
					$var["d1"] = 17;
					$var["d2"] = 18;
					break;
				case "15":
					$var["d1"] = 18;
					$var["d2"] = 19;
					break;
				case "16":
					$var["d1"] = 20;
					$var["d2"] = 21;
					break;
				case "17":
					$var["d1"] = 21;
					$var["d2"] = 22;
					break;
				case "18":
					$var["d1"] = 22;
					$var["d2"] = 23; 
					break;
				case "19":
					$var["d1"] = 23;
					$var["d2"] = 0;
					break;
				case "20":
					$var["d1"] = 24;
					$var["d2"] = 0;
					break;
				case "21":
					$var["d1"] = 24;
					$var["d2"] = 25;
					break;
				case "22":
					$var["d1"] = 25;
					$var["d2"] = 26;
					break;
				case "23":
					$var["d1"] = 26;
					$var["d2"] = 27; 
					break;
				case "24": 
					$var["d1"] = 28;
					$var["d2"] = 29;
					break;
				case "25":
					$var["d1"] = 29;
					$var["d2"] = 30;
					break;
				case "26":
					$var["d1"] = 30;
					$var["d2"] = 31;
					break;
				case "27":
					$var["d1"] = 31;
					$var["d2"] = 0;
					break;
				default:
					$var["d1"] = 0;
					$var["d2"] = 0;
			}
	}
	else{
		switch($move)
		{	
			case "4":
					$var["d1"] = 33;
					$var["d2"] = 0;
					break;
				case "5":
					$var["d1"] = 33;
					$var["d2"] = 1;
					break;
				case "6":
					$var["d1"] = 1;
					$var["d2"] = 2;
					break;
				case "7":
					$var["d1"] = 2;
					$var["d2"] = 3;
					break;
				case "8":
					$var["d1"] = 4;
					$var["d2"] = 5;
					break;
				case "9":
					$var["d1"] = 5;
					$var["d2"] = 6;
					break;
				case "10":
					$var["d1"] = 6;
					$var["d2"] = 7;
					break;
				case "11":
					$var["d1"] = 7;
					$var["d2"] = 0;
					break;
				case "12":
					$var["d1"] = 8;
					$var["d2"] = 0;
					break;
				case "13":
					$var["d1"] = 8;
					$var["d2"] = 9;
					break;
				case "14":
					$var["d1"] = 9;
					$var["d2"] = 10;
					break;
				case "15":
					$var["d1"] = 10;
					$var["d2"] = 11;
					break;
				case "16":
					$var["d1"] = 12;
					$var["d2"] = 13;
					break;
				case "17":
					$var["d1"] = 13;
					$var["d2"] = 14;
					break;
				case "18":
					$var["d1"] = 14;
					$var["d2"] = 15; 
					break;
				case "19":
					$var["d1"] = 15;
					$var["d2"] = 0;
					break;
				case "20":
					$var["d1"] = 16;
					$var["d2"] = 0;
					break;
				case "21":
					$var["d1"] = 16;
					$var["d2"] = 17;
					break;
				case "22":
					$var["d1"] = 17;
					$var["d2"] = 18;
					break;
				case "23":
					$var["d1"] = 18;
					$var["d2"] = 19; 
					break;
				case "24": 
					$var["d1"] = 20;
					$var["d2"] = 21;
					break;
				case "25":
					$var["d1"] = 21;
					$var["d2"] = 22;
					break;
				case "26":
					$var["d1"] = 22;
					$var["d2"] = 23;
					break;
				case "27":
					$var["d1"] = 23;
					$var["d2"] = 0;
					break;
				case "28":
					$var["d1"] = 24;
					$var["d2"] = 0;
					break;
				case "29":
					$var["d1"] = 24;
					$var["d2"] = 25;
					break;
				case "30":
					$var["d1"] = 25;
					$var["d2"] = 26;
					break;
				case "31":
					$var["d1"] = 26;
					$var["d2"] = 27;
				default:
					$var["d1"] = 0;
					$var["d2"] = 0;
		}
	}
	return $var;
}
function create_game($roomid)
{
	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT ck_room FROM ck_game WHERE ck_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM ck_room WHERE id=$roomid"));

		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		if($turn==1){$other=2;}else{$other=1;}
		$otheruid = p_to_uid($other, $roomid);
		$db->query("UPDATE ck_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO ck_game (ck_room, {$firstmovemarkfield}, p1, p2) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']})");
		board_setup($roomid,$turnuid,$otheruid);

	}
}

function board_setup($roomid,$p1,$p2)
{
	global $db;
	$db->query("UPDATE ck_game SET b33=$p1,b1=$p1,b2=$p1,b3=$p1,b4=$p1,b5=$p1,b6=$p1,b7=$p1,b8=$p1,b9=$p1,b10=$p1,b11=$p1 WHERE ck_room=$roomid");
	$db->query("UPDATE ck_game SET b20=$p2,b21=$p2,b22=$p2,b23=$p2,b24=$p2,b25=$p2,b26=$p2,b27=$p2,b28=$p2,b29=$p2,b30=$p2,b31=$p2 WHERE ck_room=$roomid");

}

function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM ck_room WHERE id = $roomid"));
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE ck_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE ck_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	$db->query("UPDATE ck_game SET pselect = 0,lastmove = 0 WHERE ck_room=$roomid");
}



?>