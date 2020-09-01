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
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<div>
			<label for="name">名字</label>
			<input type="text" name="name" id="name">
		</div>
		<div>
			<label for="password">密码</label>
			<input type="password" id="password" name="password">
		</div>
		<button type="submit">提交</button>
	</form>
</body>
</html>