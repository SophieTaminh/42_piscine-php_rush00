<?php


  $conn = mysqli_connect("localhost", "root", "root", "shop");
    if (!$conn)
    {
    	echo "Error:Connection : " . mysqli_connect_errno()."<br>";

        echo "Error:Connection to database: " . mysqli_connect_error()."<br>";

        exit();
    }
    // echo "Success";
    // echo "Host information: " . mysqli_get_host_inconn)."\n";


    return ($conn);
?>