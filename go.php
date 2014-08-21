<<!DOCTYPE html>
<html>

<?php

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

$sql="INSERT INTO users (username, password, email_address) VALUES ('$username', '$password', '$email')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

mysqli_close($con);

?>

<script>

window.location = "index.php";

</script>
<body>

</body>
</html>
