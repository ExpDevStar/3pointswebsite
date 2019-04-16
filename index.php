<!doctype html>
<?php
session_start();
$feedbackdata = json_decode($_SESSION['feedbackdata']);
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
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/feedback.min.js"></script>
    <link rel="stylesheet" href="./css/feedback.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <title>3Points</title>
    <style>
      .tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */
      .tt-hint {
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
      /* override styles when printing */
      @media print {
        body {
          margin: 0;
          color: #000;
          background-color: #fff;
        }
        img, svg {
        display: none;
      }

      img.print, svg.print {
        display: block;
        max-width: 100%;
      }
      header, footer, aside, nav, form, iframe, .menu, .hero, .modal-footer, .modal-header, .close{
        display: none;
      }
      .modal-body {
        display:block;
      }
      }
    </style>
  </head>
  <body screen_capture_injected="true">
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
          <!-- <li class="nav-item">
            <a class="nav-link waves-effect" href="register.php" target="_blank">Registration </a>
          </li> -->
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
        <!-- <div class="offset-md-1 col-lg-1 col-md-1">
          <div class="card">
            <div class="card-header">




            </div>

        </div>
      </div> -->
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
                  <h2 class="card-title">Clinical</h2>

                    <div id="diagnosis-card">
                        <input name="clinicalID" readonly class="form-control" type="text" id="clinicalID" value="">
                    </div>
    <div id="ranking_text"></div>
                    <h2>Diagnosis</h2>
                    <input name="DiagnosisID" readonly class="form-control" type="text" id="DiagnosisID" value="">

                </div>
                <input type="hidden" class="" aria-label="" placeholder="" name="ranking" id="ranking" value="" />

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
          </div> <!-- ./page content -->
        </div> <!-- ./card-->
      </div> <!-- ./offset-md-2 col-lg-7 col-md-7 -->
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

                      <div class="field_wrapper">

                        <form id="cart"></form>
                          <ul id="ulcart" style="list-style-type:disc;">
                                </ul>
                      </div>

                    <div class="bottom-buttons">
                      <span>
                    <button class="btn btn-warning align-items-center" id="emptyBtn"><a id="btnEmpty">Reset List</a></button>
                    <button type="button" data-toggle="modal" data-target="#centralModalSuccess" id="completeBtn" class="align-items-center btn btn-success complete">Complete</button>
                  </span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- /.col md-2-->
    </div><!-- /.row -->
  </div><!-- /.Container-fluid -->
  <!-- Central Modal Medium Success -->
  <div class="modal modal-print fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
        <div class="modal-body ">
            <div id="modal-text">
            <ol>

            </ol></div>
        </div>
        <!--Footer-->
        <div class="modal-footer justify-content-center">
          <button class="printBtn align-items-center btn btn-success complete waves-effect waves-light"><i class="fas fa-print"></i> Print</button>
          <!-- <button class="align-items-center btn btn-success complete waves-effect waves-light"><i class="fas fa-download"></i> Download</button> -->
          <button  class="btn btn-outline-success waves-effect" data-dismiss="modal"><i class="fas fa-save"></i>  Save</button>
        </div>
      </div>
      <!--/.Content-->
    </div>
  </div>
  <?php
      if (isset($feedbackdata)) :
  ?>
  <img src="<?php echo $feedbackdata->img; ?>"/>
  <?php
      endif;
  ?>
<!-- Central Modal Medium Success-->
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
  <!--/.Copyright -->
</footer>
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
<script>
// Enable tooltips
  // feedback
document.addEventListener('DOMContentLoaded',
  function () {
    $.feedback({
      ajaxURL: 'feedback-listener.php',
      html2canvasURL: 'js/html2canvas.js',
      onClose: function() { window.location.reload(); }
    });
  }, false);

$(document).ready(function()
{

  $('#btnEmpty').click(function () {
    var r = confirm("You agree to resetting this list");
    if (r == true) {
  // console.log("You pressed OK!");
  window.location.assign("index.php?action=empty");
} else {
  // console.log("You pressed Cancel!");
}

  })
  // Print Functionality
  var printButton = $('.printBtn');
  $(printButton).click(function()
  {
      $("#modal-text > .item > .remove_button").hide();
    $("#centralModalSuccess").printThis({

     importCSS: true,                // import parent page css
         importStyle: true,             // import style tags
          printContainer: false,           // grab outer container as well as the contents of the selector
          loadCSS: ["../css/bootstrap.min.css",
                            "../css/mdb.min.css",
                            "../css/style.css",
                            "../css/feedback.min.css"
                          ],// path to additional css file - use an array [] for multiple
          pageTitle: "Print Title",                  // add title to print page
          removeInline: true,            // remove all inline styles from print elements
          removeInlineSelector: "body *", // custom selectors to filter inline styles. removeInline must be true
          printDelay: 333,                // variable print delay
                      // postfix to html
          base: true,                    // preserve the BASE tag, or accept a string for the URL
        formValues: true,               // preserve input/form values
         canvas: false,                  // copy canvas elements
          doctypeString: '...',           // enter a different doctype for older markup
         removeScripts: false,           // remove script tags from print content
         copyTagClasses: true,           // copy classes from the html & body tag
        beforePrintEvent: null,         // callback function for printEvent in iframe
         beforePrint: null,              // function called before iframe is filled
         afterPrint: null                // function called before iframe is removed
     });

  })

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
    // console.log(datumConvert); // you'll get xxx
    // $('#cardResult').slideDown("slow", function() {});
    // stripping this extra fluff out
    var stripDatum = datumConvert.replace(/[{()}]/g, '');
    var stripDatum2 = stripDatum.replace(/[\[\]':value]+/g, '');
    var stripDatum3 = stripDatum2.replace(/[\[\]""]+/g, '');
    $('.hidden-cat').val(stripDatum3)
    $('.hidden-id').val(stripDatum3)
    // console.log(stripDatum3)
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
          // console.log("category_id", cat_id.cat_id)
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
        addExtraFields();
        // icd_id = JSON.parse(data);
        // data.forEach(function(icd_id)
        // {
          // $('.hidden-id').val(data.icd_id)
          // console.log("icd_id", icd_id)
        //   return icd_id
        // })
      }
    })
  })   // === END Suggest === //

  // On change of input field, grab the category id and search for matching
  function addExtraFields()
    {
      var cid = $('.hidden-cat').val();
      var iid = $('.hidden-id').val();
      //var myJSON = JSON.stringify(cid);
      // console.log(iid)
      $.ajax(
      {
        url: 'data.php',
        method: 'POST',
        dataType : 'html',
        data: 'cid=' + cid
      }).done(function(category)
      {
        // console.log(category);
        cat_id = JSON.parse(category);
        cat_id.forEach(function(cat_id)
        {
          // fill in clinical id
          $('#clinicalID').val(cat_id.cat_name)
              $('#ranking_text').val(cat_id.cat_name);
              if ($("#ranking_text").val() == "Return to Provider") {
    $('#ranking_text').html(cat_id.cat_name).val(cat_id.cat_name)
      $('#DiagnosisID').css('color', 'red');
  } else{
      $('#ranking_text').html(" ")
        $('#DiagnosisID').css('color', 'black');
  }
        })
      })
      $.ajax(
      {
        url: 'data.php',
        method: 'POST',
        dataType : 'html',
        data: 'iid=' + iid
      }).done(function(icd)
      {
        // console.log(icd);
        icd_desc = JSON.parse(icd);
        icd_desc.forEach(function(icd_desc)
        {
          // fill in diagnosis
          $('#DiagnosisID').val(icd_desc.icd_desc)
          $('#Price').val(icd_desc.icd_tertiary_ranking)

          // grab ranking and compare if its higher or not
          var icd_ranking = (icd_desc.icd_ranking);
          var icd_secondary_ranking = (icd_desc.icd_secondary_ranking);
          if ( icd_secondary_ranking == '0' || icd_secondary_ranking == '' || icd_secondary_ranking == 'undefined' || icd_secondary_ranking == null )
          {
            // console.log("emty")
            //console.log("secondary rank", icd_secondary_ranking)
          // var icd_secondary_ranking = icd_ranking;
           $('#ranking').val(icd_ranking);
          }
           else {
             // console.log("secondary rank", icd_secondary_ranking)
             var cartRankAdjusted = + 9.0 + icd_secondary_ranking;
             $('#ranking').val(cartRankAdjusted);
           }
          // if (icd_ranking < icd_secondary_ranking)
          // {
          //     console.log('less than')
          //
          //   $('#ranking').val(cartRankAdjusted);
          //   // $('#ranking').html("Return to Provider").val(icd_secondary_ranking);
          //   // $('#ranking_text').html("Return to Provider").fadeIn("fast");
          // }
          // else
          // {
          //   console.log('greater');
          //   // $('#ranking_text').html("");
          //   // $('#ranking').html(" ").val(icd_ranking);
          //   // $('#ranking_text').html(" ").fadeIn("fast");
          //
          //
          //
          //
          // };



    // console.log(cid);
    // console.log(iid);
    // $.ajax({
    //   type: "POST",
    //   url: "getprice.php",
    //   data: {
    //     ItemTypeID: iid,
    //     CategoryID: cid,
    //   },
    //   success: function(result) {
    //     $("#TreatmentID").val(result);
    //     if (result == 0) {
    //       $("#TreatmentID").val("N/A");
    //       console.log("null", result)
    //     } else {
    //       console.log("the", result);
    //     }
    //   }
    // });

           $('#TreatmentID').html(icd_desc.icd_note).val(icd_desc.icd_note)
        })
      })
    } // === END addExtraFields === //

  // Sorter
  $('#sort').click(function(e)
  {
    e.preventDefault();
    $('.field_wrapper li').sort(function(a, b)
    {
      return $(a).data('order') - $(b).data('order');
    }).appendTo('.field_wrapper');
  });

  // Dynamically Add More Input Fields after Add Button //Add to cart
  var maxField = 50; //Input fields increment limitation
  var addButton = $('.add_button'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper
  var x = 1; //Initial field counter is 1

  //Once add button is clicked
  $(addButton).click(function()
  {
    $('.item');
    // Check maximum number of input fields
    if (x < maxField)
    {
      x++; // Increment field
      // Grab Values
      var cartID = $('.hidden-id').val(),
        cartDiag = $('#DiagnosisID').val(),
        cartTreat = $('#TreatmentID').val(),
        cartRank = $('#ranking').val();
      cartPrice = $('#Price').val()
      cartNumber = x;
        // console.log("cartRank", cartRank)
      if ($('#ranking_text:contains("Return to Provider")').length > 0){


        // console.log('return to provider now')

      text = "ID: " + cartID + " " + "RANK:  " + cartRank;
      // Append Values to Sidebar
      $('#ulcart').append(`
      <li class="item" data-order="${cartRank}"><h5 data-toggle="tooltip" data-placement="top" title="Return to Provider" class="mt-1 mb-1 cart-rank font-weight-bold highlight-red ">
        ${cartID}   <div class="cartdiag" style="display:none">: ${cartDiag}</div></h5></a><a href="javascript:void(0);" class="remove_button"> <i class="fa fa-times" aria-hidden="true"></i></a>
      </li>`)
      $('.field_wrapper li').sort(function(a, b)
      {
        return $(b).data('order') - $(a).data('order');
      }).appendTo('.field_wrapper');
    }else {
        // console.log('dont to provider now')
      $('#ulcart').append(`
      <li class="item" data-order="${cartRank}"><h5 class="mt-1 mb-1 cart-rank font-weight-bold">
        ${cartID}  <div class="cartdiag" style="display:none">: ${cartDiag}</div></h5><a href="javascript:void(0);" class="remove_button"> <i class="fa fa-times" aria-hidden="true"></i></a>
      </li>`)
      $('.field_wrapper li').sort(function(a, b)
      {
        return $(b).data('order') - $(a).data('order');
      }).appendTo('.field_wrapper');
    }
    }
  }); // === END addButton === //

  // Once remove button is clicked
  $(wrapper).on('click', '.remove_button', function(e)
  {
    e.preventDefault();
    $(this).parent('li').remove();
    x--; //Decrement field
  }); // === END wrapper Remove === //

  // loop and clone to modal
  $('#completeBtn').on('click', function(e)
  {
    $('#modal-text').remove();
     $('.modal-body').prepend('<div id="modal-text"><ol class="olcart">');
      // clone to modal
      $('.field_wrapper').contents().clone().appendTo('.olcart');
        $(".olcart > .item > .remove_button").hide();
        $(".olcart > .item > h5 > .cartdiag").show();

  }); // === END Clone === //
}); // === END Document Ready === //
</script>
</body>
</html>
