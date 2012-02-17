<?php
if(isset($_GET['s']) && isset($_GET['d'])) {
	if(isset($_GET['ds'])) {
	$myImage = imagecreatefromjpeg("squadv2.jpg");
	$color = imagecolorallocate($myImage, 255,255,255);
	imagettftext($myImage, 12, 0, 16, 30, $color, "rainbow6.ttf", $_GET['d']);
	imagettftext($myImage, 28, 0, 15, 55, $color, "rainbow6.ttf", $_GET['ds']." - ".$_GET['s']);
	imagettftext($myImage, 10, 0, 411, 10, $color, "rainbow6.ttf", "Squad Edit v2 Beta");
	header("Content-type: image/png");
	imagepng($myImage);
	imagedestroy($myImage);
	}
}
?>