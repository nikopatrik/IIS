<?php
include_once "dbConfig.php";
session_start();


if(isset($_SESSION['email'])){
    $qry = $pdo->prepare("SELECT user_type FROM users WHERE user_email=?");
    $qry->execute([$_SESSION['email']]);
    $type = $qry->fetch();
    if($type['user_type'] != 'A' and $type['user_type'] != 'O'){
        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
        return;
    }

}
else {
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
    return;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
    }
    $attribute = 'business_id';

    if(isset($_GET['attribute'])){
        $getattr = $_GET['attribute'];
        if($getattr === 'ID prevádzky'){
            $attribute = 'business_id';
        }
        else if($getattr === 'Názov prevádzky'){
            $attribute = 'business_name';
        }
    }

    $businesses = $pdo->prepare("SELECT business_id, business_name, business_street, business_street_number, business_city, 
       business_zip, business_closing_time, business_picture_path FROM businesses WHERE ".$attribute."=?");
    $businesses->execute([$keyword]);
    $business = $businesses->fetch();
    $business_id = $business['business_id'];

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['create'])){
        $create = true;
    }
    else if(isset($_POST['edit'])){
        $edit= true;
    }

    if(isset($_POST['business_id'])){
        $business_id = $_POST['business_id'];
    }

    if(isset($_POST['business_name'])){
        $business_name= $_POST['business_name'];
    }


    if(isset($_POST['business_street'])){
        $business_street= $_POST['business_street'];
    }

    if(isset($_POST['business_street_num'])){
        $business_street_num= $_POST['business_street_num'];
    }

    if(isset($_POST['business_city'])){
        $business_city= $_POST['business_city'];
    }

    if(isset($_POST['business_zip'])){
        $business_zip= $_POST['business_zip'];
    }

    if(isset($_POST['business_closingTime'])){
        $business_closingTime= $_POST['business_closingTime'];
    }

    $error_msg = false;
    if(isset($_FILES['business_picture'])) {
        $target_dir = "img/";
        $business_picture = $target_dir . basename($_FILES["business_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($business_picture, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["edit"]) or isset($_POST["create"])) {
            $check = getimagesize($_FILES["business_picture"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $error_msg = "File is not an image.";
                $uploadOk = 0;
            }
        }

        if ($uploadOk == 0) {
            $error_msg = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["business_picture"]["tmp_name"], $business_picture)) {
                $error_msg = "The file ". basename( $_FILES["business_picture"]["name"]). " has been uploaded.";
            } else {
                $error_msg = "Sorry, there was an error uploading your file.";
            }
        }
    }


    if($create){
        $business_exist =  $pdo->prepare("SELECT business_id FROM businesses WHERE business_name=?");
        $business_exist->execute([$business_name]);
        if(!$business_exist->fetch()){
            $new_business = $pdo->prepare("INSERT INTO businesses(business_name, business_street, business_street_number, 
                       business_city, business_zip, business_closing_time, business_picture_path) VALUES (?,?,?,?,?,?,?)");
            $new_business->execute([$business_name, $business_street, $business_street_num, $business_city, $business_zip,
                $business_closingTime, $business_picture]);
            $business_exist->execute(([$business_name]));
            $business_id = $business_exist['business_id'];
            header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/bussiness.php?keyword={$business_id}&attribute=ID+prevádzky");

        }
        else {
            $error_msg = "Daná prevádzka už existuje!";
        }
    }
    else if($edit){
        $business_exist = $pdo->prepare("SELECT business_id FROM businesses WHERE business_id=?");
        $business_exist->execute([$business_id]);
        if($business_exist->fetch()){
            $edit_business = $pdo->prepare("UPDATE businesses SET business_name=?, business_street=?, business_street_number=?,
                    business_city=?, business_zip=?, business_closing_time=?, business_picture_path=?  WHERE business_id=?");
            if($edit_business->execute([$business_name, $business_street, $business_street_num, $business_city, $business_zip,
                $business_closingTime, $business_picture, $business_id])) {
                header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/bussiness.php?keyword={$business_id}&attribute=ID+prevádzky");
            }

        }
        else {
            $error_msg = "Daná prevádzka neexistuje!";
        }
    }
}

function print_item($item, $business_id){
    static $count = 0;
    $n_sel= "";
    $w_sel="";
    $v_sel="";
    $g_sel="";
    $d_sel="";

    if($item['item_type'] == 'N'){
        $n_sel = "selected";
    }
    else if($item['item_type'] == 'W'){
        $w_sel = "selected";
    }
    else if($item['item_type'] == 'V'){
        $v_sel = "selected";
    }
    else if($item['item_type'] == 'G'){
        $g_sel = "selected";
    }
    else if($item['item_type'] == 'D'){
        $d_sel = "selected";
    }


    $cn_sel ="";
    $cd_sel ="";

    if($item['item_category'] == 'O'){
        $cn_sel = "selected";
    }
    else if($item['item_category'] == 'D'){
        $cd_sel = "selected";
    }

    echo "
            <div class=\"card\">
            <div class=\"d-flex card-header justify-content-between\" id=\"heading{$count}\">
                <h2 class=\"mb-0 clickable-card\">
                    <button class=\"btn\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapse{$count}\" aria-expanded=\"true\" aria-controls=\"collapse{$count}\">
                        <strong>#".$item['item_id']." ". $item['item_name']."</strong>
                    </button>
                </h2>
                <button class=\"btn btn-light ml-5\"><i class=\"fas fa-trash-alt\"></i></button>
            </div>

            <div id=\"collapse{$count}\" class=\"collapse hide\" aria-labelledby=\"heading{$count}\" data-parent=\"#accordionExample\">
                <div class=\"card-body\">
                    <form method='post' action='item.php' enctype='multipart/form-data'>
                        <div class=\"row\">
                        <input name='business_id' type=\"text\" readonly class=\"form-control-plaintext invisible\" placeholder=\"ID\" value='".$business_id."'>
                            <div class=\"col my-2\">
                                <input name='item_id' type=\"text\" readonly class=\"form-control-plaintext \" placeholder=\"ID\" value='".$item['item_id']."'>
                            </div>
                            <div class=\"col my-2\">
                                <input name='item_name' type=\"text\" class=\"form-control\" placeholder=\"Názov\" value='".$item['item_name']."'> 
                            </div>
                            <div class=\"col my-2\">
                                <input name='item_desc' type=\"text\" class=\"form-control\" placeholder=\"Popis\" value='".$item['item_description']."'>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col my-2\">
                                <input name='item_price' type=\"text\" class=\"form-control\" placeholder=\"Cena\" style=\"font-weight: bold\" value='".$item['item_price']."'>
                            </div>
                            <div class=\"col my-2\">
                                <select class=\"custom-select\" name='item_type'>
                                    <option {$n_sel}>Normálna</option>
                                    <option {$w_sel}>Vegetariánska</option>
                                    <option {$v_sel}>Vegánska</option>
                                    <option {$g_sel}>Bezlepková</option>
                                    <option {$d_sel}>Nápoj</option>
                                </select>
                            </div>
                            <div class=\"col my-2\">
                                <select class=\"custom-select\" id=\"offerType\" name='item_cat'
                                        onchange=\"isDailyOfferItem = function (){
                                            if(document.getElementById('offerType').value ==='Denná ponuka'){
                                                document.getElementById('limit').disabled = false;
                                                console.log('should be visible');
                                            }
                                            else{
                                                document.getElementById('limit').disabled = true;
                                                console.log('should not');
                                            }
                                        }; isDailyOfferItem()\">
                                    <option {$cn_sel}>Stála ponuka</option>
                                    <option {$cd_sel}>Denná ponuka</option>
                                </select>
                            </div>

                        </div>

                        <div class=\"row\">
                            <div class=\"col my-2\">
                                <div class=\"custom-file\">
                                    <input type=\"file\" class=\"custom-file-input\" id=\"customFile1\" name='item_pic'>
                                    <label class=\"custom-file-label\" for=\"customFile\">Vybrať fotku</label>
                                </div>
                            </div>
                            <div class=\"col my-2\">
                                <button type=\"submit\" class=\"btn btn-primary\" name='item_save' style=\"width: 100%\"> Uložiť </button>
                            </div>
                            <div class=\"col my-2\" >
                                <input id=\"limit\" name='item_limit' type=\"text\" class=\"form-control\" placeholder=\"Počet položiek dennej ponuky\" disabled/>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>";
    $count++;
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

    <form method="post" action="bussiness.php" enctype="multipart/form-data">
        <h1 class="display-7 text-center"> Údaje o prevádzke </h1>
        <h5> <?php if($error_msg) echo $error_msg; ?></h5>

        <div class="form-group">
            <input type="text"  readonly class="form-control-plaintext my-2" placeholder="ID" value="<?php echo $business['business_id']; ?>" name="business_id" />
            <input type="text" class="form-control my-2" placeholder="Názov" value="<?php echo $business['business_name']; ?>" name="business_name"/>

        </div>

        <div class="form-group">
            <label><strong> Adresa </strong></label>
            <div class="row my-2">
                <div class="col"><input type="text" class="form-control" placeholder="Ulica" name="business_street" value="<?php echo $business['business_street']; ?>"/></div>
                <div class="col-4"><input type="text" class="form-control" placeholder="Číslo" name="business_street_num" value="<?php echo $business['business_street_number']; ?>"/></div>
            </div>
            <div class="row my-2">
                <div class="col"><input type="text" class="form-control" placeholder="Mesto" name="business_city" value="<?php echo $business['business_city']; ?>"/></div>
                <div class="col-4"><input type="text" class="form-control" placeholder="PSČ" name="business_zip" value="<?php echo $business['business_zip']; ?>"/></div>
            </div>

        </div>

        <div class="form-group">
            <label><strong> Other </strong></label>
            <input type="time" placeholder="Zadajte čas uzávierky"  class="form-control my-2" name="business_closingTime" value="<?php echo $business['business_closing_time']; ?>">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="business_picture">
                <label class="custom-file-label" for="customFile">Vybrať fotku</label>
            </div>

        </div>

        <button class="btn btn-primary my-2" type="submit" name="create">Vytvoriť</button>
        <button class="btn btn-primary my-2" type="submit" name="edit">Upraviť</button>

    </form>

</div>
<hr>

<div class="container">
    <h1 class="display-7 text-center"> Ponuka </h1>

    <div class="accordion" id="accordionExample">
        <?php
        $items = $pdo->prepare("SELECT item_id, item_name, item_description, item_price, item_category, item_type, 
        item_image_path, item_limit, item_business FROM items WHERE item_business=?");
        $items->execute([$business_id]);

        $itemsALL = $items->fetchAll();
        foreach ($itemsALL as $item) {
            print_item($item, $business_id);
        }

        print_item(array('item_id'=>"", 'item_name'=>"", 'item_description'=>"", 'item_price'=>"", 'item_category'=>"",
            'item_type'=>""), $business_id)
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