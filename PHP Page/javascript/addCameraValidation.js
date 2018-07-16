/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validateForm(){
    var name = document.forms["addCameraForm"]["cameraName"].value;
    var location = document.forms["addCameraForm"]["location"].value;
    
    var flag = 0;
    document.getElementById("cameraNameWarning").style.visibility = "hidden";
    document.getElementById("locationWarning").style.visibility = "hidden";
    
    if(name == ""){
        document.getElementById("cameraNameWarning").style.visibility = "visible";
        flag = 1;
    }
    
    if(location == ""){
        document.getElementById("locationWarning").style.visibility = "visible";
        flag = 1;
    }
    
    if(flag==1){
        return false;
    }
}
