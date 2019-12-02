<?php
require_once 'dbConfig.php';
session_start();


if(!isset($_SESSION['email'])){
    $new_user = $pdo->prepare("INSERT INTO users(user_email,user_type, user_password) VALUES (?,'N','nothing')");
    $guid = uniqid('non_registered_') . "@nonregistered.xx";
    $new_user->execute([$guid]);
    $_SESSION['email'] = $guid;
}

if(isset($_SESSION['email'])){
    $driver = $_SESSION['email'];
    $select = "SELECT * FROM users WHERE user_email = :email";
    $sql = $pdo->prepare($select);
    $sql->execute(['email' => $driver]);
    $result = $sql->fetch();
    if(!($result['user_type'] ==='D') && !($result['user_type'] === 'O') && !($result['user_type'] === 'A')){
        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
    }
}else{
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
}

if(!empty($_GET['done'])){
    $update_stmt = $pdo->prepare('UPDATE orders SET order_state=1 WHERE order_id=?');
    $update_stmt->execute([$_GET['done']]);
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
$driver_stmt = $pdo->prepare('SELECT * FROM orders WHERE order_driver=? AND orders.order_state = 0');
$driver_stmt->execute([$driver]);
while($order = $driver_stmt->fetch()){
    $user_stmt = $pdo->prepare('SELECT * FROM users WHERE user_email=?');
    $user_stmt->execute([$order['order_owner']]);
    $user = $user_stmt->fetch();
    echo "<div class=\"container mt-3\" >
    
    <div class=\"card m-5 shadow p-3 mb-5 bg-white rounded\">
        <div class=\"card-header\">
            <div class=\"d-flex container justify-content-start\">
                <a href=\"?done=".$order['order_id']."\" class=\"btn btn-light d-flex mr-3\">
                    <span style=\"font-size: 1.5rem\"><i class=\"far fa-check-circle align-self-center\"></i></span>
                </a>
                <div>
                    <p class=\"my-1\" style=\"font-weight: bold\">".$user['user_name']." ".$user['user_phone_number']."</p>
                    <p class=\"my-1\">".$user['user_street']." ".$user['user_street_number']." ".$user['user_zip_code']." ".$user['user_city']." "."</p>
                </div>
            </div>
        </div>

        <div class=\"card-body\">
            <ul class=\"list-group\">";
            $item_stmt = $pdo->prepare('SELECT distinct i.item_name, i.item_price, oi.number_of_items FROM items i,order_items oi,orders o WHERE item_id=item_in_order and order_of_item=?');
            $item_stmt->execute([$order['order_id']]);
            while ($item = $item_stmt->fetch()){
                $price = $item['item_price'] * $item['number_of_items'];
                echo "
                        <li class=\"d-flex list-group-item justify-content-between\">
                            <div>".$item['item_name']. " x ".$item['number_of_items']."</div>
                            <div>".$price." €"."</div>
                        </li>";
            }
                echo "

            </ul>
        </div>
    </div>


</div>";
}


?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>