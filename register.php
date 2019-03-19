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
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

<title>Registration</title>
</head>
<body>
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
                   <div class="md-form input-group">
                       <input type="text" id="materialRegisterFormFirstName" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                       <label for="materialRegisterFormFirstName">First Name</label>
                   </div>
               </div>
               <div class="col">
                    <!-- Last name -->
                    <div class="md-form input-group">
                        <input type="text" id="materialRegisterFormLastName" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                        <label for="materialRegisterFormLastName">Last name</label>
                    </div>
                </div>
        </div>
        <!-- Username -->
           <div class="md-form input-group mt-0">
               <input type="text" id="materialRegisterFormUsername" class="form-control" name="username" value="<?php echo $username; ?>">
               <label for="materialRegisterFormUsername">Username</label>
           </div>
        <!-- E-mail -->
           <div class="md-form input-group mt-0">
               <input type="email" id="materialRegisterFormEmail" class="form-control" name="email" value="<?php echo $email; ?>">
               <label for="materialRegisterFormEmail">E-mail</label>
           </div>

    <!-- Password -->
           <div class="md-form input-group">
               <input type="password" id="materialRegisterFormPassword" class="form-control" name="password_1" aria-describedby="materialRegisterFormPasswordHelpBlock">
               <label for="materialRegisterFormPassword">Password</label>
               <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                   At least 8 characters and 1 digit
               </small>
           </div>
           <!-- Password -->
                  <div class="md-form input-group">
                      <input type="password" id="materialRegisterFormPassword" class="form-control" name="password_2" aria-describedby="materialRegisterFormPasswordHelpBlock">
                      <label for="materialRegisterFormPassword">Confirm password</label>

                  </div>
                  <!-- Sign up button -->
          <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"  name="reg_user" type="submit">Sign in</button>


  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
    <!-- Terms of service -->
              <p>By clicking
                  <em>Sign up</em> you agree to our
                  <a href="" target="_blank">terms of service</a>

          </form>
          <!-- Form -->

      </div>

  </div>
</div>
</div>
</div>
  <!-- Material form register -->
</body>
</html>
