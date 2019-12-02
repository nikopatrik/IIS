<?php
require_once "dbConfig.php";

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


if($is_logged_in){
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
    exit();
}

$email = $password = "";
$status = -1;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty(trim($email)) || empty(trim($password))){
        $status = 1;    # Fields are empty
    }else{
        $sql = "SELECT * FROM users WHERE user_email = :email";
        if($query = $pdo->prepare($sql)){
            $query->execute(['email' => $email]);
            if($result = $query->fetch()) {
                if(!$result['user_active']){
                    $status = 3;    # Account is not active
                }else {
                    if (password_verify($password, $result['user_password'])) {
                        $qry = $pdo->prepare("DELETE FROM users WHERE user_email=?");
                        $qry->execute($_SESSION['email']);
                        $_SESSION['email'] = $result['user_email'];
                        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
                        exit();
                    } else {
                        $status = 0;    # Wrong password
                    }

                }
            }else{
                $status = 0;    # Wrong email address
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
<?php
include "navigation-bar.php";
?>
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
        }elseif($status == 1){
            echo "<strong style='color: red'>Vyplňte všetky polia</strong>";
        }elseif($status == 2){
            echo "<strong style='color: red'>Interná chyba, skúste znova</strong>";
        }elseif ($status == 3){
            echo "<strong style='color: red'>Tento účet nie je aktívny</strong>";
        }
        ?>
        </div>
        <button type="submit" style="vertical-align: center" class="btn btn-primary">Submit</button>
    </form>
    </div>

    <div class="d-flex row justify-content-center" >
            <a class="m-4" href="signup.php"> Vytvoriť účet</a>
            <a class="m-4" href="forgottenpassword.php"> Zapomenuté heslo</a>
    </div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>