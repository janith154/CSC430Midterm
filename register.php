<?php
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

	if(isset($_POST['submit'])){
		if(!empty($email) && !empty($name) && !empty($username) && !empty($password) && !empty($address) && !empty($state) && !empty($zip) && !empty($credit_info) && !empty($credit_cvv)) {

			$query = "insert into account (email, name, username, password, address,zip,state,credit_info,credit_cvv) values ('$email','$name','$username','$password','$address','$state','$zip','$credit_info','$credit_cvv')";
			
			mysqli_query($conn,$query);

			header("Location: signin.html");
		}
	}
	else {
		echo "All fields required.";
	}
	mysqli_close($conn);
?>