<!DOCTYPE html>
<html>

<?php

function encode($string){
	$string = base64_encode($string);
	return $string;
}

$db_username = 'root';
$db_password = '';
$db_name = 'impassableareas';
$db_host = 'localhost';

$con= mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$username = mysqli_real_escape_string($con, $_POST['regUser']);
$password = mysqli_real_escape_string($con, $_POST['regPass']);
$email = mysqli_real_escape_string($con, $_POST['regMail']);

$userExists = false;
$emailExists = false;

$password = encode($password);
$sql=$con->prepare("SELECT username FROM users WHERE username='$username'");
$sql->execute();

if($sql->fetch()){
	$userExists = true;
	echo "<script type='text/javascript'>alert('User already exists!');</script>";
	header('location:register.php');
} 

$sql=$con->prepare("SELECT email_address FROM users WHERE email_address='$email'");
$sql->execute();

if($sql->fetch()){
	$emailExists = true;
	echo "<script type='text/javascript'>alert('Email address already exists!');</script>";
	header('location:register.php');
}

if($userExists == false && $emailExists == false){
	$sql=$con->prepare("INSERT INTO users (username, password, email_address) VALUES ('$username', '$password', '$email')");
	$sql->execute();
	// if (!mysqli_query($con,$sql)) {
	//   die('Error: ' . mysqli_error($con));
	// }

	header('location:index.php');
	exit();
}  
mysqli_close($con);
?>

<body>

</body>
</html>
