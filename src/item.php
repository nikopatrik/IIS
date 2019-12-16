<?php

include_once "dbConfig.php";
session_start();


if(!isset($_SESSION['email'])){
    $new_user = $pdo->prepare("INSERT INTO users(user_email,user_type, user_password) VALUES (?,'N','nothing')");
    $guid = uniqid('non_registered_') . "@nonregistered.xx";
    $new_user->execute([$guid]);
    $_SESSION['email'] = $guid;
}


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


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['item_id'])){
        $item_id = $_POST['item_id'];
    }
    if(isset($_POST['business_id'])){
        $business_id = $_POST['business_id'];
    }

    if(isset($_POST['item_name'])){
        $item_name = $_POST['item_name'];
    }
    if(isset($_POST['item_desc'])){
        $item_desc = $_POST['item_desc'];
    }
    if(isset($_POST['item_price'])){
        $item_price = $_POST['item_price'];
    }
    if(isset($_POST['item_type'])){
        if($_POST['item_type'] == 'Normálna')
            $item_cat = 'N';
        else if($_POST['item_type'] == 'Vegetariánska')
            $item_cat = 'W';
        else if($_POST['item_type'] == 'Vegánska')
            $item_cat = 'V';
        else if($_POST['item_type'] == 'Bezlepková')
            $item_cat = 'G';
        else if($_POST['item_type'] == 'Nápoj')
            $item_cat = 'D';
    }
    if(isset($_POST['item_cat'])){
        if($_POST['item_cat'] == 'Denná ponuka')
            $item_type = 'D';
        else if($_POST['item_cat'] == 'Stála ponuka')
            $item_cat = 'O';
    };
    if(isset($_POST['item_limit'])){
        $item_limit = $_POST['item_limit'];
    }
    else $item_limit=0;



    $error_msg = false;
    if(isset($_FILES['item_pic'])) {
        $target_dir = "img/";
        $item_pic = $target_dir . basename($_FILES["item_pic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($item_pic, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["item_save"])) {
            $check = getimagesize($_FILES["item_pic"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $error_msg= "File is not an image.";
                $uploadOk = 0;
            }
        }

        if ($uploadOk == 0) {
            $error_msg=  "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["item_pic"]["tmp_name"], $item_pic)) {
                $error_msg= "The file ". basename( $_FILES["item_pic"]["name"]). " has been uploaded.";
            } else {
                $error_msg= "Sorry, there was an error uploading your file.";
            }
        }
    }


    if(!empty($_POST['item_id'])){
        $update_item = $pdo->prepare("UPDATE items SET item_name=?, item_description=?, item_price=?, item_category=?,
                 item_type=?, item_image_path=?, item_limit=?, item_business=? WHERE item_id=?");
        $update_item->execute([$item_name, $item_desc, $item_price, $item_cat, $item_type, $item_pic, $item_limit,$business_id, $item_id]);

    }
    else {
        $new_item = $pdo->prepare("INSERT INTO items( item_name, item_description, item_price, 
                  item_category, item_type, item_image_path, item_limit, item_business) VALUES(?,?,?,?,?,?,?,?)");
        $new_item->execute([$item_name, $item_desc, $item_price, $item_cat, $item_type, $item_pic, $item_limit,$business_id]);
   }
}

//header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/bussiness.php?keyword={$business_id}&attribute=ID+prevádzky");
