<?php
session_start();
require_once "dbConfig.php";


if(!isset($_SESSION['email'])){
    $new_user = $pdo->prepare("INSERT INTO users(user_email,user_type, user_password) VALUES (?,'N','nothing')");
    $guid = uniqid('non_registered_') . "@nonregistered.xx";
    $new_user->execute([$guid]);
    $_SESSION['email'] = $guid;
}

if(isset($_SESSION['email'])){
    $admin = $_SESSION['email'];
    $select = "SELECT * FROM users WHERE user_email = :email";
    $sql = $pdo->prepare($select);
    $sql->execute(['email' => $admin]);
    $result = $sql->fetch();
    if(!($result['user_type'] ==='A')){
        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
    }
}else{
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
}

$status = -1;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST['email'])) || empty(trim($_POST['password'])) || empty(trim($_POST['repeat_password']))   ) {
        $status = 0;
    } else {
        if (strcmp($_POST['password'], $_POST['repeat_password']) != 0) {
            $status = 2;
        } else {
            $email = $_POST['email'];
            $sqlLookUp = "SELECT user_email FROM users WHERE user_email = :email";
            if($query = $pdo->prepare($sqlLookUp)) {
                    $query->execute(['email' => $email]);
                    $result = $query->fetch();
                    if (!empty($result)) {
                        $status = 44;    # Email already in database
                    } else {
                        $pass = $_POST['password'];
                        $type = $_POST['role'];
                        $sql = "INSERT INTO users (user_email, user_password, user_type,user_active) VALUES (:email, :pass, :type,1)";
                        if ($query = $pdo->prepare($sql)) {
                            $password_hashed = password_hash($pass, PASSWORD_BCRYPT);
                            if ($query->execute(['email' => $email, 'pass' => $password_hashed, 'type' => $type])) {
                                $status = 1;
                            } else {
                                error_log("Wrong INSERT query in admin-new-user.php file");
                                $status = 3;    # Internal Error
                            }
                        }

                        if(isset($_POST['new_name'])){
                            $stmt=$pdo->prepare('UPDATE users SET user_name=? WHERE user_email=?');
                            $stmt->execute([$_POST['new_name'],$email]);
                        }

                        if(isset($_POST['new_phone_number'])){
                            $stmt=$pdo->prepare('UPDATE users SET user_phone_number=? WHERE user_email=?');
                            $stmt->execute([$_POST['new_phone_number'],$email]);
                        }

                        if(!empty($_POST['new_city'])){
                            $stmt=$pdo->prepare('UPDATE users SET user_city=? WHERE user_email=?');
                            $stmt->execute([$_POST['new_city'],$email]);
                        }

                        if(!empty($_POST['new_zip'])){
                            $stmt=$pdo->prepare('UPDATE users SET user_zip_code=? WHERE user_email=?');
                            $stmt->execute([$_POST['new_zip'],$email]);
                        }

                        if(!empty($_POST['new_street'])){
                            $stmt=$pdo->prepare('UPDATE users SET user_street=? WHERE user_email=?');
                            $stmt->execute([$_POST['new_street'],$email]);
                        }

                        if(!empty($_POST['new_street_number'])) {
                            $stmt = $pdo->prepare('UPDATE users SET user_street_number=? WHERE user_email=?');
                            $stmt->execute([$_POST['new_street_number'], $email]);
                        }

                        if(!empty($_POST['new_role'])){
                            $stmt=$pdo->prepare('UPDATE users SET user_type=? WHERE user_email=?');
                            $stmt->execute([$_POST['new_role'],$email]);
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

        label {
            margin-top: 0.75rem;
        }


    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="../templates/img/papocadologo.png" />

    <script src="https://kit.fontawesome.com/8200b23f0f.js" crossorigin="anonymous"></script>


    <title>PaPoCADO!</title>
</head>
<body>
<?php
include "navigation-bar.php";
?>
<div class="container mt-5 " >
    <div class="d-flex row justify-content-center">
        <form style="min-width: 400px" method="POST" class="needs-validation" action="admin-new-user.php" novalidate>
            <?php
            if($status == 44)
                echo '<div ><font color="red">Email sa už nachádza v databáze</font></div>';
            ?>

            <div class="form-group">
                <label for="exampleInputEmail2">Email *</label>
                <input type="email" name="email" class="form-control mb-2" maxlength="100" id="inlineFormInput2" placeholder="Email uživateľa" required>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="registrationPassword">Heslo *</label>
                <input type="password" name="password" class="form-control" id="registrationPassword" required>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="registrationConfirmPassword">Zopakujte Heslo *</label>
                <input type="password"  name="repeat_password" class="form-control" id="registrationConfirmPassword" required oninput="check(this)">
                <script language='javascript' type='text/javascript'>
                    function check(input) {
                        if (input.value != document.getElementById('registrationPassword').value) {
                            input.setCustomValidity('Password Must be Matching.');
                        } else {
                            // input is valid -- reset the error message
                            input.setCustomValidity('');
                        }
                    }
                </script>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Heslá sa nezhodujú</div>
            </div>

            <div class="form-group">
                <label for="inlineFormInput">Meno a Priezvisko</label>
                <input type="text" name ="new_name" class="form-control mb-2" id="inlineFormInput">
            </div>

            <div class="form-group">
                <label for="inlineFormInput3">Telefónne číslo</label>
                <input type="text" name="new_phone_number" minlength="9" maxlength="13" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" class="form-control mb-2" id="inlineFormInput3" placeholder="+421 900 111 222">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" name="new_street" pattern="[A-Za-z\s\u0080-\u9fff]+" class="form-control" id="street" minlength="2" maxlength="100">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback">Nesmie obsahovať čísla alebo špecialne znaky</div>

                <label for="streetnumber">Číslo popisné</label>
                <input type="text" pattern="(([0-9])+([/][0-9]+)?)" name="new_street_number" class="form-control" id="streetnumber" maxlength="10">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>


                <label for="city">Mesto</label>
                <input type="text" name="new_city" pattern="[A-Za-z\s\u0080-\u9fff]+" class="form-control" id="city" maxlength="100">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>

                <label for="zip">PSČ</label>
                <input type="text" minlength="5" pattern="[0-9]+" maxlength="5" name="new_zip"  class="form-control" id="zip">
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"></div>
            </div>

            <div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="role" value="A"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Administrátor</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="role" value="O"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Operátor</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline3" name="role" value="D"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline3">Vodič</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline4" checked="checked" name="role" value="C"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline4">Normálny
                        uživateľ</label>
                </div>

            <button type="submit" style="vertical-align: center" class="btn btn-primary">Vytvoriť uživateľa</button>
        </form>
    </div>

</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>