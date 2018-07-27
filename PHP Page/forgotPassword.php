<?php
    include 'dbConnection.php';
   
?>

<html>
    <head>
        <title>Pestbusters Pest Monitoring and Analysis System</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/loginStyleSheet.css">
        <script src="javascript/loginValidation.js"></script>
    </head>
    
    <body>
            
        <!--Login Form-->
        <form method="post" action="forgotPasswordPost.php" onSubmit="return validateForm()" name="forgotPasswordForm">  
            <table>
            <tr>
              <th><img src="img/pestbusters.jpg" style="width: 75%;"></th>
            </tr>
            
            
            <!--Message (if applicable)-->
            <tr>
                <td><small>Your request will be forwarded to an administrator, who will reset your password.</small></td>
            </tr>
                
            <!--Username Field-->
            <tr>
              <td>
                  <input type="text" class="form-control" name="user" id="email" placeholder="Username">
                  <small id="usernameWarning">* Please enter your username</small>
              </td>
            </tr>
            
           <!--Login Button-->
            <tr>
                <td>
                    <button type="submit" class="btn btn-primary" id="resetPasswordButton" >Request For Password Reset</button>
                </td>
            </tr>
            
          </table>
        </form>
        
        
    </body>
</html>

