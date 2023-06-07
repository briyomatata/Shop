<?php

require_once 'connection.php';

$sql = "SELECT * FROM goods";
$products = $conn->query($sql);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="Css/shop.css">
</head>
<body>

<main>



<!-- code for displaying products in the template -->
<?php
while($row = mysqli_fetch_assoc($products)){
?>
    <div class="card">
        <div class="image">
            <img src="Images/<?php echo $row["image"]; ?>" alt="">
        </div>
        <div class="caption">
            <p class="rate">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </p>
            <p class="product_name"><?php echo $row["name"]; ?></p>
            <p class="price"><b><?php echo $row["price"]; ?></b></p>
            <p class="category"><b><?php echo $row["category"]; ?></b></p>
            <p class="discount">  <?php echo $row["description"]; ?> </p>
            <!-- <button class="add"> <a  href="">Add to Cart</a></button> -->

            <form action="cart.php" method="post">
                <input type="hidden" name="id" value ="<?php echo $row["id"]; ?>"/>
                <input type="hidden" name="name" value ="<?php echo $row["name"]; ?>"/>
                <input type="hidden" name="price" value ="<?php echo $row["price"]; ?>"/>
                <input type="hidden" name="image" value ="<?php echo $row["image"]; ?>"/>
                <input type="hidden" name="quantity" value ="1"/>
                <input type="submit" name="add_to_cart" value="order">
    
        
            </form>
        </div>
    </div><?php
    }
    ?>
</main>
    
</body>
</html>