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
<H2 class=admin>Change Username</H2>
<br />
<FORM enctype="multipart/form-data" method="POST" ACTION="change_username.php">
  <table class="general" cellspacing="0">
		<thead>
		<tr>
			<th colspan="2" class="first last">Account Details</th>
		</tr>
		</thead>
		<tr class="first">
			<td class="first"><label for="adminuser">Old Username:</label></td>    
			<td class="alt_col last"><select name="username" id="username">
<?php
require('config.php');
$conn = mysql_connect("$local_host","$realityd_cms","$collin"); 
if (!$conn) die ("Could not connect MySQL"); 
mysql_select_db($database,$conn) or die ("Could not open database"); 
$query="SELECT useraccess.username FROM useraccess"; 
$rt=mysql_query($query);           
echo mysql_error();                    
while($nt=mysql_fetch_array($rt)){
echo "<option name=\"username\" id=\"username\">$nt[username]</option>";
} ?>
</select></td>
		</tr>
		<tr class="alt_row">
			<td class="first"><label for="adminpass">New Username:</label></td>
			<td class="alt_col last"><input type="text" class="text_input" name="new_username" id="new_username" value="" autocomplete="off"  /></td>
		</tr>
        <tr><td></td>
        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="edit" value="Submit"></td></tr>
</table>
<DIV id=next_button>

<?php
require('config.php');
$conn = mysql_connect("$location","$dbusername","$dbpassword"); 
if (!$conn) die ("Could not connect MySQL"); 
mysql_select_db($database,$conn) or die ("Could not open database"); 
if(isset($_POST['edit']))
  {
    $username            =    addslashes($_POST['username']);
    $new_username            =    addslashes($_POST['new_username']);
    $edit            =    addslashes($_POST['edit']);
   mysql_query("UPDATE `useraccess` SET `username` = '$new_username' WHERE `username` = '$username'") or die (mysql_error());
  }
$query = "select * from useraccess order by username";
$result = mysql_query($query);
?>
</P>
</DIV>



</form>

<br />
<br /><div align="right"><a href="./">Go Back</a></div>
</DIV>
<DIV id=footer>
<DIV id=copyright>Admin Tools © 2008-2009 UGN Group</DIV>
</DIV></DIV></DIV></BODY></HTML>

<?php } ?>