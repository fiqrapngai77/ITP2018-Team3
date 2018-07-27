<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function signUpVerify($username, $email, $verifCode){
    $message = "Hello there! \n\n"
            . "Thank you for signing up with PestBusters' PCS. \n"
            . "We would like you to verify your account by clicking on the link below.\n\n"
            . "https://pestbusters.000webhostapp.com/verifyAccount \n\n"
            . "Enter the following in the respective fields:\n"
            . "Username: $username \n"
            . "Verification Code: $verifCode";
    
    $subject = "PestBusters Account Verification (DO NOT REPLY)";
    
    $headers = "From: webmaster@pestbusters.com" ;
    
    mail($email, $subject, $message, $headers);
}

function resetPassword($username, $email, $RNGcode){
    $message = "Hello there! \n\n"
            . "We note your request for a change of password. \n"
            . "Please login with the following credentials and change your password after logging in. \n\n"
            . "Username: $username \n"
            . "Password: $RNGcode";
    
    $subject = "PestBusters Change of Password (DO NOT REPLY)";
    
    $headers = "From: webmaster@pestbusters.com" ;
    
    mail($email, $subject, $message, $headers);
}
