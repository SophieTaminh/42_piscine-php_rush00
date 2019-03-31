<?php

require('../initdb.php');

if (isset($_POST['username']) && $_POST['username'] !== ""
	&& isset($_POST['permission']) && is_numeric($_POST['permission'])
	&& isset($_POST['id']) && is_numeric($_POST['id'])) {

	if (isset($_POST['password']) && $_POST['password'] !== "") {
		$sql = "UPDATE user SET username = ?, permission = ?, password = ? WHERE id = ?";
	} else {
		$sql = "UPDATE user SET username = ?, permission = ? WHERE id = ?";
	}

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) {
		if (isset($_POST['password']) && $_POST['password'] !== "") {
			mysqli_stmt_bind_param($stmt, "sisi", $_POST['username'], intval($_POST['permission']), hash("whirlpool", $_POST['password']), $_POST['id']);
		} else {
			mysqli_stmt_bind_param($stmt, "sii", $_POST['username'], intval($_POST['permission']), $_POST['id']);
		}
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);
}

header('Location: ../admin_users.php');

?>