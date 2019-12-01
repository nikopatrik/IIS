<?php

$useremail = 'aboarer2@shinystat.com';
require_once 'dbConfig.php';

$user_name_stmt = $pdo->prepare('SELECT * FROM users WHERE user_email=?');
$user_name_stmt->execute([$useremail]);
$user_data = $user_name_stmt->fetch();

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

<div class="container mt-3">
    <div class="d-flex justify-content-center">

        <form style="width: 400px" action="validateorder.php"  method="POST" class="was-validated">
            <div class="form-group">
                <label for="name">Meno a Priezvisko</label>
                <?php echo '
                <input type="text" name="name" value="'.$user_data['user_name'].'" class="form-control mb-2"  pattern="[A-Za-z\s\u0080-\u9fff]+" id="name" placeholder="Meno Uživateľa" minlength="2"  maxlength="100" required>'; ?>
                <label for="formGroupExampleInput3">Email</label>
                <?php echo '
                <input type="email" name="email" class="form-control mb-2" maxlength="100" id="email" value="'.$user_data['user_email'].'" placeholder="Email uživateľa" required>'; ?>
                <label for="formGroupExampleInput4">Telefónne číslo </label>
                <?php
                echo '
                <input type="text" name="phone_number" value="'.$user_data['user_phone_number'].'" minlength="9" maxlength="13" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" class="form-control mb-2" id="phone_number" placeholder="+421 900 111 222" required>'; ?>

            </div>
            <div class="form-group" class="was-validated">
                <label for="formGroupExampleInput2">Adresa</label>
                <?php echo '
                <input type="text" value="'.$user_data['user_street'].'" name="street" pattern="[A-Za-z\s\u0080-\u9fff]+" class="form-control" id="street" minlength="2" maxlength="100" required>';?>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
                <?php echo '
                <input type="text" value="'.$user_data['user_street_number'].'" pattern="(([0-9])+([/][0-9]+)?)" name="street_number" class="form-control" id="street_number" maxlength="10" required>'; ?>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
                <?php echo '
                <input type="text" name="city" value="'.$user_data['user_city'].'" pattern="[A-Za-z\s\u0080-\u9fff]+" class="form-control" id="city" maxlength="100" required>'; ?>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
                <?php echo '
                <input type="text" minlength="5" value="'.$user_data['user_zip_code'].'" pattern="[0-9]+" maxlength="5" name="zip_code"  class="form-control" id="zip_code" required>'; ?>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
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