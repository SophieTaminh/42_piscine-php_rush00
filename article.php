<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id']) || $_GET['id'] === "" || !is_numeric($_GET['id'])) {
	header('Location: .');
}

$isAdding = false;
if (isset($_POST['quantity']) && is_numeric($_POST['quantity'])) {
	$isAdding = true;

	$quantity = intval($_POST['quantity']);
	if (!isset($_SESSION['basket'])) {
		$_SESSION['basket'] = [];
	}
	for ($i = 0; $i < $quantity; $i++) {
		if (!isset($_SESSION['basket'][intval($_GET['id'])])) {
			$_SESSION['basket'][intval($_GET['id'])] = 0;
		}
		$_SESSION['basket'][intval($_GET['id'])]++;
	}
}

require("initdb.php");


// Get article
$article = null;
$sql = "SELECT * FROM article WHERE id = ?";
$result = mysqli_query($conn, $sql);

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
	mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	$article = mysqli_fetch_array($result);

	mysqli_stmt_close($stmt);
}

if (!$article) {
	header('Location: .');
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
	<title>ft_minishop</title>
	<link rel="stylesheet" type="text/css" href="ft_minishop.css">
</head>
<body>
	<div class="vwrapper">
		<?php include("header.php") ?>
		<div class="middle">
			<div class="main article-main">
				<div class="article-image-container">
					<img class="article-image" src="<?= $article['image'] ?>" />
				</div>
				<div class="article-body-container">
					<h2><?= $article['name'] ?></h2>
					<p>
						<?= $article['description'] ?>
					</p>
				</div>
				<div class="article-price-container">
					<form class="article-form" method="post" action="article.php?id=<?= $_GET['id'] ?>">
						<input type="hidden" name="id" value="<?= $_GET['id'] ?>" />
						<div class="article-price">
							<?= $article['price'] ?> €
						</div>
						<div class="form-group">
							<label>Quantity : </label>
							<input type="number" name="quantity" />
						</div>
						<div>
							<input type="submit" value="Add to basket" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php include("footer.php") ?>
	</div>
</body>
</html>