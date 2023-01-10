<?php 
include_once('server/connection.php');
$errors	= array();

	if (isset($_POST['signin'])) {

	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($connection, $query);

		if (mysqli_num_rows($results) == 1) { 
			$usertypes = mysqli_fetch_array($results);
			if ($usertypes['position'] == 'Admin') {
				$_SESSION['username'] = $username;
				$insert	= "INSERT INTO logs (username, purpose) VALUES('$username', 'Login')";
				$logs = mysqli_query($connection, $insert);
				header('location: dashboard.php');		  
			}else if ($usertypes['position'] == 'Head Admin') {
				$_SESSION['username'] = $username;
				$insert	= "INSERT INTO logs (username, purpose) VALUES('$username', 'Login')";
				$logs = mysqli_query($connection, $insert);
				header('location: dashboard.php');		  
			}else{
				$_SESSION['username'] = $username;
				$insert	= "INSERT INTO logs (username, purpose) VALUES('$username', 'Login')";
				$logs = mysqli_query($connection, $insert);
				header('location: pos.php');
			}
		}else {
			array_push($errors, "Wrong username or password");
		}
	}
}
