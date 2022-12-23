<html>
<?php

include_once("configer.php");
?>
<table width='90%' border=0>

<tr bgcolor='#CCCCCC'>
    <td>ID</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Age</td>
    <td>Update</td>
</tr>
<?php
    if(isset($_POST['Submit'])) {  
        $id = $_POST['id']; 
        
            
        // checking empty fields
        if(empty($id) ) {
                    
            if(empty($id)) {
                echo "<font color='red'> Your ID feild if empty</font><br/>";
            }
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        }
         else { 
            //selecting data associated with this particular id
            $sql = "SELECT * FROM users WHERE id=:id";
            $query = $dbConn->prepare($sql);
            $query->execute(array(':id' => $id));
            
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                
                echo "<td>".$row['id'] . "</td>";
                echo "<td>".$row['Fname']."</td>";
                echo "<td>".$row['Lname']."</td>";
                echo "<td>".$row['age']."</td>";  
                echo "<td><a href=\"edit.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";       

            }
            }
            
        }
    
    
    ?>
    </table>
    </html>
