<?php


$gpre = "or_";
$gpres = "or";
$gamename = "Othello";

$teaser_image = "images/or/title.jpg";

//ex: tic tac toe = "x", connect 4 = "red"
$firstmovemarkfield = "black";

//ex: tic tac toe = X, connect 4 = RED
$person1mark = "BLACK";

//ex: tic tac toe = O, connect 4 = BLACK
$person2mark = "WHITE";

$rules = "
<center><b>Rules</b><br /><br /></center>
<ul>
<li>At the beginning of the game, the board is set up. It is randomly chosen who goes first.</li>
<br /><li>Players take turn placing a single marker on the board.</li>
<br /><li>You can only place markers in spots where you 'capture' at least one of your opponent's pieces.</li>
<br /><li>You 'capture' opponent's pieces when you place a marker down, and in a vertical, horizontal, or diagnol direction from that spot there are opponent's pieces, followed by another one of your pieces, with no empty spots.</li>
<br /><li>Example: X = your piece, O = opponent piece</li>
<br /><li>X O O O X turns into X X X X X</li>
<br /><li>Captured pieces change to the color of the person who captured them.</li>
<br /><li>You win by either capturing all your opponent's pieces, or by them running out of legal moves.</li>

</ul>


";


//SQL
/*

ALTER TABLE  `users` ADD  `or_room` INT( 11 ) NOT NULL;

CREATE TABLE IF NOT EXISTS `or_chat` (
  `id` int(11) NOT NULL auto_increment,
  `or_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `or_game` (
  `black` int(11) NOT NULL,
  `or_room` int(11) NOT NULL,
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
  `b18` int(11) NOT NULL,
  `b21` int(11) NOT NULL,
  `b22` int(11) NOT NULL,
  `b23` int(11) NOT NULL,
  `b24` int(11) NOT NULL,
  `b25` int(11) NOT NULL,
  `b26` int(11) NOT NULL,
  `b27` int(11) NOT NULL,
  `b28` int(11) NOT NULL,
  `b31` int(11) NOT NULL,
  `b32` int(11) NOT NULL,
  `b33` int(11) NOT NULL,
  `b34` int(11) NOT NULL,
  `b35` int(11) NOT NULL,
  `b36` int(11) NOT NULL,
  `b37` int(11) NOT NULL,
  `b38` int(11) NOT NULL,
  `b41` int(11) NOT NULL,
  `b42` int(11) NOT NULL,
  `b43` int(11) NOT NULL,
  `b44` int(11) NOT NULL,
  `b45` int(11) NOT NULL,
  `b46` int(11) NOT NULL,
  `b47` int(11) NOT NULL,
  `b48` int(11) NOT NULL,
  `b51` int(11) NOT NULL,
  `b52` int(11) NOT NULL,
  `b53` int(11) NOT NULL,
  `b54` int(11) NOT NULL,
  `b55` int(11) NOT NULL,
  `b56` int(11) NOT NULL,
  `b57` int(11) NOT NULL,
  `b58` int(11) NOT NULL,
  `b61` int(11) NOT NULL,
  `b62` int(11) NOT NULL,
  `b63` int(11) NOT NULL,
  `b64` int(11) NOT NULL,
  `b65` int(11) NOT NULL,
  `b66` int(11) NOT NULL,
  `b67` int(11) NOT NULL,
  `b68` int(11) NOT NULL,
  `b71` int(11) NOT NULL,
  `b72` int(11) NOT NULL,
  `b73` int(11) NOT NULL,
  `b74` int(11) NOT NULL,
  `b75` int(11) NOT NULL,
  `b76` int(11) NOT NULL,
  `b77` int(11) NOT NULL,
  `b78` int(11) NOT NULL,
  `b81` int(11) NOT NULL,
  `b82` int(11) NOT NULL,
  `b83` int(11) NOT NULL,
  `b84` int(11) NOT NULL,
  `b85` int(11) NOT NULL,
  `b86` int(11) NOT NULL,
  `b87` int(11) NOT NULL,
  `b88` int(11) NOT NULL,
  `lastmove` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `or_room` (
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


CREATE TABLE IF NOT EXISTS `or_ranks` (
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