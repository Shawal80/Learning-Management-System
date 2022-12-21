<?php

	session_start();
	
	require("../require/database.php");
	$database = new database();
	require("../general/php_mailer.php");  
	date_default_timezone_set("Asia/Karachi");
	$time = date("Y-m-d H:i:s");	

	########## CHANGE TOPIC STATUS PROCESS ##################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'topic_status')
	{
		
		extract($_POST);
		$query = "UPDATE TOPICS SET status_id = '".$topic_status_id."' , updated_at = '".$time."' WHERE topic_id = '".$topic_id."'";

		$result = $database->execute_query($query);

		if ($result) 
		{
			if ($topic_status_id == '1') 
			{
				?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
				  <strong>Topic Activated Succesfully</strong>
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>

				<?php
			}
			else
			{
				?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				  <strong>Topic Inactivated Succesfully</strong>
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>

				<?php
			}
		}
	
	}

	######### CHANGE TOPIC STATUS PROCESS ENDS HERE #########

	########## ADD TOPIC FILES PROCESS STARTS HERE #########

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_topic_files') 
	{
		extract($_POST);
		// print_r($_FILES['file']);
		$count = count($_FILES['file']['name']);
		$file_name = [];
		$file_ext = [];
		$file_tmpname = [] ;
		// $file_extension = [];

		######## LOOP TO STORE FILE NAME EXTENSIONS AND PATH #######
		for ($i=0; $i < $count  ; $i++) 
		{ 
			$file_name[] = $_FILES['file']['name'][$i];
			// $file_extension[] = $_FILES['file']['type'][$i];
			$file_tmpname [] = $_FILES['file']['tmp_name'][$i];
	 	    $file_ext[] = explode('.', $_FILES['file']['name'][$i]);
	 	    
		}



		$path = [];
		$dir = '../Topic Files';
	    if (!is_dir($dir)) 
	    {
	        mkdir($dir);
	    }
	    ######### LOOP FOR UPLOADING FILES  ##########
	    for ($j=0; $j < $count ; $j++) 
	    { 
	    	
	    $rand = rand();
	    $file_upload = move_uploaded_file($file_tmpname[$j],$dir."/".$rand.$file_name[$j]);
	    $path [] = $dir."/".$rand.$file_name[$j];

	    }

	    if ($file_upload) 
	    {

	    	for ($k=0; $k < $count ; $k++) 
	    	{ 
		    	$query = "INSERT INTO topic_file(topic_id,status_id,file_name,file_path,file_type,created_at)

		    	VALUES ('".$topic_id."',1,'".$file_name[$k]."' , '".$path[$k]."' , '".$file_ext[$k][1]."' , '".$time."')
		    	";

		    	$result = $database->execute_query($query);

		    	
	    	}
	    	if (isset($result)) 
		    	{
			    	?>
					<div class="alert alert-primary alert-dismissible fade show" role="alert">
					  <strong>Topic File Uploaded Succesfully</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

					<?php
		    	}
	    		else
	    		{
	    			?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Topic File Uploade Failure</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

					<?php
	    		}
	    }


	}


	######### ADD TOPIC PROCESS ENDS HERE ##################

	######### TOPIC FILE STATUS PROCESS STARTS HERE #########

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'topic_file_status') 	
	{
		extract($_POST);

		$query = "UPDATE topic_file set status_id = '".$status_id."' WHERE topic_file_id = '".$topic_file_id."'";

		$result = $database->execute_query($query);

		if ($result)
		{
			if ($status_id == 2) 
			{
				?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Topic File Deactivated Succesfully</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

				<?php
			}
			else
			{
				?>
					<div class="alert alert-primary alert-dismissible fade show" role="alert">
					  <strong>Topic File Activated Succesfully</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

				<?php
			}
		}
	}


	####### TOPIC FILE STATUS PROCESS ENDS HERE ############
	
		
?>