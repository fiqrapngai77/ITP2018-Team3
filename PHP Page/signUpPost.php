<?php
include 'dbConnection.php';

$username = $_POST['user'];
$password = $_POST['password'];
$verifCode = generateRandomString(15);

$existQuery = "SELECT * FROM users WHERE user='$username'";
$existResult = $conn->query($existQuery);

if ($existResult->num_rows > 0){
    header("Location: signup.php?taken=true");
    return false;
}


$query = "INSERT INTO users (user, password, verifCode, accountType) VALUES ('$username','$password','$verifCode','Normal')" ;
$result = $conn->query($query);

//If the entry is successful, it will redirect to Register page with a message
if($result){
    header("Location: signup.php?registered=true");
}else{
    header("Location: signup.php");
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
