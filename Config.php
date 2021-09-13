<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="mysql";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db)
    or die("Could not connect to database.");  
?>