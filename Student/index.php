<?php 
    
    require("../general/session_maintenance.php");
    require("../require/header_footer.php");
    header_footer::header("../general/logout.php");
    $database = new database();

 ?>
 <!-- MAIN CONTENT STARS HERE -->
 <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 " style="background-color:#5189B8;">
            <div style="padding: 70px;">   
            <h1 class=" text-light"><?php echo "<b>".strtoupper($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'])."</b>"??"" ?><sup class="text-warning" style="font-size:25px"></sup></h1>
            </div>
      </div>
    </div>
    <div class="row m-3">
        <div class="col-sm-3">
            
          <div class="card border-primary" style="max-width: auto">
              <div class="card-header bg-primary text-light">NAVIGATION</div>
              <div class="card-body">
              <p><a href="view_users.php" class="text-decoration-none text-dark">Site Home</a></p>
              <p><a href="index.php" class="text-decoration-none text-dark" style="font-size: 20px;"> &#10140; My Courses</a></p>
              
              </div>
          </div>
        </div>
        <div class="col-sm-6">
            <div class="card mb-1">
                <div class="card-header bg-light text-dark text-center" style="font-size:18px"><?php echo strtoupper($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']) ?></div>
            </div>
            <div class="card p-2">
                
                <div class="card-body">
                        <?php 
                         ### QUERY TO CHECK USER ROLES #####################

                         // $role_query = "SELECT * FROM USER_ROLE WHERE USER_ID = $"

                         ####### QUERY TO CHECK ROLE STATUS OF USER #############

                         $check_role_query = "SELECT * FROM USER_ROLE WHERE role_id = 3 AND status_id = 1 AND USER_ID ='".$_SESSION['user']['user_id']."'";

                        // die($check_role_query);

                        // die($check_role_query);

                         // echo "$check_role_query";
                        



                         $check_role_result = $database->execute_query($check_role_query);

                         if ($check_role_result->num_rows) 
                         {

                            $rec = mysqli_fetch_assoc($check_role_result);

                            ### QUERY TO CHECK ASIGNED COURSES TO TEACHER ###########

                            $check_course_assigned = "SELECT * FROM user_role_batch_course_enrollment WHERE status_id = 5 AND user_role_id = '".$rec['user_role_id']."'";

                            $check_course_assigned_result = $database->execute_query($check_course_assigned);
                            if ($check_course_assigned_result->num_rows) 
                            {
                                while($course = mysqli_fetch_assoc($check_course_assigned_result))
                            {
                                ### QUERY TO CHECK WHICH BATCH AND COURSES ARE ASSIGNED TO USERS
                            $batch_course_query = "SELECT * FROM BATCHES B  , COURSES  C , BATCH_COURSE  CB WHERE  CB.`batch_id` = B.`batch_id` AND CB.`course_id` = C.`course_id` AND CB.`batch_course_id` = '".$course['batch_course_id']."'" ;

                            // die($batch_course_query);

                            $batch_course_result = $database->execute_query($batch_course_query);

                            if ($batch_course_result->num_rows) 
                            {
                                while ($record = mysqli_fetch_assoc($batch_course_result))
                                {
                                    
                                ?>
                                <div class="m-3">
                                <a href="student_course.php?batch_course_id=<?php echo $record['batch_course_id'] ?>&batch_title=<?php echo $record['batch_title']." ".$record['course_title'] ?>"style="font-size:20px; text-decoration: none;"><?php echo strtoupper($record['batch_title']." ".$record['course_title']) ?></a>
                               
                                    
                                </div>
                                <?php
                                
                                }
                            }
                             else
                             {
                                ?>
                                <div class="alert alert-warning" role="alert">
                                  No Course Assigned yet
                                </div>

                                <?php
                             }
                            }
                            }
                            else
                            {
                                 ?>
                                <div class="alert alert-warning" role="alert">
                                  No Course Assigned yet
                                </div>

                                <?php
                            }
                            
                         }
                         else
                         {
                            ?>
                            <div class="alert alert-warning" role="alert">
                              Sorry Your Role Is Inactivated By Administration Or No Course Assigned Yet
                            </div>

                            <?php
                         }





                        ?>
                </div>
            </div>

            
        </div>
        <div class="col-sm-3">
            <div class="card  mb-3" style="max-width: 18rem;"> 
            <div class="card-header text-center">
                Upcoming Events
            </div>  
            <div class="card-body">
                <div class="card-text p-3 text-center">
                    Sorry There is No Upcoming Event
                </div>
            </div>
           
          
        </div>
             <div class="card border-dark mb-3" style="max-width: 18rem;">   
            <div class="card-body text-dark">
              <p class="card-text">Education is the most powerful weapon which you can use to change the world.</p>
              <h5 class="card-title">Nelson Mandela</h5>
              <hr>
               <p class="card-text">Education is the passport to the future, for tomorrow belongs to those who prepare for it today. </p>
              <h5 class="card-title">Malcolm X</h5>
              
              
          </div>
          
        </div>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-12 " style="background-color:#5189B8;">
                  <div style="padding: 40px;">   
                  <h2 class="text-center text-light">EDUCATION IS A WEAPON WHICH WE CAN USE TO CHANGE THE WORLD</h2>
                  <p class="text-center text-light">We will open the world of knowledge for you!... We outstrip social needs in education!</p>
                  <center>
                    
                  <a href="https://histpk.org/" class="btn btn-light text-primary">Read More!...</a>
                  </center>
                  </div>
            </div>
          </div>
 </div>
 
 <!-- MAIN CONTENT ENDS HERE -->

 <!-- FOOTER REQUIRED FILE -->
 <?php header_footer::footer("../index.php") ?>
 <!-- #################### -->


   
  </body>
</html>


