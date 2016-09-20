	function uploadImage(e) {
		$("#upload_btn").html("<i class='fa fa-spinner fa-pulse'></i>");
		var file = e.target.files[0];
		var data = new FormData();
		if (file) {
			var xhr = new XMLHttpRequest();
			xhr.onload = xhr.onerror = function() {
				if (this.status == 200) {
					$("#upload_btn").html("<i class='fa fa-upload'></i>");
					if (xhr.responseText == "OK") {
						  $("#popup_info").addClass("upload-success").html("<i class='fa fa-check'></i> Image uploaded");
						  setTimeout(function () {
						  	$("#popup_info").removeClass("upload-success");
						  },3000);
						  $("#more_img").addClass("visible");
					} else {
						$("#popup_info").addClass("upload-warning").html("<i class='fa fa-exclamation'></i> Image don't match parameters");
						setTimeout(function () {
						  	$("#popup_info").removeClass("upload-warning");
						  },3000);
					}
					console.log(xhr.responseText);
			    } else {
			    	$("#popup_info").addClass("upload-error").html("<i class='fa fa-exclamation'></i> Error");
			    	setTimeout(function () {
						  	$("#popup_info").removeClass("upload-error");
						  },3000);
			      console.log("error " + this.status);
			    }
			}
			xhr.open("POST","upload_image.php",true);
			data.append('image',file);

			xhr.send(data);
		}
		return false;
	}

	$("#upload_btn").click(function() {
		$(this).next().trigger('click');
	});

	$("#input_file").change(uploadImage);

	$("#more_img").click(function(e) {
		e.preventDefault();
		$.ajax("addimg.php")
		.done(function(data) {
			$(".img-list").append(data);
			$(".img-link").click(imageView);
			if (getCookie("imgs") == $(".img").length) {
				$("#more_img").removeClass("visible");
			}
		});
	});

	$(".start-btn").click(function () {
		$(".title-wrapper").addClass("hidden");

		setTimeout(function () {
			$.ajax("addimg.php")
		.done(function(data) {
			$(".img-list").append(data);
			$(".img-link").click(imageView);
		});
		$(".header").addClass("visible");
		$("#more_img").addClass("visible");
		},1000);
		
	});



	function imageView(e) {
		e.stopPropagation();
		e.preventDefault();
		var link = $(this).attr("href");
		$("#expand").attr("href",link);
		$(".view-image").addClass("visible").find("img").attr("src",link);

	}

	$("#close").click(function (e) {
		e.preventDefault();
		$(".view-image").removeClass("visible");
	});

	// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}