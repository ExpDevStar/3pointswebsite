<?php
// $icd_code
function checkUser($username)
{
	global $db;

	$query = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

	if(mysqli_num_rows($query) > 0)
	{
		return 'true';
	}else
	{
		return 'false';
	}
}

function UserID($email)
{
	global $db;

	$query = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
	$row = mysqli_fetch_assoc($query);

	return $row['id'];
}

function get_icd_ids($icd_list){
  $length = count($icd_list);
  $icd_ids = [];
  for ($i = 0; $i < $length; $i++) {
    $query = mysqli_query($db, "SELECT * FROM icd WHERE icd_code = '$icd_code'");
    $row = mysqli_fetch_assoc($query);
    $icd_id=$row['icd_id'];
    array_push($icd_ids, $icd_id);
  }
  return $icd_ids;
}
function save_icd($icd_ids, $user_id){
  $length = count($icd_ids);
  $inserts = [];
  $save_date = date("Y-m-d H:i:s");
  for ($i = 0; $i < $length; $i++) {
    $insert = "('$icd_ids[$i]', '$user_id', '$save_date')";
    array_push( $inserts, $insert );
  }
  $query = mysqli_query("INSERT INTO save (`icd_id`, `user_id`, `save_date`) VALUES "
      .implode(",",$inserts));
  if ($query) {
    return true;
  }else {
    return false;
  }
}
?>
