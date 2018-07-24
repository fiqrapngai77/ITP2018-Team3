<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

<<<<<<< HEAD


=======
>>>>>>> 81f4c7d68c10e5c9cb000965d01af5f458bc39b9
$ID = $_GET['ID'];

$deleteQuery = "DELETE FROM users WHERE ID = '$ID'";

//Debug code
//$deleteQuery = "DELETE FROM users WHERE ID != '1'";

$conn->query($deleteQuery);

header("Location: manageUser.php");
