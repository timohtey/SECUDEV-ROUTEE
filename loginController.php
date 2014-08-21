<!DOCTYPE html>
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
	if ($_POST) {
	    

	    if(isset($_POST["loginUser"])){
	    	$username = mysqli_real_escape_string($con, $_POST['loginUser']);
	    } 
	    if(isset($_POST["loginPass"])){
			$password = mysqli_real_escape_string($con, $_POST['loginPass']);
		}

		$query = "SELECT username, password FROM users";
		if($stmt = $con->prepare($query)){
			$stmt->execute();

			$stmt->bind_result($username1, $password1);
			while($stmt->fetch()){
				if($username == $username1 && $password == $password1){
					header('Login successful!');
        			exit();
				} 
			}
			$stmt->close();
		}
		mysqli_close($con);
		header('HTTP/1.1 500 Error:Login not successful!');
		exit();
	}
?>

<body>

</body>
</html>