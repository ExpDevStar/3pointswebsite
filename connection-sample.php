<?php
//--------------------------------------------------------------------------
// Create connection and select DB
//--------------------------------------------------------------------------
$db = new mysqli('localhost', 'sample-user', 'sample-pass', 'sample-db');


// --------------------------------------------------------------------------
// Validate Output
// --------------------------------------------------------------------------
// $conn = mysqli_query($db, "SELECT * FROM icd WHERE icd_ranking < icd_secondary_ranking");
// $rows = array();
// while ($r = mysqli_fetch_assoc($conn)) {
//     $rows[] = $r;
// }
// print json_encode($rows);
// $jsonData = array();
//
// echo json_encode($rows);
// if ($db->connect_error) {
//    echo "Not connected, error: " . $db->connect_error;
// }
// else {
//    echo "Connected.";
// }
