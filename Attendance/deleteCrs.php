<?php

session_start();
    $id=(isset($_POST['id']))?(int)$_POST['id']:-1;
$_SESSION['MSG']="line $id was deleted";

    include 'db_func.php';
    $mysqli= openDb();
    $q = "DELETE FROM `courses` WHERE id=$id";
    $result = mysqli_query($mysqli,$q);

    header("location:displayCrs.php");
