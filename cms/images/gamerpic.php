<?
if(isset($_GET['text'])) {
	if(isset($_GET['rgb'])) {
		if(strlen($_GET['rgb']) < 7) {
		$r = 255;
		$g = 255;
		$b = 255;
		} else {
		list($r, $g , $b) = explode("-", $_GET['rgb']);
		}
		$image = imagecreate(198, 15);
		$white = imagecolorallocate($image, 0, 0, 0);
		$black = imagecolorallocate($image, $r, $g, $b);
		imagefttext($image, 12, 0, 1, 11, $black, "visitor2.ttf", $_GET['text']);
		header("Content-type: image/jpeg");
		imagejpeg($image);
		imagedestroy($image);
	}
}
?>