<!doctype html>
<?php
session_start();

?>
<!-- https://phppot.com/php/simple-php-shopping-cart/  and
http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/ -->

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
         <button type="button" id="sidebarCollapse" class="btn btn-info">
             <i class="fas fa-bars"></i>
             <!-- <span>Menu</span> -->
         </button>
         <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <i class="fas fa-align-justify"></i>
         </button>
        </div>
      </nav>

      <h1>Enter a ICD-10-CM Code to Begin</h1>
      <form id="f-code" class="form" method="post" >
      <div id="diagnosis-card">
        <?php
        include 'connection.php';
        ?>
    <input name="searchbox" readonly class="form-control" onfocus="if (this.value=='search') this.value = ''" type="text" id="clinicalID" value="Clinical Category">

      </select>
    </div>
      <div class="jumbotron">
        <div class="row">
          <div class="offset-md-3 col-sm-4 col-md-6">
              <div id="item-card">
                <label for="codelist">Enter Code:</label>
                <select name="codeID" class="form-control" id="codeID">
                  <option selected="" disabled="">Select ICD-10-CM</option>
                    <?php
                    require 'data.php';
                    $codes = loadCodes();
                    foreach ($codes as $icd) {
                        echo "<option id='".$icd['icd_id']."' value='".$icd['icd_id']."'>".$icd['icd_code']."</option>";
                    }
                     ?>
                </select>
              </div>
            <!-- <input type="text" class="form-control" aria-label="Search for Code" list="codelist" name="codelist" id="suggest" placeholder="Search for Code"/>

            <datalist id="codelist">

            </datalist> -->
            <!-- <select name="ItemTypeID"  class="form-control"  id="ItemType" >
                <option selected=""></option>-->

            <!-- </div> -->
            <div id="diagnosis-card">
            <h2>Diagnosis</h2>
              <input name="DiagnosisID" readonly class="form-control" type="text" id="DiagnosisID" value="">
          <!--//<?php  echo "<input id='DiagnosisID'  value='".$icd['icd_desc']."'/>"; ?>-->
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
            <h2>Avg Cost/Price</h2>
            <div class="price-box"><input readonly class="form-control" id="Price"></input>
            </div>
            <button type="button" id="addToCart"  class="add_button btn btn-primary">Add</button>
          </div>
      </div>
    </div>
</form>
</div> <!-- page content -->

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
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
  $("#suggest").keyup(function() {
    $.get("getautocomplete.php", {
      codelist: $(this).val()
    }, function(data) {
      $("datalist").empty();
      $("datalist").html(data);
    });
  });
  $("#codeID").change(function() {
    var cid = $("#codeID").val();
    var iid = $("#codeID").val();
    console.log(iid)
    $.ajax({
      url: 'data.php',
      method: 'POST',
      data: 'cid=' + cid
    }).done(function(category) {
      console.log(category);
      cat_id = JSON.parse(category);
      cat_id.forEach(function(cat_id) {
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
        $('#DiagnosisID').val(icd_desc.icd_desc)
      })
    })
  })
  // Dynamically Add More Input Fields after Add Button //Add to cart
  var maxField = 10; //Input fields increment limitation
  var addButton = $('.add_button'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper
  var x = 1; //Initial field counter is 1
  //Once add button is clicked
  $(addButton).click(function() {
    //Check maximum number of input fields
    if (x < maxField) {
      x++; //Increment field counter
      var cartID = $('#codeID').val(),
        cartDiag = $('#DiagnosisID').val(),
        cartPrice = $('#Price').val()
      text = cartID + cartDiag + cartPrice;
        $(wrapper).append(`<div><input type="text" id="test" value="${text}"/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>`)
    }
  });
  //Once remove button is clicked
  $(wrapper).on('click', '.remove_button', function(e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--; //Decrement field counter
  });
  // Submit Final cart
  function finalCart() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var contact = document.getElementById("contact").value;
    // Returns successful data submission message when the entered information is stored in database.
    var dataString = 'name1=' + name + '&email1=' + email + '&password1=' + password + '&contact1=' + contact;
    if (name == '' || email == '' || password == '' || contact == '') {
      alert("Please Fill All Fields");
    } else {
      // AJAX code to submit form.
      $.ajax({
        type: "POST",
        url: "ajaxjs.php",
        data: dataString,
        cache: false,
        success: function(html) {
          alert(html);
        }
      });
    }
    return false;
  }
  $('#sidebarCollapse').on('click', function() {
    $('#sidebar').toggleClass('active');
  });
  $("#ItemType, #Treatment").on('change', function() {
    var itemType = $("#ItemType").val();
    var treatment = $("#Treatment").val();
    console.log(itemType);
    console.log(treatment);
    $.ajax({
      type: "POST",
      url: "getprice.php",
      data: {
        ItemTypeID: itemType,
        TreatmentID: treatment
      },
      success: function(result) {
        $("#Price").val(result);
        if (result == 0) {
          $("#Price").val("N/A");
          console.log("null", result)
        } else {
          console.log("the", result);
        }
      }
    });
  });
});
</script>
</body>
</html>
