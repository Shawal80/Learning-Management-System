<?php 	 
		
	session_start();
	
	require("../require/database.php");
	$database = new database();
	require("../general/php_mailer.php");	
	date_default_timezone_set("Asia/Karachi");
	$time = date("Y-m-d H:i:s");	

	############## SHOW USERS PORCESS #############################################W##

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "enrol_user") 
	{	
        ############### QUERY TO CHECK  USERS ALREADY ENROLLED OR NOT ################

        extract($_POST);
        // print_r($_POST);
        // die;
		$check_query  = " SELECT * FROM user_role WHERE user_role_id = '".$user_role_id."' ";
	

       	$check_result = $database->execute_query($check_query);

       	if($check_result->num_rows)
       	{
       		$record = mysqli_fetch_assoc($check_result);
       		if($record['role_id']==3)
       		{
       			$check_query  = "SELECT COUNT(u.`user_id`) 'Flag' FROM users u
					INNER JOIN user_role ur
					ON u.`user_id` = ur.`user_id`
					INNER JOIN roles r
					ON r.`role_id` = ur.`role_id` AND ur.`user_role_id` = '".$user_role_id."'
					INNER JOIN `user_role_batch_course_enrollment` e
					ON e.`user_role_id` = ur.`user_role_id`
					WHERE r.`role_id` = 3 AND e.`status_id` = 5";
       			$check_result = $database->execute_query($check_query);
       			if($check_result->num_rows)
       			{
       				$rec = mysqli_fetch_assoc($check_result);
       				if ($rec['Flag'] == 1) 
       				{
       					?>
		        		<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						  <strong> User Is Already Enrolled</strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
		        		<?php	
       				}
       				else
       			{


       				$check_batch_role = "SELECT * FROM user_role_batch_course_enrollment WHERE batch_course_id= '".$batch_course_id."' AND user_role_id = '".$user_role_id."' AND status_id = 5";
       			$check_batch_role_result = $database->execute_query($check_batch_role);

       			if ($check_batch_role_result->num_rows) 
       			{
       				?>
		        		<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						  <strong> Student Already Enrolled In this Batch</strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
		        		<?php
       			}
       			else
       			{
       				
       				$insert = "INSERT INTO `user_role_batch_course_enrollment` (`user_role_id`,`batch_course_id`,`status_id`,`created_at`) VALUES ($user_role_id,$batch_course_id,5,'".$time."')";

		        	$result = $database->execute_query($insert);
		        	if($result)
		        	{
		        		?>
		        		<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						  <strong> User Enrolled  Succesfully </strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
		        		<?php
		        	}	
       			}
       				
		        	
       			
       				
       				
       			}
       				
       			}
       			

       		}
       		else
       		{
       			
       			$check_batch_role = "SELECT * FROM user_role_batch_course_enrollment WHERE batch_course_id= '".$batch_course_id."' AND user_role_id = '".$user_role_id."' AND status_id = 5";
       			$check_batch_role_result = $database->execute_query($check_batch_role);

       			if ($check_batch_role_result->num_rows) 
       			{
       				?>
		        		<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						  <strong> Teacher Already Enrolled In this Batch</strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
		        		<?php
       			}
       			else
       			{
       				$insert = "INSERT INTO `user_role_batch_course_enrollment` (`user_role_id`,`batch_course_id`,`status_id`,`created_at`) VALUES ($user_role_id,$batch_course_id,5,'".$time."')";

		        	$result = $database->execute_query($insert);
		        	if($result)
		        	{
		        		?>
		        		<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						  <strong> Teacher Enrolled  Succesfully </strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
		        		<?php
		        }		
       			}
       			
       		}
       	}

	}


	############## SHOW USERS PORCESS ENDS HERE #######################


	########### DIS ENROL USER PROCESS STARTS HERE #####
	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'disenrol_user') 
	{
		extract($_POST);
		$query = "UPDATE user_role_batch_course_enrollment set status_id = '$role_status' , updated_at = '".$time."' WHERE user_role_id = '$user_role_id' AND batch_course_id = '".$batch_course_id."'";


		$result = $database->execute_query($query);

		if ($result) 
		{
			?>
			<div class="alert alert-info m-3" role="alert">
			  User Role Status Succesfully
			</div>

			<?php
		}
		else
		{
			?>
			<div class="alert alert-warning m-3" role="alert">
			  User Role Status Change Failure
			</div>

			<?php	
		}
		
	}		
	########### DIS ENROL USER PROCESS ENDS  HERE #####		
		

?>