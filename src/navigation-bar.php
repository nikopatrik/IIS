
<nav class="navbar navbar-expand-md navbar-dark justify-content-between celadon-green ">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="img/papocadologo.png" width="50" height="50" alt=""> <i> Papocado </i>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <form class="form-inline mx-auto" method="get" action="index.php">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Vyhľadať reštaurácie" aria-label="Search" id="search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Hľadať</button>
            </form>


            <div class="navbar-nav">
                <ul class="navbar-nav">
<?php

   include_once 'dbConfig.php';

   $is_logged_in = false;
   $is_admin = false;
   $is_operator = false;
   $is_driver = false;
   $name_of_user = isset($_SESSION['email'])?$_SESSION['email']:'';

   if(isset($_SESSION['email'])){
       $is_logged_in = true;

       $result = $pdo->prepare("SELECT user_email, user_type FROM iisdb.users WHERE user_email=?");
       $result->execute([$name_of_user]);
       $user = $result->fetch();

   }

   if($user['user_type'] === 'N')
       $is_logged_in = false;

   if($user['user_type'] === 'A'){
       $is_admin = true;
       $is_operator = true;
       $is_driver = true;
   }
   else if ($user['user_type'] === 'O'){
       $is_operator = true;
   }
   else if ($user['user_type'] === 'D'){
       $is_driver = true;
   }

   if($is_logged_in) {
       echo '
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
       echo $name_of_user;
       echo '
                        </a>
       
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="profile.php">Profil</a>
                            <a class="dropdown-item" href="profile.php#orders">Moje objednávky</a>';

       if($is_driver) { echo '<a class="dropdown-item" href="driver.php">Vodič</a>'; }
       if($is_operator) { echo '<a class="dropdown-item" href="operator.php">Operátor</a>'; }
       if($is_admin) { echo '<a class="dropdown-item" href="admin.php">Admin</a>'; }


         echo '
                            <a class="dropdown-item" href="signout.php">Odhlásiť sa</a>
       
                        </div>
                    </li> 
   ';
   }
   else {

       echo '
                    <li class="nav-item">
                    <a class="nav-link" href="login.php">
                    Prihlásiť sa
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="signup.php">
                    Registrovať sa
                    </a>
                    </li>
                    ';
   }

?>

                    <li class="nav-item">
                        <a class="nav-link" href="shoppingcart.php">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</nav>

