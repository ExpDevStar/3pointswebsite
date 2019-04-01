<?php
require 'DbConnect.php';
if(isset($_POST['cid'])) {
	$db = new DbConnect;
	$conn = $db->connect();
	$stmt = $conn->prepare("SELECT * FROM category WHERE cat_id = " . $_POST['cid']);
	#$stmt = $conn->prepare("SELECT * FROM category WHERE cat_name = " . $_POST['iid']);
	$stmt->execute();

	$category = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($category);
}




if(isset($_POST['iid'])) {
	$db = new DbConnect;
	$conn = $db->connect();
	$str = $_POST['iid'];
	$stmt = $conn->prepare("SELECT * FROM icd WHERE icd_code = '$str'");
	#$stmt = $conn->prepare("SELECT * FROM category WHERE cat_name = " . $_POST['iid']);
	$stmt->execute();

	$icd = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($icd);

	// include 'connection.php';
	// $a="SELECT * FROM icd WHERE icd_ranking >= icd_secondary_ranking";
	// $q=mysqli_query($db, $a);
	//
	//
	// while($query_exec=mysqli_fetch_array($q, MYSQLI_ASSOC))
	// {
	// 	$bool = $query_exec['Available'];
	// 	if($bool>0)
	// 	{
	// 		$bool="YES";
	// 	}
	// 	else
	// 	{
	// 		$bool="NO";
	// 	}
	//
	// 	echo "<table><tr><td>'.$bool.'</td></tr></table>";
	// }
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
