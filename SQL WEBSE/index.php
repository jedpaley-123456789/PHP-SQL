<!DOCTYPE html> 
    <head> 
        <title>PHP/SQL Login Page</title>
    </head> 

    <body> 
        <?php 
            echo "<p>Hello, World!</p>";
            ?> 
            <a href="login.php">Click here to login</a><br> 
            <a href="register.php">Click here to register</a> 
    </body> 
    <br>
    <h2 align="center">List</h2>
    <table width="100%" border="1px"> 
        <tr> 
            <th>ID</th>
            <th>Details</th>
            <th>Post Time</th> 
            <th>Edit Time</th> 
        </tr>
        <?php
            $con = mysqli_connect("localhost", "root", "", "first_db"); 
            $query = mysqli_query($con, "Select * from list Where public='yes'"); 
            while($row = mysqli_fetch_array($query)) {
                print "<tr>"; 
                    print '<td align="center">' . $row['id'] . "</td>";
                    print '<td align="center">' . $row['details'] . "</td>";
                    print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                    print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                print "</tr>"; 
            }
        ?>
    </table>
</html>
    
    

