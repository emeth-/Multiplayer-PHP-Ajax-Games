<?php

function draw_board($roomid, $userid, $turn)
{
	global $db,$ir;

	$drawb = $db->query("SELECT * FROM ms_game WHERE ms_room=$roomid");

	if(!$db->num_rows($drawb)){die();}	//game not yet created

	$draw = $db->fetch_row($drawb);

if($draw['b11'] >= 0){$b11 = "<form method='post' name='m11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b11']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm11');return false;\" /></form>";}
else{$b11 = "<form method='post' name='m11'><input type=hidden name='move' value=11><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm11');return false;\" /></form>";}

if($draw['b12'] >= 0){$b12 = "<form method='post' name='m12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b12']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm12');return false;\" /></form>";}
else{$b12 = "<form method='post' name='m12'><input type=hidden name='move' value=12><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm12');return false;\" /></form>";}

if($draw['b13'] >= 0){$b13 = "<form method='post' name='m13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b13']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm13');return false;\" /></form>";}
else{$b13 = "<form method='post' name='m13'><input type=hidden name='move' value=13><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm13');return false;\" /></form>";}

if($draw['b14'] >= 0){$b14 = "<form method='post' name='m14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b14']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm14');return false;\" /></form>";}
else{$b14 = "<form method='post' name='m14'><input type=hidden name='move' value=14><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm14');return false;\" /></form>";}

if($draw['b15'] >= 0){$b15 = "<form method='post' name='m15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b15']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm15');return false;\" /></form>";}
else{$b15 = "<form method='post' name='m15'><input type=hidden name='move' value=15><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm15');return false;\" /></form>";}
	
if($draw['b16'] >= 0){$b16 = "<form method='post' name='m16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b16']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm16');return false;\" /></form>";}
else{$b16 = "<form method='post' name='m16'><input type=hidden name='move' value=16><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm16');return false;\" /></form>";}
	
if($draw['b17'] >= 0){$b17 = "<form method='post' name='m17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b17']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm17');return false;\" /></form>";}
else{$b17 = "<form method='post' name='m17'><input type=hidden name='move' value=17><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm17');return false;\" /></form>";}
	
if($draw['b18'] >= 0){$b18 = "<form method='post' name='m18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b18']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm18');return false;\" /></form>";}
else{$b18 = "<form method='post' name='m18'><input type=hidden name='move' value=18><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm18');return false;\" /></form>";}
	
if($draw['b19'] >= 0){$b19 = "<form method='post' name='m19'><input type=hidden name='move' value=19><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b19']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm19');return false;\" /></form>";}
else{$b19 = "<form method='post' name='m19'><input type=hidden name='move' value=19><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm19');return false;\" /></form>";}
	
if($draw['b21'] >= 0){$b21 = "<form method='post' name='m21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b21']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm21');return false;\" /></form>";}
else{$b21 = "<form method='post' name='m21'><input type=hidden name='move' value=21><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm21');return false;\" /></form>";}
	
if($draw['b22'] >= 0){$b22 = "<form method='post' name='m22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b22']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm22');return false;\" /></form>";}
else{$b22 = "<form method='post' name='m22'><input type=hidden name='move' value=22><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm22');return false;\" /></form>";}
	
if($draw['b23'] >= 0){$b23 = "<form method='post' name='m23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b23']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm23');return false;\" /></form>";}
else{$b23 = "<form method='post' name='m23'><input type=hidden name='move' value=23><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm23');return false;\" /></form>";}
	
if($draw['b24'] >= 0){$b24 = "<form method='post' name='m24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b24']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm24');return false;\" /></form>";}
else{$b24 = "<form method='post' name='m24'><input type=hidden name='move' value=24><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm24');return false;\" /></form>";}
	
if($draw['b25'] >= 0){$b25 = "<form method='post' name='m25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b25']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm25');return false;\" /></form>";}
else{$b25 = "<form method='post' name='m25'><input type=hidden name='move' value=25><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm25');return false;\" /></form>";}
	
if($draw['b26'] >= 0){$b26 = "<form method='post' name='m26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b26']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm26');return false;\" /></form>";}
else{$b26 = "<form method='post' name='m26'><input type=hidden name='move' value=26><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm26');return false;\" /></form>";}
	
if($draw['b27'] >= 0){$b27 = "<form method='post' name='m27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b27']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm27');return false;\" /></form>";}
else{$b27 = "<form method='post' name='m27'><input type=hidden name='move' value=27><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm27');return false;\" /></form>";}
	
if($draw['b28'] >= 0){$b28 = "<form method='post' name='m28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b28']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm28');return false;\" /></form>";}
else{$b28 = "<form method='post' name='m28'><input type=hidden name='move' value=28><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm28');return false;\" /></form>";}
	
if($draw['b29'] >= 0){$b29 = "<form method='post' name='m29'><input type=hidden name='move' value=29><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b29']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm29');return false;\" /></form>";}
else{$b29 = "<form method='post' name='m29'><input type=hidden name='move' value=29><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm29');return false;\" /></form>";}

if($draw['b31'] >= 0){$b31 = "<form method='post' name='m31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b31']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm31');return false;\" /></form>";}
else{$b31 = "<form method='post' name='m31'><input type=hidden name='move' value=31><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm31');return false;\" /></form>";}

if($draw['b32'] >= 0){$b32 = "<form method='post' name='m32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b32']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm32');return false;\" /></form>";}
else{$b32 = "<form method='post' name='m32'><input type=hidden name='move' value=32><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm32');return false;\" /></form>";}

if($draw['b33'] >= 0){$b33 = "<form method='post' name='m33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b33']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm33');return false;\" /></form>";}
else{$b33 = "<form method='post' name='m33'><input type=hidden name='move' value=33><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm33');return false;\" /></form>";}

if($draw['b34'] >= 0){$b34 = "<form method='post' name='m34'><input type=hidden name='move' value=34><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b34']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm34');return false;\" /></form>";}
else{$b34 = "<form method='post' name='m34'><input type=hidden name='move' value=34><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm34');return false;\" /></form>";}

if($draw['b35'] >= 0){$b35 = "<form method='post' name='m35'><input type=hidden name='move' value=35><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b35']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm35');return false;\" /></form>";}
else{$b35 = "<form method='post' name='m35'><input type=hidden name='move' value=35><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm35');return false;\" /></form>";}
	
if($draw['b36'] >= 0){$b36 = "<form method='post' name='m36'><input type=hidden name='move' value=36><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b36']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm36');return false;\" /></form>";}
else{$b36 = "<form method='post' name='m36'><input type=hidden name='move' value=36><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm36');return false;\" /></form>";}
	
if($draw['b37'] >= 0){$b37 = "<form method='post' name='m37'><input type=hidden name='move' value=37><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b37']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm37');return false;\" /></form>";}
else{$b37 = "<form method='post' name='m37'><input type=hidden name='move' value=37><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm37');return false;\" /></form>";}
	
if($draw['b38'] >= 0){$b38 = "<form method='post' name='m38'><input type=hidden name='move' value=38><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b38']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm38');return false;\" /></form>";}
else{$b38 = "<form method='post' name='m38'><input type=hidden name='move' value=38><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm38');return false;\" /></form>";}
	
if($draw['b39'] >= 0){$b39 = "<form method='post' name='m39'><input type=hidden name='move' value=39><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b39']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm39');return false;\" /></form>";}
else{$b39 = "<form method='post' name='m39'><input type=hidden name='move' value=39><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm39');return false;\" /></form>";}
	
if($draw['b41'] >= 0){$b41 = "<form method='post' name='m41'><input type=hidden name='move' value=41><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b41']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm41');return false;\" /></form>";}
else{$b41 = "<form method='post' name='m41'><input type=hidden name='move' value=41><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm41');return false;\" /></form>";}

if($draw['b42'] >= 0){$b42 = "<form method='post' name='m42'><input type=hidden name='move' value=42><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b42']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm42');return false;\" /></form>";}
else{$b42 = "<form method='post' name='m42'><input type=hidden name='move' value=42><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm42');return false;\" /></form>";}

if($draw['b43'] >= 0){$b43 = "<form method='post' name='m43'><input type=hidden name='move' value=43><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b43']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm43');return false;\" /></form>";}
else{$b43 = "<form method='post' name='m43'><input type=hidden name='move' value=43><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm43');return false;\" /></form>";}

if($draw['b44'] >= 0){$b44 = "<form method='post' name='m44'><input type=hidden name='move' value=44><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b44']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm44');return false;\" /></form>";}
else{$b44 = "<form method='post' name='m44'><input type=hidden name='move' value=44><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm44');return false;\" /></form>";}

if($draw['b45'] >= 0){$b45 = "<form method='post' name='m45'><input type=hidden name='move' value=45><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b45']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm45');return false;\" /></form>";}
else{$b45 = "<form method='post' name='m45'><input type=hidden name='move' value=45><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm45');return false;\" /></form>";}
	
if($draw['b46'] >= 0){$b46 = "<form method='post' name='m46'><input type=hidden name='move' value=46><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b46']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm46');return false;\" /></form>";}
else{$b46 = "<form method='post' name='m46'><input type=hidden name='move' value=46><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm46');return false;\" /></form>";}
	
if($draw['b47'] >= 0){$b47 = "<form method='post' name='m47'><input type=hidden name='move' value=47><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b47']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm47');return false;\" /></form>";}
else{$b47 = "<form method='post' name='m47'><input type=hidden name='move' value=47><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm47');return false;\" /></form>";}
	
if($draw['b48'] >= 0){$b48 = "<form method='post' name='m48'><input type=hidden name='move' value=48><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b48']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm48');return false;\" /></form>";}
else{$b48 = "<form method='post' name='m48'><input type=hidden name='move' value=48><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm48');return false;\" /></form>";}
	
if($draw['b49'] >= 0){$b49 = "<form method='post' name='m49'><input type=hidden name='move' value=49><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b49']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm49');return false;\" /></form>";}
else{$b49 = "<form method='post' name='m49'><input type=hidden name='move' value=49><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm49');return false;\" /></form>";}

if($draw['b51'] >= 0){$b51 = "<form method='post' name='m51'><input type=hidden name='move' value=51><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b51']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm51');return false;\" /></form>";}
else{$b51 = "<form method='post' name='m51'><input type=hidden name='move' value=51><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm51');return false;\" /></form>";}

if($draw['b52'] >= 0){$b52 = "<form method='post' name='m52'><input type=hidden name='move' value=52><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b52']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm52');return false;\" /></form>";}
else{$b52 = "<form method='post' name='m52'><input type=hidden name='move' value=52><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm52');return false;\" /></form>";}

if($draw['b53'] >= 0){$b53 = "<form method='post' name='m53'><input type=hidden name='move' value=53><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b53']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm53');return false;\" /></form>";}
else{$b53 = "<form method='post' name='m53'><input type=hidden name='move' value=53><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm53');return false;\" /></form>";}

if($draw['b54'] >= 0){$b54 = "<form method='post' name='m54'><input type=hidden name='move' value=54><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b54']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm54');return false;\" /></form>";}
else{$b54 = "<form method='post' name='m54'><input type=hidden name='move' value=54><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm54');return false;\" /></form>";}

if($draw['b55'] >= 0){$b55 = "<form method='post' name='m55'><input type=hidden name='move' value=55><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b55']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm55');return false;\" /></form>";}
else{$b55 = "<form method='post' name='m55'><input type=hidden name='move' value=55><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm55');return false;\" /></form>";}
	
if($draw['b56'] >= 0){$b56 = "<form method='post' name='m56'><input type=hidden name='move' value=56><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b56']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm56');return false;\" /></form>";}
else{$b56 = "<form method='post' name='m56'><input type=hidden name='move' value=56><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm56');return false;\" /></form>";}
	
if($draw['b57'] >= 0){$b57 = "<form method='post' name='m57'><input type=hidden name='move' value=57><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b57']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm57');return false;\" /></form>";}
else{$b57 = "<form method='post' name='m57'><input type=hidden name='move' value=57><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm57');return false;\" /></form>";}
	
if($draw['b58'] >= 0){$b58 = "<form method='post' name='m58'><input type=hidden name='move' value=58><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b58']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm58');return false;\" /></form>";}
else{$b58 = "<form method='post' name='m58'><input type=hidden name='move' value=58><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm58');return false;\" /></form>";}
	
if($draw['b59'] >= 0){$b59 = "<form method='post' name='m59'><input type=hidden name='move' value=59><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b59']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm59');return false;\" /></form>";}
else{$b59 = "<form method='post' name='m59'><input type=hidden name='move' value=59><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm59');return false;\" /></form>";}

if($draw['b61'] >= 0){$b61 = "<form method='post' name='m61'><input type=hidden name='move' value=61><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b61']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm61');return false;\" /></form>";}
else{$b61 = "<form method='post' name='m61'><input type=hidden name='move' value=61><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm61');return false;\" /></form>";}

if($draw['b62'] >= 0){$b62 = "<form method='post' name='m62'><input type=hidden name='move' value=62><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b62']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm62');return false;\" /></form>";}
else{$b62 = "<form method='post' name='m62'><input type=hidden name='move' value=62><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm62');return false;\" /></form>";}

if($draw['b63'] >= 0){$b63 = "<form method='post' name='m63'><input type=hidden name='move' value=63><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b63']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm63');return false;\" /></form>";}
else{$b63 = "<form method='post' name='m63'><input type=hidden name='move' value=63><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm63');return false;\" /></form>";}

if($draw['b64'] >= 0){$b64 = "<form method='post' name='m64'><input type=hidden name='move' value=64><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b64']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm64');return false;\" /></form>";}
else{$b64 = "<form method='post' name='m64'><input type=hidden name='move' value=64><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm64');return false;\" /></form>";}

if($draw['b65'] >= 0){$b65 = "<form method='post' name='m65'><input type=hidden name='move' value=65><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b65']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm65');return false;\" /></form>";}
else{$b65 = "<form method='post' name='m65'><input type=hidden name='move' value=65><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm65');return false;\" /></form>";}
	
if($draw['b66'] >= 0){$b66 = "<form method='post' name='m66'><input type=hidden name='move' value=66><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b66']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm66');return false;\" /></form>";}
else{$b66 = "<form method='post' name='m66'><input type=hidden name='move' value=66><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm66');return false;\" /></form>";}
	
if($draw['b67'] >= 0){$b67 = "<form method='post' name='m67'><input type=hidden name='move' value=67><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b67']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm67');return false;\" /></form>";}
else{$b67 = "<form method='post' name='m67'><input type=hidden name='move' value=67><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm67');return false;\" /></form>";}
	
if($draw['b68'] >= 0){$b68 = "<form method='post' name='m68'><input type=hidden name='move' value=68><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b68']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm68');return false;\" /></form>";}
else{$b68 = "<form method='post' name='m68'><input type=hidden name='move' value=68><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm68');return false;\" /></form>";}
	
if($draw['b69'] >= 0){$b69 = "<form method='post' name='m69'><input type=hidden name='move' value=69><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b69']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm69');return false;\" /></form>";}
else{$b69 = "<form method='post' name='m69'><input type=hidden name='move' value=69><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm69');return false;\" /></form>";}

if($draw['b71'] >= 0){$b71 = "<form method='post' name='m71'><input type=hidden name='move' value=71><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b71']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm71');return false;\" /></form>";}
else{$b71 = "<form method='post' name='m71'><input type=hidden name='move' value=71><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm71');return false;\" /></form>";}

if($draw['b72'] >= 0){$b72 = "<form method='post' name='m72'><input type=hidden name='move' value=72><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b72']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm72');return false;\" /></form>";}
else{$b72 = "<form method='post' name='m72'><input type=hidden name='move' value=72><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm72');return false;\" /></form>";}

if($draw['b73'] >= 0){$b73 = "<form method='post' name='m73'><input type=hidden name='move' value=73><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b73']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm73');return false;\" /></form>";}
else{$b73 = "<form method='post' name='m73'><input type=hidden name='move' value=73><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm73');return false;\" /></form>";}

if($draw['b74'] >= 0){$b74 = "<form method='post' name='m74'><input type=hidden name='move' value=74><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b74']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm74');return false;\" /></form>";}
else{$b74 = "<form method='post' name='m74'><input type=hidden name='move' value=74><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm74');return false;\" /></form>";}

if($draw['b75'] >= 0){$b75 = "<form method='post' name='m75'><input type=hidden name='move' value=75><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b75']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm75');return false;\" /></form>";}
else{$b75 = "<form method='post' name='m75'><input type=hidden name='move' value=75><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm75');return false;\" /></form>";}
	
if($draw['b76'] >= 0){$b76 = "<form method='post' name='m76'><input type=hidden name='move' value=76><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b76']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm76');return false;\" /></form>";}
else{$b76 = "<form method='post' name='m76'><input type=hidden name='move' value=76><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm76');return false;\" /></form>";}
	
if($draw['b77'] >= 0){$b77 = "<form method='post' name='m77'><input type=hidden name='move' value=77><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b77']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm77');return false;\" /></form>";}
else{$b77 = "<form method='post' name='m77'><input type=hidden name='move' value=77><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm77');return false;\" /></form>";}
	
if($draw['b78'] >= 0){$b78 = "<form method='post' name='m78'><input type=hidden name='move' value=78><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b78']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm78');return false;\" /></form>";}
else{$b78 = "<form method='post' name='m78'><input type=hidden name='move' value=78><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm78');return false;\" /></form>";}
	
if($draw['b79'] >= 0){$b79 = "<form method='post' name='m79'><input type=hidden name='move' value=79><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b79']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm79');return false;\" /></form>";}
else{$b79 = "<form method='post' name='m79'><input type=hidden name='move' value=79><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm79');return false;\" /></form>";}

if($draw['b81'] >= 0){$b81 = "<form method='post' name='m81'><input type=hidden name='move' value=81><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b81']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm81');return false;\" /></form>";}
else{$b81 = "<form method='post' name='m81'><input type=hidden name='move' value=81><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm81');return false;\" /></form>";}

if($draw['b82'] >= 0){$b82 = "<form method='post' name='m82'><input type=hidden name='move' value=82><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b82']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm82');return false;\" /></form>";}
else{$b82 = "<form method='post' name='m82'><input type=hidden name='move' value=82><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm82');return false;\" /></form>";}

if($draw['b83'] >= 0){$b83 = "<form method='post' name='m83'><input type=hidden name='move' value=83><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b83']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm83');return false;\" /></form>";}
else{$b83 = "<form method='post' name='m83'><input type=hidden name='move' value=83><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm83');return false;\" /></form>";}

if($draw['b84'] >= 0){$b84 = "<form method='post' name='m84'><input type=hidden name='move' value=84><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b84']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm84');return false;\" /></form>";}
else{$b84 = "<form method='post' name='m84'><input type=hidden name='move' value=84><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm84');return false;\" /></form>";}

if($draw['b85'] >= 0){$b85 = "<form method='post' name='m85'><input type=hidden name='move' value=85><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b85']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm85');return false;\" /></form>";}
else{$b85 = "<form method='post' name='m85'><input type=hidden name='move' value=85><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm85');return false;\" /></form>";}
	
if($draw['b86'] >= 0){$b86 = "<form method='post' name='m86'><input type=hidden name='move' value=86><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b86']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm86');return false;\" /></form>";}
else{$b86 = "<form method='post' name='m86'><input type=hidden name='move' value=86><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm86');return false;\" /></form>";}
	
if($draw['b87'] >= 0){$b87 = "<form method='post' name='m87'><input type=hidden name='move' value=87><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b87']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm87');return false;\" /></form>";}
else{$b87 = "<form method='post' name='m87'><input type=hidden name='move' value=87><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm87');return false;\" /></form>";}
	
if($draw['b88'] >= 0){$b88 = "<form method='post' name='m88'><input type=hidden name='move' value=88><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b88']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm88');return false;\" /></form>";}
else{$b88 = "<form method='post' name='m88'><input type=hidden name='move' value=88><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm88');return false;\" /></form>";}
	
if($draw['b89'] >= 0){$b89 = "<form method='post' name='m89'><input type=hidden name='move' value=89><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b89']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm89');return false;\" /></form>";}
else{$b89 = "<form method='post' name='m89'><input type=hidden name='move' value=89><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm89');return false;\" /></form>";}

if($draw['b91'] >= 0){$b91 = "<form method='post' name='m91'><input type=hidden name='move' value=91><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b91']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm91');return false;\" /></form>";}
else{$b91 = "<form method='post' name='m91'><input type=hidden name='move' value=91><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm91');return false;\" /></form>";}

if($draw['b92'] >= 0){$b92 = "<form method='post' name='m92'><input type=hidden name='move' value=92><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b92']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm92');return false;\" /></form>";}
else{$b92 = "<form method='post' name='m92'><input type=hidden name='move' value=92><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm92');return false;\" /></form>";}

if($draw['b93'] >= 0){$b93 = "<form method='post' name='m93'><input type=hidden name='move' value=93><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b93']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm93');return false;\" /></form>";}
else{$b93 = "<form method='post' name='m93'><input type=hidden name='move' value=93><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm93');return false;\" /></form>";}

if($draw['b94'] >= 0){$b94 = "<form method='post' name='m94'><input type=hidden name='move' value=94><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b94']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm94');return false;\" /></form>";}
else{$b94 = "<form method='post' name='m94'><input type=hidden name='move' value=94><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm94');return false;\" /></form>";}

if($draw['b95'] >= 0){$b95 = "<form method='post' name='m95'><input type=hidden name='move' value=95><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b95']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm95');return false;\" /></form>";}
else{$b95 = "<form method='post' name='m95'><input type=hidden name='move' value=95><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm95');return false;\" /></form>";}
	
if($draw['b96'] >= 0){$b96 = "<form method='post' name='m96'><input type=hidden name='move' value=96><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b96']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm96');return false;\" /></form>";}
else{$b96 = "<form method='post' name='m96'><input type=hidden name='move' value=96><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm96');return false;\" /></form>";}
	
if($draw['b97'] >= 0){$b97 = "<form method='post' name='m97'><input type=hidden name='move' value=97><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b97']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm97');return false;\" /></form>";}
else{$b97 = "<form method='post' name='m97'><input type=hidden name='move' value=97><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm97');return false;\" /></form>";}
	
if($draw['b98'] >= 0){$b98 = "<form method='post' name='m98'><input type=hidden name='move' value=98><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b98']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm98');return false;\" /></form>";}
else{$b98 = "<form method='post' name='m98'><input type=hidden name='move' value=98><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm98');return false;\" /></form>";}
	
if($draw['b99'] >= 0){$b99 = "<form method='post' name='m99'><input type=hidden name='move' value=99><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/{$draw['b99']}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm99');return false;\" /></form>";}
else{$b99 = "<form method='post' name='m99'><input type=hidden name='move' value=99><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/blank.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm99');return false;\" /></form>";}
	

if($draw['mselected'] == 1){$g1 = "<form method='post' name='g1'><input type=hidden name='gtype' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/sguess.jpg\" border=0 name='guesstype' id='guesstype' value='Click' onclick=\"postFormAjax('ms_play.php', 'g1');return false;\" /></form>";}
else{$g1 = "<form method='post' name='g1'><input type=hidden name='gtype' value=1><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/guess.jpg\" border=0 name='guesstype' id='guesstype' value='Click' onclick=\"postFormAjax('ms_play.php', 'g1');return false;\" /></form>";}

if($draw['mselected'] == 2){$g2 = "<form method='post' name='g2'><input type=hidden name='gtype' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/smine.jpg\" border=0 name='guesstype' id='guesstype' value='Click' onclick=\"postFormAjax('ms_play.php', 'g2');return false;\" /></form>";}
else{$g2 = "<form method='post' name='g2'><input type=hidden name='gtype' value=2><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/mine.jpg\" border=0 name='guesstype' id='guesstype' value='Click' onclick=\"postFormAjax('ms_play.php', 'g2');return false;\" /></form>";}

$p1c = $draw['pointsp1'];
$p2c = $draw['pointsp2'];

$p1 = $draw['p1'];
$p2 = $draw['p2'];

$p1name = $db->query("SELECT username FROM users WHERE userid=$p1");
$p2name = $db->query("SELECT username FROM users WHERE userid=$p2");
	
$p1n = $db->fetch_row($p1name);
$p2n = $db->fetch_row($p2name);
$minesleft =0;


$temp="b".$draw['lastmove'];

$temp2 = $draw[$temp]; // value in the spot
$temp3 =	$draw['lastmove']; //spot on board
$$temp = "<form method='post' name='m{$temp3}'><input type=hidden name='move' value=$temp3><input type=hidden name='id' value='{$roomid}'><input type='image' class='sbmult' src=\"images/ms/l{$temp2}.png\" border=0 name='movebutton' id='movebutton' value='Click' onclick=\"postFormAjax('ms_play.php', 'm{$temp3}');return false;\" /></form>";



for($i=11; $i <=99; $i++)
	{
			if($draw["b".$i] == -42){$minesleft = $minesleft +1;}
	}

	$txt="<center><table BORDER='0' cellspacing = '0' cellpadding='0' bgcolor=#FFFFFF>";
	$txt.="<tr><td>$g1</td><td>$g2</td></tr>";
	$txt.="</table>";
	$txt.="<br /><b>{$draw['gametxt']}</b>";
	$txt.="</center><br/>";
	$txt.="<center><table BORDER='0' cellspacing = '0' cellpadding='0' height = '450' width='450' style=\"background: url('images/ms/board.jpg') no-repeat;\">";
	$txt.="<tr><td>$b11</td><td>$b12</td><td>$b13</td><td>$b14</td><td>$b15</td><td>$b16</td><td>$b17</td><td>$b18</td><td>$b19</td></tr>";
	$txt.="<tr><td>$b21</td><td>$b22</td><td>$b23</td><td>$b24</td><td>$b25</td><td>$b26</td><td>$b27</td><td>$b28</td><td>$b29</td></tr>";
	$txt.="<tr><td>$b31</td><td>$b32</td><td>$b33</td><td>$b34</td><td>$b35</td><td>$b36</td><td>$b37</td><td>$b38</td><td>$b39</td></tr>";
	$txt.="<tr><td>$b41</td><td>$b42</td><td>$b43</td><td>$b44</td><td>$b45</td><td>$b46</td><td>$b47</td><td>$b48</td><td>$b49</td></tr>";
	$txt.="<tr><td>$b51</td><td>$b52</td><td>$b53</td><td>$b54</td><td>$b55</td><td>$b56</td><td>$b57</td><td>$b58</td><td>$b59</td></tr>";
	$txt.="<tr><td>$b61</td><td>$b62</td><td>$b63</td><td>$b64</td><td>$b65</td><td>$b66</td><td>$b67</td><td>$b68</td><td>$b69</td></tr>";
	$txt.="<tr><td>$b71</td><td>$b72</td><td>$b73</td><td>$b74</td><td>$b75</td><td>$b76</td><td>$b77</td><td>$b78</td><td>$b79</td></tr>";
	$txt.="<tr><td>$b81</td><td>$b82</td><td>$b83</td><td>$b84</td><td>$b85</td><td>$b86</td><td>$b87</td><td>$b88</td><td>$b89</td></tr>";
	$txt.="<tr><td>$b91</td><td>$b92</td><td>$b93</td><td>$b94</td><td>$b95</td><td>$b96</td><td>$b97</td><td>$b98</td><td>$b99</td></tr>";
	$txt.="</table></center>";
	
	$txt.="<center><br /><b>{$p1n['username']}: {$p1c} | {$p2n['username']}: {$p2c}</b></center>";
	$txt.="<center><br /><b>Mines left: {$minesleft}</b></center>";

	print $txt;
}

function make_move($move, $userid, $roomid)
{
	global $db,$ir;
	$game = $db->query("SELECT * FROM ms_room WHERE id=$roomid", $c) or die("1");
	$ga=$db->fetch_row($game);

	$ginfo = $db->query("SELECT * FROM ms_game WHERE ms_room=$roomid");
	$gin = $db->fetch_row($ginfo);

	$db->query("UPDATE ms_game SET gametxt='' WHERE ms_room=$roomid");

	$turn = $ga['turn'];
	$gtype = $gin['mselected'];

	if($turn==$userid)
	{
		if($gtype == 1)
		{
			//guess a square, reveal if either bomb or how many are around
				$temp = "b".$move;
			if($gin["b".$move] < 0)
			{
				if(abs($gin["b".$move]) == 42)
				{
					if($userid == $gin['p1'])
					{
						$db->query("UPDATE ms_game SET pointsp1 = pointsp1 - 5, $temp = 42,lastmove = $move WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
					else
					{
						$db->query("UPDATE ms_game SET pointsp2 = pointsp2 - 5, $temp = 42,lastmove = $move WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
					$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$userid"));
					$gtxt = "<font color=red>{$uname['username']} hit a bomb! -5 points</font>";
					$db->query("UPDATE ms_game SET gametxt = '$gtxt' WHERE ms_room=$roomid");

				}
				else
				{
					if($userid == $gin['p1'])
					{
						mine_count($roomid, $move);
						$db->query("UPDATE ms_game SET lastmove = $move WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
					else
					{
						mine_count($roomid, $move);
						$db->query("UPDATE ms_game SET lastmove = $move WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
				}
			}
		}
		else if($gtype == 2)
		{
			$temp = "b".$move;
			if($gin["b".$move] < 0){
			//guessing a bomb check to see if it is a bomb and reveal square
				if(abs($gin["b".$move]) == 42) //if the spot is a bomb award points
				{
					if($userid == $gin['p1'])
					{
						$db->query("UPDATE ms_game SET pointsp1 = pointsp1 + 5, $temp = 42,lastmove = $move WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
					else
					{
						$db->query("UPDATE ms_game SET pointsp2 = pointsp2 + 5, $temp = 42,lastmove = $move  WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
					$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$userid"));
					$gtxt = "<font color=green>{$uname['username']} correctly identified a bomb! +5 points</font>";
					$db->query("UPDATE ms_game SET gametxt = '$gtxt' WHERE ms_room=$roomid");

				}
				else // if the spot isn't a bomb subtract points and reveal square
				{
					//need to check how many bombs are around the spot and reveal that number
					if($userid == $gin['p1'])
					{
						mine_count($roomid, $move);
						$db->query("UPDATE ms_game SET pointsp1 = pointsp1 -2,lastmove = $move WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
					else
					{
						mine_count($roomid, $move);
						$db->query("UPDATE ms_game SET pointsp2 = pointsp2 - 2,lastmove = $move  WHERE ms_room=$roomid");
						toggle_turn($roomid);
					}
					$uname = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$userid"));
					$gtxt = "<font color=red>{$uname['username']} incorrectly identified bomb! -2 points</font>";
					$db->query("UPDATE ms_game SET gametxt = '$gtxt' WHERE ms_room=$roomid");

				}
			}
		}
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
	$nominesleft = 1;
	$ginf = $db->query("SELECT * FROM ms_game WHERE ms_room = $roomid");
	$gin = $db->fetch_row($ginf);
	$gameover = 1;
	for($i=11; $i <=99; $i++)
	{
			if($gin["b".$i] < 0){$gameover = 0;}
	}
	for($i=11; $i <=99; $i++)
	{
		
		if($gin["b".$i] == -42){$nominesleft = 0;}
	}

	if($gameover ==1 || $nominesleft == 1)
	{
		if($gin['pointsp1'] > $gin['pointsp2'])
		{
			$winner = $gin['p1'];
		}
		else if($gin['pointsp1'] < $gin['pointsp2'])
		{
			$winner = $gin['p2'];
		}
		else
		{
			$winner = -1;
		}
	}
	//Return the winner's userid
	return $winner;
}

function create_game($roomid)
{

	global $db,$ir, $firstmovemarkfield;
	$alreadymade = $db->num_rows($db->query("SELECT ms_room FROM ms_game WHERE ms_room = $roomid"));
	if(!$alreadymade)
	{
		$roominfo = $db->fetch_row($db->query("SELECT * FROM ms_room WHERE id=$roomid"));

		$turn = rand(1,2);
		$turnuid = p_to_uid($turn, $roomid);
		if($turn==1){$other=2;}else{$other=1;}
		$otheruid = p_to_uid($other, $roomid);
		$db->query("UPDATE ms_room SET turn=$turnuid,play_time=0 WHERE id=$roomid");
		$db->query("INSERT INTO ms_game (ms_room, {$firstmovemarkfield}, p1, p2, mselected) VALUES ($roomid, $turnuid, {$roominfo['p1']}, {$roominfo['p2']}, 1)");

	}
	create_mines($roomid);

}

function board_setup($roomid,$p1,$p2)
{
	global $db;
}
function toggle_turn($roomid)
{
	global $db,$ir;
	$ui=$db->fetch_row($db->query("SELECT p1,p2,turn FROM ms_room WHERE id = $roomid"));
	$db->query("UPDATE ms_game SET mselected=1 WHERE ms_room=$roomid");
	if($ui['turn']==$ui['p1'])
	{
		$db->query("UPDATE ms_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p2']} WHERE id=$roomid");
	}
	else
	{
		$db->query("UPDATE ms_room SET notifyturn=0,play_time=unix_timestamp(),turn={$ui['p1']} WHERE id=$roomid");
	}
	$winner = check_win($roomid);
	if($winner != 0)
	{
		award_win($roomid,$winner);
	}
}
function create_mines($roomid)
{
	global $db,$ir;

	$mines = $db->query("SELECT * FROM ms_game WHERE ms_room=$roomid");
	$mine = $db->fetch_row($mines);
	$counter = 0;
	
	while(true)
		{
			$placemine = rand(11,99);
			if($placemine != 20 && $placemine != 30 && $placemine != 40 && $placemine != 50 && $placemine != 60 && $placemine != 70 && $placemine != 80 && $placemine != 90)
			{
				$temp = $mine["b".$placemine];
				$temp2 = "b".$placemine;
				if($temp != -42)
				{	
					$db->query("UPDATE ms_game SET $temp2 = -42 WHERE ms_room=$roomid");
					$counter = $counter +1;
					$mine["b".$placemine] = -42;
				}
				if($counter == 11) {break;}
			}
		}
}
function guess_type($gtype, $userid, $roomid)
{	

	global $db,$ir;
	$guess = $db->query("SELECT * FROM ms_room WHERE id=$roomid", $c) or die("1");
	$gt=$db->fetch_row($guess);
	$turn = $gt['turn'];
	if($turn==$userid)
	{
	$db->query("UPDATE ms_game SET mselected = $gtype WHERE ms_room=$roomid");
	}

}
function mine_count($roomid, $move){
	global $db,$ir;
	$mcb = $db->query("SELECT * FROM ms_game WHERE ms_room=$roomid");
	$mc = $db->fetch_row($mcb);
	$temp = "b".$move;
	$temp1 = $move - 11;
	$temp2 = $move - 10;
	$temp3 = $move - 9;
	$temp4 = $move - 1;
	$temp5 = $move + 1;
	$temp6 = $move + 9;
	$temp7 = $move + 10;
	$temp8 = $move + 11;
	$count = 0;
	
	$a1 = $mc["b".$temp1];
	$a2 = $mc["b".$temp2];
	$a3 = $mc["b".$temp3];
	$a4 = $mc["b".$temp4];
	$a5 = $mc["b".$temp5];
	$a6 = $mc["b".$temp6];
	$a7 = $mc["b".$temp7];
	$a8 = $mc["b".$temp8];


	if(abs($a1) == 42){$count = $count + 1;}
	if(abs($a2) == 42){$count = $count + 1;}
	if(abs($a3) == 42){$count = $count + 1;}
	if(abs($a4) == 42){$count = $count + 1;}
	if(abs($a5) == 42){$count = $count + 1;}
	if(abs($a6) == 42){$count = $count + 1;}
	if(abs($a7) == 42){$count = $count + 1;}
	if(abs($a8) == 42){$count = $count + 1;}
	
	$db->query("UPDATE ms_game SET $temp = $count WHERE ms_room=$roomid");
}
?>