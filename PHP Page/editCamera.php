<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

$cameraID = $_GET['cameraID'];

$retrieveQuery = "SELECT * FROM cameradetails WHERE cameraID = $cameraID";
$retrieveResult = $conn->query($retrieveQuery); 

$currentPage = "Edit Cameras";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Cameras</title>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/editCameraStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="javascript/editCameraValidation.js"></script>
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
            
            <?php if($retrieveResult->num_rows>0){
                while($row = $retrieveResult->fetch_assoc()) {?>
            
            <!--Edit Camera Form-->
            <form method="post" onSubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="editCameraForm">
                <table>
                    <!--Message (if applicable)-->
                    <tr>
                        <td colspan="3"><small id="errorMessage"><?php if(isset($message)){echo $message;} ?></small></td>
                    </tr>
                    
                    <!--Camera Name-->
                    <tr>
                      <td colspan="3">
                          <label for="cameraName">Camera Name:</label>
                          <input type="text" class="form-control" name="cameraName" id="cameraName" placeholder="Camera Name" value="<?php echo $row['cameraName'] ?>">
                          <small id="cameraNameWarning">Please input a name for the camera</small>
                      </td>
                    </tr>

                    <!--Location-->
                    <tr>
                      <td colspan="3">
                          <label for="location">Location:</label>
                          <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="<?php echo $row['location']?>" >
                          <small id="locationWarning">Please input a location for the camera</small>
                      </td>
                    </tr>

                    <!--Register User-->
                    <tr>
                        <td colspan="3">
                            <br>
                            <button type="submit" class="btn btn-primary" id="registerButton" >Edit Camera</button>
                        </td>
                    </tr>
                    
                    <!--Camera ID-->
                    <tr>
                      <td colspan="3">
                          <input type="text" class="form-control" name="cameraID" id="cameraID" placeholder="Camera ID" value="<?php echo $row['cameraID'] ?>" style="visibility: hidden;">
                      </td>
                    </tr>

              </table>
            </form>
            
                <?php }
                
                        } ?>
        </div>
        
    </body>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newCameraID = $_POST['cameraID'];
            $newCameraName = $_POST['cameraName'];
            $newLocation = $_POST['location'];
            $updateQuery = "UPDATE cameradetails SET cameraName = '$newCameraName', location = '$newLocation' WHERE cameraID = '$newCameraID'";
            $result = $conn->query($updateQuery);
            
            echo $newCameraID, $newCameraName, $newLocation;
            
            header("Location: cameras.php");
    } ?>
</html>
