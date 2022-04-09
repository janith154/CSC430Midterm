<?php
	session_start();
	include('dbconnect.php');

	$status="";

	if (isset($_POST['code']) && $_POST['code']!=""){
		$code = $_POST['code'];
		$result = mysqli_query(
		$conn,
		"SELECT * FROM `products` WHERE `code`='$code'");
		$row = mysqli_fetch_assoc($result);
		$date = $row['concert_date'];
		$name = $row['concert_name'];
		$loc = $row['concert_loc'];
		$cartArray = array(
		$code=>array(
			'date'=>$date,
			'name'=>$name,
			'loc'=>$loc,
			'quantity'=>1,
			'image'=>$image)
		);

	if(empty($_SESSION["shopping_cart"])) {
	    $_SESSION["shopping_cart"] = $cartArray;
	    $status = "<div class='box'>Product is added to your cart!</div>";
	}else{
	    $array_keys = array_keys($_SESSION["shopping_cart"]);
	    if(in_array($code,$array_keys)) {
			$status = "<div class='box' style='color:red;'>
			Product is already added to your cart!</div>";	
	    } else {
		    $_SESSION["shopping_cart"] = array_merge(
		    $_SESSION["shopping_cart"],
		    $cartArray );

	    	$status = "<div class='box'>Product is added to your cart!</div>";
		}

		}
	}
?>

<!DOCtype html>
<html>
<head>
<!-- style css -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<!-- display info in cart icon-->
<?php
	if(!empty($_SESSION["shopping_cart"])) {
	$cart_count = count(array_keys($_SESSION["shopping_cart"]));
	?>
	<div class="cart_div">
	<a href="testcart.php"><img src="cart-icon.png"> Cart<span>
	<?php echo $cart_count; ?></span></a>
	</div>
	<?php
	}
?>

<!-- display products-->

<?php
	$result = mysqli_query($conn,"SELECT * FROM concert");
	while($row = mysqli_fetch_assoc($result)){
	    echo "<div class='product_wrapper'>
	    <form method='post' action=''>
	    <input type='hidden' name='date' value=".$row['concert_date']." />
	    
	    <div class='name'>".$row['concert_name']."</div>
	    <div class='loc'>$".$row['concert_loc']."</div>
	    <button type='submit' class='buy'>Buy Now</button>
	    </form>
	    </div>";
	        }
	mysqli_close($conn);
?>
<!-- <div class='image'><img src='".$row['image']."' /></div> -->
	<div style="clear:both;"></div>

	<div class="message_box" style="margin:10px 0px;">

<?php 
	echo $status; 
?>
</div>
</body>
</html>