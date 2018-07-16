<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

$cameraID = $_GET['cameraID'];

$deleteQuery = "DELETE FROM cameradetails WHERE cameraID = '$cameraID'";
$conn->query($deleteQuery);

header("Location: cameras.php");
