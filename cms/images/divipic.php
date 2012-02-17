<?php
if(isset($_GET['ds']) && isset($_GET['d'])) {
	
	
	if($_GET['ds'] == "LS") {
	$myImage = imagecreatefrompng("divi/clannetbanner.png");
	$color = imagecolorallocate($myImage, 0,0,0);
	imagettftext($myImage, 12, 0, 16, 30, $color, "rainbow6.ttf", $_GET['d']);
	imagettftext($myImage, 28, 0, 15, 55, $color, "rainbow6.ttf", $_GET['ds']);
	} elseif($_GET['ds'] == "SA") {
	$myImage = imagecreatefrompng("http://i143.photobucket.com/albums/r127/ksi7/silentassassinscopy.png");
	} else {
	$myImage = imagecreatefromjpeg("divi.jpg");
	$color = imagecolorallocate($myImage, 0,0,0);
	imagettftext($myImage, 12, 0, 16, 30, $color, "rainbow6.ttf", $_GET['d']);
	imagettftext($myImage, 28, 0, 15, 55, $color, "rainbow6.ttf", $_GET['ds']);
	}
	//imagettftext($myImage, 10, 0, 390, 10, $color, "rainbow6.ttf", "KSIClan.net");
	header("Content-type: image/png");
	imagepng($myImage);
	imagedestroy($myImage);
}
?>