<?php 

	/*-------------self表示当前类的名字----------------*/
	
	class User {
		public static $count = 0;

		public function __construct () {

			self::$count++;
		}
		public function showCount() {
			return self::$count;
		}

		public static function show () {

			/*
				非静态方法被self::调用，自动转成静态方法

				@self::xxx 调用普通方法和属性
			*/
			$count = @self::showCount(); 
			echo $count,'<br>';
		}
	}

	$user01 = new User();
	User::show();

	$user02 = new User();
	User::show();

	$user03 = new User();
	User::show();

	// echo $user01->showCount(), '<br>';

	// echo $user02->showCount(), '<br>';

	// echo $user03->showCount(), '<br>';




	/*--------静态成员可以被继承---------------------*/


	class Person {
		public static $name = 'robert';

		public static function showName () {
			echo 'hello';
		}
	}

	class Student extends Person {

	}

	//通过子类来访问继承下来的静态属性和方法
	echo Student::$name,'<br>';

	Student::showName();




 ?>