<?php 
    session_start();
    if(!$_SESSION['user']){
        header("location:index.php");
    } 

    if ($_SERVER['REQUEST_METHOD'] = "POST"){
    $con = mysqli_connect("localhost", "root", "", "first_db"); 
    $details = mysqli_real_escape_string($con, $_POST['details']); 
    $time = strftime("%X"); 
    $date = strftime("%B %d, %Y"); 
    $decision = "no";
    Print "$time - $date - $details"; 

    if(isset($_POST['public'])){ 
        $checkboxes = $_POST['public'];
    } 
    else { 
        $checkboxes = array(); 
    } 
    foreach($checkboxes as $each_check){
        if($each_check != null) {
            $decision = "yes";
        }
    } 

    mysqli_query($con, "INSERT INTO list (details, date_posted, time_posted, public) VALUES ('$details', '$date', '$time', '$decision')"); 
    header("location:home.php");
    }
    else {
        header("location:home.php");
    }
?> 