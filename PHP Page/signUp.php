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
    
    $currentPage = "Register";
    
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
                  <th style="width: 50%"><img src="img/pestbusters.jpg" style="width: 75%;"></th>
                  <th></th>
                  <th></th>
                </tr>

                

                <!--Username-->
                <tr>
                  <td colspan="3">
                      <input type="text" class="form-control" name="user" id="username" placeholder="Username">
                      <small id="usernameWarning">* Please enter your desired username</small>
                  </td>
                </tr>

                <!--Password-->
                <tr>
                  <td colspan="3">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      <small id="passwordWarning">* Please enter your desired password</small>
                  </td>
                </tr>

                <!--Confirm Password-->
                <tr>
                  <td colspan="3">
                      <input type="password" class="form-control" name="confirmPassword" id="cPassword" placeholder="Confirm Password">
                      <small id="cPasswordWarning">* The password does not match</small>
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

