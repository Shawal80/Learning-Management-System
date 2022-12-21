<?php 
	
    
    require("../general/session_maintenance.php");
	require("../require/header_footer.php");
    header_footer::header("../general/logout.php");
    $database = new database();

 ?>
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
  <p><a href="" class="text-decoration-none text-dark">Manage Users</a></p>
  <p><a href="manage_user_role.php" class="text-decoration-none text-dark">Manage User Roles</a></p>
  <p><a href="manage_course.php" class="text-decoration-none text-dark active">Manage Course Batch</a></p>
  
<p><a href="" class="text-decoration-none text-dark">Manage Course Enrolement</a></p>
</div>
</div>
</div>
<div class="col-sm-9">
<div class="card m-1  border border-light">
    <div class="card-header bg-light text-dark">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="manage_course_batch.php">Manage Course Batches</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="manage_course.php">Courses</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="manage_batch.php" aria-current="page">Batches</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active bg-warning rounded-pill text-light" href="manage_course_batch.php" aria-current="page">Manage Course Batch</a>
                </li>
              </ul>
            </div>
             <!-- MODEL FOR SELECTING COURSE AND BATCH -->
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Assign Course To Batch    
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Course To Batch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="row g-3 needs-validation " novalidate action="manage_course_batch_topics.php" method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                    <div id="Message" >
                                  </div>
                                
                                    
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <div class="mb-3">
                                  <label class="text-dark">Batch Title</label>
                                  <select class="form-select" id="batch_id">
                                      <?php 

                                        $batch_query = "SELECT * FROM BATCHES  WHERE status_id = 1";
                                        echo "$batch_query";
                                        $result_batch = $database->execute_query($batch_query);
                                        while ($rec = mysqli_fetch_assoc($result_batch)) 
                                        {
                                            ?>

                                            <option value="<?php echo $rec['batch_id']; ?>"><?php echo $rec['batch_title'] ?></option>

                                            <?php
                                        }



                                       ?>
                                  </select>
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                  <label class="text-dark">Course Title</label>
                                  <select class="form-select" id="course_id">
                                      <?php 

                                        $course_query = "SELECT * FROM COURSES  WHERE status_id = 1 ";
                                        $result_course = $database->execute_query($course_query);
                                        while ($rec = mysqli_fetch_assoc($result_course)) 
                                        {
                                            ?>

                                            <option value="<?php echo $rec['course_id']; ?>"><?php echo $rec['course_title'] ?></option>

                                            <?php
                                        }
                                       ?>
                                  </select>
                                  
                                  
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                    <label class="text-dark">Number Of Topics</label>
                                    <input type="text" id="number_of_topics" class="form-control">
                            </div>
                            <div class="col-sm-6">
                               <label class="text-dark">Set Status</label>
                               <select class="form-select" id="status_id">
                                   <option value="1">Active</option>
                                   <option value="2">InActive</option>
                                   <option value="3">Completed</option>
                               </select>
                            </div>

                        </div>    
                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="assign_course()">Assign Course</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- MODEL FOR SLECTING COURSE AND BATCH ENDS HERE  -->
          </div>
         
        </nav> 
    </div>
</div>

<div class="card-body  text-dark m-3 ">
                 
                

             <div class="row m-3">
                <div id="message_update" class="m-2">
                    
                </div>
                <?php  


               $query = "SELECT *  FROM  COURSES c, BATCHES b , BATCH_COURSE cb WHERE cb.course_id = c.course_id AND cb.batch_id = b.batch_id" ;
     


                $result = $database->execute_query($query);
                $course_id = null;
                if ($result->num_rows) 
                {
                    ?>
                    <table id="example" class="display" style="width:100%; text-align:center" >
                        <thead>
                            
                        <tr>
                            <th>Course-Batch-Id</th>
                            <th>Course Title</th>
                            <th>Batch Title</th>
                            <th>Number Of Topics</th>
                            <th>Status</th>
                            <th>Set Status</th>
                            <th>Set Priority</th>
                            <th>See Priority</th>
                        </tr>
                        </thead>
                    <?php
                   while ($rec = mysqli_fetch_assoc($result)) 
                   {
                    ?>
                            <tbody>
                                
                            <tr>
                                
                                <td ><?php echo $rec['batch_course_id'] ?></td>
                                <td><?php echo strtoupper($rec['course_title']) ?></td>
                                <td><?php echo strtoupper($rec['batch_title']) ?></td>
                                <td><?php echo $rec['number_of_topics'] ?></td>
                                <td>
                                <?php 
                                if ($rec['status_id'] == 1) 
                                {
                                    ?>
                                    <p class="badge text-light rounded bg-success" style="font-weight: bold;">Active</p>
                                    <?php
                                }
                                else if ($rec['status_id'] == 2) 
                                {
                                    ?>
                                    <p class="badge text-light rounded bg-danger" style="font-weight: bold;">InActive</p>
                                    <?php
                                }  
                                else if ($rec['status_id'] == 3) 
                                {
                                  ?>
                                    <p class="badge text-light rounded bg-secondary" style="font-weight: bold;">Complete</p>
                                    <?php  
                                } 
                                ?>
                                    


                                </td>
                                <td>
                                    <select class="form-select" id="batch_course_status_id<?php echo $rec['batch_course_id'] ?>" onchange="batch_course_status(<?php echo $rec['batch_course_id'] ?>)">
                                        <option value="1" selected>Active</option>
                                        <option value="2">InActive</option>
                                        <option value="3">Completed</option>
                                            
                                    </select>
                                </td>
                                <td>
                                     <!-- BUTTON TO SET ROLE PRIORITY -->
                                    <a href="manage_course_batch_topics.php?number_of_topics=<?php echo $rec['number_of_topics']  ?>&course_batch_id=<?php echo $rec['batch_course_id'] ?>&status_id=<?php echo $rec['status_id'] ?>" class="btn btn-primary">Set Priority</a>
                                </td>
                                <td>
                                    
                                    <!-- BOTTOB TO SEE BATCH TOPIC PRIORITY -->
                                    <a href="batch_priority.php?course_batch_id=<?php echo $rec['batch_course_id'] ?>&batch_title=<?php echo $rec['batch_title'] ?>" class="btn btn-secondary">See Priority</a>
                                </td>

                                
                               
                                   
                            </tr>

                            </tbody>                    
                    <?php
                   }
                }
                else
                {
                    ?>
                    <div class="alert alert-primary" role="alert">
                    No Course Assigned To Any Batch
                    </div>
                    <?php
                }


                ?>
                  </table>
                       </div>
                       

</div>
                  
            </div>
</div>
 




                                    

 <!-- FOOTER REQUIRED FILE -->
 <?php header_footer::footer("../index.php") ?>
 <!-- #################### -->

 
<!-- Option 1: Bootstrap Bundle with Popper --><!-- 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->

    <script type="text/javascript " src="../require/media/jquery.js"></script>
      <script type="text/javascript" src="../require/media/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        
        // #### ADD COURSE ############################
        function assign_course()
        {
            
            var course_id = document.getElementById('course_id').value;
            var batch_id = document.getElementById('batch_id').value;
            var number_of_topics = document.getElementById('number_of_topics').value;
            var status_id = document.getElementById('status_id').value;
            var action = "assign_course";

            
             
            var obj;

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
                    
                document.getElementById('Message').innerHTML=obj.responseText;

                }
            }
            formdata = new FormData();
            
            formdata.append('course_id',course_id);
            formdata.append('batch_id',batch_id);
            formdata.append('status_id',status_id);
            formdata.append('number_of_topics',number_of_topics);
            formdata.append('action',action);

            
            obj.open("POST","course_batch_process.php");
            obj.send(formdata);
  
        }
           
            
            

        

        // #### ADD COURSE ENDS HERE ############################



        // ######  CHANGE BATCH COURSE STATUS ###################
       function batch_course_status(batch_course_id)
       {

            var batch_course_status_id = document.getElementById('batch_course_status_id'+batch_course_id).value;

            // alert(batch_course_status_id);

            
            var action = "batch_course_status";

            // alert(batch_course_status_id) ;        
             
            var obj;

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
                  
                document.getElementById('message_update').innerHTML = obj.responseText;
              
                }
            }
            formdata = new FormData();
            
            formdata.append('batch_course_id',batch_course_id);
            formdata.append('batch_course_status_id',batch_course_status_id);
            formdata.append('action',action);

            
            obj.open("POST","course_batch_process.php");
            obj.send(formdata);
       }
        // ######  CHANGE BATCH COURSE STATUS ENDS HERE ###################




       

       
    </script>
  </body>
</html>
<!-- DATA TABLE JQUERY FUNCTION -->
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- DATA TABLE JQUERY FUNCTION ENDS HERE -->


