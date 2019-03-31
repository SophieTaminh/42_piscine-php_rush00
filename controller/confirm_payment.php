<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../initdb.php');

if (isset($_SESSION['basket'])) 
{
	// Check if article in basket is 0 or less
	if (count($_SESSION['basket']) <= 0) 
	{
		header('Location: ../');
		exit(0);
	}
	
	foreach ($_SESSION['basket'] as $key => $basketArticle) 
	{
		if ($basketArticle <= 0) 
		{
			unset($_SESSION['basket'][$key]);
		}
	}

	// Prepare basket for display
	$basket = [];
	$totalPrice = 0.00;
	$articleList = implode(",", array_keys($_SESSION['basket']));

	$sql = "SELECT * FROM article WHERE id IN (" . $articleList . ")";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) 
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$row['quantity'] = $_SESSION['basket'][$row['id']];
			$basket[] = $row;
			$totalPrice += $row['quantity'] * $row['price'];
		}
	}

	$sql = "INSERT INTO history (username, total) VALUES (?, ?)";

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) 
	{
		$username = $_SESSION['username'];
		mysqli_stmt_bind_param($stmt, "sd", $username, $totalPrice);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}


	$id = mysqli_insert_id($conn);

	foreach ($basket as $basketArticle) 
	{
		$sql = "INSERT INTO history_link (history_id, article_id, quantity) VALUES (?, ?, ?)";

		$stmt = mysqli_stmt_init($conn);
		if (mysqli_stmt_prepare($stmt, $sql)) 
		{
			mysqli_stmt_bind_param($stmt, "iii", $id, $basketArticle['id'], $basketArticle['quantity']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}

	mysqli_close($conn);
	$_SESSION['basket'] = [];
}

header('Location: ../purchase.php');

?>