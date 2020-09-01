<?php 

	header('content-type:text/html;charset=utf-8');

	class Person {
		public static $name = 'robert';
		public static function show () {
			echo 'zhe是一个静态方法<br>';
		}
	}

	echo Person::$name,'<br>';
	Person::show();

 ?>