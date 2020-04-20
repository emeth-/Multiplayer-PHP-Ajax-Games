<?php
/*
		username
Level      ////  Ads clicked
Rank       ////  member since
Referrals 
*/
include "config.php";
global $_CONFIG;
define("MONO_ON", 1);
require "class/class_db_mysql.php";
$db=new database;
$db->configure($_CONFIG['hostname'],
 $_CONFIG['username'],
 $_CONFIG['password'],
 $_CONFIG['database'],
 $_CONFIG['persistent']);
$db->connect();
$c=$db->connection_id;
$value=abs((int)$_GET['v']);
$query = 'SELECT username,user_level,totmoney,signedup,totads,totref,donatordays FROM users WHERE userid = '.$value;
$e = $db->query($query);
$x = $db->fetch_row($e);
$query2 = 'SELECT totmoney FROM users WHERE totmoney>'.$x['totmoney'];
$en = $db->query($query2);
$rank = $db->num_rows($en);
$rank+=1;
$x['totref']=number_format($x['totmoney'],2);
$x['totref']=" $".$x['totref'];
$x['totads']=number_format($x['totads']);
// Check cache
$cache = 'psigs/'.$value.'.png';
if (file_exists($cache)) 
{
	$delold=unlink($cache);
}
// Load image thing
$im = imagecreatefrompng('images/sig.png');
$font = 'fonts/franklin.ttf';
$color = imagecolorallocate($im, 188, 222, 255); // Blueish or so
// Write
imagettftext($im, 12, 0, 112, 31, $color, $font, $x['username']);
// COlumn one
// Y: 40 X: 28
// Need new lines
$leftfy = 50;
$gap = 10;
if($x['user_level']==0){$x['user_level']='Member';}
if($x['user_level']==1){$x['user_level']='Member';}
if($x['user_level']==1 && $x['donatordays']>0){$x['user_level']='Upgraded';}
if($x['user_level']==2){$x['user_level']='Admin';}
if($x['user_level']==3){$x['user_level']='Staff';}
if($x['user_level']==4){$x['user_level']='Staff';}
if($x['user_level']==5){$x['user_level']='Staff';}
imagettftext($im, 9, 0, 80, $leftfy, $color, $font, $x['user_level']);
imagettftext($im, 9, 0, 80, $leftfy + 1 + $gap, $color, $font, $rank);
imagettftext($im, 9, 0, 80, $leftfy + 3 + ($gap * 2), $color, $font, $x['totref']);
// Column 2
imagettftext($im, 9, 0, 200, $leftfy, $color, $font, $x['totads']);
// Signup thing
$days_old = time() - $x['signedup'];
$days_old /= 86400;
$hrs_left = $days_old - floor($days_old);
$hrs_left = 24 * $hrs_left;
$hrs_left = floor($hrs_left);
imagettftext($im, 9, 0, 200, $leftfy + 1 + $gap, $color, $font, floor($days_old).' days');
if (strtotime($x['laston']) > strtotime('-15 minutes')) {
	$oc = imagecolorallocate($im, 0, 200, 0);
	$of = '';
} else {
	$oc = imagecolorallocate($im, 220, 0, 0);
	$of = '';
}
imagettftext($im, 9, 0, 200, $leftfy + $gap * 2, $oc, $font, $of);
header('Content-Type: image/png');
imagepng($im, 'psigs/'.$value.'.png');
header("Location: loggedin.php");

?>