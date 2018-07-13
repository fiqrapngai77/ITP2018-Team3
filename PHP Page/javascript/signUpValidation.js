/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateForm(){
    var user = document.forms["signUpForm"]["user"].value;
    var password = document.forms["signUpForm"]["password"].value;
    var cPassword = document.forms["signUpForm"]["cPassword"].value;
    
    var flag = 0;
    document.getElementById("usernameWarning").style.visibility = "hidden";
    document.getElementById("passwordWarning").style.visibility = "hidden";
    document.getElementById("cPasswordWarning").style.visibility = "hidden";
    
    if(user == ""){
        document.getElementById("usernameWarning").style.visibility = "visible";
        flag = 1;
    }
    
    if(password == ""){
        document.getElementById("passwordWarning").style.visibility = "visible";
        flag = 1;
    }
    
    if(cPassword != password){
        document.getElementById("cPasswordWarning").style.visibility = "visible";
        flag = 1;
    }
    
    if(flag==1){
        return false;
    }
}
