<?php
	require_once 'database.php';

	$db = new Database;

	$table = "code_table";
	$result = array();

	if (isset($_POST['key'])){
		$key = $_POST['key'];

		if($key == "") {
			$result['success'] = false;
			$result['message'] = 'Values not given!';
			echo json_encode($result);
			return; 
		}

		$constraints = array(
				array('id', $key)
			);

		if($data = $db->getRows($table, null, $constraints)) {
			$result['success'] = true;
			$result['message'] = $data[0];
		} else {
			$result['success'] = false;
			$result['message'] = '500 Server Error!';
		}
	} else {
		$result['success'] = false;
		$result['message'] = 'Values not given!';
	}

	echo json_encode($result);
?>