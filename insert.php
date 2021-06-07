<?php
    include("parts/conn.php");
    if($mysqli === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    if(isset($_POST["signup"])){
        if($_POST["psw"]==$_POST["rpsw"]){
            $first_name = mysqli_real_escape_string($mysqli, $_REQUEST['fname']);
            $last_name = mysqli_real_escape_string($mysqli, $_REQUEST['lname']);
            $email = mysqli_real_escape_string($mysqli, $_REQUEST['email']);
            $phone = mysqli_real_escape_string($mysqli, $_REQUEST['phone']);
            $psw = mysqli_real_escape_string($mysqli, $_REQUEST['psw']);
            $token = bin2hex(random_bytes(30));

            $subject = "HealthCare.com | Please Activate Your Account!";
            $body = "<html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            <h1>Hello $first_name,</h1>
            <h4>Your have created your account on <b><span style='color: red; font-size: 20px;'>Health</span><span style='color: blue; font-size: 20px;'>Care</span>.com<b></h4>
            <p>Please Click the link below to activate your account, so that you can use our services..</p>
            <a href=localhost/opd/user_activate.php?token=$token>Click Here</a>
            </body>
            </html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // $pass_hash = password_hash($psw, PASSWORD_DEFAULT);
            $query="select * from patient_login where email='$email'";
            $res = mysqli_query($mysqli,$query);
            $row = mysqli_fetch_array($res,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($res);
      
      // If result matched $email, table row must be 1 row
		
            if($count == 1)
            {
                echo "<script type='text/javascript'>alert('Already Registered Please try login!');window.location.href ='start.php';</script>";
            } 
            else
            {
            $sql = "INSERT INTO patient_login (f_name, l_name, email, phone, password,ver_code) VALUES ('$first_name', '$last_name', '$email', '$phone','$psw','$token')";
            if(mysqli_query($mysqli, $sql)){
                if(! is_dir("uploads/".$email)){
                    mkdir("uploads/".$email);
                }
                if(mail($email,$subject,$body,$headers)){
                    echo '<script>alert("Your Account is created. An activation link send to your email address!!")</script>';
                    header('refresh:0.2; url=start.php');
                }else{
                    echo "Sorry!!";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
            }
        }
            // Close connection
            mysqli_close($mysqli);

        }
        else{
            echo "Password did not match";
        }
        

    }

?>