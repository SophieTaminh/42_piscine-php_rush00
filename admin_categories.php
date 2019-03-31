<?php

session_start();

require('admin_check.php');
require('initdb.php');

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
				<h1>Categories</h1>
				<form method="post" action="controller/category_add.php">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" />
					</div>
					<div class="form-group">
						<input type="submit" value="Create" />
					</div>
				</form>
				<table class="admin-sales-table">
					<tr>
						<th>Action</th>
						<th>Id</th>
						<th>Name</th>
					</tr>
					<?php foreach ($categories as $category) { ?>
						<tr>
							<td>
								<a href="controller/category_remove.php?id=<?= $category['id'] ?>"><img class="icon" src="https://cdn3.iconfinder.com/data/icons/objects/512/Bin-512.png" /></a>
							</td>
							<td><?= $category['id'] ?></td>
							<td>
								<form method="post" action="controller/category_edit.php">
									<input type="text" name="name" value="<?= $category['name'] ?>" />
									<input type="hidden" name="id" value="<?= $category['id'] ?>" />
									<input type="image" src="https://cdn3.iconfinder.com/data/icons/simplius-pack/512/pencil_and_paper-512.png" class="icon" />
								</form>
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<?php include("../footer.php") ?>
	</div>
</body>
</html>