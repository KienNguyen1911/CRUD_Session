<?php 
session_start();
$id = $_GET['id'];
unset($_SESSION['student'][$id]);
header('location: listStudent.php');
?>