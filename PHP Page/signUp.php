<?php
    include 'dbConnection.php';
   
    if(isset($_GET['taken'])){
        $message = "The username is already taken";
    }
    
    if(!isset($_SESSION['currentUser'])){
        exit(header("Location: index.php?user=false"));
    }
    
    if($_SESSION['accountType'] != "superadmin"){
        header("Location: cameras.php");
    }
    
    $currentPage = "User Management";
    
?>

<html>
    <head>
        <title>Pestbusters Pest Monitoring and Analysis System</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/signUpStyleSheet.css">
        <script src="javascript/signUpValidation.js"></script>
    </head>
    
    <body>
        <!--Navbar-->    
        <?php
        include 'navbar.php';
        ?>

        <!--Sign Up Form-->
        <form method="post" action="signUpPost.php" onSubmit="return validateForm()" name="signUpForm">
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

                <!--Username-->
                <tr>
                  <td colspan="3">
                      <input type="text" class="form-control" name="user" id="username" placeholder="Username">
                      <small id="usernameWarning" class="errorMsg">* Please enter your desired username</small>
                      <br>
                  </td>
                </tr>
                
                <!--Email-->
                <tr>
                  <td colspan="3">
                      <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="fiqrapngai77@gmail.com">
                      <br>
                  </td>
                </tr>

                <!--Password-->
                <tr>
                  <td colspan="3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      <small id="passwordWarning" class="errorMsg">* Please enter your desired password</small>
                      <small id="shortPasswordWarning" class="errorMsg">* Please enter at least 8 characters</small>
                      <small id="specialCharPasswordWarning" class="errorMsg">* Please enter alphanumeric characters only</small>
                      <br>
                  </td>
                </tr>

                <!--Confirm Password-->
                <tr>
                  <td colspan="3">
                      <input type="password" class="form-control" name="confirmPassword" id="cPassword" placeholder="Confirm Password">
                      <small id="cPasswordWarning" class="errorMsg">* The password does not match</small>
                      <br>
                  </td>
                </tr>
                
                <tr>
                    <td colspan="3">
                        <input type="checkbox" name="privilege" id="privilege" value="admin">
                        <label for="privilege">Admin privileges?</label>
                    </td>
                </tr>

                <!--Register User-->
                <tr>
                    <td colspan="3">
                        <button type="submit" class="btn btn-primary" id="registerButton" >Register User</button>
                    </td>
                </tr>
                
          </table>
        </form>

    </body>
</html>

