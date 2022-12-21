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
            <h1 class=" text-light"><?php echo strtoupper($_REQUEST['batch_title'])??"" ?></h1>
            </div>
      </div>
    </div>
    <div class="row m-3">
    	<div class="col-sm-3">
    		
	      <div class="card border-primary" style="max-width: auto">
		      <div class="card-header bg-primary text-light">NAVIGATION</div>
		      <div class="card-body">
		      <p><a href="index.php" class="text-decoration-none text-dark" style="font-size: 20px;" >&#10140;View Courses</a></p>
		      
	     	  </div>
	  	  </div>
 		</div>
 		<div class="col-sm-6">
 			<div class="card mb-1">
 				<div class="card-header bg-light text-dark text-center" style="font-size:21px"> <?php echo strtoupper($_REQUEST['batch_title']); ?></div>
 			</div>
 			<div class="card">
 				
 				<h4 class="text-center text-success m-3"><?php echo strtoupper($_REQUEST['batch_title']); ?></h4>

 				<div class="card-body m-3">
 						<!-- <h2 class="text-center text-dark"><?php //echo  $_REQUEST['batch_title_'] ?></h2> -->		

 					<?php 	$batch_title = $_REQUEST['batch_title'] ?>		
 						
 			<div id="topic_message">
 				
 			</div>
 			<?php 

 				$batch_course_id = $_REQUEST['batch_course_id'];

				$query = "SELECT * FROM batch_course_topic bct , topics t WHERE  t.`topic_id` = bct.`topic_id` AND bct.`batch_course_id` = '".$batch_course_id."' AND t.status_id = '1' ORDER BY bct.`topic_priority` ASC";

				
               
               $result = $database->execute_query($query);

                if ($result) 
                {
                	?>

                	 

					        


                	<?php
                    $number = 1 ;
                	while ($rec = mysqli_fetch_assoc($result)) 
                	{
                		?>
		                   

                		<div class="card m-1">
                			<div class="card-body p-3">
                				<div class="card-text">
                					<p class="text-primary" style="font-size: 22px;">Topic <?php echo $number ?>
                					</p>
			        				<p class="text-success" style="font-weight: bold; font-size: 22px;"><?php echo $rec['topic_title'] ?></p>
                                    <p>Topic Material</p>
                                    <hr>
                				</div>
                				<?php  

                				$file_query = "SELECT * FROM topic_file WHERE topic_id = '".$rec['topic_id']."' AND status_id = 1" ;

                                $number++;

				 				$result_file = $database->execute_query($file_query);
				 			
				 				if ($result->num_rows) 
				 				{
				 					?>
				 					

									<?php

									while ($rec = mysqli_fetch_assoc($result_file))
									{
										?>
											
										<?php
										if ($rec['file_type'] == "doc" || $rec['file_type'] == "docx") 
										{
											?>
											<img src="../images/doc.png" style="height:30px; width:30px; margin:10px"> <a href="<?php echo $rec['file_path'] ?>" download style="font-size: 17px"><?php echo $rec['file_name']; ?></a>
											<br>
											<?php
										}

										if ($rec['file_type'] == "ppt" || $rec['file_type'] == "pptx") 
										{
											?>
											<img src="../images/ppt.png" style="height: 30px; width:30px; margin:10px">  <a href="<?php echo $rec['file_path'] ?>" download style="font-size: 17px"><?php echo $rec['file_name']; ?></a>
											<br>
											<?php
										}
										if ($rec['file_type'] == "jpeg" || $rec['file_type'] == "jpg" || $rec['file_type'] == "png") 
										{
											?>
											<img src="../images/image.png" style="height: 30px; width:30px; margin:10px"> <a href="<?php echo $rec['file_path'] ?>" download style="font-size: 17px"><?php echo $rec['file_name']; ?></a>
											<br>
											<?php
										}
										if ($rec['file_type'] == "pdf") 
										{
											?>
											<img src="../images/pdf.png" style="height: 30px; width:30px; margin:10px"> <a href="<?php echo $rec['file_path'] ?>" download style="font-size: 17px"><?php echo $rec['file_name']; ?></a>
											<br>
											<?php
										}
										
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
			        
			      
			        				
			        		
			        
					        



		                   <?php
                	}
                    ?>


					        

                    <?php
                    
                   
                      






                }


			 ?>
 				</div>
 			</div>

 			
 		</div>
 		<div class="col-sm-3">
            <div class="card  mb-3" style="max-width: 18rem;"> 
            <div class="card-header text-center">
                Upcoming Events
            </div>  
            <div class="card-body">
                <div class="card-text p-3 text-center">
                    Sorry There is No Upcoming Event
                </div>
            </div>
           
          
        </div>
             <div class="card mb-3" style="max-width: 18rem;">   
            <div class="card-body text-dark">
              <p class="card-text">Education is the most powerful weapon which you can use to change the world.</p>
              <h5 class="card-title">Nelson Mandela</h5>
              <hr>
               <p class="card-text">Education is the passport to the future, for tomorrow belongs to those who prepare for it today. </p>
              <h5 class="card-title">Malcolm X</h5>
              
              
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
                document.getElementById('topic_message'+topic_id).innerHTML = obj.responseText;
              
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

      		// console.log(files);

             
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


      	//### ADD TOPIC FILES ENDS HERE ##########
      </script>

   
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

