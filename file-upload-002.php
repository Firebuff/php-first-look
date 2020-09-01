<?php 

/* 多文件上传  */

	//判断前台是否有提交动作
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		upload();
	}

	//提交动作发生后要执行的判定
	function upload () {
		
		var_dump($_FILES);

		$imgs = $_FILES['imgs'];

		for ($i=0; $i < count($imgs['error']); $i++) {

			if ($imgs['error'][$i] !== UPLOAD_ERR_OK) {
				$GLOBALS['message'] = '上传失败';
				return;
			}
			$allowed_types = array('image/jpeg','image/png','image/jpg');

			// 图片类型校验
			if ( !in_array($imgs['type'][$i], $allowed_types) ) {
				$GLOBALS['message'] = '只能上传图片';
				return;
			}

			// 图片大小校验
			if ($imgs['size'][$i] > 2*1024*1024) {

				$GLOBALS['message'] = '上传的图片大小不能超过2M';
				return;
			}

			// 移动

			$temp_path = $imgs['tmp_name'][$i];

				//使用绝对路径保存图片，但是文件操作时只能使用相对路径，所以要处理前面的./
			$target_path = './images/' .uniqid(). '-'. $imgs['name'][$i]; 
			
			$move_status = move_uploaded_file($temp_path, $target_path);

			if ( !$move_status) {
				$GLOBALS['message'] = '上传失败';
				return;
			}

			$images[] = substr($target_path, 1);

			
		}

		$new_data = array(
			'id' => uniqid(),
			'name' => 'Tommy',
			'images' => $images
		);

		$datas = json_decode(file_get_contents('./data/data.json'),true);

		$datas[] = $new_data;

		file_put_contents('./data/data.json',json_encode($datas));
	}

	

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
 		
 		<input type="file" name="imgs[]" id="img" value="文件上传" multiple="multiple" accept="image/*">
 		
		<input type="submit" value="提交">
 	</form>
 	<div>
 		<?php  
 			if (isset($message)) {
 				echo $message;
 			}
 		 ?>
 	</div>
 </body>
 </html>