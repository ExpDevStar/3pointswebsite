<?php

require_once 'connection.php';
session_start();
if (isset($_POST['cid'])) {
    $category = $pdo->getResult("SELECT * FROM category WHERE cat_id = '" . $_POST['cid'] . "'");
    echo json_encode($category);
}

if (isset($_POST['iid'])) {
    $str = $_POST['iid'];
    $icd = $pdo->getResult("SELECT * FROM icd WHERE icd_code = '$str'");
    echo json_encode($icd);
}

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'getQuestions') {
        $result = $pdo->getResult("SELECT * FROM questions");
        echo json_encode($result);
    }
    if ($_REQUEST['action'] == 'getPatients') {
        $arr = [];
        $where = ' WHERE hospital = ?';
        $args = [$_SESSION['hospital']];
        $count = $pdo->getCount("SELECT count(*) as count FROM patients" . $where, $args);
        $arr['draw'] = $_POST['draw'];
        $arr['recordsTotal'] = $count;
        $arr['recordsFiltered'] = $count;
        $query = "SELECT * FROM patients " . $where . " ORDER BY ID DESC LIMIT " . $_POST['start'] . ", " . $_POST['length'] . "";
        //echo $query; die;
        $arr['data'] = $pdo->getResult($query, $args);
        echo json_encode($arr);
    }
    if ($_REQUEST['action'] == 'getAnswers') {
		$medicalrecord	= urldecode($_POST['medicalrecord']);
        $result = $pdo->getResult("SELECT p.*, q.title FROM patient_answers p INNER JOIN questions q ON (p.question_id = q.id) where medicalrecord = ?", [$medicalrecord]);
        $data['answers'] = $result;
        $result = $pdo->getResult("SELECT p.*, i.icd_desc, i.icd_tertiary_ranking FROM patient_icd_codes p INNER JOIN icd i ON (p.icd_code = i.icd_code) where medicalrecord = ? order by p.id asc", [$medicalrecord]); //icd_tertiary_ranking 
        $data['icd_codes'] = $result;
        echo json_encode($data);
    }
    /*if ($_REQUEST['action'] == 'getPatientDetail') {
        $result = $pdo->getResult("SELECT * FROM patients where id = ?", [$_POST['id']]);
        $data['data'] = $result;
        echo json_encode($data);
    }
    if ($_REQUEST['action'] == 'savePatient') {
        $query = "UPDATE patients SET firstname = '" . $_POST["firstname"] . "',lastname='" . $_POST['lastname'] . "',medicalrecord = '" . $_POST['medicalrecord'] . "',hospital='" . $_POST['hospital'] . "' where id = " . $_POST['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error());
        echo json_encode(array("status" => 1));
    }*/
}

function loadCodes() {
    $icd = $pdo->getResult("SELECT * FROM icd");
    echo json_encode($icd);
    return $icd;
}

?>
