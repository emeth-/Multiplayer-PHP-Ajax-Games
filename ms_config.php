<?php


$gpre = "ms_";
$gpres = "ms";
$gamename = "Minesweeper";

$teaser_image = "images/ms/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "black";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "black";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "white";

$rules="
<center><b>Rules</b><br /><br /></center>
<ul>
<li>At the beginning of the game, the board is set up and mines are hidden on the board. It is randomly chosen who goes first.</li>
<br /><li>Players earn points for correctly identifying mines, and lose points for accidentally clicking a mine.</li>
<br /><li>To guess a square is a mine, click the mine icon at the top of the board, then click the square. If you are correct, you gain 5 points. If incorrect, you lose 2 points.</li>
<br /><li>To guess a square is not a mine, click the question mark icon at the top of the board, then click the square. If you are incorrect, you lose 5 points.</li>
<br /><li>When you guess a square is not a mine correctly, 	that square will show the number of mines touching that square.</li>
<br /><li>Players take turns guessing. Player with most points wins.</li>
</ul>


";


//SQL
/*

ALTER TABLE  `users` ADD  `ms_room` INT( 11 ) NOT NULL;

CREATE TABLE IF NOT EXISTS `ms_chat` (
  `id` int(11) NOT NULL auto_increment,
  `ms_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `ms_game` (
  `black` int(11) NOT NULL,
  `ms_room` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `replay` int(11) NOT NULL,
  `p1` int(11) NOT NULL,
  `p2` int(11) NOT NULL,
  `lastmove` int(11) NOT NULL,
  `mselected` int(1) NOT NULL,
  `m1` int(1) NOT NULL,
  `m2` int(1) NOT NULL,
  `pointsp1` int(11) NOT NULL,
  `pointsp2` int(11) NOT NULL,
  `gametxt` varchar(255) NOT NULL,
  `b11` int(11) NOT NULL default '-1',
  `b12` int(11) NOT NULL default '-1',
  `b13` int(11) NOT NULL default '-1',
  `b14` int(11) NOT NULL default '-1',
  `b15` int(11) NOT NULL default '-1',
  `b16` int(11) NOT NULL default '-1',
  `b17` int(11) NOT NULL default '-1',
  `b18` int(11) NOT NULL default '-1',
  `b19` int(11) NOT NULL default '-1',
  `b21` int(11) NOT NULL default '-1',
  `b22` int(11) NOT NULL default '-1',
  `b23` int(11) NOT NULL default '-1',
  `b24` int(11) NOT NULL default '-1',
  `b25` int(11) NOT NULL default '-1',
  `b26` int(11) NOT NULL default '-1',
  `b27` int(11) NOT NULL default '-1',
  `b28` int(11) NOT NULL default '-1',
  `b29` int(11) NOT NULL default '-1',
  `b31` int(11) NOT NULL default '-1',
  `b32` int(11) NOT NULL default '-1',
  `b33` int(11) NOT NULL default '-1',
  `b34` int(11) NOT NULL default '-1',
  `b35` int(11) NOT NULL default '-1',
  `b36` int(11) NOT NULL default '-1',
  `b37` int(11) NOT NULL default '-1',
  `b38` int(11) NOT NULL default '-1',
  `b39` int(11) NOT NULL default '-1',
  `b41` int(11) NOT NULL default '-1',
  `b42` int(11) NOT NULL default '-1',
  `b43` int(11) NOT NULL default '-1',
  `b44` int(11) NOT NULL default '-1',
  `b45` int(11) NOT NULL default '-1',
  `b46` int(11) NOT NULL default '-1',
  `b47` int(11) NOT NULL default '-1',
  `b48` int(11) NOT NULL default '-1',
  `b49` int(11) NOT NULL default '-1',
  `b51` int(11) NOT NULL default '-1',
  `b52` int(11) NOT NULL default '-1',
  `b53` int(11) NOT NULL default '-1',
  `b54` int(11) NOT NULL default '-1',
  `b55` int(11) NOT NULL default '-1',
  `b56` int(11) NOT NULL default '-1',
  `b57` int(11) NOT NULL default '-1',
  `b58` int(11) NOT NULL default '-1',
  `b59` int(11) NOT NULL default '-1',
  `b61` int(11) NOT NULL default '-1',
  `b62` int(11) NOT NULL default '-1',
  `b63` int(11) NOT NULL default '-1',
  `b64` int(11) NOT NULL default '-1',
  `b65` int(11) NOT NULL default '-1',
  `b66` int(11) NOT NULL default '-1',
  `b67` int(11) NOT NULL default '-1',
  `b68` int(11) NOT NULL default '-1',
  `b69` int(11) NOT NULL default '-1',
  `b71` int(11) NOT NULL default '-1',
  `b72` int(11) NOT NULL default '-1',
  `b73` int(11) NOT NULL default '-1',
  `b74` int(11) NOT NULL default '-1',
  `b75` int(11) NOT NULL default '-1',
  `b76` int(11) NOT NULL default '-1',
  `b77` int(11) NOT NULL default '-1',
  `b78` int(11) NOT NULL default '-1',
  `b79` int(11) NOT NULL default '-1',
  `b81` int(11) NOT NULL default '-1',
  `b82` int(11) NOT NULL default '-1',
  `b83` int(11) NOT NULL default '-1',
  `b84` int(11) NOT NULL default '-1',
  `b85` int(11) NOT NULL default '-1',
  `b86` int(11) NOT NULL default '-1',
  `b87` int(11) NOT NULL default '-1',
  `b88` int(11) NOT NULL default '-1',
  `b89` int(11) NOT NULL default '-1',
  `b91` int(11) NOT NULL default '-1',
  `b92` int(11) NOT NULL default '-1',
  `b93` int(11) NOT NULL default '-1',
  `b94` int(11) NOT NULL default '-1',
  `b95` int(11) NOT NULL default '-1',
  `b96` int(11) NOT NULL default '-1',
  `b97` int(11) NOT NULL default '-1',
  `b98` int(11) NOT NULL default '-1',
  `b99` int(11) NOT NULL default '-1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `ms_room` (
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

CREATE TABLE IF NOT EXISTS `ms_ranks` (
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


*/
?>