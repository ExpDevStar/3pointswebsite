<?php
	// remove $DB and swap with PDO
	$db         = mysqli_connect('localhost', 'root', '', 'pdpm');
	// require 'connection.php';
	// $db = new DbConnect;
	$codelist    = $_GET['codelist'];

	$sql        = "SELECT icd_code FROM icd WHERE icd_code like '$codelist%' ORDER BY icd_code";

	$res        = $db->query($sql);

	if(!$res)
		echo mysqli_error($db);
	else
		while( $row = $res->fetch_object() )
			echo "<option value='".$row->icd_code."'>";

?>
</option>
