<div class="container bg-muted">
        <h1 class="jumbotron-heading text-danger" id="pizza">Pizza</h1>
        <p class="lead text-dark my-4">
            <strong>The only love triangle I need is a pizza!</strong>

        </p>
        
    </div>
    <div class="album py-1 bg-muted">
      <div class="container">
        <div class="row">

<?php
$query = mysqli_query($con, "SELECT * FROM pizza ORDER BY name");

while($row = mysqli_fetch_array($query)) {
    $words_arr = explode(" ", $row['gredient']);
    $part = implode(" ", array_splice($words_arr, 0, 2)). "...";

    echo
    "
    <div class='col-md-3'>
        <div class='shadow-none p-3 mb-4 bg-muted rounded'>
            <img class='card-img-top' alt='Pizza [100%x225]' style='height: 225px; width: 100%; display: block;' src='" . $row['image'] . "'>
            <div class='card-body'>
                <p class='card-text lead text-dark'>
                    " . $row['name'] . ' with ' .  $part . "<a href='product.php?p=pizza&id=" . $row['id'] . "'><i class='fas fa-arrow-circle-right'></i></a>   
                </p>
                <div class='d-flex justify-content-between align-items-center'>
                    <a href='cart.php?p=pizza&id=". $row['id'] ."' class='addToCart btn btn-warning my-3 border'>To card</a>
                    <a class='openForm btn btn-warning my-3 border' data-toggle='modal' data-target='#exampleModal' style='cursor:pointer;'>
                        To Cart
                    </a>
                <small class='text-danger text-center'><strong>" . $row['price'] . "$</strong></small>
                
                <small class='text-dark text-right'>". $row['weight'] ."g</small>
                </div>
            </div>
        </div>
    </div>
    ";
}


?>
        </div>
      </div>