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
<div class="container mt-3 d-flex justify-content-center" >

    <form>
        <h1 class="display-7 text-center"> Údaje o prevádzke </h1>

        <div class="form-group">
            <input type="text" class="form-control my-2" placeholder="ID" disabled/>
            <input type="text" class="form-control my-2" placeholder="Názov"/>

        </div>

        <div class="form-group">
            <label><strong> Adresa </strong></label>
            <div class="row my-2">
                <div class="col"><input type="text" class="form-control" placeholder="Ulica"/></div>
                <div class="col-4"><input type="text" class="form-control" placeholder="Číslo"/></div>
            </div>
            <div class="row my-2">
                <div class="col"><input type="text" class="form-control" placeholder="Mesto"/></div>
                <div class="col-4"><input type="text" class="form-control" placeholder="PSČ"/></div>
            </div>

        </div>

        <div class="form-group">
            <label><strong> Other </strong></label>
            <input type="time" class="form-control my-2" name="ClosingTime">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Vybrať fotku</label>
            </div>

        </div>

        <button class="btn btn-primary my-2" type="submit">Uložiť</button>

    </form>

</div>
<hr>
<div class="container">
    <h1 class="display-7 text-center"> Nabídka </h1>

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="d-flex card-header justify-content-between" id="headingOne">
                <h2 class="mb-0 clickable-card">
                    <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong>#ID Názov položky</strong>
                    </button>
                </h2>
                <button class="btn btn-light ml-5"><i class="fas fa-trash-alt"></i></button>
            </div>

            <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col my-2">
                                <input type="text" class="form-control" placeholder="ID" disabled>
                            </div>
                            <div class="col my-2">
                                <input type="text" class="form-control" placeholder="Názov">
                            </div>
                            <div class="col my-2">
                                <input type="text" class="form-control" placeholder="Popis">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col my-2">
                                <input type="text" class="form-control" placeholder="Cena" style="font-weight: bold">
                            </div>
                            <div class="col my-2">
                                <select class="custom-select">
                                    <option>Normálna</option>
                                    <option>Vegetariánska</option>
                                    <option>Vegánska</option>
                                    <option>Bezlepková</option>
                                </select>
                            </div>
                            <div class="col my-2">
                                <select class="custom-select" id="offerType"
                                        onchange="isDailyOfferItem = function (){
                                            if(document.getElementById('offerType').value ==='Denná ponuka'){
                                                document.getElementById('limit').disabled = false;
                                                console.log('should be visible');
                                            }
                                            else{
                                                document.getElementById('limit').disabled = true;
                                                console.log('should not');
                                            }
                                        }; isDailyOfferItem()">
                                    <option>Stála ponuka</option>
                                    <option>Denná ponuka</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col my-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile1">
                                    <label class="custom-file-label" for="customFile">Vybrať fotku</label>
                                </div>
                            </div>
                            <div class="col my-2">
                                <button type="submit" class="btn btn-primary" style="width: 100%"> Uložiť </button>
                            </div>
                            <div class="col my-2" >
                                <input id="limit" type="text" class="form-control" placeholder="Počet položiek dennej ponuky" disabled/>
                            </div>

                        </div>

                    </form>
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