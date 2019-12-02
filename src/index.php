<?php
session_start();
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

<div class="container mt-3" >
    <div class="row">
        <!--template to fill in with database info -->
        <?php
        include_once "dbConfig.php";
        if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['search'])){
            $searchName = $_GET['search'];
            $searchName = htmlspecialchars($searchName);
            foreach($pdo->query("SELECT * FROM businesses WHERE (`business_name` LIKE '%".$searchName."%')") as $row){
                $time = strtotime($row['business_closing_time']);
                if (empty($row['business_picture_path']))
                    $picture = 'img/default.jpg';
                else
                    $picture = $row['business_picture_path'];

                echo "<div class=\"col3-sm\">
                    <div class=\"card m-1\" style=\"width: 16rem;\">
                        <a class=\"clickable-card\" href=\"offer.php?business=" . $row['business_name'] . "&type=all\" >
                        <img class=\"card-image-same-size\" src=\"" . $picture . "\" class=\"card-img-top\" alt=\"...\">
                    <div class=\"card-body\">
                    <h5 class=\"card-title\">" . $row['business_name'] . "</h5>
                    <p class=\"card-text\">Posledné objednávky: " . date("H:i", $time) . "</p>
                    </div>
                    </a>
                </div>
            </div>";
            }
        }else {
            foreach ($pdo->query("SELECT * FROM businesses") as $row) {
                $time = strtotime($row['business_closing_time']);
                if (empty($row['business_picture_path']))
                    $picture = 'img/default.jpg';
                else
                    $picture = $row['business_picture_path'];

                echo "<div class=\"col3-sm\">
            <div class=\"card m-1\" style=\"width: 16rem;\">
                <a class=\"clickable-card\" href=\"offer.php?business=" . $row['business_name'] . "&type=all\" >
                <img class=\"card-image-same-size\" src=\"" . $picture . "\" class=\"card-img-top\" alt=\"...\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">" . $row['business_name'] . "</h5>
                <p class=\"card-text\">Posledné objednávky: " . date("H:i", $time) . "</p>
                </div>
                </a>
            </div>
        </div>";
            }
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
