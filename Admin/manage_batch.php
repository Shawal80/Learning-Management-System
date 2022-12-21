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
              <p><a href="" class="text-decoration-none text-dark">Manage Users</a></p>
              <p><a href="manage_user_role.php" class="text-decoration-none text-dark">Manage User Roles</a></p>
              <p><a href="" class="text-decoration-none text-dark active">Manage Course Batch</a></p>
              
              <p><a href="" class="text-decoration-none text-dark">Manage Course Enrolement</a></p>
              </div>
          </div>
        </div>
        <div class="col-sm-9">
            <div class="card m-1  border border-light">
                <div class="card-header bg-light text-dark">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <div class="container-fluid">
                        <a class="navbar-brand" href="#">Manage Course Batches</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                              <a class="nav-link " aria-current="page" href="manage_course.php">Courses</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active  bg-warning rounded-pill text-light" href="#" aria-current="page">Batches</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " href="manage_course_batch.php" aria-current="page">Manage Course Batch</a>
                            </li>
                          </ul>
                          

                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Add New Batch
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="staticBackdropLabel">Add Batch</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                               <form class="row g-3 needs-validation " novalidate enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                            <div id="Batch_Message">
                                          </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="text-dark">Batch Title</label>
                                          <input type="text" class="form-control" id="batch_title" aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <label class="text-dark">Batch Status</label>
                                       <select class="form-select" id="batch_status_id">
                                           <option value="1">Active</option>
                                           <option value="2">InActive</option>
                                           <option value="3">Completed</option>
                                       </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="text-dark"> Batch Start Date </label>
                                        <input type="date" id="batch_start_date" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="text-dark"> Batch End Date </label>
                                        <input type="date" id="batch_end_date" class="form-control">
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div class="mb-3">
                                          <label class="text-dark">Batch Description</label>
                                          <textarea class="form-control" id="batch_description"></textarea>
                                        </div>
                                    </div>
                                    </div>
                                
                              </form>
                                    
                                </div>
                                
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" onclick="add_batch()">Add batch</button>
                                </center>
                              </div>
                              </div>
                        
                        </div>

                      </div>
                    </nav>
                   
                    
                                           

                   
            </div>
            </div>
            <div class="card-body  text-dark m-3 ">
                 
                

             <div class="row m-3">
                <?php  

               $query = "SELECT * FROM BATCHES" ;



                $result = $database->execute_query($query);
                $course_id = null;
                if ($result->num_rows) 
                {
                    ?>
                    <table id="example" class="display" style="width:100%; text-align:center">
                        <thead>
                            
                        <tr>
                            <th>Batch-Id</th>
                            <th>Batch Title</th>
                            <th>Batch Descrription</th>
                            <th>Batch Start Date</th>
                            <th>Batch End Date</th>
                            <th>Batch Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    <?php
                   while ($rec = mysqli_fetch_assoc($result)) 
                   {
                    ?>
                            <tbody>
                                
                            <tr>
                                
                                <td ><?php echo $rec['batch_id'] ?></td>
                                <td><?php echo strtoupper($rec['batch_title']); ?></td>
                                <td><?php echo $rec['batch_description'] ?></td>
                                <td><?php echo $rec['batch_start_date'] ?></td>
                                <td><?php echo $rec['batch_end_date'] ?></td>
                                <td>
                                <?php 
                                if ($rec['status_id'] == 1) 
                                {
                                    ?>
                                    <p class=" text-light rounded text-center" style="font-weight: bold; background-color:green ;">Active</p>
                                    <?php
                                } 
                                else if ($rec['status_id'] == 2)
                                {
                                  ?>
                                    <p class=" text-light rounded" style="font-weight: bold; background-color:red ;">InActive</p>
                                    <?php  
                                } 
                                else 
                                {
                                  ?>
                                    <p class="badge bg-dark text-light rounded" style="font-weight: bold">Completed</p>
                                    <?php  
                                } 
                                ?>
                                    


                                </td>
                                <td>
                                     <!-- Button trigger modal -->
                                    <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_course"
                                       onclick="show_batches(<?php echo $rec['batch_id']?>)">
                                       Batch Properties
                                    </button>
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
                    No Registered Batch Found
                    </div>
                    <?php
                }


                ?>
                  </table>
                       </div>
                       


                  
            </div>
            
        </div>
    </div>
 </div>
 <!-- MAIN CONTENT ENDS HERE -->
  <!-- EDIT COURSE DATA -->
                                    <!-- MODEL STARTS HERE -->
                        <div class="modal fade text-left" id="edit_course" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Batch</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form class="row g-3 needs-validation " novalidate enctype="multipart/form-data">
                                    <div class="row">
                                    <div class="col-sm-12">
                                            <div id="Batch_Message">
                                          </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="text-dark">Batch Title</label>
                                          <input type="text" class="form-control" id="edit_batch_title" aria-describedby="emailHelp" required>
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                        <label class="text-dark">Batch Status</label>
                                       <select class="form-select" id="edit_batch_status_id">
                                           <option value="1">Active</option>
                                           <option value="2">InActive</option>
                                           <option value="3">Completed</option>
                                       </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="text-dark"> Batch Start Date </label>
                                        <input type="date" id="edit_batch_start_date" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="text-dark"> Batch End Date </label>
                                        <input type="date" id="edit_batch_end_date" class="form-control">
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div class="mb-3">
                                          <label class="text-dark">Batch Description</label>
                                          <textarea class="form-control" id="edit_batch_description"></textarea>
                                        </div>
                                    </div>
                                    </div>
                                  </form>
                              </div>
                              <input type="hidden" id="edit_batch_id">
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="edit_batch()">Update Batch</button>
                              </div>
                            </div>
                          </div>
                        </div>
                       <!-- MODEL ENDS HERE -->
                                  




                                    <!-- EDIT COURSE DATA ENDS HERE -->

 <!-- FOOTER REQUIRED FILE -->
 <?php header_footer::footer("../index.php") ?>
 <!-- #################### -->

 
<!-- Option 1: Bootstrap Bundle with Popper --><!-- 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->

    <script type="text/javascript " src="../require/media/jquery.js"></script>
      <script type="text/javascript" src="../require/media/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        
        // #### ADD BATCH ############################
        function add_batch()
        {
            
            var batch_title = document.getElementById('batch_title').value;
            var batch_description = document.getElementById('batch_description').value;
            // var batch_status_id = document.getElementById('batch_status_id').value;
            var batch_start_date = document.getElementById('batch_start_date').value;
            var batch_end_date = document.getElementById('batch_end_date').value;
            var batch_status_id = document.getElementById('batch_status_id').value;
            var action = "add_batch";

            
            

            
             
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
                    
                    
                alert(obj.responseText);

                }
            }
            formdata = new FormData();
            
            formdata.append('batch_title',batch_title);
            formdata.append('batch_description',batch_description);
            formdata.append('batch_status_id',batch_status_id);
            formdata.append('batch_start_date',batch_start_date);
            formdata.append('batch_end_date',batch_end_date);
            formdata.append('action',action);

            
            obj.open("POST","course_batch_process.php");
            obj.send(formdata);
  
        }
           
            
            

        

        // #### ADD BATCH ENDS HERE ############################

        // #### EDIT BATCH STARTS HERE ############################
        function edit_batch()
        {
            var batch_id =  document.getElementById('edit_batch_id').value;
            var batch_title = document.getElementById('edit_batch_title').value;
            var batch_description = document.getElementById('edit_batch_description').value;
            var batch_status_id = document.getElementById('edit_batch_status_id').value;
            var batch_start_date = document.getElementById('edit_batch_start_date').value;
            var batch_end_date = document.getElementById('edit_batch_end_date').value;
            var action = "edit_batch";
           

            
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
                    
                    
                alert(obj.responseText);

                }
            }
            formdata = new FormData();
            
            formdata.append('batch_title',batch_title);
            formdata.append('batch_description',batch_description);
            formdata.append('batch_status_id',batch_status_id);
            formdata.append('batch_start_date',batch_start_date);
            formdata.append('batch_end_date',batch_end_date);
            formdata.append('batch_id',batch_id);
            formdata.append('action',action);

            
            obj.open("POST","course_batch_process.php");
            obj.send(formdata);


        }

        // #### EDIT COURSE END ############################

        //############# SHOW COURSE DATA FOR UPDATE FUNCTION ##################

         function show_batches(batch_id)
         {

            
            var obj ;

            if (window.XMLHttpRequest) 
            {
                 obj =  new XMLHttpRequest();
            }
            else
            {
                obj = new ActiveXObject('microsoft.XMLHTTP');
            }

            obj.onreadystatechange = function()
            {
                if (obj.readyState == 4 && obj.status == 200) 
                {

                    var mydata = obj.responseText.split(",");
                    console.log(mydata)

                    document.getElementById('edit_batch_title').value = mydata['0'];
                    document.getElementById('edit_batch_description').value = mydata['1'];
                    document.getElementById('edit_batch_start_date').value = mydata['2'];
                    document.getElementById('edit_batch_end_date').value = mydata['3'];
                    document.getElementById('edit_batch_id').value = mydata['4'];
                    
                               
                        
                }

            }
            
            obj.open("POST","course_batch_process.php");
            obj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            obj.send("action=show_batch&batch_id="+batch_id);
z
         }

        //############# SHOW COURSE DATA FOR UPDATE FUNCTION ENDS HER #########

       

       function approve_reject_user(user_id)
       {
            
            var obj ;

            

            

            var request = document.getElementById('request').value;

            if (window.XMLHttpRequest) 
            {
                 obj =  new XMLHttpRequest();
            }
            else
            {
                obj = new ActiveXObject('microsoft.XMLHTTP');
            }

            obj.onreadystatechange = function()
            {
                if (obj.readyState == 4 && obj.status == 200) 
                {
                    
                            alert(obj.responseText);
                            location.reload();
                        
                }

            }
            
            obj.open("POST","admin_process.php");
            obj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            obj.send("action=user_request&user_id="+user_id+"&request="+request);
       }

        //##################### USER ACCOUNT REQUEST FUNCTION ENDS HERE ################


       
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


