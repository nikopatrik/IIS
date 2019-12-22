<?php
include_once "dbConfig.php";
session_start();


if(!isset($_SESSION['email'])){
    $new_user = $pdo->prepare("INSERT INTO users(user_email,user_type, user_password) VALUES (?,'N','nothing')");
    $guid = uniqid('non_registered_') . "@nonregistered.xx";
    $new_user->execute([$guid]);
    $_SESSION['email'] = $guid;
}


$number_of_order = -1;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }

    if(isset($_POST['email'])){
        $email= $_POST['email'];
    }

    if(isset($_POST['phone_number'])){
        $phone_number= $_POST['phone_number'];
    }

    if(isset($_POST['street'])){
        $street= $_POST['street'];
    }

    if(isset($_POST['street_number'])){
        $street_number= $_POST['street_number'];
    }

    if(isset($_POST['city'])){
        $city= $_POST['city'];
    }

    if(isset($_POST['zip_code'])){
        $zip_code= $_POST['zip_code'];
    }

}

$today_date = date("Y-m-d");
$today_time = date("H:i:s");

$qry = $pdo->prepare("SELECT SUM(cart_quantity*item_price) price FROM user_item JOIN items ON user_item.item_id_cart = items.item_id
  JOIN users ON user_item.user_id = users.user_email WHERE user_email = ?");
$qry->execute([$_SESSION['email']]);
$order_price = $qry->fetch();

$new_order = $pdo->prepare("INSERT INTO orders(order_date, order_time, order_price, order_state, order_owner, 
                   order_street, order_street_number, order_city, order_zip_code) VALUES(?,?,?,false,?,?,?,?,?) ");
$new_order->execute([$today_date, $today_time, $order_price['price'], $_SESSION['email'], $street, $street_number, $city, $zip_code]);

$qry = $pdo->prepare("SELECT order_id FROM orders WHERE order_date=? AND order_time=? AND order_owner=?");
$qry->execute([$today_date, $today_time, $_SESSION['email']]);

$order = $qry->fetch();
$number_of_order = $order['order_id'];

$qry = $pdo->prepare("SELECT item_id_cart, cart_quantity FROM user_item WHERE user_id=?");
$qry->execute([$_SESSION['email']]);
$items = $qry->fetchAll();
$qry = $pdo->prepare("DELETE FROM user_item WHERE user_id=?");
$qry->execute([$_SESSION['email']]);

$qry = $pdo->prepare("INSERT INTO order_items(order_of_item, item_in_order, number_of_items) VALUES(?,?,?)");



?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        .celadon-green{
            background-color: #247B7B;
        }
        .baby-powder{
            color: #FFFFFA;
        }

        .card-image-same-size {
            width: 100%;
            height: 200px
        }

        .clickable-card{
            color: #212529;;
        }

        .clickable-card:hover{
            text-decoration: none;
        }

        .clickable-card:visited{
            color: #212529;;
        }


    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="img/papocadologo.png" />

    <script src="https://kit.fontawesome.com/8200b23f0f.js" crossorigin="anonymous"></script>


    <title>PaPoCADO!</title>
</head>
<body>
<?php
include "navigation-bar.php";
?>
<div class="jumbotron">
    <h1 class="display-6">Ďakujeme za nákup!</h1>
    <p class="lead">Ďakujeme za nákup! Na Vašej objednávke usiľovne pracujeme.</p>
    <hr class="my-4">
    <p>Číslo vašej objednávky je: <strong><?php echo $number_of_order;?></strong>. Pre vrátenie sa na hlavnú stránku kliknite pokračovať.</p>
    <a class="btn btn-primary btn-lg" href="index.php" role="button">Pokračovať v nákupe</a>
</div>
<?php
foreach ($items as $item){
    $qry->execute([$number_of_order, $item['item_id_cart'], $item['cart_quantity']]);
}

$limits = $pdo->prepare("SELECT item_id, number_of_items FROM items JOIN order_items oi
  on items.item_id = oi.item_in_order WHERE item_category='D' AND order_of_item=?");
$limits->execute([$number_of_order]);
while ($limit = $limits->fetch()){
    $qry  = $pdo->prepare("SELECT item_limit FROM items WHERE item_id=?");
    $qry->execute([$limit['item_id']]);
    $item = $qry->fetch();
    $new_quantity = $item['item_limit'] - $limit['number_of_items'];
    $qry = $pdo->prepare("UPDATE items SET item_limit=? WHERE item_id=?");
    $qry->execute([$new_quantity, $limit['item_id']]);
}
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>