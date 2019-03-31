<?php

session_start();

require('initdb.php');

// Basket change
if (isset($_POST['id']) && is_numeric($_POST['id'])
	&& isset($_POST['quantity']) && is_numeric($_POST['quantity'])
	&& isset($_SESSION['basket'])
	&& isset($_SESSION['basket'][$_POST['id']])) {
	$_SESSION['basket'][$_POST['id']] = $_POST['quantity'];
}

// Check if article in basket is 0 or less
if (isset($_SESSION['basket'])) {
	foreach ($_SESSION['basket'] as $key => $basketArticle) {
		if ($basketArticle <= 0) {
			unset($_SESSION['basket'][$key]);
		}
	}
}

// Prepare basket for display
$basket = [];
$totalPrice = 0.00;
if (isset($_SESSION['basket'])) {
	$articleList = implode(",", array_keys($_SESSION['basket']));

	$sql = "SELECT * FROM article WHERE id IN (" . $articleList . ")";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$row['quantity'] = $_SESSION['basket'][$row['id']];
			$basket[] = $row;
			$totalPrice += $row['quantity'] * $row['price'];
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
			<div class="main basket-main">
				<h1>Recapitulatif du contenu de votre panier</h1>
				<div class="basket-article-container">
					<table class="basket-article-table">
						<tr>
							<th>Action</th>
							<th>Article</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
						<?php foreach ($basket as $basketArticle) { ?>
							<tr>
								<td><img class="icon" src="<?= $basketArticle['image'] ?>" /></td>
								<td><?= $basketArticle['name'] ?></td>
								<td><?= $basketArticle['price'] ?> €</td>
								<td>
									<form method="post" action="basket.php">
										<input type="hidden" name="id" value="<?= $basketArticle['id'] ?>" />
										<input type="number" name="quantity" value="<?= $basketArticle['quantity'] ?>" />
									<input type="image" class="icon" src="https://cdn3.iconfinder.com/data/icons/simplius-pack/512/pencil_and_paper-512.png" />
									</form>
								</td>
								<td><?= $basketArticle['price'] * $basketArticle['quantity'] ?> €</td>
							</tr>
						<?php } ?>
						<tfoot>
							<tr>
								<td colspan="4"></td>
								<td><?= $totalPrice ?> €</td>
							</tr>
						</tfoot>
					</table>

				<?php if( $totalPrice == 0){?>
					<a class="header-link" href="index.php"><button>Votre panier est VIDE, cliquez pour choisir vos articles</button></a>
					<?php } ?>

					

					<?php if($_SESSION['userid'] !== null && $_SESSION['userid'] !== "" && $_SESSION['username'] !== null && $_SESSION['username'] !== "" && $totalPrice !== 0){?>
					<a class="header-link" href="controller/confirm_payment.php"><button>Payer pour commander</button></a>
					<?php }
					else {?>
						<a class="header-link" href="login.php"><button>Connectez vous pour commander</button></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php include("footer.php") ?>
	</div>
</body>
</html>