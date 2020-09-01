<?php
	
	$contents = file_get_contents('./files/names.txt');
	$lines = explode("\n", $contents);

	$data = array();

	foreach ($lines as $value) {
		$cols = explode('|', $value);
		$data[] = $cols;
		// var_dump($value);
	}
	// var_dump($data);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>所有人员资料</title>
</head>
<body>
	<h3>所有人员资料</h3>
	<table border="1">
		<thead>
			<tr>
				<th>编号</th>
				<th>姓名</th>
				<th>年龄</th>
				<th>邮箱</th>
				<th>网址</th>
			</tr>
		</thead>
		<tbody style="text-align:center;">

			<?php foreach ($data as $line): ?>
				<?php if (count($line) === 1): ?>

					<?php continue; ?>
				<?php endif ?>
				
				<tr>
					<?php foreach ($line as $item): ?>

						<?php $item = trim($item); ?>
						
						
						<?php if (strpos($item,'http://') === 0): ?>
							<td>
								<a href="<?php echo strtolower($item);?>">
									<?php echo strtolower(substr($item, 7)); ?>
								</a>
							</td>
						<?php else: ?>
							<td><?php echo $item;?></td>
						<?php endif ?>

						

					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
			 
		</tbody>
	</table>
</body>
</html>