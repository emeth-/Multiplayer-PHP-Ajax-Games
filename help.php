<?php
include "globals.php";
$id=abs((int)$_GET['id']);
$hel=$db->query("SELECT * FROM help WHERE id=$id");
$hen=$db->num_rows($hel);
print"
<center><h2>Help</h2><hr width=98%>
<center>
<br />
";
if($hen<=0)
{
	print"Invalid help ID.<br /><br />";
}
else
{
	$help=$db->fetch_row($hel);
	print"<b><font size=2>{$help['htitle']}</font></b><br />{$help['htext']}<br /><br />";
}
$h->endpage();
?>