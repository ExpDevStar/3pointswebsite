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

function get_save_ids($user_id){
  global $db;

  $result = mysqli_query($db, "SELECT * FROM save WHERE user_id = '$user_id'");
  return $result;
}
?>
