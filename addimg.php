<?php
session_start();
setrawcookie("imgs");
$img_count = simplexml_load_file('images_count.xml');
$animation_delay = 0;
for ($i=0; $i < 4; $i++) { 
	if ($_SESSION['current_img_ID'] > $img_count->count) {
		setrawcookie("imgs", $img_count->count);
		break;
	}

	$style = "animation: appear .3s ease-out forwards ".$animation_delay."s";

	$img_set .= "<div class='img'><a class='img-link' href='upload_images/image_".$_SESSION['current_img_ID'].".jpg'><img style='".$style."' src='images_preview/image_preview_".
	$_SESSION['current_img_ID'].".jpg' alt=''></a></div>";

	$_SESSION['current_img_ID']++;
	$animation_delay += 0.2;
}
echo $img_set;
?>