<?php
    include("../parts/conn.php");
    // Query for fetching p_id and token_no
    $fetch_patient_info = "select token_no, p_id from live_token order by token_no asc limit 1";
    $patent_info = mysqli_query($mysqli, $fetch_patient_info);
    $patent_info_row = [];
    if($patent_info){
        $patent_info_row = mysqli_fetch_array($patent_info,MYSQLI_ASSOC);
    }
    $p_token = $patent_info_row['token_no'];
    $p_id = $patent_info_row['p_id'];
    //if checkup started is pressed
    if(isset($_POST['c_started'])){
        
        // query for checkup is started 
        $query_to_update_checkup_status = "update live_token set is_started=1 where p_id='$p_id'";
        if(mysqli_query($mysqli, $query_to_update_checkup_status)){
            header("refresh: 0.1; url=doctor.php");

        }
        else{
            header("refresh: 0.1; url=doctor.php");

        }

    }
    // if checkup ended is pressed 
    if(isset($_POST['c_ended'])){
        // query for checkup ended and calling for next token
        $query_for_saving_history = "insert into token_history (p_id,token_no,is_done) values('$p_id','$p_token',1)";
        $query_for_next_token = "delete from live_token where p_id='$p_id'";
        mysqli_query($mysqli,$query_for_saving_history);
        if(mysqli_query($mysqli,$query_for_next_token)){
            header("refresh:0.1; url=doctor.php");
        }

    }
    




?>