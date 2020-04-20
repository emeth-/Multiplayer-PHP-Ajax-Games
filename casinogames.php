<?php
$casino=1;
include "globals.php";
print"<center>";

print"<table class='table'>";
print"<tr><th colspan=6>Game: <a href='s_pp_game.php'>Poker Patience</a> (<a href='s_pp_game.php?act=highscores'>High Scores</a>)</th></tr>";

print"</table><br /><br />";

print"<table class='table'>";
print"<tr><th colspan=6>Game: <a href='videopoker.php'>Video Poker</a></th></tr>";
print"</table><br /><br />";

print"<table class='table'>";
print"<tr><th colspan=6>Game: <a href='blackjack.php'>Blackjack</a></th></tr>";
print"</table><br /><br />";

print"<table class='table'>";
print"<tr><th colspan=6>Game: <a href='roulette.php'>Roulette</a></th></tr>";
print"</table><br /><br />";

print"<table class='table'>";
print"<tr><th colspan=6>Game: <a href='slots.php'>Slots</a></th></tr>";
print"</table><br /><br />";
print"</center>";


$h->endpage();
?>
