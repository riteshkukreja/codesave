<?php

	class Route {
		private $_uri = array();
		private $_method = array();
		private $_error = array();

		// Add Method
		public function add($uri, $func = null) {
			$this->_uri[] = '/'.trim($uri, '/');
			
			if($func != null) {
				
					$this->_method[] = $func;
			}
		}

		public function error($type, $func = null) {
			$this->_error[$type] = $func;
		}

		public function submit() {
			$u = isset($_GET['uri']) ? '/'.$_GET['uri'] : '/';
			$flag = 0;
			foreach($this->_uri as $key => $value) {
				$params = array();
				if(preg_match("#^$value$#", $u, $params)) {
					$flag = 1;
					if(is_string($this->_method[$key])) {

						$useMethod = $this->_method[$key];
						$obj = new $useMethod();
						if(isset($params[1])) {
							$obj->render($params[1]);
						} else {
							$obj->render();
						}
						

					} else {

						call_user_func($this->_method[$key]);

					}
				}
			}

			if($flag == 0) {
				$obj = new $this->_error['404']();
				$obj->render();
			}
		}
	}

?>