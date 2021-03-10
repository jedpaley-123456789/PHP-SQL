<!DOCTYPE html> 
<html> 
    <head> 
        <title>PHP/SQL HOME PAGE</title> 
    </head> 

    <?php 
        session_start(); 

        if(!$_SESSION['user']) { 

            header("location:index.php"); 
        } 

        $user = $_SESSION['user']; 
    ?> 

    <body> 
        <h2>Home Page</h2> 
        <p>Hello <?php  Print "$user"?>!</p>  

        <a href="logout.php">Click here to logout</a> <br> <br> 
        <form action="add.php" method="post"> 
            Add more to list: <input type="text" name="details"/> <br> 
            Public Post? <input type="checkbox" name="public[]" value="yes"/> <br>
            <input type="submit" value="Add to list"/> 
        </form> 

        <h2 align="center">My List</h2> 
        <table border="1px" width="100%"> 
            <tr> 
                <th>Id</th> 
                <th>Details</th>
                <th>Post Time</th> 
                <th>Edit Time</th> 
                <th>Edit</th>
                <th>Delete</th> 
                <th>Public Post</th>
            </tr> 

            <?php 
                $con = mysqli_connect("localhost", "root", "", "first_db");
                $query = mysqli_query($con, "Select * from list");
                while($row = mysqli_fetch_array($query)) {
                    print "<tr>"; 
                    print '<td align="center">' . $row['id'] . "</td>";
                    print '<td align="center">' . $row['details'] . "</td>";
                    print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                    print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                    print '<td align="center"><a href="edit.php">edit</a></td>'; 
                    print '<td align="center"><a href="delete.php">delete</a></td>';
                    print '<td align="center">' . $row['public'] . "</td>"; 
                print "</tr>";

                }
            ?>
        </table> 
        <script> 
            function promptUser(id){
                var r=confirm("Are you sure you want to delete this record?"); 
                if (r==true){
                    window.location.assign("delete.php?id=" + id);
            }
        }
        </script>
    </body>  
</html> 



