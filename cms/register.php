<?
if(isset($_POST['username'])) {
$user = $_POST['username'];
$pass = $_POST['password'];
$repass = $_POST['repassword'];
$email = $_POST['email'];
$reemail = $_POST['reemail'];
if(isset($_POST['moresquad'])) {
$checkbox = $_POST['moresquad'];
} else {
$checkbox = "";
}
if(isset($_POST['agreecheck'])) {
$terms = $_POST['agreecheck'];
} else {
$terms = "";
}

$squad = $_POST['squad'];
$code = $_POST['code'];
	if(empty($user) || empty($pass) || empty($repass) || empty($email) || empty($reemail) || empty($code) || $squad == 0) {//empty
	$_SESSION['error'] = 4;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";
	exit;
	}
	$user = cleanInput($user);
	$pass = md5($pass);
	$repass = md5($repass);
	if(!isset($terms)) {// terms agreed
	$_SESSION['error'] = 4;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";
	exit;
	}
	
	if(isset($checkbox)) {// need more squads
	$multi = "yes";
	}
	
	$sqlusername = "SELECT * FROM `useraccess`";// Same names
	$resultusername = mysql_query($sqlusername);
	while($rowusername = mysql_fetch_assoc($resultusername)) {
		if(strtolower($rowusername['username']) == strtolower($user)) {
		$_SESSION['error'] = 4;
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=error\";";
		echo "</script>";
		exit;
		}
	}
	
	if(!($pass == $repass) || !($email == $reemail)) {// same
	$_SESSION['error'] = 4;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";
	exit;
	}
	
	if (!ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $email)) { // Check Email if Valid or not
	$_SESSION['error'] = 4;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";
	exit;
	}
	//Code Test
	$code = str_replace("-", "", $code);
	$code = str_replace(" ", "", $code);
	$dbsql = "SELECT * FROM `codes`";
	$dbresult = mysql_query($dbsql);
	while($dbrow = mysql_fetch_assoc($dbresult)) {
		if($code == $dbrow['codechars'] && getDiviID($squad) == $dbrow['squadid']) {
		$sd = "DELETE FROM `codes` WHERE `codechars` = '".$code."'";
		mysql_query($sd);
		$passZ = 1;
		}
	}
	if(isset($passZ)) {
	
	//Create Records
	$sqlAccess = "INSERT INTO `useraccess` (`username`, `password`, `email`, `accesslevel`, `ipaddress`, `firststarted`) VALUES ('".$user."', '".$pass."', '".$email."', '0', '".$_SERVER['REMOTE_ADDR']."', '".date("m/d/y")."')";
	mysql_query($sqlAccess);
	$sqlSelectName = "SELECT * FROM `useraccess` WHERE `username` = '".$user."'";
	$resultSelectName = mysql_query($sqlSelectName);
	if($resultSelectName) {
	while($rowSelect = mysql_fetch_assoc($resultSelectName)) {
		logfile($rowSelect['id'], "Registered on Code: ".$code);
		$sl = "INSERT INTO `accesslevels` (`userid`, `level`, `s1id`) VALUES ('".$rowSelect['id']."', '0', '".$squad."')";
		mysql_query($sl);
		$aax = "INSERT INTO `requestlist` (`appid`, `squadid`, `multi`, `ip`) VALUES ('".$rowSelect['id']."', '".$squad."', '".$multi."', '".$_SERVER['REMOTE_ADDR']."')";
		if(mysql_query($aax)) {
		
		} else {
		}
	echo "Your account is now registered (but not enabled for use yet).<BR>You may go login and tryout your options.";
	}
	} else {
	echo mysql_error();
	}
	} else {
	$_SESSION['error'] = 4;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";
	exit;
	}
}
?>