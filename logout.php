<?php
session_start();
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    session_destroy();
}
if(isset($_SESSION['penulis'])){
    unset($_SESSION['penulis']);
    session_destroy();
}
header('Location: login.php');
?>