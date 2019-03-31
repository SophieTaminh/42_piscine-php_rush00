<div class="header">
	<!--<div class="logo">
	<img src="https://scontent-cdt1-1.xx.fbcdn.net/v/t1.0-9/16730417_10154225266700785_4040291753004488805_n.png?_nc_cat=109&_nc_ht=scontent-cdt1-1.xx&oh=99335a6be4e5cc442e7ce0b28b9e2754&oe=5D486947" width="15px" />
	</div>-->
	<a href="." class="logo">Rush00 - Piscine PHP</a>

	<div class="header-right">
		<a class="header-link" href="basket.php">
			Mon panier <?php $count = 0; if (isset($_SESSION['basket'])) foreach ($_SESSION['basket'] as $basketArticle) {
				$count += $basketArticle;
			}
			echo "($count)";
			?>
		</a>

		<?php if (isset($_SESSION['userid']) && $_SESSION['userid'] !== "" && isset($_SESSION['username']) && $_SESSION['username'] !== "") { ?>
			<a class="header-link" href="index.php">Bonjour <?= $_SESSION['username'] ?></a>
		<?php } else { ?>
			<a class="header-link" href="login.php">Connexion</a>
		<?php } ?>

		<?php if (isset($_SESSION['userid']) && $_SESSION['userid'] !== "" && isset($_SESSION['username']) && $_SESSION['username'] !== "") { ?>
			<a class="header-link" href="controller/logout.php">Déconnexion</a>
		<?php } ?>

		<!-- je suis connecte en admin, bouton admin-->		
		<?php if (isset($_SESSION['userid']) && $_SESSION['userid'] !== "" && isset($_SESSION['username']) && $_SESSION['username'] !== "" && isset($_SESSION['permission']) && $_SESSION['permission'] == 1) { ?>
			<a class="header-link" href="admin_sales_list.php">Admin</a>
		<?php } ?>


		<a href="https://www.facebook.com/manbiospherefrance/" target="_blank">
			<img src="image/icone/facebook.png" alt="lien facebook"/>
		</a>
	</div>
</div>