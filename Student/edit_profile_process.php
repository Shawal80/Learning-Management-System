<?php 
	
    
    require("../general/session_maintenance.php");
	require("../require/header_footer.php");
    header_footer::header("../general/logout.php");
    $database = new database();



 ?>
 <!-- MAIN CONTENT STARS HERE -->
 <div class="container-fluid" style="background-color:#5189B8;">

 	<div class="row">

 				<div class="col-sm-2">
 					
 				</div>

 				<div class="col-sm-8  m-4">

 				<?php 	 
 				
 					$query = "SELECT * FROM USERS WHERE USER_ID =".$_REQUEST['user_id'];

 					$result = $database->execute_query($query);	

 					$rec = mysqli_fetch_assoc($result);
 				?>		


 					 <form class="border border-secondary rounded p-3" method ="POST" enctype="multipart/form-data" action="#">
              	<div class="row">
              		<div class="col-sm-12">
              				<h2 class="text-center text-light">UPDATE PROFILE</h2>
              				<hr>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">First Name</label>
		                  <input type="text" class="form-control" name="firstname"  required value="<?php echo $rec['first_name'] ?>">
		                  
		                </div>
              		</div>
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Last Name</label>
		                  <input type="text" class="form-control" name="lastname" required
		                  value="<?php echo $rec['last_name'] ?>">
		                </div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  
		                  <label class="text-light">Password</label>
		                  <input type="password" class="form-control" name="password" value="<?php echo $rec['password'] ?>" required>
		                </div>
              		</div>
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Hometown</label>
		                  <input type="text" class="form-control" name="hometown" value="<?php echo $rec['home_town'] ?>" required>
		                </div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Date Of Birth</label>
		                  <input type="date" class="form-control"  value="<?php echo $rec['date_of_birth'] ?>" name="dateofbirth" required>
		                </div>
              		</div>
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Profile Image</label>
		                  <input type="file" class="form-control"  accept=".png,.jpg,.jpeg,.bmp,." name="profile_image" >
		                </div>
              		</div>
              	</div>
              	
              	<hr>	
                <center>  
                <input type="submit" name="update_profile" value="Update Profile" class="btn btn-light">
                </center>

                
              	</div>
              </form>
 				</div>

 				<div class="col-sm-2">
 					
 				</div>
 		
 	</div>
 	                    
 </div>

 <!-- MAIN CONTENT ENDS HERE -->

 <!-- FOOTER REQUIRED FILE -->
 <?php header_footer::footer("../index.php") ?>
 <!-- #################### -->

      

     


     
  </body>
</html>



<?php 	 
		
		if (isset($_REQUEST['update_profile'])) 
		{
			print_r($_POST);
		}

		

?>