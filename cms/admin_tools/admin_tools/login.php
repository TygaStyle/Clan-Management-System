<?php

require('config.php');

//Login Check Vairables
$myusername = strip_tags($_POST['myusername']);
$mypassword = strip_tags($_POST['mypassword']);
$myusername2 = strip_tags($_POST['myusername2']);
$mypassword2 = strip_tags($_POST['mypassword2']);


// SQL Take Data
if (md5($myusername)==$username&&md5($mypassword)==$password||md5($myusername2)==$username2&&md5($mypassword2)==$password2)
{
session_register("myusername");
  session_register("mypassword");
  $_SESSION["USERNAME"] = $myusername;
  header("location:index.php");
}
else 
{
echo "Wrong Username or Password"; 
}
?>