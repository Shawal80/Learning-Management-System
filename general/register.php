<?php 
	session_start();

      if (isset($_SESSION['user'])) 
      {
        if ($_SESSION['user']['role_id'] == 1) 
        {
          header("location:../Admin/index.php");
        }
        if ($_SESSION['user']['role_id'] == 2) 
        {
          header("location:../Teacher/index.php");
        }
        if ($_SESSION['user']['role_id'] == 3) 
        {
          header("location:../Student/index.php");
        }
      }
	require("../require/header_footer.php");
	header_footer::header('../general/logout.php');

 ?>

 <!-- MAIN CONTENT CODE STARTS HERE -->
 <style type="text/css">
 	
 	span
 	{
 		color: white;
 	}

 </style>
 <div class="container-fluid" style="background-color:#5189b8; ">
      <div class="row">
          <div class="col-sm-12 " >
                <div style="padding: 70px;">   
                <h1 class="text-center text-light">HIDAYA INSTITUTE OF SCIENCE & TECHNOLOGY (HIST)</h1>
                </div>
                  
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2">
           
          </div>
          <div class="col-sm-8">
            <div style="background-color:#01577bd9;padding:5px; border-radius:5px; margin: 0px auto; border-bottom-right-radius:0px; border-bottom-left-radius:0px; width: 60%;" >
             <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb" >
                    <li class="breadcrumb-item"><a href="../index.php" style="color:white">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:white"> Register to the site</li>
                  </ol>
                  </nav>   
              
            </div>
          </div>
          <div class="col-sm-2">
            
          </div>
          
        </div>
  </div>

<div class="container-fluid">
 <div class="row">
 		
 	<div class="col-2">
 		
 	</div>
 	<div class="col-sm-8">
 		<div style="background-color:#01577bd9;padding: 25px; border-radius:5px; margin: 0px auto 25px auto;  border-top-right-radius:0px; border-top-left-radius:0px; width: 60%; " >
              <form >
              	<div class="row">
              		<div class="col-sm-12">
              				<div id="email_message" class="text-light" style="font-size:20px; font-weight: bold;">
              					
              				</div>
              				
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">First Name</label>
		                  <input type="text" class="form-control" id="firstname" aria-describedby="emailHelp" required>
		                  <span id="msg_firstname"></span>
		                  
		                </div>
              		</div>
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Last Name</label>
		                  <input type="text" class="form-control" id="lastname" required>
		                  <span id="msg_lastname"></span>
		                </div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Email</label>
		                  <input type="text" class="form-control" id="email" aria-describedby="emailHelp" onblur="checkemail()" required>
		                  <span id="msg_email"></span>
		                  
		                </div>
              		</div>
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Password</label>
		                  <input type="password" class="form-control" id="password" required>
		                  <span id="msg_password"></span>
		                </div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Date Of Birth</label>
		                  <input type="date" class="form-control" id="dateofbirth" required>
		                  <span id="msg_dob"></span>
		                </div>
              		</div>
              		<div class="col-sm-6">
              			<div class="mb-3">
		                  <label class="text-light">Hometown</label>
		                  <input type="text" class="form-control" id="hometown" required>
		                  <span id="msg_hometown"></span>
		                </div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-sm-6">
              			 <div class="mb-3">
		                  <label class="text-light">Gender</label>
		                  <select name="gender" id="gender" class="form-control" required>
		                  	<option selected>Male</option>
		                  	<option>Female</option>

		                  	
		                  </select>
		                  <span id="msg_gender"></span>
		                </div>
              		</div>
					<div class="col-sm-6">
						 <div class="mb-3">
		                	<label class="text-light">Profile Image</label>
		                  <input type="file" class="form-control" id="profile_image" accept=".png,.jpg,.jpeg,.bmp,." required>
		                </div>
					</div>              		
              	</div>
              	
                <center>  
                <button class="btn btn-light"   type="button"  onclick="validation()" id="registerbutton"> Register</button>
                </center>

                <div class="row">
              		<div class="col-sm-12 text-center text-light">
              			<hr>
              			<p>Already Have an Account <a href="login.php" style="color:white;">Login</a></p>
              			
              		</div>
              	</div>
              </form>

              <script type="text/javascript">
              	
              </script>      
        </div>
      </div>
 	</div>
 	<div class="col-sm-2">
 		
 	</div>
 	</div>
 </div>

 <!-- MAIN CONTENT CODE ENDS HERE -->


 <!-- FOOTER REQUIRED FILE -->

 <?php header_footer::footer("../index.php"); ?>

 <!-- #################### -->





 <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->

    <script type="text/javascript">


    	// ##########   USER REGISTERATION FUNCTION ##########################

		function register()
		{
			
			var first_name = document.getElementById('firstname').value;
			var last_name = document.getElementById('lastname').value;
			var email = document.getElementById('email').value;
			var password = document.getElementById('password').value;
			var date_of_birth = document.getElementById('dateofbirth').value;
			var gender = document.getElementById('gender').value;
			var hometown = document.getElementById('hometown').value;
			var image = document.getElementById('profile_image').files[0];
			var action = 'user_registeration';
			
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
					
					
				document.getElementById('firstname').value == "";
				document.getElementById('lastname').value == "";
				document.getElementById('email').value == "";
				document.getElementById('password').value == "";
				document.getElementById('gender').value == "";
				document.getElementById('hometown').value == "";
				document.getElementById('dateofbirth').value == "";
				document.getElementById('email_message').innerHTML = obj.responseText;



				}
			}
			formdata = new FormData();
			formdata.append('firstname',first_name);
			formdata.append('lastname',last_name);
			formdata.append('email',email);
			formdata.append('password',password);
			formdata.append('gender',gender);
			formdata.append('hometown',hometown);
			formdata.append('profile_image',image);
			formdata.append('dateofbirth',date_of_birth);
			formdata.append('action',action);

			
			obj.open("POST","login_register_process.php");
			obj.send(formdata);


		}
		// ########### USER REGISTERATION FUNCTION ENDS HERE ##############################



    				function validation()
    				{
            var first_name = document.getElementById('firstname').value;
            var last_name = document.getElementById('lastname').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            // alert(password)
            var dob = document.getElementById('dateofbirth').value;
            // console.log(dob);

            var address = document.getElementById('hometown').value;
            
            
               // alert(upload);
               /*Pattern for client side validation*/
            var patt_first_name = /^[A-Z]{1}[a-z]{2,}$/;
            var result_first_name = patt_first_name.test(first_name);
            var result_last_name = patt_first_name.test(last_name);
             
            var pattern_email=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
            var result_email = pattern_email.test(email);
             
            var pattern_password=/^[a-z]{3}[0-9]{1,10}$/; 
            // var pattern_password=/^[A-Z]{1}[a-z]{2,}$/; 
            // var pattern_password=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,}$/gm; 
            var result_password = pattern_password.test(password);

            var pattern_date_of_birth=/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/
            var pattern_dob=pattern_date_of_birth.test(dob);
            
            var pattern_address=/^[#.0-9a-zA-Z\s,-]+$/;
            var pattern_address=pattern_address.test(address);

           
              /*First name*/
            var flag = true;

            if (first_name == '') {

                flag = false;
                document.getElementById('msg_firstname').innerHTML = "*Please Enter First Name";
            }else{
                flag = true;
                document.getElementById('msg_firstname').innerHTML = "";
            }


               /*Last name*/
            if (last_name == '') {
                flag = false;
                document.getElementById('msg_lastname').innerHTML = "*Please Enter Last Name";
            }else{
                flag = true;
                document.getElementById('msg_lastname').innerHTML = "";
            }

            /*Email*/
            if (email == '') {
                flag = false;
                document.getElementById('msg_email').innerHTML = "*Please Enter Correct Email";
            }else{
                flag = true;
                document.getElementById('msg_email').innerHTML = "";
            }
            
            /*Password*/

             if (password == '') {
                flag = false;
                document.getElementById('msg_password').innerHTML = "*Please Enter Correct Password";
            }else{
                flag = true;
                document.getElementById('msg_password').innerHTML = "";
            }
            
           
           

            /*date of birth*/

            if (dob == '') {
                flag = false;
                document.getElementById('msg_dob').innerHTML = "*Please Enter Date-Of-Birth";
            }else{
                flag = true;
                document.getElementById('msg_dob').innerHTML = "";
            }
            /*Address*/

            if (address == '') {
                flag = false;
                document.getElementById('msg_hometown').innerHTML = "*Please Enter Your Address";
            }else{
                flag = true;
                document.getElementById('msg_hometown').innerHTML = "";
            }

            if (flag == true) 
            {
            	 register();
            }
          }
    	
    	 // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              	
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }

              form.classList.add('was-validated')
            }, false)
          })
      })()  


			

		//########### SUM FUNCTION FOR THE REGISTERARTION AND VALIDATION ##################

		// function sum_functions()
		// {
		// 	validation();
		// 	// typeoff(validation());
		// 	register();
		// }

		// ########## SUM FUNCTION FOR THE REGISTERATION AND VALIDATION ENDS HERE ########

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
					 	alert
						if(obj.responseText== "email_exists")
						{

						document.getElementById('email_message').innerHTML = "Please Try With Another Email This Email Is Already Registered";
						document.getElementById('registerbutton').disabled = true;
						
						}
						
				}

			}
			
			obj.open("POST","login_register_process.php");
			obj.send(formdata);
		
		}


          
     

		// ############ CHECK EMAIL IF ALREADY EXISTS FUNCTION ENDS HERE ##################
    </script>
   
  </body>
</html>

