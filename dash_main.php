
<div class="col col-2 main_area">

            <div class="row row-big">
                <div class="col col-big">
                    <div id="user-info" class="bg-color borders box-shadows">
                        <div class="usr-col">
                            <div class="usr-head rows">
                                <div class="h-left column col-3">
                                    <img src="<?php echo $data_row['photo_path']; ?>" alt="img">
                                </div>
                                <div class="h-right column col-2">
                                    <h1>Welcome</h1>
                                    <p><?php echo $row['f_name']." ".$row['l_name']; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="usr-body">
                                <div class="rows width">
                                    <div class="column c-width">
                                        <h4>+91 <?php echo $row['phone']; ?></h4>
                                        <p>Phone</p>
                                    </div>
                                    <div class="column c-width">
                                        <h4><?php echo $row['email']; ?></h4>
                                        <p>E-mail</p>
                                    </div>
                                    
                                </div>
                                <div class="rows width">
                                    <div class="column c-width">
                                        <h4><?php echo $data_row['age'];  ?></h4>
                                        <p>Age</p>
                                    </div>
                                    <div class="column c-width">
                                        <h4><?php echo $data_row['dob'];  ?></h4>
                                        <p>DOB</p>
                                    </div>
                                </div>
                                <div class="rows width">
                                    <div class="column c-width">
                                        <h4><?php echo $data_row['gender'];  ?></h4>
                                        <p>Gender</p>
                                    </div>
                                    <div class="column c-width">
                                        <h4><?php echo $data_row['area'];  ?></h4>
                                        <p>Address</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div id="tokens-col" class="col col-small">
                    <div id="usr-token" class="row height-50 bg-color borders box-shadows">
                        <?php 
                                                       

                            $patient_p_id = $_SESSION['p_id'];
                            $query="select * from live_token where p_id='$patient_p_id'";
                            $res = mysqli_query($mysqli,$query);
                            $token_row=[];
                            // Condition for checking that live_token table exists or not 
                            $token_number=0;
                            if($res!==False){
                                $token_row = mysqli_fetch_array($res,MYSQLI_ASSOC);  
                            }
                            if(isset($token_row['token_no']))
                            {
                                $token_number = $token_row['token_no'];
                            }
                            // condition for checking that any token number alloted to the patient or not 
                            if(!$token_row){
                                echo '<h3>You havn\'t booked any appointment!!</h3><img src="assets/images/down_arrow.gif" /><form method="post" action="gen_token.php"><input type="submit" name="token" id="token" class="token" value="Get Your Token"/></form>';
                            }
                            else{
                                // query for counting the number of patient before the current patient 
                                $query_for_counting_patients = "select count(*) as patients_before_you from live_token WHERE token_no<'$token_number'";
                                $total_patients_before = mysqli_query($mysqli,$query_for_counting_patients);
                                $patient_before_row=[];
                                if($total_patients_before){
                                    $patient_before_row=mysqli_fetch_array($total_patients_before,MYSQLI_ASSOC);
                                }
                                $patients_number = 3*(int)$patient_before_row['patients_before_you'];


                                echo '<h1>Your Token</h1><hr>';
                                if($patients_number>0){
                                    echo '<p style="color: red;">'.$token_row['token_no'].'</p><h4>Estimated Time: <span style="color:red;">'.$patients_number.' min(s)</span></h4>';
                                }
                                else{
                                    echo '<p style="color: green;">'.$token_row['token_no'].'</p><h4 style="color:green;">Go Inside...</h4>';
                                }
                            }
                        
                        ?>

                    </div>
                    <div id="live-token" class="row height-50 bg-color borders box-shadows">
                        <h1>Live</h1>
                        <hr>
                        <?php
                            $query_for_live_token = "Select token_no,is_started from live_token order by token_no asc limit 1";
                            $get_live_token = mysqli_query($mysqli, $query_for_live_token);
                            $live_token_row = [];
                            if($get_live_token!==False){
                                $live_token_row=mysqli_fetch_array($get_live_token,MYSQLI_ASSOC);
                            }


                            if(!$token_row){
                                echo '<img src="assets/images/deny.png" /><h4>Live Token will be visible only after Booking an appointment!</h4>';
                            }else{
                                if($live_token_row['is_started']==0){
                                    echo '<p style="color: gold;">'.$live_token_row['token_no'].'</p>';
                                    echo '<h4 style="color: gold;">Waiting For Patient...</h4>';
                                }
                                else{
                                    echo '<p style="color: green;">'.$live_token_row['token_no'].'</p>';
                                    echo '<h4 style="color: green;">Consulting...</h4>';
                                }
                                
                            }

                          ?>
                    </div>
                </div>


            </div>
            <div class="row row-small">
                <div class="bg-color height-100 box-shadows">


                </div>
            </div>

            </div>



            

