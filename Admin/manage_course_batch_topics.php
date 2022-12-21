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
                  <a class="nav-link " aria-current="page" href="#">Courses</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="manage_batch.php" aria-current="page">Batches</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active bg-warning rounded-pill text-light" href="manage_course_batch.php" aria-current="page">Manage Course Batch</a>
                </li>
              </ul>
            </div>
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcourse">
              Add New Topic
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addcourse" tabindex="-1" aria-labelledby="addcourseLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Topic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                   <form class="row g-3 needs-validation " novalidate>
                        <div class="row">
                            <div class="col-sm-12">
                                    <div id="Message" style=>
                                  </div>
                                
                                    
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <div class="mb-3">
                                  <label class="text-dark">Topic Title</label>
                                  <input type="text" id="topic_title" class="form-control">
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                  <label class="text-dark">Topic Description</label>
                                  <input type="text" id="topic_description" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            
                               <label class="text-dark">Set Status</label>
                               <select class="form-select" id="topic_status_id">
                                   <option value="1">Active</option>
                                   <option value="2">InActive</option>
                                   <!-- <option value="3">Completed</option> -->
                               </select>
                            </div>

                        </div>    
                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="add_topic()">Add Topic</button>
                  </div>
                </div>
              </div>
            </div>

        </div>
     </nav>
    </div>       
</div>
<div class="row">
        <h2 class="text-center text-dark">Set Topics Prirority</h2>
        <hr>
        <!-- COURSE BATCH ID  -->
        <input type="hidden" id="batch_course_id" value="<?php echo $_REQUEST['course_batch_id'] ?>">
        <!-- TOPIC STATUS ID -->
        <input type="hidden" id="status_id" value="<?php echo $_REQUEST['status_id'] ?>">


    <?php

    $count = 1;

    for ($i=1; $i<= $_REQUEST['number_of_topics'] ; $i++) 
    { 
      $query = "SELECT * FROM TOPICS WHERE status_id = 1";
    $result = $database->execute_query($query);
    
        
        ?>
        

        
        <div class="col-sm-6">
        
        <div class="text-light bg-light  border border-light rounded m-2 p-3" >
        
            
                
                    <h1 class="text-center text-dark">Topic <?php echo $i ?></h1>
                   <label class="text-dark">Topic Title</label>
                    <select  class="form-select topic_id"  >

                        <?php
       
                      while ($rec = mysqli_fetch_assoc($result)) 
                        {
                         
                              // code...
                    ?>

                            <option value="<?php echo $rec['topic_id'] ?>"><?php echo $rec['topic_title'] ?></option> 

                    <?php
             
                         
                    }

                ?>
                    </select>

                   


             
       <!--  </div>
        <div class="col-sm-6"> -->
            <label class="text-dark">Topic Priority</label>
            <select  class="form-control topic_priority">
            <?php    

                for ($j=1; $j<= $_REQUEST['number_of_topics'] ;$j++) 
                { 
                    ?>
                    <option><?php echo $j ?></option>
                    <?php
                }


            ?>
            </select>
            <br>
            
        </div>   


            
                
        

        </div>
        <?php
        
    }
    
    ?>

        </div> 
        <button class="btn btn-primary btn-lg" onclick="set_topic_priority()" style="width:100%">Set Topic Priority</button>
        
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
        
        


        // ###### ADD TOPIC FUNCTION ########################

        function add_topic()
        {

            var topic_title = document.getElementById('topic_title').value;
            var topic_description = document.getElementById('topic_description').value;
            var topic_status_id = document.getElementById('topic_status_id').value;
            var action = "add_topic";

            
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
            
            formdata.append('topic_title',topic_title);
            formdata.append('topic_description',topic_description);
            formdata.append('topic_status_id',topic_status_id);
            formdata.append('action',action);

            
            obj.open("POST","course_batch_process.php");
            obj.send(formdata);
        }

        // ##### ADD TOPIC FUNCTION ENDS HERE ###############


        // ### SET BATCH TOPIC PRIORITY  FUNCTION ##########

        function set_topic_priority()
        {
            var topic_priority = document.getElementsByClassName('topic_priority');
            var topic_id = document.getElementsByClassName('topic_id');

            // console.log(topic_priority+topic_id);
    
            var status_id = document.getElementById('status_id').value;
            var batch_course_id = document.getElementById('batch_course_id').value;

            var topic_ids = [];

            var topic_priorities = [];

            // LOOP FOR STORIGN MULTIPLE  TOPIC IDS
            for (var i = 0 ; i <= topic_id.length - 1 ; i++) 
            {
               topic_ids[i] = topic_id[i].value ;
            }
            // LOOP FOR STORING MULTIPLE TOP PRIORITES
            for (var i = 0 ; i <= topic_priority.length - 1 ; i++) 
            {
               topic_priorities[i] = topic_priority[i].value ;
            }

            console.log(topic_priorities);
            console.log(topic_ids);

            var action = "topic_priority";
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
                    
                // document.getElementById('Message').innerHTML=obj.responseText;

                }
            }

            var formdata = new FormData();

            formdata.append('topic_priority',topic_priorities);
            formdata.append('topic_id',topic_ids);
            formdata.append('status_id',status_id);
            formdata.append('batch_course_id',batch_course_id);
            formdata.append('action',action);
            
            obj.open("POST","course_batch_process.php");
            obj.send(formdata);

        }



        // ## SET BATCH TOPICE PRIORITY ENDS HERE #########

       

       
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


