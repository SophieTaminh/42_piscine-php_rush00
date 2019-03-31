<?php

session_start();

require('admin_check.php');
require('initdb.php');

// Get all articles
$sql = "SELECT * FROM article";
$result = mysqli_query($conn, $sql);

$articles = [];
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$articles[] = $row;
	}
}

// Get all categories
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

$categories = [];
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$categories[] = $row;
	}
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
			<?php include("admin_sidebar.php") ?>
			<div class="main admin-list">
				<h1>Articles</h1>
				<form method="post" action="controller/article_add.php">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" value="" required="required" />
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea name="description"></textarea>
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="number" step="0.01" name="price" value="" required="required" /> €
					</div>

					<div class="form-group">
						<label>Image link</label>
						<input name="image" value="" />
					</div>
					<div class="form-group">
						<label>Categories : Maintenir la touche Cmd pour sélectionner plusieurs catégories</label>
						<br>
						<select name="categories[]" size="<?= count($categories) ?>" multiple>
							<?php foreach($categories as $category) { ?>
								<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<input class="header-link" type="submit" value="Create" ></input>
				</form>
				<table class="admin-sales-table">
					<tr>
						<th>Action</th>
						<th>Id</th>
						<th>Name</th>
						<th>Image</th>
						<th>Description</th>
						<th>Price</th>
					</tr>
					<?php foreach ($articles as $article) { ?>
						<tr>
							<form method="post" action="controller/article_edit.php">
								<td>
									<input type="image" class="icon" src="https://cdn3.iconfinder.com/data/icons/simplius-pack/512/pencil_and_paper-512.png" />
									<a href="controller/article_remove.php?id=<?= $article['id'] ?>"><img class="icon" src="https://cdn3.iconfinder.com/data/icons/objects/512/Bin-512.png" /></a>
								</td>
								<td><input type="hidden" name="id" value="<?= $article['id'] ?>" /><?= $article['id'] ?></td>
								<td><input type="text" name="name" value="<?= $article['name'] ?>" /></td>
								<td>
									<input name="image" value="<?= $article['image'] ?>" /><br/>
									<?php if ($article['image'] !== "") { ?>
										<img class="icon" src="<?= $article['image'] ?>" />
									<?php } ?>
								</td>
								<td>
									<textarea name="description"><?= $article['description'] ?></textarea>
								</td>
								<td><input type="number" step="0.01" name="price" value="<?= $article['price'] ?>" /> €</td>
							</form>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<?php include("../footer.php") ?>
	</div>
</body>
</html>