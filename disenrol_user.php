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
            <div style="padding: 30px;">   
            <h1 class=" text-light text-left"><?php echo "<b>".$_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']."</b>"??"" ?><sup class="text-warning" style="font-size: 20px;">(Admin)</sup></h1>
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
                        <a class="navbar-brand" href="manage_user_enrollment.php">Manage Enrolments</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                              <a class="nav-link active bg-warning rounded-pill text-light" href="" aria-current="page">Disenrol Users</a>
                            </li>
                             <li class="nav-item">
                              <a class="nav-link " href="batch_course_enrollments.php" aria-current="page">See Enrollments</a>
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
                    <th>Profile Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                   
                    </tr>

                    </thead>

                    <tbody id="enrol_users_table_body">
                    <?php  
                    ############### QUERY FOR FETCHING DATA OF USERS ###############################################
                    $query = "SELECT * FROM USERS , user_role , USER_ROLE_BATCH_COURSE_ENROLLMENT  WHERE USERS.user_id = user_role.user_id AND USER_ROLE_BATCH_COURSE_ENROLLMENT.user_role_id = user_role.user_role_id  AND USER_ROLE_BATCH_COURSE_ENROLLMENT.status_id = 5" ;


                    $result = $database->execute_query($query);

                    if ($result->num_rows) 
                    {
                    
                        
                    while ($rec = mysqli_fetch_assoc($result)) 
                    {
                         
                                
                        ?>
                    <tr>

                    <td><img src="<?php echo $rec['image'] ?>" style="width: 90px; height:70px; border-radius: 50%;"></td>

                    <td><?php echo $rec['first_name']." ".$rec['last_name'] ?></td>
                    <td><?php echo $rec['email'] ?></td>
                       
                    <td id="user_role_type">
                            <!-- <select class="form-control"> -->
                        <?php 

                    ######## QUERY FOR CHECKING USER ROLES ##############

                    $role_query = "SELECT * FROM USERS u,USER_ROLE ur,ROLES r WHERE u.user_id = ur.user_id AND ur.status_id = '1' AND ur.role_id = r.`role_id` AND ur.role_id <> '1' AND u.user_id = '".$rec['user_id']."'";
                    
                    $role = $database->execute_query($role_query);
                    $roles = array();
                    while($check_role = mysqli_fetch_assoc($role))
                    {
                            $roles[] = $check_role['role_id'];
                           
                            echo "<p class='badge bg-secondary'>".$check_role['role_type']."</p>"."<br>" ;
                            
                        
                    }
                    ?>
                               
                            <!-- </select> -->

                    </td> 
                    <td>
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disenrol<?php echo$rec['user_id']  ?>" onclick="<?php $user_id = $rec['user_id']  ?>">
                          Disenrol
                        </button>

                        <?php  

                        $disenrol_query = "SELECT * FROM USER_ROLE_BATCH_COURSE_ENROLLMENT WHERE user_id = $user_id";
                        $disenrol_query_result = $database->execute_query($query);


                        if ($disenrol_query_result->num_rows) 
                        {
                           
                        $disenrol = mysqli_fetch_assoc($disenrol_query_result);
                        $course_batch_query = "SELECT
                                                  *
                                                FROM
                                                  BATCH_COURSE cb,
                                                  BATCHES b,
                                                  COURSES c
                                                WHERE cb.course_id = c.course_id
                                                  AND cb.batch_id = b.batch_id
                                                  AND cb.`batch_course_id` = '".$disenrol['batch_course_id']."'";
                        $fetch_batch_result = $database->execute_query($course_batch_query);
                        }
                        else
                        {
                            echo "User Is Not Enrolled in Any Course Batch";
                        }

                        

                        

                        ?>
                        <!-- Modal -->
                        <div class="modal fade" id="disenrol<?php echo$rec['user_id']  ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="disenrolLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">User Enrolment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body p-5">
                               <form class="row g-3 needs-validation " novalidate enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                            <div id="enrolment_message<?php echo$rec['user_id']  ?>">
                                                
                                          </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                        <?php  

                                        if ($fetch_batch_result->num_rows) 
                                        {
                                          ?>

                                          <label class="text-dark">Batch Course</label>
                                          <select class="form-select" id="course_batch_id">
                                            <?php

                                            while ($batch = mysqli_fetch_assoc($fetch_batch_result)) 
                                            {
                                                ?>

                                                <option value="<?php echo $batch['batch_course_id'] ?>"><?php echo $batch['course_title']." ".$batch['batch_title'] ?></option>

                                                <?php
                                            }



                                            ?>        
                                          </select>


                                          <?php  
                                        }
                                        else
                                        {
                                            ?>
                                            <select>
                                                <option>No Course Batch Found</option>
                                            </select>
                                            <?php
                                        }


                                        ?>

                                         
                                        </div>
                                    </div>
                                        

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                         <?php  
                                         
                                      $role_query = "SELECT * FROM user_role , roles where roles.role_id = user_role.role_id AND user_role.status_id = 1 AND USER_ROLE.role_id <> '1' AND user_role.user_role_id = '".$disenrol['user_role_id']."'";
                                        
                                         $role_result = $database->execute_query($role_query);

                                         ?>   
                                        <label class="text-dark">User Role</label>
                                       <select class="form-select" id="user_role_id<?php echo$user_id  ?>">
                                           <?php 

                                           while ($user_role = mysqli_fetch_assoc($role_result)) 
                                           {
                                             ?>
                                             <option value="<?php echo $user_role['user_role_id'] ?>"><?php echo $user_role['role_type'] ?></option>
                                             <?php
                                           }

                                           ?>
                                       </select>
                                    </div>
                                   
                                </div>
                               
                                
                              </form>
                                    
                                </div>
                                
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" onclick="enrol_user(<?php echo $user_id ?>)">Enroll User</button>
                                </center>
                              </div>
                              </div>
                        
                        </div>
                    </td>      
                        
                    </tr>

                    </tbody>
                    <?php
                    }
                }
                    ?>         
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

