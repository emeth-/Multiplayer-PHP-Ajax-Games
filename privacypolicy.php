<?php
session_start();
if($_SESSION['userid'])
{
include "globals.php";
}
print"<center><h2>Privacy Policy</h2><hr width=98%>";

echo <<<EOF
<table width=80%><tr><td>
<font size=2>
MrWQ.com is very serious about protecting all our customers' personal information. 
Throughout our time doing business with you, we may gather some of your personal information, such as your name, address, or email. Under no circumstances will we sell, rent, trade or give away your personal information entered on these sites to any third party. The only reasons we collect this information is to process orders, personalize your experience on our site, or send you updates about the site. If you would prefer not to receive any further material from MrWQ.com, simply email 'support@mrwq.com' and tell us that you wish to remove your personal information from our site. 

Whenever you provide personal information at our website, you are consenting to the manner in which MrWQ.com will collect, use, disclose and manage your personal information, as stated below.<br /><br />
<b>Cookies</b><br />
This site uses a 'tag' commonly called a 'cookie'. A 'cookie' is just a bit of data that this site sends to your browser, which is stored on your hard drive. It just allows us to keep track of your session on our website. Cookies must be accepted by you, through your browser, in order to use our site properly. Many services our site provides will not work if you do not accept cookies. <br /><br />
<b>Outside Links</b><br />
MrWQ.com provides links to third party websites as a manner of convenience to the user. Just because we have other links does not mean we endorse any other companies, their websites, or their products. All the linked websites have independent privacy policies, which you should read carefully. We have no control over third party websites, and as a result have no responsibility or liability for how these third party websites collect, use, or store your personal information that you give them.
<br /><br />
<b>Spamming Policy</b><br />
Spam email is another name for 'junk email', which is the deliverance of messages to someone(s) who have no desire to receive it. MrWQ.com does not spam, nor do we support spam. If you receive a mail from us, it is because you signed up with us and have your prefence settings set to 'opt-in', that is, to receive email from us. To no longer receive email from us, you can go to your Preferences page, and change your email settings to 'opt-out'. 
<br /><br />
<b>How is your personal information stored?</b><br />
Your personal information is stored in a database when you sign up for our site. Most of this information is solely used in the registration and verification processes. We do not share this information with anyone.
<br /><br />

</font>
</td></tr></table>
EOF;



if($_SESSION['userid'])
{
$h->endpage();
}
?>