<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="mx-auto container">

      <form action="place_order.php" method="post">

      <div class="form-group checkout-small-element">
            <label for="">Name</label>
            <input type="text" class="form-control" id="checkout-name" name="name" placeholder="name">

        </div>

        <div class="form-group checkout-small-element">
            <label for="">Email</label>
            <input type="email" class="form-control" id="checkout-email" name="email" placeholder="email">

        </div>

        <div class="form-group checkout-small-element">
            <label for="">Phone</label>
            <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="phone">

        </div>

        <div class="form-group checkout-large-element">
            <label for="">Address</label>
            <input type="text" class="form-control" id="checkout-address" name="address" placeholder="address">

        </div>

        <div class="form-group checkout-btn-container">
           <p>Total Amount: <?php echo "Ksh". $_SESSION['total'];   ?></p>
            <input type="submit" class="btn" id="checkout-btn" name="checkout-btn" value="checkout">

        </div>

      </form>


    </div>

</body>

</html>