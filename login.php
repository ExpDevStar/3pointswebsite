<?php include('server.php') ?>
<!DOCTYPE html>
<html>
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
       <input type="TEXT" id="materialLoginFormUsername" class="form-control" name="username">
       <label for="materialLoginFormUsername">Username</label>
     </div>
     <!-- Password -->
    <div class="md-form input-group">
      <input type="password" id="materialLoginFormPassword" class="form-control"  name="password">
      <label for="materialLoginFormPassword">Password</label>
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
           <a href="">Forgot password?</a>
         </div>
       </div>
       <!-- Sign in button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"  name="login_user" type="submit">Sign in</button>

    <!-- Register -->
    <p>Not a member?
    <a href="register.php">Register</a>
    </p>


  </form>
</div>

</div>
<!-- Material form login -->
</div></div></div>
</body>
</html>
