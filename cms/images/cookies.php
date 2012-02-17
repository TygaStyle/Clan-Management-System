<?php
$myImage = imagecreatefromjpeg("cookies.jpg");

	
$color = imagecolorallocate($myImage, 0,0,0);
$head = imagecolorallocate($myImage, 185,204,0);

imagettftext($myImage, 20, 0, 11, 117, imagecolorallocate($myImage, 0,0,0), "agencyr.ttf", $gtbeta);
//imagettftext($myImage, 20, 0, 50, 30, $color, "agencyr.ttf", $gtbeta);

imagettftext($myImage, 12, 0, 20, 170, $color, "visitor2.ttf", "All your cookies Now belong to us");
//imagettftext($myImage, 12, 90, 8, 137, $color, "visitor2.ttf", "KSI Gaming Network");
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
