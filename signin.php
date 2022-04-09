<?php
    session_start();

     $username = $_POST['username'];
     $password = $_POST['password'];

     $_SESSION['username'] = $username;

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
                header("Location: account.php");
            }else {
                echo "<h2> Invalid Email or Password.</h2>";
            }
        }
        $stmt->close(); 
    }

    mysqli_close($conn);
?>