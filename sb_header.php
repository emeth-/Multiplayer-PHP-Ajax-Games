<?php

$gamepage = preg_replace("/[^a-z]/", "", $gamepage);
$gamepage = substr($gamepage, 0, 4); 

//$gameroomid
if($gamepage)
{
	if (file_exists($gamepage."_config.php")) 
	    include $gamepage."_config.php";
	else 
	    die("Error.");

$extragameheaders="

<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">
<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">
";
	$gamejs="

<style type=\"text/css\">
<!--
.sbmult {
margin:0;
padding: 0;
display: inline;
vertical-align:top;
}
#gamediv {
display: block;
margin:0;
padding:0;
}
-->
</style>

<script type=\"text/javascript\">
var f = false;
var doitagain = true;
var waittime = 5000;

function postFormAjax(url, formname) 
{
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
		  // code for IE6, IE5
		  xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
	  }

  if (!f && xmlhttp) 
  {
    var fields = new Array();
    if(formname)
	{
      var ajax = formname;
    }
    //loop through form elements and retrieve field NAMEs and Values
    for (var x = 0; x < eval(\"document.\"+ajax+\".elements.length\"); x++)
	{

     // join them into a string.
 eval(\"fields.push(document.\"+ajax+
\".elements[x].name+'='+document.\"
+ajax+\".elements[x].value)\");

    }
    elem = 'errors';

    var sendf = fields.join('&');

    xmlhttp.open(\"POST\", url, true);
    xmlhttp.onreadystatechange = function()
	{
	  if (xmlhttp.readyState == 4) 
	  {
	    if(xmlhttp.status == 200)
	    {
	      results = xmlhttp.responseText; 
	      var para = document.getElementById('errors'); 
	      //para.innerHTML = results;
	      f = false; // re activate the AJAX function
	
			//refresh page
			//clearTimeout();
			refreshGameOnce();
			refreshGameChat();
	    } 
	  }
	}


    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(sendf);
    f = true;
	if(formname=='postchat'){document.getElementById(\"chattxtinput\").value = '';}
  }
}

function enter_pressed(e)
{
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return false;
	return (keycode == 13);
}

function beginGameAjax()
{

	refreshEverything();
}


function runGameAjax()
{

	//every x seconds, resend the ajax
	clearTimeout();
	if(doitagain)
	{
		doitagain=false;
		var t=setTimeout(\"refreshEverything()\",waittime);
	}
}


function refreshEverything()
{
	refreshGameChat();
	refreshGame();
	doitagain=true;
}

function refreshGame()
{
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
		  // code for IE6, IE5
		  xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		  document.getElementById(\"gamediv\").innerHTML = '';
		  document.getElementById(\"gamediv\").innerHTML = xmlhttp.responseText;
	  }
	}

	xmlhttp.open(\"GET\",\"{$gpre}play.php?id={$gameroomid}\",true);
	xmlhttp.send(null);
	runGameAjax();
}

function refreshGameOnce()
{
	var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
		  // code for IE6, IE5
		  xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		  document.getElementById(\"gamediv\").innerHTML = '';
		  document.getElementById(\"gamediv\").innerHTML = xmlhttp.responseText;
	  }
	}

	xmlhttp.open(\"GET\",\"{$gpre}play.php?id={$gameroomid}\",true);
	xmlhttp.send(null);
}


function refreshGameChat()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
		  // code for IE6, IE5
		  xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
	  }
	xmlhttp.onreadystatechange=function()
	{
	if(xmlhttp.readyState==4)
	  {
		  document.getElementById(\"gamechat\").innerHTML = xmlhttp.responseText;
	  }
	}

	xmlhttp.open(\"GET\",\"sb_chat.php?pre={$gpre}&id={$gameroomid}\",true);
	xmlhttp.send(null);

}

</script>
";
}
?>