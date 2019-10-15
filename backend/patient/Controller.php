<?php

require_once __DIR__ . "/../../connection.php";

class PatientController {
    /* public function getConnection($HOST,$USERNAME,$PASSWORD,$DB) {
      $db = new mysqli($HOST,$USERNAME,$PASSWORD,$DB);
      return $pdo = new DbConnect();
      } */

    public function getEditModal()
    {
        return '<div class="modal modal-print fade" id="editPatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-notify modal-success" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        Edit Patient
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="white-text">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body" data-keyboard="false" data-backdrop="static" >
                    
                        <div class="alert alert-success" role="alert" style="display:none;"></div>
                        <div class="alert alert-danger" role="alert" style="display:none;"></div>
                        
                        <div class="form-group">
                          <label>Firstname:</label>
                          <input type="text" class="form-control" id="firstname">
                        </div>
                        <div class="form-group">
                          <label>Lastname:</label>
                          <input type="text" class="form-control" id="lastname">
                        </div>
                        <div class="form-group">
                          <label>Medical Record:</label>
                          <input type="text" class="form-control" id="medicalrecord">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="hidden-cat"/>
                            <input type="hidden" class="hidden-id"/>
                            <label>Code:</label>
                            <div class="md-form mt-0">
                              <!-- <input class="typeahead form-control" type="text" id="suggest" ria-label="Search for Code" placeholder="Search for Code" value="" name="suggest"> -->
                              <select class="js-data-example-ajax"></select>
                            </div>
                        </div>
                        <div class="form-group">
                        <div id="code_result"></div>
                        <br>
                        <div id="ques_html">
                        </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                          <label>SNF:</label>
                          <input type="text" class="form-control" id="hospital" readonly="">
                        </div>
                        <div id="hiddenInputs">
                        </div>
                        <input type="hidden" name="patient_id" id="patient_id">
                        <input type="hidden" name="medicalrecordinput" id="medicalrecordinput" value="">
                        <input type="hidden" name="customsorting" id="customsorting" value="">
                        <button type="button" class="btn btn-primary submitPatient">Submit</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>';
    }

    public function getPatientDetail($pdo) {
        $result = $pdo->getResult("SELECT * FROM patients INNER JOIN patient_answers ON patients.medicalrecord = patient_answers.medicalrecord where patients.id = ?", [$_POST['id']]);
        $quesHtml = '';
        if(empty($result)){
            //if user did not selected or answered any question
            $result = $pdo->getResult("SELECT * FROM patients WHERE id = ?", [$_POST['id']]);
            $ques = $pdo->getResult("SELECT * FROM questions");
            foreach($ques as $key => $value) {
                $quesHtml  .= '<div class="custom-control custom-checkbox float-left"><input type="checkbox" data-id = "' . $value['id'] . '"class="form-check-input" id="q' . $value['id'] . '" name="ques" increment="1" value="yes">  <label class="form-check-label" for="q' . $value['id'] . '">' . $value['title'] . '</label></div><br>';
                            $qids[] = $value['id'];
            }
        }
        else {
            //If user selected at least one answer.
            foreach ($result as $key => $value) {
            $ques = $pdo->getResult("SELECT * FROM questions WHERE id= {$value['question_id']}");
            if($value['answer'] == 'Yes') {
                $quesHtml  .= '<div class="custom-control custom-checkbox float-left"><input type="checkbox" data-id = "' . $ques[0]['id'] . '"class="form-check-input" id="q' . $ques[0]['id'] . '" name="ques" increment="1" value="yes" checked>  <label class="form-check-label" for="q' . $ques[0]['id'] . '">' . $ques[0]['title'] . '</label></div><br>';
                $yesAns[] = $ques[0]['id'];
            }
            else {
                                    $quesHtml  .= '<div class="custom-control custom-checkbox float-left"><input type="checkbox" data-id = "' . $ques[0]['id'] . '"class="form-check-input" id="q' . $ques[0]['id'] . '" name="ques" increment="1" value="yes">  <label class="form-check-label" for="q' . $ques[0]['id'] . '">' . $ques[0]['title'] . '</label></div><br>';
            }
            $qids[] = $ques[0]['id'];
            }
        }

        $code_result = [];
        $sortable_html = '<ul id="sortable" class="patient_code_sort">';
        $code = "";
        if (!empty($result)) {
            $medicalrecord = $result[0]['medicalrecord'];
            $query = "SELECT pic.id,pic.icd_code,icd.icd_desc,icd.icd_secondary_ranking,icd.icd_ranking "
                    . "FROM patient_icd_codes as pic "
                    . "INNER JOIN icd ON icd.icd_code = pic.icd_code "
                    . "where pic.medicalrecord = '" . $medicalrecord . "' "
                    . "ORDER BY id ASC ";
            $code_result = $pdo->getResult($query);
            if (!empty($code_result)) {
                foreach ($code_result as $key => $value) {
                    
                    
                    if ( $value['icd_secondary_ranking'] == '0' || $value['icd_secondary_ranking'] == '' || $value['icd_secondary_ranking'] == null )
                    {
                        $rank = $value['icd_ranking'];
                    }
                    else
                    {
                        $rank = $value['icd_secondary_ranking'];
                    }
                    //CB10-10
                    $sortable_html .= '<li class="ui-state-default" data-cart-id="' . $value['icd_code'] . '" data-order="' . $rank . '"><b>' . $value['icd_code'] . ' - ' . $value['icd_desc'] . '</b>&nbsp;&nbsp;<button type="button" class="removeC close" aria-label="Close"><span aria-hidden="true">×</span></button></li>';
                    $code .= "," . $value['icd_code'];
                }
                $code = substr($code, 1);
            }
        }
        $sortable_html .= '</ul>';
        $qstr = implode(', ',$qids);
        if(isset($yesAns)){
                 $astr = implode(', ',$yesAns);
        }
        else {
            $astr = '';
        }
        $hiddenInputs = '';
        $hiddenInputs .= '<input type="hidden" id="qids" name="qids" value="'.$qstr.'">';
        $hiddenInputs .= '<input type="hidden" id="aids" name="aids" value="'.$astr.'">';
        $data['data'] = $result;
        $data['hiddenInputs'] = $hiddenInputs;
        $data['quesHtml'] = $quesHtml;
        $data['code_result'] = $sortable_html;
        $data['medicalrecordinput'] = $code;
        echo json_encode($data);
        die;
    }
    public function savePatient($pdo, $pdo_connection)
    {
        $check_medical_record = " SELECT * FROM patients WHERE medicalrecord = '" . $_POST['hospital'] . "' AND id != " . $_POST['id'] . " ";
        $code_result = $pdo_connection->getResult($check_medical_record);
        $totalScore   = 0;
        $args       = explode(',', $_POST['questions']);
            $ques       = $pdo_connection->getResult('select * from questions where id IN (' . str_pad('', count($args) * 2 - 1, '?,') . ')', $args);
            $score      = [];
            foreach ($ques as $q) {
                $key    = $q['id'];
                // scores are based on what is in db Creating score array based on id
                $score[$key]  = $q['points'];
            }
        if(isset($_POST['ques'])){
            foreach ($_POST['ques'] as $key => $value) {
                if (isset($score[$value['key']])) {
                    $totalScore += $score[$value['key']];
                }
            }
        }
        if (!empty($_POST['oldAnswers'])) {
            //May be some updation in the questions
            $query = "DELETE FROM  patient_answers where medicalrecord = '" . $_POST['medicalrecord'] . "' ";
            $result = mysqli_query($pdo, $query) or die(mysqli_error());
        }
        if(isset($_POST['ques'])){
            $i = 0;
            $arr = $_POST['ques'];
            foreach($ques as $q){
                $key    = $q['id'];
                $answer = 'No';
                $points   = 0;
                if($i < count($arr)) {
                    if($arr[$i]['key'] == $key){
                        $points   = $score[$key];
                        $answer = 'Yes';
                        $i++;
                      }
                }
                $query = "INSERT INTO patient_answers (medicalrecord, question_id, answer, points)
                    VALUES(?, ?, ?, ?)";
                $pdo_connection->insert($query, [$_POST['medicalrecord'], $q['id'], $answer, $points]);
              }
        }
        $icd_nat_score = 0;
        if (empty($code_result)) {
            $query = "UPDATE patients SET firstname = '" . mysqli_real_escape_string($pdo, $_POST["firstname"]) . "',lastname='" . mysqli_real_escape_string($pdo, $_POST['lastname']) . "',medicalrecord = '" . mysqli_real_escape_string($pdo, $_POST['medicalrecord']) . "',hospital='" . mysqli_real_escape_string($pdo, $_POST['hospital']) . "' where id = " . $_POST['id'];
            $result = mysqli_query($pdo, $query) or die(mysqli_error());

            $query = "DELETE FROM  patient_icd_codes where medicalrecord = '" . $_POST['medicalrecord'] . "' ";
            $result = mysqli_query($pdo, $query) or die(mysqli_error());

            if (isset($_POST['medicalrecordinput']) && $_POST['medicalrecordinput'] != '') {
                $code = explode(',', $_POST['medicalrecordinput']);
                foreach ($code as $key => $value) {
                    $arr_icd_data = $pdo_connection->getResult('select * from icd where icd_code = ?', array($value));
                    //print_r($arr_icd_data);
                    if (count($arr_icd_data) > 0) {
                        if ($arr_icd_data[0]['icd_tertiary_ranking'] > 0) {
                            $icd_nat_score = $arr_icd_data[0]['icd_tertiary_ranking'];
                        }
                    }
                    $query = "INSERT INTO  patient_icd_codes (medicalrecord,icd_code) VALUES ('" . mysqli_real_escape_string($pdo, $_POST['medicalrecord']) . "','" . mysqli_real_escape_string($pdo, $value) . "') ";
                    $result = mysqli_query($pdo, $query) or die(mysqli_error());
                }
            }
            $totalScore += $icd_nat_score;
            echo json_encode(array("status" => 1, "msg" => ""));
        } else {
            echo json_encode(array("status" => 0, "msg" => "Medical record already exist"));
        }
        die;
    }
    public function deletePatient($pdo,$pdo_connection) {
        $result = $pdo_connection->getResult("SELECT * FROM patients where id = ?", [$_POST['id']]);
        $medicalrecord = $result[0]['medicalrecord']; 
        
        $query = "DELETE FROM  patients where id = " . $_POST['id'];
        $result = mysqli_query($pdo, $query) or die(mysqli_error());
        
        $query = "DELETE FROM patient_icd_codes where medicalrecord = '".$medicalrecord."' ";
        $result = mysqli_query($pdo, $query) or die(mysqli_error()); 
        
        echo json_encode(array("status" => 1));
        die;
    }  

}

/* $pdo = PatientController::getConnection(HOST,USERNAME,PASSWORD,DB);

  echo "<pre>";
  print_r($pdo);
  die; */

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getPatientDetail') {
    PatientController::getPatientDetail($pdo);
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'savePatient') {
    PatientController::savePatient($db, $pdo);
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'deletePatient') {
    PatientController::deletePatient($db,$pdo);
}

