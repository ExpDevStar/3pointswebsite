<?php
if(isset($_GET['st'])) {
$str = $_GET['st'];

$connection = mysqli_connect("localhost", "root", "", "pdpm");

$sql = "SELECT icd_code, icd_id FROM icd WHERE icd_code LIKE '%{$str}%'";

$result = mysqli_query($connection, $sql);

$array = array();
while($row = mysqli_fetch_assoc($result)) {
    $array[] = $row['icd_code'];
}
echo json_encode($array);

}

if(isset($_POST['itemID'])) {
require 'DbConnect.php';
$var1 = $_POST['itemID'];
$db = new DbConnect;
$conn = $db->connect();
$str = $_POST['itemID'];
$stmt = $conn->prepare("SELECT icd_code, cat_id FROM icd WHERE icd_code = '$str'");

$stmt->execute();
$icd = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($icd);

}
?>
