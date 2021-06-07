<?php

$conn = new mysqli('localhost', 'root', '');
if (!$conn)
 {
    die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysqli_select_db($conn,'opd' );
if (!$db_selected)
 {
    echo "not found ,going to create";
    header("location:index1.php");
}
else
{
	echo "db found";
	header("location:start.php");
}


$conn->close();
?>