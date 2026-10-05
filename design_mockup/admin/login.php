<?php include 'include/header.php'; ?>

<body>
    <!-- Begin page -->
    <div class="wrapper active">


        

    <!-- Begin page -->

        <!-- Menu -->
        <!-- Sidenav Menu Start -->
      

            <!-- Brand Logo -->
           

            <!-- Full Sidebar Menu Close Button -->
          


                <!--- Sidenav Menu -->
              
               

              
        <!-- Sidenav Menu End -->

        <!-- Topbar Start -->
       
        <!-- Topbar End -->





        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->




            <div class="myaccountPage pt-5 login-page">
                <div class="dashboardForms py-3"> 

                    <form id="survey-form">
                        <div class="login-form-container customLoginFormBox">
                            <h1 class="text-center mb-3 log">Log<span class="login">In</span></h1>
                               <form id="login-form">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" placeholder="Enter Username" class="form-control" required>
                                </div>
                                <div class="form-group position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" required>
                                    <span class="toggle-password" onclick="togglePassword()">
                                        <i class="ri-eye-line" id="eyeIcon"></i>
                                    </span>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember-me">
                                            <label class="form-check-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-left pt-3">
                                        <button type="submit" id="submit" class="lab-btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        
            
                    </form>
                </div>
               </div>

<!--       -->

      

     <?php include 'include/footer.php'; ?>