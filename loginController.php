<!DOCTYPE html>
<html>

<?php
	session_start();
	echo isset($_SESSION['username']);
	function decode($string){
		$string = base64_decode($string);
		return $string;
	}

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
	if ($_POST) {
	    

	    if(isset($_POST["loginUser"])){
	    	$username = mysqli_real_escape_string($con, $_POST['loginUser']);
	    } 
	    if(isset($_POST["loginPass"])){
			$password = mysqli_real_escape_string($con, $_POST['loginPass']);
		}
		$loginSuccessful = false;
		$password = encode($password);
		$query = "SELECT username, password FROM users WHERE username = '$username' AND password = '$password'";
		if($stmt = $con->prepare($query)){
			$stmt->execute();

			$stmt->bind_result($username1, $password1);
			if($stmt->fetch()){
				$loginSuccessful = true;
				$_SESSION['username'] = $username;
				echo "<script type='text/javascript'>alert('Login successful!');</script>";
				header('location: index.php');
				exit();
			} else {
				echo "<script type='text/javascript'>alert('Invalid username/password');</script>";
				header('location: index.php');
			}
			$stmt->close();
		}
		mysqli_close($con);
		exit();
	}
?>

<body>

</body>
</html>