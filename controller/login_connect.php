<?php
// le header doit etre en premier, 
//des qu'on fait un echo pour le debugg, il y a une erreur
//pour afficher les erreur
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//fin pour afficher les erreur

require('../initdb.php');

if ($_POST['username'] !== null && $_POST['username'] !== ""
	&& $_POST['password'] !== null && ($_POST['password'] !== "")) 

{
	$password = hash("whirlpool",$_POST['password']);

	$sql = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $password . "'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 0)
	{
		header('Location: ../login.php?error=erreur');
	    exit(0);
	}

	if (mysqli_num_rows($result) == 1)
	{	
		$row_user = mysqli_fetch_assoc($result);
		
		session_start();
		
		$_SESSION['userid'] = $row_user['id'];
		$_SESSION['username'] = $row_user['username'];
		$_SESSION['permission'] = $row_user['permission'];
		
		header('Location: ../index.php');
		exit(0);
	}
}
else
{
	header('Location: ../login.php?error=connection');
	exit(0);
}

mysqli_close($conn);

header('Location: ../login.php');
?>