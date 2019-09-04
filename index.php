<!doctype html>
<?php
include_once 'functions.php';
session_start();
// $feedbackdata = json_decode($_SESSION['feedbackdata']);
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    exit;
}

if (!isset($_SESSION['medicalrecord']) || empty($_SESSION['medicalrecord'])) {
    header('location: patientorexisting.php');
    exit;
}

// $hospital=$_POST['hospital'];
// echo $hospital;
 // $medicalrecord=$_POST['medicalrecord'];
 // echo $medicalrecord;


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
    <!-- Jquery UI -->
    <link href="css/style.css" rel="stylesheet">
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
        .cartdiag {
          display: inline-block;
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


        <div class="offset-md-2 col-lg-7 col-md-7">
        <?php flashMsg(); ?>
          <div class="card">
            <div class="card-header">

              <input type="hidden" class="hidden-cat"/>
              <input type="hidden" class="hidden-id"/>
              <div class="md-form mt-0">
                  <!-- <button class="btn btn-success align-items-center" id="search-by-code"><a id="search-by-code">Search By Code</a></button> <button class="btn btn-success align-items-center" id="search-by-description"><a id="search-by-description">Search By Description</a></button> -->
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
                <input type="hidden" name="icd_tertiary_ranking" id="icd_tertiary_ranking" value="" />
                <div id="treatment-card">
                  <h2>Treatment Options</h2>
                  <input type="text" readonly name="TreatmentID" val="" id="TreatmentID" class="form-control" />
                </div>
                <h2>NTA Score</h2>
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
									<input name="hospital" id="hospital" type="hidden" value="<?php echo $_SESSION['hospital'];?>">
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
          <p class="heading lead">Finalize and Print</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <!--Body-->
        <div class="modal-body" data-keyboard="false" data-backdrop="static" >
            <form id="modal-text" method="post" action="server.php">
              <ul>
              </ul>

            </form>
            <div class="modal-footers justify-content-center">
              <button class="printBtn align-items-center btn btn-success complete waves-effect waves-light"><i class="fas fa-print"></i> Print</button>
            </div>

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
      <div class="col-md-4 col-lg-3 col-xl-3 mb-4">
        <h6 class="text-uppercase font-weight-bold">
          <strong>Legal</strong>
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
  if ($('#diabetesCaseMin').is(':checked')) {

  }
 // Reset Button
  $('#btnEmpty').click(function () {
    var r = confirm("You agree to resetting this list");
    if (r == true) {
      window.location.assign("index.php?action=empty");
    } else {
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
  var source1 = new Bloodhound({
       datumTokenizer: Bloodhound.tokenizers.obj.whitespace('icd_code'),
       queryTokenizer: Bloodhound.tokenizers.whitespace,
       remote: {
           url: 'getautocomplete.php?st=%QUERY',
           wildcard: '%QUERY'
       }
   });

  var source2 = new Bloodhound({
       datumTokenizer: Bloodhound.tokenizers.obj.whitespace('icd_desc'),
       queryTokenizer: Bloodhound.tokenizers.whitespace,
       remote: {
           url: 'getautocomplete.php?std=%QUERY',
           wildcard: '%QUERY'
       }
   });

  // Initialize the Bloodhound suggestion engine
  source1.initialize();
  source2.initialize();
  $('#suggest').typeahead(null,
    {
    name: 'source1',
    display: 'icd_code',
    highlight:true,
    source: source1.ttAdapter(),
    templates:
  {
    suggestion: function(data)
    {
      // lists all suggestions
      var details = "<div>" + data +"</div>";
      return details
    }

  }
},
  {
  name: 'source2',
   displayKey: 'icd_desc',
   source: source2.ttAdapter(),
   templates:
 {
   suggestion: function(data)
   {
     // lists all suggestions
     var details = "<div>" + data +"</div>";
     return details
   }
 },
});
  // Listen to when a selection is made
  $('#suggest').on('typeahead:selected', function(e, datum)
  {
    // grab the hidden input value
    var datumConvert = JSON.stringify(datum);
    // if autocomplete contains description as well
    if (datumConvert.includes(":")) {
      // remove any characters after :
        var stripDatum2 = datumConvert.substring(0, datumConvert.lastIndexOf(":"));
        //remove all characters
        var stripDatum3 = stripDatum2.replace(/[\[\]""]+/g, '');
        $('.hidden-cat').val(stripDatum3)
        $('.hidden-id').val(stripDatum3)
    }
    // if no description
    else{
      // remove special characters
      var stripDatum = datumConvert.replace(/[{()}]/g, '');
      // remove special characters
      var stripDatum3 = stripDatum.replace(/[\[\]""]+/g, '');
      $('.hidden-cat').val(stripDatum3)
      $('.hidden-id').val(stripDatum3)
    }
    //var stripDatum4 = stripDatum3.substring(0, stripDatum3.lastIndexOf(":") );
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
      }
    })
  })   // === END Suggest === //

  function findValueInArray(value,arr){
	  var result = "Doesn't exist";

	  for(var i=0; i<arr.length; i++){
		var name = arr[i];
		if(name == value){
		  result = 'Exist';
		  break;
		}
	  }

	  return result;
	}

  // On change of input field, grab the category id and search for matching
  function addExtraFields()
    {
      var cid = $('.hidden-cat').val();
      var iid = $('.hidden-id').val();
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
		  $('#icd_tertiary_ranking').val(icd_desc.icd_tertiary_ranking);
          // fill in diagnosis
          $('#DiagnosisID').val(icd_desc.icd_desc)
         $('#Price').val(icd_desc.icd_tertiary_ranking)
          // grab ranking and compare if its higher or not
          var icd_ranking = (icd_desc.icd_ranking);
          var icd_secondary_ranking = (icd_desc.icd_secondary_ranking);
          if ( icd_secondary_ranking == '0' || icd_secondary_ranking == '' || icd_secondary_ranking == 'undefined' || icd_secondary_ranking == null )
          {
           $('#ranking').val(icd_ranking);
          }
           else {
             // var cartRankAdjusted = + 9.0 + icd_secondary_ranking;
             var cartRankAdjusted = icd_secondary_ranking;
             $('#ranking').val(cartRankAdjusted);
           }
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
  var codes   = [];
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
        icd_tertiary_ranking = $('#icd_tertiary_ranking').val(),
        cartRank = $('#ranking').val();
        cartPrice = $('#Price').val()
        cartMedialRecord = $('#medicalrecord').val()
        cartHospital = $('#hospital').val()
        cartNumber = x;

		if(icd_tertiary_ranking == ''){
			icd_tertiary_ranking = 0;
		}

		var chkC = findValueInArray(cartID,codes);
		if(chkC === 'Exist'){
			alert("Code is already added");
			return false;
		}


        codes.push(cartID);




        // If Rank has return to provider, reorder
      if ($('#ranking_text:contains("Return to Provider")').length > 0){
        text = "ID: " + cartID + " " + "RANK:  " + cartRank;
        // Append Values to Sidebar
        $('#ulcart').append('<li class="list-unstyled item ui-state-default cartid_'+cartID+'" data-order="'+cartRank+'"><h5 data-toggle="tooltip" data-placement="top" title="Return to Provider" class="mt-1 mb-1 cart-rank font-weight-bold highlight-red "> '+cartID+'<span style="display:none" class="icd_tertiary_ranking">('+icd_tertiary_ranking+')</span><div class="cartdiag" style="display:none">:'+cartDiag+','+cartPrice+'</div></h5></a><a href="javascript:void(0);" data-id="'+cartID+'" class="remove_button"> <i class="fa fa-times" aria-hidden="true"></i></a></li>');
        // Auto Sort
        $('.field_wrapper li').sort(function(a, b)
        {
          return $(a).data('order') - $(b).data('order');
        }).appendTo('.field_wrapper');
      } else {
        $('#ulcart').append('<li class="list-unstyled item ui-state-default cartid_'+cartID+'" data-order="'+cartRank+'"><h5 class=" mt-1 mb-1 cart-rank font-weight-bold"> '+cartID+'<span style="display:none" class="icd_tertiary_ranking">('+icd_tertiary_ranking+')</span><div class="cartdiag" style="display:none">:'+cartDiag+' '+cartPrice+'</div></h5><a href="javascript:void(0);" data-id="'+cartID+'" class="remove_button"> <i class="fa fa-times" aria-hidden="true"></i></a></li>');
        // Auto Sort
        $('.field_wrapper li').sort(function(a, b)
        {
          return $(a).data('order') - $(b).data('order');
        }).appendTo('.field_wrapper');
      }
    }
  }); // === END addButton === //

  $('#centralModalSuccess').on('hidden.bs.modal', function () {
  //Display icd_tertiary_ranking

	  $('.icd_tertiary_ranking').hide();
	})

  // Once remove button is clicked
  $(wrapper).on('click', '.remove_button', function(e)
  {
    e.preventDefault();
	var h = $(this).data('id');
	codes = jQuery.grep(codes, function(value) {
	  return value != h;
	});

    $(this).parent('li').remove();
    x--; //Decrement field
  }); // === END wrapper Remove === //

  // loop and clone to modal
  $('#completeBtn').on('click', function(e)
  {
    $('#modal-text').remove();
	$('.patient_name').html('');
	var patientName = "<?php echo $_SESSION['patient_name']; ?>";
    // Append Form for Server.php Data Ingestion.
     $('.modal-body').prepend('<div class="col-12 text-success"><h4 class="patient_name">Patient Name: '+patientName+'</h4></div><form id="modal-text" method="post" action="server.php"><ul id="sortable" class="ui-sortable olcart"><input type="hidden" id="hospitalinput" name="hospitalinput" value="'+ cartHospital +'"><input type="hidden" id="medicalrecordinput" name="medicalrecordinput" value="'+ codes +'">');
      // clone to modal
      $('.field_wrapper').contents().clone().appendTo('.olcart');

	  //Display icd_tertiary_ranking

	  $('.icd_tertiary_ranking').show();
      // remove unncessary content
      $(".olcart > #cart").remove();
      $(".olcart > #ulcart").remove();
      $(".olcart > .item > .remove_button").remove();
      // show whats left
      $(".olcart > .item > h5 > .cartdiag").show();

      // Enable Sortable now
      $( "#sortable" ).sortable({
          tolerance: 'touch',
          placeholder: "ui-state-highlight"
      });
      $("#sortable").disableSelection();
      $('#sortable').sortable();
      $.ajax(
      {
        url: 'data.php',
        method: 'POST',
        dataType : 'html',
        data: {action: 'getQuestions'}
      }).done(function(data)
      {
        var questions = JSON.parse(data);
        var quesHtml  = '';
        var ids     = [];
        $.each(questions,function(index, value){
          ids.push(value.id);
          quesHtml  += '<div class="custom-control custom-checkbox float-left"><input type="checkbox" class="form-check-input" id="q'+ value.id +'" name="ques['+ value.id +']" increment="1" value="yes">  <label class="form-check-label" for="q'+ value.id +'">'+ value.title +'</label></div>';
        });
        // Append Questionairre and Print + Save Button
        $('#modal-text').append(quesHtml + `<input type="hidden" name="qids" value="${ids}"><!--Footer-->
                <!-- <button class="align-items-center btn btn-success complete waves-effect waves-light"><i class="fas fa-download"></i> Download</button> -->
                  <button class="btn btn-outline-info btn-rounded btn-block my-4 btn-blue waves-effect z-depth-0" id="save-btn" name="reg_medialsubmission" type="submit"><i class="fas fa-save"></i>  Save</button>
              </div>`)
      });

    // Case Min Index Questionairre Logic
    // $('input[name="cogCaseMin"]').click(function(){
    //        if($(this).is(":checked")){
    //          var i = parseInt($(this).attr('increment'));
    //          var current_value = parseInt($('.caseMinIndexPrice').text());
    //           $('.caseMinIndexPrice').text(current_value+i);
    //        }
    //        else if($(this).is(":not(:checked)")){
    //          var i = parseInt($(this).attr('increment'));
    //          var current_value = parseInt($('.caseMinIndexPrice').text());
    //           $('.caseMinIndexPrice').text(current_value-i);
    //        }
    //    });
    //  $('input[name="swallowCaseMin"]').click(function(){
    //         if($(this).is(":checked")){
    //           var i = parseInt($(this).attr('increment'));
    //           var current_value = parseInt($('.caseMinIndexPrice').text());
    //            $('.caseMinIndexPrice').text(current_value+i);
    //         }
    //         else if($(this).is(":not(:checked)")){
    //           var i = parseInt($(this).attr('increment'));
    //           var current_value = parseInt($('.caseMinIndexPrice').text());
    //            $('.caseMinIndexPrice').text(current_value-i);
    //         }
    //     });
    //   $('input[name="mechCaseMin"]').click(function(){
    //          if($(this).is(":checked")){
    //            var i = parseInt($(this).attr('increment'));
    //            var current_value = parseInt($('.caseMinIndexPrice').text());
    //             $('.caseMinIndexPrice').text(current_value+i);
    //          }
    //          else if($(this).is(":not(:checked)")){
    //            var i = parseInt($(this).attr('increment'));
    //            var current_value = parseInt($('.caseMinIndexPrice').text());
    //             $('.caseMinIndexPrice').text(current_value-i);
    //          }
    //      });
  }); // === END Clone === //

  // Convert Cloned Data in LI to string// Javascript/jQuery WIP
// Save Button To Database
  $("#save-btn").submit(function(e) {
    e.preventDefault();
    // var liarray = [];
    // $("li").each(function() {
    //     array.push($(this).html());
    // });
    //
    // var lisubmission = JSON.stringify(liarray);
    //
    //   var formData = {
    //         'hospital'              : $('input[name=hospitalinput]').val(),
    //         'medicalrecord'             : $('input[name=medicalrecordinput]').val(),
    //         'submission'    : lisubmission
    //     };
    //     console.log(formData);
    //     // process the form
    //            $.ajax({
    //                type        : 'POST',
    //                url         : 'server.php',
    //                data        : formData,
    //                dataType    : 'json',
    //               encode          : true
    //            })
    //                // using the done promise callback
    //                .done(function(data) {
    //
    //                    // log data to the console so we can see
    //                    console.log(data);
    //                    // var array = [];
    //                    // $("h3").each(function() {
    //                    //     array.push($(this).html());
    //                    // });
    //                    //
    //                    // var message = JSON.stringify(array);
    //                    // $.post('test.php', {data: message}, function(data) {
    //                    //     document.write(data); // "success"
    //                    // });
    //                    // here we will handle errors and validation messages
    //                });
    //
    //            // stop the form from submitting the normal way and refreshing the page
    //            event.preventDefault();
           });
}); // === END Document Ready === //
</script>
</body>
</html>
