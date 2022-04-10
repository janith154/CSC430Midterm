<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "concertticketsalessystem";

	
	$conn = mysqli_connect($server,$username,$password,$dbname);
	if($conn->connect_error){
		die("Connection Failed: " . $conn->connect_error);
	}
	
	$email = $_POST['email'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$address = $_POST['address'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$credit_info = $_POST['credit_info'];
	$credit_cvv = $_POST['credit_cvv'];

	//Username Query
	$stmt = $conn-> prepare("select * from account where username = ?");
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$stmt_result = $stmt->get_result();

	//Email query
	$stmt1 = $conn-> prepare("select * from account where email = ?");
	$stmt1->bind_param("s", $email);
	$stmt1->execute();
	$stmt_result1 = $stmt1->get_result();

	//Check for username or email taken
	if($stmt_result->num_rows > 0 || $stmt_result1->num_rows > 0){
		if ($stmt_result->num_rows > 0){
			$_SESSION['errUsernameMsg'] = "Username Taken";
		}
		if ($stmt_result1->num_rows > 0){
        	$_SESSION['errEmailMsg'] = "Email Taken";
		}
		include('signup.html');
	}
	else if(isset($_POST['submit'])){
		if(!empty($email) && !empty($name) && !empty($username) && !empty($password) && !empty($address) && !empty($state) && !empty($zip) && !empty($credit_info) && !empty($credit_cvv)) {
			
			$query = "insert into account (email, name, username, password, address,zip,state,credit_info,credit_cvv) values ('$email','$name','$username','$password','$address','$state','$zip','$credit_info','$credit_cvv')";
			
			mysqli_query($conn,$query);

			header("Location: signin.html");
		}
		else {
			$_SESSION['errFieldMsg'] = "All fields required.";
			include('signup.html');
		}
	}
	mysqli_close($conn);
?>