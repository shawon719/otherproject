<?php
    echo "this will be index header";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index page</title>
    <link rel="stylesheet" href="./bootstrap//dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="./bootstrap/fontawesome/css/all.min.css">
     <link rel="stylesheet" href="./bootstrap/css/adminlte.min.css">
    
     <script src="./bootstrap/fontawesome/js/all.min.js"></script>
     <title>indexheader</title>
     <style>
          .header-component-container{
            width: 100%;
          }
          .imglo{
            margin-left: 90px;
          }
          .rightmenu{
            margin-right: 90px;
          }


          /* Modal styles to come from the right and take full height */
        .modal-dialog {
            position: fixed;
            top: 0;
            right: 0;
            margin: 0;
            height: 100%;
            width: 500px;
            transform: translateX(100%); /* Initially off-screen */
            transition: transform 0.3s ease-in-out;
        }

        /* Modal open state: slide in from the right */
        .modal.show .modal-dialog {
            transform: translateX(0);
        }

        .modal-content {
            height: 100%;
        }

       .modal-body {
           /* overflow-y: auto; If the content is too long, enable scrolling  */
        }
        .modalx{
              border: 1px solid green;
              height: 40px;
              width: 10%;
              font-weight: 900;
        }
        .modalx:hover{
          border: 2px solid green;
        }
        .logbtn{
          height: 50px;
          width: 100%;
        }
       
     </style>
     
</head>
<body>
    <!-- navbar start -->

    <header class="header-component-container">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
            <!-- img Logo -->
          
              <div class="header_component_right">
                      <a href="#">
                        <div class="imglo">
                          <img src="./bootstrap/img/main-logo.569c225.svg" alt="europa">
                        </div>
                      </a>

              </div>
            <!-- img logo end -->
           
            
            <!-- Navbar menu aligned to the right -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <div class="rightmenu">
                    <ul class="navbar-nav">
                      <button style="border:none" data-bs-toggle="modal" data-bs-target="#loginModal" id="loginModalLabel">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#" ><i class="fa-solid fa-user" style="width:24px,height:24px; margin-right:10px"></i>Log in</a>
                        </li>
                      </button>

                      <!-- login modal -->
                        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <!-- <h5 class="modal-title" id="loginModalLabel">Login</h5> -->
                                  <button id="modalx" type="button" class="btn-close modalx" data-bs-dismiss="modal" aria-label="Close"></button>
                                  
                              </div>
                              <div class="modal-body">
                    <!-- Login Form --> 
                    <form>
                        <div class="mb-3">
                          <h3>Personal account login</h3>
                            <!-- <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email"> -->
                        </div>
                        <div class="mb-3">
                          
                            <label for="email" class="form-label">Your Email or Driver ID

                            <i class="fa-sharp-duotone fa-solid fa-circle-exclamation"></i>
                          </label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <div class="forgetpass">
                          <p><a href="#">Forgot your password?</a></p>
                        </div>

                        <div>
                        <button type="submit" class="btn btn-primary logbtn">Login</button>
                        <button type="submit" class="btn btn-primary logbtn" style="margin-top: 15px;">Create Account</button>
                        </div>

                        <div class="forgetpass">
                          <p><a href="#">Sign in to your Business account
                          </a></p>
                        </div>


                        
                    </form>
                </div>
            </div>
        </div>
    </div>

                    <!-- us flag start -->
                    <button style="border:none">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-user" style="width:24px,height:24px; margin-right:10px"></i>US</a>
                        </li>
                      </button>
                   <button style="border:none">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#"><i class="fa-regular fa-circle-exclamation" style="width:24px,height:24px; margin-right:10px"></i>Help</a>
                        </li>
                      </button>
                    <button style="border:none">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-bars" style="width:24px,height:24px; margin-right:10px"></i>Menu</a>
                        </li>
                      </button>
                </ul>

              </div>
                
            </div>
        </div>
    </nav>
           
    <!-- </nav> -->


    </header>

    
  <!-- navbar end -->


      
    <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./bootstrap/js/adminlte.min.js"></script>
</body>
</html>