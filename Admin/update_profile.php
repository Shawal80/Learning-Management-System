<?php

	require("../general/session_maintenance.php");	 	 
	require("../require/database.php");
    $database = new database();

		if (isset($_REQUEST['update_profile'])) 
		{
		
		extract($_POST);
		$file = $_FILES['profile_image'];
	    $dir = '../images/profile images';
	    if (!is_dir($dir)) 
	    {
	        mkdir($dir);
	    }
	    $rand = rand();
	    move_uploaded_file($file['tmp_name'],$dir."/".$rand.$file['name']);
	    $path = $dir."/".$rand.$file['name'];
	   	date_default_timezone_set("Asia/Karachi");
	   	$time = date("Y-m-d H:i:s");
	    $query = "UPDATE USERS SET first_name = '".$firstname."' , last_name = '".$lastname."' , password ='".$password."' , home_town = '".$hometown."' , date_of_birth = '".$dateofbirth."' , image = '".$path."', updated_at = '".$time."' WHERE USER_ID = '".$_SESSION['user']['user_id']."' ";

	    // die($query);
					
		$result = $database->execute_query($query);
		if ($result) 
		{

			
				header("location:edit_profile_process.php?msg=Profile Updated Succesfully");
			
			
		
		}
		}
		


?>