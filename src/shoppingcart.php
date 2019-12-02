<?php
include_once "dbConfig.php";
session_start();

if(isset($_POST['item_id']) and isset($_POST['quantity'])){
    $quantity_update = $pdo->prepare("UPDATE user_item SET cart_quantity=? WHERE user_id=? AND item_id_cart=?");
    $quantity_update->execute([$_POST['quantity'], $_SESSION['email'], $_POST['item_id']]);
    exit(0);
}

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

        .icon-size{
            width: 75px;
            height: 75px;
        }

        .display-7 {
            font-size: 1.75rem;
        }

    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="img/papocadologo.png" />

    <script src="https://kit.fontawesome.com/8200b23f0f.js" crossorigin="anonymous"></script>


    <script>
        function quantityChanged(idOfElement, dbId) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "shoppingcart.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("item_id="+dbId+"&quantity="+document.getElementById(idOfElement).value);
        }

        function addQuantity(idOfElement, dbId){
            if(document.getElementById(idOfElement).value === 30){
                alert("Nemozno pridat viac ako tridsat poloziek");
                return;
            }
            document.getElementById(idOfElement).value++;
            quantityChanged(idOfElement, dbId)
        }

        function decreaseQuantity(idOfElement, dbId){
            if(document.getElementById(idOfElement).value === 1){
                alert("Nemozno mat menej ako jednu polozku.");
                return;
            }
            document.getElementById(idOfElement).value--;
            quantityChanged(idOfElement, dbId)
        }

    </script>


    <title>PaPoCADO!</title>
</head>
<body>
<?php
include_once "navigation-bar.php";
?>

<?php
include_once "dbConfig.php";

if(isset($_GET['item_id'])){
    $qry = $pdo->prepare("SELECT cart_quantity FROM user_item WHERE user_id=? AND item_id_cart=?");
    $qry->execute([$_SESSION['email'], $_GET['item_id']]);
    if($cart = $qry->fetch()){
        $qry = $pdo->prepare("UPDATE user_item SET cart_quantity=? WHERE user_id=? AND item_id_cart=?");
        $qry->execute([++$cart['cart_quantity'], $_SESSION['email'], $_GET['item_id']]);
    }
    else {
        $qry = $pdo->prepare("INSERT INTO user_item(user_id, item_id_cart, cart_quantity) VALUES(?,?, 1) ");
        $qry->execute([$_SESSION['email'], $_GET['item_id']]);
    }
}

if(isset($_GET['remove'])){
    $remove = $pdo->prepare("DELETE FROM user_item WHERE user_id=? AND item_id_cart=?");
    $remove->execute([$_SESSION['email'], $_GET['remove']]);
}

$items = $pdo->prepare("SELECT item_id, item_name, item_description, item_price, item_image_path, cart_quantity
                                FROM items JOIN user_item ui on items.item_id = ui.item_id_cart
                                WHERE user_id = ?;");
$items->execute([$_SESSION['email']]);


function print_cart_item($item_id, $item_name, $item_desc, $item_price, $item_image, $quantity, &$total){
    static $number_of_print = 0;
    echo "
    <!-- PRODUCT -->
            <div class=\"row my-3\" id=\"item1\">
                <div class=\"col-12 col-sm-12 col-md-2 text-center\">
                    <img class=\"img-responsive icon-size \" src=\"". ($item_image ? $item_image :"img/default_food.png" ). "\" alt=\"prewiew\" width=\"120\" height=\"80\">
                </div>
                <div class=\"col-12 text-sm-center col-sm-12 text-md-left col-md-6\">
                    <h4 class=\"product-name\"><strong>". $item_name."</strong></h4>
                    <h4>
                        <small>". $item_desc. "</small>
                    </h4>
                </div>
                <div class=\"col-12 col-sm-12 text-sm-center col-md-4 text-md-right row\">
                    <div class=\"col-3 col-sm-3 col-md-6 text-md-right\" style=\"padding-top: 5px\">
                        <h6><strong>".$item_price. "<span class=\"text-muted\">€</span></strong></h6>
                    </div>
                    <div class=\"col-4 col-sm-4 col-md-4\">
                        <div class=\"quantity\">
                            <input type=\"button\" value=\"+\" class=\"plus\"
                                   onclick=\"addQuantity('quantity".$number_of_print."',".$item_id.")\"/>
                            <input type=\"number\" step=\"1\" max=\"99\" min=\"1\" value=\"". $quantity ."\" title=\"Qty\" class=\"qty\"
                                   size=\"4\" id=\"quantity".$number_of_print."\" onchange=\"quantityChanged('quantity".$number_of_print."',".$item_id.")\">
                            <input type=\"button\" value=\"-\" class=\"minus\"
                                   onclick=\"decreaseQuantity('quantity".$number_of_print."',".$item_id.")\">
                        </div>
                    </div>
                    <div class=\"col-2 col-sm-2 col-md-2 text-right\">
                        <a class=\"btn btn-outline-danger btn-xs\" href='?remove=".$item_id ."'>
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                        </a>
                    </div>
                </div>
                <hr>
            </div>
            <!-- END PRODUCT -->
    ";

    $total += $item_price * $quantity;
    $number_of_print++;
}



?>

<?php
if(isset($_GET['no'])){
    if($_GET['no'] == '1'){
        echo '<h1 class="display-7 text-center mt-3"> Košík je prázdny </h1>';
    }
}
?>

<div class="container">
        <div class="card shopping-cart">
            <div class="d-flex justify-content-between card-header bg-light text-dark">
                <div>
                    <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                    Košík
                </div>
                <a href="index.php" class="btn btn-outline-dark btn-sm pull-right">Pokračovať v nákupe</a>
                <!--<div class="clearfix"></div>-->
            </div>
            <div class="card-body">

                <?php
                $total = 0;
                while ($item = $items->fetch()) {
                    print_cart_item($item['item_id'], $item['item_name'], $item['item_description'],
                        $item ['item_price'], $item['item_image_path'], $item['cart_quantity'], $total);
                }
                ?>

            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between" style="margin: 10px">
                    <div class="pull-right" style="margin: 5px">
                        Celková suma <b id="total"><?php echo number_format($total, 2) . " €" ?></b>
                    </div>

                    <a href="validcheck.php" class="btn btn-primary pull-right">Pokračovať v objednávke</a>

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