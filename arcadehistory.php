<?php
require "globals.php";
if($ir['guest']==1){die("Must have a Facebook account linked.");}
print"
<br />
<center><h2>Arcade History</h2> &gt;<a href='arcade.php'>Go to Arcade</a><br /><br />";

$friends = $user->fbc_get_connected_friends_sb(FALSE);
$friends[] = $ir['userid'];
$friendids = implode(",", $friends);
//userid IN ($friendids)
$ahc = $db->query("SELECT * FROM flashscores WHERE userid>0 AND score>0 ORDER BY endTime DESC LIMIT 100");
$howmany = $db->num_rows($ahc);
if(!$howmany)
{
	print"You and your friend's have no activity in the arcade yet! <a href='arcade.php'>Go play some games!</a>";
}
else
{
	print"<table class='table'><tr><th colspan=2>Last $howmany games played</th></tr>";
	while($ah = $db->fetch_row($ahc))
	{
		$gam=$db->fetch_row($db->query("SELECT imagename,game FROM flash2 WHERE id={$ah['gameid']}"));
		$usr=$db->fetch_row($db->query("SELECT username FROM users WHERE userid={$ah['userid']}"));
		$ah['score'] = (float) $ah['score'];
		$ah['score'] = number_format($ah['score']);
		print"<tr><td align='center'>".nicetime($ah['endTime'])."</td><td><a href='http://www.facebook.com/profile.php?id={$ah['userid']}' target='_blank'>{$usr['username']}</a> scored {$ah['score']} on the game <a href='game.php?id={$ah['gameid']}'>{$gam['game']}</a>.</td></tr>";
	}
	print"</table>";
}

$h->endpage();




function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
   
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
   
    $now             = time();
    $unix_date         = $date;
   
       // check validity of date
    if(empty($unix_date)) {   
        return "Bad date";
    }

    // is it future date or past date
    if($now >= $unix_date) {   
        $difference     = $now - $unix_date;
        $tense         = "ago";
       
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
   
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
   
    $difference = round($difference);
   
    if($difference != 1) {
        $periods[$j].= "s";
    }
   
    return "$difference $periods[$j] {$tense}";
}



?>