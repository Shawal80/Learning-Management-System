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
		      <p><a href="" class="text-decoration-none text-dark">Manage Course Batch</a></p>
		      
		      <p><a href="" class="text-decoration-none text-dark">Manage Course Enrolement</a></p>
	     	  </div>
	  	  </div>
 		</div>
 		<div class="col-sm-9">
 			<div class="card m-1  border border-light">
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
                              <a class="nav-link " aria-current="page" href="index.php">Account Controls</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link active bg-warning rounded-pill text-light" href="#" aria-current="page">New Users</a>
                            </li>
                          </ul>
                          

                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          Add New User
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="staticBackdropLabel">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                               <form class="row g-3 needs-validation " novalidate enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                            <div id="email_message" style=>
                                          </div>
                                        
                                            
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="text-dark">First Name</label>
                                          <input type="text" class="form-control" id="firstname" aria-describedby="emailHelp" required>
                                          
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="text-dark">Last Name</label>
                                          <input type="text" class="form-control" id="lastname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="text-dark">Email</label>
                                          <input type="text" class="form-control" id="email" aria-describedby="emailHelp" onblur="" required>
                                          
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="text-dark">Password</label>
                                          <input type="password" class="form-control" id="password" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                         <div class="mb-3">
                                          <label class="text-dark">Gender</label>
                                          <select name="gender" id="gender" class="form-control" required>
                                            <option>Male</option>
                                            <option>Female</option>
                                            
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="mb-3">
                                          <label class="text-dark">Profile Image</label>
                                          <input type="file" class="form-control" id="profile_image" accept=".png,.jpg,.jpeg,.bmp,." required>
                                        </div>
                                    </div>                      
                                </div>
                                <div class="row">

                                    <div class="col-sm-6">
                                         <div class="mb-3">
                                          <label class="text-dark">Account Status</label>
                                       
                                          <select name="account_status" id="account_status" class="form-control" required>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                            
                                          </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">

                                         <div class="mb-3">

                                          <label class="text-dark">Assign Role</label>
                                          <select name="user_role" id="user_role" class="form-control" required>
                                            <option value="1">Admin</option>
                                            <option value="2">Teacher</option>
                                            <option value="3">Student</option>
                                            
                                          </select>
                                        </div>
                                    </div>                      
                                </div>
                                
                                <center>  
                                
                              </form>

                              <script type="text/javascript">
                                  // Example starter JavaScript for disabling form submissions if there are invalid fields
                                    (function () {
                                      'use strict'

                                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                      var forms = document.querySelectorAll('.needs-validation')

                                      // Loop over them and prevent submission
                                      Array.prototype.slice.call(forms)
                                        .forEach(function (form) {
                                          form.addEventListener('submit', function (event) {
                                            if (!form.checkValidity()) {
                                              event.preventDefault()
                                              event.stopPropagation()
                                            }

                                            form.classList.add('was-validated')
                                          }, false)
                                        })
                                    })()
                              </script>      
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-outline-success" onclick="register()">Register</button>
                                </center>
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
                <?php  

               $query = "SELECT * FROM USERS WHERE status_id = '2' AND is_approve = 'Pending' or is_approve = 'Rejected' " ;



                $result = $database->execute_query($query);

                if ($result->num_rows) 
                {
                    ?>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            
                        <tr>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Account Status</th>
                            <th>Request Status</th>
                            <th>Profile Image</th>
                            <th> Set Request</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    <?php
                   while ($rec = mysqli_fetch_assoc($result)) 
                   {
                    ?>
                            <tbody>
                                
                            <tr>
                                
                                <td><?php echo $rec['user_id'] ?></td>
                                
                                <td><?php echo $rec['first_name']." ".$rec['last_name'] ?></td>
                                
                                
                                <td><?php echo $rec['status_id'] ?></td>
                                <td><?php echo strtoupper($rec['is_approve']); ?></td>
                                
                                <td><img src="<?php echo $rec['image'] ?>" style="width: 90px; height:70px; border-radius: 50%;"></td>
                                <td>
                                    <select id="request" class="form-control bg-light text-dark">
                                        <option value="Approved" class="bg-success text-light">Approve</option>
                                        <option value="Rejected" class="bg-danger text-light">Reject</option>
                                    </select>
                                </td>
                                <td><button class="btn btn-outline-success" onclick="approve_reject_user(<?php echo $rec['user_id'] ?>)">Done</button>
                                   
                            </tr>

                            </tbody>                    
                    <?php
                   }
                }
                else
                {
                    ?>
                    <div class="alert alert-primary" role="alert">
                    No New User Found
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

 <!-- FOOTER REQUIRED FILE -->
 <?php header_footer::footer("../index.php") ?>
 <!-- #################### -->

 
<!-- Option 1: Bootstrap Bundle with Popper --><!-- 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->

    <script type="text/javascript " src="../require/media/jquery.js"></script>
      <script type="text/javascript" src="../require/media/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        
        // #### ADD NEW USER BY ADMIN ############################



        function register()
        {
            
            var first_name = document.getElementById('firstname').value;
            var last_name = document.getElementById('lastname').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var gender = document.getElementById('gender').value;
            var account_status = document.getElementById('account_status').value;
            var user_role = document.getElementById('user_role').value;
            var image = document.getElementById('profile_image').files[0];
            var action = 'user_registeration';
            
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
            formdata.append('firstname',first_name);
            formdata.append('lastname',last_name);
            formdata.append('email',email);
            formdata.append('password',password);
            formdata.append('gender',gender);
            formdata.append('user_role',user_role);
            formdata.append('account_status',account_status);
            formdata.append('profile_image',image);
            formdata.append('action',action);

            
            obj.open("POST","admin_process.php");
            obj.send(formdata);


        }
       


        // #### ADD NEW USER BY ADMIN END############################



        // ############ CHECK EMAIL IF ALREADY EXISTS FUNCTION ############################

        function checkemail()
        {
                

            var email = document.getElementById('email').value;
            var action = "check_email";
            var obj ;

            formdata = new FormData();
            formdata.append('email',email);
            formdata.append('action',action);

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
                        alert
                        if(obj.responseText== "email_exists")
                        {

                        document.getElementById('email_message').innerHTML = "Please Try With Another Email This Email Is Already Registered";
                        document.getElementById('registerbutton').disabled = true;
                        
                        }
                        
                }

            }
            
            obj.open("POST","admin_process.php");
            obj.send(formdata);
        
        }



        // ############ CHECK EMAIL IF ALREADY EXISTS FUNCTION ENDS HERE ##################


        //##################### USER ACCOUNT REQUEST FUNCTION ##########################

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


