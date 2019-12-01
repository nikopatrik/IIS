<?php

include_once "dbConfig.php";

$email = $pass = $password_second = "";
$status = -1;
define("CUSTOMER", 'c');

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $password_second = $_POST['confirmPassword'];

    # Check if fields are not empty
    if (empty(trim($email)) || empty(trim($pass)) || empty(trim($password_second))) {
        $status = 0;    # No/wrong input
    } else {
        # Check if both passwords match
        if (strcmp($pass, $password_second) != 0) {
            $status = 2;    # Passwords do not match
        } else {
            # Look up in database, if there is already user's email
            $sqlLookUp = "SELECT user_email FROM users WHERE user_email = :email";
            if($query = $pdo->prepare($sqlLookUp)) {
                $query->execute(['email' => $email]);
                if ($result = $query->fetch()) {
                    if (isset($result)) {
                        $status = 4;    # Email already in database
                    }
                }
            }else{
                $status = 5;
                http_response_code(500);
            }
            if ($status == -1) {
                # Add user to database
                $sql = "INSERT INTO users (user_email, user_password, user_type) VALUES (:email, :pass, :type)";
                if ($query = $pdo->prepare($sql)) {
                    $password_hashed = password_hash($pass, PASSWORD_BCRYPT);
                    if ($query->execute(['email' => $email, 'pass' => $password_hashed, 'type' => CUSTOMER])) {
                        $status = 1;
                        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/login.php");
                        exit();
                    } else {
                        error_log("Wrong INSERT query in signup.php file");
                        $status = 3;    # Internal Error
                    }
                }
            }
        }
    }
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
    <link rel="shortcut icon" type="image/x-icon" href="../templates/img/papocadologo.png" />

    <script src="https://kit.fontawesome.com/8200b23f0f.js" crossorigin="anonymous"></script>


    <title>PaPoCADO!</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark justify-content-between celadon-green ">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="img/papocadologo.png" width="50" height="50" alt=""> <i> PaPoCADO </i>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <form class="form-inline mx-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Vyhľadať reštaurácie" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Hľadať</button>
            </form>
            <div class="navbar-nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            Prihlásiť sa
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5 " >
    <div class="d-flex row justify-content-center">
        <form action="signup.php" method="post" style="min-width: 400px">
            <div class="form-group">
                <label for="registrationEmail">Email</label>
                <input type="email" name="email" class="form-control" id="registrationEmail" aria-describedby="emailHelp">

            </div>
            <div class="form-group">
                <label for="registrationPassword">Heslo</label>
                <input type="password" name="password" class="form-control" id="registrationPassword">
            </div>
            <div class="form-group">
                <label for="registrationConfirmPassword">Zopakujte Heslo</label>
                <input type="password" name="confirmPassword" class="form-control" id="registrationConfirmPassword">
            </div>

            <div class="form-group form-check d-flex justify-content-between">
                <div>
                    <button type="submit" style="vertical-align: center" class="btn btn-primary">Submit</button>
                </div>
                <?php
                    if($status == 0){
                        echo "<strong style='color: red'>Vyplňte všetky údaje</strong>";
                    }elseif($status == 2){
                        echo "<strong style='color: red'>Heslá sa nezhodujú</strong>";
                    }elseif($status == 3 || $status == 5){
                        echo "<strong style='color: red'>Interná chyba, skúste znova</strong>";
                    }elseif($status == 4){
                        echo "<strong style='color: red'>Email je už registrovaný</strong>";
                    }
                ?>
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