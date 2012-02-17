<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$myImage = imagecreatefromjpeg("ad.jpg");

$myCopyright = imagecreatefrompng("pieChart.png");
$another_test = imagecreatefromgif("icons/settings.gif");
$x=imagesx($myCopyright);
$y=imagesy($myCopyright);
imagecopy($myImage, $myCopyright, 10, 10, 0, 0, $x, $y);
unset($x, $y);
$x=imagesx($another_test);
$y=imagesy($another_test);
imagecopy($myImage, $another_test, 11, 11, 0, 0, $x, $y);

//$color = imagecolorallocate($myImage, 255,255,255);
//imagettftext($myImage, 12, 0, 50, 50, $color, "visitor2.ttf", "Test Text");3
//imagettftext($myImage, 12, 0, 75, 75, $color, "visitor2.ttf", "Test Text2");
header("Content-type: image/png");
imagepng($myImage);
imagedestroy($myImage);
imagedestroy($myCopyright);
imagedestroy($another_test);
//imagedestroy($myCopyright);
?>