<?php
    include('includes/config.php');
    include('includes/header.php');
    if(!empty($_GET['p']) && !empty($_GET['id'])) {
        
        $id = $_GET['id'];
        $type = $_GET['p'];

        $query = mysqli_query($con, "SELECT * FROM $type where id='$id'");
        if(mysqli_num_rows($query) == 0) {
            echo "
            <div class='alert alert-danger' role='alert'>
               Product not found!!!
            </div>
            ";
        } else {
            while($row = mysqli_fetch_array($query)) {
                echo
                "
                <div class='col-md-3' style='margin: 20px auto;'>
                    <div class='shadow-none p-3 mb-4 bg-muted rounded'>
                        <img class='card-img-top' alt='Pizza [100%x225]' style='height: 225px; width: 100%; display: block;' src='" . $row['image'] . "'>
                        <div class='card-body'>
                            <p class='card-text lead text-dark'>
                                " . $row['name'] . ' with ' .  $row['gredient'] . "   
                            </p>
                            <div class='d-flex justify-content-between align-items-center'>
                                <a href='#' class='btn btn-warning my-3 border'>To card</a>
                            <small class='text-danger text-center'><strong>" . $row['price'] . "$</strong></small>
                            
                            <small class='text-dark text-right'>". $row['weight'] ."g</small>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
        }

    } else {
        header('HTTP/1.0 404 Not Found');
    }
    include('includes/footer.php');
?>
