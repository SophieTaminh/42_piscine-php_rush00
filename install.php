<?php

  $conn = mysqli_connect("localhost", "root", "root");
    
    if (!$conn)
    {
    	echo "Error:Connection : " . mysqli_connect_errno()."<br>";

        echo "Error:Connection to database: " . mysqli_connect_error()."<br>";

        exit();
    } 
    else 
    {
    	echo "connexion ok"."<br>"	;
    }

function createDatabase($conn) {
	$sql = "CREATE DATABASE IF NOT EXISTS shop";
	if (mysqli_query($conn, $sql)) {
		echo "Database created successfully"."<br>";
		return (true);
	} else {
		echo "Error creating database: " . mysqli_error($conn)."<br>";
		return (false);
	}
}

function createUser($conn) {
	$sql = "CREATE TABLE IF NOT EXISTS user (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(32) NOT NULL UNIQUE,
	password VARCHAR(128) NOT NULL,
	permission INT DEFAULT 0,
	creation_date TIMESTAMP)";

	if (mysqli_query($conn, $sql)) {
		echo "Table user created successfully"."<br>";
		return (true);
	} else {
		echo "Error creating table users: " . mysqli_error($conn)."<br>";
		return (false);
	}
}

function createArticle($conn) {
	$sql = "CREATE TABLE IF NOT EXISTS article (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(128) NOT NULL,
	description VARCHAR(512),
	price DECIMAL(8, 2),
	image VARCHAR(256))";

	if (mysqli_query($conn, $sql)) {
		echo "Table article created successfully"."<br>";
		return (true);
	} else {
		echo "Error creating table article: " . mysqli_error($conn);
		return (false);
	}
}

function createCategory($conn) {
	$sql = "CREATE TABLE IF NOT EXISTS category (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(128) NOT NULL UNIQUE)";

	if (mysqli_query($conn, $sql)) {
		echo "Table category created successfully"."<br>";
		return (true);
	} else {
		echo "Error creating table category: " . mysqli_error($conn)."<br>";
		return (false);
	}
}

function createLink($conn) {
	$sql = "CREATE TABLE IF NOT EXISTS link (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	article_id INT NOT NULL,
	quantity INT NOT NULL,
	category_id INT NOT NULL)";

	if (mysqli_query($conn, $sql)) {
		echo "Table link created successfully"."<br>";
		return (true);
	} else {
		echo "Error creating table link: " . mysqli_error($conn)."<br>";
		return (false);
	}
}

function createHistory($conn) {
	$sql = "CREATE TABLE IF NOT EXISTS history (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(32) NOT NULL,
	total DECIMAL(8, 2),
	payment_date DATETIME DEFAULT CURRENT_TIMESTAMP)";

	if (mysqli_query($conn, $sql)) {
		echo "Table history created successfully"."<br>";
		return (true);
	} else {
		echo "Error creating table history: " . mysqli_error($conn)."<br>";
		return (false);
	}
}

function createHistoryLink($conn) {
	$sql = "CREATE TABLE IF NOT EXISTS history_link (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	history_id INT NOT NULL,
	article_id INT NOT NULL)";

	if (mysqli_query($conn, $sql)) {
		echo "Table history_link created successfully"."<br>";
		return (true);
	} else {
		echo "Error creating table history_link: " . mysqli_error($conn)."<br>";
		return (false);
	}
}

function importDatabase($conn) {
	$queries = file_get_contents("import.sql");
	return (mysqli_multi_query($conn, $queries));
}

// Create database
if (createDatabase($conn)) 
{
	// Switch to ft_minishop database
	if (mysqli_select_db($conn, "shop")) 
	{
		// Create user table
		if (createUser($conn)) {
			// Create article table
			if (createArticle($conn)) {
				// Create category table
				if (createCategory($conn)) {
					// Create link table
					if (createLink($conn)) {
						if (createHistory($conn)) {
							if (createHistoryLink($conn)) {
								if (importDatabase($conn)) {
									echo "The database has been initializated successfully"."<br>";
								} else {
									echo "Error while importing the database";
								}
							}
						}
					}
				}
			}
		}
	} 
		else 
		{
			echo "Couldn't switch to database ft_minishop: " . mysqli_error($conn)."<br>";
	}
} 
else 
{
	echo "db creation failed"."<br>";
}

mysqli_close($conn);

?>
