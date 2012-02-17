<?php
session_start();
if(!session_is_registered(myusername)) { 
echo "Access Denied!";
}else{
?>


<div style="overflow-x: hidden;width: 99.9%;z-index:1000;font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 8pt;font-weight: normal;position:fixed;left:0;top:0;display: block;color: InfoText;background: #F4E7EA no-repeat fixed .3em .3em;padding: .45em .3em .45em 1em;">
 <table width="98%"><tr>
 <td><span class="style1"><?php
require('config.php');
$conn = mysql_connect("$local_host","$realityd_cms","$collin"); 
if (!$conn) die ("Could not connect MySQL"); 
mysql_select_db($database,$conn) or die ("<center>You must have an active Clan.net installation to continue!</center>");
{
echo "Welcome <b>".$_SESSION["USERNAME"]."</b>, Database connection successfull!";
} 
?></span></td>

 <td align="right"><span class="style1"><strong>Admin Tools</strong> (Clan.net Admin Tools 3.0 PL2) &nbsp;&nbsp;<a href="../index.php" target="_blank">View Home</a>&nbsp;-&nbsp;<a href="logout.php" target="_blank">Logout</a></span></td>
 </tr>
 </table>
</div>

<?php } ?>