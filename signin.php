<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

     $username = $_POST['username'];
     $password = $_POST['password'];

	$conn = mysqli_connect("localhost","root","","concertticketsalessystem");
	if($conn->connect_error){
		die("Connection Failed: " . $conn->connect_error);
	} else {
        $stmt = $conn-> prepare("select * from account where username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows> 0){
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password){
                echo "<h2> Login Sucessful!</h2>";
                $_SESSION['username'] = $username;
                header("Location: account.php");
            }else {
                $_SESSION['errMsg'] = "Invalid username or password";
                include('signin.html');
            }
        }
        else{
            $_SESSION['errMsg'] = "Invalid username or password";
            include('signin.html');
        }
        $stmt->close(); 
    }

    mysqli_close($conn);
?>