<?php
session_start();
if($_SESSION['userid'])
{
include "globals.php";
}
print"<center><h2>FAQ</h2><hr width=98%>";

echo <<<EOF
<b>What is {$set['game_name']}?</b><br />
{$set['game_name']} is a new, unique English-based website that helps both regular, everyday people make money online, and helps advertisers reach the people they are interested in. 
<br /><br />
<b>Can I have more than one account?</b><br />
No. We are strict about this. We have to protect our advertisers from being cheated.
<br /><br />
<b>Can other people in my household join?</b><br />
Only if they have a different computer and IP than you.
<br /><br />
<b>How much money can I make?</b><br />
It really just depends how much time you invest. Some members have made $20-30 a day, some only a couple cents.
<br /><br />
<b>How do I refer others?</b><br />
Use your referral link or any of the codes provided in the "Refer People" page.
<br /><br />
<b>How do I get paid?</b><br />
Once you have $15 In your account balance you can cashout to <a href=http://www.alertpay.com/>AlertPay</a> or <a href=http://paypal.com/>PayPal</a>
<br /><br />
<b>When do I get paid?</b><br />
We pay at the beginning of the new month, sometime between the 1st and the 5th, to your AlertPay/PayPal account
<br /><br />


EOF;



if($_SESSION['userid'])
{
$h->endpage();
}
?>
