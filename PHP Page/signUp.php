<?php
    include 'dbConnection.php';
   
    if(isset($_GET['taken'])){
        $takenMessage = "The username is already taken";
    }
    
?>

<html>
    <head>
        <title>Pestbusters Pest Monitoring and Analysis System</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/loginStyleSheet.css">
        <script src="javascript/signUpValidation.js"></script>
    </head>
    
    <body>
        
            <table>
            <tr>
              <th style="width: 50%"><img src="img/pestbusters.jpg" style="width: 75%;"></th>
              <th></th>
              <th style="float: right;">
                  <a href="signUp.php"> <button type="submit" class="btn btn-primary" id="signUpButton" name="signUp" style="background-color: grey; border-color: grey; color: white;" >Sign Up</button> </a>
                  <a href="login.php"><button type="submit" class="btn btn-primary" id="login" name="login" style="background-color: white; border-color: white; color: black;" >Login</button> </a>
              </th>
            </tr>
            
            <tr>
                <td colspan="3"><small id="errorMessage"><?php if(isset($takenMessage)){echo $takenMessage;} ?></small></td>
            </tr>
            
            <form method="post" action="signUpPost.php" onSubmit="return validateForm()" name="signUpForm">
            <tr>
              <td colspan="3">
                  <input type="text" class="form-control" name="user" id="email" placeholder="Username">
                  <small id="usernameWarning">* Please enter your desired username</small>
              </td>
            </tr>
            
            <tr>
              <td colspan="3">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  <small id="passwordWarning">* Please enter your desired password</small>
              </td>
            </tr>
            
            <tr>
              <td colspan="3">
                  <input type="password" class="form-control" name="confirmPassword" id="cPassword" placeholder="Confirm Password">
                  <small id="cPasswordWarning">* The password does not match</small>
              </td>
            </tr>
            
            <tr>
                <td colspan="3">
                    <button type="submit" class="btn btn-primary" id="loginButton" >Sign Up</button>
                </td>
            </tr>
            
            </form>
            
          </table>
        
        
    </body>
</html>

