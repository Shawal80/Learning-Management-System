      
    <?php  
      session_start();
      // require("../general/session_maintenance.php");
  // require("../require/header_footer.php");
  // header_footer::header("../general/logout.php");
      require_once('require/database.php');
  $database = new database();
      if (isset($_SESSION['user'])) 
      {
        if ($_SESSION['user']['role_id'] == 1) 
        {
          header("location:Admin/index.php");
        }
        if ($_SESSION['user']['role_id'] == 2) 
        {
          header("location:Teacher/index.php");
        }
        if ($_SESSION['user']['role_id'] == 3) 
        {
          header("location:Student/index.php");
        }
      }

    ?>

    <!doctype html>
    <html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Hidaya Institute of Science &amp; Technology (HIST)</title>
    <link rel="shortcut icon" href="https://lms.histpk.org/theme/image.php/azuline29/theme/1617621814/favicon" />

    <style type="text/css">
                 
                 
    
                    

    
                 
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
                    <a class="nav-link active"  href="#">HOME</a>
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
                ?>

                <div class="float-end" style="font-size:16px">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['user'] ?>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="<?php echo $logout ?>">Logout</a></li>
                      </ul>
                    </li>
              </div>

                <?php  
              }
              else  
              {
                ?>

                <div class="float-end" style="font-size:16px"><li class="nav-item ">
                    <a class="nav-link" href="general/login.php" style="color:lightgreen">LOGIN</a>
                  </li>

              </div>
               <div class="float-end" style="font-size:16px">
                <li class="nav-item" style="font-size:16px">
                    <a class="nav-link text-warning " href="general/register.php" >REGISTER</a>
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

    <!-- MAIN CONTENT STARTS HERE -->
  
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12 " style="background-color:#5189B8;">
                <div style="padding: 70px;">   
                <h1 class="text-center text-light">HIDAYA INSTITUTE OF SCIENCE & TECHNOLOGY (HIST)</h1>
                </div>
          </div>
        </div>
      <div class="row" style="background-color: #EAEAEA; padding: 3% 0px ;border-top: dashed ; border-width:1px;border-bottom: dashed ; border-width:1px; border-color: gray;" >
        <div class="col-sm-4 text-center">
          <img src="images/news.png" class="card-img-top" style="width:170px;height: 17 0px; ">
          <div class="card-body">
           <h5 class="card-title text-primary" style="font-size: 25px;">Why HIST?</h5>
           <p class="card-text" style="font-size: 18px;">Students will benefit from a range of teaching methods that are all geared towards awakening interest and kindling enthusiasm. We believe that this approach is the best way to impact knowledge easily and successfully.</p>
            <a href="https://histpk.org/" class="btn btn-primary bg-primary">Read More!...</a>
        </div>
      </div>
        <div class="col-sm-4  text-center">
          <img src="images/event.png" class="card-img-top" style="width:170px;height: 170px;">
          <div class="card-body">
          <h5 class="card-title" style="color:orange; font-size:25px">HIST Offers</h5>
          <p class="card-text" style="font-size: 18px;">Training in different fields like Software Development Training, System Adminstration Training, Network Adminstration Training, Basic Computer Skills.</p>
          <a href="https://histpk.org/" class="btn btn-warning text-light" style="background-color:orange; color: white;">Read More!...</a>
        </div>
          
        </div>
        <div class="col-sm-4 text-center ">
        
          <img src="images/messages.png" class="card-img-top" style="width:170px;height: 170px;">
          <div class="card-body">
           <h5 class="card-title text-success" style="font-size: 25px;">HIST Missions</h5>
           <p class="card-text" style="font-size: 18px;">Mission of HIST is to support Information & Communication Technology graduates with weak financial background. Such students are given four or more months of training on free-tuition basis and stipend for their day-to-day living expenses.</p>
           <a href="https://histpk.org/" class="btn btn-success">Read More!...</a>
        </div>
          
        </div>
        
      </div>
      
    </div>

    <div class="container-fluid">
      <div class="row m-3">
        <div class="col-sm-3">
          <div class="card border-primary mb-3" style="max-width: auto">
          <div class="card-header bg-primary text-light">NAVIGATION</div>
          <div class="card-body text-primary">
            <p><a href="#" class="text-decoration-none"><b>Home</b></a></p>
            <p><a href="#" class="text-decoration-none"><b><img src="images/icon.svg" style="width:17px;height:17px;"> Site News</b></a></p>
            <p><a href="#" class="text-decoration-none"><b>Courses</b></a></p></div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card mb-3" style="max-width: auto">
          <div class="card-header bg-light text-dark">AVAILABLE COURSES</div>
            <div class="card-body">
                          <?php 
                          
                          
                            $batch_course_query = "SELECT
                                                      *
                                                    FROM
                                                      BATCHES B,
                                                      COURSES C,
                                                      BATCH_COURSE CB
                                                    WHERE CB.`batch_id` = B.`batch_id`
                                                      AND CB.`course_id` = C.`course_id`
                                                      AND CB.`status_id` = 1" ;

                            // die($batch_course_query);

                            $batch_course_result = $database->execute_query($batch_course_query);

                            if ($batch_course_result->num_rows) 
                            {
                              while ($record = mysqli_fetch_assoc($batch_course_result))
                              {
                                
                              ?>
                              <div class="m-3">
                              <a href="#"style="font-size:20px"><?php echo strtoupper($record['batch_title']." ".$record['course_title']) ?></a>
                              <p style="font-size:17px"> <?php echo $record['course_description']; ?> 
                              </p>

                              <?php  

                                $role_query = "SELECT * FROM USER_ROLE_BATCH_COURSE_ENROLLMENT WHERE BATCH_COURSE_ID = '".$record['batch_course_id']."' AND status_id = 5" ;
                                $result = $database->execute_query($role_query);

                                if ($result->num_rows) 
                                {
                                  while ($rec=mysqli_fetch_assoc($result)) 
                                  {
                                    $query = "SELECT * FROM USERS U , USER_ROLE UR WHERE U.user_id = UR.user_id AND UR.role_id = 2 AND UR.user_role_id = '".$rec['user_role_id']."' " ;

                                    

                                    $result2 = $database->execute_query($query);
                                    // var_dump($result2);
                                    if ($result2->num_rows) 
                                    {
                                       while ($rec3=mysqli_fetch_assoc($result2)) 
                                       {
                                         ?>
                                         <p style="font-size:18px">Instructor: <span class="text-primary"><?php echo $rec3['first_name']." ".$rec3['last_name'] ?></span></p>
                                         <?php
                                       }
                                    }


                                  }
                                  
                                }


                              ?>
                                
                              </div>
                              <?php
                              
                              }
                            }
                            
                          



                          ?>
            </div>
          </div>
        </div>
        <div class="col-sm-3">

          <div class="card border-dark mb-3" style="max-width: 18rem;">   
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
                  <h2 class="text-center text-light">GOOD EDUCATION IS A TICKET TO QUALITY LIFE!</h2>
                  <p class="text-center text-light">We will open the world of knowledge for you!... We outstrip social needs in education!</p>
                  <center>
                    
                  <a href="https://histpk.org/" class="btn btn-light text-primary">Read More!...</a>
                  </center>
                  </div>
            </div>
          </div>
          <div class="row p-3">
          <div class="col-sm-3">
            <div class="card mb-3" style="max-width: auto; border: none;">
            <!-- <div class="card-header bg-primary text-light">NAVIGATION</div> -->
            <div class="card-body ">
              <p class="text-primary">All About HIST</p>
              <ul>
                <li><a href="#" class="text-dark text-decoration-none">Why Does HIST Stands For?</a></li>
                <li><a href="#" class="text-dark text-decoration-none">When Was HIST Founded?</a></li>
                <li><a href="#" class="text-dark text-decoration-none">Who Founded HIST?</a></li>
                <li><a href="#" class="text-dark text-decoration-none">With Whom HIST Is Affiliated?</a></li>
              </ul>
            </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="card mb-3" style="max-width: auto; border: none;">
            <!-- <div class="card-header bg-primary text-light">NAVIGATION</div> -->
            <div class="card-body">
              <p class="text-primary">TRAINING PROGRAMS</p>
              <ul>
                <li><a href="#" class="text-dark text-decoration-none">Basic Computer Skills</a></li>
                <li><a href="#" class="text-dark text-decoration-none">Software Development Training</a></li>
                <li><a href="#" class="text-dark text-decoration-none">System Adminstration Training</a></li>
                <li><a href="#" class="text-dark text-decoration-none">Network Adminstration Training</a></li>
              </ul>
            </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card mb-3" style="max-width: auto; border: none;">
            <!-- <div class="card-header bg-primary text-light">NAVIGATION</div> -->
            <div class="card-body">
              <p class="text-primary">QUICK LINKS</p>
              <ul>
                <li><a href="#" class="text-dark text-decoration-none">Our Mission</a></li>
                <li><a href="#" class="text-dark text-decoration-none">Who We Are?</a></li>
                <li><a href="#" class="text-dark text-decoration-none">How We Work?</a></li>
                <li><a href="#" class="text-dark text-decoration-none">Technologies Offered</a></li>
              </ul>
            </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card mb-3" style="max-width: auto; border: none;">
            <!-- <div class="card-header bg-primary text-light">NAVIGATION</div> -->
            <div class="card-body">
              <p class="text-primary">CONTACTS</p>
              <p class="text-dark">A-17, Phase - I, Sindh University Employess Co-operative Housing Society Jamshoro, 76060</p>
              <p class="text-dark">E-mail:   software.hist@hidayatrust.org</p>
              <a href="#" class="btn btn-secondary">Contact Details</a>
            </div>
            </div>
          </div>
        </div>
    </div>

    <!-- MAIN CONTENT ENDS HERE -->
    <!-- FOOTER STARTS HERE -->

          <div class="container-fluid">
            <div class="row bg-dark p-4" style="border-top: ;">
              <div class="col-sm-4">
                <p style="color:lightgray; text-align:left; font-size: 14px;">© 2021 Hidaya Institute of Science & Technology
                  </p>
              </div>
               <div class="col-sm-4">
                <p style="color:lightgray; text-align:center; font-size: 14px;">You are not logged in.</p>
                <center>
                  
                <img src="images/logo.png">
                </center>
              </div>
               <div class="col-sm-4 p-3 text-center">
                <a href="https://www.facebook.com/hidayajamshoro/" target="_blank"><img src="images/facebook.png"></a> 
                <a href="https://twitter.com/HidayaUpdates" target="_blank"><img src="images/twitter.png"></a>
                <a href="https://histpk.org/" target="_blank"><img src="images/googleplus.png"></a>
                <a href="https://histpk.org/" target="_blank"><img src="images/in.png"></a>
                
                
              </div>
              
            </div>
            
          </div>

    <!-- FOOTER ENDS HERE -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

   
  </body>
</html>