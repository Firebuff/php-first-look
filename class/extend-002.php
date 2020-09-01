<?php 


	/* ------------------构造函数继承-------------------- */


	class Person {

		public function __construct () {

			echo "我是父类的构造函数的打印" .'<br>';
		}
	}

	class Student extends Person {

		public function __construct () {

			echo "我是子类的构造函数的打印" .'<br>';

			// parent::__construct();
			// Person::__construct();
		}

	}

	$stu = new Student();

	/*
		1、如果子类没有构造函数，就调用父类的构造函数

		2、如果子类有构造函数就调用自己的构造函数

		3、通过parent来调用父类的构造函数

	*/

	






 ?>