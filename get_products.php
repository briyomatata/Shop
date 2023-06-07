<?php 

include('connection.php');

$stmt= $conn->prepare("SELECT * FROM goods");
$stmt->execute();
$products=$stmt->get_result();

echo $products;




?>