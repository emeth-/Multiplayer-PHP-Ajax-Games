SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `announcements` (
  `a_text` text NOT NULL,
  `a_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `arcadepbest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL DEFAULT '0',
  `gameid` int(11) NOT NULL DEFAULT '0',
  `score` float NOT NULL DEFAULT '0',
  `gamename` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=879 ;

CREATE TABLE IF NOT EXISTS `arcadetrophy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL DEFAULT '0',
  `gameid` int(11) NOT NULL DEFAULT '0',
  `score` float NOT NULL DEFAULT '0',
  `place` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `gamename` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `bg_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bg_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

CREATE TABLE IF NOT EXISTS `bg_game` (
  `black` bigint(20) NOT NULL,
  `bg_room` int(11) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `dselected` int(1) NOT NULL,
  `d1` int(1) NOT NULL,
  `d2` int(1) NOT NULL,
  `d3` int(1) NOT NULL,
  `d4` int(1) NOT NULL,
  `b0` int(11) NOT NULL,
  `b1` int(11) NOT NULL DEFAULT '2',
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
  `b12` int(11) NOT NULL DEFAULT '5',
  `b13` int(11) NOT NULL,
  `b14` int(11) NOT NULL,
  `b15` int(11) NOT NULL,
  `b16` int(11) NOT NULL,
  `b17` int(11) NOT NULL DEFAULT '3',
  `b18` int(11) NOT NULL,
  `b19` int(11) NOT NULL DEFAULT '5',
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
  `a6` int(11) NOT NULL DEFAULT '5',
  `a7` int(11) NOT NULL,
  `a8` int(11) NOT NULL DEFAULT '3',
  `a9` int(11) NOT NULL,
  `a10` int(11) NOT NULL,
  `a11` int(11) NOT NULL,
  `a12` int(11) NOT NULL,
  `a13` int(11) NOT NULL DEFAULT '5',
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
  `a24` int(11) NOT NULL DEFAULT '2',
  `a25` int(11) NOT NULL,
  `abar` int(2) NOT NULL,
  `bbar` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `bg_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `bg_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

CREATE TABLE IF NOT EXISTS `blackjack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `betAmount` int(11) NOT NULL,
  `uNumHits` int(3) NOT NULL DEFAULT '0',
  `dNumHits` int(3) NOT NULL DEFAULT '0',
  `c1n` int(3) NOT NULL,
  `c1s` varchar(3) NOT NULL,
  `c2n` int(3) NOT NULL,
  `c2s` varchar(3) NOT NULL,
  `c3n` int(3) NOT NULL,
  `c3s` varchar(3) NOT NULL,
  `c4n` int(3) NOT NULL,
  `c4s` varchar(3) NOT NULL,
  `c5n` int(3) NOT NULL,
  `c5s` varchar(3) NOT NULL,
  `c6n` int(3) NOT NULL,
  `c6s` varchar(3) NOT NULL,
  `c7n` int(3) NOT NULL,
  `c7s` varchar(3) NOT NULL,
  `c8n` int(3) NOT NULL,
  `c8s` varchar(3) NOT NULL,
  `c9n` int(3) NOT NULL,
  `c9s` varchar(3) NOT NULL,
  `c10n` int(3) NOT NULL,
  `c10s` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

CREATE TABLE IF NOT EXISTS `blackjack_stats` (
  `houseProfit` int(11) NOT NULL,
  `totalPlays` int(11) NOT NULL,
  `minbet` int(11) NOT NULL DEFAULT '100',
  `maxbet` int(11) NOT NULL DEFAULT '1000'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `bs_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bs_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `bs_game` (
  `first` bigint(20) NOT NULL,
  `bs_room` int(11) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `gamestart` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `p1b` text NOT NULL,
  `p2b` text NOT NULL,
  `p1bo` text NOT NULL,
  `p2bo` text NOT NULL,
  `p1ss` varchar(5) NOT NULL,
  `p2ss` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `bs_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `bs_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `cf_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cf_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

CREATE TABLE IF NOT EXISTS `cf_game` (
  `red` bigint(20) NOT NULL,
  `cf_room` int(11) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `b11` bigint(20) NOT NULL,
  `b12` bigint(20) NOT NULL,
  `b13` bigint(20) NOT NULL,
  `b14` bigint(20) NOT NULL,
  `b15` bigint(20) NOT NULL,
  `b16` bigint(20) NOT NULL,
  `b17` bigint(20) NOT NULL,
  `b21` bigint(20) NOT NULL,
  `b22` bigint(20) NOT NULL,
  `b23` bigint(20) NOT NULL,
  `b24` bigint(20) NOT NULL,
  `b25` bigint(20) NOT NULL,
  `b26` bigint(20) NOT NULL,
  `b27` bigint(20) NOT NULL,
  `b31` bigint(20) NOT NULL,
  `b32` bigint(20) NOT NULL,
  `b33` bigint(20) NOT NULL,
  `b34` bigint(20) NOT NULL,
  `b35` bigint(20) NOT NULL,
  `b36` bigint(20) NOT NULL,
  `b37` bigint(20) NOT NULL,
  `b41` bigint(20) NOT NULL,
  `b42` bigint(20) NOT NULL,
  `b43` bigint(20) NOT NULL,
  `b44` bigint(20) NOT NULL,
  `b45` bigint(20) NOT NULL,
  `b46` bigint(20) NOT NULL,
  `b47` bigint(20) NOT NULL,
  `b51` bigint(20) NOT NULL,
  `b52` bigint(20) NOT NULL,
  `b53` bigint(20) NOT NULL,
  `b54` bigint(20) NOT NULL,
  `b55` bigint(20) NOT NULL,
  `b56` bigint(20) NOT NULL,
  `b57` bigint(20) NOT NULL,
  `b61` bigint(20) NOT NULL,
  `b62` bigint(20) NOT NULL,
  `b63` bigint(20) NOT NULL,
  `b64` bigint(20) NOT NULL,
  `b65` bigint(20) NOT NULL,
  `b66` bigint(20) NOT NULL,
  `b67` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cf_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cf_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

CREATE TABLE IF NOT EXISTS `challenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `from` bigint(20) NOT NULL,
  `to` bigint(20) NOT NULL,
  `game` varchar(20) NOT NULL,
  `time_left` int(11) NOT NULL,
  `accepted` bigint(20) NOT NULL,
  `room` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to` (`to`),
  KEY `from` (`from`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=325 ;

CREATE TABLE IF NOT EXISTS `ck_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ck_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

CREATE TABLE IF NOT EXISTS `ck_game` (
  `red` bigint(20) NOT NULL,
  `ck_room` int(11) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `pselect` int(11) NOT NULL DEFAULT '-1',
  `lastmove` int(2) NOT NULL,
  `lastmove2` int(2) NOT NULL,
  `b33` bigint(20) NOT NULL,
  `b1` bigint(20) NOT NULL,
  `b2` bigint(20) NOT NULL,
  `b3` bigint(20) NOT NULL,
  `b4` bigint(20) NOT NULL,
  `b5` bigint(20) NOT NULL,
  `b6` bigint(20) NOT NULL,
  `b7` bigint(20) NOT NULL,
  `b8` bigint(20) NOT NULL,
  `b9` bigint(20) NOT NULL,
  `b10` bigint(20) NOT NULL,
  `b11` bigint(20) NOT NULL,
  `b12` bigint(20) NOT NULL,
  `b13` bigint(20) NOT NULL,
  `b14` bigint(20) NOT NULL,
  `b15` bigint(20) NOT NULL,
  `b16` bigint(20) NOT NULL,
  `b17` bigint(20) NOT NULL,
  `b18` bigint(20) NOT NULL,
  `b19` bigint(20) NOT NULL,
  `b20` bigint(20) NOT NULL,
  `b21` bigint(20) NOT NULL,
  `b22` bigint(20) NOT NULL,
  `b23` bigint(20) NOT NULL,
  `b24` bigint(20) NOT NULL,
  `b25` bigint(20) NOT NULL,
  `b26` bigint(20) NOT NULL,
  `b27` bigint(20) NOT NULL,
  `b28` bigint(20) NOT NULL,
  `b29` bigint(20) NOT NULL,
  `b30` bigint(20) NOT NULL,
  `b31` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ck_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ck_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

CREATE TABLE IF NOT EXISTS `flash2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accepted` int(1) NOT NULL DEFAULT '0',
  `game` varchar(35) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `category` tinyint(3) NOT NULL DEFAULT '0',
  `plays` int(11) NOT NULL DEFAULT '0',
  `file` varchar(50) NOT NULL DEFAULT '',
  `imagename` varchar(60) NOT NULL DEFAULT '',
  `height` int(11) NOT NULL DEFAULT '350',
  `width` int(11) NOT NULL DEFAULT '750',
  `maxscore` float NOT NULL DEFAULT '0',
  `minscore` float NOT NULL DEFAULT '0',
  `sortmethod` varchar(5) NOT NULL DEFAULT 'DESC',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=162 ;

CREATE TABLE IF NOT EXISTS `flashscores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `gameid` int(11) unsigned NOT NULL DEFAULT '0',
  `score` float NOT NULL DEFAULT '0',
  `startTime` int(11) unsigned NOT NULL DEFAULT '0',
  `endTime` int(11) unsigned NOT NULL DEFAULT '0',
  `champ` int(11) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `scoreStatus` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7147 ;

CREATE TABLE IF NOT EXISTS `highscores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `gameid` int(11) unsigned NOT NULL DEFAULT '0',
  `score` float NOT NULL DEFAULT '0',
  `startTime` int(11) unsigned NOT NULL DEFAULT '0',
  `endTime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=528 ;

CREATE TABLE IF NOT EXISTS `ipban` (
  `iID` int(11) NOT NULL AUTO_INCREMENT,
  `iIP` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`iID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

CREATE TABLE IF NOT EXISTS `man_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `man_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

CREATE TABLE IF NOT EXISTS `man_game` (
  `bottom` bigint(20) NOT NULL,
  `man_room` int(11) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `b0` int(11) NOT NULL DEFAULT '0',
  `b1` int(11) NOT NULL DEFAULT '4',
  `b2` int(11) NOT NULL DEFAULT '4',
  `b3` int(11) NOT NULL DEFAULT '4',
  `b4` int(11) NOT NULL DEFAULT '4',
  `b5` int(11) NOT NULL DEFAULT '4',
  `b6` int(11) NOT NULL DEFAULT '4',
  `b7` int(11) NOT NULL DEFAULT '0',
  `b8` int(11) NOT NULL DEFAULT '4',
  `b9` int(11) NOT NULL DEFAULT '4',
  `b10` int(11) NOT NULL DEFAULT '4',
  `b11` int(11) NOT NULL DEFAULT '4',
  `b12` int(11) NOT NULL DEFAULT '4',
  `b13` int(11) NOT NULL DEFAULT '4'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `man_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `man_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `ms_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

CREATE TABLE IF NOT EXISTS `ms_game` (
  `black` bigint(20) NOT NULL,
  `ms_room` int(11) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `lastmove` int(11) NOT NULL,
  `mselected` int(1) NOT NULL,
  `m1` int(1) NOT NULL,
  `m2` int(1) NOT NULL,
  `pointsp1` int(11) NOT NULL,
  `pointsp2` int(11) NOT NULL,
  `gametxt` varchar(255) NOT NULL,
  `b11` bigint(20) NOT NULL DEFAULT '-1',
  `b12` bigint(20) NOT NULL DEFAULT '-1',
  `b13` bigint(20) NOT NULL DEFAULT '-1',
  `b14` bigint(20) NOT NULL DEFAULT '-1',
  `b15` bigint(20) NOT NULL DEFAULT '-1',
  `b16` bigint(20) NOT NULL DEFAULT '-1',
  `b17` bigint(20) NOT NULL DEFAULT '-1',
  `b18` bigint(20) NOT NULL DEFAULT '-1',
  `b19` bigint(20) NOT NULL DEFAULT '-1',
  `b21` bigint(20) NOT NULL DEFAULT '-1',
  `b22` bigint(20) NOT NULL DEFAULT '-1',
  `b23` bigint(20) NOT NULL DEFAULT '-1',
  `b24` bigint(20) NOT NULL DEFAULT '-1',
  `b25` bigint(20) NOT NULL DEFAULT '-1',
  `b26` bigint(20) NOT NULL DEFAULT '-1',
  `b27` bigint(20) NOT NULL DEFAULT '-1',
  `b28` bigint(20) NOT NULL DEFAULT '-1',
  `b29` bigint(20) NOT NULL DEFAULT '-1',
  `b31` bigint(20) NOT NULL DEFAULT '-1',
  `b32` bigint(20) NOT NULL DEFAULT '-1',
  `b33` bigint(20) NOT NULL DEFAULT '-1',
  `b34` bigint(20) NOT NULL DEFAULT '-1',
  `b35` bigint(20) NOT NULL DEFAULT '-1',
  `b36` bigint(20) NOT NULL DEFAULT '-1',
  `b37` bigint(20) NOT NULL DEFAULT '-1',
  `b38` bigint(20) NOT NULL DEFAULT '-1',
  `b39` bigint(20) NOT NULL DEFAULT '-1',
  `b41` bigint(20) NOT NULL DEFAULT '-1',
  `b42` bigint(20) NOT NULL DEFAULT '-1',
  `b43` bigint(20) NOT NULL DEFAULT '-1',
  `b44` bigint(20) NOT NULL DEFAULT '-1',
  `b45` bigint(20) NOT NULL DEFAULT '-1',
  `b46` bigint(20) NOT NULL DEFAULT '-1',
  `b47` bigint(20) NOT NULL DEFAULT '-1',
  `b48` bigint(20) NOT NULL DEFAULT '-1',
  `b49` bigint(20) NOT NULL DEFAULT '-1',
  `b51` bigint(20) NOT NULL DEFAULT '-1',
  `b52` bigint(20) NOT NULL DEFAULT '-1',
  `b53` bigint(20) NOT NULL DEFAULT '-1',
  `b54` bigint(20) NOT NULL DEFAULT '-1',
  `b55` bigint(20) NOT NULL DEFAULT '-1',
  `b56` bigint(20) NOT NULL DEFAULT '-1',
  `b57` bigint(20) NOT NULL DEFAULT '-1',
  `b58` bigint(20) NOT NULL DEFAULT '-1',
  `b59` bigint(20) NOT NULL DEFAULT '-1',
  `b61` bigint(20) NOT NULL DEFAULT '-1',
  `b62` bigint(20) NOT NULL DEFAULT '-1',
  `b63` bigint(20) NOT NULL DEFAULT '-1',
  `b64` bigint(20) NOT NULL DEFAULT '-1',
  `b65` bigint(20) NOT NULL DEFAULT '-1',
  `b66` bigint(20) NOT NULL DEFAULT '-1',
  `b67` bigint(20) NOT NULL DEFAULT '-1',
  `b68` bigint(20) NOT NULL DEFAULT '-1',
  `b69` bigint(20) NOT NULL DEFAULT '-1',
  `b71` bigint(20) NOT NULL DEFAULT '-1',
  `b72` bigint(20) NOT NULL DEFAULT '-1',
  `b73` bigint(20) NOT NULL DEFAULT '-1',
  `b74` bigint(20) NOT NULL DEFAULT '-1',
  `b75` bigint(20) NOT NULL DEFAULT '-1',
  `b76` bigint(20) NOT NULL DEFAULT '-1',
  `b77` bigint(20) NOT NULL DEFAULT '-1',
  `b78` bigint(20) NOT NULL DEFAULT '-1',
  `b79` bigint(20) NOT NULL DEFAULT '-1',
  `b81` bigint(20) NOT NULL DEFAULT '-1',
  `b82` bigint(20) NOT NULL DEFAULT '-1',
  `b83` bigint(20) NOT NULL DEFAULT '-1',
  `b84` bigint(20) NOT NULL DEFAULT '-1',
  `b85` bigint(20) NOT NULL DEFAULT '-1',
  `b86` bigint(20) NOT NULL DEFAULT '-1',
  `b87` bigint(20) NOT NULL DEFAULT '-1',
  `b88` bigint(20) NOT NULL DEFAULT '-1',
  `b89` bigint(20) NOT NULL DEFAULT '-1',
  `b91` bigint(20) NOT NULL DEFAULT '-1',
  `b92` bigint(20) NOT NULL DEFAULT '-1',
  `b93` bigint(20) NOT NULL DEFAULT '-1',
  `b94` bigint(20) NOT NULL DEFAULT '-1',
  `b95` bigint(20) NOT NULL DEFAULT '-1',
  `b96` bigint(20) NOT NULL DEFAULT '-1',
  `b97` bigint(20) NOT NULL DEFAULT '-1',
  `b98` bigint(20) NOT NULL DEFAULT '-1',
  `b99` bigint(20) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ms_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ms_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL DEFAULT '0',
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

CREATE TABLE IF NOT EXISTS `multgames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `short` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `multihistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` varchar(255) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `loser` bigint(20) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `tiegame` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

CREATE TABLE IF NOT EXISTS `or_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `or_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

CREATE TABLE IF NOT EXISTS `or_game` (
  `black` bigint(20) NOT NULL,
  `or_room` int(11) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `b11` bigint(20) NOT NULL,
  `b12` bigint(20) NOT NULL,
  `b13` bigint(20) NOT NULL,
  `b14` bigint(20) NOT NULL,
  `b15` bigint(20) NOT NULL,
  `b16` bigint(20) NOT NULL,
  `b17` bigint(20) NOT NULL,
  `b18` bigint(20) NOT NULL,
  `b21` bigint(20) NOT NULL,
  `b22` bigint(20) NOT NULL,
  `b23` bigint(20) NOT NULL,
  `b24` bigint(20) NOT NULL,
  `b25` bigint(20) NOT NULL,
  `b26` bigint(20) NOT NULL,
  `b27` bigint(20) NOT NULL,
  `b28` bigint(20) NOT NULL,
  `b31` bigint(20) NOT NULL,
  `b32` bigint(20) NOT NULL,
  `b33` bigint(20) NOT NULL,
  `b34` bigint(20) NOT NULL,
  `b35` bigint(20) NOT NULL,
  `b36` bigint(20) NOT NULL,
  `b37` bigint(20) NOT NULL,
  `b38` bigint(20) NOT NULL,
  `b41` bigint(20) NOT NULL,
  `b42` bigint(20) NOT NULL,
  `b43` bigint(20) NOT NULL,
  `b44` bigint(20) NOT NULL,
  `b45` bigint(20) NOT NULL,
  `b46` bigint(20) NOT NULL,
  `b47` bigint(20) NOT NULL,
  `b48` bigint(20) NOT NULL,
  `b51` bigint(20) NOT NULL,
  `b52` bigint(20) NOT NULL,
  `b53` bigint(20) NOT NULL,
  `b54` bigint(20) NOT NULL,
  `b55` bigint(20) NOT NULL,
  `b56` bigint(20) NOT NULL,
  `b57` bigint(20) NOT NULL,
  `b58` bigint(20) NOT NULL,
  `b61` bigint(20) NOT NULL,
  `b62` bigint(20) NOT NULL,
  `b63` bigint(20) NOT NULL,
  `b64` bigint(20) NOT NULL,
  `b65` bigint(20) NOT NULL,
  `b66` bigint(20) NOT NULL,
  `b67` bigint(20) NOT NULL,
  `b68` bigint(20) NOT NULL,
  `b71` bigint(20) NOT NULL,
  `b72` bigint(20) NOT NULL,
  `b73` bigint(20) NOT NULL,
  `b74` bigint(20) NOT NULL,
  `b75` bigint(20) NOT NULL,
  `b76` bigint(20) NOT NULL,
  `b77` bigint(20) NOT NULL,
  `b78` bigint(20) NOT NULL,
  `b81` bigint(20) NOT NULL,
  `b82` bigint(20) NOT NULL,
  `b83` bigint(20) NOT NULL,
  `b84` bigint(20) NOT NULL,
  `b85` bigint(20) NOT NULL,
  `b86` bigint(20) NOT NULL,
  `b87` bigint(20) NOT NULL,
  `b88` bigint(20) NOT NULL,
  `lastmove` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `or_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `or_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `pp_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `gameover` int(1) NOT NULL,
  `deck` text NOT NULL,
  `layout` text NOT NULL,
  `spotindeck` text NOT NULL,
  `count` text NOT NULL,
  `cardselect` int(11) NOT NULL DEFAULT '1',
  `score` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

CREATE TABLE IF NOT EXISTS `pp_scores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `score` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

CREATE TABLE IF NOT EXISTS `roulette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `winnum` int(3) NOT NULL,
  `wincolor` int(2) NOT NULL,
  `winRange` int(2) NOT NULL,
  `winEvenOdd` int(2) NOT NULL,
  `wincolumn` int(2) NOT NULL,
  `winrow` int(2) NOT NULL,
  `betNum` int(3) NOT NULL DEFAULT '-1',
  `betAmount` int(11) NOT NULL,
  `betColumnNum` int(3) NOT NULL DEFAULT '-1',
  `betRowNum` int(3) NOT NULL DEFAULT '-1',
  `betRangeNum` int(3) NOT NULL DEFAULT '-1',
  `betEvenOddNum` int(3) NOT NULL DEFAULT '-1',
  `betColorNum` int(3) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

CREATE TABLE IF NOT EXISTS `roulette_stats` (
  `minbet` int(11) NOT NULL,
  `maxbet` int(11) NOT NULL,
  `totHouseProfit` float NOT NULL,
  `totPlays` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `settings` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_name` varchar(255) NOT NULL DEFAULT '',
  `conf_value` text NOT NULL,
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

CREATE TABLE IF NOT EXISTS `slots_stats` (
  `plays` int(11) NOT NULL,
  `houseprofit` int(11) NOT NULL,
  `jackpot7` int(11) NOT NULL,
  `jackpotbar` int(11) NOT NULL,
  `minbet` int(11) NOT NULL,
  `maxbet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `slot_reel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reel1` varchar(255) NOT NULL DEFAULT 'blank',
  `reel2` varchar(255) NOT NULL DEFAULT 'blank',
  `reel3` varchar(255) NOT NULL DEFAULT 'blank',
  `reel1bef` varchar(255) NOT NULL,
  `reel1aft` varchar(255) NOT NULL,
  `reel2bef` varchar(255) NOT NULL,
  `reel2aft` varchar(255) NOT NULL,
  `reel3bef` varchar(255) NOT NULL,
  `reel3aft` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

CREATE TABLE IF NOT EXISTS `st_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `st_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

CREATE TABLE IF NOT EXISTS `st_game` (
  `red` bigint(20) NOT NULL,
  `st_room` bigint(20) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `mode` int(1) NOT NULL,
  `pselected` bigint(20) NOT NULL,
  `b11` bigint(20) NOT NULL,
  `b12` bigint(20) NOT NULL,
  `b13` bigint(20) NOT NULL,
  `b14` bigint(20) NOT NULL,
  `b15` bigint(20) NOT NULL,
  `b16` bigint(20) NOT NULL,
  `b17` bigint(20) NOT NULL,
  `b18` bigint(20) NOT NULL,
  `b21` bigint(20) NOT NULL,
  `b22` bigint(20) NOT NULL,
  `b23` bigint(20) NOT NULL,
  `b24` bigint(20) NOT NULL,
  `b25` bigint(20) NOT NULL,
  `b26` bigint(20) NOT NULL,
  `b27` bigint(20) NOT NULL,
  `b28` bigint(20) NOT NULL,
  `b31` bigint(20) NOT NULL,
  `b32` bigint(20) NOT NULL,
  `b33` bigint(20) NOT NULL,
  `b34` bigint(20) NOT NULL,
  `b35` bigint(20) NOT NULL,
  `b36` bigint(20) NOT NULL,
  `b37` bigint(20) NOT NULL,
  `b38` bigint(20) NOT NULL,
  `b41` bigint(20) NOT NULL,
  `b42` bigint(20) NOT NULL,
  `b43` bigint(20) NOT NULL,
  `b44` bigint(20) NOT NULL,
  `b45` bigint(20) NOT NULL,
  `b46` bigint(20) NOT NULL,
  `b47` bigint(20) NOT NULL,
  `b48` bigint(20) NOT NULL,
  `b51` bigint(20) NOT NULL,
  `b52` bigint(20) NOT NULL,
  `b53` bigint(20) NOT NULL,
  `b54` bigint(20) NOT NULL,
  `b55` bigint(20) NOT NULL,
  `b56` bigint(20) NOT NULL,
  `b57` bigint(20) NOT NULL,
  `b58` bigint(20) NOT NULL,
  `b61` bigint(20) NOT NULL,
  `b62` bigint(20) NOT NULL,
  `b63` bigint(20) NOT NULL,
  `b64` bigint(20) NOT NULL,
  `b65` bigint(20) NOT NULL,
  `b66` bigint(20) NOT NULL,
  `b67` bigint(20) NOT NULL,
  `b68` bigint(20) NOT NULL,
  `b71` bigint(20) NOT NULL,
  `b72` bigint(20) NOT NULL,
  `b73` bigint(20) NOT NULL,
  `b74` bigint(20) NOT NULL,
  `b75` bigint(20) NOT NULL,
  `b76` bigint(20) NOT NULL,
  `b77` bigint(20) NOT NULL,
  `b78` bigint(20) NOT NULL,
  `b81` bigint(20) NOT NULL,
  `b82` bigint(20) NOT NULL,
  `b83` bigint(20) NOT NULL,
  `b84` bigint(20) NOT NULL,
  `b85` bigint(20) NOT NULL,
  `b86` bigint(20) NOT NULL,
  `b87` bigint(20) NOT NULL,
  `b88` bigint(20) NOT NULL,
  `a11` bigint(20) NOT NULL,
  `a12` bigint(20) NOT NULL,
  `a13` bigint(20) NOT NULL,
  `a14` bigint(20) NOT NULL,
  `a15` bigint(20) NOT NULL,
  `a16` bigint(20) NOT NULL,
  `a17` bigint(20) NOT NULL,
  `a18` bigint(20) NOT NULL,
  `a21` bigint(20) NOT NULL,
  `a22` bigint(20) NOT NULL,
  `a23` bigint(20) NOT NULL,
  `a24` bigint(20) NOT NULL,
  `a25` bigint(20) NOT NULL,
  `a26` bigint(20) NOT NULL,
  `a27` bigint(20) NOT NULL,
  `a28` bigint(20) NOT NULL,
  `a31` bigint(20) NOT NULL,
  `a32` bigint(20) NOT NULL,
  `a33` bigint(20) NOT NULL,
  `a34` bigint(20) NOT NULL,
  `a35` bigint(20) NOT NULL,
  `a36` bigint(20) NOT NULL,
  `a37` bigint(20) NOT NULL,
  `a38` bigint(20) NOT NULL,
  `a41` bigint(20) NOT NULL,
  `a42` bigint(20) NOT NULL,
  `a43` bigint(20) NOT NULL,
  `a44` bigint(20) NOT NULL,
  `a45` bigint(20) NOT NULL,
  `a46` bigint(20) NOT NULL,
  `a47` bigint(20) NOT NULL,
  `a48` bigint(20) NOT NULL,
  `a51` bigint(20) NOT NULL,
  `a52` bigint(20) NOT NULL,
  `a53` bigint(20) NOT NULL,
  `a54` bigint(20) NOT NULL,
  `a55` bigint(20) NOT NULL,
  `a56` bigint(20) NOT NULL,
  `a57` bigint(20) NOT NULL,
  `a58` bigint(20) NOT NULL,
  `a61` bigint(20) NOT NULL,
  `a62` bigint(20) NOT NULL,
  `a63` bigint(20) NOT NULL,
  `a64` bigint(20) NOT NULL,
  `a65` bigint(20) NOT NULL,
  `a66` bigint(20) NOT NULL,
  `a67` bigint(20) NOT NULL,
  `a68` bigint(20) NOT NULL,
  `a71` bigint(20) NOT NULL,
  `a72` bigint(20) NOT NULL,
  `a73` bigint(20) NOT NULL,
  `a74` bigint(20) NOT NULL,
  `a75` bigint(20) NOT NULL,
  `a76` bigint(20) NOT NULL,
  `a77` bigint(20) NOT NULL,
  `a78` bigint(20) NOT NULL,
  `a81` bigint(20) NOT NULL,
  `a82` bigint(20) NOT NULL,
  `a83` bigint(20) NOT NULL,
  `a84` bigint(20) NOT NULL,
  `a85` bigint(20) NOT NULL,
  `a86` bigint(20) NOT NULL,
  `a87` bigint(20) NOT NULL,
  `a88` bigint(20) NOT NULL,
  `lastmove` bigint(20) NOT NULL,
  `pa1` bigint(20) NOT NULL DEFAULT '1',
  `pa2` bigint(20) NOT NULL DEFAULT '1',
  `pa3` bigint(20) NOT NULL DEFAULT '2',
  `pa4` bigint(20) NOT NULL DEFAULT '3',
  `pa5` bigint(20) NOT NULL DEFAULT '3',
  `pa6` bigint(20) NOT NULL DEFAULT '3',
  `pa7` bigint(20) NOT NULL DEFAULT '5',
  `pa8` bigint(20) NOT NULL DEFAULT '1',
  `pa9` bigint(20) NOT NULL DEFAULT '4',
  `pa10` bigint(20) NOT NULL DEFAULT '1',
  `pb1` bigint(20) NOT NULL DEFAULT '1',
  `pb2` bigint(20) NOT NULL DEFAULT '1',
  `pb3` bigint(20) NOT NULL DEFAULT '2',
  `pb4` bigint(20) NOT NULL DEFAULT '3',
  `pb5` bigint(20) NOT NULL DEFAULT '3',
  `pb6` bigint(20) NOT NULL DEFAULT '3',
  `pb7` bigint(20) NOT NULL DEFAULT '5',
  `pb8` bigint(20) NOT NULL DEFAULT '1',
  `pb9` bigint(20) NOT NULL DEFAULT '4',
  `pb10` bigint(20) NOT NULL DEFAULT '1',
  `p1ready` int(1) NOT NULL,
  `p2ready` int(1) NOT NULL,
  `posa` bigint(20) NOT NULL,
  `posb` bigint(20) NOT NULL,
  `battletxt` varchar(255) NOT NULL,
  `listofmoves` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `st_ranks` (
  `userid` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `ties` int(11) NOT NULL,
  `totgames` int(11) NOT NULL,
  `ratio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `st_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `p1missed` int(1) NOT NULL,
  `p2missed` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

CREATE TABLE IF NOT EXISTS `ttt_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ttt_room` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `txt` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

CREATE TABLE IF NOT EXISTS `ttt_game` (
  `ttt_room` int(11) NOT NULL,
  `b1` bigint(20) NOT NULL,
  `b2` bigint(20) NOT NULL,
  `b3` bigint(20) NOT NULL,
  `b4` bigint(20) NOT NULL,
  `b5` bigint(20) NOT NULL,
  `b6` bigint(20) NOT NULL,
  `b7` bigint(20) NOT NULL,
  `b8` bigint(20) NOT NULL,
  `b9` bigint(20) NOT NULL,
  `x` bigint(20) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `winner` bigint(20) NOT NULL,
  `replay` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ttt_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bet` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `p1` bigint(20) NOT NULL,
  `p2` bigint(20) NOT NULL,
  `turn` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `play_time` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `notifyturn` int(1) NOT NULL,
  `pleft` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

CREATE TABLE IF NOT EXISTS `users` (
  `userid` bigint(20) NOT NULL,
  `guest` int(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `laston` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `lastip` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `bg_room` int(11) NOT NULL,
  `ms_room` int(11) NOT NULL,
  `ck_room` int(11) NOT NULL,
  `cf_room` int(11) NOT NULL,
  `man_room` int(11) NOT NULL,
  `or_room` int(11) NOT NULL,
  `ttt_room` int(11) NOT NULL,
  `bs_room` int(11) NOT NULL,
  `st_room` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `videopoker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `betAmount` int(11) NOT NULL,
  `c1n` int(3) NOT NULL,
  `c1s` varchar(3) NOT NULL,
  `c2n` int(3) NOT NULL,
  `c2s` varchar(3) NOT NULL,
  `c3n` int(3) NOT NULL,
  `c3s` varchar(3) NOT NULL,
  `c4n` int(3) NOT NULL,
  `c4s` varchar(3) NOT NULL,
  `c5n` int(3) NOT NULL,
  `c5s` varchar(3) NOT NULL,
  `c6n` int(3) NOT NULL,
  `c6s` varchar(3) NOT NULL,
  `c7n` int(3) NOT NULL,
  `c7s` varchar(3) NOT NULL,
  `c8n` int(3) NOT NULL,
  `c8s` varchar(3) NOT NULL,
  `c9n` int(3) NOT NULL,
  `c9s` varchar(3) NOT NULL,
  `c10n` int(3) NOT NULL,
  `c10s` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=228 ;

CREATE TABLE IF NOT EXISTS `videopoker_stats` (
  `houseProfit` int(11) NOT NULL,
  `totalPlays` int(11) NOT NULL,
  `minbet` int(11) NOT NULL,
  `maxbet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
