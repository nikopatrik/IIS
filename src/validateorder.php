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
    $ans = $qry->fetch();
    $is_logged_in = $ans['user_type'] != 'N';
}


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
else {
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/validcheck.php");
    exit(0);
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

<?php
$items = $pdo->prepare("SELECT item_name, item_price, cart_quantity
                                FROM items JOIN user_item ui on items.item_id = ui.item_id_cart
                                WHERE user_id = ?;");
$items->execute([$_SESSION['email']]);

$final_sum = 0;
function print_item($name, $price, $count, &$final_sum){

    echo " <li class=\"d-flex list-group-item justify-content-between\">
                    <div><strong>".$name."</strong></div>
                    <div class=\"row ml-5\">
                        <span class=\"col mx-2\">".$price."</span >
                        <span class=\"col mx-2\">".$count."</span >
                        <span class=\"col mx-2\">".$price * $count." €</span >
                    </div>
                </li>";

    $final_sum += $price * $count;
}
?>

<form method="post" action="thankyou.php">
<div class="container mt-2" style="width: 30rem">

        <h3 class="text-center" > Potvrdenie objednávky</h3>
        <h5 style="font-weight: bold"> Údaje pre doručenie:</h5>
        <div class="d-flex justify-content-between">
            <div style="font-weight: bold"> Meno a Priezvisko:</div>
            <div>
                <input type="text" readonly class="form-control-plaintext" name="name" id="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div style="font-weight: bold"> Email:</div>
            <div>
                <input type="text" readonly class="form-control-plaintext" name="email" id="email" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div style="font-weight: bold"> Telefónne číslo:</div>
            <div>
                <input type="text" readonly class="form-control-plaintext" name="phone_number"  id="phone_number" value="<?php echo $phone_number; ?>">
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div style="font-weight: bold">Adresa: </div>
            <div class="d-flex flex-column align-items-end">
                <div>
                    <input type="text" readonly class="form-control-plaintext" name="street"  id="street" value="<?php echo $street; ?>">
                </div>
                <div>
                    <input type="text" readonly class="form-control-plaintext ml-2" name="street_number" id="street_number" value="<?php echo $street_number; ?>">
                </div>
                <div>
                    <input type="text" readonly class="form-control-plaintext" name="city" id="city" value="<?php echo $city; ?>">
                </div>
                <div>
                    <input type="text" readonly class="form-control-plaintext ml-2" name="zip_code" id="zip_code"  value="<?php echo $zip_code; ?>">
                </div>

            </div>
        </div>


</div>

<div class="container" style="width: 50rem">
    <div class="card  shadow p-3 m-3 mb-1 bg-white rounded">
        <div class="card-header">
            <div class="d-flex container justify-content-start">
                <h5 class="align-self-center mx-4"> Objednávka </h5>
            </div>
        </div>

        <div class="card-body">
            <ul class="list-group">
                <li class="d-flex list-group-item justify-content-between">
                    <div><strong>Názov</strong></div>
                    <div class="row ml-5">
                        <strong class="col">€/ks</strong>
                        <strong class="col">Počet kusov</strong>
                        <strong class="col">Cena</strong>
                    </div>
                </li>
                <?php
                while ($item = $items->fetch()){
                    print_item($item['item_name'], $item['item_price'], $item['cart_quantity'], $final_sum);
                }
                ?>

                <li class="d-flex list-group-item justify-content-between active">
                    <div><strong>Celkovo</strong></div>
                    <div class="d-flex justify-content-between ml-5">
                        <?php echo $final_sum;?> €
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>

<div class="container d-flex justify-content-center"><button type="submit" class="btn btn-primary mb-2"> Potvrdiť </button></div>
</form>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>