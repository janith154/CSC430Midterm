<?php
  session_start();
  include "dbconnect.php";
  //Returns user to sign in page if not set.
  if(!isset($_SESSION['username'])){
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
  <title>Concerts</title>
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
<script>
function openTabs(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }
</script>
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
</head>
<!-- body -->

<body class="main-layout">
    
  <!-- loader  -->
  <div class="loader_bg">
    <div class="loader"><img src="images/loading.gif" alt="#" /></div>
  </div>
  <!-- end loader -->
  <!-- header -->
  <header>
    <!-- header inner -->
    <div>
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

     
</header>

<!-- Tab links -->
<div class="tab">
    <button class="tablinks" onclick="openTabs(event, 'Account Info')" id = "defaultOpen">Account Info</button>
    <button class="tablinks" onclick="openTabs(event, 'Orders')">Orders</button>
    <button class="tablinks" onclick="openTabs(event, 'Payment Info')">Payment Info</button>
    <button class="tablinks" onclick="openTabs(event, 'Logout')"><a href="logout.php">Logout</a></button>
  </div>
  
  <!-- Tab content -->
  <div id="Account Info" class="tabcontent">
    <h3>Account Information</h3>
    <p>
      <?php echo "<h2>Welcome, " . $_SESSION['username'] . "!</h2><br>";
          $user = $_SESSION['username'];
          $accEmail = "SELECT a.email FROM account as a WHERE username = ?";
          $stmtE = $conn->prepare($accEmail);
          $stmtE->bind_param("s", $user);
          $stmtE->execute();
          $stmtE_result = $stmtE->get_result();
          if($stmtE_result->num_rows>0){
            $emRow = $stmtE_result->fetch_assoc();
            echo "Your current email is " . $emRow['email']; 
          }
          $stmtE->close();
      ?>
    </p>
  </div>
  
  <div id="Orders" class="tabcontent">
    <h3>Your Past Orders</h3>
    <p>
      <table>
        <th>Order Number</th>
        <th>Price</th>
        <th>Order Date</th>
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
            $accountID = intval($UID);
            
            $userOrders = "SELECT o.order_ID, o.order_total, o.order_date FROM orders as o WHERE o.account_ID = ?";
            $stmt2 = $conn->prepare($userOrders);
            $stmt2->bind_param('i', $accountID);
            $stmt2->execute();
            $stmt_result2 = $stmt2->get_result();
            if($stmt_result2->num_rows > 0){
              while($rows = $stmt_result2->fetch_assoc()) {
                echo "<tr><td>" . $rows['order_ID'] . "</td><td>$" . $rows['order_total'] . "</td><td>" . $rows['order_date'] . '</td><td><button type="submit"><a href="refund.php?order_ID='.$rows['order_ID'].' ">Refund</a></button></td></tr>';
              }
            } else {
              echo "There are currently no orders for this account.";
            }   
        }
      ?>
      </table>
      </p>
  </div>
  
  <div id="Payment Info" class="tabcontent">
  <h3>Payment Information</h3>
    <p>
      <?php 
          $user = $_SESSION['username'];
          $accCredit = "SELECT a.credit_info FROM account as a WHERE a.username = ?";
          $stmtC = $conn->prepare($accCredit);
          $stmtC->bind_param("s", $user);
          $stmtC->execute();
          $stmtC_result = $stmtC->get_result();
          if($stmtC_result->num_rows>0){
            $cRow = $stmtC_result->fetch_assoc();
            $credit_info = $cRow['credit_info'];
            echo "Your current payment on file is XXXX-XXXX-" . substr($credit_info, -4); 
          }
          $stmtC->close();
          mysqli_close($conn);
      ?>
    </p>
  </div>

  <script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

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
                            <li><a href="#">Linkedin</a> </li>
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
