<?php
require_once "dbConfig.php";

$email = $password = "";
$status = -1;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty(trim($email)) || empty(trim($password))){
        $status = 0;
    }else{
        $sql = "SELECT * FROM users WHERE user_email = :email";
        if($query = $pdo->prepare($sql)){
            $query->execute(['email' => $email]);
            if($result = $query->fetch()) {
                if (password_verify($password, $result['user_password'])) {
                    $_SESSION['email'] = $result['user_email'];
                    $status = 1;        # FIXME delete this
                } else {
                    $status = 0;
                }
            }else{
                $status = 0;
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
    <link rel="shortcut icon" type="image/x-icon" href="img/papocadologo.png" />

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
                    <a class="nav-link" href="signup.php">
                        Registrovať sa
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5 " >
    <div class="d-flex row justify-content-center">
    <form action="login.php" method="post" style="min-width: 400px">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="loginEmail" aria-describedby="emailHelp">

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Heslo</label>
            <input type="password" name="password" class="form-control" id="loginPassword">
            <small id="pwdHelp" class="form-text text-muted">Vaše heslo nikdy s nikým nezdieľajte.</small>
        </div>
        <div class="form-group form-check d-flex justify-content-between">
            <div>
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Zapamätať si ma</label>
            </div>
        <?php
        if($status == 0) {
            echo "<strong style='color: red'>Nesprávne heslo alebo email</strong>";
        }else{
            echo $status;   # TODO
        }
        ?>
        </div>
        <button type="submit" style="vertical-align: center" class="btn btn-primary">Submit</button>
    </form>
    </div>

    <div class="d-flex row justify-content-center" >
            <a class="m-4" href="signup.php"> Vytvoriť účet</a>
            <a class="m-4" href="forgottenpassword.html"> Zapomenuté heslo</a>
    </div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>