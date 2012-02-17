<?php
session_start();
if(session_is_registered(myusername)) { 
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
<H2 class=requirements>Welcome to Clan.net Admin Tools!</H2>
<DIV class="border_wrapper upgrade_note" style="PADDING-RIGHT: 4px; PADDING-LEFT: 4px; PADDING-BOTTOM: 4px; PADDING-TOP: 4px">
<H3>Clan.net Admin Tools</H3>
<P>Welcome to clan.net admin tools! This software was created by David for use of restoring members, squads, adn divisons. With the accomodation of changing usernames and passwords.
<br><br>
Future versions for clan.net admin tools will be released in the near future!

</P>

</DIV>

<DIV class="border_wrapper upgrade_note" 
style="PADDING-RIGHT: 4px; PADDING-LEFT: 4px; PADDING-BOTTOM: 4px; PADDING-TOP: 4px">
<center><b><?php
require('config.php');
$conn = mysql_connect("$local_host","$realityd_cms","$collin"); 
if (!$conn) die ("Could not connect MySQL"); 
mysql_select_db($realityd_cms,$conn) or die ("Warning: Could not open database!<br />You must have an active installation to continue!");
{
echo "Database connection successfull<br />You may continue";
} 
?></b></center>
</DIV>

<br>
<BR 
style="CLEAR: both">
</DIV>
<DIV id=footer>
<DIV id=copyright>Admin Tools © 2008-2009 UGN Group</DIV>
</DIV></DIV></DIV>

</BODY></HTML>
<?php }else{ ?>
<form id="login" action="login.php" method="post">
<table>
<tr><td>Username: </td><td><input type="text" name="myusername" /></td></tr>
<tr><td>Password: </td><td><input type="password" name="mypassword" /></td></tr>
<tr><td></td><td align="right"><input id="submit-button" type="submit" name="submit" value="Login" /></td></tr>
</table>
</form>

<?php } ?>