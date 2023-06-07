<?php

session_start();

if (isset($_POST['add_to_cart'])) {

    if (isset($_SESSION['cart'])) {

        // stores all the ids of the products from the database
        $products_array_ids = array_column($_SESSION['cart'], "id");
        if (!in_array($_POST['id'], $products_array_ids)) {
            // add the products to cart
            $product_id = $_POST["id"];

            $product_array = array(
                'id' => $product_id,
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'image' => $_POST['image'],
                'quantity' => $_POST['quantity'],
            );

            $_SESSION['cart'][$product_id] = $product_array;
        } else {
            echo "<script>alert('product already added to the cart')</script>";
        }
    }


    //if the user is adding object to the cartb for the first time
    else {

        //adding product to the cart
        $product_id = $_POST["id"];

        $product_array = array(
            'id' => $product_id,
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'image' => $_POST['image'],
            'quantity' => $_POST['quantity'],
        );

        $_SESSION['cart'][$product_id] = $product_array;

    }

    // calculate the total in the cart
    total();


} else if (isset($_POST['remove-btn'])) {
    $product_id = $_POST['id'];
    unset($_SESSION['cart'][$product_id]);

    // calculate the total in the cart
    total();



} else if (isset($_POST['edit-btn'])) {
    $product_id = $_POST['id'];
    $product_quantity = $_POST['quantity'];
  
    $product = $_SESSION['cart'][$product_id];

    $product['quantity'] = $product_quantity;

    $_SESSION['cart'][$product_id] = $product;

    // calculate the total in the cart
    total();
} else {

}


function total(){

    $total_price = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $id=>$product){

        $product = $_SESSION['cart'][$id];

        $price = $product['price'];
        $quantity = $product['quantity'];

        $total_price = $total_price +($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;

}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../show/Css/cart.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="cart_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Shopping Cart<small> </small></div>


                        <div class="cart_items">

                            <?php if (isset($_SESSION['cart'])) { ?>

                                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                    <ul class="cart_list">
                                        <li class="cart_item clearfix">

                                            <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                                <div class="cart_item_name cart_info_col">
                                                    <div class="cart_item_title">Image</div>
                                                    <div class="cart_item_image"><img
                                                            src="Images/<?php echo $value["image"]; ?>"></div>
                                                </div>

                                                <!-- <div class="cart_item_name cart_info_col">
                                                    <div class="cart_item_title">Product ID:</div>
                                                    <div class="cart_item_text">
                                                        <?php echo $value["id"]; ?>
                                                    </div>
                                                </div> -->

                                                <div class="cart_item_name cart_info_col">
                                                    <div class="cart_item_title">Name</div>
                                                    <div class="cart_item_text">
                                                        <?php echo $value["name"]; ?>
                                                    </div>
                                                </div>
                                                <div class="cart_item_quantity cart_info_col">
                                                    <div class="cart_item_title">Quantity</div>


                                                    <form action="cart.php" method="post">
                                                    <input type="number" name="quantity"  value="<?php echo $value["quantity"] ?>">
                                                        <input type="hidden" name="id" value="<?php echo $value["id"]; ?>">
                                                        <input type="submit" name="edit-btn" value="edit" />
                                            
                                                    </form>
                                                </div>
                                                <div class="cart_item_price cart_info_col">
                                                    <div class="cart_item_title">Price</div>
                                                    <div class="cart_item_text">
                                                        <?php echo $value["price"] * $value['quantity']; ?>
                                                    </div>
                                                </div>



                                                <div class="cart_buttons">
                                                    <form action="cart.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $value["id"]; ?>">

                                                        <button type="submit" name="remove-btn"
                                                            class="button cart_button_checkout">Remove</button>
                                                    </form>
                                                </div>
                                            </div>


                                        </li>
                                    </ul>

                                <?php } ?>

                            <?php } ?>

                            <div class="order_total">
                                <div class="order_total_content text-md-right">
                                    <div class="order_total_title">Order Total:</div>
                                    <div class="order_total_amount">
                                        <?php if(isset($_SESSION['cart'])){  ?>

                                            <?php echo "ksh".$_SESSION['total']; ?>

                                            <?php } ?>
                                    </div>
                                </div>


                            </div>



                            <div class="cart_buttons"> <button type="button" class="button cart_button_success"> <a href="show.php">Continue Shopping</a> </button>
                        </div>

                        <div class="checkout-container">
                            <form action="checkout.php" method="get">
                                <input type="submit" value="Checkout" name="checkout-btn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>