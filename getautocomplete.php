<?php
require 'connection.php';
if (isset($_GET['st'])) {
    $str = $_GET['st'];

    $sql = "SELECT icd_code FROM icd WHERE icd_code LIKE '%{$str}%' ORDER BY icd_code";

    $result = mysqli_query($db, $sql);

    $array = array();

    while ($row = mysqli_fetch_assoc($result)) {
        // $array[] = $row['icd_code'] . ',' . $row['icd_desc'];
         $array[] = $row['icd_code'];
    }
    echo json_encode($array);
}

if (isset($_GET['std'])) {
    $strs = $_GET['std'];

    $sql = "SELECT icd_code, icd_desc FROM icd WHERE icd_desc LIKE '%{$strs}%' ORDER BY icd_code";

    $result = mysqli_query($db, $sql);

    $array = array();

    while ($row = mysqli_fetch_assoc($result)) {
      $array[] = $row['icd_code'] . ':' . $row['icd_desc'];
    }
    echo json_encode($array);
}

if (isset($_POST['itemID'])) {
    $var1 = $_POST['itemID'];
    $str = $_POST['itemID'];
    $icd = $pdo->getResult("SELECT icd_code, cat_id FROM icd WHERE icd_code = '$str'");
    echo json_encode($icd);
}
if (isset($_POST['itemID2'])) {
    $var1 = $_POST['itemID2'];
    $str = $_POST['itemID2'];
    $icd = $pdo->getResult("SELECT * FROM icd WHERE icd_code ='$str'");
    echo json_encode($icd);
}
