<?php

if($sppjs)
{

$sppjs="

<style type=\"text/css\">
<!--
.sbmult {
margin:0;
padding: 0;
display: inline;
vertical-align:top;
}
-->
</style>

<script type=\"text/javascript\">

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

  if (xmlhttp) 
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
		document.getElementById(\"gamediv\").innerHTML = results;

                //refreshPage();
	    } 
	  }
	}


    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(sendf);
  }
}


function refreshPage()
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

	xmlhttp.open(\"GET\",\"s_pp_play.php?act=play\",true);
	xmlhttp.send(null);
}

</script>
";
}
?>