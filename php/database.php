<?php

	/**
	 * Copyright 
	 * Developer : Ritesh Kukreja
	 * Note: class 'Database'  for databse entry
	 *		It uses MYSQLI object
	 */

	class Database {

		private $db = null;

		public function __construct() {
			if(!$this->connect()) {
				exit();
			}
		}

		public function __destruct() {
			$this->db->close();
		}

		private function connect() {
			$host = "localhost";
			$user = "root";
			$pass = "";
			$database = "codesave";

			$this->db = new mysqli($host, $user, $pass, $database);

			/* check connection */
			if ($this->db->connect_errno) {
			    printf("Connect failed: %s\n", $db->connect_error);
			   return false;
			}
			return true;
		}
		
		public function getRows($table, $params = null, $constraints = null, $constraint_type = false, $limit = null, $order_col = null, $order = "ASC") {
			$sql = "SELECT ";

			if($params != null) {
				foreach($params as $param) {
					$sql .= $param . " , ";
				}
				$sql = rtrim($sql, ", ");
			} else {
				$sql .= " * ";
			}

			$sql .= " FROM " . $table;

			if($constraints != null) {
				$sql .= " WHERE ";
				if($constraint_type != false) {
					$sql .= $this->generateUnstrictConstraints($constraints);
				} else {
					$sql .= $this->generateStrictConstraints($constraints);
				}
			}

			
			if($order_col != null) {
				$sql .= " ORDER BY " . $order_col . " " . $order;
			}

			if($limit != null) {
				$sql .= " LIMIT " . $limit . " ";
			}

			$res = $this->execute($sql);
			if($res != false) {
				return $this->getData($res, MYSQLI_ASSOC);
			}

			return false;
		}

		public function addRow($table, $params = null) {
			$sql = "INSERT INTO " . $table; 

			if($params != null) {
				$sql .= " ( ";
				foreach($params as $param) {
					$sql .= $param[0]  . " , ";
				}
				$sql = rtrim($sql, ", ");
				$sql .= " ) ";

			} else {
				return false;
			}


			$sql .= " VALUES ( ";

			foreach($params as $param) {
				$sql .= "'" . $param[1] .  "' , ";
			}
			$sql = rtrim($sql, ", ");
			

			$sql .= " ) ";

			return $this->execute($sql);
		}

		public function updateRows($table, $params = null, $constraints = null, $constraint_type = false) {
			$sql = "UPDATE " . $table . " SET ";

			if($params != null) {
				foreach($params as $param) {
					$sql .= $param[0] . " = '" . $param[1] . "' , ";
				}
				$sql = rtrim($sql, ", ");
			} else {
				return false;
			}

			if($constraints != null) {
				$sql .= " WHERE ";
				if($constraint_type != false) {
					$sql .= $this->generateUnstrictConstraints($constraints);
				} else {
					$sql .= $this->generateStrictConstraints($constraints);
				}
			}

			return $this->execute($sql);
		}

		public function delRows($table, $constraints = null, $constraint_type = false) {
			$sql = "DELETE FROM " . $table;

			if($constraints != null) {
				$sql .= " WHERE ";
				if($constraint_type != false) {
					$sql .= $this->generateUnstrictConstraints($constraints);
				} else {
					$sql .= $this->generateStrictConstraints($constraints);
				}
			}

			return $this->execute($sql);
		}

		public function isPresent($table, $cols, $values) {
			$constraints = array();
			$i = 0;
			foreach ($values as $value) {
				$con = array(
						$cols[$i], $value, 0
					);

				array_push($constraints, $con);
			}

			$res = $this->getRows($table, $cols, $constraints);
			if($res) {
				return true;
			}
			return false;
		}

		public function getNumRows($table, $constraints = null, $constraint_type = false) {
			$sql = "SELECT * ";

			$sql .= " FROM " . $table;

			if($constraints != null) {
				$sql .= " WHERE ";
				if($constraint_type != false) {
					$sql .= $this->generateUnstrictConstraints($constraints);
				} else {
					$sql .= $this->generateStrictConstraints($constraints);
				}
			}

			$res = $this->execute($sql);
			if($res != false) {
				return $res->num_rows;
			}

			return false;
		}


		private function generateStrictConstraints($constraints) {
			$sql = "";
			foreach($constraints as $constraint) {
				if($constraint[2] != 1)
					$sql .= $constraint[0] . " = '" . $constraint[1] . "' AND ";
				else
					$sql .= $constraint[0] . " LIKE '" . $constraint[1] . "' AND ";
			}
			$sql = rtrim($sql, "AND ");

			return $sql;
		}	

		private function generateUnstrictConstraints($constraints) {
			$sql = "";
			foreach($constraints as $constraint) {
				if($constraint[2] != 1)
					$sql .= $constraint[0] . " = '" . $constraint[1] . "' OR ";
				else
					$sql .= $constraint[0] . " LIKE '" . $constraint[1] . "' OR ";
			}
			$sql = rtrim($sql, "OR ");

			return $sql;
		}	

		private function execute($sql) {
			//echo $sql;
			return $this->db->query($sql);
		}	

		private function getData($res, $mode) {
			if(!$res) {
				return false;
			}

			$data = array();
			while($d = $res->fetch_array($mode)) {
				$data[] = $d;
			}
			return $data;
		}			
	}
?>
