<?php
echo "<form id='form1' name='form1' method='post' action='#' onSubmit=\"submitonce(this);\">";
echo "<select name='cc' id='cc' class='forms'>";
echo "<option value='0'>--Select Color--</option>";
$colorarray = array("White" => "FFFFFF", "Steel" => "999999", "Red" => "FF0000", "Orange" => "FF9900", "Yellow" => "FFFF00", "Light Green" => "00FF00", "Green" => "00CC00", "Dark Green" => "006600", "Blue" => "0000FF", "Cooler Blue" => "00688a", "Dark Blue" => "003399", "Dark Purple" => "990099", "Purple" => "FF00FF", "Pink" => "FF99FF", "Dark Pink" => "FF00CC", "Brown" => "993300", "Tan" => "999966");
foreach($colorarray as $key=>$value) {
echo "<option value=".$value.">".$key."</option>";
}
foreach($colorarray as $key=>$value) {
	foreach($colorarray as $keyb=>$valueb) {
		if($value == $valueb) {
		} else {
		echo "<option value=".$value."-".$valueb.">".$key." - ".$keyb."</option>";
		}
	}
}
foreach($colorarray as $key=>$value) {
	foreach($colorarray as $keyb=>$valueb) {
		foreach($colorarray as $keyc=>$valuec) {
			if($value == $valueb && $valueb == $valuec) {
			} else {
			echo "<option value=".$value."-".$valueb."-".$valuec.">".$key." - ".$keyb." - ".$keyc."</option>";
			}
		}
	}
}
echo "</select>";
echo "<input type='submit' name='Submit' value='Change Color' class='forms'>";

echo "</form>";

?>