<?php
//including the database connection file
include("configer.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$sql = "DELETE FROM users WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

//redirecting to the display page (indexz.php in our case)
header("Location:indexz.php");
?>