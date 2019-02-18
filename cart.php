<?php
// https://www.formget.com/form-submission-using-ajax-php-and-javascript/
require 'connection.php';
// Fetching Values From URL
$name2 = $_POST['name1'];
$email2 = $_POST['email1'];
$password2 = $_POST['password1'];
$contact2 = $_POST['contact1'];

$db = mysqli_select_db("pdpm", $connection); // Selecting Database
if (isset($_POST['name1'])) {
$query = mysql_query("insert into form_element(name, email, password, contact) values ('$name2', '$email2', '$password2','$contact2')"); //Insert Query
echo "Form Submitted succesfully";
}
mysql_close($connection); // Connection Closed
?>
