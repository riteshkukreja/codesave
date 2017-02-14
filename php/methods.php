<?php
	require_once 'database.php';

	$db = new Database;


	// Send back total number of submissions
	if (isset($_POST['submissions'])) {
		$table = "code_table";

		$n = $db->getNumRows($table);

		echo $n;
	}
?>