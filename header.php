<?php
class headers
{
	 
	function startheaders()
	{
		global $ir, $set,$forums, $head, $db, $error, $gamepage,$user, $blackjackjs, $sppjs, $roulettejs, $gameroomid;
		include "blackjack_header.php";
		include "roulette_header.php";
		include "sb_header.php";
		include "s_pp_header.php";
		
		//for chat
		//<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
		print <<<EOF
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		$extragameheaders
		<title>MrWQ</title>		
		$blackjackjs
		$gamejs
		$roulettejs
		$sppjs
		<link type="text/css" rel="Stylesheet" href="./css/masterin.css" />
		<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
		
		<!--[if lte IE 7]>
		<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
		<![endif]-->
EOF;

if($head)
{
	print <<<EOF
		
		<script language="JavaScript">
		<!--
		
		$head
		//-->
		</script>
EOF;
}
		print <<<EOF
		</head>
EOF;
	}

	function userdata($ir,$lv,$fm,$dosessh=1)
	{
		global $db, $c, $userid, $set, $home,$user, $casino, $twoplayer, $arcade;
		$IP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
		$db->query("UPDATE users SET laston=unix_timestamp(),lastip='$IP' WHERE userid='$userid'");
		$u=$ir['username'];
		$bgcolor = 'CDCDCD';
		
		if($ir['guest']==0)
		{
			$logouttxt = sprintf('<a href="#" onClick="FB.Connect.logout(function() { refresh_page(); })">'
											 .'Logout'
											 //.'<img src="images/fbconnect_logout.png">'
											 .'</a>',
											 $_SERVER['REQUEST_URI']);
			$logouttxt = " | ".$logouttxt;
		}
		else
		{
			$fb_active_session = FALSE;
			// DISPLAY PAGE WHEN USER IS NOT LOGGED IN TO FB CONNECT
			$logouttxt = '&nbsp;&nbsp;<div class="fbconnect_login" style="display:inline;">';
			$logouttxt .= render_fbconnect_button('medium');
			$logouttxt .= '</div>';
		}
		
		print <<<EOF
		<body>
		<div id="wrapper">
			<div id="nav">
				<div id="logo">
					<img src="./img/logo.jpg" width="55" height="15" alt="MRWQ" />
					<br /><span id="logo_text">Play 2-player games against your friends!</span>
				</div>
				<div id="login">
					<table><tr><td>Welcome, {$ir['username']}</td><td>{$logouttxt}</td></tr></table>
				</div>
			</div>
			<div id="graphic">
				<img src="./img/top-graphic.jpg" width="874" height="168" alt="MrWQ" />
			</div>
			<div id="main_links">
				<ul>
EOF;
		$htext = "";
		$twoptext = "";
		$casinotext = "";
		$arctext = "";
		if($home==1){$htext = " class=\"current\"";}
		if($twoplayer==1){$twoptext = " class=\"current\"";}
		if($casino==1){$casinotext = " class=\"current\"";}
		if($arcade==1){$arctext = " class=\"current\"";}
		echo <<<EOF
					<li $htext><a href="index.php"><span>Home</span></a></li>
					<li $twoptext><a href="twoplayergames.php"><span>2-Player Games</span></a></li>
					<li $casinotext><a href="casinogames.php"><span>Casino Games</span></a></li>
					<li $arctext><a href="arcade.php"><span>Arcade Games</span></a></li>
				</ul>
			</div>
			<div id="left_nav">
				<table>
					<tr>
						<td class="header" colspan="2"><center>{$ir['username']}
EOF;
		print"				
						</td>
					</tr>
					<tr valign=\"top\">
						<td class=\"subinfo\" colspan=\"2\">
							<div>
		";
		print"<strong>Q-Cash:</strong> {$fm}";
		echo <<<EOF
		
							</div>			
						</td>
					</tr>
				</table>
EOF;
global $challengeheadertext;
if($_GET['challengeid'])
{
       include "challenge.php";
}
$pendingchal = $db->num_rows($db->query("SELECT `to` FROM challenge WHERE `to`=$userid AND accepted!=$userid"));
if($pendingchal)
{
	$tick=$db->query("SELECT * FROM challenge WHERE `to`=$userid AND accepted!=$userid ORDER BY rand() LIMIT 1");
	$tic=$db->fetch_row($tick);
	$unamef = $db->fetch_row($db->query("SELECT username,laston FROM users WHERE userid={$tic['from']}"));
	$gnamef = $db->fetch_row($db->query("SELECT * FROM multgames WHERE short='{$tic['game']}'"));
	if($unamef['laston']>(time()-(60*15)) || $tic['time_left']>40)
	{
		if($tic['time_left'] == 86400){$tleng = "1 day";}
		else if($tic['time_left'] == 259200){$tleng = "3 days";}
		else if($tic['time_left'] == 604800){$tleng = "1 week";}
		else{$tleng = "30 seconds";}
		$challengeheadertext = "<table class='table' width=95%><tr>";
		$challengeheadertext .="<td id='newsheader'><center><strong>{$unamef['username']} challenged you to a game of {$gnamef['name']} with turns of $tleng each!
		<br /><a href='index.php?challengeid={$tic['id']}&act=accept'><font color=green>Accept</font></a> | <a href='index.php?challengeid={$tic['id']}&act=reject'><font color=red>Reject</font></a></strong></center></td>";
		$challengeheadertext .="</tr></table><br />";
	}
}

$challhead = $db->query("SELECT * FROM challenge WHERE (`to` = $userid OR `from`=$userid) AND accepted!=$userid");
$challheada = $db->num_rows($challhead);
if($challheada>0)
{
echo <<<EOF
				<table>
					<tr>
						<td class="header" colspan="2">My Challenges</td>
					</tr>
	
EOF;
	while($chh = $db->fetch_row($challhead))
	{
		if($userid==$chh['from'])
		{
			
			
			if($chh['accepted']!=$chh['to'])
			{
				$usrfull = $db->fetch_row($db->query("SELECT username FROM users WHERE userid='{$chh['to']}'"));
				$gamfull = $db->fetch_row($db->query("SELECT * FROM multgames WHERE short='{$chh['game']}'"));
				if(!$usrfull['username'])
				{
					$friendinf = $user->fbc_get_friend_name($chh['to']);
					if(empty($friendinf))
					{
						$usrfull['username']="Username Unavailable";
					}
					else
					{
						$usrfull['username']= $friendinf[0]['first_name'].' '.$friendinf[0]['last_name'];
					}
				}
				print"
				<tr>
					<td class=\"sub\" colspan=\"2\">» {$usrfull['username']} - {$gamfull['name']} <br />
						<center><i>Pending...</i><a href='index.php?challengeid={$chh['id']}&act=cancel'><font color=red>Cancel?</font></a></center></td>
				</tr>
				";
			}
			else
			{
				$usrfull = $db->fetch_row($db->query("SELECT username FROM users WHERE userid='{$chh['to']}'"));
				$gamfull = $db->fetch_row($db->query("SELECT * FROM multgames WHERE short='{$chh['game']}'"));
				print"
				<tr>
					<td class=\"sub\" colspan=\"2\">» {$usrfull['username']} - {$gamfull['name']} <br />
						<center><font color=green>Live! <a href='sb_game.php?g={$chh['game']}&act=joining&challengeid={$chh['id']}&id={$chh['room']}'>Join Game!</a></font></center></td>
				</tr>
				";
			}
		}
		else
		{
			$usrfull = $db->fetch_row($db->query("SELECT username,laston FROM users WHERE userid='{$chh['from']}'"));
			$gamfull = $db->fetch_row($db->query("SELECT * FROM multgames WHERE short='{$chh['game']}'"));
			if($usrfull['laston'] > (time()-(60*15)) || $chh['time_left']>40)
			{
				print"
				<tr>
					<td class=\"sub\" colspan=\"2\">» {$usrfull['username']} - {$gamfull['name']} <br />
						<center><a href='?challengeid={$chh['id']}&act=accept'><font color=green>Accept</font></a> / <a href='?challengeid={$chh['id']}&act=reject'><font color=red>Reject</font></a></center></td>
				</tr>
				";
			}
			else
			{
				print"
				<tr>
					<td class=\"sub\" colspan=\"2\">» {$usrfull['username']} - {$gamfull['name']} <br />
						<center><font color=grey>-Friend Currently Offline</font></center></td>
				</tr>
				";
			}
		}
	}
	print"</table>";
}

echo <<<EOF
				<table>
					<tr>
						<td class="header" colspan="2">2-Player Games I'm In</td>
					</tr>
	
EOF;
	$gan22 = $db->query("SELECT * FROM multgames ORDER BY name ASC");
	$tot=0;
	while($gan2 = $db->fetch_row($gan22))
	{
		$short = $gan2['short'];
		$roomsin = check_room($short, $ir['userid']);
		if(is_array($roomsin))	//if($ir["{$short}_room"])
		{
			
			foreach ($roomsin as &$room) 
			{
				$ar = $db->fetch_row($db->query("SELECT p1,p2,turn FROM {$short}_room WHERE id={$room}"));
				if($ar['p1'] && $ar['p2'])
				{
					if($ar['turn']==$ir['userid']){$acttxt = "<font color=green><b>Play</b></font>";}
					else{$acttxt = "Play";}
				}
				else{$acttxt = "Waiting";}
			echo <<<EOF
					<tr>
						<td class="sub" colspan="2">» {$gan2['name']} [<a href='sb_game.php?g={$short}&id=$room'>{$acttxt}</a>] [<a href='sb_rooms.php?g={$short}&act=leave&id=$room'>Leave</a>]</td>
					</tr>
EOF;
			}
		$tot++;
		}
	}
	if($tot==0)
	{
		echo <<<EOF
				<tr>
					<td class="sub" colspan="2"><i>None... :(</i></td>
				</tr>
EOF;
	}
	else
	{
		print"
		<tr><td class=\"sub\" colspan=\"2\" align='center'>
		If 'Play' is green, it's your turn.
		</td></tr>
		";
	}
		print"</table>";
		if($ir['guest']==0)
		{
				$friends = $user->fbc_get_all_friends();
				$friusers = array();
				foreach ($friends as $friend)
				{
					$friusers[]=$friend['uid'];
				}
				$allfriends = implode(",", $friusers);
				if (empty($friend)) { 
					$html = '<table>';
					$html .= '<tr><td class="header" colspan="2">' . $title . '</td></tr>';
					$html .= '<tr><td class="sub" colspan="2">No friends here!</td></tr>';
					$html .= '</table>';
					print $html;
				}
				else
				{
				
					$html = '<table>';
					$html .= '<tr><td class="header" colspan="2"><center>Friends on our Site</center></td></tr>';
					$fris = $db->query("SELECT * FROM users WHERE userid IN ($allfriends) ORDER BY laston DESC");
					while($fri = $db->fetch_row($fris))
					{
						$newname = str_replace(" ", "_", $fri['username']);
						$laston = $fri['laston'];
						$ctime = time();
						$last15 = time() - 60 * 15;
						$last60 = time() - 60 * 60;
						if($laston > $last15)
						{
							$lastonimg = "<img src='images/online.png'> ";
						}
						else if($laston > $last60)
						{
							$lastonimg = "<img src='images/idle.png'> ";
						}
						else
						{
							$lastonimg = "<img src='images/offline.png'> ";
						}
						$html .= '<tr><td class="sub" colspan="2">'.$lastonimg.
						'<a href="javascript:void(0)" onclick="javascript:chatWith(\''.$newname.'\');">
						' . $fri['username'] . '</a>
						[<a href="challenge.php?act=prechallenge&player='.$fri['userid'].'">C</a>] 
						[<a target="_blank" href="http://www.facebook.com/profile.php?id=' . $fri['userid'] . '">P</a>]</td></tr>';
					}
						
					$html .= '<tr><td class="sub" colspan="2" align="center"><b>C</b> = Challenge | <b>P</b> = Profile</td></tr>
					<tr><td class="sub" colspan="2" align="center">Click a friend\'s name to chat.</td></tr></table>';
					print $html;
					
				}
		}
		else
		{
			$fb_active_session = FALSE;
			// DISPLAY PAGE WHEN USER IS NOT LOGGED IN TO FB CONNECT
			print '<br /><div class="fbconnect_login"><center>';
			print render_fbconnect_button('medium');
			print '</center></div>';
		}
		echo <<<EOF
			</div>
			<div id="content">
EOF;


	print $challengeheadertext;

	}
	function endpage()
	{
		global $db,$user;
		print <<<OUT
		</div>
			<div class="push"></div>
		</div>
		<div id="footer">
			<div id="sock">Copyright <strong>©</strong> 2009 <a href="http://mrwq.com">MrWQ.com</a>. | <a href=privacypolicy.php>Privacy Policy</a> | <a href=tos.php>Terms Of Service</a></div>
		</div>	
OUT;
		
		echo render_footer();
		print"
		
		<script type=\"text/javascript\" src=\"js/jquery.js\"></script>
		<script type=\"text/javascript\" src=\"js/chat.js\"></script>
		</body>
		</html>";
		
	
	}
}
?>