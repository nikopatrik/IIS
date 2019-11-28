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

        .restaurant-name{
            color: #FFFFFA;
        }

        .food-type {
            color: #212529;
        }

        .icon-size {
            width: 80px;
            height: 80px;
        }

    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

    <title>IIS!</title>
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
                    <!--<li class="nav-item dropdown">-->
                    <!--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--Meno Uživateľa-->
                    <!--</a>-->
                    <!--<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
                    <!--<a class="dropdown-item" href="#">Profil</a>-->
                    <!--<a class="dropdown-item" href="#">Moje objednávky</a>-->
                    <!--<a class="dropdown-item" href="#">Odhlásiť sa</a>-->
                    <!--</div>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Prihlásiť sa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Registrovať sa
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


    <div class="jumbotron jumbotron-fluid restaurant-name" style="background: url(https://static.urbandaddy.com/uploads/assets/image/articles/standard/7e0a3ae7d14decddaedfa77928b9dfec.jpg) center center / cover no-repeat">
        <div class="container ">
            <h1 class="display-4" >Roburrito</h1>
            <p class="lead" >Čaute, volám sa Robert a po skúsenosti s mexickým food truckom v USA som sa rozhodol tento skvelý street food priniesť do Brna. </p>
        </div>
    </div>

<nav class="nav justify-content-center food-type ">
    <a class="nav-link active" href="?type=all">Všetky</a>
    <a class="nav-link" href="?type=veggie">Vegetariánske</a>
    <a class="nav-link" href="?type=veg">Vegánske</a>
    <a class="nav-link" href="?type=gluten-free">Bezlepkové</a>
</nav>

<div class="container shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
        <div class="card-body p-2 d-flex justify-content-between">
            <div class="d-flex justify-content-start">
            <img class="icon-size b-1" src="https://tacotimeregina.com/wp-content/uploads/2018/08/taco-time-specialty_burrito-ranch_chicken.jpg"/>

                <div class="d-flex flex-column ml-3">
                    <h5 class="card-title mb-1">Fajita burrito</h5>
                    <p class="text-secondary"> Zloženie: láska</p>
                    <p class="card-text"><strong>149 Kč</strong></p>
                </div>
            </div>
            <a href="shoppingcart.html?id=8abcfaed5 " class="btn btn-primary align-self-end">Vybrať</a>
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