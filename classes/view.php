<?php
	class View {

		public function __contruct() {
			
		}

		public function render($key) {
			$_GET['key'] = $key;
			include 'models/view.php';
		}
	}

?>