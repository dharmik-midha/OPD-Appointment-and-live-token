<?php
    include("parts/conn.php");
    session_start();
    if(!isset($_SESSION['login_user'])){
        header("Location: start.php");
    }
    
    $email = $_SESSION['login_user'];
    $sql = "select pno, f_name, l_name, phone, email from patient_login where email='$email'";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $email = $row['email'];
    $p_id = $row['pno'];
    $photo="";



    // sql query for checking the more info is exist or not 
    $sql_for_checking_info="select * from Registered_User where login_id='$p_id'";
    $data = mysqli_query($mysqli,$sql_for_checking_info);
    $data_row = mysqli_fetch_array($data, MYSQLI_ASSOC);
    if($data_row){
        header("Location: dashboard.php");
    }



    if(isset($_FILES['profile'])){
        $errors= array();
        $photo_name = $_FILES['profile']['name'];
        $file_size =$_FILES['profile']['size'];
        $file_tmp =$_FILES['profile']['tmp_name'];
        $file_type=$_FILES['profile']['type'];
        $file_ext=explode('.',$_FILES['profile']['name']);
        $fin_file_extension = strtolower(end($file_ext));
        $photo = "profile.".$fin_file_extension;

        $extensions= array("jpeg","jpg","png");
        
        if(in_array($fin_file_extension,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 2097152){
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"uploads/".$email."/".$photo);
        }else{
           print_r($errors);
        }
     }

    
    if(isset($_POST['submit'])){
        $dob = mysqli_real_escape_string($mysqli, $_REQUEST['dob']);
        $gender = mysqli_real_escape_string($mysqli, $_REQUEST['gender']);
        $area = mysqli_real_escape_string($mysqli, $_REQUEST['area']);
        $pin = mysqli_real_escape_string($mysqli, $_REQUEST['pin']);
        $state = mysqli_real_escape_string($mysqli, $_REQUEST['state']);
        $path = "uploads/".$email."/".$photo;

        $values_insert = "INSERT INTO Registered_User (dob, area,state,pin_code ,gender,photo_path,login_id) VALUES ('$dob', '$area', '$state', '$pin','$gender','$path',$p_id)";

        if(mysqli_query($mysqli,$values_insert)){
            header("Location: dashboard.php");
        }
        else{
            echo '<script>alert("Sorry, Something went Wrong!")</script>';
        }

    }
    
    

?>


<div class="col col-2 main_area">
    <form action="" method="post" enctype="multipart/form-data" >
    <div id="info_form">
        <div class="one_line">
            <div class="one-1">
                <label for="fname">First Name:</label>
            </div>
            <div class="one-2">
                <input type="text" class="input_design" name="fname" id="fname" value=<?php echo $row['f_name']; ?> readonly>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="lname">Last Name:</label>
            </div>
            <div class="one-2">
                <input type="text" class="input_design" name="lname" id="lname" value=<?php echo $row['l_name']; ?> readonly>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="email">E-Mail Address:</label>
            </div>
            <div class="one-2">
                <input type="text" class="input_design" name="email" id="email" value=<?php echo $row['email']; ?> readonly>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="phone">Phone:</label>
            </div>
            <div class="one-2">
                <input type="int" class="input_design" name="phone" id="phone" value=<?php echo $row['phone']; ?> readonly>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="dob">Date of Birth:</label>
            </div>
            <div class="one-2">
                <input type="date" name="dob" id="dob" class="input_design" required>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="gender">Gender:</label>
            </div>
            <div class="one-2">
            <select name="gender" class="input_design" id="gender" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="area">City:</label>
            </div>
            <div class="one-2">
                <input type="text" class="input_design" name="area" id="area" required>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="state">State:</label>
            </div>
            <div class="one-2">
            <select name="state" id="state" class="input_design" required>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                <option value="Daman and Diu">Daman and Diu</option>
                <option value="Delhi">Delhi</option>
                <option value="Lakshadweep">Lakshadweep</option>
                <option value="Puducherry">Puducherry</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
            </select>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="pin">Zip Code:</label>
            </div>
            <div class="one-2">
                <input type="int" class="input_design" name="pin" id="pin" required>
            </div>
        </div>
        <div class="one_line">
            <div class="one-1">
                <label for="profile">Profile:</label>
            </div>
            <div class="one-2">
                <input type="file" name="profile" required />
            </div>
        </div>
        <div class="one_line">    
            <input type="submit" class="submit_input" name="submit" />
        </div>
    </div>
    </form>
            
</div>