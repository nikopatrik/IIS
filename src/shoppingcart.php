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


        .quantity {
            float: left;
            margin-right: 15px;
            background-color: #eee;
            position: relative;
            width: 80px;
            overflow: hidden
        }

        .quantity input {
            margin: 0;
            text-align: center;
            width: 15px;
            height: 15px;
            padding: 0;
            float: right;
            color: #000;
            font-size: 20px;
            border: 0;
            outline: 0;
            background-color: #F6F6F6
        }

        .quantity input.qty {
            position: relative;
            border: 0;
            width: 100%;
            height: 40px;
            padding: 10px 25px 10px 10px;
            text-align: center;
            font-weight: 400;
            font-size: 15px;
            border-radius: 0;
            background-clip: padding-box
        }

        .quantity .minus, .quantity .plus {
            line-height: 0;
            background-clip: padding-box;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            -webkit-background-size: 6px 30px;
            -moz-background-size: 6px 30px;
            color: #bbb;
            font-size: 20px;
            position: absolute;
            height: 50%;
            border: 0;
            right: 0;
            padding: 0;
            width: 25px;
            z-index: 3
        }

        .quantity .minus:hover, .quantity .plus:hover {
            background-color: #dad8da
        }

        .quantity .minus {
            bottom: 0
        }
        .shopping-cart {
            margin-top: 20px;
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

<div class="container">
    <div class="card shopping-cart">
        <div class="d-flex justify-content-between card-header bg-light text-dark">
            <div>
                <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                Košík
            </div>
            <a href="index.html" class="btn btn-outline-dark btn-sm pull-right">Pokračovať v nákupe</a>
            <!--<div class="clearfix"></div>-->
        </div>
        <div class="card-body">
            <!-- PRODUCT -->
            <div class="row my-3" id="item1">
                <div class="col-12 col-sm-12 col-md-2 text-center">
                    <img class="img-responsive" src="https://media-cdn.tripadvisor.com/media/photo-s/18/5c/c1/d3/20190419-120507-largejpg.jpg" alt="prewiew" width="120" height="80">
                </div>
                <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                    <h4 class="product-name"><strong>Pulled pork</strong></h4>
                    <h4>
                        <small>Trhané bravčové mäsko.</small>
                    </h4>
                </div>
                <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                    <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                        <h6><strong>179 <span class="text-muted">Kč</span></strong></h6>
                    </div>
                    <div class="col-4 col-sm-4 col-md-4">
                        <div class="quantity">
                            <input type="button" value="+" class="plus"
                                   onclick="document.getElementById('quantity').value(document.getElementById('quantity').value ++ );"/>
                            <input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
                                   size="4" id="quantity">
                            <input type="button" value="-" class="minus"
                                   onclick="document.getElementById('quantity').value(document.getElementById('quantity').value -- );">
                        </div>
                    </div>
                    <div class="col-2 col-sm-2 col-md-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-xs" onclick="
                            var element = document.getElementById('item1');
                            element.parentNode.removeChild(element);
                        ">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
            <!-- END PRODUCT -->

        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between" style="margin: 10px">
                <div class="pull-right" style="margin: 5px">
                    Celková suma <b id="total">50.00€</b>
                </div>

                <a href="validcheck.html" class="btn btn-primary pull-right">Pokračovať v objednávke</a>

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