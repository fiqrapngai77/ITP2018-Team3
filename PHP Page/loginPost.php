<?php
include 'dbConnection.php';
include 'sha256hash.php';

$username = $_POST['user'];

$query = "SELECT * FROM users WHERE user = '$username'" ;
$result = $conn->query($query);

//of the name of the user matches a row
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if($row['verified'] != 'true'){
            header("Location: index.php?verified=false");
        }else{
            if($row['user'] == $username && $row['password'] == hashPassword($_POST['password'], $row['verifCode'])){
                //set the currentUser 
                $_SESSION['currentUser'] = $username;
                
                //set the accountType, superadmin has the ability to create more users
                $_SESSION['accountType'] = $row['accountType'];
                
                //redirect to cameras
                header("Location: cameras.php");
            }else{

                //redirects to the login page with error message
                header("Location: index.php?credentials=false");
            }
        }
        
        
        
    }
} else {
    
    //redirects to login page with error message
    header("Location: index.php?exist=false");
}