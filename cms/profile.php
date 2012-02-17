<?
if(isset($_GET['v'])) {
$al = dataRetrieve($_GET['v'], "accesslevel");
	if($al <= 2) {
		$psql = mysql_query("SELECT * FROM `accesslevels` WHERE `userid` = '".$_GET['v']."'");
		$prow = mysql_fetch_row($psql);
		if($al == 0) {
			echo "Squad 1: ".getSquad($prow[3]);
		} elseif($al == 1) {
			echo "Squad 1: ".getSquad($prow[3]);
			echo "<BR>Squad 2: ".getSquad($prow[4]);
		} elseif($al == 2) {
			echo "Squad 1: ".getSquad($prow[3]);
			echo "<BR>Squad 2: ".getSquad($prow[4]);
			echo "<BR>Squad 3: ".getSquad($prow[5]);
		} 
	} elseif($al == 3) {
		echo "Division Control: ".diviname(dataRetrieve($_GET['v'], "clanleaderid"));
	} else {
		echo "Controls all squads";
	}
}
?>