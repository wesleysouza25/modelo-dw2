<?php
session_start();
if ($_SESSION['login'] == null)
    header('location: view/login.php');
else
     header('location: view/principal.php');

?>  