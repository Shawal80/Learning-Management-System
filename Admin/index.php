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
		      <p><a href="manage_course.php" class="text-decoration-none text-dark">Manage Course Batch</a></p>
		      
		      <p><a href="manage_user_enrollment.php" class="text-decoration-none text-dark">Manage Course Enrolement</a></p>
	     	  </div>
	  	  </div>
 		</div>
 		<div class="col-sm-9">
 			<div class="card m-1  border border-light " style="background-color:#5189B8;">
 				<div class="card-header bg-light text-dark">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <div class="container-fluid">
                        <a class="navbar-brand" href="#">Manage Users</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                              <a class="nav-link  active bg-warning rounded-pill text-light" aria-current="page" href="#">Account Controls</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " href="new_users.php" aria-current="page">New Users</a>
                            </li>
                          </ul>
                          

                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Download User's Data
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Download User's Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="row m-3">
                                    <div class="col-sm-3">
                                        
                                    </div>
                                     <div class="col-sm-6">
                                         <a href = "user_data_process.php?action=wordfile" class="btn btn-primary">Download Data In Word File</a>
                                     </div>
                                     <div class="col-sm-3">
                                        
                                    </div>
                                     
                                 </div>                  
                              </div>
                              
                            </div>
                          </div>
                        </div>

                      </div>
                    </nav>
                  </div>
                    
                    
                                           

                   
 			</div>
            
            <div class="card-body  text-dark m-3 ">
                 
                

             <div class="row m-3">
               
                    <table  id="example" class="display text-center bg-light" style="width:100%" >

        <thead>

        <tr>
        <th>Profile Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Account Status</th>
        <th>Active Role</th>
        <th>Set Account Status</th>
       
        </tr>

        </thead>

        <tbody id="new_users_table_body">
        

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

      

      <script type="text/javascript">

            setInterval(function(){ show_users(); }, 1000);
            
            //#####  ACTIVE  USER FUNCTION ################

            function active_inactive_user(userid,account_status_id)

            {

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
                

                
                obj.open("POST","admin_process.php");
                obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                obj.send("action=activeinactiveuser&user_id="+userid+"&user_account_status="+account_status_id);
            }

            //#####  ACTIVE  USER ENDS HERE ################

            // ########### SHOW USERS ################

            function show_users()
            {

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
                        
                        
                        document.getElementById('new_users_table_body').innerHTML = obj.responseText;   

                    }
                }
                

                
                obj.open("POST","admin_process.php");
                obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                obj.send("action=showuser");
            }



            // ########### SHOW USERS ENDS HERE ################






      </script>

<script type="text/javascript" src="../require/media/jquery.js"></script>
      <script type="text/javascript" src="../require/media/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
     <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
  </body>

</html>


