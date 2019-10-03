<?php
require 'connection.php';
if (isset($_GET['term']['term'])) {
    $str = $_GET['term']['term'];
    $sql = "SELECT * FROM icd WHERE icd_code LIKE '%{$str}%' ORDER BY icd_code";
    $result = mysqli_query($db, $sql);
    $array = array();
    $count = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $array[$count]['text'] = $row['icd_code'];
        $array[$count]['slug'] = $row['icd_desc'];
        $array[$count]['id'] = $row['icd_code'];
        $array[$count]['icd_secondary_ranking'] = $row['icd_secondary_ranking'];
        $count++;
    }
    echo json_encode(array('items'=>$array));
}

