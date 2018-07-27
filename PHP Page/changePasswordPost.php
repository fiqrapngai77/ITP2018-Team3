<?php
include 'dbConnection.php';
include 'sha256hash.php';

$username = $_SESSION['currentUser'];

$existQuery = "SELECT * FROM users WHERE user='$username'";
$existResult = $conn->query($existQuery);

if ($existResult->num_rows > 0){
    $row = $existResult->fetch_assoc();
    $oldPassword = hashPassword($_POST['currentPassword'], $row['verifCode']);
    $newPassword = hashPassword($_POST['newPassword'], $row['verifCode']);
    
    if($oldPassword != $row['password']){
        header("location: changePassword.php?success=false");
    }else{
        $updateQuery = "UPDATE users SET password = '$newPassword' WHERE user = '$username'";
        $conn->query($updateQuery);

        header("location: cameras.php");
    }
}
?>