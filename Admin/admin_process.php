<?php 

	session_start();
	
	require("../require/database.php");
	$database = new database();
	require("../general/php_mailer.php");

	
	########### USER REGISTERATION PROCESS ############################################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'user_registeration' ) 
	{

		extract($_POST);
		$file = isset($_FILES['profile_image'])?$_FILES['profile_image']:'';
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
	    $query = "INSERT INTO USERS (status_id,first_name,last_name,gender,email,password,image,is_approve,created_at) 
	    VALUES (

	    			'".$account_status."',
	    			'".$firstname."',
	    			'".$lastname."',
	    			'".$gender."',
	    			'".$email."',
	    			'".$password."',
	    			'".$path."',
	    			'Approved',
	    			'".$time."'

				)";
		
		$result = $database->execute_query($query);
		if ($result) 
		{

			########## ROLE ASSIGN QUERY #####################
			$last_user_id = mysqli_insert_id($database->connection);
			$role_assign_query = "INSERT INTO USER_ROLE(user_id,role_id,status_id,created_at) VALUES ('".$last_user_id."','".$user_role."','1','".$time."')";
			$role_assign_result = $database->execute_query($role_assign_query);
			if ($role_assign_result) 
			{	

				$message = "<div class='alert alert-success' role='alert'>";
				$message .= "<h2 class='alert-heading'>".$firstname.' '.$lastname."</h2>";
			 	$message .= "<h3>This is Automatic Generated Email Your Account is Registered</h3>";	
			  	$message .= '<p><b>Your Email</b> '.$email.'</p>';
			  	$message .= '<p><b>Your Password</b> '.$password.' </p>';
			  	$message .= "</div>";
			  	
			  	
			  	
			  email::sendmail($email,"Account Registeration",$message);
			  echo "New User Added Credentials Information Sent to User";
			}
			else
			{
				echo "Registeration Failed";
			}
			#### ROLE ASSIGNAION ENDS HERE ######################
		}
		else
		{
			echo "user cant be registered";
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


	########### USER ACCOUNT STATUS PROCESS  #######################################



	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "activeinactiveuser") 
	{
		extract($_POST);
		date_default_timezone_set("Asia/Karachi");
	   	$time = date("Y-m-d H:i:s");
		$query = "UPDATE USERS SET status_id='".$user_account_status."',  updated_at = '".$time."' WHERE user_id='".$_REQUEST['user_id'] ."'";

		

		$result =  $database->execute_query($query);

		if ($result) 
		{

		$selectquery = "SELECT * FROM USERS WHERE user_id = '".$_REQUEST['user_id']."'";
		
		$result2 = $database->execute_query($selectquery);

		$rec = mysqli_fetch_assoc($result2);
			
		if($rec['status_id'] == 1) 
		{	
			$message = "<div class='alert alert-success' role='alert'>";
			$message .= "<h3>This is To Inform You That Your Account is Activated By You Can Now Login to Learning Management System HiST </h3>";	
			$message .= "</div>";	
			email::sendmail($rec["email"],"<h2>HiST JAMSHORO</h2>",$message);
			echo " USER-ID : $user_id Account is Activated";
	
		}
		else if($rec['status_id'] == 2) 
		{
			$message = "<div class='alert alert-success' role='alert'>";
			$message .= "<h3>This is To Inform You That Your Account is Suspended By Management For Further Queries Visit HiST Jamashoro</h3>";	
			$message .= "</div>";	
			email::sendmail($rec["email"],"<h2>HiST JAMSHORO</h2>",$message);
			echo " USER-ID : $user_id Account is Deactivated";
		}
		}
	}
	########### USER ACCOUNT STATUS PROCESS ENDS HERE #######################################



	########### USER ACCOUNT REQUEST PROCESS START HERE ##################################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "user_request") 
	{
		extract($_POST);

		$user_role_id = $_SESSION['user']['user_role_id'];

		date_default_timezone_set("Asia/Karachi");
	   	$time = date("Y-m-d H:i:s");
		$query = "UPDATE USERS SET  is_approve='".$request."' , approved_by = '".$user_role_id."' ,updated_at = '".$time."' WHERE user_id='".$user_id."'";
		
		$result =  $database->execute_query($query);

		$selectquery = "SELECT * FROM USERS WHERE user_id = '".$user_id."'";
		
		$result2 = $database->execute_query($selectquery);

		$rec = mysqli_fetch_assoc($result2);

		if ($result) 
		{
			
		if($request == "Approved") 
		{	
			$message = "<div class='alert alert-success' role='alert'>";
			$message .= "<h2>This is To Inform You That Your Account Request was Approved By Administration You Will Be Notified When The Administration Will Activate Your Account </h2>";	
			$message .= "<h3>Hidaya Institute Of Science & Technology</h3>";	
			$message .= "</div>";	
			email::sendmail($rec["email"],"<h2>HiST JAMSHORO</h2>",$message);
			echo " USER-ID : $user_id Account Request is Approved";
			
		}
		else if($request == "Rejected") 
		{
			$message = "<div class='alert alert-success' role='alert'>";
			$message .= "<h2>This is To Inform You That Your Account Request was Rejected By Administration You Will Be Notified When The Administration Will Further Process On Your Account Feel Free to Visit HiST Jamshoro for Any Queries During Office Hours</h2>";	
			$message .= "<h3>Hidaya Institute Of Science & Technology</h3>";
			$message .= "</div>";	
			email::sendmail($rec["email"],"HiST JAMSHORO",$message);
			echo " USER-ID : $user_id Account Request Is Rejected";
		}
		}
	}


	########### USER ACCOUNT REQUEST PROCESS END HERE ##################################




	############## SHOW USERS PORCESS #############################################W##

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "showuser") 
	{	
		 ############### QUERY FOR FETCHING DATA OF USERS ###########################
        $query = "SELECT * FROM USERS u , STATUS s WHERE u.`status_id` = s.`status_id` AND u.`user_id` <> ".$_SESSION["user"]["user_id"];


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
           <p class="badge bg-success">Active</p>
           <?php
        }
        elseif ($rec['status_id'] == 2) 
        {
            ?>
            <p class="badge bg-danger">InActive</p>
            <?php
         } ?></td>   
        <td id="user_role_type">
                
            <?php 

        ######## QUERY FOR CHECKING USER ROLES ##############

        $role_query = "SELECT * FROM USERS u,USER_ROLE ur,ROLES r WHERE u.user_id = ur.user_id AND ur.status_id = '1' AND ur.role_id = r.`role_id` AND u.user_id = '".$rec['user_id']."'";
        
        $role = $database->execute_query($role_query);
        $roles = array();
        while($check_role = mysqli_fetch_assoc($role))
        {
                $roles[] = $check_role['role_id'];
               
                echo "<p class='badge bg-secondary'>".$check_role['role_type']."</p>"."<br>" ;
                
            
        }

        ?>         
                


        </td>       
        	<td >
                <?php   
                    if ($rec['status_id'] == 2) 
                    {
                    	$status = 1;
                        ?>
                         <button class="btn btn-success" onclick="active_inactive_user(<?php echo $rec['user_id'];
                          ?>, <?php echo $status; ?> )">Active</button>
                        <?php  
                    }
                    else 
                    {	
                    	$status = 2; 
                        ?>
                         <button class="btn btn-danger" onclick="active_inactive_user(<?php echo $rec['user_id'];
                          ?>, <?php echo $status; ?> )">InActive</button>
                        <?php
                    }
                 ?>       
            </td>
        </tr>
                            <?php
                            
        	}
        	?>

        	<?php
            
	}

}


	############## SHOW USERS PORCESS ENDS HERE ######################################





   ############ SHOW USERS MANAGE USER ROLE  PORCESS ###############################################

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_user_manage_user") 
	{
		$query = "SELECT   USERS.user_id , USERS.first_name,USERS.last_name , USERS.email , USERS.image , USERS.status_id , ROLES.role_type FROM USERS,USER_ROLE,ROLES WHERE USER_ROLE.user_id = USERS.user_id AND USER_ROLE.role_id = ROLES.role_id AND USERS.status_id BETWEEN 1 AND 2 AND USERS.user_id <> ".$_SESSION["user"]["user_id"];

               
        $result = $database->execute_query($query);

        if ($result->num_rows) 
        {

        	while ($rec = mysqli_fetch_assoc($result)) 
        	{
        		?>
            <tr>
                                
                                <td><img src="<?php echo $rec['image'] ?>" style="width: 70px; height:50px;"></td>
                                
                                <td><?php echo $rec['first_name']." ".$rec['last_name'] ?></td>
                                <td><?php echo $rec['email'] ?></td>   
                                <td><?php echo $rec['role_type'
                                ] ?></td>   
                                <td><?php  if ($rec['status_id'] == 1) 
                                {
                                	?>
                                	<p class="bg-success text-light p-3">Active</p>
                                	<?php
                                }
                                elseif ($rec['status_id'] == 2) 
                                {
                                	?>
                                	<p class="bg-success text-light p-3">InActive</p>
                                	<?php
                                 } ?></td>
                                
                   
                                <td>


<!-- Modal -->


								</td>
							</tr>
									
                            <?php
        	}
            
	}

	}


	############## SHOW USERS PORCESS MANAGE USER ROLE PAGE ENDS HERE ######################################
	

	########## ASSIGN ROLE PROCESS #################################################
	

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "assign_role") 
	{
		// print_r($_POST);
		// die;
		extract($_POST);
		

		date_default_timezone_set("Asia/Karachi");
	   	$time = date("Y-m-d H:i:s");

		$selectquery = "SELECT * FROM user_role where  user_id = '".$user_id."' AND role_id = '".$role_id."' ";

		$result = $database->execute_query($selectquery);
		if ($result->num_rows) 
		{
			
			echo "Role Is Already Assigned To User And Role is Deactivated By Administration";
			
		}
		else
		{

			$query = "INSERT INTO USER_ROLE (user_id,role_id,status_id,created_at) VALUES('".$user_id."','".$role_id."','1','".$time."')";

				$result = $database->execute_query($query);
				// $rec = mysqli_fetch_assoc($result);
				if ($result) 
				{
					echo "Role Assigned Successfully";
				}
				else
				{
					echo "Role Assignation Failed";
				}
		}


			
		
		


		

	}
		


	########## ASSIGN ROLE PROCESS ENDS HERE #######################################


	########## CHANGE ROLE PROCESS #################################################
	

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "role_status") 
	{
		extract($_POST);
		
		date_default_timezone_set("Asia/Karachi");
	   	$time = date("Y-m-d H:i:s");

		$query = "UPDATE user_role set status_id = '2' , updated_at = '".$time."' where role_id = '".$role_id."' AND  user_id = ".$user_id ;

		

		$result = $database->execute_query($query);
		if ($result) 
		{
			
				echo "Role Is Deactivated";
		}
		


		

	}
		


	########## CHANGE ROLE PROCESS ENDS HERE #######################################



	########## CHANGE ROLE PROCESS #################################################
	

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == "role_status_active") 
	{
		extract($_POST);
		
		date_default_timezone_set("Asia/Karachi");
	   	$time = date("Y-m-d H:i:s");

		$query = "UPDATE user_role set status_id = '1' , updated_at = '".$time."' where role_id = '".$role_id."' AND  user_id = ".$user_id ;

		

		$result = $database->execute_query($query);
		if ($result) 
		{
			
				echo "Role Is Activated";
		}
		


		

	}
		


	########## CHANGE ROLE PROCESS ENDS HERE #######################################







?>