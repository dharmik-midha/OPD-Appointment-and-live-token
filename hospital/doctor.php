<?php
/*Receptionist page */
     include("../parts/conn.php");
    //  Query for taking live token number patient details
    $sql_for_taking_token_no = "SELECT f_name, l_name, email,gender, photo_path, area, age, dob, phone,live_token.p_id, token_no,(SELECT token_no FROM live_token order by token_no desc limit 1) as Total from live_token, Registered_User, patient_login WHERE live_token.p_id=Registered_User.p_id and Registered_User.login_id=patient_login.pno ORDER by live_token.token_no LIMIT 1";
    $execution = mysqli_query($mysqli, $sql_for_taking_token_no);
    $execution_row=[];
    $p_id=0;
    if($execution){
        $execution_row = mysqli_fetch_array($execution, MYSQLI_ASSOC);
        
    }
    if(isset($execution_row['p_id'])){
        $p_id = $execution_row['p_id'];
    }
    
    
    
    // Query for checking the live patient is old or new 
    $check_patient = "select * from token_history where p_id='$p_id'";
    $check_patient_result = mysqli_query($mysqli,$check_patient);
    $check_patient_row = mysqli_fetch_array($check_patient_result,MYSQLI_ASSOC);

    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .i-b{
            display: inline-block;
        }

        .container{
            /* border: 2px solid red; */
            background-color: white;
            height: 100vh;
            width: 100%;
        }
        .row{
            width: 100%;
            /* border: 2px solid blue; */
            color: black;

        }
        img{
            height: 150px;
            width: 200px;
        }
        
        .h-20{
            height: 40%;
        }
        .h-80{
            height: 60%;
        }
        #patient_info{
            /* background: linear-gradient(48deg, rgba(87, 114, 133, 0.479),rgb(95, 113, 128)); */
        }
        .row::after{
            content: "";
            display: table;
            clear: both;
        }
        .column{
            float: left;
        }
        .box-shadow{
            box-shadow: 5px 5px 8px rgb(73, 72, 72);
        }
        .col-left{

            width: 18.25%;
            height: 93%;
            background-color: white;
            margin: 0.5% 0.5%;
            text-align: center;
            color: black
        }
        .col-left img{
            width: 100%;
            height: 100%;
            max-height: 200px;
        }
        .col-left h1{
            margin: 2% 0%;
        }
        .col-right{
            /* border: 2px solid blue; */
            width: 78.75%;
            height: 100%;
            margin: 0% 0.5%;
        }
        #usr-info-right{
            padding: 2%;
            border: 2px solid grey;
            border-radius: 90px;
        }
        
        
        #bottom-row{
            height: 59%;
        }
        #bottom-row .col-right{
            width: 78.75%;
            height: 100%;
            margin: 0% 0.5%;
            background-color: white;

        }
        #bottom-row .col-left{
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: space-between;
            width: 18.25%;
            height: 100%;
            margin: 0% 0.5%;
            padding: 2%;
            background: linear-gradient(71deg, rgb(230, 237, 240),rgb(227, 231, 233));

        }
        .user-info-width{
            width: 32%;
            margin: 0.33%;
        }
        .user-info-height{
            height: 33.33%;
        }
        .buttons_design{
            display: block;
            background: linear-gradient(78deg, rgb(63, 73, 129),rgb(53, 91, 122));
            color: white;
            font-size: 16px;
            padding: 10px;
            width: 100%;
            border: 1px solid rgb(174, 174, 180);
            margin: 5% 0;
            cursor: pointer;
            text-transform: uppercase;
        }
        #c_started{
            background: linear-gradient(59deg, rgb(7, 85, 7),rgb(45, 77, 45));
        }
        #c_ended{
            background: linear-gradient(59deg, rgb(202, 2, 29),rgb(180, 39, 26));
        }
        #p_not_arrived{
            background: linear-gradient(59deg, rgb(127, 144, 29),rgb(159, 185, 8));
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="patient_info" class="row h-20">
            <div class="column col-left box-shadow">
                <img src="../<?php if($execution_row){
                    echo $execution_row['photo_path'];
                }else{echo "assets/images/default.png";} ?>" alt="Image">
                <h1><?php if($execution_row){
                    echo $execution_row['f_name']." ".$execution_row['l_name'];
                } else{ echo "No Patient"; }  ?></h1>
            </div>
            <div id="usr-info-right" class="column col-right">
                <div id="info" class="row user-info-height">
                    <div class="column user-info-width">
                        <p class="i-b">Gender: </p><h3 class="i-b"><?php if($execution_row){
                            if($execution_row['gender']=="M"){
                                echo "Male";} else{echo "Female";}
                        }else{echo "";}  ?></h3>
                    </div>
                    <div class="column user-info-width">
                        
                        <p class="i-b">Date Of Birth:</p><h3 class="i-b"><?php if($execution_row){
                           echo $execution_row['dob'];}else{echo "";}  ?></h3>
                    </div>
                    <div class="column user-info-width">
                        
                        <p class="i-b">Age:</p>
                        <h3 class="i-b"><?php if($execution_row){
                           echo $execution_row['age'];}else{echo "";}  ?></h3>
                    </div>
                </div>

                <div class="row user-info-height">
                    <div class="column user-info-width">
                        
                        <p class="i-b">Phone Number:</p>
                        <h3 class="i-b">+91 <?php if($execution_row){
                           echo $execution_row['phone'];}else{echo "";}  ?></h3>
                    </div>
                    <div class="column user-info-width">
                        
                        <p class="i-b">E-Mail:</p>
                        <h3 class="i-b"><?php if($execution_row){
                           echo $execution_row['email'];}else{echo "";}  ?></h3>
                    </div>
                    <div class="column user-info-width">
                        
                        <p class="i-b">Patient Type:</p>
                        <h3 class="i-b"><?php if ($execution_row){
                            if($check_patient_row){
                                echo "Old";}else{ echo "New";}
                        }else{
                            echo "";
                        }
                          ?></h3>
                    </div>
                </div>
                <div class="row user-info-height">
                    <div class="column user-info-width">
                        
                        <p class="i-b">Token Number:</p>
                        <h3 class="i-b"><?php if($execution_row){
                           echo $execution_row['token_no']."/".$execution_row['Total'];}else{echo "";}  ?></h3>
                    </div>
                    <div class="column user-info-width">
                        
                        <p class="i-b">Department:</p>
                        <h3 class="i-b">General</h3>
                    </div>
                    <div class="column user-info-width">
                        
                        <p class="i-b">City:</p>
                        <h3 class="i-b"><?php if($execution_row){
                           echo $execution_row['area'];}else{echo "";}  ?></h3>
                    </div>
                </div>



            </div>
        </div>
        <div id="bottom-row" class="row">
            <div class="column col-left box-shadow">
                <form action="checkup_updation.php" method="post">
                    <input type="submit" id="c_started" class="buttons_design" value="Checkup Started" name="c_started">
                </form>
                <form action="checkup_updation.php" method="post">
                    <input type="submit" id="c_ended" class="buttons_design" value="Checkup Ended" name="c_ended">
                </form>
                <input type="submit" id="p_not_arrived" class="buttons_design" value="Patient Not Arrived" name="p_not_arrived">
            </div>
            <div class="column col-right"></div>

        </div>
    </div>
    
</body>
</html>