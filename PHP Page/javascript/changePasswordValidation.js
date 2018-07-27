/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateForm(){
    var password = document.forms["changePasswordForm"]["currentPassword"].value;
    var newPassword = document.forms["changePasswordForm"]["newPassword"].value;
    var cPassword = document.forms["changePasswordForm"]["confirmPassword"].value;
    
    var alphanumeric = new RegExp("[^a-zA-Z0-9]");
    
    var flag = 0;
    document.getElementById("oldPasswordWarning").style.display = "none";
    document.getElementById("passwordWarning").style.display = "none";
    document.getElementById("cPasswordWarning").style.display = "none";
    document.getElementById("shortPasswordWarning").style.display = "none";
    document.getElementById("specialCharPasswordWarning").style.display = "none";
    
    if(password == ""){
        document.getElementById("oldPasswordWarning").style.display = "block";
        flag = 1;
    } 
    
    if(newPassword == 0){
        document.getElementById("passwordWarning").style.display = "block";
        flag = 1;
    }else if(newPassword.length <8){
        document.getElementById("shortPasswordWarning").style.display = "block";
        flag=1;
    }
    
    if(cPassword != newPassword){
        document.getElementById("cPasswordWarning").style.display = "block";
        flag = 1;
    }
    
    if(alphanumeric.test(newPassword)){
        document.getElementById("specialCharPasswordWarning").style.display = "block";
        flag=1;
    }
    
    if(flag==1){
        return false;
    }
}
