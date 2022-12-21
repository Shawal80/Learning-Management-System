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
	      <p><a href="" class="text-decoration-none text-dark">Manage User Roles</a></p>
	      <p><a href="manage_course_batch.php" class="text-decoration-none text-dark">Manage Course Batch</a></p>
	      
	      <p><a href="" class="text-decoration-none text-dark">Manage Course Enrolement</a></p>
     	  </div>
  	  </div>
		</div>
		<div class="col-sm-9">
			<div class="card m-1  border border-light " style="background-color:#5189B8;">
				<div class="card-header bg-light text-dark">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <div class="container-fluid">
                    <a class="navbar-brand" href="#">Manage User Roles</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                          <a class="nav-link active bg-warning rounded-pill text-light" aria-current="page" href="#">Assign Role</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link " href="change_role.php" aria-current="page">Change Roles Status</a>
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
        <th>Account Status</th>
        <th>Active Role</th>
        <th>Assign Role</th>
        <th>Action</th>
        </tr>

        </thead>

        <tbody>
        <?php

        ############### QUERY FOR FETCHING DATA OF USERS ###############################################
        $query = "SELECT * FROM USERS u , STATUS s WHERE u.`status_id` = s.`status_id` AND u.`status_id` = 1 AND u.`user_id` <> ".$_SESSION["user"]["user_id"];


        $result = $database->execute_query($query);

        if ($result->num_rows) 
        {

        while ($rec = mysqli_fetch_assoc($result)) 
        {
            ?>
        <tr>

        <td><img src="<?php echo $rec['image'] ?>" style="width: 90px; height:70px; border-radius: 50%;"></td>

        <td><?php echo ucwords($rec['first_name']." ".$rec['last_name']) ?></td>
        <td><?php echo $rec['email'] ?></td>
        <td><?php  if ($rec['status_id'] == 1) 
        {
           ?>
            <p class=" text-light rounded" style="font-weight: bold; background-color:green ;">Active</p>
            <?php
        }
        elseif ($rec['status_id'] == 2) 
        {
            ?>
            <p class=" text-light rounded" style="font-weight: bold; background-color:red">InActive</p>
            <?php
         } ?></td>   
        <td id="user_role_type">
                <!-- <select class="form-control"> -->
            <?php 

        ######## QUERY FOR CHECKING USER ROLES ##############

        $role_query = "SELECT * FROM USERS u,USER_ROLE ur,ROLES r WHERE u.user_id = ur.user_id AND ur.status_id = '1' AND ur.role_id = r.`role_id` AND u.user_id = '".$rec['user_id']."'";
        
        $role = $database->execute_query($role_query);
        $roles = array();
        $count = null;
        while($check_role = mysqli_fetch_assoc($role))
        {
                $count++;
                $roles[] = $check_role['role_id'];
                echo "<p class='badge bg-secondary'>".$check_role['role_type']."</p>"."<br>" ;
            
        }

        ?>         
                   
                <!-- </select> -->


        </td>   
        

         <td>
             <?php 

                $user_inactive_roles = implode(',',$roles); 
                trim($user_inactive_roles);
                $select_in_active_query = "SELECT * FROM   roles r WHERE r.`role_id` NOT IN ($user_inactive_roles)";

                $select_role = $database->execute_query($select_in_active_query);

               if ($select_role->num_rows) 
               {
                ?>

                <select class="form-select" id="user_role_id<?php echo $rec['user_id'] ?>">
                    
                

                <?php
                   
                while ($inactive_role = mysqli_fetch_assoc($select_role)) 
                {
                    

                    ?>

                    <option value="<?php echo $inactive_role['role_id'] ?>" onselect="user_role_status(this)"><?php echo $inactive_role['role_type'] ?></option>
                    <?php
                    
                   
                }



              ?>
              </select>
               <?php 
           }else
                {
                    echo "No Role Available";

                    $btn = "disable";
                    
                }
            ?>
         </td>
        <td > 
                <?php 

                // if (isset($btn) && $btn == "disable") 
                // {
                //     ?>
                   <!--  <script type="text/javascript">
                            

                //   document.getElementById("assign_btn").disabled = true;
                            
                //     </script> -->
                     <?php
                // }

                ?>
             
              <button class="btn btn-primary" onclick="assign_role(<?php echo $rec['user_id'] ?>)" id="assign_btn"> Assign </button>
              
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

                        
           //#####  ROLE ASSIGN FUNCTION ################

            function assign_role(userid)

            {
                // var value1 = document.getElementsByTagName('')
                var role_id = document.getElementById('user_role_id'+userid).value;
                
                // alert(role_id);

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
                    // location.reload();   

                    }
                }
                

                
                obj.open("POST","admin_process.php");
                obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                obj.send("action=assign_role&user_id="+userid+"&role_id="+role_id);
            }

            // ############ USER ROLE FUNCTION ENDS HERE #############################



            

      </script>


     
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

