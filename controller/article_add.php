<?php

require('../initdb.php');

if ($_POST['name'] !== null && $_POST['name'] !== ""
	&& $_POST['price'] !== null && is_numeric($_POST['price'])) 
{
	$sql = "INSERT INTO article (name, description, price, image) VALUES (?, ?, ?, ?)";

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, "ssds", $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		echo mysqli_stmt_error($stmt);
		echo mysqli_error();
	}

	$id = mysqli_insert_id($conn);
	

	foreach ($_POST['categories'] as $category) {
		$sql = "INSERT INTO link (article_id, category_id) VALUES (?, ?)";

		$stmt = mysqli_stmt_init($conn);
		if (mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "ii", $id, $category);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}
	mysqli_close($conn);
}

header('Location: ../admin_articles.php');

?>