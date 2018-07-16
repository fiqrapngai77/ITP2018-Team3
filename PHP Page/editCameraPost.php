<?php
include 'dbConnection.php';

$newCameraID = $_POST['cameraID'];
$newCameraName = $_POST['cameraName'];
$newLocation = $_POST['location'];
$updateQuery = "UPDATE cameradetails SET cameraName = '$newCameraName', location = '$newLocation' WHERE cameraID = '$newCameraID'";
$result = $conn->query($updateQuery);



header("Location: cameras.php");
