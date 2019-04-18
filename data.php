<?php
require 'DbConnect.php';
if(isset($_POST['cid'])) {
	$db = new DbConnect;
	$conn = $db->connect();
	$stmt = $conn->prepare("SELECT * FROM category WHERE cat_id = " . $_POST['cid']);
	$stmt->execute();
	$category = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($category);
}

if(isset($_POST['iid'])) {
	$db = new DbConnect;
	$conn = $db->connect();
	$str = $_POST['iid'];
	$stmt = $conn->prepare("SELECT * FROM icd WHERE icd_code = '$str'");
	$stmt->execute();

	$icd = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($icd);
}

function loadCodes(){
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT * FROM icd");
		$stmt->execute();
		$icd = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($icd);
		return $icd;
}
?>
