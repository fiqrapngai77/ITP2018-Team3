<?php
    include 'dbConnection.php';
    
    if(isset($_GET['exist'])){
        $message = "The user does not exist in the system";
    }else if(isset($_GET['registered'])){
        $message = "Account has been successfully registered";
    }else if(isset($_GET['credentials'])){
        $message = "Please enter the correct username and password";
    }
?>

<html>
    <head>
        <title>Pestbusters Pest Monitoring and Analysis System</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/loginStyleSheet.css">
        <script src="javascript/loginValidation.js"></script>
    </head>
    
    <body>
        
            <table>
            <tr>
              <th style="width: 50%"><img src="img/pestbusters.jpg" style="width: 75%;"></th>
              <th></th>
              <th></th>
            </tr>
            
            <tr>
                <td colspan="3"><small id="errorMessage"><?php if(isset($message)){echo $message;} ?></small></td>
            </tr>
            
            <form method="post" action="loginPost.php" onSubmit="return validateForm()" name="loginForm">  
                <tr>
                  <td colspan="3">
                      <input type="text" class="form-control" name="user" id="email" placeholder="Username">
                      <small id="usernameWarning">* Please enter your username</small>
                  </td>
                </tr>

                <tr>
                  <td colspan="3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      <small id="passwordWarning">* Please enter your password</small>
                  </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <button type="submit" class="btn btn-primary" id="loginButton" >Login ></button>
                    </td>
                </tr>
            </form>
            <tr>
                <td colspan="3">
                    <small>Forgot password?</small>
                </td>
            </tr>
            
          </table>
        
        
    </body>
</html>

