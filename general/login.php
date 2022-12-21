
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
    header_footer::header("../general/logout.php") ;
    ?>
        
    <!-- MAIN CONTENT STARTS HERE -->
  
    <div class="container-fluid" style="background-color:#5189b8; ">
      <div class="row">
          <div class="col-sm-12 " >
                <div style="padding: 70px;">   
                <h1 class="text-center text-light">HIDAYA INSTITUTE OF SCIENCE & TECHNOLOGY (HIST)</h1>
                </div>
                  
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
           
          </div>
          <div class="col-sm-6">
            <div style="background-color:#01577bd9;padding:5px; border-radius:5px; margin: 0px auto; border-bottom-right-radius:0px; border-bottom-left-radius:0px;width: 70%; " >
             <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb" >
                    <li class="breadcrumb-item"><a href="../index.php" style="color:white">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:white"> Login to the site</li>
                  </ol>
                  </nav>   
              
            </div>
          </div>
          <div class="col-sm-3">
            
          </div>
          
        </div>
      </div>
      <div class="container-fluid" >
        <div class="row" style="margin-bottom: 10%;">
          <div class="col-sm-3">
           
          </div>
          <div class="col-sm-6">
            <div style="background-color:#01577bd9;padding: 45px; border-radius:5px; margin: 0px auto;  border-top-right-radius:0px; border-top-left-radius:0px; width: 70%; " >
              <form action="login_register_process.php" method="POST">
                <div class="mb-3 text-light" >
                  <?php if (isset($_REQUEST['message'])): ?>
                    <?php echo "<p style='text-align:center; color:white; font-size:20px; '>".$_REQUEST['message']."</p>" ?>
                  <?php endif ?>
                </div>
                <div class="mb-3">
                  <label class="text-light">Username</label>
                  <input type="email" class="form-control" name="email" required>
                  
                </div>
                <div class="mb-3">
                  <label class="text-light">Password</label> 
                  <input type="password" class="form-control" name="password" required>
                </div>
                <center>
                 
                <input type="submit" name="login_btn" value="Login"  class="btn btn-light btn-md">
                <br>
                <hr>
                <a href="forgot_password.php" style="color:white">Forgot Password</a>
                </center>
              </form>
              
            </div>
          </div>
          <div class="col-sm-3">
            
          </div>
          
        </div>
      </div>

    <div class="container-fluid">
    <div class="row">
          <div class="col-sm-12 " style="background-color:#5189b8;">
                <div style="padding: 40px;">   
                <h2 class="text-center text-light">GOOD EDUCATION IS A TICKET TO QUALITY LIFE!</h2>
                <p class="text-center text-light">We will open the world of knowledge for you!... We outstrip social needs in education!</p>
                <center>
                  
                <a href="https://histpk.org/" class="btn btn-light text-primary">Read More!...</a>
                </center>
                </div>
          </div>
        </div>  
  </div>


    <!-- MAIN CONTENT ENDS HERE -->



    <?php  header_footer::footer("../index.php") ?>
     


    

   
  

  </body>
</html>