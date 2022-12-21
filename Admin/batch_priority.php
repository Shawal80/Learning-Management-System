<?php 
	
    
    require("../general/session_maintenance.php");
	require("../require/header_footer.php");
    header_footer::header("../general/logout.php");
    $database = new database();



 ?>
 <!-- MAIN CONTENT STARS HERE -->
 <div class="container-fluid" style="background-color:#5189B8;">

 	<div class="row">

 		<div class="col-sm-2 mt-5 mb-5">
 			<a href="manage_course_batch.php" class="btn btn-secondary">BACK</a>
 		</div>
 		<div class="col-sm-8 mt-5 mb-5">
 			<h2 class=" text-center text-light">TOPIC PRIORITY</h2>
 			<h2 class="text-center text-light"><?php echo strtoupper($_REQUEST['batch_title']) ?></h2>
 			<hr>
 			<?php 


				$query = "SELECT * FROM batch_course_topic bct , topics t WHERE  t.`topic_id` = bct.`topic_id` AND bct.`batch_course_id` = '".$_REQUEST['course_batch_id']."' ORDER BY bct.`topic_priority` ASC  ";

				
               
               $result = $database->execute_query($query);

                if ($result) 
                {
                	?>

                	 <table  id="example" class=" text-center text-light table table-dark" style="width:100%">

					        <thead>
					        	
					        <tr>
					        	
					        	<th>BATCH</th>	
					        	<th>TOPIC TITLE</th>	
					        	<th>TOPIC PRIORITY NUMBER</th>	
					       	
					        </tr>

					       </thead>
					        <tbody>


                	<?php
                	while ($rec = mysqli_fetch_assoc($result)) 
                	{
                		?>
		                   


					        	<tr>
					        		<td><?php echo strtoupper($_REQUEST['batch_title']) ?></td>
					        		<td><?php echo $rec['topic_title'] ?></td>
					        		<td><?php echo $rec['topic_priority'] ?></td>
					        		
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
 		<div class="col-sm-2 mt-5">
 			
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


