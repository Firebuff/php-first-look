<?php 

	/*----------------- 属性和方法的继承-----------------*/


	class Person {
		protected  $name = 'lucy';
		protected $gender = 'male';
		protected $id = '001';
		public function getName () {
			echo 'everybody must has a name' .'<br>';
		}

		protected function showGender () {
			echo $this -> id .'<br>';
		}
	}

	class Student extends Person {
		protected $name = 'robert';
		protected $gender = 'female';
		public function showName () {

			// 如果父类的属性要在子类中被访问到， 要将属性设置为 protected
			echo $this -> name.'<br>'; 

			//如果子类和父类都有同名的 protected 属性，那么在子类中访问会遵循就近原则；
			echo $this -> gender.'<br>'; // female

			$this -> showGender(); // 调用父类的方法
		}

	}

	$stu = new Student;

	$stu -> getName();



	//子类继承了父类的所有属性和方法，但是不一定有权限调用

	$stu -> showName();

	 /*
	 总结：子类在继承父类时，子类只能访问和调用父类中的 修饰符为 protected 或者 public 的属性和方法，

	 不能访问private属性和方法； 如果子类也有 和父类同名的 protected 的属性和方法 ，

	 则遵循就近原则（先访问子类自己的，如果子类没有则访问父类的）；

	 */
	



 ?>