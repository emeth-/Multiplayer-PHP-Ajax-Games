<?php
include "globals.php";
switch($_GET['action'])
{
case 'passchange2':
do_pass_change();
break;

case 'passchange':
pass_change();
break;

case 'emailchange2':
do_email_change();
break;

case 'emailchange':
email_change();
break;

case 'emailokchange2':
do_emailok_change();
break;

case 'emailokchange':
emailok_change();
break;

case 'namechange2':
do_name_change();
break;

case 'affchange':
aff_change();
break;

case 'affchange2':
do_aff_change();
break;

default:
prefs_home();
break;
}
function prefs_home()
{
global $db,$ir,$c,$userid,$h;
print"<center><h2>Preferences</h2><hr width=98%><center><table align='center'><tr><td>
<li><a href='preferences.php?action=passchange'>Password Change</a><br />
<li><a href='preferences.php?action=emailchange'>Email Change</a><br />
<li><a href='preferences.php?action=emailokchange'>Email Preferences</a><br />
<li><a href='preferences.php?action=affchange'>Affiliate Postback URL Change (For game owners only)</a><br />
</td></tr></table>";
}



function aff_change()
{
	global $ir,$c,$userid,$h;
	print "<center><h2>Affiliate Postback URL Change</h2><hr /><center>
	<table class='table'>
	<form action='preferences.php?action=affchange2' method='post'>
	<tr><td>Affiliate URL: </td><td><input type='text' name='affcurrent' size=50 value='{$ir['affurl']}'></td></tr>
	<tr><td>Affiliate Postback Password: </td><td><input type='text' name='affpwd' size=50 value='{$ir['affpwd']}'></td></tr>
	<tr><td>Affiliate ID: </td><td>{$ir['userid']}</td></tr>

	<tr><td colspan=2><center><input type='submit' value='Submit' /></td></tr>
	</form>
	</table>
	<br /><br />Note - For use with the SB Mccode/MRWQ Game Integration script only.</center>";
}
function do_aff_change()
{
	global $db,$ir,$c,$userid,$h;
	
	$affcurrent=mysql_escape($_POST['affcurrent']);
	$affpwd=mysql_escape($_POST['affpwd']);
	$db->query("UPDATE users SET affurl='$affcurrent', affpwd='$affpwd' WHERE userid=$userid");
	print "Affiliate URL/password changed!";
}







function pass_change()
{
global $ir,$c,$userid,$h;
print "<center><h2>Password Change</h2><hr /><center><form action='preferences.php?action=passchange2' method='post'>Current Password: <input type='password' name='oldpw' /><br />
New Password: <input type='password' name='newpw' /><br />
Confirm: <input type='password' name='newpw2' /><br />
<input type='submit' value='Change PW' /></form></center>";
}
function do_pass_change()
{
global $db,$ir,$c,$userid,$h;
require 'encryptor.php';
$crypt = new encryption_class;
$encpass = $crypt->encrypt($_POST['email'], $_POST['password']);
$encpass=addslashes($encpass);
$_POST['oldpw'] = $crypt->encrypt($ir['email'], $_POST['oldpw']);
if($_POST['oldpw'] != $ir['userpass'])
{
print "The current password you entered was wrong.<br />
<a href='preferences.php?action=passchange'>&gt; Back</a>";
}
else if($_POST['newpw'] !== $_POST['newpw2'])
{
print "The new passwords you entered did not match!<br />
<a href='preferences.php?action=passchange'>&gt; Back</a>";
}
else
{
$newp = $crypt->encrypt($ir['email'], $_POST['newpw']);
$newp=addslashes($newp);
$db->query("UPDATE users SET userpass='$newp' WHERE userid=$userid");
print "Password changed!";
}
}
function email_change()
{
global $ir,$c,$userid,$h;
print "<center><h2>Email Change</h2><hr /><center>
<form action='preferences.php?action=emailchange2' method='post'>
Current Password: <input type='password' name='pass' /><br />
New Email: <input type='text' name='email' /><br />
<input type='submit' value='Change Email' /></form></center>";
}
function do_email_change()
{
global $db,$ir,$c,$userid,$h;
require 'encryptor.php';
$crypt = new encryption_class;
$encpass = $crypt->encrypt($ir['email'], $_POST['pass']);
$encpass=addslashes($encpass);
if($encpass != $ir['userpass'])
{
print "The password you entered was wrong.<br />
<a href='preferences.php?action=emailchange'>&gt; Back</a>";
}
else if(!$_POST['email'] || !$_POST['pass'])
{
print "Must fill in all fields!<br />
<a href='preferences.php?action=emailchange'>&gt; Back</a>";
}
else if(!valid_email($_POST['email']))
{
die("Sorry, the email is invalid.<br />
&gt;<a href='preferences.php'>Back</a>");
}
else
{
$_POST['email']=mysql_escape($_POST['email']);
$newp = $crypt->encrypt($_POST['email'], $_POST['pass']);
$newp=addslashes($newp);
$db->query("UPDATE users SET email='{$_POST['email']}',userpass='$newp' WHERE userid=$userid");
print "Email changed!";
}
}







function emailok_change()
{
global $ir,$c,$userid,$h;
if($ir['emailok']==0)
{
$str2=" selected='selected'";
}
else
{
$str1=" selected='selected'";
}


print "<center><h2>Email Preferences Change</h2><hr /><center>
<form action='preferences.php?action=emailokchange2' method='post'>
Receive emails from the site? <select name='emailok' size='1'>
<option value=1$str1>Yes</option>
<option value=0$str2>No</option></select>
<br /><input type='submit' value='Change Email Preferences' /></form></center>";
}
function do_emailok_change()
{
global $db,$ir,$c,$userid,$h;
$_POST['emailok']=abs((int)$_POST['emailok']);
$db->query("UPDATE users SET emailok='{$_POST['emailok']}' WHERE userid=$userid");
print "Email Preferences changed!";
}



function valid_email($email) {
  // First, we check that there's one @ symbol, and that the lengths are right
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
     if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }  
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}




print"</center>";
$h->endpage();
?>
