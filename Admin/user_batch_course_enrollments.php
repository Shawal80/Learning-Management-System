<?php 
	
    
    require("../general/session_maintenance.php");
	require("../require/header_footer.php");
    header_footer::header("../general/logout.php");
    $database = new database();



 ?>
 <!-- MAIN CONTENT STARS HERE -->
 <div class="container-fluid" >

 	<div class="row">

 		<div class="col-sm-2 mt-5 mb-5">
 			<a href="manage_user_enrollment.php" class="btn btn-secondary">BACK</a>
 		</div>
 		<div class="col-sm-8 mt-5 mb-5">
 			
 			<!-- <h2 class=" text-center text-light">TOPIC PRIORITY</h2> -->
 			<h2 class="text-center text-dark"><?php echo  strtoupper($_REQUEST['batch_title_']) ?></h2>
 			<hr>
 			<?php 

 				$batch_title = $_REQUEST['batch_title_'];

				$query = "SELECT * FROM user_role_batch_course_enrollment WHERE batch_course_id =  '".$_REQUEST['course_batch_id']."' AND status_id IN (5 , 6)";

				
               
               $result = $database->execute_query($query);

                if ($result) 
                {
                	
                	?>

        	 <table  id="example" class="text-center" style="width:100%">

			        <thead>
			        	
			        <tr>
			        	<th>S.No</th>
			        	<th>NAME</th>	
			        	<th>ROLE</th>	
			        	<th>ROLE STATUS</th>	
			        	<th>ACTION</th>	
			       	
			        </tr>

			       </thead>
			        <tbody>


        	<?php
        	while ($rec = mysqli_fetch_assoc($result)) 
        	{
        		?>
		                   


					        	
        		<?php 

        		$data_query = "
				  SELECT * FROM USERS  , USER_ROLE  , ROLES  
				  WHERE USER_ROLE.`role_id` = ROLES.`role_id`
				  AND USER_ROLE.`user_id` = USERS.`user_id` 
				  AND USER_ROLE.`user_role_id` ='".$rec['user_role_id']."' ";

				  

				  $data_result = $database->execute_query($data_query);
				  
				  while ($users = mysqli_fetch_assoc($data_result)) 
				  {
				  	
				  	?>

				  	<tr>
				  		<td><?php echo $users['user_id'] ; ?></td>
		        		<td><?php echo ucwords($users['first_name']." " .$users['last_name']) ?></td>
		        		<td><?php echo $users['role_type'] ?></td>
		        		<td><?php

		        			if ($rec['status_id'] == 5) 
		        			{
		        				?>
		        				<p class="badge bg-success">Enroled</p>
		        				<?php
		        			}
		        			else
		        			{
		        				?>
		        				<p class="badge bg-danger">Dis-Enroled</p>
		        				<?php
		        			}


		        		 ?></td>
		        		<td>
							        			<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user_update<?php echo $users['user_id'] 	 ?>" onclick="<?php $user_role_id =  $users['user_role_id']?>">
						  Update
						</button>
						<?php 	 


					$user_data = "SELECT
									  *
									FROM
									  users,
									  batches,
									  courses,
									  batch_course,
									  roles,
									  user_role
									WHERE user_role.`user_id` = users.`user_id` 
									AND user_role.`role_id` = roles.`role_id` 
									AND batch_course.`batch_id` = batches.`batch_id`
									AND batch_course.`course_id` = courses.`course_id`
									AND batch_course.`batch_course_id` = '".$rec['batch_course_id']."'
									AND user_role.`user_role_id` = '$user_role_id'"; 
							
							$user_data_result = $database->execute_query($user_data);

							$user = mysqli_fetch_assoc($user_data_result);	

						?>
						<!-- Modal -->
						<div class="modal fade" id="user_update<?php echo $users['user_id'] 	 ?>" tabindex="-1" aria-labelledby="user_update<?php echo $users['user_id'] 	 ?>Label" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Update Enrolled User</h5>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body">
						      	
						      			<div id="msg<?php echo $user_role_id ?>">
						      				
						      			</div>
						      		
						      	
						      	<div class="row">
						      	<div class="col-sm-12">	
						      		<img src="<?php echo $user['image'] ?>" style="width: 90px; height:70px; border-radius: 50%;">

                    				<?php echo $user['first_name']." ".$user['last_name'] ?>
						      	<br>
						      	</div>
						      	<br>		
						      	<hr>
						      	</div>
						         <table>
						         	<tr>
						         		<th>Batch Course</th>
						         		<th>Role</th>
						         		<th>Set Status</th>
						         		
						         	</tr>
						         	<tr>
						         	<td><?php echo $user['batch_title']." ".$user['course_title']?></td>
						         	<td><?php echo $user['role_type'] ?></td>	
						         	<td>

						         		<select class="form-select" id="role_status<?php echo $user_role_id ?>">
						         			<option value="5">Enrol</option>
						         			<option value="6">Dis-Enrol</option>
						         			<option value="3">Completed</option>
						         		</select>
						         		
						         	</td>	
						         	</tr>
						         </table>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						        <button type="button" class="btn btn-primary" onclick="disenrol(<?php echo $user_role_id ?>, <?php echo $rec['batch_course_id']; ?>)">Update</button>
						      </div>
						    </div>
						  </div>
						</div>
						</td>
				        		</tr>

				  	<?php
				  }

        		 ?>

       <?php
}
?>


					        </tbody>
					        </table>

                    <?php
                    
                   
                      






                }


			 ?>
 			
 		</div>
 		<div class="col-sm-2 mt-5">
 			<a href="user_data_process.php?action=user_enrolment_data&batchcourseid=<?php echo$_REQUEST['course_batch_id'] ?>&batchtitle=<?php echo $batch_title ?>" class="btn btn-secondary">Download Batch Data</a>
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
      		
      function disenrol(userroleid,batch_course_id)
      {

      	// alert(batch_course_id);

		var obj;
		var role_status = document.getElementById('role_status'+userroleid).value;
		var action = "disenrol_user";

        var formdata = new FormData();
        formdata.append('action',action);
        formdata.append('user_role_id',userroleid);
        formdata.append('role_status',role_status);
        formdata.append('batch_course_id',batch_course_id);

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
                
                // alert(obj.responseText);
                
            document.getElementById('msg'+userroleid).innerHTML = obj.responseText;
            

            }
        }


        

        
        obj.open("POST","enrolment_process.php");
        obj.send(formdata);	
      }


      </script>
     	


     
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>


