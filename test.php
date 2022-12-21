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
        $query = "SELECT * FROM `user_role_batch_course_enrollment` WHERE `batch_course_id` = '$batch_course_id' AND `user_role_id` = '$user_role_id'";
        $result  = $database->execute_query($query);

        if($result->num_rows)
        {
            ?>
            <div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
				  <strong>User is Already Enroled</strong> 
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
            <?php
        }
        else
        {
       		$check_query = "SELECT * FROM `user_role_batch_course_enrollment`" ;

       		$check_result = $database->execute_query($check_query);

       		if ($check_result->num_rows) 
       		{
       			$rec = mysqli_fetch_assoc($check_result);

       			if ($rec['batch_course_id'] != $batch_course_id && $rec['user_role_id'] != $user_role_id) 
       			{
       				$check_roll = "SELECT * FROM USER_ROLE , ROLES WHERE USER_ROLE.role_id = ROLES.role_id AND USER_ROLE.user_role_id = '".$user_role_id
       				."'";

       				
       				$check_roll_result = $database->execute_query($query);



       				while ($chek_roles = mysqli_fetch_assoc($check_roll_result)) 
       				{
       					if ($check_roles['role_id'] == 3 && $rec['batch_course_id'] != $rec['batch_course_id'] ) 
       					{
						?>
		        		<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						  <strong> User Enrolled In Other Batch</strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
		        		<?php
       				    }
       				}

       				
       				$insert = "INSERT INTO `user_role_batch_course_enrollment` (`user_role_id`,`batch_course_id`,`status_id`,`created_at`) VALUES ($user_role_id,$batch_course_id,1,'".$time."')";

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
		        	else
		        	{
		        		?>
		        		<div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
						  <strong>Enrolmment Was Unsuccessfull</strong> 
						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>

		        		<?php
		        	}	
       			}


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

        	// Starting of Enrolling User in Batch
        	
        }

        

        
        

        }


	############## SHOW USERS PORCESS ENDS HERE ######################################	
		
		

?>