<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

$ID = $_GET['ID'];

$deleteQuery = "DELETE FROM requests WHERE username = '$ID'";

//Debug code
//$deleteQuery = "DELETE FROM users WHERE ID != '1'";

$conn->query($deleteQuery);

header("Location: notifications.php");
