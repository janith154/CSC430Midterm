<?php
	session_start();
	include ('dbconnect.php');
	
	$orderID = $_GET['order_ID'];

	if(isset($_SESSION['username'])){
		$user = $_SESSION['username'];
		$getAID = "SELECT account_ID FROM account WHERE username = ?";
		$query = $conn->prepare($getAID);
		$query->bind_param('s', $user);
		$query->execute();
		$result = $query->get_result();
		$AID = $result->fetch_row();
	} else {
		header("Location: signin.html");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>Refund</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- bootstrap css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">  
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
  <!-- loader  -->
  <div class="loader_bg">
    <div class="loader"><img src="images/loading.gif" alt="#" /></div>
  </div>
  <!-- end loader -->
  <!-- header -->
  <header>
    <!-- header inner -->
      <div class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-3 col logo_section">
              <div class="full">
                <div class="center-desk">
                  <div class="logo">
                    <a href="index.php"><img src="images/headphones-svg-png-icon-download-32.png" width="50" 
                      height="50" alt="#" /></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-9">
         
               <div class="menu-area">
                <div class="limit-box">
                  <nav class="main-menu ">
                    <ul class="menu-area-main">
                      <li class="active"> <a href="index.php">Home</a> </li>
                      <li> <a href="#about">About</a> </li>
                      <li> <a href="#concerts">Concerts</a> </li>
                      <li> <a href="#testimonial">Testomonial</a> </li>
                      <li> <a href="#contact">Contact Us</a> </li>
                      <li> <a href= "signin.html">Sign In / Sign Up</a> </li>
                     
                     <li> <a href="#"><img src="icon/icon_b.png" alt="#" /></a></li>
                     </ul>
                   </nav>
                 </div>
               </div> 
              </div>
           </div>
         </div>
       </div>
     </div>
     <!-- end header inner -->
     

     <!-- end header -->

<!-- contact -->
<div id="contact" class="contact">
    <div class="container">
     <div class="row">
       <div class="col-md-12">
                  <div class="titlepage">
                    <h2>Refund</h2>
                  </div>
     </div>
  
  </div>
      <div class="whit_ecolor">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12">
              <!-- <form class="contact_bg" action="refundconfirmation.php" method="post"> -->
                <table>
                    <tr>
                        <th>Order Number</th>
                        <th>Price</th>
                        <th>Order Date</th>
                    </tr>
                    <?php 
                        $query = "SELECT o.order_total, o.order_date FROM orders as o WHERE o.order_ID = $orderID";
                        $result = mysqli_query($conn, $query);

                        if($result->num_rows > 0){
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr><td>' . $orderID . '</td><td>' . $row['order_total'] . '</td><td>' . $row['order_date'] . '</td></tr>';
                                $price = $row['order_total'];
                            }
                        }
                    ?>
                </table><br><br>
                <p style="text-align:right">
                    <b>Total :</b> <?php echo $price ?> 
                    <?php echo "<button name='refund' type='submit' value='refund'><a href='refundconfirmation.php?order_ID='.$orderID.>Confirm Refund</button>" ?> 
			    </p>
              <!-- </form> -->
           </div>
        </div>
      </div>
     </div>
  
        </div>
      </div>
  </div>
  </div>
      <!-- end contact -->

    <!--  footer -->
    <footr>
      <div class="footer ">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
             <a href="#" class="logo_footer"> <img src="images/headphones-svg-png-icon-download-32.png" width="50" height ="50" alt="#"/></a>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ">
                  <div class="address">
                    <h3>Address </h3>
                    <ul class="loca">
                      <li>
                        <a href="#"></a>It is a long established fact 
                        <br>that a reader will be  </li>
                        <li>
                          <a href="#"></a>(+71 1234567890) </li>
                          <li>
                            <a href="#"></a>demo@gmail.com</li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="address">
                          <h3>Social Link</h3>
                          <ul class="Menu_footer">
                            <li class="active"> <a href="#">Twitter</a> </li>
                            <li><a href="#">Facebook</a> </li>
                            <li><a href="#">Instagram</a> </li>
                            <li><a href="#">Linkdin</a> </li>
                          </ul>
                        </div>
                      </div>
                     

                      <div class="col-lg-4 col-md-6 col-sm-6 ">
                        <div class="address">
                          <h3>Newsletter</h3>
                           <form class="news">
                           <input class="newslatter" placeholder="Enter your email" type="text" name=" Enter your email">
                            <button class="submit">Subscribe</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
              <div class="copyright">
                <div class="container">
                  <p>Copyright © 2019 Design by <a href="https://html.design/">Free Html Templates </a></p>
                </div>
              </div>
            </div>
          </footr>
          <!-- end footer -->
          <!-- Javascript files-->
          <script src="js/jquery.min.js"></script>
          <script src="js/popper.min.js"></script>
          <script src="js/bootstrap.bundle.min.js"></script>
          <script src="js/jquery-3.0.0.min.js"></script>
          <script src="js/plugin.js"></script>
          <!-- sidebar -->
          <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
          <script src="js/custom.js"></script>
          <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>

</html>