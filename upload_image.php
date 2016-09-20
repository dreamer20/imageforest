<?php
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
	list($img_width, $img_height) = getimagesize($_FILES['image']['tmp_name']);
	$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	if ($img_width < 500 || $img_height < 500 || !$ext == "jpeg" || !$ext == "jpg") {
		echo "ERR";
	} else {
		$img_count = simplexml_load_file('images_count.xml');
		$upload_dir = "upload_images";
		$preview_dir = "images_preview";
		$ext = ".".pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		$img_ID = $img_count->count + 1;
		$img_name = "image_".$img_ID.$ext;
		$img_path = "$upload_dir/$img_name";
		$img_height = 250;
		$img_width = 250;
		$default_img_size = 250;
		move_uploaded_file($_FILES['image']['tmp_name'], $img_path);

		list($img_width_orig, $img_height_orig) = getimagesize($img_path);
		$img_ratio_orig = $img_width_orig/$img_height_orig;

		if ($img_width/$img_height > $img_ratio_orig) {
		   $img_width = $img_height*$img_ratio_orig;
		} else {
		   $img_height = $img_width/$img_ratio_orig;
		   
		}

		if ($img_height < $default_img_size) {
			for ($img_height; $img_height < $default_img_size; $img_height++) $img_width++;
		} else {
			for ($img_width; $img_width < $default_img_size; $img_width++) $img_height++;
		}

		$img_start_pos_x = $img_width-$default_img_size;
		$img_start_pos_y = $img_height-$default_img_size;

		if ($img_start_pos_x > 0) {
			$img_start_pos_x /= 2;
		} else {
			$img_start_pos_y /= 2;
		}

		$image_p = imagecreatetruecolor($default_img_size, $default_img_size);
		$image = imagecreatefromjpeg($img_path);
		imagecopyresampled($image_p, $image, 0, 0, $img_start_pos_x, $img_start_pos_y, $img_width, $img_height, $img_width_orig, $img_height_orig);
		imagejpeg($image_p , $preview_dir. "/image_preview_".$img_ID.$ext,100);
		imagedestroy($image_p);
		$img_count->count++;
		$img_count->asXML('images_count.xml');
		echo "OK";
	}
} else {
	echo "во время загрузки произошла ошибка";
}
?>