<?php

session_start();

include('connection.php');

if(isset($_POST['checkout_btn'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $order_date = date("Y-m-d");

    $conn->prepare("INSERT INTO orders (order_cost,order_status,user_name,user_email,user_phone,user_address,order_date) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("isssiss", $order_cost,$order_status,$name,$email,$phone,$address,$order_date);

    if($stmt->execute()){
        header("location: index.php");
        exit;
    }

    $order_id = $stmt->insert_id;

    foreach($_SESSION['cart'] as $id=>$product){

        $product = $_SESSION['cart']['$id'];
        $product_id = $_SESSION['cart']['id'];
        $product_name = $_SESSION['cart']['name'];
        $product_image = $_SESSION['cart']['image'];
        $product_price = $_SESSION['cart']['price'];
        $product_quantity = $_SESSION['cart']['quantity'];

        $stmt1 = $conn->prepare("INSERT INTO order_items(order_id,product_id,product_name,product_image,product_price,product_quantity,user_name,order_date) VALUES (?,?,?,?,?,?,?,?)");
        $stmt1->bind_param("iissiiss", $order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$name,$order_date);
        $stmt1->execute();
    }
    

    // store the order details
    $_SESSION['order_id'] = $order_id;

    // send user for payment

    header("location: payment.php");
}

?>