<?php

require('../initdb.php');

if ($_POST['name'] !== null && $_POST['name'] !== "") {
	$sql = "INSERT INTO category (name) VALUES (?)";

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, "s", $_POST['name']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

header('Location: ../admin_categories.php');

?>