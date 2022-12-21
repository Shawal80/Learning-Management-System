<?php 
	
	require("../general/session_maintenance.php");
	require("../require/header_footer.php");
	header_footer::header("../general/logout.php");
	$database = new database();

 ?>
 <!-- MAIN CONTENT STARS HERE -->
 <div class="container-fluid">
 	<div class="row">
      <div class="col-sm-12 " style="background-color:#5189B8;">
            <div style="padding: 70px;">   
            <h1 class=" text-light"><?php echo "<b>".strtoupper($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'])."</b>"??"" ?><sup class="text-warning" style="font-size:25px">(Teacher)</sup></h1>
            </div>
      </div>
    </div>
    <div class="row m-3">
    	<div class="col-sm-3">
    		
	      <div class="card border-primary" style="max-width: auto">
		      <div class="card-header bg-primary text-light">NAVIGATION</div>
		      <div class="card-body">
		      <p><a href="index.php" class="text-decoration-none text-dark" >  View Courses</a></p>
		      <p><a href="view_users.php" class="text-decoration-none text-dark" style="font-size: 20px;">&#10140;View Users</a></p>
		      <p><a href="" class="text-decoration-none text-dark">Manage Course Topics</a></p>
	     	  </div>
	  	  </div>
 		</div>
 		<div class="col-sm-9">
 			<div class="card">
 				<div class="card-header bg-light text-dark "> <b style="font-size:20px">Users </b><a href="view_users.php" class="btn btn-primary" style="font-size: 23px; float: right">	 BACK</a></div>

 				<div class="card-body">
 						<!-- <h2 class="text-center text-dark"><?php //echo  $_REQUEST['batch_title_'] ?></h2> -->

 						<h4 class="text-center"><?php echo strtoupper($_REQUEST['batch_title']); ?></h4>
 			<hr>
 			<?php 
 				
 				// $batch_title = $_REQUEST['batch_title_'];

				$query = "SELECT * FROM user_role_batch_course_enrollment WHERE batch_course_id =  '".$_REQUEST['batch_course_id']."' AND status_id IN (5 , 6)";

				
               
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
 			</div>

 			
 		</div>
 	</div>
 	 <div class="row">
            <div class="col-sm-12 " style="background-color:#5189B8;">
                  <div style="padding: 40px;">   
                  <h2 class="text-center text-light">EDUCATION IS A WEAPON WHICH WE CAN USE TO CHANGE THE WORLD</h2>
                  <p class="text-center text-light">We will open the world of knowledge for you!... We outstrip social needs in education!</p>
                  <center>
                    
                  <a href="https://histpk.org/" class="btn btn-light text-primary">Read More!...</a>
                  </center>
                  </div>
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


   
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

