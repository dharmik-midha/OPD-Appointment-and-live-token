<?php
$servername = "localhost";
$username = "root";
$pass = "";

// Create connection

$conn = new mysqli($servername, $username, $pass);

// Check connection

if ($conn->connection_error)
{
    die("Connection failed: ". $conn->connection_error);
}


// Create database
$sql = "CREATE DATABASE opd";
if ($conn->query($sql) === TRUE) 
{
    echo "Database created successfully";
    header("location:index2.php");
}
else
{
    echo "Error creating database: ". $conn->error;
}



$conn->close();
?>