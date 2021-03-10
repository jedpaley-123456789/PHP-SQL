<?php 
    session_start(); 
    if(!$_SESSION['user']){
        header("location:index.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        $con = mysqli_connect("localhost", "root", "", "first_db"); 
        $id = $_GET['id']; 
        mysqli_query($con, "DELETE FROM list WHERE id='$id'"); 
        header("location:home.php");
    }
?>