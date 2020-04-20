SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO `blackjack_stats` (`houseProfit`, `totalPlays`, `minbet`, `maxbet`) VALUES
(2766, 246, 1, 10000);

INSERT INTO `flash2` (`id`, `accepted`, `game`, `description`, `category`, `plays`, `file`, `imagename`, `height`, `width`, `maxscore`, `minscore`, `sortmethod`) VALUES
(1, 1, 'Avoider', '', 0, 138, 'avoider', 'avoider.gif', 400, 550, 0, 1600, 'DESC'),
(5, 1, 'Otello', '', 0, 43, 'otello', 'otello.gif', 450, 445, 0, 0, 'DESC'),
(132, 1, 'Juggler', '', 0, 21, 'pongleur5', 'pongleur51.gif', 513, 450, 0, 800, 'DESC'),
(137, 1, 'Tanks', '', 0, 34, 'tanksIBPAG', 'tanksIBPAG1.gif', 400, 550, 0, 100000, 'DESC'),
(7, 1, 'Ballo', '', 0, 43, 'ballo', 'ballo.gif', 475, 665, 0, 200, 'DESC'),
(12, 1, 'Defend Your Stronghold', 'Addicting game! Defend your stronghold by shooting attackers! Hire guards to help you! <br><br> Space bar reloads your gun', 0, 26, 'defend_your_stronghold', 'defend_your_stronghold.gif', 450, 650, 0, 3, 'DESC'),
(13, 1, 'Chainreaction', '', 0, 42, 'chainreaction_CH', 'chainreaction_CH.gif', 400, 550, 0, 125, 'DESC'),
(142, 1, 'Vector TD', 'Tower Defense like game', 0, 49, 'vectortdv32MICRO', 'vectortdv32MICRO1.gif', 500, 640, 0, 0, 'DESC'),
(15, 1, 'Solitaire', 'To submit your score, there is a hidden button at the top right of the game. See if you can find it :)', 0, 16, 'solitaire', 'solitaire.gif', 316, 558, 0, 100, 'DESC'),
(16, 1, 'Technobounce', '', 0, 13, 'technobounce_CH', 'technobounce_CH.gif', 460, 560, 0, 400, 'DESC'),
(18, 1, 'Blix', 'Use the buttons to move horizontal lines left or right. You must make columns of same color boxes to win moves - if you don''t, game over.', 0, 8, 'blix', 'blix.gif', 200, 490, 0, 600, 'DESC'),
(20, 1, 'Ponx', 'Move quickly to make bunches or groups of the same colors. You can click and replace position with its neighbor. Click the blue button to collect colored bunches.', 0, 10, 'ponx', 'ponx.gif', 290, 253, 0, 0, 'DESC'),
(23, 1, 'Breakout', '', 0, 29, 'breakoutv2', 'breakoutv2.gif', 400, 550, 0, 150, 'DESC'),
(129, 1, 'Blackjack', '', 0, 3, 'aceblackjack', 'aceblackjack1.gif', 400, 600, 0, 3300, 'DESC'),
(32, 1, 'Slotz', '', 0, 18, 'slotz', 'slotz.gif', 368, 368, 0, 150, 'DESC'),
(125, 1, 'Island Mini-Golf', '', 0, 46, 'islandminigolfBH', 'islandminigolfBH1.gif', 400, 720, 0, 0, 'ASC'),
(39, 1, 'Sportssmash', '', 0, 27, 'sportssmash', 'sportssmash.gif', 380, 665, 0, 0, 'DESC'),
(40, 1, 'Asteroids', '', 0, 15, 'asteroids2_CH', 'asteroids2_CH.gif', 375, 500, 0, 500, 'DESC'),
(153, 0, 'Playing with Fire', 'Use the semi-colon key (;) to place bombs and the arrow keys to move!', 0, 201, 'bomberman', 'playingwithfire.gif', 410, 544, 0, 0, 'DESC'),
(46, 1, 'Burgertime', '', 0, 11, 'burgertime', 'burgertime.gif', 512, 480, 0, 2000, 'DESC'),
(49, 1, 'Ultimate Billiards', '', 0, 36, 'ultbilCH', 'ultbilCH.gif', 470, 550, 0, 150, 'DESC'),
(50, 1, '1i Champi', '', 0, 10, '1i_champi', '1i_champi.gif', 490, 550, 0, 3000, 'DESC'),
(51, 1, 'Whack a Penguin', '', 0, 24, 'bloodypingu', 'bloodypingu.gif', 400, 650, 0, 550, 'DESC'),
(53, 1, 'Quix', '', 0, 8, 'quix_CH', 'quix_CH.gif', 280, 450, 0, 1000, 'DESC'),
(54, 1, 'Znax', '', 0, 33, 'znax_CH', 'znax_CH.gif', 307, 459, 0, 10000, 'DESC'),
(134, 1, 'Bejeweled', '', 0, 11, 'bejeweled', 'bejeweled1.gif', 334, 468, 0, 150, 'DESC'),
(57, 1, 'Collector', '', 0, 9, 'collector', 'collector.gif', 400, 600, 0, 500, 'DESC'),
(126, 1, 'A.L.I.A.S. 2', '', 0, 4, 'alias2JS', 'alias2JS1.gif', 350, 550, 0, 1000, 'DESC'),
(59, 1, 'Airfox', '', 0, 2, 'airfox', 'airfox.gif', 320, 300, 0, 400, 'DESC'),
(149, 1, 'Shuffle', '', 0, 120, 'shuffleGC', 'shuffleGC.gif', 550, 625, 0, 0, 'DESC'),
(69, 1, 'Duckhunt', '', 0, 4, 'duckhunt', 'duckhunt.gif', 393, 450, 0, 5000, 'DESC'),
(71, 1, 'Eskiv', '', 0, 12, 'eskiv', 'eskiv.gif', 300, 400, 0, 50, 'DESC'),
(73, 1, 'Frogger', '', 0, 18, 'frogger2', 'frogger2.gif', 400, 400, 0, 300, 'DESC'),
(136, 1, 'Virus', '', 0, 0, 'virus2', 'virus21.gif', 350, 466, 0, 5250, 'DESC'),
(78, 1, 'Hexxagon', '', 0, 10, 'hexxagon', 'hexxagon.gif', 300, 380, 0, 0, 'DESC'),
(79, 1, 'Invaders', '', 0, 9, 'invaders', 'invaders.gif', 440, 520, 0, 150, 'DESC'),
(80, 1, 'Jewels', '', 0, 10, 'jewels', 'jewels.gif', 405, 490, 0, 1000, 'DESC'),
(81, 1, 'Karts', '', 0, 19, 'karts', 'karts.gif', 270, 570, 0, 1700, 'DESC'),
(84, 1, 'Mahjong', '', 0, 8, 'mahjong', 'mahjong.gif', 473, 650, 0, 300, 'DESC'),
(86, 1, 'Mumu', 'Match up 3 circles of a similar color to gain points!', 0, 6, 'mumu', 'mumu.gif', 255, 355, 0, 100, 'DESC'),
(88, 1, 'Pacman', '', 0, 30, 'pacman', 'pacman.gif', 420, 360, 0, 2000, 'DESC'),
(93, 1, 'Plasmanaut', '', 0, 3, 'plasmanaut', 'plasmanaut.gif', 300, 400, 0, 25, 'DESC'),
(94, 1, 'Plasmanautv2', '', 0, 11, 'plasmanautv2', 'plasmanautv2.gif', 300, 400, 0, 20, 'DESC'),
(95, 1, 'Project Orion', '', 0, 11, 'project_orion', 'project_orion.gif', 500, 650, 0, 12000, 'DESC'),
(98, 1, 'Rsnake', '', 0, 21, 'rsnake', 'rsnake.gif', 320, 320, 0, 25, 'DESC'),
(100, 1, 'Seconds of Madness', '', 0, 34, 'secondsofmadness', 'secondsofmadness.gif', 400, 400, 0, 80, 'DESC'),
(101, 1, 'Simon', '', 0, 29, 'simon', 'simon.gif', 400, 500, 0, 5, 'DESC'),
(103, 1, 'Slots', '', 0, 12, 'slots', 'slots.gif', 226, 582, 0, 150, 'DESC'),
(141, 1, 'UpBeat', 'After finishing the game, DO NOT click the submit button! Rather, let the game automatically send your score. ', 0, 138, 'upbeatGC', 'upbeatGC1.gif', 400, 590, 0, 600, 'DESC'),
(105, 1, 'Snake', '', 0, 40, 'snake', 'snake.gif', 300, 360, 0, 500, 'DESC'),
(107, 1, 'Spacehunter', '', 0, 11, 'spacehunter', 'spacehunter.gif', 400, 550, 0, 300, 'DESC'),
(113, 1, 'Tetris', '', 0, 35, 'tetris', 'tetris.gif', 380, 382, 0, 500, 'DESC'),
(123, 1, 'A.L.I.A.S.', '', 0, 15, 'aliasibpg', 'aliasibpg1.gif', 350, 550, 0, 400, 'DESC'),
(124, 1, 'Megaman', 'Hit 1 and 2 to toggle the background.', 0, 4, 'megaman', 'megaman1.gif', 480, 640, 0, 1000, 'DESC'),
(122, 1, 'Yahtzee', '', 0, 6, 'yahtz', 'yahtz1.gif', 500, 600, 0, 60, 'DESC'),
(130, 1, 'Defend Your Castle', 'Defend your castle by picking up enemies and throwing them into the air. \r\n<br>\r\nGet the temple as early as possible, then drop enemy units gently within your castle to "convert" them and make them work for you!\r\n<br><br>\r\n<a href=http://www.arcadetown.com/defendyourcastle/index.asp>Comprehensive guide here!</a><br><br>\r\nType in the code "splattery" on the main screen to start on level 10!', 0, 70, 'castle', 'castle1.gif', 400, 580, 0, 1000, 'DESC'),
(128, 1, 'Super Flash Mario Bros', '', 0, 21, 'SuperFlashMarioBrosSte', 'SuperFlashMarioBrosSte1.gif', 400, 550, 0, 1500, 'DESC'),
(138, 0, 'Tower Defense 2007', 'kill the creeps before they reach the end of the maze, do this by building attacking towers on the grass around the maze.', 0, 0, 'td2007v32MICRO', 'td2007v32MICRO1.gif', 450, 600, 0, 0, 'DESC'),
(139, 0, 'Qwerty Warriors', 'Type the word that appears below each enemy. Hit the enter key to fire. If the word is spelled correctly, then the enemy will be killed. Survive as long as possible to get the high score!', 0, 0, 'qwertywarriors2', 'qwertywar.gif', 550, 550, 0, 0, 'DESC'),
(140, 1, 'Happy Memory', 'Match the cards with each other... be sure to memorize them before each round quickly!', 0, 15, 'happymemorySte', 'happymemory.gif', 500, 400, 0, 400, 'DESC'),
(143, 0, 'Yeti Bubbles', '', 0, 0, 'yetibub', 'yetibub.gif', 480, 640, 0, 0, 'DESC'),
(144, 0, 'Rat Pinball', '', 0, 1, 'ratpinballGC', 'ratpinballGC.gif', 600, 600, 0, 0, 'DESC'),
(147, 1, 'Gold Miner', '', 0, 339, 'goldminer', 'goldminer.jpg', 510, 600, 0, 800, 'DESC'),
(146, 1, 'Copter Game', '', 0, 247, 'copter', 'heligame.jpg', 340, 550, 0, 300, 'DESC'),
(148, 1, 'Defend Your Inglor', '', 0, 14, 'defendinglor', 'defendinglor.jpg', 400, 640, 0, 0, 'DESC'),
(150, 1, 'Garage Door Tennis', '', 0, 76, 'garagetennis', 'garagetennis1.gif', 400, 540, 0, 5, 'DESC'),
(151, 1, 'Seal Bounce', '', 0, 41, 'sealbounce', 'sealbounce.jpg', 308, 500, 0, 200, 'DESC'),
(152, 1, 'Kitten Cannon', '', 0, 259, 'Kitten_Cannon_Ste', 'Kitten_Cannon_Ste.gif', 400, 650, 0, 0, 'DESC'),
(154, 1, '247 Mini-Golf', '', 0, 3, '247minigolfSte', '247minigolf.gif', 400, 569, 0, 0, 'DESC'),
(155, 1, 'Panda Golf', '', 0, 9, 'pandagolf', 'pandagolf.gif', 400, 600, 0, 0, 'DESC'),
(156, 1, 'Skee Ball', 'Fling your mouse forward to give the ball power.', 0, 278, 'skeeballMT', 'skeeballMT.gif', 498, 618, 0, 0, 'DESC'),
(157, 1, 'Solitaire Golf Slingo', 'Play cards that are within 1 value of the showing card (example, play a JACK on a QUEEN). Click NEW GAME to submit score. ', 0, 3, 'slingogolfibpg', 'slingogolfibpg1.gif', 450, 720, 0, 0, 'DESC'),
(158, 1, 'Blocks', '', 0, 17, 'blocksibpa', 'blocksibpa1.gif', 284, 480, 0, 0, 'DESC'),
(159, 1, 'Slingo', '', 0, 3, 'slingodGC', 'slingodGC1.gif', 400, 600, 0, 0, 'DESC'),
(160, 1, 'Helicopter 2', '', 0, 27, 'helicopter', 'helicopter1.gif', 380, 500, 0, 0, 'DESC');

INSERT INTO `multgames` (`id`, `name`, `short`) VALUES
(1, 'Minesweeper', 'ms'),
(2, 'Checkers', 'ck'),
(3, 'Othello', 'or'),
(4, 'Battleship', 'bs'),
(5, 'Backgammon', 'bg'),
(6, 'Connect Four', 'cf'),
(7, 'Mancala', 'man'),
(8, 'Strategy', 'st');

INSERT INTO `roulette_stats` (`minbet`, `maxbet`, `totHouseProfit`, `totPlays`) VALUES
(1, 10000, 755, 32);

INSERT INTO `settings` (`conf_id`, `conf_name`, `conf_value`) VALUES
(11, 'staff_pad', ''),
(13, 'game_name', 'MrWQ'),
(19, 'domain', 'MrWQ.com'),
(15, 'paypal', 'admin@mrwq.com'),
(18, 'version', '1.0'),
(17, 'welcome_mail', '');

INSERT INTO `slots_stats` (`plays`, `houseprofit`, `jackpot7`, `jackpotbar`, `minbet`, `maxbet`) VALUES
(279, -381, 2454, 80, 1, 10000);

INSERT INTO `videopoker_stats` (`houseProfit`, `totalPlays`, `minbet`, `maxbet`) VALUES
(203, 230, 1, 10000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
