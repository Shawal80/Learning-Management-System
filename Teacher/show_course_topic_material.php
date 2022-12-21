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
		      <p><a href="view_users.php" class="text-decoration-none text-dark" >View Users</a></p>
		      <p><a href="" class="text-decoration-none text-dark"style="font-size: 20px;" >&#10140;Manage Course Topics</a></p>
	     	  </div>
	  	  </div>
 		</div>
 		<div class="col-sm-9">
 			<div class="card">
 				<div class="card-header bg-light text-dark "> <b style="font-size:20px">Topics</b></div>

 				<div class="card-body">
 						<!-- <h2 class="text-center text-dark"><?php //echo  $_REQUEST['batch_title_'] ?></h2> -->		

 					<?php 	$batch_title = $_REQUEST['batch_title'] ?>		
 						<h4 class="text-center"><?php echo strtoupper($_REQUEST['batch_title']); ?></h4>
 			<hr>
 			<div id="topic_message">
 				
 			</div>
 			<?php 

 				$batch_course_id = $_REQUEST['batch_course_id'];

				$query = "SELECT * FROM batch_course_topic bct , topics t WHERE  t.`topic_id` = bct.`topic_id` AND bct.`batch_course_id` = '".$batch_course_id."' ORDER BY bct.`topic_priority` ASC";

				
               
               $result = $database->execute_query($query);

                if ($result) 
                {
                	?>

                	 <table  id="example" class="text-center" style="width:100%">

					        <thead>
					        	
					        <tr>
					        	
					        		
					        	<th>Topic Title</th>	
					        	<th>Topic Priority Number</th>
					        	<th>Topic Status</th>
					        	<th>Set Topic Status</th>
					        	<th>Topic Material</th>	
					        	<th>Action</th>
					       	
					        </tr>

					       </thead>
					        <tbody>


                	<?php
                	while ($rec = mysqli_fetch_assoc($result)) 
                	{
                		?>
		                   


			        	<tr>
			      
			        		<td><?php echo $rec['topic_title'] ?></td>
			        		<td><?php echo $rec['topic_priority'] ?></td>
			        		<td>
			        			<?php  

			        			if ($rec['status_id'] == 1) 
			        			{
			        				?>
			        				<p class="badge bg-success">
			        					Active
			        				</p>
			        				<?php
			        			}
			        			else
			        			{
			        				?>
			        				<p class="badge bg-danger">
			        					In-Active
			        				</p>
			        				<?php	
			        			}

			        			?>
			        		</td>
			        		<td>
			        			<?php  
			        			 if ($rec['status_id'] == 1) 
			        			{
			        				?>
			        				<button class="btn btn-danger" onclick="topic_status(<?php echo $rec['topic_id'] ?>,<?php echo 2 ?>)">In-Active</button>
			        				<?php
			        			}
			        			else
			        			{
			        				?>
			        				
			        				<button class="btn btn-success" onclick="topic_status(<?php echo $rec['topic_id'] ?>,<?php echo 1 ?>)">Active</button>
			        				<?php
			        					
			        			}

			        			?>
			        		</td>
			        		<td><a href="topic_material.php?topic_id=<?php echo $rec['topic_id'] ?>&topic_title=<?php echo $rec['topic_title'] ?>&batch_title=<?php echo $batch_title ?>&batchcourseid=<?php echo $batch_course_id ?>"> Topic Material</a></td>
			        		<td>
			        			<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#topic<?php echo $rec['topic_id'] ?>" onclick="<?php $topic_id = $rec['topic_id'] ?>">
						  Add Files
						</button>

						<?php  



						?>
						<div class="modal fade" id="topic<?php echo$rec['topic_id'] ?>" tabindex="-1" aria-labelledby="topicLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel"><?php echo $rec['topic_title'] ?></h5>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body">
						       	
						       	<div id="topic_file_message<?php echo $rec['topic_id'] ?>">
						       		
						       	</div>
						       	<div class="row">
						       		<form enctype="multipart/form-data">
						       			<h5 class="text-start">Add Topic Material</h5>
						       			<hr>
						       			<input type="file" class=" form-control" id="topic_files<?php echo $rec['topic_id'] ?>" accept=".doc,.docx,.ppt,.pptx,.pdf,.jpg,.jpeg,.png" multiple>
						       		</form>
						       	</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						        <button type="button" class="btn btn-primary" onclick="topic_files(<?php echo $rec['topic_id'] ?>)">Upload Files</button>
						      </div>
						    </div>
						  </div>
						</div>	


			        		</td>
			        		
			        	</tr>
					        



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

      <script type="text/javascript">
      	
      	// ####### TOPIC STATUS FUNCTION #########
      	function topic_status(topic_id,topic_status)
      	{


            var action = "topic_status";        


             
            var obj;

            if (window.XMLHttpRequest) 
            {
                obj = new XMLHttpRequest();
            }
            else
            {
                obj = new ActiveXObject('microsoft.XMLHTTP');
            } 
            obj.onreadystatechange = function()
            {
                if (obj.readyState == 4 && obj.status == 200) 
                {
                  
                // location.reload();
                document.getElementById('topic_message').innerHTML = obj.responseText;
              
                }
            }
            formdata = new FormData();
            
            formdata.append('topic_status_id',topic_status);
            formdata.append('topic_id',topic_id);
            // formdata.append('batch_course_status_id',batch_course_status_id);
            formdata.append('action',action);

            
            obj.open("POST","course_topic_process.php");
            obj.send(formdata);
      	}
      	// ####### TOPIC STATUS FUNCTIO ENDS HERE ###



      	//### ADD TOPIC FILES ####################

      	function topic_files(topic_id)
      	{

      		var files = document.getElementById('topic_files'+topic_id).files;
      		var action = "add_topic_files";        
      		if (files.length == 0) 
      		{
      			
      			alert('No File Added Please Add Any File');
      		}
      		else
      		{
      			var obj;

            if (window.XMLHttpRequest) 
            {
                obj = new XMLHttpRequest();
            }
            else
            {
                obj = new ActiveXObject('microsoft.XMLHTTP');
            } 
            obj.onreadystatechange = function()
            {
                if (obj.readyState == 4 && obj.status == 200) 
                {
                  // alert(obj.responseText);
                  
                // location.reload();
                document.getElementById('topic_file_message'+topic_id).innerHTML = obj.responseText;
              
                }
            }
            formdata = new FormData();
            for(var i=0; i<files.length; i++){
	            formdata.append('file[]',document.getElementById('topic_files'+topic_id).files[i]);
            }
            // console.log(formdata);

            formdata.append('topic_id',topic_id);
            // formdata.append('batch_course_status_id',batch_course_status_id);
            formdata.append('action',action);

            
            obj.open("POST","course_topic_process.php");
            obj.send(formdata);
      		}
      		// console.log(files);

             
            
      	}


      	//### ADD TOPIC FILES ENDS HERE ##########
      </script>

   
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

