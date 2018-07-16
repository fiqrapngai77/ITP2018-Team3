<?php
include 'dbConnection.php';

$cameraName = $_POST['cameraName'];
$location = $_POST['location'];

$insertQuery = "INSERT INTO cameradetails (cameraName, location, state) VALUES ('$cameraName','$location',0)";
$conn->query($insertQuery);

header("Location: cameras.php");

