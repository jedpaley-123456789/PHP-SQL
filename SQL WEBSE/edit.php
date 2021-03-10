<!DOCTYPE html> 
<html> 
    <head>
        <title>Home Page</title> 
    </head> 
    <?php 
        session_start(); 
        if(!$_SESSION['user']) { 
            header("location:index.php");
        } 
        $user = $_SESSION['user']; 
        $id_exists = false; 
    ?> 

    <body> 
        <h2>Home Page</h2>
        <p>Hello <?php Print "$user"?>!</p> 
        <a href="logout.php">Click to sign out</a> <br> <br> 
        <a href="home.php">Return to home page</a> 

        <h2 align="center">Currently Selected</h2> 
        <h2 align="center">My list</h2>  
        <table border="1px" width="100%"> 
            <tr> 
                <th>Id</th> 
                <th>Details</th> 
                <th>Edit</th> 
                <th>Delete</th> 
            </tr>

            <?php 
                if(!empty($_GET['id'])){
                    $id = $_GET['id']; 
                    $_SESSION['id'] = $id;
                    $id_exists = true; 
                    $con = mysqli_connect("localhost", "root", "", "first_db"); 
                    $query = mysqli_query($con, "SELECT * FROM list WHERE id='$id'"); 
                    $count = mysqli_num_rows($query); 
                    if($count > 0){
                        while($row = mysqli_fetch_arry($query)) { 
                            Print "<tr>"; 
                                Print '<td align="center">' . $row['id'] . "</td>"; 
                                Print '<td align="center">' . $row['details'] . "</td>";
                                Print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                                Print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>"; 
                                Print '<td align="center">' . $row['public'] . "</td>"; 
                            Print "</tr>"; 
                        }
                    } else {
                        $id_exists= false; 
                    }
                } 
            ?> 
        </table> 
        <br> 
        <?php 
            if($id_exists) { 
                print ' 
                <form action="edit.php" method="post">
                Enter New Detail: <input type="text" name="detail"/> <br> 
                Public Post? <input type="text"  name="public[]" value="yes"/> <br> 
                <input type="submit" value="Update list"/>
                ';
            }
            else { 
                Print '<h2 align="center">There is no data to be edited.</h2>';
            } 
        ?> 
    </body> 
</html> 

<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST") {
            $con = mysqli_connect("localhost", "root", "", "first_db"); 
            $details = mysqli_real_escape_string($con, $_POST['details']);
            $public = "no";
            $id = $_SESSION['id']; 
            $time = strfttime("%X");
            $date = strfttime("%B %d, %Y");

            if(isset($_POST['public'])){
                $checkboxes = $_POST['public'];
            } 
            else {
                $checkboxes = array();
            }
            foreach($checkboxes as $list){
                if($list != null) {
                    $public = "yes";
                }
            } 
            mysqli_query($con, "UPDATE list SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'");

        header("location:home.php");
    }
?>


