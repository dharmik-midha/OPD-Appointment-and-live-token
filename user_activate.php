<?php
include("parts/conn.php");
$token_recieved = $_GET["token"];

$sql = "update patient_login set is_active=1 where ver_code='$token_recieved'";

if(mysqli_query($mysqli, $sql)){
    echo '<script>alert("Your Account is Activated Now.")</script>';
    header("refresh: 0.2; url=start.php");
}else{
    echo "Error". mysqli_error($mysqli);
}
mysqli_close($mysqli);
?>