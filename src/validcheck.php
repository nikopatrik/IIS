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
            <img src="img/papocadologo.png" width="50" height="50" alt=""> <i> Papocado </i>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Meno Uživateľa
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="profile.html">Profil</a>
                            <a class="dropdown-item" href="orders.html">Moje objednávky</a>
                            <a class="dropdown-item" href="#">Odhlásiť sa</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shoppingcart.html">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>

                    <!--<li class="nav-item">-->
                    <!--<a class="nav-link" href="login.html">-->
                    <!--Prihlásiť sa-->
                    <!--</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--<a class="nav-link" href="signup.html">-->
                    <!--Registrovať sa-->
                    <!--</a>-->
                    <!--</li>-->
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <div class="d-flex justify-content-center">
        <form style="width: 400px">
            <div class="form-group">
                <label for="formGroupExampleInput">Meno a Priezvisko</label>
                <input type="text" class="form-control mb-2" id="formGroupExampleInput"
                       placeholder="Meno Uživateľa">
                <label for="formGroupExampleInput3">Email</label>
                <input type="text" class="form-control mb-2" id="formGroupExampleInput3"
                       placeholder="menouzivatela@gmail.com">
                <label for="formGroupExampleInput4">Telefónne číslo </label>
                <input type="text" class="form-control mb-2" id="formGroupExampleInput4"
                       placeholder="+421 902 222 000">

            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Adresa</label>
                <input type="text" class="form-control my-2" id="formGroupExampleInput2"
                       placeholder="Ulica">
                <input type="text" class="form-control my-2"
                       placeholder="Číslo popisné">
                <input type="text" class="form-control my-2"
                       placeholder="Mesto">
                <input type="text" class="form-control my-2"
                       placeholder="PSČ">
            </div>
            <div class="d-flex justify-content-between">
                <a class="btn btn-light" href="shoppingcart.html">Zpäť do košíku</a>
                <a type="submit" class="btn btn-primary" href="validateorder.html">Pokračovať</a>
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