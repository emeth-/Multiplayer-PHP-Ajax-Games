<?php


$gpre = "cf_";
$gpres = "cf";
$gamename = "Connect Four";

$teaser_image = "images/cf/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "red";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "RED";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "BLUE";

$rules = "
<center><b>Rules</b><br /><br /></center>
<ul>
<li>At the beginning of the game, the board is set up. It is randomly chosen who goes first.</li>
<br /><li>Players take turns choosing a column to place a piece in.</li>
<br /><li>When you put a piece in a column, it falls down the column into the lowest occupied spot.</li>
<br /><li>Players win by getting four in a row horizontally, vertically, or diagonally.</li>
</ul>


";

//SQL
/*

ALTER TABLE  `users` ADD  `cf_room` INT( 11 ) NOT NULL;



CREATE TABLE IF NOT EXISTS `cf_chat` (
  `id` int(11) NOT NULL auto_increment,
  `cf_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `cf_game` (
  `red` int(11) NOT NULL,
  `cf_room` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `replay` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `b11` int(11) NOT NULL,
  `b12` int(11) NOT NULL,
  `b13` int(11) NOT NULL,
  `b14` int(11) NOT NULL,
  `b15` int(11) NOT NULL,
  `b16` int(11) NOT NULL,
  `b17` int(11) NOT NULL,
  `b21` int(11) NOT NULL,
  `b22` int(11) NOT NULL,
  `b23` int(11) NOT NULL,
  `b24` int(11) NOT NULL,
  `b25` int(11) NOT NULL,
  `b26` int(11) NOT NULL,
  `b27` int(11) NOT NULL,
  `b31` int(11) NOT NULL,
  `b32` int(11) NOT NULL,
  `b33` int(11) NOT NULL,
  `b34` int(11) NOT NULL,
  `b35` int(11) NOT NULL,
  `b36` int(11) NOT NULL,
  `b37` int(11) NOT NULL,
  `b41` int(11) NOT NULL,
  `b42` int(11) NOT NULL,
  `b43` int(11) NOT NULL,
  `b44` int(11) NOT NULL,
  `b45` int(11) NOT NULL,
  `b46` int(11) NOT NULL,
  `b47` int(11) NOT NULL,
  `b51` int(11) NOT NULL,
  `b52` int(11) NOT NULL,
  `b53` int(11) NOT NULL,
  `b54` int(11) NOT NULL,
  `b55` int(11) NOT NULL,
  `b56` int(11) NOT NULL,
  `b57` int(11) NOT NULL,
  `b61` int(11) NOT NULL,
  `b62` int(11) NOT NULL,
  `b63` int(11) NOT NULL,
  `b64` int(11) NOT NULL,
  `b65` int(11) NOT NULL,
  `b66` int(11) NOT NULL,
  `b67` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `cf_ranks` (
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `cf_room` (
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