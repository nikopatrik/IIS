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
<?php
include "navigation-bar.php";
?>
<?php
require_once 'dbConfig.php';
$id =$_GET['business'];
if(!empty($id))
    $_SESSION['requested_restaurant']=$id;
$type =$_GET['type'];
if(!empty($type))
    $_SESSION['requested_type']=$type;

$stmt = $pdo->prepare('SELECT * FROM businesses WHERE business_name=?');
$stmt->execute([$_SESSION['requested_restaurant']]);
$business = $stmt->fetch();
if(empty($business['business_picture_path']))
    $picture ='img\default.jpg';
else
    $picture =$business['business_picture_path'];

echo "
    <div class=\"jumbotron jumbotron-fluid restaurant-name\" style=\"background: url(".$picture.") center center / cover no-repeat\">
        <div class=\"container \">
            <h1 class=\"display-4\" >".$business['business_name']."</h1>
            <p class=\"lead\" >Posledné objednávky: ".date("H:i",strtotime($business['business_closing_time']))."<br>".$business['business_street']." ".$business['business_street_number']." ".$business['business_zip']." ".$business['business_city']."</p>
        </div>
    </div>
    <nav class=\"nav justify-content-center food-type \">
        <a class=\"nav-link active\" href=\"?type=all\">Všetky</a>
        <a class=\"nav-link\" href=\"?type=W\">Vegetariánske</a>
        <a class=\"nav-link\" href=\"?type=V\">Vegánske</a>
        <a class=\"nav-link\" href=\"?type=G\">Bezlepkové</a>
    </nav>
    ";

if( $_SESSION['requested_type'] == 'all'){
    $stmt = $pdo->prepare('SELECT * FROM items WHERE item_business=?');
    $stmt->execute([$business['business_id']]);
} else {
    $stmt = $pdo->prepare('SELECT * FROM items WHERE item_business=? AND item_type =?');
    $stmt->execute([$business['business_id'],$_SESSION['requested_type']]);
}

while ($item = $stmt->fetch()){
    if(empty($item['item_image_path']))
        $picture = "img/default_food.png";
    else
        $picture = $item['item_image_path'];
    echo "    
    <div class=\"container shadow-lg p-3 mb-5 bg-white rounded\">
    <div class=\"card\">
        <div class=\"card-body p-2 d-flex justify-content-between\">
            <div class=\"d-flex justify-content-start\">
            <img class=\"icon-size b-1\" src=\"".$picture."\"/>

                <div class=\"d-flex flex-column ml-3\">
                    <h5 class=\"card-title mb-1\">".$item['item_name']."</h5>
                    <p class=\"text-secondary\">".$item['item_description']."</p>
                    <p class=\"card-text\"><strong>".$item['item_price']." €</strong></p>
                </div>
            </div>
            <a href=\"shoppingcart.html?id=8abcfaed5 \" class=\"btn btn-primary align-self-end\">Vybrať</a>
        </div>
    </div>
</div>
    ";
}

?>







<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>