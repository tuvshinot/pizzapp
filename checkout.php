<?php  
     include('includes/config.php');
     if(!isset($_SESSION['userLoggedIn'])) { header("Location: index.php"); }

    $userEmail = $_SESSION['email'];
    $query =  mysqli_query($con, "SELECT * FROM users WHERE email='$userEmail'");
    $row = mysqli_fetch_array($query);
    $userId = $row['id'];
    
    $cartQuery = mysqli_query($con, "SELECT * FROM cart_product WHERE user_id='$userId'");
    $cartItemCount = mysqli_num_rows($cartQuery);
    $total = 0;

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <!-- custum css -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <!-- icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Cart</title>
    <!-- Bootstrap core CSS -->
<link href="/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- Custom styles for this template -->
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-1 text-center">
    <h1 class="text-danger">Cart</h1>
    <p class="lead">Check your food before payment </p>
    <p>User LoggedIn : <?php if(isset($_SESSION['userLoggedIn'])) { echo $_SESSION['email']; } ?></p>
  </div>

  <div class="row">
    <div class="col-md-6 order-md-2 mb-4" style='margin:50px auto;'>
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-danger">Your cart items</span>
        <span class="badge badge-danger badge-pill"><?php echo $cartItemCount; ?></span>
      </h4>
      <ul class="list-group mb-3">
        <?php
            while($row = mysqli_fetch_array($cartQuery)) {
                $cartProdType = $row['type'];
                $cartProdId = $row['product_id'];
                $prodQuery =  mysqli_query($con, "SELECT * FROM $cartProdType WHERE id='$cartProdId'");
                $prod = mysqli_fetch_array($prodQuery);
                $total += $prod['price'];
                echo "
                    <li class='list-group-item d-flex justify-content-between lh-condensed'>
                        <div>
                            <h6 class='my-0'>" . $prod['name'] . "</h6>
                            <small class='text-muted'>" . $prod['weight'] . 'g' . "</small>
                        </div>
                        <span class='text-danger'>$". $prod['price'] ."</span>
                    </li>
                ";
            }
            
        ?>
        <li class="list-group-item d-flex justify-content-between text-danger">
          <span>Total (USD)</span>
          <strong>$<?php echo $total; ?> <i class="fas fa-check-circle"></i></strong>
        </li>
      </ul>

      <button type="button" class="btn btn-primary" style="margin: 0 33%;width: 200px;">Checked</button>
      <a href="checkout.php?paid=true"><button type="button" class="btn btn-success" style="display:none;margin: 0 33%;width: 200px;">Pay</button></a>
    </div>
  </div>
    <!-- Dummy payment for empthying cart -->
    <?php
        if(isset($_GET['paid'])) {
            $query = mysqli_query($con, "DELETE FROM cart_product WHERE user_id='$userId'");
            header("Location: index.php");
        }
    ?>


  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-2018 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>

<script>
  $( ".btn-primary").click(function() {
      $(this).hide();
      $(".btn-success").show();
      $(".fa-check-circle").css("color", "green");
  });
</script>     
</body>
</html>