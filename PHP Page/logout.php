<?php
include 'dbConnection.php';

$_SESSION['currentUser'] =  "";
session_destroy();

header('Location: index.php?logout=true');

?>

