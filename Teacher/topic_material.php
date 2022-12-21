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
            <h1 class=" text-light"><?php echo "<b>".$_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']."</b>"??"" ?><sup class="text-warning" style="font-size:25px">(Teacher)</sup></h1>
            </div>
      </div>
    </div>
    <div class="row m-3">
    	<div class="col-sm-3">
    		
	      <div class="card border-primary" style="max-width: auto">
		      <div class="card-header bg-primary text-light">NAVIGATION</div>
		      <div class="card-body">
		      <p><a href="index.php" class="text-decoration-none text-dark" >  View Courses</a></p>
		      <p><a href="view_users.php" class="text-decoration-none text-dark">View Users</a></p>
		      <p><a href="" class="text-decoration-none text-dark"  style="font-size: 20px;">&#10140;Manage Course Topics</a></p>
	     	  </div>
	  	  </div>
 		</div>
 		<div class="col-sm-9">
 			<div class="card">
 				<div class="card-header bg-light text-dark "> <b style="font-size:20px">Topic Material </b><a href="show_course_topic_material.php?batch_title=<?php echo $_REQUEST['batch_title'] ?>&batch_course_id=<?php echo $_REQUEST['batchcourseid'] ?>" class="btn btn-primary" style="font-size: 23px; float: right">BACK</a></div>

 				<div class="card-body">
 						<h4 class="text-center"><?php echo $_REQUEST['topic_title']; ?></h4>
 						<hr>
 						<div id="topic_file_message">
 							
 						</div>
 				<?php  

 				$query = "SELECT * FROM topic_file WHERE topic_id = '".$_REQUEST['topic_id']."'" ;



 				$result = $database->execute_query($query);
 			
 				if ($result->num_rows) 
 				{
 					?>
 					<table  class="text-center" style="width:100%">
 						<tr style="text-align:left">
 							<th>File Name</th>
 							<th>Status</th>
 							<th>Action</th>
 						</tr>


					<?php

					while ($rec = mysqli_fetch_assoc($result))
					{
						?>
						<tr style="text-align:left">	
						<?php
						if ($rec['file_type'] == "doc" || $rec['file_type'] == "docx") 
						{
							?>
							<td><img src="../images/doc.png" style="height: 50px; width:50px"><a href="<?php echo $rec['file_path'] ?>" download><?php echo $rec['file_name']; ?></a></td>
							<?php
						}
						if ($rec['file_type'] == "ppt" || $rec['file_type'] == "pptx") 
						{
							?>
							<td ><img src="../images/ppt.png" style="height: 50px; width:50px;"><a href="<?php echo $rec['file_path'] ?>" download><?php echo $rec['file_name']; ?></a></td>
							<?php
						}
						if ($rec['file_type'] == "jpeg" || $rec['file_type'] == "jpg" || $rec['file_type'] == "png") 
						{
							?>
							<td><img src="../images/image.png" style="height: 50px; width:50px"><a href="<?php echo $rec['file_path'] ?>" download><?php echo $rec['file_name']; ?></a></td>
							<?php
						}
						if ($rec['file_type'] == "pdf") 
						{
							?>
							<td><img src="../images/pdf.png" style="height: 50px; width:50px"><a href="<?php echo $rec['file_path'] ?>" download><?php echo $rec['file_name']; ?></a></td>
							<?php
						}
						?>
						<td><?php  

							if ($rec['status_id'] == 1) 
							{
								?>
								<p class="badge bg-success" >Active</p>
								<?php
							}
							else
							{
								?>
								<p class="badge bg-danger">In-Active</p>
								<?php
							}	

						?></td>
						<td>
							<?php 	

								if ($rec['status_id'] == 1) 
								{
									?>
									<button class="btn btn-danger" onclick="topic_file_status(<?php echo $rec['topic_file_id'] ?> , <?php echo 2 ?>)">In-Active</button>
									<?php
								}
								else	if ($rec['status_id'] == 2)
								{
									?>
									<button class="btn btn-success" onclick="topic_file_status(<?php echo $rec['topic_file_id'] ?> , <?php echo 1 ?>)">Active</button>
									<?php
								}

							 ?>
						</td>
						</tr>
						<?php
					}


					?>

 					</table>

 					<?php
 				}
 				else
 				{
 					?>
					<div class="alert alert-primary alert-dismissible fade show" role="alert">
					  <strong>Topic Material Not Found</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>

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

 <script type="text/javascript">
 	
		function topic_file_status(topic_file_id , status_id)
		{
			var action = "topic_file_status";
			var obj;  
			if (window.XMLHttpRequest) 
			{
				obj = new XMLHttpRequest();
			}
			else
			{
				obj = new ActiveXObject('microsoft.XMLHTTP');
			}
			obj.onreadystatechange = function ()
			{
				if (obj.readyState == 4 && obj.status == 200) 
				{
					document.getElementById('topic_file_message').innerHTML = obj.responseText;
				}
			}
			formdata = new FormData();
			formdata.append('topic_file_id',topic_file_id);
			formdata.append('status_id',status_id);
			formdata.append('action',action);



			obj.open("POST" , "course_topic_process.php");
			obj.send(formdata);
		}
 	 

 </script>
   
  </body>
</html>


