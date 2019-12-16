<?php
include_once "dbConfig.php";
session_start();


if(!isset($_SESSION['email'])){
    $new_user = $pdo->prepare("INSERT INTO users(user_email,user_type, user_password) VALUES (?,'N','nothing')");
    $guid = uniqid('non_registered_') . "@nonregistered.xx";
    $new_user->execute([$guid]);
    $_SESSION['email'] = $guid;
}


if(isset($_SESSION['email'])){
    $qry = $pdo->prepare("SELECT user_type FROM users WHERE user_email=?");
    $qry->execute([$_SESSION['email']]);
    $type = $qry->fetch();
    if($type['user_type'] != 'A' and $type['user_type'] != 'O'){
        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
        return;
    }

}
else {
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
    return;
}



if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['driver'])){
        $driver = $_POST['driver'];
    }

    if(isset($_POST['order_id'])){
        $order_id= $_POST['order_id'];
    }

    $postqry = $pdo->prepare("UPDATE orders SET order_driver=?, order_state=false WHERE order_id=?");
    $postqry->execute([$driver, $order_id]);

}

function print_order($order_id, $items, $drivers){
    $total_price = 0;
    echo "
    <div class=\"card m-5 shadow p-3 mb-5 bg-white rounded\">
        <div class=\"card-header\">
            <div class=\"d-flex container justify-content-start\">
               <h5 class=\"align-self-center mx-4\"> #".$order_id."</h5>
            </div>
        </div>

        <div class=\"card-body d-flex justify-content-between\">
            <ul class=\"list-group\" style=\"width: 20rem\">";
    foreach ($items as $item){
        echo "           
                <li class=\"d-flex list-group-item justify-content-between\">
                    <div>".$item['item_name']."</div>
                    <div>". $item['item_price']." € </div>
                    <div>".$item['number_of_items']."</div>
                </li>";
        $total_price += $item['item_price'] * $item['number_of_items'];
    }
    echo "
                <li class=\"d-flex list-group-item justify-content-between active\">
                    <div>Celkovo</div>
                    <div>".$total_price." €</div>
                </li>

            </ul>";

    echo "
            <div class=\"d-flex flex-column justify-content-between\">
                        <form class=\"form-inline align-self-end\" method='POST' action='operator.php'>
                            <select class=\"custom-select\" name='driver'>";
     foreach ($drivers as $driver)
         echo "<option>".$driver['user_email']."</option>";

    echo "
                            </select>";
                            if(!$drivers)
                                echo "<button disabled type=\"submit\" class=\"btn btn-primary mx-2\"> Priradiť vodiča</button>";
                            else
                                echo "<button type=\"submit\" class=\"btn btn-primary mx-2\"> Priradiť vodiča</button>";
                            echo "<input type=\"hidden\" id=\"order_id\" name=\"order_id\" value=\"".$order_id."\">
                        </form>
                    </div>
        </div>
    </div>";
}

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

        .display-7 {
            font-size: 1.75rem;
        }

        .icon-size{
            width: 50px;
            height: 50px;
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
<div class="container mt-3" >

    <form class="d-flex form-inline justify-content-center" method="GET" action="bussiness.php">
        <input type="text" class="form-control mx-2" placeholder="Hľadať prevádzku" name="keyword"/>
        <select class="custom-select mx-2" name="attribute">
            <option>ID prevádzky</option>
            <option>Názov prevádzky</option>
        </select>
        <button type="submit" class="btn btn-primary mx-2" >Hľadať </button>
        <a href="bussiness.php" class="btn btn-light mx-2"> Vytvoriť novú prevádzku</a>
    </form>
</div>
<hr>

<div class="container mt-3" id="orders" >
    <div class="row">
        <div class="col"></div>
        <h1 class="display-7 text-center col-6"> Objednávky</h1>
        <a class="btn btn-light col px-2">Ukončiť objednávky</a>
    </div>


</div>

<div class="container">
    <?php

    $orders = $pdo->prepare("SELECT order_id FROM orders WHERE order_driver IS NULL");
    $orders->execute();
    while($order = $orders->fetch()){
        $qry = $pdo->prepare("SELECT user_email FROM users WHERE user_type='D' or user_type='A'");
        $qry->execute();
        $drivers = $qry->fetchAll();
        $qry = $pdo->prepare("SELECT item_name, item_price, number_of_items FROM items
                              JOIN order_items oi on items.item_id = oi.item_in_order WHERE order_of_item=?");
        $qry->execute([$order['order_id']]);
        $items = $qry->fetchAll();

        print_order($order['order_id'], $items, $drivers);
    }

    ?>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>