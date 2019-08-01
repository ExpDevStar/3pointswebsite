<?php
require_once 'connection.php';
session_start();
if(isset($_POST['cid'])) {
	$category = $pdo->getResult("SELECT * FROM category WHERE cat_id = '" . $_POST['cid'] . "'");
	echo json_encode($category);
}

if(isset($_POST['iid'])) {
	$str = $_POST['iid'];
	$icd = $pdo->getResult("SELECT * FROM icd WHERE icd_code = '$str'");
	echo json_encode($icd);
}

if(isset($_REQUEST['action'])) {
	if($_REQUEST['action'] == 'getQuestions'){
		$result = $pdo->getResult("SELECT * FROM questions");
		echo json_encode($result);
	}
	if($_REQUEST['action'] == 'getPatients'){
		$arr 			= [];
		$where 			= ' WHERE hospital = ?';
		$args 			= [$_SESSION['hospital']];
		$count			= $pdo->getCount("SELECT count(*) as count FROM patients" . $where, $args);
		$arr['draw']	= $_POST['draw'];
		$arr['recordsTotal']	= $count;
		$arr['recordsFiltered']	= $count;
		$query 		 	= "SELECT * FROM patients ". $where ." ORDER BY ID DESC LIMIT ".$_POST['start'].", ".$_POST['length']."";
		$arr['data']	= $pdo->getResult($query, $args);
		echo json_encode($arr);
	}
	if($_REQUEST['action'] == 'getAnswers'){
		$result = $pdo->getResult("SELECT p.*, q.title FROM patient_answers p INNER JOIN questions q ON (p.question_id = q.id) where medicalrecord = ?", [$_POST['medicalrecord']]);
		$data['answers']	= $result;
		$result = $pdo->getResult("SELECT p.*, i.icd_desc, i.icd_tertiary_ranking FROM patient_icd_codes p INNER JOIN icd i ON (p.icd_code = i.icd_code) where medicalrecord = ? order by icd_tertiary_ranking asc", [$_POST['medicalrecord']]);
		$data['icd_codes']	= $result;
		echo json_encode($data);
	}
}

function loadCodes(){
		$icd = $pdo->getResult("SELECT * FROM icd");
		echo json_encode($icd);
		return $icd;
}
?>
