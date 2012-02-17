<?

##############################################################################################
$connection = mysql_connect("localhost", "realityd_cms", "collin");
mysql_select_db("realityd_cms", $connection);
##############################################################################################
session_start();
include("functions/functions.php");

if(isset($_POST['username']) && isset($_POST['password'])) {
	$username = cleanInput($_POST['username']);
	$password = md5(cleanInput($_POST['password']));
	if(empty($username) || empty($password)) {
		$_SESSION['error'] = "1";
		header("Location: index.php?db=error");
	} else {
		$sql = "SELECT * FROM `useraccess` WHERE `username` = '".$username."'";
		$result = mysql_query($sql);
		if($result) {
		if(mysql_num_rows($result) == 0) {
			$_SESSION['error'] = 1;
			header("Location: index.php?db=error");
		}
			while($row = mysql_fetch_assoc($result)) {
			
				if($password == $row['password']) {
					$_SESSION['id'] = $row['id'];
					lastactive($row['id']);
					logfile($row['id'], "Logged In ".date('h:i:s A'));
					header("Location: index.php?db=cp");
				} else {
					
					$_SESSION['error'] = 1;
					header("Location: index.php?db=error");
				}
			}
		} else {
			$_SESSION['error'] = 1;
			header("Location: index.php?db=error");
		}
	}
} else {
$_SESSION['error'] = 1;
header("Location: index.php?db=error");
}

?>