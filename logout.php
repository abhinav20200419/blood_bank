<?php 
session_start();

if(isset($_SESSION['user_id']))
{
    unset($_SESSION['user_id']);
}

if(isset($_SESSION['hospital_id']))
{
    unset($_SESSION['hospital_id']);
}

session_unset();
session_destroy();
header('location:index.php');
?>