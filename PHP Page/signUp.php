<?php
    include 'dbConnection.php';
   
    if(isset($_GET['taken'])){
        $takenMessage = "The username is already taken";
    }
    
    if(!isset($_SESSION['currentUser'])){
        exit(header("Location: index.php?user=false"));
    }
    
    if($_SESSION['accountType'] != "superadmin"){
        header("Location: cameras.php");
    }
    
?>

<html>
    <head>
        <title>Pestbusters Pest Monitoring and Analysis System</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/signUpStyleSheet.css">
        <script src="javascript/signUpValidation.js"></script>
    </head>
    
    <body>
        
            <!--Nav bar -->
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <a class="navbar-brand" href="#">Pestbusters</a>
                  </div>
                  <ul class="nav navbar-nav">
                      <li><a href="cameras.php"><span class="glyphicon glyphicon-camera"></span> Cameras</a></li>
                      <li><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                      <?php
                        if($_SESSION['accountType'] == "superadmin"){
                            echo '<li class="active"><a href="#" ><span class="glyphicon glyphicon-user"></span> Add users</a></li>';
                        }
                    ?>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                  </ul>
                </div>
            </nav>
        
            <table>
            <tr>
              <th style="width: 50%"><img src="img/pestbusters.jpg" style="width: 75%;"></th>
              <th></th>
              <th></th>
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
                    <button type="submit" class="btn btn-primary" id="registerButton" >Register User</button>
                </td>
            </tr>
            
            </form>
            
          </table>
        
        
    </body>
</html>

