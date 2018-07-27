<?php
include 'dbConnection.php';
include 'sha256hash.php';

$username = $_POST['user'];
$verifCode = $_POST['verifCode'];

$query = "SELECT * FROM users WHERE user = '$username' AND verifCode = '$verifCode'" ;
$result = $conn->query($query);

//of the name of the user matches a row
if ($result->num_rows > 0) {
    $verifyQuery = "UPDATE users SET verified = 'true' WHERE user = '$username'" ;
    $conn->query($verifyQuery);
    header("Location: index.php");
} else {
    //redirects to verify account page with error message
    header("Location: verifyAccount.php?verified=false");
}