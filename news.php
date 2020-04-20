<?php
$home=1;
include "globals.php";

$signedup=$ir['signedup'];
$threedaysago=time() - (60 * 60 * 24 * 3);

if($wbstw==1 && $signedup<$threedaysago)
{
print"<center><b>Welcome,  {$ir['username']}!</b><br />
<em>Your last visit was: $lv.</em><hr width=98%></center>";
}

if($signedup>$threedaysago)
{
echo <<<EOF
<table width=90%><tr><td>
<p><b>Welcome to the MrWQ Community!</b></p>
To start earning money, click on the <a href=offers.php>Available Offers</a> button. Looking to kill time? Check out our <a href=arcade.php>Arcade</a> or <a href=casinogames.php>Casino Games</a>. <br /><br />
Any questions/comments? Get to know our community in the <a href=forums/index.php>forums</a>!
</td></tr></table>
EOF;
}

print"<center><h2>News</h2><hr width=98%><center>";
$ac=$ir['new_announcements'];
$q=$db->query("SELECT * FROM announcements ORDER BY a_time DESC LIMIT 10");
print "<table width='80%' cellspacing='1' class='table'>
<tr>
<th>Time</th>
<th>Announcement</th>
</tr>";
while($r=$db->fetch_row($q))
{
if($ac > 0)
{
$ac--;
$new="<br /><b>New!</b>";
}
else
{
$new="";
}
print "<tr><td valign=top><font size=1><center>".date('F j Y, g:i:s a', $r['a_time']).$new."</font></td><td valign=top>&nbsp;<br />&nbsp;{$r['a_text']}<br />&nbsp;</td></tr>";
}
print "</table>";
if($ir['new_announcements'])
{
$db->query("UPDATE users SET new_announcements=0 WHERE userid={$userid}");
}
print"</center><br /><br />";

$h->endpage();
?>
