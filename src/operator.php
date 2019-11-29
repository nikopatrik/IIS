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

        .display-7 {
            font-size: 1.75rem;
        }

        .icon-size{
            width: 50px;
            height: 50px;
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

<div class="container mt-3" >

    <form class="d-flex form-inline justify-content-center">
        <input type="text" class="form-control mx-2" placeholder="Hľadať prevádzku"/>
        <select class="custom-select mx-2">
            <option>ID prevádzky</option>
            <option>Názov prevádzky</option>
        </select>
        <button type="submit" class="btn btn-primary mx-2" >Hľadať </button>
        <a href="bussiness.html" class="btn btn-light mx-2"> Vytvoriť novú prevádzku</a>
    </form>
</div>
<hr>

<div class="container mt-3" id="orders" >
    <div class="row">
        <div class="col"></div>
        <h1 class="display-7 text-center col-6"> Objednávky</h1>
        <a class="btn btn-light col px-2">Ukončiť objednávky</a>
    </div>
    <div class="card m-5 shadow p-3 mb-5 bg-white rounded">
        <div class="card-header">
            <div class="d-flex container justify-content-start">
                <img class="icon-size" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEUAAAD////q6upkZGTl5eXU1NRzc3Ojo6M3NzdcXFyKioqwsLDExMSfn5++vr7Q0NBOTk4nJycUFBTw8PAsLCw/Pz+Dg4P4+PhVVVVFRUV8fHwYGBiXl5cRERHc3NysrKwiIiJJSUlubm6Pj48zMzOZmZnYnRXIAAAECElEQVR4nO2abVuqQBBAletbSVpqoGlkWf//L153FmEXtYs+jNulc740DLvAMVeWZTodAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIDmWa+eXVbb0BfUOMuuz0voC2ocDP9/2m/4GEU9h/kg9AXBL2f34DCyuZGJdxK+7KPh0qZnm0O74dpm3of7jUTCzTSOpxIm7hEPQ/i+6LqyiafxnuFrfsL7JEm0Rnvk/qTMreKdxBLGJrSynX7ZMLKXNjBxv2w4rDTrdqe267jMpFZxJIfJP6mJ2XhTMux5v5rpc2EYlRd+b6JZ5jaMngrDaXmRx4ZxubPgsTScye5FajYWNzHspmcNY79h7wLDh8o51hXDxMR9JcGqYfesYd9vN7/AcOx3lf+Wayg91G5JYjgZ7nmrYSgNJzUMpeH+mElh2Jft9IThSv6xWoLW8M5EsxqGd8Xufxh+uOcQwy8TbecnDOWjHesa/jHRUw1DafinhqH3nRPDBxMtThlKbtViww8TZWqCP8BwWpyipYYy/NNtiw03JpjoCYY3lGnjXYsN5Wm7pygY3HBS7PtphulVhp+VOc1rxyRSvZvhdYaLwZ6PqwzXH6bvrDBUnnRfa1hysWFJbpgdNW6coIa9ZTGk9QhrqDzpFoIazuWn9bF5K5eghoLipFsIb6g46RbCGzbv5FMabps0PH7GP2cYN+/kI4aDxefnYnWlYfZilnP7vuGbSSaJXVb91lBvgSbHW2tL7bfrMkOHo7W2rTT7/lv6rKnXqRra4dOYYf5g+73hTlOvUzHMx8RtDbUHor8ibN8d3PZbqj0QHUPzICMzqMsM55M4jieRb9iPDRP75uWsYSoPUzeb0yxE00Q3u1tkss6mPBCV7oc1Z9678gBq8PSkahjZFX3NlbbghnL8TfNaDoEN7/UHYmDDZ/mzbt6rJKzhqx2IlcM2S1jDfEVYdSBeYTja7HY7yV2+Xrrvudm5lQoyEFUXTMOuec/sTGr+9AMNG3v3pH5HDG5Ydmyr4Yv2QAxuuJZRvW2xoVPR01ZD2atVmPgjDJ0SzjYYnqhrK5+8FQ1lFKxrGKrUtWVHHZo3tDX5vmFq6/R9Q6nhj2oYHor9x4WhzZyqTVStEP6mvtRBDDM/12B9qRS26RWcVAzlchde8Xc3lUr2SqHv5ALDyrKqvDB0DD+Lj/YGhvnT9tbNpnmp/teRYO06b0/RvhF1a4R1yxVOrep3OrMyfRD0FPNX755hmp417AzSIpPfF9xa/YdelvW+tAzfHx3K9OyQWjol9Ktqw+1yH1fLfVbuEQ8vlkbF8fLEq9l413ECAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgN/KX7+jVGXgR95gAAAAAElFTkSuQmCC" />
                <h5 class="align-self-center mx-4"> Bucheck </h5>
            </div>
        </div>

        <div class="card-body d-flex justify-content-between">
            <ul class="list-group" style="width: 20rem">
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

            <div class="d-flex flex-column justify-content-between">
                        <form class="form-inline align-self-end">
                            <select class="custom-select">
                                <option>Vodič 1</option>
                                <option>Vodič 2</option>
                                <option>Vodič 3</option>
                                <option>Vodič 4</option>

                            </select>
                            <button type="submit" class="btn btn-primary mx-2"> Priradiť vodiča</button>
                        </form>


                        <form class="form-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Označiť objednávku ako
                                    potvrdenú</label>
                            </div>

                            <button type="submit" class="btn btn-primary mx-3">
                                <i class="fas fa-check-circle">Potvrdené</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>