<?php


$gpre = "bs_";
$gpres = "bs";
$gamename = "Battle Ship";

$teaser_image = "images/bs/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "first";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "";

$rules = "
<center><b>Rules</b><br /><br /></center>
<ul>
<li>At the beginning of the game, players set up their fleets is set up. It is randomly chosen who goes first.</li>
<br /><li>After the fleets are set up, players take turning firing at each other's boards, trying to hit their opponent's fleet.</li>
<br /><li>If you hit all the parts of an opponent's ship, that ship is sunk.</li>
<br /><li>First player to sink all their opponent's ships wins.</li>
</ul>


";

//SQL
/*

ALTER TABLE  `users` ADD  `bs_room` INT( 11 ) NOT NULL;


CREATE TABLE IF NOT EXISTS `bs_chat` (
  `id` int(11) NOT NULL auto_increment,
  `bs_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `bs_game` (
  `first` int(11) NOT NULL,
  `bs_room` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `replay` int(11) NOT NULL,
  `gamestart` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `p1b` text NOT NULL,
  `p2b` text NOT NULL,
  `p1bo` text NOT NULL,
  `p2bo` text NOT NULL,
  `p1ss` varchar(5) NOT NULL,
  `p2ss` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `bs_ranks` (
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `bs_room` (
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