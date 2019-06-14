<?php
    session_start();
    $machine=$_GET['machine'];
    $_SESSION['machine']=$machine;
    header('location: terminal.php');
    exit;
?>