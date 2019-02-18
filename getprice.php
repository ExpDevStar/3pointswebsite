<?php include "connection.php";

$a="SELECT * FROM icd WHERE icd_code = '".$_POST["icd_code"]."' AND cat_id = '".$_POST["cat_id"]."'";
$q=mysqli_query($db, $a);
while ($record=mysqli_fetch_array($q)) {
    echo $record['price'];
}
