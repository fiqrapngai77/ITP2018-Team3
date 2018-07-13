<?php
include 'dbConnection.php';

$username = $_POST['user'];
$password = $_POST['password'];



$query = "SELECT * FROM users WHERE user = '$username'" ;
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if($row['user'] == $username && $row['password'] == $password){
            $_SESSION['currentUser'] = $username;
            $_SESSION['accountType'] = $row['accountType'];
            header("Location: cameras.php");
        }else{
            header("Location: index.php?credentials=false");
        }
        
    }
} else {
    header("Location: index.php?exist=false");
}