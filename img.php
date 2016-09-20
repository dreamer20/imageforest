<?php

$height = 250;
$width = 250;

list($width_orig, $height_orig) = getimagesize("Koala.jpg");

$ratio_orig = $width_orig/$height_orig;



if ($width/$height > $ratio_orig) {
   $width = $height*$ratio_orig;
   for ($width ; $width  < 250; $width ++) { 
	$height++;
	}
} else {
   $height = $width/$ratio_orig;
   for ($height; $height < 250; $height++) { 
	$width++;
	}
}


$x_start = $width-250;
$y_start = $height-250;
if ($x_start > 0) {
	$x_start /= 2;
} else {
	$y_start /= 2;
}
$image_p = imagecreatetruecolor(250, 250);

switch (strtolower($ext)) {
	case 'jpeg':
	case 'jpg':
		$image = imagecreatefromjpeg($filename);
		break;
	case 'png':
		$image = imagecreatefrompng($filename);
		break;
	case 'gif':	
		$image = imagecreatefromgif($filename);
		break;
	default:
		# code...
		break;
}
$filePreviewName = "pic".$id."_preview.jpg";
$filePath = "upload_preview/".$filePreviewName;
$image = imagecreatefromjpeg("Koala.jpg");
imagecopyresampled($image_p, $image, 0, 0, $x_start, $y_start, $width, $height, $width_orig, $height_orig);

header('Content-Type: image/jpeg');
imagejpeg($image_p , null,100);
// imagejpeg($image , null,100);
imagedestroy($image_p);


?>