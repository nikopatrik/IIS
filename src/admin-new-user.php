<?php
require_once "dbConfig.php";
$status = -1;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST['email'])) || empty(trim($_POST['password'])) || empty(trim($_POST['repeat_password'])) || ( empty($_POST['A'])&&empty($_POST['D'])&&empty($_POST['O'])&&empty($_POST['C']) ) ) {
        $status = 0;
    } else {
        if (strcmp($_POST['password'], $_POST['repeat_password']) != 0) {
            $status = 2;
        } else {
            // Code for inserting new user TODO

        }
    }
}
echo $status;
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
        <form style="min-width: 400px" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail2">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp">

            </div>
            <div class="form-group">
                <label for="registrationPassword">Heslo</label>
                <input type="password" name="password" class="form-control" id="registrationPassword">
            </div>
            <div class="form-group">
                <label for="registrationConfirmPassword">Zopakujte Heslo</label>
                <input type="password"  name="repeat_password" class="form-control" id="registrationConfirmPassword">
            </div>

            <div class="form-group">
                <label for="inlineFormInput">Meno a Priezvisko</label>
                <input type="text" name ="name" class="form-control mb-2" id="inlineFormInput">
            </div>

            <div class="form-group">
                <label for="inlineFormInput3">Telefónne číslo</label>
                <input type="text" name="phone_number" class="form-control mb-2" id="inlineFormInput3" placeholder="">
            </div>

            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" name="street" class="form-control" id="street" >

                <label for="streetnumber">Číslo popisné</label>
                <input type="text" name="street_number" class="form-control" id="streetnumber" >

                <label for="city">Mesto</label>
                <input type="text" name="city"  class="form-control" id="city" >

                <label for="zip">PSČ</label>
                <input type="text" name="zip" class="form-control" id="zip" >
            </div>

            <div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="A"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Administrátor</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="O"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Operátor</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline3" name="D"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline3">Vodič</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline4" name="C"
                           class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline4">Normálny
                        uživateľ</label>
                </div>

            <button type="submit" style="vertical-align: center" class="btn btn-primary">Vytvoriť uživateľa</button>
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