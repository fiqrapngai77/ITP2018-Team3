<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

$currentPage = "Cameras";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cameras</title>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/camerasStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
    
    <body>
        <!--Navbar-->
        <?php
        include 'navbar.php';
        ?>
        
        <!--Content-->
        <div class="container">
            <div class="row">
                <p class="pageTitle">Cameras</p>
                
                <hr>
            </div>
            
            <!--Table showing all the cameras-->
            <div class="row">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Camera Name</th>
                        <th>Location</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $cameraQuery = "SELECT * FROM cameradetails";
                        $result = $conn->query($cameraQuery);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <tr>
                                    <td><?php echo $row["cameraID"] ?></td>
                                    <td><?php echo $row["location"] ?></td>

                                    <?php $state = $row["state"]; 
                                    $cameraID = $row["cameraID"]?>
                                    
                                    <!--Button to start analysis-->
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <td><button type="submit" name="camera" value="<?php echo $cameraID?>" id="<?php echo $cameraID?>" class="btn btn-success" <?php if($state == 1){echo "disabled='true'";}?>>Start</button></td>
                                    </form>


                                </tr>
                                <?php
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </body>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $cameraID = $_REQUEST['camera'];
        $sql2 = "UPDATE cameradetails SET state = 1 WHERE cameraID = $cameraID";
        $result = $conn->query($sql2);           
        echo "<script type='text/javascript'>document.getElementById(String($cameraID)).disabled = true;</script>";
    } ?>
</html>