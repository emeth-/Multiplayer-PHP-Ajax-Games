<?php

$gprefix = preg_replace("/[^a-z]/", "", $_GET['g']);
$gprefix = substr($gprefix, 0, 4); 



if (file_exists($gprefix."_config.php")) 
    include $gprefix."_config.php";
else 
    die("Error.");


include "globals.php";

$_GET['st'] = abs((int) $_GET['st']);
$st=($_GET['st']) ? $_GET['st'] : 0;

if($_GET['type']=='ratio'){$by='ratio';$byratb = "<b>";$byratbe = "</b>";}
else if($_GET['type']=='wins'){$by='wins';$bywinb = "<b>";$bywinbe = "</b>";}
else{$by='rating';$bytingb = "<b>";$bytingbe = "</b>";}

if($_GET['ord']=='ASC'){$order = 'ASC';$lfb="<b>";$lfbe="</b>";}
else{$order = 'DESC';$hfb="<b>";$hfbe="</b>";}

$byuserid=abs((int)$_GET['userid']);

print "<center><h3><a href='sb_rooms.php?g={$gprefix}'>{$gamename} Hall of Fame</a></h3>
<a href='?g={$gpres}&type=ratings'>{$bytingb}Ratings{$bytingbe}</a> |
 <a href='?g={$gpres}&type=ratio'>{$byratb}Ratio{$byratbe}</a>
 | <a href='?g={$gpres}&type=wins'>{$bywinb}Wins{$bywinbe}</a><br /><br />";

$cnt=$db->query("SELECT * FROM {$gpre}ranks ORDER BY {$by} {$order}");
$membs=$db->num_rows($cnt);
$pages=(int) ($membs/50)+1;
if($membs % 100 == 0)
{
$pages--;
}
print "Pages: ";
for($i=1;$i<=$pages;$i++)
{
$pst=($i-1)*50;
print "<a href='?g={$gpres}&type=$by&ord=$order'>";
if($pst == $st) { print "<font color='#33cc33'>"; }
print $i;
if($pst == $st) { print "</font>"; }
print "</a>&nbsp;";
if($i % 25 == 0) { print "<br />"; }
}
print"
<a href='?g={$gpres}&type=$by&ord=DESC'>{$hfb}Highest First{$hfbe}</a>&nbsp;
| <a href='?g={$gpres}&type=$by&ord=ASC'>{$lfb}Lowest First{$lfbe}</a><br /><br />";

if($byuserid)
	$q=$db->query("SELECT u.*,r.* FROM users u LEFT JOIN {$gpre}ranks r ON u.userid=r.userid WHERE r.userid=$byuserid");
else
	$q=$db->query("SELECT u.*,r.* FROM users u LEFT JOIN {$gpre}ranks r ON u.userid=r.userid WHERE r.userid>0 ORDER BY r.{$by} $order LIMIT $st,50");

$no1=$st+1;
$no2=$st+50;
print "Showing $txt $no1 to $no2
<table width=75% cellspacing=1 class='table'><tr style='background:gray'>
<th>Name</th><th>Rating</th><th>Win Ratio</th><th>Wins</th><th>Losses</th>
<th>Ties</th><th>Total Games</th></tr>";
while($r=$db->fetch_row($q))
{
$d="";
$r['ratio']=(int)(100*$r['ratio']);
print "<tr>
<td><a href='http://www.facebook.com/profile.php?id={$r['userid']}' target='_blank'>{$r['username']}</a></td>
<td align=center>{$r['rating']}</td>
<td align=center>{$r['ratio']}%</td>
<td align=center>{$r['wins']}</td>
<td align=center>{$r['losses']}</td>
<td align=center>{$r['ties']}</td>
<td align=center>{$r['totgames']}</td>
";



print"</tr>";
}
print "</table></center>";

$h->endpage();
?>