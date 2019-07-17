<?php
//--------------------------------------------------------------------------
// Create connection and select DB
//--------------------------------------------------------------------------



$config     = include_once('config.php');
include_once('functions.php');
require_once 'DbConnect.php';
$host       = $config['db']['host'];
$user       = $config['db']['user'];
$pw         = $config['db']['pw'];
$dbName     = $config['db']['name'];
$charset    = 'utf8mb4';

$db = new mysqli($host, $user, $pw , $dbName);

$pdo    = new DbConnect();


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
