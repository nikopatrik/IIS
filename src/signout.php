<?php

session_start();
session_unset($_SESSION['email']);
header("Location: http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/index.php");
exit();