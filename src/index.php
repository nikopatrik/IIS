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
                        <a class="dropdown-item" href="profile.php">Profil</a>
                        <a class="dropdown-item" href="orders.php">Moje objednávky</a>
                        <a class="dropdown-item" href="#">Odhlásiť sa</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="shoppingcart.php">
                        <i class="fas fa-shopping-cart"></i>
                     </a>
                </li>

                <!--<li class="nav-item">-->
                    <!--<a class="nav-link" href="login.php">-->
                        <!--Prihlásiť sa-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li class="nav-item">-->
                    <!--<a class="nav-link" href="signup.php">-->
                        <!--Registrovať sa-->
                    <!--</a>-->
                <!--</li>-->
            </ul>
        </div>
    </div>
    </div>
</nav>

<div class="container mt-3" >
    <div class="row">
        <!--template to fill in with database info -->
        <?php
        require_once 'dbConfig.php';
        foreach ($pdo->query("SELECT * FROM businesses") as $row){
            $time=strtotime($row['business_closing_time']);
            if(empty($row['business_picture_path']))
                $picture ='img\default.jpg';
            else
                $picture =$row['business_picture_path'];

            echo "<div class=\"col3-sm\">
            <div class=\"card m-1\" style=\"width: 16rem;\">
                <a class=\"clickable-card\" href=\"offer.php?business=".$row['business_name']."&type=all\" >
                <img class=\"card-image-same-size\" src=\"".$picture."\" class=\"card-img-top\" alt=\"...\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">".$row['business_name']."</h5>
                <p class=\"card-text\">Posledné objednávky: ".date("H:i",$time)."</p>
                </div>
                </a>
            </div>
        </div>";
        }
        ?>


</div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>
