<?php
require 'encryptor.php';
$crypt = new encryption_class;
include "config.php";
global $_CONFIG,$affID;
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
$set=array();
$settq=$db->query("SELECT * FROM settings");
while($r=$db->fetch_row($settq))
{
$set[$r['conf_name']]=$r['conf_value'];
}
$q2=$db->query("SELECT totcash,top5earn,last5co,totusers FROM cashin");
$r=$db->fetch_row($q2);

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
session_start();
$IP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
if(file_exists('ipbans/'.$IP))
{
die("<b><font color=red size=+1>Your IP has been banned, there is no way around this.</font></b></body></html>");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MrWQ</title>
<link type="text/css" rel="Stylesheet" href="./css/master.css" />
<script language="JavaScript" type="text/javascript">

function changeCountry() {
	if( document.signup.country.value == 'United States of America' ) {
		document.signup.zipcode.disabled = false;
		document.signup.zipcode.value = '';
	} else {
		document.signup.zipcode.disabled = true;
		document.signup.zipcode.value = '';			
	}
}

</script>

<script type="text/javascript">
var xmlHttp // xmlHttp variable

function GetXmlHttpObject(){ // This function we will use to call our xmlhttpobject.
var objXMLHttp=null // Sets objXMLHttp to null as default.
if (window.XMLHttpRequest){ // If we are using Netscape or any other browser than IE lets use xmlhttp.
objXMLHttp=new XMLHttpRequest() // Creates a xmlhttp request.
}else if (window.ActiveXObject){ // ElseIf we are using IE lets use Active X.
objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP") // Creates a new Active X Object.
} // End ElseIf.
return objXMLHttp // Returns the xhttp object.
} // Close Function

function CheckPasswords(password){ // This is our fucntion that will check to see how strong the users password is.
xmlHttp=GetXmlHttpObject() // Creates a new Xmlhttp object.
if (xmlHttp==null){ // If it cannot create a new Xmlhttp object.
alert ("Browser does not support HTTP Request") // Alert Them!
return // Returns.
} // End If.

var url="check.php?password="+escape(password) // Url that we will use to check the password.
xmlHttp.open("GET",url,true) // Opens the URL using GET
xmlHttp.onreadystatechange = function () { // This is the most important piece of the puzzle, if onreadystatechange = equal to 4 than that means the request is done.
if (xmlHttp.readyState == 4) { // If the onreadystatechange is equal to 4 lets show the response text.
document.getElementById("passwordresult").innerHTML = xmlHttp.responseText; // Updates the div with the response text from check.php
} // End If.
}; // Close Function
xmlHttp.send(null); // Sends NULL insted of sending data.
} // Close Function.

function CheckUsername(password){ // This is our fucntion that will check to see how strong the users password is.
xmlHttp=GetXmlHttpObject() // Creates a new Xmlhttp object.
if (xmlHttp==null){ // If it cannot create a new Xmlhttp object.
alert ("Browser does not support HTTP Request") // Alert Them!
return // Returns.
} // End If.

var url="checkun.php?password="+escape(password) // Url that we will use to check the password.
xmlHttp.open("GET",url,true) // Opens the URL using GET
xmlHttp.onreadystatechange = function () { // This is the most important piece of the puzzle, if onreadystatechange = equal to 4 than that means the request is done.
if (xmlHttp.readyState == 4) { // If the onreadystatechange is equal to 4 lets show the response text.
document.getElementById("usernameresult").innerHTML = xmlHttp.responseText; // Updates the div with the response text from check.php
} // End If.
}; // Close Function
xmlHttp.send(null); // Sends NULL insted of sending data.
} // Close Function.

function CheckEmail(password){ // This is our fucntion that will check to see how strong the users password is.
xmlHttp=GetXmlHttpObject() // Creates a new Xmlhttp object.
if (xmlHttp==null){ // If it cannot create a new Xmlhttp object.
alert ("Browser does not support HTTP Request") // Alert Them!
return // Returns.
} // End If.

var url="checkem.php?password="+escape(password) // Url that we will use to check the password.
xmlHttp.open("GET",url,true) // Opens the URL using GET
xmlHttp.onreadystatechange = function () { // This is the most important piece of the puzzle, if onreadystatechange = equal to 4 than that means the request is done.
if (xmlHttp.readyState == 4) { // If the onreadystatechange is equal to 4 lets show the response text.
document.getElementById("emailresult").innerHTML = xmlHttp.responseText; // Updates the div with the response text from check.php
} // End If.
}; // Close Function
xmlHttp.send(null); // Sends NULL insted of sending data.
} // Close Function.

function PasswordMatch()
{
pwt1=document.getElementById('pw1').value;
pwt2=document.getElementById('pw2').value;
if(pwt1 == pwt2)
{
document.getElementById('cpasswordresult').innerHTML="<font color='green'>OK</font>";
}
else
{
document.getElementById('cpasswordresult').innerHTML="<font color='red'>Not Matching</font>";
}
}
</script>
</head>

<body>
<div id="wrapper">
	<div id="nav">
		<div id="logo">
			<img src="./img/logo.jpg" width="55" height="15" alt="MRWQ" />
			<br /><span id="logo_text">Get paid for surveys, games, polls, and more!</span>
		</div>
		<form id="login" action="authenticate.php" method="post">			
			Email:
			<input class="field" type="text"name="email" />
			Password:
			<input class="field" type="password" name="password" />
			<input name="login" value="Login" class="log_btn" alt="submit" type="submit" /><br />
			<div id="fpassword"><span id="logo_text"><a href="login.php?a=forgot">Forgot Password?</a></span></div>
		</form>
	</div>
	<div id="graphic">
		<img src="./img/top-graphic.jpg" width="874" height="168" alt="MrWQ" />
	</div>
	<div id="main_links">
		<ul>
			<li><a href="login.php"><span>Home</span></a></li>
			<li class="current"><a href="register.php"><span>Register</span></a></li>
			<li><a href="login.php?a=faq"><span>FAQ</span></a></li>
			<li><a href="login.php?a=contactus"><span>Contact Us</span></a></li>
		</ul>
	</div>
	<div id="left_nav">
		<table>
			<tr>
				<td class="header" colspan="2">Top 5 Earners</td>
			</tr>
		<?php
			print $r['top5earn'];
		?>
		</table>
		<table>
			<tr>
				<td class="header" colspan="2">Most Recent Cashouts</td>
			</tr>
		<?php
			print $r['last5co'];
		?>
		</table>

		<?php
			$membs=number_format($r['totusers']);
			$totalb=$r['totcash'];
/*

		<table>
			<tr>
				<td class="header" colspan="2">Statistics</td>
			</tr>
			<tr>
				<td class="sub" colspan="2">Members: <?php print $membs; ?></td>
			</tr>
			<tr>
				<td class="sub" colspan="2">Cash Earned: $<?php print number_format($totalb,2); ?></td>
			</tr>
		</table>
*/
		?>
	</div>
	<div id="content">
<?php
if(!$_POST['zipcode'] || $_POST['country']!='United States of America'){$_POST['zipcode']=0;}

			$IP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
			$la=$db->fetch_row($db->query("SELECT * FROM registerattempts WHERE ip='$IP'"));

			if($_POST['username'])
			{

			if($la['times']>3)
			{
			die("Sorry, this IP address has registered too many accounts recently. Please come back later.<br />
			&gt;<a href='register.php'>Back</a>");
			}
			if(!valid_email($_POST['email']))
			{
			die("Sorry, the email is invalid.<br />
			&gt;<a href='register.php'>Back</a>");
			}
			if (!preg_match("/^[a-zA-Z0-9]*$/", trim($_POST['username']))) 
			{
			die("Sorry, the username has invalid characters. Only numbers and letters are allowed.<br />
			&gt;<a href='register.php'>Back</a>");
			}
			if(strlen($_POST['username']) < 4)
			{
			die("Sorry, the username is too short.<br />
			&gt;<a href='register.php'>Back</a>");
			}
			if($_POST['country']=='United States of America' && !$_POST['zipcode'])
			{
			die("USA residents must fill in their zip code.<br />
			&gt;<a href='register.php'>Back</a>");
			}
			if($_POST['country']=='United States of America' && $_POST['zipcode'])
			{
				if(!is_numeric($_POST['zipcode']))
				{
				die("Not a valid zip code.<br />
				&gt;<a href='register.php'>Back</a>");
				}
				$qll=$db->query("SELECT * FROM zipcodes WHERE zipcode={$_POST['zipcode']}");
				if(!$db->num_rows($qll))
				{
				die("Not a valid zip code.<br />
				&gt;<a href='register.php'>Back</a>");
				}
			}
			$username=$_POST['username'];
			$username=str_replace(array("<", ">"), array("&lt;", "&gt;"), $username);
			$q=$db->query("SELECT * FROM users WHERE username='{$username}'");
			$q2=$db->query("SELECT * FROM users WHERE email='{$_POST['email']}'");
			if($db->num_rows($q))
			{
			print "Username already in use. Choose another.<br />
			&gt;<a href='register.php'>Back</a>";
			}
			else if($db->num_rows($q2))
			{
			print "E-Mail already in use. Choose another.<br />
			&gt;<a href='register.php'>Back</a>";
			}
			else if($_POST['password'] != $_POST['cpassword'])
			{
			print "The passwords did not match, go back and try again.<br />
			&gt;<a href='register.php'>Back</a>";
			}
			else if(!$_POST['password'] || $_POST['password']=='')
			{
			print "You can not have a blank password!<br />
			&gt;<a href='register.php'>Back</a>";
			}
			else
			{
			$_POST['ref'] = abs((int) $_POST['ref']);
			$IP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
			$q=$db->query("SELECT * FROM users WHERE lastip='$IP' AND userid={$_POST['ref']}");
			if($db->num_rows($q))
			{
				die("Please don't attempt to create referral multi accounts. This just gives the admins more work. Thank you.<br />
				&gt;<a href='register.php'>Back</a>");
			}
			$ref=0;
			if($_POST['ref']) 
			{
				$ref=$_POST['ref'];
			}
			$olpass=$_POST['password'];
			$verifypass=generatePassword();
			$_POST['password'] = $crypt->encrypt($_POST['email'], $_POST['password']);
			$_POST['password']=addslashes($_POST['password']);
			$db->query("INSERT INTO users (username, userpass, verified, money, points, user_level, gender, signedup, email, lastip, lastip_signup, country, refer, zipcode, dailygames) VALUES( '{$username}', '{$_POST['password']}','$verifypass', 0.25,0, 1, '{$_POST['gender']}', unix_timestamp(), '{$_POST['email']}','$IP', '$IP', '{$_POST['country']}', $ref, {$_POST['zipcode']},10)");
			$i=$db->insert_id();
			$forumpass = sha1(strtolower($username).$olpass);
			$db->query("INSERT INTO f_members (memberName, dateRegistered, ID_GROUP, realName, passwd, emailAddress, memberIP, memberIP2, is_activated, ID_POST_GROUP, pm_email_notify, passwordSalt) VALUES('$username', unix_timestamp(), 0, '$username', '$forumpass', '{$_POST['email']}', '$IP', '$IP', 1, 4, 1, 'b9ee')");
			$to = $_POST['email'];
			$subject = "Welcome to MrWQ's GPT! Validate your account now!";
			$message = "We would like to take this opportunity to welcome you to MrWQ's GPT. It's great to have you as a part of our community. Also, we want to let you know about a new addition to our site - you can now earn money by playing flash games! Log in and check it out!\n\nFor future reference:\nYour Email:  {$_POST['email']}\nYour Password: $olpass\n\nPlease validate your account by clicking this link\n\n http://mrwq.com/login.php?a=validate&u=$i&b=$verifypass\n\nThen login and start making cash now!\nhttp://mrwq.com";
			$headers = "From: MrWQ Staff <support@MrWQ.com>\r\n";
			$headers .= 'To: '.$username.' <'.$_POST['email'].'>'."\r\n";
			$mailit = mail($to,$subject,$message,$headers);

			$msg='As a thanks for joining us, we have credited your account with $0.25.';
			$db->query("INSERT INTO events VALUES ('',$i,unix_timestamp(),0,'$msg')") or die(mysql_error());
			$db->query("UPDATE users SET new_event=new_event+1 WHERE userid=$i");


			$lat=$db->num_rows($db->query("SELECT * FROM registerattempts WHERE ip='$IP'"));
			if(!$lat){$db->query("INSERT INTO registerattempts VALUES('','$IP',1)");}
			else{$db->query("UPDATE registerattempts SET times=times+1 WHERE ip='$IP'");}

			print "<center>Your account has been created. You may now log in. <br /><br />You have been sent an email with a validation link. <br>Please click the validation link to confirm your email.<br><br />
			<font size=1>If for some reason you do not receive the email, just login and click the REQUEST ADMIN VALIDATE link, and an admin will verify your account.</font><br /><br />
			&gt; <a href='login.php'>Login</a></center><br /><br />";
			}
			}
			else
			{
			
			if($_GET['ref'])
			{
				$_GET['ref']=abs((int)$_GET['ref']);
				$ty=$db->query("SELECT username FROM users WHERE userid={$_GET['ref']}");
				$gg=$db->fetch_row($ty);
				print"<center></center>";
			}
			if(!$gg['username']){$gg['username']='None';}
?>
			<center>	
			<h2><?php print $set['game_name']; ?> Registration</h2>
<br />


<b>Get paid to take surveys and polls, play games, and other simple, online activities!</b>
<br /><br />
<b><font size=3 color=red>New!!!</font> <font size=3> Now you can earn REAL MONEY by playing flash games in our arcade!
</b>
<br /><br />
Do you want to earn money for an online game subscription? Maybe get some extra money in your paypal account to buy a gift on ebay for that special someone? Or perhaps you simply just want to add some extra spending cash in your wallet. Regardless, this site is for you! Sign up below, everything is completely free, and you can earn <strong>real cash</strong> here!
<br /><br />
					<form action=register.php method=post name='signup'>
					<table width='75%' class='table' cellspacing='1'>
					<tr>
					<td width='30%'><b>Username: </b></td>
					<td width='40%'><input type=text name=username onkeyup='CheckUsername(this.value);'></td>
					<td width='30%'><div id='usernameresult'></div></td>
					</tr>
					<tr>
					<td><b>Password: </b></td>
					<td><input type=password id='pw1' name=password onkeyup='CheckPasswords(this.value);PasswordMatch();'></td>
					<td><div id='passwordresult'></div></td>
					</tr>
					<tr>
					<td><b>Confirm Password: </b></td><td><input type=password name=cpassword id='pw2' onkeyup='PasswordMatch();'></td>
					<td><div id='cpasswordresult'></div></td>
					</tr>
					<tr>
					<td><b>Email: </b></td><td><input type=text name=email onkeyup='CheckEmail(this.value);'></td>
					<td><div id='emailresult'></div></td>
					</tr>
					<tr>
					<td colspan=2>
					<font size=1>(Be sure this is a real email.Do not use a Hotmail address.)</font>
					</td>
					</tr>
					<tr>
					<td><b>Country: </b></td>
					<td colspan='2'>
<select name="country" size="1" onchange="changeCountry();">
<option>Afghanistan</option><option>&Aring;land Islands</option><option>Albania</option><option>Algeria</option><option>American Samoa</option><option>Andorra</option><option>Angola</option><option>Anguilla</option><option>Antarctica</option><option>Antigua and Barbuda</option><option>Argentina</option><option>Armenia</option><option>Aruba</option><option >Australia</option><option>Austria</option><option>Azerbaijan</option><option>Bahamas</option><option>Bahrain</option><option>Bangladesh</option><option>Barbados</option><option>Belarus</option><option>Belgium</option><option>Belize</option><option>Benin</option><option>Bermuda</option><option>Bhutan</option><option>Bolivia</option><option>Bosnia and Herzegovina</option><option>Botswana</option><option>Bouvet Island</option><option>Brazil</option><option>British Indian Ocean territory</option><option>Brunei Darussalam</option><option>Bulgaria</option><option>Burkina Faso</option><option>Burundi</option><option>Cambodia</option><option>Cameroon</option><option>Canada</option><option>Cape Verde</option><option>Cayman Islands</option><option>Central African Republic</option><option>Chad</option><option>Chile</option><option>China</option><option>Christmas Island</option><option>Cocos (Keeling) Islands</option><option>Colombia</option><option>Comoros</option><option>Congo</option><option>Congo, Democratic Republic</option><option>Cook Islands</option><option>Costa Rica</option><option>C&ocirc;te d'Ivoire (Ivory Coast)</option><option>Croatia (Hrvatska)</option><option>Cuba</option><option>Cyprus</option><option>Czech Republic</option><option>Denmark</option><option>Djibouti</option><option>Dominica</option><option>Dominican Republic</option><option>East Timor</option><option>Ecuador</option><option>Egypt</option><option>El Salvador</option><option>Equatorial Guinea</option><option>Eritrea</option><option>Estonia</option><option>Ethiopia</option><option>Falkland Islands</option><option>Faroe Islands</option><option>Fiji</option><option>Finland</option><option >France</option><option>French Guiana</option><option>French Polynesia</option><option>French Southern Territories</option><option>Gabon</option><option>Gambia</option><option>Georgia</option><option >Germany</option><option>Ghana</option><option>Gibraltar</option><option>Greece</option><option>Greenland</option><option>Grenada</option><option>Guadeloupe</option><option>Guam</option><option>Guatemala</option><option>Guinea</option><option>Guinea-Bissau</option><option>Guyana</option><option>Haiti</option><option>Heard and McDonald Islands</option><option>Honduras</option><option>Hong Kong</option><option>Hungary</option><option>Iceland</option><option>India</option><option>Indonesia</option><!-- copyright Felgall Pty Ltd --><option>Iran</option><option>Iraq</option><option>Ireland</option><option>Israel</option><option>Italy</option><option>Jamaica</option><option>Japan</option><option>Jordan</option><option>Kazakhstan</option><option>Kenya</option><option>Kiribati</option><option>Korea (north)</option><option>Korea (south)</option><option>Kuwait</option><option>Kyrgyzstan</option><option>Lao People's Democratic Republic</option><option>Latvia</option><option>Lebanon</option><option>Lesotho</option><option>Liberia</option><option>Libyan Arab Jamahiriya</option><option>Liechtenstein</option><option>Lithuania</option><option>Luxembourg</option><option>Macao</option><option>Macedonia (FYROM)</option><option>Madagascar</option><option>Malawi</option><option>Malaysia</option><option>Maldives</option><option>Mali</option><option>Malta</option><option>Marshall Islands</option><option>Martinique</option><option>Mauritania</option><option>Mauritius</option><option>Mayotte</option><option>Mexico</option><option>Micronesia</option><option>Moldova</option><option>Monaco</option><option>Mongolia</option><option>Montserrat</option><option>Morocco</option><option>Mozambique</option><option>Myanmar</option><option>Namibia</option><option>Nauru</option><option>Nepal</option><option>Netherlands</option><option>Netherlands Antilles</option><option>New Caledonia</option><option >New Zealand</option><option>Nicaragua</option><option>Niger</option><option>Nigeria</option><option>Niue</option><option>Norfolk Island</option><option>Northern Mariana Islands</option><option>Norway</option><option>Oman</option><option>Pakistan</option><option>Palau</option><option>Palestinian Territories</option><option>Panama</option><option>Papua New Guinea</option><option>Paraguay</option><option>Peru</option><option>Philippines</option><option>Pitcairn</option><option>Poland</option><option>Portugal</option><option>Puerto Rico</option><option>Qatar</option><option>R&eacute;union</option><option>Romania</option><option>Russian Federation</option><option>Rwanda</option><option>Saint Helena</option><option>Saint Kitts and Nevis</option><option>Saint Lucia</option><option>Saint Pierre and Miquelon</option><option>Saint Vincent and the Grenadines</option><option>Samoa</option><option>San Marino</option><option>Sao Tome and Principe</option><!-- copyright Felgall Pty Ltd --><option>Saudi Arabia</option><option>Senegal</option><option>Serbia and Montenegro</option><option>Seychelles</option><option>Sierra Leone</option><option>Singapore</option><option>Slovakia</option><option>Slovenia</option><option>Solomon Islands</option><option>Somalia</option><option>South Africa</option><option>Spain</option><option>Sri Lanka</option><option>Sudan</option><option>Suriname</option><option>Svalbard and Jan Mayen Islands</option><option>Swaziland</option><option>Sweden</option><option>Switzerland</option><option>Syria</option><option>Taiwan</option><option>Tajikistan</option><option>Tanzania</option><option>Thailand</option><option>Togo</option><option>Tokelau</option><option>Tonga</option><option>Trinidad and Tobago</option><option>Tunisia</option><option>Turkey</option><option>Turkmenistan</option><option>Turks and Caicos Islands</option><option>Tuvalu</option><option>Uganda</option><option>Ukraine</option><option>United Arab Emirates</option><option >United Kingdom</option><option  selected="selected">United States of America</option><option>Uruguay</option><option>Uzbekistan</option><option>Vanuatu</option><option>Vatican City</option><option>Venezuela</option><option>Vietnam</option><option>Virgin Islands (British)</option><option>Virgin Islands (US)</option><option>Wallis and Futuna Islands</option><option>Western Sahara</option><option>Yemen</option><option>Zaire</option><option>Zambia</option><option>Zimbabwe</option></select>

					</td>
					</tr>
					<tr>
					<td><b>Zipcode : </b><br />(USA Only)</td>
					<td colspan=2><input type=text name=zipcode></td>
					</tr>
					<tr>
					<td><b>Gender: </b></td>
					<td colspan='2'><select name='gender' type='dropdown'>
					<option value='Male'>Male
					<option value='Female'>Female</select></td>
					</tr>
					<tr><td><b>Your Referrer: </b></td><td colspan='2'><?php print $gg['username']; ?></td></tr>
					
					<input type=hidden name=ref value='<?php print $_GET['ref']; ?>' />
					<tr>
					<td colspan=3 align=center>
					<br /><font size=1>By clicking the submit button, you are stating that you have read and agree with the <a href=login.php?a=tos>Terms of Service</a> and <a href=login.php?a=privacypolicy>Privacy Policy</a>.</font><br />
					<input type=submit value='Submit Registration'></td>
					</tr>
					</table>
					</form><br />
<a href='login.php'>Go Back</a><br /><br />
<?php } ?>	</div>
	<div class="push"></div>
</div>
<div id="footer">
	<div id="sock">Copyright <strong>©</strong> 2009 <a href="index.php">mrwq.com</a>.
 | <a href=login.php?a=privacypolicy>Privacy Policy</a> | 
<a href=login.php?a=tos>Terms Of Service</a></div>
</div>
</body>
</html>

<?php


function generatePassword ($length = 8)
{

  // start with a blank password
  $password = "";

  // define possible characters
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
    
  // set up a counter
  $i = 0; 
    
  // add random characters to $password until $length is reached
  while ($i < $length) { 

    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    // we don't want this character if it's already in the password
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  // done!
  return $password;

}
?>
