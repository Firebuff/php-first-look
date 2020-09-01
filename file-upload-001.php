<?php 

/* 单文件上传  */

	//判断前台是否有提交动作

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		upload();
	}

	/*	提交动作发生时，后台要做事情：

			1. 判断前台是否有文件域;(是否选择了文件后点击的提交)

			2. 判断是否是正确的文件类型;

			3. 判断文文件大小是否是自己限定的;

			4. 判断获取到的文件 中下标 ['error'] 是否为 0；

			5. 判断从临时文件移动到指定目录是否成功；

	*/

	function upload () {

		var_dump($_FILES);

		// 1. 判断文件域
		if (empty($_FILES['img'])) {
			$GLOBALS['message'] = '请选择文件1';
			return;
		}

		$img = $_FILES['img'];

		// 2. 判断大小
		$correct_size = 1024*1024*3;

		if ($img['size'] > $correct_size) {
			$GLOBALS['message'] = '文件过大';
			return;
		}


		// 3. 判断文件类型
		$correct_types = array('image/png','image/jpg','image/jpeg');

		if ( !in_array($img['type'], $correct_types)) {
			$GLOBALS['message'] = '文件类型不正确';
			return;
		}

		//	4. 判断上传状态
		if ($img['error'] != UPLOAD_ERR_OK) {
			$GLOBALS['message'] = '上传失败2';
			return;
		}

		$temp_path = $img['tmp_name']; //上传文件的临时保存路径;

		$target_path = './images/' . $img['name']; //目标路径

		$move_status = move_uploaded_file($temp_path, $target_path); //移动文件到指定路径


		// 5. 判断移动文件的状态
		if (!$move_status) {
			$GLOBALS['message'] = '上传失败3';
		}
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
 		
 		<input type="file" name="img" id="img" value="文件上传">
 		
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