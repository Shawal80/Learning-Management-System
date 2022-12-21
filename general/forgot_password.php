<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgotten Password</title>
	<link rel="shortcut icon" href="https://lms.histpk.org/theme/image.php/azuline29/theme/1617621814/favicon" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
		<!-- MAIN CONTENT STARTS HERE -->
		<div class="container-fluid" style="background-color:#5189b8; ">
	      <div class="row">
	          <div class="col-sm-12 " >
	                <div style="padding: 70px;">   
	                <h1 class="text-center text-light">HIDAYA INSTITUTE OF SCIENCE & TECHNOLOGY (HIST)</h1>
	                </div>
	                  
	          </div>
	        </div>
	        <div class="row m-1">
	          
	          <div class="col-sm-12 bg-light text-dark p-2" style="border-radius: 10px;">
	            
	             <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
	                  <ol class="breadcrumb" >
	                    <li class="breadcrumb-item"><a href="../index.php" >Home</a></li>
	                    <li class="breadcrumb-item " aria-current="page" > <a href="login.php" >Login</a></li>
	                    <li class="breadcrumb-item active" aria-current="page" style="color:black">Forgotten Password</li>
	                  </ol>
	                  </nav>   
	          </div>
	        </div>
	        <br>
	      </div>
	      <div class="row m-5 p-2">
	      	<div class="col-sm-2">
	      		
	      	</div>
	      	<div class="col-sm-8">
	      		<div class="card text-center">
				  <div class="card-header bg-success">
				    <h4 class="text-light">Forgot Password</h4>
				  </div>
				  <div class="card-body">
		
				    <form>
				    	<div class="row">
				    		<div class="col-sm-12">
				    			<div id="forgot_password_message" style="font-size:20px; margin:20px">
				    				
				    			</div>
				    		</div>
				    	</div>
				    	<div class="row">
				    		<div class="col-sm-3">
				    			
				    		</div>
				    		<div class="col-sm-6">
				    			<div class="mb-3">
				                  			
				                  <input type="email" class="form-control" id="email" required placeholder="Please Enter Your Email Here" onblur="checkemail()">
				                  <br>
				                  <input type="button" onclick="forgotpassword()" id="forgot_password_btn" class="btn btn-primary" value="Submit"> 
				                </div>
				    		</div>
				    		<div class="col-sm-3">
				    			
				    		</div>

				    	</div>

				    	
				    </form>
				    
				  </div>
				  
				</div>
	      	</div>
	      	<div class="col-sm-2">
	      		
 	      	</div>
	      </div>
		<!-- MAIN CONTENT ENDS HERE -->

		<!-- FOOTER RREQUIRED FILE -->

		<?php require("../require/header_footer.php");

			header_footer::footer("../index.php");

		  ?>

		<!-- ##################### -->

		 
    	<!-- Option 1: Bootstrap Bundle with Popper -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


    	<script type="text/javascript">
    		

    		// ###############   FORGOT PASS FUNCTION STARTS HERE ############################### 


    		function forgotpassword()
    		{
    			var email = document.getElementById('email').value;

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
    					if(obj.responseText == 1)
								{

									document.getElementById('forgot_password_message').innerHTML = "Password IS Sent To your Email Please Check your email";
								
								}
								else if (obj.responseText == 0) 
								{
								document.getElementById('forgot_password_message').innerHTML = "No User Registered With this Email";	
								document.getElementById('forgot_password_btn').disabled = true;
								}
    				}
    			}

    			obj.open("POST","login_register_process.php");
    			obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    			obj.send("action=forgot_password&email="+email);
    		}


    		// ###############   FORGOT PASS FUNCTION ENS HERE ############################### 
    		// ############ CHECK EMAIL IF ALREADY EXISTS FUNCTION ############################

				function checkemail()
				{
						

					var email = document.getElementById('email').value;
					var action = "check_email";
					var obj ;

					formdata = new FormData();
					formdata.append('email',email);
					formdata.append('action',action);

					if (window.XMLHttpRequest) 
					{
						 obj =  new XMLHttpRequest();
					}
					else
					{
						obj = new ActiveXObject('microsoft.XMLHTTP');
					}

					obj.onreadystatechange = function()
					{
						if (obj.readyState == 4 && obj.status == 200) 
						{
							 	
								
								
						}

					}
					
					obj.open("POST","login_register_process.php");
					obj.send(formdata);
				
				}


		          
		     

				// ############ CHECK EMAIL IF ALREADY EXISTS FUNCTION ENDS HERE ##################



    	</script>
</body>
</html>