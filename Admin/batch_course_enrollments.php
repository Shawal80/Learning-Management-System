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
            <div style="padding:60px 30px;">   
            <h1 class=" text-light"><?php echo "<b>".strtoupper($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'])."</b>"??"" ?><sup class="text-warning" style="font-size:25px">(Admin)</sup></h1>
            </div>
      </div>
    </div>
    <div class="row m-3">
        <div class="col-sm-3">
            
          <div class="card border-primary" style="max-width: auto">
              <div class="card-header bg-primary text-light">NAVIGATION</div>
              <div class="card-body">
              <p><a href="index.php" class="text-decoration-none text-dark">Manage Users</a></p>
              <p><a href="manage_user_role.php" class="text-decoration-none text-dark">Manage User Roles</a></p>
              <p><a href="manage_course.php" class="text-decoration-none text-dark">Manage Course Batch</a></p>
              
              <p><a href="" class="text-decoration-none text-dark">Manage Course Enrolement</a></p>
              </div>
          </div>
        </div>
        <div class="col-sm-9">
            <div class="card m-1  border border-light " style="background-color:#5189B8;">
                <div class="card-header bg-light text-dark">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <div class="container-fluid">
                        <a class="navbar-brand" href="#">User Enrollments</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item ">
                                <a class="nav-link mr-3 " aria-current="page" href="manage_user_enrollment.php">Enrol Users</a>
                            </li>
                            <li class="nav-item ">
                              <a class="nav-link  active bg-warning rounded-pill text-light" aria-current="page" href="#">User Batch Enrollments</a>
                            </li>
                            
                            
                          </ul>
                          

                        </div>
                      </div>
                    </nav>
                  </div>
                    
                    
                                           

                   
            </div>
            
            <div class="card-body  text-dark m-3 ">
                 
                

             <div class="row m-3">

                <table  id="example" class="display text-center" style="width:100%">

                    <thead>

                    <tr >
                   
                    
                    <th>Batch Course</th>
                    <th>Total Users</th>
                    <th>Status</th>
                    <th>Acion</th>
                    
                   
                    </tr>

                    </thead>

                    <tbody id="enrol_users_table_body">
                    <?php  
                    ############### QUERY FOR FETCHING DATA OF USERS ###############################################
                    $query = "SELECT
                              BATCHES.*,
                              COURSES.*,
                              BATCH_COURSE.*
                              FROM
                              BAtCHES,
                              BATCH_COURSE,
                              COURSES
                              
                            WHERE BATCH_COURSE.`course_id` = COURSES.`course_id`
                              AND BATCH_COURSE.`batch_id` = BATCHES.`batch_id`
                              AND BATCH_COURSE.`status_id` IN (1,3) " ;


                    $result = $database->execute_query($query);

                    if ($result->num_rows) 
                    {
                    
                        
                    while ($rec = mysqli_fetch_assoc($result)) 
                    {
                         
                                
                        ?>
                    <tr>

                   

                    
                    <td><?php echo strtoupper($rec['course_title']." - ".$rec['batch_title']) ?></td>
                       
                    <td>

                        <?php

                        $count_total = "SELECT COUNT(user_role_batch_course_enrollment.`enrollment_id`) AS Total FROM user_role_batch_course_enrollment WHERE BATCH_COURSE_ID ='".$rec['batch_course_id']."' " ;
                        $count_total_result = $database->execute_query($count_total);
                        $record = mysqli_fetch_assoc($count_total_result);
                        echo $record['Total'];?></td> 
                    <td><?php 

                    if ($rec['status_id'] == 1) 
                    {
                         ?>
                        <p class="badge  bg-success">Active</p>
                        <?php
                    } 
                    else if ($rec['status_id'] == 2)
                    {
                     ?>
                        <p class="badge  bg-danger">In-Active</p>
                        <?php   
                    }
                    else if ($rec['status_id'] == 3)
                    {
                     ?>
                        <p class="badge  bg-secondary   ">Completed</p>
                        <?php   
                    }


                    ?></td> 
                    <td>
                        <a href="user_batch_course_enrollments.php?course_batch_id= <?php echo $rec['batch_course_id'] ?>&batch_title = <?php echo $rec['batch_title']."".$rec['course_title'] ?> " class = "btn btn-primary"> Properties </a>
                    </td>


                        
                    </tr>

                    <?php
                    }
                }
                    ?>         
                    </tbody>       
                </table>
             
            </div>     
            </div>
            
        </div>
    </div>
 </div>

 <!-- MAIN CONTENT ENDS HERE -->

 <!-- FOOTER REQUIRED FILE -->
 <?php header_footer::footer("../index.php") ?>
 <!-- #################### -->

      <script type="text/javascript " src="../require/media/jquery.js"></script>
      <script type="text/javascript" src="../require/media/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

      <script type="text/javascript">

            // setInterval(function(){ show_users(); }, 1000);
            
            //#####  ACTIVE  USER FUNCTION ################

            function enrol_user(userid)
            {

                var batch_course_id = document.getElementById('course_batch_id').value;
                var user_role_id = document.getElementById('user_role_id'+userid).value;
               
                // var user_enrolment_status = document.getElementById('user_enrolment_status').value;
                var action = "enrol_user";
                var obj;

                
                // alert("batch_course_id : "+batch_course_id);
                // alert("user_role_id : "+user_role_id);
                // alert("user_enrolment_status : "+user_enrolment_status);

                if (window.XMLHttpRequest) 
                {
                    obj = new XMLHttpRequest();
                }
                else
                {
                    obj = new ActiveXObject('microsoft.XMLHTTP');
                }
                obj.onreadystatechange = function()
                {
                    if (obj.readyState == 4 && obj.status == 200) 
                    {
                        
                        
                    document.getElementById('enrolment_message'+userid).innerHTML = obj.responseText;
                    // document.getElementById('enrolment_message').innerHTML = "hi";

                    }
                }

                var formdata = new FormData();

                formdata.append('batch_course_id',batch_course_id);
                formdata.append('user_role_id',user_role_id);
                // formdata.append('user_enrolment_status',user_enrolment_status);
                formdata.append('action',action);
                formdata.append('user_id',userid);

                

                
                obj.open("POST","enrolment_process.php");
                // obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                obj.send(formdata);
            }

            //#####  ACTIVE  USER ENDS HERE ################

            // ########### SHOW USERS ################

            // function show_users()
            // {

            //  var obj;

            //     if (window.XMLHttpRequest) 
            //     {
            //         obj = new XMLHttpRequest();
            //     }
            //     else
            //     {
            //         obj = new ActiveXObject('microsoft.XMLHTTP');
            //     }
            //     obj.onreadystatechange = function()
            //     {
            //         if (obj.readyState == 4 && obj.status == 200) 
            //         {
                        
                        
            //             document.getElementById('enrol_users_table_body').innerHTML = obj.responseText;   

            //         }
            //     }
                

                
            //     obj.open("POST","enrolment_process.php");
            //     obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            //     obj.send("action=showuser");
            // }



            // ########### SHOW USERS ENDS HERE ################






      </script>


     
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

