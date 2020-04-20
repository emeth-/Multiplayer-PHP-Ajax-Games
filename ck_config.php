<?php


$gpre = "ck_";
$gpres = "ck";
$gamename = "Checkers";

$teaser_image = "images/ck/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "red";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "RED";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "WHITE";

$rules = "
<center><b>Rules</b><br /><br /></center>
<ul>
<li>At the beginning of the game, the board is set up. It is randomly chosen who goes first.</li>
<br /><li>Standard American Checkers (not International Draughts) rules apply.</li>
<br /><li>Checkers can only be on dark pieces on the board.</li>
<br /><li>Regular checkers can only move/jump in a forwards direction.</li>
<br /><li>Kings can moves/jump forwards or backwards.</li>
<br /><li>A regular checker turns into a king when it advances to the far opposite side of the board.</li>
<br /><li><b>Jumps are not mandatory.</b></li>
</ul>


";

//SQL
/*

ALTER TABLE  `users` ADD  `ck_room` INT( 11 ) NOT NULL;

CREATE TABLE IF NOT EXISTS `ck_chat` (
  `id` int(11) NOT NULL auto_increment,
  `ck_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `ck_game` (
  `red` int(11) NOT NULL,
  `ck_room` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `replay` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `pselect` int(11) NOT NULL default '-1',
  `lastmove` int(2) NOT NULL,
  `lastmove2` int(2) NOT NULL,
  `b33` int(11) NOT NULL,
  `b1` int(11) NOT NULL,
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
  `b12` int(11) NOT NULL,
  `b13` int(11) NOT NULL,
  `b14` int(11) NOT NULL,
  `b15` int(11) NOT NULL,
  `b16` int(11) NOT NULL,
  `b17` int(11) NOT NULL,
  `b18` int(11) NOT NULL,
  `b19` int(11) NOT NULL,
  `b20` int(11) NOT NULL,
  `b21` int(11) NOT NULL,
  `b22` int(11) NOT NULL,
  `b23` int(11) NOT NULL,
  `b24` int(11) NOT NULL,
  `b25` int(11) NOT NULL,
  `b26` int(11) NOT NULL,
  `b27` int(11) NOT NULL,
  `b28` int(11) NOT NULL,
  `b29` int(11) NOT NULL,
  `b30` int(11) NOT NULL,
  `b31` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ck_ranks` (
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ck_room` (
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