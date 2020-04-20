<?php
function userid_to_username($userid)
{
	global $db;
	$unmtmp = $db->fetch_row($db->query("SELECT username FROM users WHERE userid=$userid"));
	return $unmtmp['username'];
}
function check_room($pre, $userid)
{
	global $db;
	$allroomsin = array();
	$ans = $db->query("SELECT id FROM {$pre}_room WHERE p1=$userid OR p2=$userid");
	if($db->num_rows($ans)>0)
	{
		while($nsa = $db->fetch_row($ans))
		{
			$allroomsin[]=$nsa['id'];
		}
		return $allroomsin;
	}
	else
	{
		return 0;
	}
}

function timeleft($date)
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
    if($now > $unix_date) {    
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
    // {$tense}
    return "$difference $periods[$j]";
}


function money_formatter($muny,$symb='$')
{
return $symb.number_format($muny);
}

function helplink($id)
{
	$ret="<font size=1.5>[<a href='help.php?id=$id'>?</a>]</font>";
	return $ret;
}

function mysql_escape($str)
{
$str = str_replace("<", "&lt;", $str);
$str = str_replace(">", "&gt;", $str);
$str = mysql_real_escape_string($str); 
$str=str_replace(array("meta","onload","onerror","onLoad","onError","xml","null", "alert(","eval","innerHTML","innerhtml","onreadystatechange","var "),array("","","","","","","","","","","","",""),$str); 
$str=str_replace(array("<script", "applet", "embed", "<form", "union","--", "../","/*","java"),array("","","","","","","","","",""),$str); 
return $str;
}
function mysql_unescape($str)
{
	$str=html_entity_decode($str, ENT_QUOTES);
	$str=stripslashes($str);
	return $str;
}
function mysql_escape2($str)
{
$str=str_replace(array("meta","onload","onerror","onLoad","onError","xml","null", "alert(","eval","innerHTML","innerhtml","onreadystatechange","var "),array("","","","","","","","","","","","",""),$str); 
$str=str_replace(array("<script", "applet", "embed", "<form", "union","--", "../","/*","java"),array("","","","","","","","","",""),$str); 
$str = addslashes($str); 
return $str;
}
function get_url()
{
$_SERVER['FULL_URL'] = 'http';
if($_SERVER['HTTPS']=='on'){$_SERVER['FULL_URL'] .=  's';}
$_SERVER['FULL_URL'] .=  '://';
if($_SERVER['SERVER_PORT']!='80') $_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$_SERVER['SCRIPT_NAME'];
else
$_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
if($_SERVER['QUERY_STRING']>' '){$_SERVER['FULL_URL'] .=  '?'.$_SERVER['QUERY_STRING'];}
return $_SERVER['FULL_URL'];
}
function bbcoder($stringy)
{
$stringy=str_replace(array("[b]","[/b]","[i]","[/i]","[u]","[/u]","[strike]","[/strike]","[sub]","[/sub]","[sup]","[/sup]","[blink]","[/blink]","[center]","[/center]","[br]","[quote]","[/quote]"),array("<b>","</b>","<i>","</i>","<u>","</u>","<strike>","</strike>","<sub>","</sub>","<sup>","</sup>","<blink>","</blink>","<center>","</center>","<br />","<fieldset><legend>Quote</legend>","</fieldset>"),$stringy);
$stringy=str_replace(array("&#40;ak&#41;","&#40;angel&#41;","&#40;bomb&#41;","&#40;canada&#41;","&#40;confused&#41;",":&#41;",":&#40;&#40;","&#40;cannibal&#41;","&#40;hammer&#41;","&#40;jump&#41;","&#40;laser&#41;","&#40;laugh&#41;","&#40;laugh2&#41;","&#40;lightsaber&#41;",":&#40;","&#40;shot&#41;","&#40;sniper&#41;",":P","&#40;uk&#41;","&#40;usa&#41;","&#40;thumbu&#41;","&#40;thumbd&#41;"),array("<img src=images/smileys/ak.gif>","<img src=images/smileys/angel.gif>","<img src=images/smileys/bomb.gif>","<img src=images/smileys/canada.gif>","<img src=images/smileys/confused.gif>","<img src=images/smileys/cool.gif>","<img src=images/smileys/cry.gif>","<img src=images/smileys/eat.gif>","<img src=images/smileys/hammer.gif>","<img src=images/smileys/jumping.gif>","<img src=images/smileys/laser.gif>","<img src=images/smileys/laugh.gif>","<img src=images/smileys/laugh2.gif>","<img src=images/smileys/lightsaber.gif>","<img src=images/smileys/sadface.gif>","<img src=images/smileys/shot.gif>","<img src=images/smileys/sniper.gif>","<img src=images/smileys/ts.gif>","<img src=images/smileys/uk.gif>","<img src=images/smileys/usa.gif>","<img src=images/smileys/tu.png>","<img src=images/smileys/td.png>"),$stringy);
return $stringy;
}
function bbdecoder($stringy)
{
$stringy=str_replace(array("<img src=images/smileys/ak.gif>","<img src=images/smileys/angel.gif>","<img src=images/smileys/bomb.gif>","<img src=images/smileys/canada.gif>","<img src=images/smileys/confused.gif>","<img src=images/smileys/cool.gif>","<img src=images/smileys/cry.gif>","<img src=images/smileys/eat.gif>","<img src=images/smileys/hammer.gif>","<img src=images/smileys/jumping.gif>","<img src=images/smileys/laser.gif>","<img src=images/smileys/laugh.gif>","<img src=images/smileys/laugh2.gif>","<img src=images/smileys/lightsaber.gif>","<img src=images/smileys/sadface.gif>","<img src=images/smileys/shot.gif>","<img src=images/smileys/sniper.gif>","<img src=images/smileys/ts.gif>","<img src=images/smileys/uk.gif>","<img src=images/smileys/usa.gif>","<img src=images/smileys/tu.png>","<img src=images/smileys/td.png>"),array("&#40;ak&#41;","&#40;angel&#41;","&#40;bomb&#41;","&#40;canada&#41;","&#40;confused&#41;",":&#41;",":&#40;&#40;","&#40;cannibal&#41;","&#40;hammer&#41;","&#40;jump&#41;","&#40;laser&#41;","&#40;laugh&#41;","&#40;laugh2&#41;","&#40;lightsaber&#41;",":&#40;","&#40;shot&#41;","&#40;sniper&#41;",":P","&#40;uk&#41;","&#40;usa&#41;","&#40;thumbu&#41;","&#40;thumbd&#41;"),$stringy);
$stringy=str_replace(array("<b>","</b>","<i>","</i>","<u>","</u>","<strike>","</strike>","<sub>","</sub>","<sup>","</sup>","<blink>","</blink>","<center>","</center>","<br />","<fieldset><legend>Quote</legend>","</fieldset>"),array("[b]","[/b]","[i]","[/i]","[u]","[/u]","[strike]","[/strike]","[sub]","[/sub]","[sup]","[/sup]","[blink]","[/blink]","[center]","[/center]","\n","[quote]","[/quote]"),$stringy);
return $stringy;
}
function browser_detection( $which_test ) {

	// initialize the variables
	$browser = '';
	$dom_browser = '';

	// set to lower case to avoid errors, check to see if http_user_agent is set
	$navigator_user_agent = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';

	// run through the main browser possibilities, assign them to the main $browser variable
	if (stristr($navigator_user_agent, "opera")) 
	{
		$browser = 'opera';
		$dom_browser = true;
	}

	elseif (stristr($navigator_user_agent, "msie 4")) 
	{
		$browser = 'msie4'; 
		$dom_browser = false;
	}

	elseif (stristr($navigator_user_agent, "msie")) 
	{
		$browser = 'msie'; 
		$dom_browser = true;
	}

	elseif ((stristr($navigator_user_agent, "konqueror")) || (stristr($navigator_user_agent, "safari"))) 
	{
		$browser = 'safari'; 
		$dom_browser = true;
	}
	elseif (stristr($navigator_user_agent, "firefox")) 
	{
		$browser = 'firefox';
		$dom_browser = false;
	}
	elseif (stristr($navigator_user_agent, "gecko")) 
	{
		$browser = 'mozilla';
		$dom_browser = true;
	}

	
	elseif (stristr($navigator_user_agent, "mozilla/4")) 
	{
		$browser = 'ns4';
		$dom_browser = false;
	}
	
	else 
	{
		$dom_browser = false;
		$browser = false;
	}

	// return the test result you want
	if ( $which_test == 'browser' )
	{
		return $browser;
	}
	elseif ( $which_test == 'dom' )
	{
		return $dom_browser;
		//  note: $dom_browser is a boolean value, true/false, so you can just test if
		// it's true or not.
	}
}
?>