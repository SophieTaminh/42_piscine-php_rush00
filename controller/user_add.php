<?php

require('../initdb.php');

if ($_POST['username'] !== null && $_POST['username'] !== ""
	&& $_POST['password'] !== null && ($_POST['password'] !== ""))
{
	$sql = "INSERT INTO user (username, password, permission) VALUES (?, ?, ?)";
	
	$password = hash("whirlpool",$_POST['password']);
	
	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) 
	{
		$perm = 0;
		if (isset($_POST['permission']) && is_numeric($_POST['permission'])) {
			$perm = intval($_POST['permission']);
		}
		mysqli_stmt_bind_param($stmt, "ssi", $_POST['username'], $password, $perm);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	mysqli_close($conn);	
}

header('Location: ../admin_users.php');

?>