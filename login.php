<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

  <title>Login</title>

</head>
<body>
  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="https://www.3pointssoftware.com" target="_blank">
        <strong class="blue-text"><img src="./img/logo.png" width="70px"></strong>
      </a>
    </div>
  </nav>
  <div class="container-fluid mt-5 pt-5">
  <!--Main layout-->

  <div class="row">

    <div class="offset-md-4 col-lg-4 col-md-5">
<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Login</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">
  <form method="post" class="text-center" style="color: #757575;" action="login.php">
  	<?php include('errors.php'); ?>
    <!-- Email -->
     <div class="md-form input-group">
       <input type="TEXT" id="materialLoginFormUsername" placeholder="Email"class="form-control" name="username">
       <!-- <label for="materialLoginFormUsername">Email</label> -->
     </div>
     <!-- Password -->
    <div class="md-form input-group">
      <input type="password" id="materialLoginFormPassword" placeholder="Password" class="form-control"  name="password">
      <!-- <label for="materialLoginFormPassword">Password</label> -->
    </div>
    <div class="d-flex justify-content-around">
         <div>
           <!-- Remember me -->
           <div class="form-check">
             <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
             <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
           </div>
         </div>
         <div>
           <!-- Forgot password -->
           <a href="forgot-password.php">Forgot password?</a>
         </div>
       </div>
       <!-- Sign in button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"  name="login_user" type="submit">Sign in</button>

    <!-- Register -->
    <p>
    <a href="register.php" style="text-decoration: underline;">Not a member? Register</a>
    </p>


  </form>
</div>

</div>
<!-- Material form login -->
</div></div></div>
<footer id="footer" class="page-footer unique-color-dark mt-4">

  <!--Footer Links-->
  <div class="container text-center py-4 text-md-left mt-5">
    <div class="row mt-3">


      <!--/.Second column-->
      <!--Fourth column-->
      <div class="col-md-4 col-lg-3 mx-auto col-xl-3">
        <h6 class="text-uppercase font-weight-bold">
          <strong>Support</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-envelope mr-3"></i> support@3pointssoftware.com</p>
      </div>
      <!--/.Fourth column-->
      <!--First column-->
      <!-- <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
        <h6 class="text-uppercase font-weight-bold">
          <strong>About Us</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a id="footer-link-policy" href="./about-us.php">About Us</a>
        </p>
      </div> -->
      <!--/.First column-->
      <!--Second column-->
      <!-- <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
        <h6 class="text-uppercase font-weight-bold">
          <strong>Use Cases</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a id="footer-link-tutBootstrap" href="./usecase.php">Use Case</a>
        </p>
        <p>
      </div> -->
    </div>
  </div>
  <!--/.Footer Links-->
  <!-- Copyright-->
  <div class="footer-copyright py-3 text-center">
    © 2019 Copyright:
    <a href="https://threepointssoftware.com">
      <strong> 3Points Software</strong>
    </a>
  </div>
  <!--/.Copyright -->
</footer>
</body>
</html>
