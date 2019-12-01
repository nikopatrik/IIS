<?php
include_once "dbConfig.php";
session_start();
$_SESSION['email'] = 'aboarer2@shinystat.com';
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


if(isset($_SESSION['email'])) {
    $user_info = $pdo->prepare("SELECT user_email, user_name, user_phone_number, user_street, user_street_number, user_city, user_zip_code
                                          FROM users WHERE user_email=?");
    $user_info->execute([$_SESSION['email']]);
    $user = $user_info->fetch();
}

$email = isset($user['user_email'])? $user['user_email'] : "";
$name = isset($user['user_name'])? $user['user_name'] : "";
$phone_number = isset($user['user_phone_number'])? $user['user_phone_number'] : "";
$street = isset($user['user_street'])? $user['user_street'] : "";
$street_number = isset($user['user_street_number'])? $user['user_street_number'] : "";
$city = isset($user['user_city'])? $user['user_city'] : "";
$zip_code = isset($user['user_zip_code'])? $user['user_zip_code'] : "";


?>
<div class="container mt-3">
    <div class="d-flex justify-content-center">
        <form style="width: 400px" method="post" action="validateorder.php">
            <div class="form-group">
                <label for="name">Meno a Priezvisko</label>
                <input type="text" class="form-control mb-2" name="name"
                       placeholder="Meno Uživateľa" value="<?php echo $name; ?>" id="name">
                <label for="email">Email</label>
                <input type="text" class="form-control mb-2" name="email"
                       placeholder="menouzivatela@gmail.com" value="<?php echo $email; ?>" id="email">
                <label for="phone_number">Telefónne číslo </label>
                <input type="text" class="form-control mb-2" name="phone_number"
                       placeholder="+421 902 222 000" value="<?php echo $phone_number; ?>" id="phone_number">

            </div>
            <div class="form-group">
                <label for="street">Adresa</label>
                <input type="text" class="form-control my-2" name="street"
                       placeholder="Ulica" value="<?php echo $street; ?>" id="street">
                <input type="text" class="form-control my-2" name="street_number"
                       placeholder="Číslo popisné" value="<?php echo $street_number; ?>" id="street_number">
                <input type="text" class="form-control my-2" name="city"
                       placeholder="Mesto" value="<?php echo $city; ?>" id="city">
                <input type="text" class="form-control my-2" name="zip_code"
                       placeholder="PSČ" value="<?php echo $zip_code; ?>" id="zip_code">
            </div>
            <div class="d-flex justify-content-between">
                <a class="btn btn-light" href="shoppingcart.php">Zpäť do košíku</a>
                <button type="submit" class="btn btn-primary" >Pokračovať</button>
            </div>
        </form>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>