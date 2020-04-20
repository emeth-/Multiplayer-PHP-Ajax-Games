<?php


$gpre = "bg_";
$gpres = "bg";
$gamename = "Backgammon";

$teaser_image = "images/bg/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "black";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "Black";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "White";

$rules = "
<center><b>Rules</b><br /><br /></center>
<ul>
<li>At the beginning of the game, the board is set up. It is randomly chosen who goes first.</li>
<br /><li>Black plays in a clockwise pattern, white plays in counter-clockwise.</li>
<br /><li>To make a move on your turn, click a die, then click the piece you want to move.</li>
<br /><li>Pieces can move forward the number of 'dots' on a die. So if you roll a 5, you can move a piece 5 spaces forward (each triangle counts as a space).</li>
<br /><li>You can move pieces onto triangles you own (that have one or more of your pieces on them), empty triangles, or triangles with a single opponent piece on it.</li>
<br /><li>If you move your piece onto a triangle with a single opponents piece on it, you 'capture' that piece, and it is put on the bar in the middle.</li>
<br /><li>You move pieces out of the bar into the the furthest quadrant of the board. So white moves from the bar onto the board in the top right, and black moves from the bar onto the bottom left.</li>
<br /><li>If you have pieces on the bar, you must get them off the bar before you can move any other pieces.</li>
<br /><li>Once all your pieces are in your 'home' row (the 6 triangles in the top right for black, bottom left for white) you can begin bearing them off (moving them into your cache, the two containers at the far right of the board).</li>
<br /><li>First person to get all their pieces in their cache wins.</li>
<br /><li>For more detailed rules with pictures, <a href='http://www.bkgm.com/rules.html' target='_blank'>click here</a>.</li>
</ul>


";

//SQL
/*

ALTER TABLE  `users` ADD  `bg_room` INT( 11 ) NOT NULL;


CREATE TABLE IF NOT EXISTS `bg_chat` (
  `id` int(11) NOT NULL auto_increment,
  `bg_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `bg_game` (
  `black` int(11) NOT NULL,
  `bg_room` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `replay` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `dselected` int(1) NOT NULL,
  `d1` int(1) NOT NULL,
  `d2` int(1) NOT NULL,
  `d3` int(1) NOT NULL,
  `d4` int(1) NOT NULL,
  `b0` int(11) NOT NULL,
  `b1` int(11) NOT NULL default '2',
  `b2` int(11) NOT NULL,
  `b3` int(11) NOT NULL,
  `b4` int(11) NOT NULL,
  `b5` int(11) NOT NULL,
  `b6` int(11) NOT NULL,
  `b7` int(11) NOT NULL,
  `b8` int(11) NOT NULL,
  `b9` int(11) NOT NULL,
  `b10` int(11) NOT NULL,
  `b11` int(11) NOT NULL,
  `b12` int(11) NOT NULL default '5',
  `b13` int(11) NOT NULL,
  `b14` int(11) NOT NULL,
  `b15` int(11) NOT NULL,
  `b16` int(11) NOT NULL,
  `b17` int(11) NOT NULL default '3',
  `b18` int(11) NOT NULL,
  `b19` int(11) NOT NULL default '5',
  `b20` int(11) NOT NULL,
  `b21` int(11) NOT NULL,
  `b22` int(11) NOT NULL,
  `b23` int(11) NOT NULL,
  `b24` int(11) NOT NULL,
  `b25` int(11) NOT NULL,
  `a0` int(11) NOT NULL,
  `a1` int(11) NOT NULL,
  `a2` int(11) NOT NULL,
  `a3` int(11) NOT NULL,
  `a4` int(11) NOT NULL,
  `a5` int(11) NOT NULL,
  `a6` int(11) NOT NULL default '5',
  `a7` int(11) NOT NULL,
  `a8` int(11) NOT NULL default '3',
  `a9` int(11) NOT NULL,
  `a10` int(11) NOT NULL,
  `a11` int(11) NOT NULL,
  `a12` int(11) NOT NULL,
  `a13` int(11) NOT NULL default '5',
  `a14` int(11) NOT NULL,
  `a15` int(11) NOT NULL,
  `a16` int(11) NOT NULL,
  `a17` int(11) NOT NULL,
  `a18` int(11) NOT NULL,
  `a19` int(11) NOT NULL,
  `a20` int(11) NOT NULL,
  `a21` int(11) NOT NULL,
  `a22` int(11) NOT NULL,
  `a23` int(11) NOT NULL,
  `a24` int(11) NOT NULL default '2',
  `a25` int(11) NOT NULL,
  `abar` int(2) NOT NULL,
  `bbar` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `bg_ranks` (
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `bg_room` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `turn` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

*/
?>