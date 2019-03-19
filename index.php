<!doctype html>
<?php
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
    <title>3Point</title>
    <style>
      .tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */
      .tt-hint {
          /* width: 396px;
          height: 30px;
          padding: 8px 12px; */
          /* font-size: 24px; */
          /* line-height: 30px; */
          border: 2px solid #ccc;
          border-radius: 8px;
          outline: none;
      }

      .tt-query { /* UPDATE: newer versions use tt-input instead of tt-query */
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      }

      .tt-hint {
          color: #999;
      }

      .tt-menu { /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
          width: 422px;
          margin-top: 12px;
          padding: 8px 0;
          background-color: #fff;
          border: 1px solid #ccc;
          border: 1px solid rgba(0, 0, 0, 0.2);
          border-radius: 8px;
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
      }

      .tt-suggestion {
          padding: 3px 20px;
          font-size: 18px;
          line-height: 24px;
      }

      .tt-suggestion.tt-is-under-cursor { /* UPDATE: newer versions use .tt-suggestion.tt-cursor */
          color: #fff;
          background-color: #0097cf;

      }

      .tt-suggestion p {
          margin: 0;
      }
    </style>
  </head>
  <body>
    <!--Main Navigation-->
<header>
  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="3pointsoftware.com" target="_blank">
        <strong class="blue-text">3Point</strong>
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
          <li class="nav-item">
            <a class="nav-link waves-effect" href="register.php" target="_blank">Registration </a>
          </li>

        </ul>
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
          <div class="error success" >
            <h3>
              <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
              ?>
            </h3>
          </div>
        <?php endif ?>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
              <?php  if (isset($_SESSION['username'])) : ?>
          <a href="index.php?logout='1'"  class="nav-link waves-effect" ><i class="fas fa-sign-out-alt"></i> </a>

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
          <div class="card">
            <div class="card-header">
              <input type="hidden" class="hidden-cat"/>
              <input type="hidden" class="hidden-id"/>
              <!-- <label for="suggest"><h5 class="card-title"><strong>Enter Code</strong></h5></label> -->
              <div class="md-form mt-0">
                <input class="typeahead form-control" type="text" id="suggest" ria-label="Search for Code" placeholder="Search for Code" value="" name="suggest">
              </div>
            </div>
            <div class="card-body" id="cardResult">
            <div class="row">
              <div class="offset-md-3 col-sm-5 col-md-7">
                <div id="diagnosis-card">
                  <h5 class="card-title">Clinical</h5>
                    <div id="diagnosis-card">

                        <input name="clinicalID" readonly class="form-control" type="text" id="clinicalID" value="">
                    </div>
                    <h2>Diagnosis</h2>
                    <input name="DiagnosisID" readonly class="form-control" type="text" id="DiagnosisID" value="">
                    <!--//<?php  echo "<input id='DiagnosisID'  value='".$icd['icd_desc']."'/>"; ?>-->
                </div>
                <input type="hidden" class="" aria-label="" placeholder="" name="ranking" id="ranking" value="" />
                <div id="ranking_text"></div>
                <div id="treatment-card">
                  <h2>Treatment Options</h2>
                  <input type="text" readonly name="TreatmentID" val="" id="TreatmentID" class="form-control" />
                </div>
                <h2>Case Mix Index</h2>
                <div class="price-box"><input readonly class="form-control" id="Price"></input>
                </div>
                <button type="button" id="addToCart"  class="add_button btn btn-primary">Add</button>
              </div>
          </div>
          </div> <!-- page content -->
        </div> <!-- card-->
      </div> <!-- offset-md-2 col-lg-7 col-md-7 -->
<!-- <button id="sort">Sort </button> -->
      <div class="col-md-2">
        <div class="sticky">
        <!-- style="position: fixed; width: 222.575px; height: 260px; top: 90px; z-index: 2;"> -->
          <div id="scrollspy">
          <!-- Medical Cart -->
            <div id="sidebar-right">
              <div id="shopping-cart">
                <div class="card users-listing-small mb-4">
                  <div class="card-header text-center py-3">
                    <h5>Codes Entered</h5>
                  </div>
                  <!--Card content-->
                  <div class="card-body card-body-sidebar">
                    <ul class="list-unstyled">
                      <div class="field_wrapper">
                        <form id="cart"></form>
                      </div>
                    </ul>
                    <button class="btn btn-danger align-items-center"><a id="btnEmpty" href="index.php?action=empty">Reset List</a></button>
                    <button type="button" data-toggle="modal" data-target="#centralModalSuccess" class="align-items-center btn btn-success complete">Complete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- col md-2-->
    </div><!-- row -->
  </div><!-- container-fluid -->
<!-- Central Modal Medium Success -->
  <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">COMPLETION</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->

        <div class="modal-body">
          <div class="text-center">
            <div id="modal-text"></div>
          </div>
        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
          <button class="align-items-center btn btn-success complete waves-effect waves-light"><i class="fas fa-print"></i> Print</button>
          <button class="align-items-center btn btn-success complete waves-effect waves-light"><i class="fas fa-download"></i> Download</button>
          <button  class="btn btn-outline-success waves-effect" data-dismiss="modal"><i class="fas fa-save"></i>  Save</button>
    </div>
      </div>

      <!--/.Content-->
    </div>
  </div>
<!-- Central Modal Medium Success-->
</main>
<footer id="footer" class="page-footer unique-color-dark mt-4">
  <div class="info-color-dark text-center py-4">
    <!--Contact-->
    <a id="footer-link-contact" href="/contact" data-toggle="modal" data-target="#contactForm" class="border rounded p-2 px-3 mr-4 d-none d-md-inline-block">Contact
      <i class="fas fa-envelope white-text ml-2"> </i>
    </a>
  </div>
  <!--Footer Links-->
  <div class="container text-center text-md-left mt-5">
    <div class="row mt-3">
      <!--First column-->
      <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
        <h6 class="text-uppercase font-weight-bold">
          <strong>Useful links</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a id="footer-link-license" href="/general/license/">License</a>
        </p>
        <p>
          <a id="footer-link-changelog" href="/docs/jquery/changelog/">ChangeLog</a>
        </p>
        <p>
          <a id="footer-link-policy" href="/general/privacy-policy/">Privacy Policy</a>
        </p>
      </div>
      <!--/.First column-->

      <!--Second column-->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
        <h6 class="text-uppercase font-weight-bold">
          <strong>How To Guide</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a id="footer-link-tutBootstrap" href="/howto">How to use this Software</a>
        </p>
        <p>
      </div>
      <!--/.Second column-->
      <!--Fourth column-->
      <div class="col-md-4 col-lg-3 col-xl-3">
        <h6 class="text-uppercase font-weight-bold">
          <strong>Contact</strong>
        </h6>
        <hr class="info-color mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-envelope mr-3"></i> contact@3pointsoftware.com</p>
      </div>
      <!--/.Fourth column-->
    </div>
  </div>
  <!--/.Footer Links-->
  <!-- Copyright-->
  <div class="footer-copyright py-3 text-center">
    © 2019 Copyright:
    <a href="https://threepointsoftware.com">
      <strong> 3Point Software</strong>
    </a>
  </div>
  <!--/.Copyright -->
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.js"></script>
<script type="text/javascript" src="js/typeahead.js"></script>
  <script type="text/javascript" src="js/bloodhound.min.js"></script>
<script>
$(document).ready(function()
{
  // Hide result
  // $('#cardResult').hide();
  // Twitter Bloodhound and TypeAhead to handle Auto Complete
  // Instantiate the Bloodhound suggestion engine
  var source = new Bloodhound(
  {
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote:
    {
      url: 'getautocomplete.php?st=%QUERY',
      wildcard: '%QUERY',
      filter: function(results)
      {
        // Map the remote source JSON array to a JavaScript object array
        return $.map(results, function(result)
        {
          return {
            value: result
          };
        });
      }
    }
  });
  // Initialize the Bloodhound suggestion engine
  source.initialize();
  $('#suggest').typeahead(null,
  {
    name: 'value',
    display: 'value',
    templates:
    {
      suggestion: function(data)
      {
        // lists all suggestions
        // console.log(data.value);
        var details = "<div>" + data.value + "</div>";
        return details
      }
    },
    source: source.ttAdapter(),
    limit: 10
  });
  // Listen to when a selection is made
  $('#suggest').on('typeahead:selected', function(e, datum)
  {
    // grab the hidden input value
    var datumConvert = JSON.stringify(datum);
    // a simple user
    console.log(datumConvert); // you'll get xxx
    // $('#cardResult').slideDown("slow", function() {});
    // stripping this extra fluff out
    var stripDatum = datumConvert.replace(/[{()}]/g, '');
    var stripDatum2 = stripDatum.replace(/[\[\]':value]+/g, '');
    var stripDatum3 = stripDatum2.replace(/[\[\]""]+/g, '');
    $('.hidden-cat').val(stripDatum3)
    $('.hidden-id').val(stripDatum3)
    console.log(stripDatum3)
    var hiddenCat = $('.hidden-cat').val()
    var hiddenID = $('.hidden-id').val()
    // ajax call it and return the category ID
    $.ajax(
    {
      url: 'getautocomplete.php',
      type: 'POST',
      data:
      {
        itemID: hiddenCat
      },
      success: function(data)
      {
        cat_id = JSON.parse(data);
        cat_id.forEach(function(cat_id)
        {
          $('.hidden-cat').val(cat_id.cat_id)
          console.log("category_id", cat_id.cat_id)
          return cat_id
        })
      }
    })
    $.ajax(
    {
      url: 'getautocomplete.php',
      type: 'POST',
      data:
      {
        itemID2: hiddenID
      },
      success: function(data)
      {
        // icd_id = JSON.parse(data);
        // data.forEach(function(icd_id)
        // {
          // $('.hidden-id').val(data.icd_id)
          // console.log("icd_id", icd_id)
        //   return icd_id
        // })
      }
    })
  })
  // on change of input field, grab the category id and search for matching
  $("#suggest").change(function()
    {
      var cid = $('.hidden-cat').val();
      var iid = $('.hidden-id').val();
      // console.log(iid)
      $.ajax(
      {
        url: 'data.php',
        method: 'POST',
        data: 'cid=' + cid
      }).done(function(category)
      {
        console.log(category);
        cat_id = JSON.parse(category);
        cat_id.forEach(function(cat_id)
        {
          // fill in clinical id
          $('#clinicalID').val(cat_id.cat_name)
        })
      })
      $.ajax(
      {
        url: 'data.php',
        method: 'POST',
        data: 'iid=' + iid
      }).done(function(icd)
      {
        // console.log(icd);
        icd_desc = JSON.parse(icd);
        icd_desc.forEach(function(icd_desc)
        {
          // fill in diagnosis
          $('#DiagnosisID').val(icd_desc.icd_desc)
          // grab ranking and compare if its higher or not
          var icd_ranking = (icd_desc.icd_ranking);
          var icd_secondary_ranking = (icd_desc.icd_secondary_ranking);
          if (icd_secondary_ranking > icd_ranking)
          {
            console.log('greater')
            $('#ranking_text').html("");
            $('#ranking').html(" Elgible for Discounts").val(icd_secondary_ranking);
            $('#ranking_text').html(" Elgible for Discounts").fadeIn("fast");
          }
          else
          {
            console.log('lesser');
            $('#ranking_text').html("");
            $('#ranking').html("Not Elgible for Discounts").val(icd_ranking);
            $('#ranking_text').html("Not Elgible for Discounts").fadeIn("fast");
            // $('#ranking').val(icd_secondary_ranking);
          };
          $('#TreatmentID').html(icd_desc.icd_note).val(icd_desc.icd_note)
        })
      })
    })
    // Sorter
    - $('#sort').click(function(e)
    {
      e.preventDefault();
      $('.field_wrapper div').sort(function(a, b)
      {
        return $(b).data('order') - $(a).data('order');
      }).appendTo('.field_wrapper');
    })
  // Dynamically Add More Input Fields after Add Button //Add to cart
  var maxField = 50; //Input fields increment limitation
  var addButton = $('.add_button'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper
  var x = 1; //Initial field counter is 1
  //Once add button is clicked
  $(addButton).click(function()
  {
    $('.item');
    //Check maximum number of input fields
    if (x < maxField)
    {
      x++; //Increment field
      var cartID = $('.hidden-id').val(),
        cartDiag = $('#DiagnosisID').val(),
        cartRank = $('#ranking').val();
      cartPrice = $('#Price').val()
      cartNumber = x;
      text = "ID: " + cartID + " " + "RANK:  " + cartRank;
      $(wrapper).append(`
      <div class="item" data-order="${cartRank}"><h5 class="mt-0 mb-2 font-weight-bold">
      <a href="/icdnumberlist?id=${cartID}">${cartID}<input type="hidden" class="hiddencart" name="hiddencartid" value="${cartID}"</a>
      </h5>
      <p class="badge teal darken-4"><input type="hidden" class="hiddencart" name="hiddencartrank" value="${cartRank}">${cartRank}<i class="fas fa-thumbs-o-up mx-1"></i></p>
      <a href="javascript:void(0);" class="remove_button"> <i class="fa fa-times" aria-hidden="true"></i></a></div>`)
      $('.field_wrapper div').sort(function(a, b)
      {
        return $(b).data('order') - $(a).data('order');
      }).appendTo('.field_wrapper');
    }
  });
  //Once remove button is clicked
  $(wrapper).on('click', '.remove_button', function(e)
  {
    e.preventDefault();
    $(this).parent('div').remove();
    x--; //Decrement field
  });
  $('.complete').on('click', function(e)
  {

   // loop and clone to modal
      var e = $('.item');
      for (var i = 0; i < 1; i++) {
        e.clone().insertAfter('#modal-text');
      }
      // probably dont need this commented stuff
     //  var map = {};
     // $(".hiddencart").each(function() {
     //     map[$(this).attr("name")] = $(this).val();
     // });
     //  // trim arr
     //  // for (var L = arr.length; L--; arr[L] = arr[L].replace(/[\n\r]/g, ''));
     //  // convert to string
     //  //var arrString = JSON.stringify(map);
     //  var i;
     //  for(i=0; i<50; i++){
     //   $('#modal-text').html("ICD ", map.hiddencartid)
     //  $('#modal-text').append("Rank ", map.hiddencartrank)
     // }
    });

  $('#sidebarCollapse').on('click', function()
  {
    $('#sidebar').toggleClass('active');
  });
  // $("#ItemType, #Treatment").on('change', function() {
  //   var itemType = $("#ItemType").val();
  //   var treatment = $("#Treatment").val();
  //   console.log(itemType);
  //   console.log(treatment);
  //   $.ajax({
  //     type: "POST",
  //     url: "getprice.php",
  //     data: {
  //       ItemTypeID: itemType,
  //       TreatmentID: treatment
  //     },
  //     success: function(result) {
  //       $("#Price").val(result);
  //       if (result == 0) {
  //         $("#Price").val("N/A");
  //         console.log("null", result)
  //       } else {
  //         console.log("the", result);
  //       }
  //     }
  //   });
  // });
});
</script>
</body>
</html>
