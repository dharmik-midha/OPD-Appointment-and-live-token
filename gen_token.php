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

    $patient_p_id = $_SESSION['p_id'];

    

    if(!$data_row){
        header("Location: registration.php");
    }


    if (isset($_POST['token'])){
        $create_live_token="CREATE TABLE if NOT EXISTS live_token (token_no int(9) NOT null AUTO_INCREMENT, is_started int(1) not null DEFAULT 0, p_id int(9) not null, PRIMARY KEY(token_no), foreign key(p_id) references Registered_User(p_id))";
        mysqli_query($mysqli,$create_live_token);
        $allot_token = "insert into live_token (p_id) values('$patient_p_id')";
        if(mysqli_query($mysqli,$allot_token)){
            echo '<script>alert("Token Number has been alloted!")</script>';
            header("refresh: 0.5; url=dashboard.php");
        }

        // $get_token_query="insert into tokens(pno, p_id) values('$p_id','$pno')";
        // if(mysqli_query($mysqli,$get_token_query)){
        //     echo '<script>alert("Your Token Number has been alloted!!")</script>';
        //     header("refresh: 0.5; url=dashboard.php");
        // }
        // $fetch_user_token = "select token_no from tokens where p_id='$pno'";
        // $fetched_token = mysqli_query($mysqli,$fetch_user_token);
        // $token_row = mysqli_fetch_array($fetched_token,MYSQLI_ASSOC);
        // $token_no = $token_row['token_no'];
        // $token_checkup_query = "insert into live_token(token_no) values('$token_no')";
        // mysqli_query($mysqli,$token_checkup_query);
        

    }

?>