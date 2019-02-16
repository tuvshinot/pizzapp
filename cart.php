<?php  

include('includes/config.php'); 

if(!isset($_GET['p']) || !isset($_GET['p']) || !isset($_SESSION['userLoggedIn'])) {
  header("Location: index.php");
  exit();
}

$product_type = $_GET['p'];
$product_id = $_GET['id'];
$userEmail = $_SESSION['email'];

$query =  mysqli_query($con, "SELECT * FROM users WHERE email='$userEmail'");
$row = mysqli_fetch_array($query);
$userId = $row['id'];
$result = mysqli_query($con, "INSERT INTO cart_product VALUES ('', '$product_type', '$product_id', '$userId')");

if($result) {
  header("Location: index.php?addedToCart=true");
} else {
  header("Location: index.php?addedToCart=false");
}

?>
