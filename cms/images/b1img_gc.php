<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$gtbeta = "KSI Kill Steal";
/*
		$GamerCard['tag'] = str_replace('%20', ' ', $_TAG);
		@$GamerCard['zone'] = $gamer[1][2];
		@$GamerCard['style'] = $gtagstyle[1];
		@$GamerCard['tile'] = $gtile[1];
		@$GamerCard['rep'] = 'http://gamercard.xbox.com'. $grep[1];
		@$GamerCard['score'] = $gamer[1][1];
		@$GamerCard['scoreimg'] = 'http://gamercard.xbox.com'. $gscoreimg[1];
		@$GamerCard['lastplayedhtml'] = $glastplayed[1][0];
		@$GamerCard['lastplayed'] = array();
		@$lastplayedhtml = explode('</a>', $GamerCard['lastplayedhtml']);
*/

	require_once('../functions/Snoopy.class.php');
	require_once('../functions/GamerCard.class.php');
	
	$_TAG = str_replace(" ", "+", $gtbeta);
	if(isset($_GET['gamertag']))
		if (is_string($_GET['gamertag']))
			$_TAG = str_replace(' ', '%20', $_GET['gamertag']);
	
	$_FORCE = false;
	if(isset($_GET['force']))
		if (is_numeric($_GET['force']))
			$_FORCE = ($_GET['force'] == 1);
$GamerCard = GamerCard::Fetch($_TAG, $_FORCE);


$extra = strlen(str_replace(" ", "+", $gtbeta));

$five = str_replace(" /></a>", "border=0 /></a> ", $GamerCard['lastplayedhtml']);
$new = substr($five, (183+$extra), 94); 
//if(file_exists($new)) {
$myImage = imagecreatefromjpeg("gamercard.jpg");

//$myCopyright = imagecreatefromjpeg($new);

//$x=imagesx($myCopyright);
//$y=imagesy($myCopyright);
//imagecopy($myImage, $myCopyright, 145, 113, 0, 0, $x, $y);    // PLACE IMG



/*
$another_test = imagecreatefromgif("icons/settings.gif");
unset($x, $y);
$x=imagesx($another_test);
$y=imagesy($another_test);
imagecopy($myImage, $another_test, 11, 11, 0, 0, $x, $y);
*/
$var = "sdfd";
	
$color = imagecolorallocate($myImage, 255,255,255);
$head = imagecolorallocate($myImage, 185,204,0);
imagettftext($myImage, 12, 0, 25, 20, $color, "visitor2.ttf", $gtbeta);

if(empty($GamerCard['zone'])) {
$red = imagecolorallocate($myImage, 255,0,0);
imagettftext($myImage, 10, 0, 25, 45, $red, "visitor2.ttf", "Xbox.com is currently down");
}

imagettftext($myImage, 12, 0, 25, 57, $color, "visitor2.ttf", "Gamerscore");
imagettftext($myImage, 12, 0, 25, 83, $color, "visitor2.ttf", "Gamerzone");
imagettftext($myImage, 12, 0, 29, 95, $color, "visitor2.ttf", $GamerCard['zone']);
imagettftext($myImage, 12, 0, 29, 69, $color, "visitor2.ttf", $GamerCard['score']);

imagettftext($myImage, 12, 0, 25, 123, $color, "visitor2.ttf", "KSI Rank");
imagettftext($myImage, 12, 0, 29, 135, $color, "visitor2.ttf", "Clan Leader");
imagettftext($myImage, 12, 90, 8, 147, $color, "visitor2.ttf", "KSI Gaming Network");
header("Content-type: image/png");
imagepng($myImage);
imagedestroy($myImage);
imagedestroy($myCopyright);
//imagedestroy($another_test);
//imagedestroy($myCopyright);

//} else {
//echo "xbox down";
//}
?>
