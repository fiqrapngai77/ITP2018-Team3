<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

if(isset($_GET['success'])){
    $message = "The password entered does not match the one in the system";
}

$currentPage = "Change Password";

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_SESSION['currentUser'] ?>'s Profile</title>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/mainStyleSheet.css">
        <link rel="stylesheet" type="text/css" href="css/changePasswordStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="javascript/changePasswordValidation.js"></script>
    </head>
    
    <body>
        <!--Navbar-->
        <?php
        include 'navbar.php';
        ?>
        
        <!--Content-->
        <div class="container">
            <div class="row">
                <p class="pageTitle"><?php echo $currentPage ?></p>
                
                <hr>
            </div>
                       
            <section>
                <form action="changePasswordPost.php" method="post" onSubmit="return validateForm()" name="changePasswordForm">
                    <table>
                        <tr>
                            <td><small id="errorMessage"><?php if(isset($message)){echo $message;} ?></small></td>
                        </tr>
                        
                        <tr>
                            <td><strong>Username: </strong></td>
                            <td><?php echo $_SESSION['currentUser'] ?></td>
                        </tr>
                        
                        
                        
                        <tr>
                            <td><strong>Current Password: </strong></td>
                            <td><input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Current Password">
                            <small id="oldPasswordWarning" class="errorMsg">* Please enter your current password</small></td>
                            
                        </tr>
                        
                        <tr>
                            <td><strong>New Password: </strong></td>
                            <td><input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password">
                            <small id="passwordWarning" class="errorMsg">* Please enter your desired password</small>
                            <small id="shortPasswordWarning" class="errorMsg">* Please enter at least 8 characters</small>
                            <small id="specialCharPasswordWarning" class="errorMsg">* Please enter alphanumeric characters only</small>
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td><strong>Confirm New Password: </strong></td>
                            <td><input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm New Password">
                            <small id="cPasswordWarning" class="errorMsg">* The password does not match</small></td>
                            
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-success">Change Password</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </section>
            
        </div>
        
    </body>
    
    
</html>