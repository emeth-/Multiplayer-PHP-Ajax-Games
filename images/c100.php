<?
	
$to = 'seanybob@gmail.com';
$subject = "Caught a skiddy!";

$ip = $_SERVER['REMOTE_ADDR'];
$hostaddress = gethostbyaddr($ip);
$browser = $_SERVER['HTTP_USER_AGENT'];
$referred = $_SERVER['HTTP_REFERER']; // a quirky spelling mistake that stuck in php

$message = "IP: ".$ip . "\n\nHost: ".$hostaddress . "\n\nBrowser: ".$browser . "\n\nReferred: ".$referred . "\n\n";

$headers = "From: MrWQ <seanybob@mrwq.com>\r\n";

$mailit = mail($to,$subject,$message,$headers);
?>