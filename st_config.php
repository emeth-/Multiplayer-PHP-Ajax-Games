<?php


$gpre = "st_";
$gpres = "st";
$gamename = "Strategy";

$teaser_image = "images/st/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "red";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "RED";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "BLUE";

$rules = "
<center><b>Rules</b><br /><br /></center>
<ul>
<li>Players set up their pieces on their side of the board. The goal is to capture your opponent's flag.</li>
<br /><li>On each turn, a player may move one of his pieces to an adjacent (horizontal or vertical) square that is empty or occupied by his opponent.</li>
<br /><li>If the square is occupied by his opponent, an attack is begun.</li>
<br /><li>For most pieces, the winner of an attack is the lower piece, except for a few special cases listed below.</li>
<br /><li>Bombs kill everything except for Miner's (6). Miner's defuse bombs (killing the bomb).</li>
<br /><li>Spies ONLY win when THEY attack the General (1) first. If the General attacks first, or anything else attacks them, they lose.</li>
<br /><li>Scouts (7) can move vertically or horizontally more than one space. They can continue moving in that straight line as long as it is clear.</li>
<br /><li>You cannot move over or onto the lakes in the center of the board.</li>
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