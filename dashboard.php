<?php
    include("parts/conn.php");
    session_start();

    if(!isset($_SESSION['login_user'])){
        header("Location: start.php");
    }
    $email = $_SESSION['login_user'];
    $sql = "select * from patient_login where email='$email'";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $p_id = $row['pno'];

    $sql_for_checking_info="select * from Registered_User where login_id='$p_id'";
    $data = mysqli_query($mysqli,$sql_for_checking_info);
    $data_row = mysqli_fetch_array($data, MYSQLI_ASSOC);
    $pno = $data_row['p_id'];
    $_SESSION['p_id'] = $pno;
    if(!$data_row){
        header("Location: registration.php");
    }

    include("dash_header.php");
    include("dash_left.php");
    include("dash_main.php");
    include("dash_right.php");



?>










       
        
        