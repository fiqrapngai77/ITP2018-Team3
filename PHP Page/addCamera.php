<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

$currentPage = "Add Camera";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Camera</title>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/manageCameraStyleSheet.css">
        <script src="javascript/addCameraValidation.js"></script>
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
            
          
            
            <!--Edit Camera Form-->
            <form method="post" onSubmit="return validateForm()" action="addCameraPost.php" name="addCameraForm">
                <table>
                    <!--Message (if applicable)-->
                    <tr>
                        <td colspan="3"><small id="errorMessage"><?php if(isset($message)){echo $message;} ?></small></td>
                    </tr>
                    
                    <!--Camera Name-->
                    <tr>
                      <td colspan="3">
                          <label for="cameraName">Camera Name:</label>
                          <input type="text" class="form-control" name="cameraName" id="cameraName" placeholder="Camera Name">
                          <small id="cameraNameWarning">Please input a name for the camera</small>
                      </td>
                    </tr>

                    <!--Location-->
                    <tr>
                      <td colspan="3">
                          <label for="location">Location:</label>
                          <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                          <small id="locationWarning">Please input a location for the camera</small>
                      </td>
                    </tr>

                    <!--Add Camera Button-->
                    <tr>
                        <td colspan="3">
                            <br>
                            <button type="submit" class="btn btn-primary" id="addCameraButton" >Add Camera</button>
                        </td>
                    </tr>
                    
              </table>
            </form>
            
 
        </div>
        
    </body>
    
</html>
