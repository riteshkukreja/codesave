<?php
	require_once 'database.php';

	$db = new Database;

	$table = "code_table";
	$result = array();

	if (isset($_POST['code']) && isset($_POST['author'])){
		$code = $_POST['code'];
		$author = $_POST['author'];

		if($code == "" || $author == "") {
			$result['success'] = false;
			$result['message'] = 'Values not given!';
			echo json_encode($result);
			return; 
		}

		$key = uniqid();

		$values = array(
				array('code', $code),
				array('author', $author),
				array('id', $key)
			);

		if($db->addRow($table, $values)) {
			$result['success'] = true;
			$result['message'] = $key;
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