<?php 
    include('includes/config.php'); 
    include('includes/header.php');
    include('includes/classes/Constants.php');
    include('includes/classes/Account.php');
    $account = new Account($con);
    // get input value when form reload
	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
    }
    
	function sanitizeFormPassword($inputText) {
		$inputText = strip_tags($inputText); // replace all html tags on input
		return $inputText;
	}
	function sanitizeFormString($inputText) {
		$inputText = strip_tags($inputText); // replace all html tags on input
		$inputText = str_replace(" ", "", $inputText);
		$inputText = ucfirst(strtolower($inputText)); // first to lower and first to upper
		return $inputText;
    }
	if(isset($_POST['signup'])) {
		//Resgister pressed
		$email = sanitizeFormString($_POST['email']);
		$address = sanitizeFormString($_POST['address']);
		$phone = sanitizeFormString($_POST['phone']);
		$password = sanitizeFormPassword($_POST['password1']);
        $password2 = sanitizeFormPassword($_POST['password2']);
        
        $wasSuccesful = $account->register($email, $address, $phone, $password, $password2);
        
        if($wasSuccesful) {
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['email'] = $email;
            header("Location: index.php");
        }
    }
    
    
    if(isset($_POST['login'])) {
    //log in button press
        $email = $_POST['email'];
        $password = $_POST['password'];
        
    // Log in function
        $result = $account->login($email, $password);
        if($result) {
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['email'] = $email;
            header("Location: index.php");
        } 
    }
      
    include("components/form.php");    
    //  pizza render 
    include('includes/products/pizza.php');
    //  burger render 
    include('includes/products/burger.php');
    //  desert render 
    include('includes/products/desert.php');
   

include('includes/footer.php'); 

// toggle add to cart btn
if(!isset($_SESSION['userLoggedIn'])){
    echo 
    '<script>
        $(".addToCart").hide();
        $(".openForm").show();
    </script>';
} else {
    echo 
    '<script>
        $(".openForm").hide();
        $(".addToCart").show();
    </script>';
}

?>
