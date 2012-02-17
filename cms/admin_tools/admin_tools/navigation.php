<?php
session_start();
if(!session_is_registered(myusername)) { 
echo "Access Denied!";
}else{
?>

<LI><a href="index.php">Welcome</a> 
<LI><a href="restore_squad.php">Restore Squad</a> 
<LI><a href="restore_division.php">Restore Division</a> 
<LI><a href="change_username.php">Change Username</a> 
<LI><a href="change_password.php">Change Password</a> 

<?php } ?>