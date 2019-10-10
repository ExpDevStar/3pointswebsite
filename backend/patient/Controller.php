<?php

require_once __DIR__ . "/../../connection.php";

class PatientController {
    /* public function getConnection($HOST,$USERNAME,$PASSWORD,$DB) {
      $db = new mysqli($HOST,$USERNAME,$PASSWORD,$DB);
      return $pdo = new DbConnect();
      } */

    public function getEditModal() {
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
                        <div id="code_result"></div>

                        <div class="form-group">
                          <label>Hospital:</label>
                          <input type="text" class="form-control" id="hospital" readonly="">
                        </div>
                        
                        <input type="hidden" name="patient_id" id="patient_id">
                        <input type="hidden" name="medicalrecordinput" id="medicalrecordinput" value="">
                        <input type="hidden" name="customsorting" id="customsorting" value="">
                        <button type="button" class="btn btn-primary submitPatient">Submit</button>
                    </div>
                </div>
            </div>
        </div>';
    }

    public function getPatientDetail($pdo) {
        $result = $pdo->getResult("SELECT * FROM patients where id = ?", [$_POST['id']]);

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

        $data['data'] = $result;
        $data['code_result'] = $sortable_html;
        $data['medicalrecordinput'] = $code;
        echo json_encode($data);
        die;
    }

    public function savePatient($pdo, $pdo_connection) {

        $check_medical_record = " SELECT * FROM patients WHERE medicalrecord = '" . $_POST['hospital'] . "' AND id != " . $_POST['id'] . " ";
        $code_result = $pdo_connection->getResult($check_medical_record);

        if(empty($code_result)) { 
            $query = "UPDATE patients SET firstname = '" . mysqli_real_escape_string($pdo,$_POST["firstname"]) . "',lastname='" . mysqli_real_escape_string($pdo,$_POST['lastname']) . "',medicalrecord = '" . mysqli_real_escape_string($pdo,$_POST['medicalrecord']) . "',hospital='" . mysqli_real_escape_string($pdo,$_POST['hospital']) . "' where id = " . $_POST['id'];
            $result = mysqli_query($pdo, $query) or die(mysqli_error());

            $query = "DELETE FROM  patient_icd_codes where medicalrecord = '" . $_POST['medicalrecord'] . "' ";
            $result = mysqli_query($pdo, $query) or die(mysqli_error());

            if (isset($_POST['medicalrecordinput']) && $_POST['medicalrecordinput'] != '') {
                $code = explode(',', $_POST['medicalrecordinput']);
                foreach ($code as $key => $value) {
                    $query = "INSERT INTO  patient_icd_codes (medicalrecord,icd_code) VALUES ('" . mysqli_real_escape_string($pdo,$_POST['medicalrecord']) . "','" . mysqli_real_escape_string($pdo,$value) . "') ";
                    $result = mysqli_query($pdo, $query) or die(mysqli_error());
                }
            }
            echo json_encode(array("status" => 1,"msg"=>"")); 
        } else { 
            echo json_encode(array("status" => 0,"msg"=>"Medical record already exist"));
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

