<?php


$gpre = "man_";
$gpres = "man";
$gamename = "Mancala";

$teaser_image = "images/man/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "bottom";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "Bottom/Right";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "Top/Left";

$rules = "
<center><b>Rules</b><br /><br /></center>
<ul>
<li>At the beginning of the game, four seeds are placed in each house. It is randomly chosen who goes first.</li>
<br /><li>Each player controls the six houses and their seeds on his side of the board. His score is the number of seeds in his store (for the player on bottom, on his right, for the player on top, his left).</li>
<br /><li>Players take turns sowing their seeds. On a turn, the player removes all seeds from one of the houses under his control. Moving counter-clockwise, the player drops one seed in each house in turn, including the player's own store but not his opponent's.</li>
<br /><li>If the last sown seed lands in the player's store, the player gets an additional move. There is no limit on the number of moves a player can make in his turn.</li>
<br /><li>If the last sown seed lands in an empty house owned by the player, and the opposite house contains seeds, both the last seed and the opposite seeds are captured and placed into the player's store.</li>
<br /><li>When one player no longer has any seeds in any of his houses, the game ends. The other player moves all remaining seeds to his store, and the player with the most seeds in his store wins.</li>
<br /><li>You get about 30 seconds for your turn. If you run out of time, your opponent gains 3 points, and you lose your turn.</li>
</ul>


";

//SQL
/*

ALTER TABLE  `users` ADD  `man_room` INT( 11 ) NOT NULL;



CREATE TABLE IF NOT EXISTS `man_chat` (
  `id` int(11) NOT NULL auto_increment,
  `man_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `man_game` (
  `bottom` int(11) NOT NULL,
  `man_room` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `replay` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `b0` int(11) NOT NULL default '0',
  `b1` int(11) NOT NULL default '4',
  `b2` int(11) NOT NULL default '4',
  `b3` int(11) NOT NULL default '4',
  `b4` int(11) NOT NULL default '4',
  `b5` int(11) NOT NULL default '4',
  `b6` int(11) NOT NULL default '4',
  `b7` int(11) NOT NULL default '0',
  `b8` int(11) NOT NULL default '4',
  `b9` int(11) NOT NULL default '4',
  `b10` int(11) NOT NULL default '4',
  `b11` int(11) NOT NULL default '4',
  `b12` int(11) NOT NULL default '4',
  `b13` int(11) NOT NULL default '4'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `man_ranks` (
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `man_room` (
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