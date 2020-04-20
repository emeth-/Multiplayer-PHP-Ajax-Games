<?php
session_start();
if($_SESSION['userid'])
{
include "globals.php";
}
print"<center><h2>Terms of Service</h2><hr width=98%>";
?>

<textarea cols="75" rows="20" readonly>
This "Terms of Service" lays out the guidelines you agree to follow if you decide to be a member of MrWQ. Before you become a member at MrWQ, you must agree to these Terms of Service. If you do not agree to them, you may not be a member of MrWQ.
By accepting these Terms of Service, you agree that you will adhere to the following guidelines:

1)	Sending unsolicited mail or messages to people, asking them to join MrWQ without any previous contact with them is both against MrWQ's Terms of Service and the law. We have no tolerance for spammers. If you are caught spamming, your account will be deleted and your IP banned from MrWQ.

2)	You may only have a single account. If you create more than one account, it is possible that all your accounts will be deleted. If you forget the password to your account, simply go to the login and use the request password form, do not create another account. 

3)	You may refer other household members to the program; however, they need a personal email address and Alertpay/PayPal address different than your own, as well as a different IP/Computer. 

4)	We retain the right to terminate your account at any time for any reason, without giving any prior warning to you. If you are caught cheating, your account will be deleted, and we may or may not notify you via email.

5)	If you use any 3rd-party programs or other software designed to circumvent/defraud/cheat the MrWQ system, or do any activity on MrWQ in anything other than the way it was intended, your account will be terminated without notice. Legal action may be taken.

6)	Our payments are made via PayPal or AlertPay. You can request payment once your account balances reaches $10 for the first time, and $15 every time thereafter. Your payment will be processed and given within 1-14 days.

7)	You need a valid email address and valid AlertPay/PayPal account to use our program.

8)	Our pay rate varies depending on the offer or activity in question. We reserve the right to change/alter the pay rate for any activity or offer without notice. 

9)	You can earn money for people you directly refer to MrWQ. However, if you attempt to cheat the referral system, and set up many referral multies to help you earn more, your account will be deleted without notice.

10)	By signing up at MrWQ, you agree to file and pay any and all government taxes necessary for the money you earn off MrWQ. Since we are an international website, we will not do this for you.

11)	You are not an employee of MrWQ, nor an independent contractor. MrWQ merely acts as a middleman between advertisers and consumers.

12)	Gambling Laws: MrWQ is not a gambling site. You can not make money from gambling on MrWQ. There are a few games on MrWQ that you can play, and bet 'points' (an alternative currency) on - but in no way whatsoever are you able to use real money on those games. Points can not be converted into real money. Be sure to check the gambling laws of the area you currently reside in - it is up to each individual member to ensure that his activities on this site do not go against the laws of his country/state.

13)	Liability: MrWQ is not responsible for any losses of money or time on MrWQ as a result of God, war, plagues, spouses, food poisoning, or anything else. This includes, but is not limited to, your spouse breaking your computer with a hammer for ignoring him/her and spending time on MrWQ. MrWQ reserves the right to change or alter these Terms of Service at any time without notice, and it is your responsibility to keep up to date on them.
</textarea>

<?php
if($_SESSION['userid'])
{
$h->endpage();
}
?>
