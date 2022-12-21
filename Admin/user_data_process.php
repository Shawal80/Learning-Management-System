<?php  

	require("../require/database.php");
	$database = new database();
		

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'wordfile') 
	{
		header("Content-Type: application/vnd-ms-word");
		header("Content-Disposition: attachment; filename=user_record.doc");
		header("Cache-Control: no-cache, no-store, must-revalidate");
		header("Pragma:no-cache");
		header("Expires:0");

		$query = "SELECT * FROM USERS";
		$result = $database->execute_query($query);

		if ($result->num_rows) 
		{
			$rec = mysqli_fetch_assoc($result);
			?>
			<h1 style="text-align: center;">Hidaya Institute Of Sceince And Technology Jamshoro (HIST)</h1>
			<hr>
			<table  cellpadding="10px" cellspacing="5px" style="width:100%; text-align:center">

	        <thead>

	        <tr>
	        <th>Name</th>
	        <th>Email</th>
	        <th>Account Status</th>
	        <th>Active Role</th>
	        
	       
	        </tr>
	        </thead>

	        
	        <tbody>
	        <?php
	    while ($rec = mysqli_fetch_assoc($result)) 
        {
        	?>

        	<tr>
        		<td><?php echo ucwords($rec['first_name'])." ".ucwords($rec['last_name'])  ?></td>
        		<td><?php echo $rec['email'] ?></td>
        		<td><?php if ($rec['status_id'] == 1) 
        		{
        			echo "Active";
        		}
        		else
        		{
        			echo "In-Active";
        		}
        		?></td>
        		<td>
        				
        			<?php  

        			$selectquery = "SELECT
									  *
									FROM
									  USER_ROLE,
									  ROLES
									WHERE USER_ROLE.STATUS_ID = 1
									  AND USER_ID = '".$rec['user_id']."' AND ROLES.role_id = USER_ROLE.role_id";
        			$result2 = $database->execute_query($selectquery);

        			while ($roles = mysqli_fetch_assoc($result2)) 
        			{
        				echo $roles['role_type'];
        			}

        			?>

        		</td>
        		
        	</tr>


        	<?php 
            
		}
		?>

		</tbody>
	</table>

		<?php
		}


	}

	########### USER_BATCH_ENROLMENT_DATA ##############

	if (isset($_REQUEST['action']) &&  $_REQUEST['action'] == 'user_enrolment_data' ) 
	{
		 
		 extract($_REQUEST);
			header("Content-Type: application/vnd-ms-word");
		header("Content-Disposition: attachment; filename=user_record.doc");
		header("Cache-Control: no-cache, no-store, must-revalidate");
		header("Pragma:no-cache");
		header("Expires:0");		


				$query = "SELECT * FROM user_role_batch_course_enrollment WHERE batch_course_id =  '".$_REQUEST['batchcourseid']."' AND status_id IN (5 , 6)";

				
               
               $result = $database->execute_query($query);

                if ($result) 
                {
                	$number = 1;
                	?>
               <h1 style="text-align: center;">Hidaya Institute Of Sceince And Technology Jamshoro (HIST)</h1>
               <h3 style="text-align:center">BATCH : <?php echo $_REQUEST['batchtitle'] ?></h3>
               <hr>
        	 <table  id="example" style="width:100%; text-align:center">

			        <thead>
			        	
			        <tr>
			        	<th>S.No</th>
			        	<th>NAME</th>	
			        	<th>ROLE</th>	
			        	<th>ROLE STATUS</th>	
			        	
			       	
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
				  		<td><?php echo $number ; ?></td>
		        		<td><?php echo $users['first_name']." " .$users['last_name'] ?></td>
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
		        		
				        		</tr>

				  	<?php
				  	$number++;
				  }

        		 ?>

       <?php
}
?>


					        </tbody>
					        </table>

                    <?php
                    
                   
                      






                }


			 
	}



	########### USER_BATCH_ENROLMENT_DATA ##############

	
	

	
	
	
	
?>