<?php include "connection.php";

$a="SELECT * FROM serviceprice WHERE itemTypeID = '".$_POST["ItemTypeID"]."' AND treatmentID = '".$_POST["TreatmentID"]."'";
$q=mysqli_query($db, $a);
while ($record=mysqli_fetch_array($q)) {
    echo $record['price'];
}
