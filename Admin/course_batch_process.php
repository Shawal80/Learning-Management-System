<?php  

	session_start();
	
	require("../require/database.php");
	$database = new database();
	require("../general/php_mailer.php");


	date_default_timezone_set("Asia/Karachi");
	$time = date("Y-m-d H:i:s");

	########################### ADD COURSE PROCESS STARTS HERE ##########################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "add_course") 
	{
		extract($_POST);

		$query = "INSERT INTO COURSES (status_id,course_title,course_description,created_at) VALUES ('".$course_status_id."','".$course_title."','".$course_description."','".$time."')";

		$result = $database->execute_query($query);

		if ($result) 
		{
			?>
				
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong><?php echo $course_title ?></strong> Course Registered Succesfully.
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
		}
	}

	###################### ADD COURSE PROCESS ENDS HERE ###############################

	########################### EDIT COURSE PROCESS STARTS HERE ##########################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_course") 
	{
		extract($_POST);
		

		$query = "UPDATE COURSES SET course_title ='".$course_title."' , course_description = '".$course_description."' , status_id = '".$course_status_id."' WHERE course_id = '".$course_id."'";

		$result = $database->execute_query($query);

		if ($result) 
		{
			?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong><?php echo $course_title ?></strong> Course Updated Succesfully.
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
			
		}
	}

	###################### EDIT COURSE PROCESS ENDS HERE ###############################


	###################### SPECIFIC COURSE DATA FOR UPDATE PROCESS ###################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_course") 
	{
		extract($_POST);
		$selectquery = "SELECT * FROM COURSES WHERE course_id = '".$course_id."'";

        $courseresult = $database->execute_query($selectquery);

        $course = mysqli_fetch_assoc($courseresult);

        
        echo str_replace(",", '',$course['course_title']).",";
        echo str_replace(",", '',$course['course_description']).",";
        echo $course['course_id'];

	}



	###################### SPECIFIC COURSE DATA FOR UPDATE PROCESS ENDS HERE ###################



	########################### ADD BATCH PROCESS STARTS HERE ##########################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "add_batch") 
	{
		extract($_POST);

		$query = "INSERT INTO BATCHES (status_id,batch_title,batch_description,batch_start_date,batch_end_date,created_at) VALUES ('".$batch_status_id."','".$batch_title."','".$batch_description."','".$batch_start_date."','".$batch_end_date."','".$time."')";

		$result = $database->execute_query($query);

		if ($result) 
		{
			echo "Batch Added Succesfully";
		}
	}

	###################### ADD BATCH PROCESS ENDS HERE ###############################


	###################### SPECIFIC BATCH DATA FOR UPDATE PROCESS ###################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_batch") 
	{
		extract($_POST);
		$query = "SELECT * FROM BATCHES WHERE batch_id = '".$batch_id."'";

        $result = $database->execute_query($query);

        $rec = mysqli_fetch_assoc($result);

        
        echo str_replace(",", '',$rec['batch_title']).",";
        echo str_replace(",", '',$rec['batch_description']).",";
        echo str_replace(",", '',$rec['batch_start_date']).",";
        echo str_replace(",", '',$rec['batch_end_date']).",";
        echo $rec['batch_id'];

	}



	###################### SPECIFIC BATCH DATA FOR UPDATE PROCESS ENDS HERE ###################


	########################### EDIT BATCH PROCESS STARTS HERE ##########################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_batch") 
	{
		extract($_POST);
		

		$query = "UPDATE BATCHES SET batch_title ='".$batch_title."' , batch_description = '".$batch_description."' , status_id = '".$batch_status_id."' , batch_start_date = '".$batch_start_date."' , batch_end_date = '".$batch_end_date."' , updated_at = '".$time."' WHERE batch_id = '".$batch_id."'";

		$result = $database->execute_query($query);

		if ($result) 
		{
			echo "$batch_title Batch Updated Succesfully";
		}
	}

	###################### EDIT BATCH PROCESS ENDS HERE ###############################


	###################### ASSIGN COURSE TO BATCH PROCESS STARTS HERE #################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "assign_course") 
	{
		extract($_POST);
		$query = "INSERT INTO BATCH_COURSE(batch_id,course_id,status_id,number_of_topics,created_at) VALUES ('".$batch_id."','".$course_id."','".$status_id."','".$number_of_topics."','".$time."')";
		$result = $database->execute_query($query);

		

		if ($result) 
		{
			?>
			<div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
			  <strong> Course Assigned To Batch Successfully. </strong>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  
			</div>

			<?php
			
		}

	}



	###################### ASSIGN COURSE TO BATCH PROCESS ENDS HERE ##################




	###################### ADD TOPIC PROCESS STARTS HERE #################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "add_topic") 
	{
		extract($_POST);
		$query = "INSERT INTO topics (status_id,topic_title,topic_description,created_at) VALUES ('".$topic_status_id."','".$topic_title."','".$topic_description."','".$time."')";


		$result = $database->execute_query($query);

		

		if ($result) 
		{
			?>
			<div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
			  <strong> New Topic Added Successfully. </strong>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  
			</div>

			<?php
			
		}

	}



	###################### ADD TOPIC PROCESS ENDS HERE ##################


	#################### SET TOPIC PRIORITY PROCESS START HERE #########

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "topic_priority")
	{
		extract($_POST);
		// print_r($_POST);
		// echo "BEFORE ARRAY CONVERSION";
		$topic_priority = explode(',',$topic_priority);
		$topic_id = explode(',',$topic_id);
		// echo "<pre>";
		// print_r($_REQUEST);

		// echo "<pre>";
		// print_r($topic_id);
		// echo "</pre>";
		// die;
		// print_r($topic_id);
		$loopcount = count($topic_id);

		// echo $loopcount;
		// die($loopcount);

		// print_r($topic_priority);
		// print_r($topic_id);
		// die;

		$flag = null;
		$else = "";
		for ($i=0; $i <= $loopcount - 1; $i++) 
		{
			// echo $i."value of i";
			// die;
			for ($j=0; $j <= $i ; $j++) 
			{ 
				// echo $i."value of i inside nested loop ";
				// echo "value of j".$j;
				/*
					CSS == CSS
					CSS ==OOP
				*/
				if ($topic_id[$i] != $topic_id[$j] && $topic_priority[$i] != $topic_priority[$j]) 
				{
				// 	echo "value of i inside nested loop = $i";
				// echo "value of j=".$j;
				$flag = true;
				break ;

					
						
				}
				else
				{
					$flag = false ;
					$else = "Topic And Priority Must Be Unique";
				}
			}
		}
			if($flag) 
			{
				foreach($topic_id as $key => $value)
				{
					$query = "INSERT INTO BATCH_COURSE_TOPIC (batch_course_id,topic_id,status_id,topic_priority,created_at) VALUES ('".$batch_course_id."','".$value."',1,'".$topic_priority[$key]."','".$time."') ";
					$result = $database->execute_query($query);
				}

					// echo "$query";
		
			}

		
		
		

		if (isset($result)) 
		{
			echo "Topic Priority Settings Applied Succesfully";
		}
		else if ($flag == false) 
		{
			echo $else ;
		}
		
			

		
	}



	#################### SET TOPIC PRIORITY PROCESS ENDS  HERE #########


	################### SET BATCH COURSE STATUS PROCESS STARTS HERE #####
	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "batch_course_status") 
	{
		extract($_POST);



		$query = "UPDATE batch_course SET status_id = '".$batch_course_status_id."' , updated_at = '".$time."' WHERE batch_course_id = '".$batch_course_id."'";

		
		$result = $database->execute_query($query);

		if ($result) 
		{
			?>
			<div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
			  <strong> Batch Course Status Updated Successfully. </strong>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  
			</div>

			<?php
		}

		else
		{
			?>
			<div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
			  <strong> Batch Cant be Updated </strong>
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  
			</div>

			<?php
		}
	}
	################### SET BATCH COURSE STATUS PROCESS ENDS HERE   #####



	
?>