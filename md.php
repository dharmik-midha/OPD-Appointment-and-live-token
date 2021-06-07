<?php
    include("parts/conn.php");
    $sql = "select * from Registered_User where login_id=2";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if(!$row){
        echo "NO data";
    }

?>