<?php 
	
	header('content-type:text/html;charset=utf-8');

	class A {
		private $name = 'robert';

		public function showA() {
			echo $this -> name .'<br>';
		}
	}

	class B extends A{
		// private $name = 'js';

		public function showB() {
			// var_dump($this);
			echo $this->name;
		}
	}

	$b = new B();

	$b -> showB();

 ?>