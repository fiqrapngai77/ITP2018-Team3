<?php
include 'dbConnection.php';

$username = $_POST['user'];

$query = "SELECT * FROM users WHERE user = '$username'" ;
$result = $conn->query($query);

//of the name of the user matches a row
if ($result->num_rows > 0) {
    $requestQuery = "INSERT INTO requests (username, requestType) VALUES ('$username', 'forgotPassword')";
    $conn->query($requestQuery);
    
} 
    
    //redirects to login page with error message
header("Location: index.php?forgotPassword=true");
?>