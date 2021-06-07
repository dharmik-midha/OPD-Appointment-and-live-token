<?php
    include("test_con.php");
    if(isset($_POST['token'])){
        $create_live_token="CREATE TABLE if NOT EXISTS live_token (token_no int(9) NOT null AUTO_INCREMENT, is_started int(1) not null DEFAULT 0, p_id int(9) not null, PRIMARY KEY(token_no), foreign key(p_id) references Registered_User(p_id))";
        mysqli_query($mysqli,$create_live_token);
        $allot_token = "insert into live_token (p_id) values(1)";
        if(mysqli_query($mysqli,$allot_token)){
            echo "Done";}
        else{
            echo "Sorry";
        }
        

    }




?>


<form action="" method="post">
    <input type="submit" value="Token Number" name="token">
</form>