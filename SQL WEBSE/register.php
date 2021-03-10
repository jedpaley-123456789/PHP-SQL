<!DOCTYPE html> 
<html> 
    <head>
        <title>PHP/SQL Register Page</title> 
    </head>

    <body>
        <h2>Registration Page</h2> 
        <a href="index.php">Click here to go back</a> <br> <br>  

        <form action="register.php" method="post"> 
            Enter Username: <input type="text" name="username" required="required"/> <br> 
            Enter Password: <input type="password" name="password" required="required"/> <br>
            <input type="submit" value="register">
        </form>
    </body> 
</html> 
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $con = mysqli_connect("localhost", "root", "", "first_db"); 
        if(mysqli_connect_errno()) { 
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']); 
        
        $bool = true;

        $query = mysqli_query($con, "Select * from users");
        while( $row = mysqli_fetch_array($query)) {
            $table_users = $row['username'];
            if($username == $table_users){ 
                $bool = false; 
                print '<script>alert("Username has been taken");</script>';
                print '<script>window.location.assign(register.php)</script>';

                }
            }
            if ($bool) {
                mysqli_query($con, "INSERT INTO users (username, password) Values ('$username', '$password')"); 
                print '<script>alert("Successfuly Registered!");</script>';
                print '<script>window.location.assign("register.php");</script>'; 
        }
    } 
?>
