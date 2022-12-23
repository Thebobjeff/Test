<?php
// including the database connection file
include_once("configer.php");

if(isset($_POST['update']))
{   
    $id = $_POST['id'];
    
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $age = $_POST['age']; 
    
    // checking empty fields
    if(empty($Fname) || empty($Lname) ||empty($age)) {  
            
        if(empty($Fname)) {
            echo "<font color='red'>First name field is empty.</font><br/>";
        }
        if(empty($Lname)) {
            echo "<font color='red'>Last name field is empty.</font><br/>";
        }
        
        if(empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }       
    } else {    
        //updating the table
        $sql = "UPDATE users SET Fname=:Fname,Lname=:Lname, age=:age WHERE id=:id";
        $query = $dbConn->prepare($sql);
                
        $query->bindparam(':id', $id);
        $query->bindparam(':Fname', $Fname);
        $query->bindparam(':Lname', $Lname);
        $query->bindparam(':age', $age);
        $query->execute();
        
        // Alternative to above bindparam and execute
        // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
                
        //redirectig to the display page. In our case, it is indexz.php
        header("Location: indexz.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM users WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $Fname = $row['Fname'];
    $Lname = $row['Lname'];
    $age = $row['age'];
}
?>
<html>
<head>  
    <title>Edit Data</title>
</head>

<body>
    <a href="indexz.php">Home</a>
    <br/><br/>
    
    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Fname</td>
                <td><input type="text" name="Fname" value="<?php echo $Fname;?>"></td>
            </tr>
            <tr> 
                <td>Lname</td>
                <td><input type="text" name="Lname" value="<?php echo $Lname;?>"></td>
            </tr>
            <tr> 
                <td>Age</td>
                <td><input type="text" name="age" value="<?php echo $age;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>