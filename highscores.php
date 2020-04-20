<?PHP
$forums=1;
require "globals.php";

// Arrange url variables
$gameid = abs($_GET['id']);
$_GET['scoid']=abs((int)$_GET['scoid']);
if($_GET['scoid'])
{
if($ir['user_level']!=2 && $ir['user_level']!=3){die();}
$staffst=$db->fetch_row($db->query("SELECT * FROM highscores WHERE id={$_GET['scoid']}"));
$secondss=$staffst['endTime']-$staffst['startTime'];
$s2=$secondss%60;
$secondss-=$s2;
$secondss=$secondss/60;
stafflog_add("Deleted score - User({$staffst['userid']}) - Game({$staffst['gameid']}) - Score({$staffst['score']}) - Time($secondss min)");
$db->query("DELETE FROM highscores WHERE id={$_GET['scoid']}");
print"<font color=red>Score Deleted!</font><br />";
}
$_GET['scoreid']=abs((int)$_GET['scoreid']);
if($_GET['scoreid'])
{
if($ir['user_level']!=2 && $ir['user_level']!=3){die();}
$staffst=$db->fetch_row($db->query("SELECT * FROM highscores WHERE id={$_GET['scoreid']}"));
$secondss=$staffst['endTime']-$staffst['startTime'];
$s2=$secondss%60;
$secondss-=$s2;
$secondss=$secondss/60;
stafflog_add("Deleted/Warned score - User({$staffst['userid']}) - Game({$staffst['gameid']}) - Score({$staffst['score']}) - Time($secondss min)");
$uid=$db->fetch_row($db->query("SELECT userid FROM highscores WHERE id={$_GET['scoreid']}"));
$_POST['userid']=$uid['userid'];
$atemp=$db->query("SELECT lastip FROM users WHERE userid={$_POST['userid']}");
$btemp=$db->fetch_row($atemp);
$db->query("DELETE FROM highscores WHERE userid={$_POST['userid']}");
$db->query("INSERT INTO arcadewarn VALUES('',{$_POST['userid']},'{$btemp['lastip']}')");
$db->query("UPDATE users SET new_mail=new_mail+1 WHERE userid={$_POST['userid']}");
$msg="This is a warning for cheating in the arcade. If you get three warnings, you will be banned from the arcade. If you feel you got this in error, feel free to contact an admin.";
$db->query("INSERT INTO mail VALUES ('',0,0,{$_POST['userid']},unix_timestamp(),'Cheating in the arcade','$msg')") or die(mysql_error());

print"<font color=red>Score deleted and user warned!</font><br />";
}
// Security check
$gameinfo = mysql_fetch_array(mysql_query("SELECT * FROM flash2 WHERE id = '$gameid'"));
$stype=$gameinfo['sortmethod'];
if(!$gameinfo[id])
{
print"game not found";
}

echo "<center>
<a href=game.php?id=$gameinfo[id]><img src=arcadefiles/{$gameinfo['imagename']} height=60 width=60></a>
<h3 style=\"padding: 0;margin:0; padding-top: 15px\">$gameinfo[game] High Scores</h3>
";
//<font size=1>(At the end of every month, trophies are awarded, <br>and the top 3 players of each game get cash prizes)</font><br />

$sc = $db->query("SELECT * FROM highscores WHERE gameid = '$gameid' ORDER BY score $stype, id ASC LIMIT 20");
print"<table width=80% class='table'><tr><th>Rank<br /><img src=images/rank.jpg></th><th width=70%>Name</th><th>Score<br /><img src=images/rank.jpg></th>";
if($ir['user_level']>1 && $ir['user_level']<5){print"<th>Duration<br /><img src=images/rank.jpg></th>";}
if($ir['user_level']==2 || $ir['user_level']==3){print"<th>Action</th>";}
print"</tr>";
$i=0;
while($sco = $db->fetch_row($sc))
{
$i++;
$u = $db->query("SELECT username FROM users WHERE userid={$sco['userid']}");
$u2 = $db->fetch_row($u);
$sco['score']=number_format($sco['score']);
print"<tr><td>$i.</td><td><center>{$u2['username']}</center></td><td><center>{$sco['score']}</center></td>";
if($ir['user_level']>1 && $ir['user_level']<5)
{
$seconds=$sco['endTime']-$sco['startTime'];
$s2=$seconds%60;
$seconds-=$s2;
$seconds=$seconds/60;
print"<td>$seconds min</td>";
}
if($ir['user_level']==2 || $ir['user_level']==3)
{
print"<td width=20%>-<a href=highscores.php?scoid={$sco['id']}&act=del&id=$gameid>Delete single</a><br />
-<a href=highscores.php?scoreid={$sco['id']}&act=del&id=$gameid>Delete all</a>
</td>";
}
print"</tr>";
}
print"</table>
<br />
&gt;<a href=arcade.php>Back to Arcade</a>
<br /><br />
<font size=1>*<font color=red>Note</font> - Each user can only hold one spot per high score board.</font>
<br /><br />";
$h->endpage();
?>