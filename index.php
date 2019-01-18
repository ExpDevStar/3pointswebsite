<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <title>Medical</title>
  </head>
  <body>
    <div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Medical Software ©</h3>
            <strong>MS</strong>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Medical Code Lookup</a>
                    </li>
                    <li>
                        <a href="#">Medical Treatment Price</a>
                    </li>
                </ul>
            </li>
            <li>


                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy"></i>
                    Profile
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Settings</a>
                    </li>
                    <li>
                        <a href="#">Exit</a>
                    </li>
                    <li>
                        <a href="#">Misc</a>
                    </li>
                </ul>
              </li>
              <li>
                <a href="#">
                    <i class="fas fa-briefcase"></i>
                    About
                </a>
            </li>
        </ul>

    </nav>


    <!-- Page Content -->

    <div id="content">

      <div class="top-navbar">
      <div class="row">
        <div class="offset-md-3 col-sm-4 col-md-6">
          <!-- Search form -->
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div><!-- /input-group -->
      </div>
      </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

               <!-- <button type="button" id="sidebarCollapse" class="btn btn-info">
                   <i class="fas fa-align-left"></i>
                   <span>Toggle Sidebar</span>
               </button> -->
               <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <i class="fas fa-align-justify"></i>
               </button>

               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="nav navbar-nav ml-auto">
                       <li class="nav-item active">
                           <a class="nav-link" href="#">Dashboard</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#">Charts</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#">Graphs</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" href="#">Drawings</a>
                       </li>
                   </ul>
               </div>
           </div>
       </nav>
    </nav>

      <h1>Medical</h1>
      <div class="jumbotron">
        <div class="row">
          <div class="offset-md-3 col-sm-4 col-md-6">
              <div id="item-card">
            <h2>Medical Diagnosis </h2>
            <select name="ItemTypeID"  class="form-control"  id="ItemType" >
                <option selected=""></option>
                <?php
                include 'connection.php';

                $sq = mysqli_query($db, "SELECT * FROM itemtype");
                printf("Error: %s\n", mysqli_error($db));
                while ($record = mysqli_fetch_array($sq, MYSQLI_ASSOC)) {
                    ?>
                    <option value="<?php echo $record['item_id']; ?>" title="<?php echo $record['defaultSpec']; ?>"> <?php echo $record["name"]; ?> </option>
                <?php
                } ?>
            </select>
            </div>
            <div id="treatment-card">
            <h2>Treatment Options</h2>
            <select name="TreatmentID" class="form-control" id="Treatment">
                <?php
                include 'connection.php';
                $sq = mysqli_query($db, "SELECT * FROM treatment");

                while ($record = mysqli_fetch_array($sq, MYSQLI_ASSOC)) {
                    ?>
                    <option value="<?php echo $record['treatment_id']; ?>"> <?php echo $record["name"]; ?> </option>
                <?php
                } ?>
            </select>
</div>
            <h2>Price</h2>
            <div class="price-box"><input id="Price">
          </input>
        </div>
          </div>

      </div>
    </div>

</div>

</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function () {

      $('#sidebarCollapse').on('click', function () {
          $('#sidebar').toggleClass('active');
      });

  });
  $("#ItemType, #Treatment").on('change', function(){
      var itemType = $("#ItemType").val();
      var treatment = $("#Treatment").val();
      console.log(itemType);
      console.log(treatment);
      $.ajax({
          type: "POST",
          url: "getprice.php",
          data: {ItemTypeID: itemType, TreatmentID: treatment},
          success: function(result){
              $("#Price").val(result);
              if (result == 0)
                {
                  $("#Price").val("N/A");
                  console.log("null", result)
                }
                else{
              console.log("the", result);
          }}
      });
  });
  </script>
  </body>
</html>
