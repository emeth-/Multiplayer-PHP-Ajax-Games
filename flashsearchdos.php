<?php

require "globals.php";
$search=mysql_escape($_POST['search']);
$page=mysql_escape($_POST['page']);
if($search == "")
{
echo "<h1>Search Games</h1><center>Please type in the most accurate game title description to find your favourite games.<br>
<form action=flashsearchdos.php?page=search method=post>Game Title: <input type=text name=search> <input type=submit value='Search'></form></center>";
}

else 
{
// Strip HTML tags
$search = strip_tags($search);

// Find games
$sql = "SELECT game FROM flash2 WHERE game LIKE '%$search%' ORDER BY game DESC LIMIT 10";

$countmatches = mysql_num_rows(mysql_query("$sql"));

$findgames = mysql_query("SELECT imagename,game,id FROM flash2 WHERE game LIKE '%$search%' ORDER BY game DESC LIMIT 10");

echo "<center><h1>Search Results</h1>
We have found $countmatches matches for your search results. The more specific the search phrase, the better your results will be.<br><br>

<table border=0 cellspacing=10 cellpadding=0 border=0><tr>";

$counter = 0;

while($game = mysql_fetch_array($findgames))
{
// Next row
if($counter == 3)
{
echo "</tr><tr>";

// Reset counter
$counter = 0;
}

echo "<td><table>
<tr>
<td>
<font size=1><a href=game.php?id=$game[id] title=\"$game[game]\"><center>
<img src=/arcadefiles/{$game['imagename']} height=60 width=60></a><br />
<li><a href=game.php?id=$game[id] title=\"$game[game]\">$game[game]</center></a>
<li><a href=highscores.php?id=$game[id]>View High Scores</a></center>
</font></td>
</tr>						
</table></td>";

$counter ++;
}


echo "</tr></table>";

}
print"<br /><br />";
$h->endpage();
?>