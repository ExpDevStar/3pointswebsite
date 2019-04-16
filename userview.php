<!doctype html>
<?php
require('connection.php');
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
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
<title>View Users</title>
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
    <div class="offset-md-3 col-lg-5 col-md-5">
      <div class="card">
        <h5 class="card-header info-color white-text text-center py-4">
          <strong>View Records</strong>
        </h5>
        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">
          <div class="form">
            <table width="100%" border="1" style="border-collapse:collapse;">
              <thead>
                <tr>
                <th><strong>No</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Delete</strong></th>
                </tr>
              </thead>
              <tbody>
              <?php
              $count=1;
              $sel_query="Select * from users ORDER BY id desc;";
              $result = mysqli_query($db, $sel_query);
              while ($row = mysqli_fetch_assoc($result)) {
                  ?>
              <tr>
                <td align="center"><?php echo $count; ?></td>
                <td align="center"><?php echo $row["firstname"]; ?></td>
                <td align="center"><?php echo $row["email"]; ?></td>
                <td align="center">
                  <a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
                </td>
              </tr>
              <?php $count++;
              } ?>
              <!--https://www.allphptricks.com/insert-view-edit-and-delete-record-from-database-using-php-and-mysqli/ -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
