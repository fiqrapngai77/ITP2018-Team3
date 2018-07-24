<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function hashPassword($password){
    

    for($x = 0; $x < 4; $x++){
        $password = hash('sha256', $password + hash('sha256',$password.$x));
    }
    
    
    return $password;
}




