<?php session_start();
  $_SESSION['current_img_ID'] = 1;

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gallery</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<div class="content-wrapper"></div>
	<header class="header">
		<div class="logo">
			<i class="fa fa-picture-o"> </i> <span class="logo-title">imageforest</span>
		</div>
			<div class="upload-form">

			<button id="upload_btn" title="upload image" class="upload-btn"><i class="fa fa-upload"></i>
</button>
			<input id="input_file" type="file" name="image">
			</div>
	</header>
	<div class="popup-info" id="popup_info"></div>
	<div class="title-wrapper">
		<h1 class="title">GALLERY</h1>
		<span class="title-image"><div class="side-line"><i class="fa fa-picture-o fa-4x"> </i></div></span>
		<h2 class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, esse.</h2>

		<a class="start-btn" href="#">VIEW IMAGES</a>
	</div>

	<div class="content">
		<div class="img-list">
			
		</div>
		<div id="more_img" class="more-img"><a href="#">MORE IMAGES</a></div>
	</div>
	<div class="view-image">
		
			<span><img src="upload_images/image_2.jpg" alt=""></span>
		<div class="controls">
			<a id="close" href="#"><i class="fa fa-times"></i></a>
			<a target="_blank" id="expand" href="#"><i class="fa fa-expand"></i></a>
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="js/myscript.js">

</script>
</html>