<!doctype html>
<?php include('server.php') ?>
<?php

// $feedbackdata = json_decode($_SESSION['feedbackdata']);
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
// send to next page
$_SESSION['medicalrecord'] = $medicalrecord;

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/feedback.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="./css/feedback.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
   
    <title>3Points</title>
  </head>

    <!--Main Navigation-->
<header>
  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="3pointssoftware.com" target="_blank">
          <strong class="blue-text"><img src="./img/logo.png" width="70px"></strong>
      </a>
      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
          <!-- <div class="error success" >
            <h3>
              <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
              ?>
            </h3>
          </div> -->
        <?php endif ?>
        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
              <?php  if (isset($_SESSION['username'])) : ?>
          <a href="patientorexisting.php?logout='1'"  class="nav-link waves-effect" ><i class="fas fa-sign-out-alt"></i> </a>
          <?php endif ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->
</header>
<!--Main layout-->
<main>
    <div class="container-fluid mt-5 pt-5">
      <div class="row">

        <div class="offset-md-2 col-lg-7 col-md-7">
         <?php flashMsg(); ?>
          <div class="card">
            <div class="card-header">
              <div class="text-center mt-0" >
                <button class="btn btn-success align-items-center new-patient"><a id="new-patient">New Patient</a></button>
                <button class="btn btn-success align-items-center existing-patient"><a id="existing-patient">View Existing Patients</a></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="new-patient-form offset-md-2 col-lg-7 col-md-7">
      <div class="card">
          <div class="card-body px-lg-5 pt-0">
        <form action="patientorexisting.php" class="text-center" method="post" style="color: #757575;">
          <?php include('errors.php'); ?>
          <?php $medicalrecord = "";?>
            <div class="form-row">
              <div class="col">
                <!-- First name -->
                <div class="md-form">
                  <input class="form-control" id="materialRegisterFormFirstName" name="firstname" placeholder="First Name" type="text" value="<?php echo $firstname; ?>">
                </div>
              </div>
              <div class="col">
                <!-- Last name -->
                <div class="md-form">
                  <input class="form-control" id="materialRegisterFormLastName" name="lastname" placeholder="Last Name" type="text" value="<?php echo $lastname; ?>">
                </div>
              </div>
            </div>
            <div class="md-form mt-0">
              <input class="form-control" id="materialRegisterFormHospital" name="medicalrecord" placeholder="Patient Medical Record" type="text" value="<?php echo $medicalrecord; ?>">
            </div>
            <!-- Hospital -->
            <div class="md-form mt-0">
              <input class="form-control" id="materialRegisterFormHospital" name="hospital" placeholder="Hospital Name" type="text" value="<?php echo $hospital; ?>">
            </div>
            <button class="btn btn-outline-info btn-rounded btn-block my-4 btn-blue waves-effect z-depth-0" id="register-btn" name="reg_patient" type="submit">Create Patient</button>

          </form><!-- Form -->
    </div></div>
  </div>
  <div class="existing-patient-content offset-md-2 col-lg-7 col-md-7">
      <div class="card">
          <div class="card-body px-lg-5 pt-0">
            <table id="existingPatients" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Medical Record</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
          </div>
      </div>
  </div>
</main>
<footer id="footer" class="page-footer unique-color-dark mt-4">
  <!--Footer Links-->
  <div class="container text-center py-4 text-md-left mt-5">
    <div class="row mt-3">
      <!--First column-->
      <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
        <h6 class="text-uppercase font-weight-bold">
          <strong>Useful links</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a id="footer-link-policy" href="/general/privacy-policy/">Privacy Policy</a>
        </p>
      </div>
      <!--/.First column-->
      <!--Second column-->
      <!--/.Second column-->
      <!--Fourth column-->
      <div class="col-md-4 col-lg-3 col-xl-3">
        <h6 class="text-uppercase font-weight-bold">
          <strong>Support</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-envelope mr-3"></i> support@3pointssoftware.com</p>
      </div>
      <!--/.Fourth column-->
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
  <div class="modal modal-print fade" id="patientAnswers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Answers ( Score: <span class="scoreView"></span> )</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body" data-keyboard="false" data-backdrop="static" >

        </div>

      </div>
      <!--/.Content-->
    </div>
  </div>
  <!--/.Copyright -->
</footer>
<script>
  $('.existing-patient-content').hide();
  $('.new-patient').on('click', function(){
    $('.new-patient-form').show();
    $('.existing-patient-content').hide();
  });
  $('.existing-patient').on('click', function(){
    $('.new-patient-form').hide();
    $('.existing-patient-content').show();
  });

  $(document).ready(function() {
    $('#existingPatients').DataTable( {
      "processing": true,
        "serverSide": true,
        "searching": false,
        "pageLength": 10,
        "lengthChange": false,
        "info": false,
        "ordering": false,
        "ajax": {
            "url": "data.php?action=getPatients",
            "type": "POST"
        },
        "columns": [
            { "data": "firstname" },
            { "data": "lastname" },
            { "data": "medicalrecord" },
            { "data": "medicalrecord" }
        ],
        columnDefs: [{
            targets: 3,
            render: function (data, type, row, meta)
            {
                if (type === 'display')
                {
                    data = '<a class="viewPatient" data-medicalrecord="' + encodeURIComponent(data) + '" href="javascript:void(0)">View</a>';
                }
                return data;
            }
        }],
    } );
} );

$(document).on('click', '.viewPatient', function(){
  var popupElem   = $('#patientAnswers').find('.modal-body');
  popupElem.html('');
  var medicalRecord   = $(this).data('medicalrecord');
  $.ajax({
							url: 'data.php',
							type: 'POST',
							data: {action: 'getAnswers', medicalrecord: medicalRecord },
							success: function(data) {
                var data    = JSON.parse(data);
                var answers = data.answers;
                var codes   = data.icd_codes;
                var html    = '<ul id="sortable" class="ui-sortable olcart">';
                $.each(codes,function(index, value){
                  html    += `<li class="item ui-state-default ui-sortable-handle"    data-order="13"><h5 class="mt-1 mb-1 cart-rank font-weight-bold">${value.icd_code}<div class="cartdiag" style="">: ${value.icd_desc} , </div></h5>
                  </li>`;
                });
                html  += '</ul>';
                var checked = '';
                score = 0;
                $.each(answers,function(index, value){
                  //console.log(value);
                  if(value.answer == 'Yes'){
                    checked  = 'checked="checked"';
                  } else{
                    checked  = '';
                  }
                  score += parseInt(value.points);
                  html  += '<div class="custom-control custom-checkbox"><input '+ checked +' disabled type="checkbox" class="form-check-input" id="q'+ value.id +'" name="ques['+ value.id +']" increment="1" value="yes">  <label class="form-check-label" for="q'+ value.id +'">'+ value.title +'</label></div>';
                });
                $('#patientAnswers').find('.scoreView').html(score);
                popupElem.html(html);
                $('#patientAnswers').modal('show');
							}
	});
 
});
</script>


<!-- Optional JavaScript -->
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.js"></script>
<script type="text/javascript" src="js/typeahead.js"></script>
<script type="text/javascript" src="js/bloodhound.min.js"></script>
<script type="text/javascript" src="js/printThis.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</body>
</html>
