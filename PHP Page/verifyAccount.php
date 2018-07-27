<?php
    include 'dbConnection.php';
   
    if(isset($_GET['verified'])){
        $message = "The username or the verification code is incorrect";
    }    
?>

<html>
    <head>
        <title>Pestbusters Pest Monitoring and Analysis System</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/loginStyleSheet.css">
    </head>
    
    <body>
            
        <!--Login Form-->
        <form method="post" action="verifyPost.php" onSubmit="return validateForm()" name="verifyForm">  
            <table>
            <tr>
              <th><img src="img/pestbusters.jpg" style="width: 75%;"></th>
              <th></th>
              <th></th>
            </tr>
            
            <!--Message (if applicable)-->
            <tr>
                <td colspan="3"><small id="errorMessage"><?php if(isset($message)){echo $message;} ?></small></td>
            </tr>
                
            <!--Username Field-->
            <tr>
              <td colspan="3">
                  <input type="text" class="form-control" name="user" id="email" placeholder="Username">
                  
              </td>
            </tr>

            <!--Verif Code Field-->
            <tr>
              <td colspan="3">
                  <input type="text" class="form-control" name="verifCode" id="password" placeholder="Verification Code">
              </td>
            </tr>


           <!--Submit Button-->
            <tr>
                <td colspan="3">
                    <button type="submit" class="btn btn-primary" id="loginButton" >Submit ></button>
                </td>
            </tr>
            
          </table>
        </form>
        
        
    </body>
</html>

