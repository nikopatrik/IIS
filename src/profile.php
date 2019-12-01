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
            text-decoration: none!important;
        }

        .clickable-card:visited{
            color: #212529;;
        }

        .icon-size{
            width: 50px;
            height: 50px;
        }

        .display-7 {
            font-size: 1.75rem;
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
<div class="d-flex flex-column container mt-3 justify-content-center">
    <?php
    require_once 'dbConfig.php';
    $user = 'aboarer2@shinystat.com';
    $user_name_stmt = $pdo->prepare('SELECT user_name FROM users WHERE user_email=?');
    $user_name_stmt->execute([$user]);
    $user_name = $user_name_stmt->fetch();
    echo "
    <h1 class=\"display-7 text-center\">".$user_name['user_name']."</h1>
    ";
    ?>

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0 clickable-card">
                    <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong>Kontaktné údaje</strong>
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <form action="profile.php" method="post">
                        <div class="form-row justify-content-around align-items-center">
                            <div class="col-auto">
                                <label for="inlineFormInput">Meno a Priezvisko</label>
                                <input type="text" name="newName" class="form-control mb-2" id="inlineFormInput" placeholder="Meno Uživateľa">
                            </div>

                            <div class="col-auto">
                                <label for="inlineFormInput2" >Email</label>
                                <input type="text" name="newEmail" class="form-control mb-2" id="inlineFormInput2" placeholder="Email uživateľa">
                            </div>

                        </div>
                        <div class="form-row justify-content-around align-items-center">
                            <div class="col-auto width">
                                <label for="inlineFormInput3">Telefónne číslo</label>
                                <input type="text" name="newNumber" class="form-control mb-2" id="inlineFormInput3" placeholder="+421 902 222 000">
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mx-5 mb-2">Uložiť údaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <strong> Nastavenie hesla </strong>
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <form class="form-inline">
                        <label class="mx-2" for="inlineFormInputName4">Zmena hesla</label>
                        <input type="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputName4" placeholder="Staré heslo">
                        <label class="mx-2 align-self-top" style="font-size: 2rem; color: #ced4da" for="inlineFormInputName5">|</label>
                        <input type="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputName5" placeholder="Nové heslo">
                        <input type="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputName6" placeholder="Znovu nové heslo">

                        <button type="submit" class="btn btn-primary mb-2">Zmeniť heslo</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="container mt-3" id="orders" >

    <h1 class="display-7 text-center"> Objednávky</h1>
    <?php
    $user_stmt = $pdo->prepare('SELECT * FROM orders WHERE order_owner=? ORDER BY order_date DESC');
    $user_stmt->execute([$user]);

    while($order = $user_stmt->fetch()){
        echo "
    <div class=\"card m-5 shadow p-3 mb-5 bg-white rounded\">
        <div class=\"card-header\">
            <div class=\"d-flex container justify-content-start\">
               <img class=\"icon-size\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADh CAMAAAAJbSJIAAAAclBMVEUAAAD////q6upkZGTl5eXU1NRzc3Ojo6M3NzdcXFyKioqwsLDExMSfn5++vr7Q0NBOTk4nJycUFBTw8PAsLCw/Pz+Dg4P4+PhVVVVFRUV8fHwYGBiXl5cRERHc3NysrKwiIiJJSUlubm6Pj48zMzOZmZnYnRXIAAAECElEQVR4nO2abVuqQBBAletbSVpqoGlkWf//L153FmEXtYs+jNulc740DLvAMVeWZTodAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIDmWa+eXVbb0BfUOMuuz0voC2ocDP9/2m/4GEU9h/kg9AXBL2f34DCyuZGJdxK+7KPh0qZnm0O74dpm3of7jUTCzTSOpxIm7hEPQ/i+6LqyiafxnuFrfsL7JEm0Rnvk/qTMreKdxBLGJrSynX7ZMLKXNjBxv2w4rDTrdqe267jMpFZxJIfJP6mJ2XhTMux5v5rpc2EYlRd+b6JZ5jaMngrDaXmRx4ZxubPgsTScye5FajYWNzHspmcNY79h7wLDh8o51hXDxMR9JcGqYfesYd9vN7/AcOx3lf+Wayg91G5JYjgZ7nmrYSgNJzUMpeH+mElh2Jft9IThSv6xWoLW8M5EsxqGd8Xufxh+uOcQwy8TbecnDOWjHesa/jHRUw1DafinhqH3nRPDBxMtThlKbtViww8TZWqCP8BwWpyipYYy/NNtiw03JpjoCYY3lGnjXYsN5Wm7pygY3HBS7PtphulVhp+VOc1rxyRSvZvhdYaLwZ6PqwzXH6bvrDBUnnRfa1hysWFJbpgdNW6coIa9ZTGk9QhrqDzpFoIazuWn9bF5K5eghoLipFsIb6g46RbCGzbv5FMabps0PH7GP2cYN+/kI4aDxefnYnWlYfZilnP7vuGbSSaJXVb91lBvgSbHW2tL7bfrMkOHo7W2rTT7/lv6rKnXqRra4dOYYf5g+73hTlOvUzHMx8RtDbUHor8ibN8d3PZbqj0QHUPzICMzqMsM55M4jieRb9iPDRP75uWsYSoPUzeb0yxE00Q3u1tkss6mPBCV7oc1Z9678gBq8PSkahjZFX3NlbbghnL8TfNaDoEN7/UHYmDDZ/mzbt6rJKzhqx2IlcM2S1jDfEVYdSBeYTja7HY7yV2+Xrrvudm5lQoyEFUXTMOuec/sTGr+9AMNG3v3pH5HDG5Ydmyr4Yv2QAxuuJZRvW2xoVPR01ZD2atVmPgjDJ0SzjYYnqhrK5+8FQ1lFKxrGKrUtWVHHZo3tDX5vmFq6/R9Q6nhj2oYHor9x4WhzZyqTVStEP6mvtRBDDM/12B9qRS26RWcVAzlchde8Xc3lUr2SqHv5ALDyrKqvDB0DD+Lj/YGhvnT9tbNpnmp/teRYO06b0/RvhF1a4R1yxVOrep3OrMyfRD0FPNX755hmp417AzSIpPfF9xa/YdelvW+tAzfHx3K9OyQWjol9Ktqw+1yH1fLfVbuEQ8vlkbF8fLEq9l413ECAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgN/KX7+jVGXgR95gAAAAAElFTkSuQmCC\" />
                <h5 class=\"align-self-center mx-4\"> ".date("j.n.Y",strtotime($order['order_date']))." ".date("H:i",strtotime($order['order_time']))." </h5>
            </div>
        </div>
        
        <div class=\"card-body\">
            <ul class=\"list-group\">";

        $item_stmt = $pdo->prepare('SELECT distinct i.item_name, i.item_price, oi.number_of_items FROM items i,order_items oi,orders o WHERE item_id=item_in_order and order_of_item=?');
        $item_stmt->execute([$order['order_id']]);
        while ($item = $item_stmt->fetch()){
            $price = $item['item_price'] * $item['number_of_items'];
            echo "
                <li class=\"d-flex list-group-item justify-content-between\">
                    <div>".$item['item_name']. " x ".$item['number_of_items']."</div>
                    <div>".$price." €"."</div>
                </li>";
        }


            echo "
            </ul>
        </div>
    </div>";
    }


    ?>
 </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>