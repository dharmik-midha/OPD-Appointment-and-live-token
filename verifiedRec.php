<?php
include("parts/conn.php");
   session_start();
   if(isset($_POST['login'])){
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($mysqli,$_POST['Username']);
      $mypassword = mysqli_real_escape_string($mysqli,$_POST['pass']); 
      
      $sql = "SELECT * FROM receptionist WHERE Username = '$myusername' and Password = '$mypassword'";
      $result = mysqli_query($mysqli,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
      
            $_SESSION['login'] = $myusername;
            $_SESSION['logged_in'] = True;
            header("Location: hospital/doctor.php");
         }
      else {
         echo '<script ">
         alert("Email or Password is Incorrect");
         window.location.href = "ReceptionistLogin.php"; </script>';
         

      }
   }

