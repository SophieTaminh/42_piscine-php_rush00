<?php

require('../initdb.php');

if ($_POST['name'] !== null && $_POST['name'] !== ""
	&& $_POST['id'] !== null && is_numeric($_POST['id'])) {
	$sql = "UPDATE category SET name = ? WHERE id = ?";

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, "si", $_POST['name'], $_POST['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

header('Location: ../admin_categories.php');

?>