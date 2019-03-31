<?php

session_start();

require('initdb.php');

// Get all categories
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

$categories = [];
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$categories[] = $row;
	}
}

$articles = [];
if (isset($_GET['category']) && $_GET['category'] !== "") {
	$sql = "SELECT * FROM link WHERE category_id = ?";
	$result = mysqli_query($conn, $sql);

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)) {
		mysqli_stmt_bind_param($stmt, "i", $_GET['category']);
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		$links = mysqli_fetch_all($result, MYSQLI_ASSOC);

		mysqli_stmt_close($stmt);
	}

	$intArray = [];
	foreach ($links as $link) {
		$intArray[] = $link['article_id'];
	}

	$articleList = implode(",", $intArray);

	$sql = "SELECT * FROM article WHERE id IN (" . $articleList . ")";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$articles[] = $row;
		}
	}

} else {
	$sql = "SELECT * FROM article";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$articles[] = $row;
		}
	}
}

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
			<div class="side">
				<ul class="category-list">
					<?php foreach ($categories as $category) { ?>
						<li><a href="?category=<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="main home-articlelist">
				<?php foreach ($articles as $article) { ?>
					<a href="article.php?id=<?= $article['id'] ?>">
						<div class="home-article">
							<div class="home-article-container">
								<div class="article-image-container" style="background: url('<?= $article['image'] ?>'); background-size: contain;background-repeat: no-repeat;background-position: center;">
								</div>
								<div class="article-body">
									<h3><?= $article['name'] ?></h3>
									<p>
										<?= $article['price'] ?> €
									</p>
								</div>
							</div>
						</div>
					</a>
				<?php } ?>
			</div>
		</div>
		<?php include("footer.php") ?>
	</div>
</body>
</html>