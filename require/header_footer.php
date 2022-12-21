<?php

  ?>
  
  <?php
   
   require('database.php');
    $database = new database();

    if (isset($_SESSION['user'])) 
    {
     $query = "SELECT * FROM USER_ROLE WHERE USER_ID = '".$_SESSION['user']['user_id']."' AND status_id = 1";
     // print_r($_SESSION['user']);
                            // die($query);
                                    $result = $database->execute_query($query);
                                    $roles = [];
                                    $u_role_id = [];
                                    if ($result->num_rows) 
                                    {
                                      while ($rec = mysqli_fetch_assoc($result)) 
                                      {
                                        $u_role_id[] = $rec['user_role_id'];

                                        // print_r($rec);
                                        // die;
                                        // $roles[] = $rec['role_id'] ;
                                        $roles[]= $rec['role_id'] ;
                                      }
                                    }    
                                    // print_r($roles);
                                        // $_SESSION['roles']= $roles;
                                        // print_r($_SESSION['roles']); 
    }
  
                            // 
    class header_footer
    {

        public static function header($logout)
        {
            ?>
            <!doctype html>
            <html lang="en">
              <head>

                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
                
                <link rel="stylesheet" type="text/css" href="../jquery.dataTables.min.css">


                <title>Hidaya Institute of Science &amp; Technology (HIST)</title>
                <link rel="shortcut icon" href="https://lms.histpk.org/theme/image.php/azuline29/theme/1617621814/favicon" />

                <style type="text/css">
                 
                 
    
                    *{
                      font-family: "Times New Roman", Times, serif;
                    }

    
                 
                </style>
              </head>
              <body>
                    
                <!-- HEADER START HERE -->

                <div class="container-fluid">
                  <div class="row bg-dark">
                    <div class="col-sm-12">
                     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav" style="font-size:14px; padding: 10px;">
                              <li class="nav-item ">
                                <a class="nav-link active"  href="../index.php">HOME</a>
                              </li>
                              <li class="nav-item ">
                                <a class="nav-link active" href="#">ABOUT US</a>
                              </li>
                              <li class="nav-item ">
                                <a class="nav-link active" href="#">TRAINING PROGRAM</a>
                              </li> 
                              <li class="nav-item ">
                                <a class="nav-link active" href="#">FAQ</a>
                              </li> 
                              <li class="nav-item ">
                                <a class="nav-link active" href="#">CONTACT US</a>
                              </li>
                            </ul>
                          </div>
                          <?php if (isset($_SESSION['user'])) 
                          {
                            global $roles ;
                            global $u_role_id ;
                            // print_r($_SESSION['roles']);

                            /*$query = "SELECT * FROM USER_ROLE WHERE USER_ID = '".$_SESSION['user']['user_id']."' AND status_id = 1";
                            // die($query);
                                    $result = $database->execute_query($query);
                                    $roles = [];
                                    if ($result->num_rows) 
                                    {

                                      while ($rec = mysqli_fetch_assoc($result)) 
                                      {
                                        print_r($rec);
                                        die;
                                        $roles [] = $rec['role_id'] ;
                                      }
                                    }*/
                            ?>

                            <div class="float-end" style="font-size:20px;">
                                <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo "".ucwords($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'])."" ?>
                                     
                                  </a> 
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <!-- <div class="text-light">
                                      <?php //print_r($_SESSION['roles']) ?>
                                    </div> -->
                                    <?php  

                                    // count($_SESSION['roles']);
                                    // print_r($u_role_id);
                                    // print_r($roles);
                                    for ($i=0; isset($roles[$i]) ; $i++) 
                                    { 
                                      // echo $roles[$i];
                                       if ($roles[$i] == 1) 
                                        {
                                          // echo $roles[$i];
                                           ?>

                                          <li><a class="dropdown-item" href="../Admin/index.php">Switch to Admin</a></li>
                                          

                                          <?php
                                          
                                        }
                                       if ($roles[$i] == 2) 
                                        {
                                          ?>
                                          <li><a class="dropdown-item" href="../Teacher/index.php">Switch to Teacher</a></li>
                                          

                                          <?php
                                          
                                        }
                                        if ($roles[$i] == 3) 
                                        {
                                          
                                           ?>
                                          <li><a class="dropdown-item" href="../Student/index.php">Switch to Student</a></li>
                                          <?php
                                          
                                        }
                                       
                                    }


                                   

                                    ?>
                                    
                                    <li><a class="dropdown-item" href="edit_profile_process.php?user_id=<?php echo $_SESSION['user']['user_id'] ?>">Edit Profile</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $logout ?>">Logout</a></li>
                                  </ul>
                                </li>
                          </div>
                           <img src="<?php echo $_SESSION['user']['image'] ?>" style="width: 40px; height: 40px;">


                            <?php  
                          }
                          else  
                          {
                            ?>

                            <div class="float-end" style="font-size:16px"><li class="nav-item ">
                                <a class="nav-link text-success" href="login.php" >LOGIN</a>
                              </li>

                          </div>
                           <div class="float-end" style="font-size:16px">
                            <li class="nav-item" style="font-size:16px">
                                <a class="nav-link text-warning " href="register.php" >REGISTER</a>
                              </li>
                          </div>

                            <?php
                          } 
                          ?>      
                          
                      </nav>
                    </div>
                  </div>
                </div>
                         
                <!-- HEADER ENDS HERE -->


            <?php
        }


        ############ FUNCTION FOR FOOTER STARTS HERE ####################################

        public static function footer($string)
        {
          ?>

          <!-- FOOTER STARTS HERE -->

          <div class="container-fluid">
            <div class="row bg-dark p-4" style="border-top: ;">
              <div class="col-sm-4">
                <p style="color:lightgray; text-align:left; font-size: 14px;">© 2021 Hidaya Institute of Science & Technology
                  </p>
              </div>
               <div class="col-sm-4">
                <?php  

                  if (isset($_SESSION['user'])) 
                  {

                    ?>
                       <p style="color:lightgray; text-align:center; font-size: 17px;">Signed in as <a href="#" class="text-decoration-none text-light" ><?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']?></a> <a href="../general/logout.php">(Logout)</a></p>
                    <?php
                    
                  }
                  else
                  {
                    ?>
                       <p style="color:lightgray; text-align:center; font-size: 17px;">You are not logged in.</p>
                    <?php
                  }

                ?>
                
                <center>
                  
                <p><a href="<?php echo $string ?>">Home</a></p>
                <img src="../images/logo.png">
                </center>
              </div>
               <div class="col-sm-4 p-3 text-center">
                <a href="https://www.facebook.com/hidayajamshoro/" target="_blank"><img src="../images/facebook.png"></a> 
                <a href="https://twitter.com/HidayaUpdates" target="_blank"><img src="../images/twitter.png"></a>
                <a href="https://histpk.org/" target="_blank"><img src="../images/googleplus.png"></a>
                <a href="https://histpk.org/" target="_blank"><img src="../images/in.png"></a>
                
              </div>
              
            </div>
            
          </div>
         
          <!-- Option 1: Bootstrap Bundle with Popper -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
                  
          <!-- FOOTER ENDS HERE -->

          


          <?php
        }



        ############ FUNCTION FOR FOOTER ENDS HERE ######################################

    }

    // header_footer::header("../general/logout.php");
?>