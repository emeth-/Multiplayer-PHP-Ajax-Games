<?php

$pre = preg_replace("/[^a-z]/", "", $_GET['pre']);
$pre = substr($pre, 0, 4); 

if (file_exists($pre."_config.php")) 
{
    include $pre."_config.php";
} else 
{
    die("Error.");
}


// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");

$gamepage=$gpres;
session_start();
require_once "config.php";
require_once "global_func.php";
global $_CONFIG;
define("MONO_ON", 1);
require_once "class/class_db_mysql.php";
$db=new database;
$db->configure($_CONFIG['hostname'],
 $_CONFIG['username'],
 $_CONFIG['password'],
 $_CONFIG['database'],
 $_CONFIG['persistent']);
$db->connect();
$c=$db->connection_id;


$_POST['chattxt']=mysql_escape($_POST['chattxt']);
$id=abs((int)$_POST['id']);
if(!$id)
{
    $id=abs((int)$_GET['id']);
}

$is=$db->query("SELECT * FROM users WHERE userid={$_SESSION['userid']}");
$ir=$db->fetch_row($is);
$userid=$ir['userid'];

$goodroom = $db->num_rows($db->query("SELECT id FROM {$gpre}room WHERE (p1=$userid OR p2=$userid) AND id=$id"));
if(!$goodroom){die('Error. Bad room ID.');}

print"<table class='table' width=100%>";
$pcha=$db->query("SELECT txt,timestamp FROM {$gpre}chat WHERE {$gpre}room=$id ORDER BY timestamp DESC LIMIT 5");
while($pchat=$db->fetch_row($pcha))
{
	$pchat['txt']=stripslashes($pchat['txt']);
	$result = nicetime($pchat['timestamp']); // 2 days ago
	print "<tr><td>$result</td><td>{$pchat['txt']}</td></tr>
";
}

print"</table>";


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