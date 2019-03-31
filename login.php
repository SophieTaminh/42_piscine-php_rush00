<?php 
session_start();
if($_SESSION['userid'] !== null && $_SESSION['userid'] !== "" && $_SESSION['username'] !== null && $_SESSION['username'] !== "") 
{
	header('Location: index.php');
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
			<div class="main login-main">

				<div class="login-container half-column split-right">
					<h2>SE CONNECTER</h2>
					<form method="post" action="controller/login_connect.php">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" />
						</div>
						<div class="form-group">
							<input type="submit" value="Connection" />
						</div>
						<div>
							<?php
							if ($_GET['error'] == "connection")
								{
							?>
									<p class="error">veuillez saisir un username et un password 
									</br>pour vous connecter</p>
							<?php }
							?>
							<?php
							if ($_GET['error'] == "erreur")
								{
							?>
									<p class="error">nous ne retrouvons pas vos username/password
									</br>Veuillez les ressaisir ou créer un compte</p>
							<?php } 
							?>
						</div>
					</form>
				</div>

				<div class="register-container half-column">
					<h2>CREER SON COMPTE</h2>
					<form method="post" action="controller/login_add.php">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" />
						</div>
						<div class="form-group">
							<input type="submit" value="Connection" />
						</div>
						<div>
							<?php
							if ($_GET['error'] == "creation")
								{
							?>
									<p class="error">veuillez saisir un username et un password </br>
									pour pouvoir créer un compte</p>
							<?php } 
							?>
						</div>
					</form>
				</div>

			</div> <!-- main login-main-->
		</div> <!--middle-->
		<?php include("footer.php") ?>
	</div> <!--wrapper-->
</body>
</html>