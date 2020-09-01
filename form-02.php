<?php 

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		var_dump($_POST);
	}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		性别
		<label for="">
			<input type="radio" name="gender" id="" value="mal">
			男
		</label>
		<label for="">
			<input type="radio" name="gender" id="" value="femal">
			女
		</label>
		<label for="">
			<input type="checkbox" name="agree" id="" value="true">同意
		</label>
		<div>
			<button type="submit">提交</button>
		</div>
	</form>
</body>
</html>