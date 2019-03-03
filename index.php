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
    <title>Medical</title>
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


      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
         <button type="button" id="sidebarCollapse" class="btn btn-info">
             <i class="fas fa-bars"></i>
             <!-- <span>Menu</span> -->
         </button>
         <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <i class="fas fa-align-justify"></i>
         </button>
         <div class="content">
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

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
        </div>
      </nav>

      <h1>Enter a ICD-10-CM Code to Begin</h1>
      <form id="f-code" class="form" method="post" >
        <div id="item-card">
          <label for="suggest">Enter Code:</label>

          <input type="text" class="typeahead form-control" aria-label="Search for Code"  name="suggest" id="suggest" placeholder="Search for Code" value=""/>
          <input type="hidden" class="hidden-cat"/>
          <input type="hidden" class="hidden-id"/>
        </div>

      <div class="jumbotron">
        <div class="row">
          <div class="offset-md-3 col-sm-4 col-md-6">


            <div id="diagnosis-card">

              <h2>Clinical</h2>
            <div id="diagnosis-card">

          <input name="searchbox" readonly class="form-control" onfocus="if (this.value=='search') this.value = ''" type="text" id="clinicalID" value="">


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
            <h2>Case Mix</h2>
            <div class="price-box"><input readonly class="form-control" id="Price"></input>
            </div>

            <button type="button" id="addToCart"  class="add_button btn btn-primary">Add</button>
          </div>
      </div>
    </div>
</form>
</div> <!-- page content -->
<!-- <button id="sort">Sort</button>
<div class="field_wrapper">
      <div class="item" data-order=""><input type="text" readonly="" id="cartitem" value="ID: A0104 RANK:  "><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"></a></div><div class="item" data-order="7">
        <input type="text" readonly="" id="cartitem" value="ID: A0101 RANK:  7"><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"></a></div><div class="item" data-order="5"><input type="text" readonly="" id="cartitem" value="ID: A009 RANK:  5">
          <a href="javascript:void(0);" class="remove_button">
        <img src="remove-icon.png"></a>
      </div>
    </div> -->
  <!-- Medical Cart -->
  <div id="sidebar-right">
    <div id="shopping-cart">
      <div class="field_wrapper">
      </div>
      <div class="txt-heading"># Of Codes Entered</div>
      <button class="btn btn-danger"><a id="btnEmpty" href="index.php?action=empty">Reset List</a></button>
      <div class="no-records">Nothing Exists</div>
      <button type="button" onclick="finalCart()" class="btn btn-success">Complete</button>
    </div>
  </div>
</div>
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
  $(document).ready(function() {

    // Twitter Bloodhound and TypeAhead to handle Auto Complete
    // Instantiate the Bloodhound suggestion engine
      var source = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
              url:'getautocomplete.php?st=%QUERY',
              wildcard: '%QUERY',
              filter: function (results) {
                  // Map the remote source JSON array to a JavaScript object array
                  return $.map(results, function (result) {
                      return {
                          value: result
                      };
                  });
              }
          }
      });
      // Initialize the Bloodhound suggestion engine
      source.initialize();

      $('#suggest').typeahead(null, {
             name: 'value',
             display: 'value',
             templates: {
             suggestion: function(data) {
               // lists all suggestions
               // console.log(data.value);
               var details = "<div>" + data.value + "</div>";

               return details
             }
            },
             source: source.ttAdapter(),
             limit:10
          });
          // Listen to when a selection is made
    $('#suggest').on('typeahead:selected', function (e, datum) {
      // grab the hidden input value
    var datumConvert = JSON.stringify(datum);
      // a simple user
   console.log(datumConvert);   // you'll get xxx

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
      $.ajax({
             url: 'getautocomplete.php',
             type: 'POST',
             data: {itemID: hiddenCat},
             success: function(data) {
             cat_id = JSON.parse(data);
            cat_id.forEach(function(cat_id) {
            $('.hidden-cat').val(cat_id.cat_id)


            console.log("category_id", cat_id.cat_id)
            return cat_id
             })
           }
         })
         $.ajax({
                url: 'getautocomplete.php',
                type: 'POST',
                data: {itemID2: hiddenID},
                success: function(data) {
                icd_id = JSON.parse(data);
               icd_id.forEach(function(icd_id) {

                 $('.hidden-id').val(icd_id.icd_id)
                 console.log("icd_id", icd_id.icd_id)

               return icd_id
                })
              }
            })
    })


    // on change of input field, grab the category id and search for matching
    $("#suggest").change(function() {
       var cid =   $('.hidden-cat').val();
         var iid =   $('.hidden-id').val();
       console.log(iid)
       $.ajax({
         url: 'data.php',
         method: 'POST',
         data: 'cid=' + cid
       }).done(function(category) {
         console.log(category);
         cat_id = JSON.parse(category);
         cat_id.forEach(function(cat_id) {
           // fill in clinical id
           $('#clinicalID').val(cat_id.cat_name)
         })
       })

       $.ajax({
         url: 'data.php',
         method: 'POST',
         data: 'iid=' + iid
       }).done(function(icd) {
         console.log(icd);
         icd_desc = JSON.parse(icd);
         icd_desc.forEach(function(icd_desc) {
           // fill in diagnosis
           $('#DiagnosisID').val(icd_desc.icd_desc)
           // grab ranking and compare if its higher or not
           var icd_ranking = (icd_desc.icd_ranking);
          var icd_secondary_ranking = (icd_desc.icd_secondary_ranking);
           if (icd_ranking >= icd_secondary_ranking) {
             console.log('lesser or equal')
           } else {
             console.log('greater');

             $('#ranking').html("Elgible for Discounts").val(icd_secondary_ranking);
             $('#ranking_text').html("Elgible for Discounts").fadeIn("fast");
            // $('#ranking').val(icd_secondary_ranking);
           };
            $('#TreatmentID').html(icd_desc.icd_note).val(icd_desc.icd_note)
         })
       })
     })


  // Sorter
-
  $('#sort').click(function(e) {
      e.preventDefault();
    $('.field_wrapper div').sort(function(a, b) {
     return $(b).data('order') - $(a).data('order');
   }).appendTo('.field_wrapper');
  })



  // Dynamically Add More Input Fields after Add Button //Add to cart
  var maxField = 10; //Input fields increment limitation
  var addButton = $('.add_button'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper
  var x = 1; //Initial field counter is 1
  //Once add button is clicked
  $(addButton).click(function() {
    $('.item');
    //Check maximum number of input fields
    if (x < maxField) {
      x++; //Increment field counter
      var cartID = $('#suggest').val(),
        cartDiag = $('#DiagnosisID').val(),
        cartRank = $('#ranking').val();
        cartPrice = $('#Price').val()
      text = "ID: " + cartID + " " + "RANK:  " + cartRank;
        // $('.field_wrapper div').detach();
        $(wrapper).append(`<div class="item" data-order="${cartRank}"><input type="text" readonly id="cartitem" value="${text}"/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>`)
        $('.field_wrapper div').sort(function(a, b) {
         return $(b).data('order') - $(a).data('order');
       }).appendTo('.field_wrapper');
      }

  });

  //Once remove button is clicked
  $(wrapper).on('click', '.remove_button', function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--; //Decrement field counter
    getSorted('.item', 'data-order')
  });



  // Submit Final cart Sample Code Doesn't Work Yet
  // function finalCart() {
  //   var name = document.getElementById("name").value;
  //   var email = document.getElementById("email").value;
  //   var password = document.getElementById("password").value;
  //   var contact = document.getElementById("contact").value;
  //   // Returns successful data submission message when the entered information is stored in database.
  //   var dataString = 'name1=' + name + '&email1=' + email + '&password1=' + password + '&contact1=' + contact;
  //   if (name == '' || email == '' || password == '' || contact == '') {
  //     alert("Please Fill All Fields");
  //   } else {
  //     // AJAX code to submit form.
  //     $.ajax({
  //       type: "POST",
  //       url: "ajaxjs.php",
  //       data: dataString,
  //       cache: false,
  //       success: function(html) {
  //         alert(html);
  //       }
  //     });
  //   }
  //   return false;
  // }
  $('#sidebarCollapse').on('click', function() {
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
