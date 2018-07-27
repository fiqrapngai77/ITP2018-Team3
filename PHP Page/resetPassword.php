<?php

include "dbConnection.php";
include "sha256hash.php";
include "sendEmail.php";

$username = $_POST['username'];


$existQuery = "SELECT * FROM users WHERE user='$username'";
$existResult = $conn->query($existQuery);
$row = $existResult->fetch_assoc();
$RNG = generateRandomString(10);

$password = hashPassword($RNG, $row['verifCode']);

$resetQuery = "UPDATE users SET password = '$password' WHERE user = '$username'";
$resetResult = $conn->query($resetQuery);

if($resetResult){
    resetPassword($username, $row['email'], $RNG);
    $deleteQuery = "DELETE FROM requests WHERE username = '$username'";
    $conn->query($deleteQuery);
    header("Location: notifications.php");
}

//Generates a random string for verification code
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



