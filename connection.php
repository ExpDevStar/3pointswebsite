<?php

// Remove this soon as I'm using PDO
//--------------------------------------------------------------------------
// Create connection and select DB
//--------------------------------------------------------------------------
$db = new mysqli('localhost', 'root', '', 'pdpm');


// --------------------------------------------------------------------------
//Validate Output
//--------------------------------------------------------------------------
// $conn = mysqli_query($db, "SELECT * FROM serviceprice");
// $rows = array();
// while ($r = mysqli_fetch_assoc($conn)) {
//     $rows[] = $r;
// }
// // print json_encode($rows);
// // $jsonData = array();
//
// echo json_encode($rows);
// if ($db->connect_error) {
//    echo "Not connected, error: " . $db->connect_error;
// }
// else {
//    echo "Connected.";
// }
