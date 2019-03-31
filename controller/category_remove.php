<?php

require('../initdb.php');

if ($_GET['id'] !== null && is_numeric($_GET['id'])) {
	$sql = "DELETE FROM category WHERE id = ?";

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

header('Location: ../admin_categories.php');

?>