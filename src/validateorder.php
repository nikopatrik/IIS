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
<div class="container mt-2" style="width: 30rem">
    <h3 class="text-center" > Potvrdenie objednávky</h3>
    <h5 style="font-weight: bold"> Údaje pre doručenie:</h5>
    <div class="d-flex justify-content-between">
        <div style="font-weight: bold"> Meno a Priezvisko:</div>
        <div> Meno Uživateľa</div>
    </div>
    <div class="d-flex justify-content-between">
        <div style="font-weight: bold"> Email:</div>
        <div> menouzivatela@gmail.com</div>
    </div>
    <div class="d-flex justify-content-between">
        <div style="font-weight: bold"> Telefónne číslo:</div>
        <div> +421 902 222 000</div>
    </div>
    <div class="d-flex justify-content-between">
        <div style="font-weight: bold">Adresa: </div>
        <div class="d-flex flex-column">
            <div>Božetechova 1/2</div>
            <div>Brno </div>
            <div>612 00</div>
        </div>
    </div>

</div>

<div class="container" style="width: 30rem">
    <div class="card  shadow p-3 m-3 mb-1 bg-white rounded">
        <div class="card-header">
            <div class="d-flex container justify-content-start">
                <h5 class="align-self-center mx-4"> Objednávka </h5>
            </div>
        </div>

        <div class="card-body">
            <ul class="list-group">
                <li class="d-flex list-group-item justify-content-between">
                    <div>Pulled Pork</div>
                    <div>179 Kč</div>
                </li>
                <li class="d-flex list-group-item justify-content-between">
                    <div>Red Velvet</div>
                    <div>60 Kč</div>
                </li>
                <li class="d-flex list-group-item justify-content-between">
                    <div>Hot-dog</div>
                    <div>159 Kč</div>
                </li>

                <li class="d-flex list-group-item justify-content-between active">
                    <div>Celkovo</div>
                    <div>398 Kč</div>
                </li>

            </ul>
        </div>
    </div>
</div>

<div class="container d-flex justify-content-center"><a href="thankyou.html" class="btn btn-primary mb-2"> Potvrdiť </a></div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>