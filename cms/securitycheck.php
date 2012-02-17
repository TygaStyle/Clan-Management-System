<?php
unset($_SESSION['selectid']);
if(isset($_SESSION['id'])) {
	if(isset($_GET['divi']) && isset($_GET['sss'])) {
		if(dataRetrieve($_SESSION['id'], "accesslevel") <= 2) {
			$_SESSION['selectid'] = $_GET['sss'];
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=editSquad&i=view\";";
			echo "</script>";
		} elseif(dataRetrieve($_SESSION['id'], "accesslevel") == 3) {
			if(getDiviID($_GET['sss']) == dataRetrieve($_SESSION['id'], "clanleaderid")) {
			$_SESSION['selectid'] = $_GET['sss'];
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=editSquad&i=view\";";
			echo "</script>";
			} else {
			$_SESSION['error'] = 2;
			echo "<script language=\"javascript\">";
			echo "window.location=\"index.php?db=error\";";
			echo "</script>";
			}
		} elseif(dataRetrieve($_SESSION['id'], "accesslevel") >= 4) {
		$_SESSION['selectid'] = $_GET['sss'];
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=editSquad&i=view\";";
		echo "</script>";
		} else {
		$_SESSION['error'] = 2;
		echo "<script language=\"javascript\">";
		echo "window.location=\"index.php?db=error\";";
		echo "</script>";
		}
	} else {
	$_SESSION['error'] = 2;
	echo "<script language=\"javascript\">";
	echo "window.location=\"index.php?db=error\";";
	echo "</script>";
	}
} else {
$_SESSION['error'] = 2;
echo "<script language=\"javascript\">";
echo "window.location=\"index.php?db=error\";";
echo "</script>";
}
?>