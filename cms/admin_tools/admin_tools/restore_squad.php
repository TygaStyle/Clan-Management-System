<?php
session_start();
if(!session_is_registered(myusername)) { 
echo "Access Denied!";
}else{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>MyClanPortal &gt; Admin Tools</TITLE>
<META http-equiv=Content-Type content="text/html; charset=windows-1252"><LINK 
href="stylesheet.css" 
type=text/css rel=stylesheet>
<META content="MSHTML 6.00.6000.16705" name=GENERATOR></HEAD>
<BODY>
<?php require("header.php"); ?>
<br /><br />
<DIV id=container>
<DIV id=logo><br></DIV>
<DIV id=inner_container>
<DIV id=header>Admin Tools</DIV>
<DIV id=progress>
<UL>
<?php require("navigation.php"); ?>
</UL>
</DIV>
<DIV id=content>
<H2 class=config>Restore Squad</H2><br />
<table class="general" cellpadding="2" cellspacing="2" bgcolor="#000000" align="center">

<tr class="first last" bgcolor="#FFFFCC"><td>0 = Visible, 1 = Invisible</td></tr>
</table><br />

<table class="general" cellpadding="2" cellspacing="2" bgcolor="#000000" align="center">

<tr class="first last" bgcolor="#FFFFCC">
<td valign="top">
<?php 
///////////////////////
// SQUAD RESTORE /////
/////////////////////
?>

<center><b>RESTORE SQUAD</b></center>
<form enctype="multipart/form-data" action="restore_squad.php" method="POST">
<div align="center"><br>Squad ID: <input name="id" type="text" size="4">&nbsp;<input type="submit" name="edit" value="Restore"></div></form> 
<div align="center"><form enctype="multipart/form-data" action="restore.php" method="POST">
<?php
require('config.php');
$conn = mysql_connect("$location","$dbusername","$dbpassword"); 
if (!$conn) die ("Could not connect MySQL"); 
mysql_select_db($database,$conn) or die ("Could not open database"); 
if(isset($_POST['edit']))
  {
    $id            =    addslashes($_POST['id']);
   mysql_query("UPDATE `squads` SET `visable` = '0' WHERE `visable` = '1' AND `id` = '$id'") or die (mysql_error());
   mysql_query("UPDATE `mbrlist` SET `visable` = '0' WHERE `visable` = '1' AND `sid` = '$id'") or die (mysql_error());
  }
$query = "select * from squads order by id";
$result = mysql_query($query);
?></div>
</td></tr>


<tr bgcolor="#FFFFCC"><td valign="top">

<table cellspacing="3" cellpadding="3" width="100%" border="1">
<tr><td align="center" width="25"><strong>ID</strong></td><td align="center"><strong>Name</strong></td><td align="center" width="15"><strong>Visible</strong></td><td align="center" width="45"><strong>Div ID</strong></td></tr>

<?php

$query="SELECT squads.id, squads.squadname, squads.visable, squads.divisionid FROM squads WHERE squads.visable = 1";
 
$rt=mysql_query($query);           
echo mysql_error();                    
while($nt=mysql_fetch_array($rt)){
echo "<tr><td align=\"center\">$nt[id]</td><td align=\"center\">$nt[squadname]</td><td align=\"center\">$nt[visable]</td><td align=\"center\">$nt[divisionid]</td></tr>";
}

?>


</table>
</td></tr>
</table>

<br /><br /><div align="right"><a href="./">Go Back</a></div>

</DIV>
<DIV id=footer>
<DIV id=copyright>Admin Tools © 2008-2009 UGN Group</DIV>
</DIV></DIV></DIV></BODY></HTML>

<?php } ?>