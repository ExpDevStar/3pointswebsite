<?php include('server.php') ?>
<!DOCTYPE html>
<html>
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
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

<title>Registration</title>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="3pointssoftware.com" target="_blank">
        <strong class="blue-text"><img src="./img/logo.png" width="70px"></strong>
      </a>
    </div>
  </nav>
  <!-- Material form register -->
  <div class="container-fluid mt-5 pt-5">
  <!--Main layout-->

  <div class="row">

    <div class="offset-md-4 col-lg-4 col-md-4">
<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Sign up</strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">

        <!-- Form -->

  <form method="post" class="text-center" style="color: #757575;" action="register.php">
  	<?php include('errors.php'); ?>
    <div class="form-row">
               <div class="col">
                   <!-- First name -->
                   <div class="md-form ">
                       <input type="text" id="materialRegisterFormFirstName" class="form-control" placeholder="First Name" name="firstname" value="<?php echo $firstname; ?>">
                       <!-- <label for="materialRegisterFormFirstName">First Name</label> -->
                   </div>
               </div>
               <div class="col">
                    <!-- Last name -->
                    <div class="md-form ">
                      <input type="text" id="materialRegisterFormLastName" class="form-control" placeholder="Last Name" name="lastname" value="<?php echo $lastname; ?>">
                        <!-- <label for="materialRegisterFormLastName">Last name</label> -->
                    </div>
                </div>
        </div>

        <!-- E-mail -->
           <div class="md-form mt-0">
               <input type="email" id="materialRegisterFormEmail" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
               <!-- <label for="materialRegisterFormEmail">E-mail</label> -->
           </div>

    <!-- Password -->
           <div class="md-form">
               <input type="password" id="materialRegisterFormPassword" class="form-control"  placeholder="Password" name="password_1" aria-describedby="materialRegisterFormPasswordHelpBlock">
               <!-- <label for="materialRegisterFormPassword">Password</label> -->
               <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                   At least 8 characters and 1 digit
               </small>
           </div>
           <!-- Password -->
                  <div class="md-form ">
                      <input type="password" id="materialRegisterFormPassword" class="form-control" placeholder="Confirm Password" name="password_2" aria-describedby="materialRegisterFormPasswordHelpBlock">
                      <!-- <label for="materialRegisterFormPassword">Confirm password</label> -->

                  </div>
                  <!-- Hospital -->
                     <div class="md-form mt-0">
                         <input type="text" id="materialRegisterFormHospital" class="form-control" name="hospital" placeholder="Hospital Name"  value="<?php echo $hospital; ?>">

                     </div>
                  <!-- Terms of service -->
                <div class="checkbox" style="text-align: left;">
                       <input id="checkTerms" name="checkbox" type="checkbox">
                       <label for="checkbox"> <p>You agree to our
                             <a href="terms-of-service.html" style="text-decoration: underline;" target="_blank">terms of service</a></label>
                  </div>
                  <!-- Sign up button -->
          <button class="btn btn-outline-info btn-rounded btn-block my-4 btn-blue waves-effect z-depth-0"  disabled id="register-btn" name="reg_user" type="submit">Register</button>


  	<p>
  		<a href="login.php" style="text-decoration: underline;">Already a member? Sign in</a>
  	</p>




          </form>
          <!-- Form -->

      </div>

  </div>
</div>
</div>
</div>

<script>
$('#checkTerms').change(function () {
    $('#register-btn').prop("disabled", !this.checked);
});
</script>
  <!-- Material form register -->
</body>
</html>
