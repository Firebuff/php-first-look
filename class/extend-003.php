<?php 


	/* ------------------子类给父类的构造函数传递参数-------------------- */


	class Person {

		protected $name;
		protected $sex;

		public function __construct($name,$sex) {
			$this -> name = $name;
			$this -> sex = $sex;
		}
	}

	class Student extends Person {

		private $score;

		public function __construct ($name, $sex, $score) {

			parent::__construct($name, $sex); //调用父类的构造函数并传参

			$this -> score = $score;

		}

		public function show () {
			
			echo "name: {$this->name} <br>"; //访问父类的属性 name

			echo "gender: {$this->sex} <br>"; //访问父类的属性 sex

			echo "score: {$this->score} <br>"; //访问子类的属性score
		}


	}

	$stu = new Student('robert','male','100');

	$stu -> show();

	
	
	






 ?>