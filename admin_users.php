<?php

session_start();

require('admin_check.php');
require('initdb.php');

$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);

$users = [];
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$users[] = $row;
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
				<h1>Users</h1>
				<form method="post" action="controller/user_add.php">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" required="required" />
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" required="required" />
					</div>
					<div class="form-group">
						<label>Permission</label>
						<select name="permission">
							<option value="0">User</option>
							<option value="1">Admin</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" value="Create" />
					</div>
				</form>
				<table class="admin-sales-table">
					<tr>
						<th>Action</th>
						<th>Id</th>
						<th>Username</th>
						<th>Password</th>
						<th>Permission (User = 0; Admin = 1)
					</tr>
					<?php foreach ($users as $user) { ?>
						<tr>
							<form method="post" action="controller/user_edit.php">
								<td>
									<input type="image" src="https://cdn3.iconfinder.com/data/icons/simplius-pack/512/pencil_and_paper-512.png" class="icon" />
									<a href="controller/user_remove.php?id=<?= $user['id'] ?>"><img class="icon" src="https://cdn3.iconfinder.com/data/icons/objects/512/Bin-512.png" /></a>
								</td>
								<td><input type="hidden" name="id" value="<?= $user['id'] ?>" /><?= $user['id'] ?></td>
								<td><input type="text" name="username" value="<?= $user['username'] ?>" /></td>
								<td><input type="password" name="password" value="" /></td>
								<td>
									<select name="permission">
										<option value="0" <?php if ($user['permission'] == 0) echo 'selected="selected"' ?>>User</option>
										<option value="1" <?php if ($user['permission'] == 1) echo 'selected="selected"' ?>>Admin</option>
									</select>
								</td>
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