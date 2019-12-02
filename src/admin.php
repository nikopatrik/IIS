<?php
session_start();
include_once "dbConfig.php";
$requested_user = "";

if(!isset($_SESSION['email'])){
    $new_user = $pdo->prepare("INSERT INTO users(user_email,user_type, user_password) VALUES (?,'N','nothing')");
    $guid = uniqid('non_registered_') . "@nonregistered.xx";
    $new_user->execute([$guid]);
    $_SESSION['email'] = $guid;
}

if(isset($_SESSION['email'])){
    $admin = $_SESSION['email'];
    $select = "SELECT * FROM users WHERE user_email = :email";
    $sql = $pdo->prepare($select);
    $sql->execute(['email' => $admin]);
    $result = $sql->fetch();
    if(!($result['user_type'] ==='A')){
        header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
    }
}else{
    header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
}


if($_SERVER["REQUEST_METHOD"] == 'GET'){
    $print_results =0;
    if(!(isset($_GET['email'])&& $_GET['email'] != "")){
        $searched_word = "";
        if(!empty($_GET['searched_word']))
            $searched_word = $_GET['searched_word'];

        $where = "";
        if(!($_GET['admin']=='on' && $_GET['operator']=='on' && $_GET['driver']=='on' && $_GET['customer']=='on')){
            if($_GET['admin']=='on')
                $where = $where."user_type='A'-";
            if($_GET['operator']=='on')
                $where = $where."user_type='O'-";
            if($_GET['driver']=='on')
                $where = $where."user_type='D'-";
            if($_GET['customer']=='on')
                $where = $where."user_type='C'-";

            if(!empty($where)){
                $where = substr($where, 0, -1);
                $where = str_replace("-"," OR ", $where);
                $where = "WHERE ".$where;
            }
        }

        $query = "SELECT * FROM users ".$where;
        $stmt =$pdo->query($query);
        $results =[];

        if(isset($_GET['searched_word']) && $_GET['searched_word']!= ""){
            while($user=$stmt->fetch()){
                switch ($_GET['searched_value']){
                    case 8:     // Email
                        if(substr($user['user_email'],0,strlen($_GET['searched_word'])) == $_GET['searched_word']){
                            array_push($results,$user);
                        }
                        break;
                    case 1:     // Street
                        if(substr($user['user_street'],0,strlen($_GET['searched_word'])) == $_GET['searched_word']){
                            array_push($results,$user);
                        }
                        break;
                    case 2:     // City
                        if(substr($user['user_city'],0,strlen($_GET['searched_word'])) == $_GET['searched_word']){
                            array_push($results,$user);
                        }
                        break;
                    case 3:     //  ZipCode
                        if(substr($user['user_zip_code'],0,strlen($_GET['searched_word'])) == $_GET['searched_word']){
                            array_push($results,$user);
                        }
                        break;
                    case 4:     //  Name
                        if(substr($user['user_name'],0,strlen($_GET['searched_word'])) == $_GET['searched_word']){
                            array_push($results,$user);
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        if(count($results) == 1){
            $requested_user = $results[0]['user_email'];
        } else {
            $print_results=1;
        }
    } else {
        $requested_user = $_GET['email'];
    }
    if(!empty($requested_user))
        $_SESSION['requested_user']=$requested_user;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){ //&&
    $useremail = $_SESSION['requested_user'];
    if(isset($_SESSION['requested_user']) && ($_SESSION['requested_user']!="")){
        if(isset($_POST['new_name'])){
            $stmt=$pdo->prepare('UPDATE users SET user_name=? WHERE user_email=?');
            $stmt->execute([$_POST['new_name'],$useremail]);
        }

        if(isset($_POST['new_phone_number'])){
            $stmt=$pdo->prepare('UPDATE users SET user_phone_number=? WHERE user_email=?');
            $stmt->execute([$_POST['new_phone_number'],$useremail]);
        }

        if(!empty($_POST['new_city'])){
            $stmt=$pdo->prepare('UPDATE users SET user_city=? WHERE user_email=?');
            $stmt->execute([$_POST['new_city'],$useremail]);
        }

        if(!empty($_POST['new_zip'])){
            $stmt=$pdo->prepare('UPDATE users SET user_zip_code=? WHERE user_email=?');
            $stmt->execute([$_POST['new_zip'],$useremail]);
        }

        if(!empty($_POST['new_street'])){
            $stmt=$pdo->prepare('UPDATE users SET user_street=? WHERE user_email=?');
            $stmt->execute([$_POST['new_street'],$useremail]);
        }

        if(!empty($_POST['new_street_number'])) {
            $stmt = $pdo->prepare('UPDATE users SET user_street_number=? WHERE user_email=?');
            $stmt->execute([$_POST['new_street_number'], $useremail]);
        }

        if(!empty($_POST['new_role'])){
            $stmt=$pdo->prepare('UPDATE users SET user_type=? WHERE user_email=?');
            $stmt->execute([$_POST['new_role'],$useremail]);
        }
    }
}
if(!empty($_SESSION['requested_user'])){
    $query_requested_user = $pdo->prepare('SELECT * FROM users WHERE user_email=?');
    $query_requested_user->execute([$_SESSION['requested_user']]);
    $requested_user_result = $query_requested_user->fetch();
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

        label {
            margin-top: 0.75rem;
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
<?php
include "navigation-bar.php";
?>
<div class="container mt-3" >
    <form action="admin.php" method="GET">
        <div class="d-flex form-group justify-content-center">
            <div>
                <input type="text" name ="searched_word" class="form-control" id="keyword" aria-describedby="Keyword"
                      placeholder="Keyword you want to look for!">
                <small id="keywordHelp" class="form-text text-muted">Write keyword and choose type of the keyword to
                    look for in user database</small>
            </div>

            <select class="custom-select ml-2" name="searched_value" style="width: 15rem;">
                <option selected value="8">Email</option>
                <option value="4">Meno užívateľa</option>
                <option value="1">Street</option>
                <option value="2">City</option>
                <option value="3">ZipCode</option>
            </select>

            <button type="submit" class="btn btn-primary align-self-start ml-2">Hľadať</button>
            <a  class="btn btn-light align-self-start ml-2" href="admin-new-user.php">Vytvoriť nového uživateľa</a>
        </div>
        <div class="d-flex justify-content-center">

            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="admin" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label mx-5" for="customCheck1">Admin</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="operator" class="custom-control-input" id="customCheck2">
                <label class="custom-control-label mx-5" for="customCheck2">Operátor</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="driver" class="custom-control-input" id="customCheck3">
                <label class="custom-control-label mx-5" for="customCheck3">Vodič</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="customer" class="custom-control-input" id="customCheck4">
                <label class="custom-control-label mx-5" for="customCheck4">Normálny uživateľ</label>
            </div>
        </div>
    </form>
</div>

<hr>

<div class="container">
    <div class="d-flex flex-column container mt-3 justify-content-center">

        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOu">
                    <h2 class="mb-0">
                        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseOu" aria-expanded="false" aria-controls="collapseOu">
                            <strong> Info </strong>
                        </button>
                    </h2>
                </div>
                <div id="collapseOu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <?php echo '
                        <p><strong>Primárny klúč(Email): </strong>'.$requested_user_result['user_email'].'</p>'; ?>
                    </div>
                </div>
            </div>
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
                        <form action="admin.php" method="POST" class="needs-validation" novalidate>
                            <div class="form-row justify-content-around align-items-center">
                                <div class="col-auto">
                                    <label for="inlineFormInput">Meno a Priezvisko</label>
                                    <?php echo '
                                <input type="text" name="new_name" value="'.$requested_user_result['user_name'].'" class="form-control mb-2"  pattern="[A-Za-z\s\u0080-\u9fff]+" id="inlineFormInput" placeholder="Meno Uživateľa" minlength="2"  maxlength="100">';
                                    ?>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-auto">
                                    <label for="inlineFormInput2" >Email</label>
                                    <?php echo '
                                <input type="email" name="new_email" class="form-control mb-2" maxlength="100" id="inlineFormInput2" value="'.$requested_user_result['user_email'].'" placeholder="Email uživateľa" disabled>';
                                    ?>

                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                </div>

                            </div>
                            <div class="form-row justify-content-around align-items-center">
                                <div class="col-auto width">
                                    <label for="inlineFormInput3">Telefónne číslo</label>
                                    <?php
                                    echo '
                                <input type="text" name="new_phone_number" value="'.$requested_user_result['user_phone_number'].'" minlength="9" maxlength="13" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" class="form-control mb-2" id="inlineFormInput3" placeholder="+421 900 111 222">';
                                    ?>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
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
                            <input type="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputName5" placeholder="Nové heslo">
                            <input type="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputName6" placeholder="Znovu nové heslo">

                            <button type="submit" class="btn btn-primary mb-2">Zmeniť heslo</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree"  >
                    <h2 class="mb-0">
                        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <strong> Adresa </strong>
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="admin.php" method="POST" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="street">Ulica</label>
                                <?php echo '
                            <input type="text" value="'.$requested_user_result['user_street'].'" name="new_street" pattern="[A-Za-z\s\u0080-\u9fff]+" class="form-control" id="street" minlength="2" maxlength="100">';?>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>

                                <label for="streetnumber">Číslo popisné</label>
                                <?php echo '
                            <input type="text" value="'.$requested_user_result['user_street_number'].'" pattern="(([0-9])+([/][0-9]+)?)" name="new_street_number" class="form-control" id="streetnumber" maxlength="10">'; ?>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>

                                <label for="city">Mesto</label>
                                <?php echo '
                            <input type="text" name="new_city" value="'.$requested_user_result['user_city'].'" pattern="[A-Za-z\s\u0080-\u9fff]+" class="form-control" id="city" maxlength="100">'; ?>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>

                                <label for="zip">PSČ</label>
                                <?php echo '
                            <input type="text" minlength="5" value="'.$requested_user_result['user_zip_code'].'" pattern="[0-9]+" maxlength="5" name="new_zip"  class="form-control" id="zip">'; ?>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Uložiť adresu</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <strong> Práva </strong>
                        </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <form method="post" class="form-inline d-flex justify-content-between">
                            <div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio"  value="A" id="customRadioInline1" name="new_role"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline1">Administrátor</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio"  value="O" id="customRadioInline2" name="new_role"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Operátor</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="D" id="customRadioInline3" name="new_role"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline3">Vodič</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" value="C" id="customRadioInline4" name="new_role"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline4">Normálny
                                        uživateľ</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mb-2 ">Zmeniť rolu</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFive">
                    <h2 class="mb-0">
                        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <strong> Objednávky </strong>
                        </button>
                    </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                    <div class="card-body">
                        <?php
                        $user_stmt = $pdo->prepare('SELECT * FROM orders WHERE order_owner=? ORDER BY order_date DESC');
                        $user_stmt->execute([$_SESSION['requested_user']]);
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
                            $total_price =0;
                            $item_stmt = $pdo->prepare('SELECT distinct i.item_name, i.item_price, oi.number_of_items FROM items i,order_items oi,orders o WHERE item_id=item_in_order and order_of_item=?');
                            $item_stmt->execute([$order['order_id']]);
                            while ($item = $item_stmt->fetch()){
                                $price = $item['item_price'] * $item['number_of_items'];
                                $total_price += $price;
                                echo "
                            <li class=\"d-flex list-group-item justify-content-between\">
                                <div>".$item['item_name']. " x ".$item['number_of_items']."</div>
                                <div>".$price." €"."</div>
                            </li>

                            ";

                            }
                            echo "
                            <li class=\"d-flex list-group-item justify-content-between\">
                                <div>Spolu</div>
                                <div>".$total_price." €"."</div>
                            </li>
                            </ul>
                            </div>
                        </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingSix">
                    <h2 class="mb-0">
                        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <strong> Vymazať uživateľa </strong>
                        </button>
                    </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                    <div class="card-body">
                        <form class="form-inline">
                            <input type="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputName10" placeholder="Heslo pre potvrdenie">

                            <button type="submit" class="btn btn-primary mb-2">Vymazať</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="list-group">
        <?php
        if($print_results)
            foreach ($results as $user){
                echo '
            <a href="?email='.$user['user_email'].'" class="list-group-item list-group-item-action">
                '.$user['user_email'].'
            </a>';
            }
        ?>
    </div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>
</html>