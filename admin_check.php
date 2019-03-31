<?php

if (!isset($_SESSION['permission'])
	|| !is_numeric($_SESSION['permission'])
	|| intval($_SESSION['permission']) != 1) {
	header('Location: .');
	exit(0);
}

?>