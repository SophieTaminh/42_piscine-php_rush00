<?php

session_start();

require('admin_check.php');
require('initdb.php');

$sql = "SELECT * FROM history";
$result = mysqli_query($conn, $sql);

$history = [];
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$history[] = $row;
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
				<h1>Historique des commandes</h1>
				<table class="admin-sales-table">
					<tr>
						
						<th>Client</th>
						<th>Date de la commande</th>
						<th>Total</th>
					</tr>
					<?php foreach ($history as $sale) { ?>
						<tr>
							
							<td><?= $sale['username'] ?></td>
							<td><?= $sale['payment_date'] ?></td>
							<td><?= $sale['total'] ?> €</td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<?php include("../footer.php") ?>
	</div>
</body>
</html>