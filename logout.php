<?php

session_start();
$sessid=$_SESSION['userid'];
$atk=$_SESSION['attacking'];
session_unset();
session_destroy();
if($_GET['search'])
{
header("Location: gsearch.php");
}
else
{
header("Location: login.php");
}
?>