<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="http://www.stickpng.com/assets/images/5842997fa6515b1e0ad75adf.png" type="image/png">
    <!-- icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>PizzaSlava</title>
  </head>
  <body>
      <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <a class="navbar-brand" href="#">
      <img src="http://www.stickpng.com/assets/images/5842997fa6515b1e0ad75adf.png" alt="logo" width="85" height="85">
      
       </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
      <span class="navbar-toggler-icon"> </span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                  </a>
                  <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                    
                    <a class="dropdown-item text-light" href="#burgers">Burgers</a>
                    <div class="dropdown-divider"></div>                   
                    <a class="dropdown-item text-light" href="#deserts">Deserts</a>
                    <div class="dropdown-divider"></div>                   
                    <a class="dropdown-item text-light" href="#pizza">Pizza</a>
                  </div>
                </li>
            </li>          
          </ul>
          <?php 
              if(isset($_SESSION['userLoggedIn'])) {
                $userEmail = $_SESSION['email'];
                $query =  mysqli_query($con, "SELECT * FROM users WHERE email='$userEmail'");
                $row = mysqli_fetch_array($query);
                $userId = $row['id'];
                $cartQuery = mysqli_query($con, "SELECT * FROM cart_product WHERE user_id='$userId'");
                $cartItemCount = 0;
                if(mysqli_num_rows($cartQuery) != 0) {
                  $cartItemCount = mysqli_num_rows($cartQuery);
                }
                 echo "
                    <a href='checkout.php' class='nav-link text-white' style='cursor:pointer;font-size: 21px;font-weight: 500;letter-spacing: 1px;'>
                    <i class='fas fa-shopping-cart'></i> : " . $cartItemCount . " <i class='fas fa-external-link-alt'></i>
                    </a>
                 ";
              }
            ?>
          <?php 
              if(!isset($_SESSION['userLoggedIn'])) {
                 echo "
                    <a class='nav-link text-white' data-toggle='modal' data-target='#exampleModal' style='cursor:pointer;font-size: 21px;font-weight: 500;letter-spacing: 1px;'>
                    Login
                    <i class='fas fa-sign-in-alt'></i>
                    </a>
                 ";
              } else { 
                echo "
                    <a class='nav-link text-white' style='cursor:pointer;font-size: 21px;font-weight: 500;letter-spacing: 1px;' href='logout.php'>
                      Log out
                      <i class='fas fa-sign-out-alt'></i>
                    </a>
                ";
              }  
            ?>
        </div>
    </a>
  </nav>
</header>
  <main role="main">
  <section class="jumbotron text-center bg-transparent">