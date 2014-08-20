<?php

$db_username = 'root';
$db_password = '';
$db_name = 'routee';
$db_host = 'localhost';

$con= mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
<<<<<<< HEAD
$username = mysqli_real_escape_string($con, $_POST['regUSer']);
$password = mysqli_real_escape_string($con, $_POST['regPass']);
$email = mysqli_real_escape_string($con, $_POST['regMail']);

$sql="INSERT INTO member (username, password, email
VALUES ('$username', '$password', '$email')";
=======
$username = mysqli_real_escape_string($con, $_POST['regUser']);
$password = mysqli_real_escape_string($con, $_POST['regPass']);
$email = mysqli_real_escape_string($con, $_POST['regMail']);

$sql="INSERT INTO routee.members (username, password, email)
VALUES ('$username','$password','$email')";
>>>>>>> f9e0624e4392a2158529991289fd21ed49a284eb

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);

?>