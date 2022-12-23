<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("configer.php");

if(isset($_POST['Submit'])) {   
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $age = $_POST['age'];
        
    // checking empty fields
    if(empty($Fname)  || empty($Lname) || empty($age)) {
                
        if(empty($Fname)) {
            echo "<font color='red'> First name field is empty.</font><br/>";
        }
        if(empty($Lname)){
            echo"<font color ='red'> Last name field is empty.</font><br/>";
        }
        
        if(empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
        // if all the fields are filled (not empty) 
            
        //insert data to database       
        $sql = "INSERT INTO users(Fname, Lname, age) VALUES(:Fname, :Lname, :age)";
        $query = $dbConn->prepare($sql);
                
        $query->bindparam(':Fname', $Fname);
        $query->bindparam(':Lname', $Lname);
        $query->bindparam(':age', $age);
        $query->execute();
        
        // Alternative to above bindparam and execute
        // $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='indexz.php'>View Result</a>";
    }
}
?>
</body>
</html>