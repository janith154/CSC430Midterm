<?php
	session_start();
	include "dbconnect.php";
	//Returns user to sign in page if not set.
	if(!isset($_SESSION['username'])){
		header("Location: signin.html");
	}
?>

<!DOCTYPE html>
<html>
<body>
	<?php echo "<h2>Welcome ," . $_SESSION['username'] . "!</h2><br>"; ?>
	<?php 

<a href="logout.php">Logout</a>

<?php
	$user = $_SESSION['username'];
	$accountIDsql = "SELECT a.account_ID from account as a WHERE username = ?";
	$stmt = $conn->prepare($accountIDsql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows> 0){
            $row = $stmt_result->fetch_assoc();
            $UID = $row['account_ID'];
            $stmt->close();

            $userOrders = "SELECT * FROM orders as o WHERE o.account_ID = ?";
            $stmt2 = $conn->prepare($userOrders);
            $stmt2->bind_param("i", $UID);
            $stmt2->execute();
            $stmt_result2 = $stmt2->get_result();
            if($stmt_result2->num_rows > 0){
            	while($rows = $results->fetch_assoc()) {
            		echo $rows['order_ID'] . " ";
            		$rows ['account_ID'];
            		echo "$" . $rows['order_total'] . " ". $rows['order_date'] . "<br>";
            	}
            } else {
            	echo "There are currently no orders for this account.";
            }
        }


   mysqli_close($conn);
?>
<body>
</html>