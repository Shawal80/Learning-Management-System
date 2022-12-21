<?php 
	session_start(); 
	require("php_mailer.php");
	require("../require/database.php");
	$database = new database();

	########### USER REGISTERATION PROCESS ############################################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'user_registeration' ) 
	{

		extract($_POST);

		if (isset($_FILES['profile_image'])) 
		{
			$file = $_FILES['profile_image'];
			$dir = '../images/profile images';
		    if (!is_dir($dir)) 
		    {
		        mkdir($dir);
		    }
			$rand = rand();
		    move_uploaded_file($file['tmp_name'],$dir."/".$rand.$file['name']);
		    $path = $dir."/".$rand.$file['name'];
		}
		
	    if (!isset($path)) 
	    {
	     	$path = "../images/profile images/dummy.png";
	    } 
	    
	   	date_default_timezone_set("Asia/Karachi");
	   	$time = date("Y-m-d H:i:s");
	    $query = "INSERT INTO USERS (status_id,first_name,last_name,gender,email,password,home_town,date_of_birth,image,created_at) 
	    VALUES (

	    			'2',
	    			'".$firstname."',
	    			'".$lastname."',
	    			'".$gender."',
	    			'".$email."',
	    			'". $password."',
	    			'".$hometown."',
	    			'".htmlspecialchars($dateofbirth,true)."',
	    			'".$path."',
	    			'".$time."'

				)";
					
		$result = $database->execute_query($query);
		if ($result) 
		{

			########## ROLE ASSIGN QUERY #####################
			$last_user_id = mysqli_insert_id($database->connection);
			$role_assign_query = "INSERT INTO USER_ROLE(user_id,role_id,status_id,created_at) VALUES ('".$last_user_id."','3','1','".$time."')";
			$role_assign_result = $database->execute_query($role_assign_query);
			if ($role_assign_result) 
			{
				?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
				  <strong>Account Registeration </strong> Process is Completed you Will Be Notified When Administration Will Approve Your Account
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>

				<?php
			}
			else
			{
				echo "Registeration Failed";
			}
			#### ROLE ASSIGNAION ENDS HERE ######################
		}
		else
		{
			?>
				<div class="alert alert-primary alert-dismissible fade show" role="alert">
				  <strong>Form Fields Are Required</strong>
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>

				<?php
		}
		

				

	}

	########### USER REGISTERATION PROCESS ENDS HERE #######################################
	

	################ CHECK EMAIL IF ALREADY EXISTS FUNCTION STARTS HERE ###################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "check_email")
	{
		extract($_REQUEST);

		$query =  "SELECT * FROM USERS WHERE email= '".$email."' " ;

		$result = $database->execute_query($query);

		if ($result->num_rows) 
		{
			echo "email_exists";
			



		}
		else
		{
			echo "false";
			
		}
		
	}

	################ CHECK EMAIL IF ALREADY EXISTS FUNCTION ENDS HERE #####################


	############### USER LOGIN PROCESS STARTS HERE ################################

	if (isset($_REQUEST['login_btn'])) 
	{
		
		extract($_POST);


		$query = "SELECT * FROM USERS WHERE email = '".$email."' AND password = '".$password."'";

		
		$result = $database->execute_query($query);



		
		
		if ($result->num_rows) 
		{
			$rec = mysqli_fetch_assoc($result);
			

			

			if ($rec['is_approve'] == "Approved") 
			{
				if ($rec['status_id'] == "1") 
				{

					// ########## QUERY TO CHECK USER ROLES AND SET ROLE PRIORITY FOR REDIRECTION AFTER LOGIN ###########

					$selectquery = "SELECT * FROM USERS u,USER_ROLE ur , roles r WHERE u.user_id = ur.user_id AND r.role_id = ur.role_id AND u.user_id = '".$rec['user_id']."' AND ur.status_id = 1 ORDER BY r.role_id ASC LIMIT 1";
		

					$result2 = $database->execute_query($selectquery);

					$rec2 = mysqli_fetch_assoc($result2);

					$_SESSION['user'] = $rec2 ;
					// ########## QUERY TO CHECK USER ROLES AND SET ROLE PRIORITY FOR REDIRECTION AFTER LOGIN ###########

					// ##################  CONDITIONS TO CHECK ROLE ####################################################
					
					if ($rec2['role_id'] == '1') 
					{
						header("location:../Admin/index.php");
					}
					else if ($rec2['role_id'] == '2') 
					{
						header("location:../Teacher/index.php");
					}
					else if ($rec2['role_id'] == '3') 
					{
						header("location:../Student/index.php");
					}
					// ##################  CONDITIONS TO CHECK ROLE ####################################################
				}
				else
				{
					header("location:login.php?message=Your Account Is Approved But Not Activated Yet");
				}
			}
			else
			{
				header("location:login.php?message=Your Account Activation Request Is Not Approved Yet");
			}

		}
		else 
		{
			
			header("location:login.php?message=Invalid Email/Password");
		}
		
	}

	############### USER LOGIN PROCESS ENDS HERE ##################################


	################# FORGOT_PASSWORD PROCESS STARTS HERE ########################

	if (isset($_REQUEST['action'])  && $_REQUEST['action'] == "forgot_password") 
	{
		extract($_POST);

		$query = "SELECT * FROM USERS WHERE email = '".$email."'";
		
		$result = $database->execute_query($query);
		
		if ($result->num_rows) 
		{

			$rec = mysqli_fetch_assoc($result);
			
			
				$message = "<div class='alert alert-success' role='alert'>";
			 	$message .= "<h2>HIST JAMSHORO</h2>";	
				$message .= "<h3 class='alert-heading'>".$rec['first_name'].' '.$rec['last_name']."</h3>";
			  	$message .= '<p><b>Your Password is</b> '.$rec['password'].' </p>';
			  	$message .= "</div>";
				email::sendmail($rec["email"],"Account Credentials",$message);
				echo "1";
			

		}
		else  
			{
				echo "0";
			}	
		
	}

	############### FORGOT PASSWORD PROCESS ENDS HERE ###########################
?>