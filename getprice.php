<?php include "connection.php";

$a="SELECT * FROM category WHERE AND cat_id = '".$_POST["CategoryID"]."'";
$q=mysqli_query($db, $a);
while ($record=mysqli_fetch_array($q)) {
    echo $record['cat_name'];
}
