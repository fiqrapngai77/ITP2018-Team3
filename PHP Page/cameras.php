<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}else{

}

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
        <!--Nav bar -->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a class="navbar-brand" href="#">Pestbusters</a>
              </div>
              <ul class="nav navbar-nav">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-camera"></span> Cameras</a></li>
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                <?php
                    if($_SESSION['accountType'] == "superadmin"){
                        echo '<li><a href="signUp.php"><span class="glyphicon glyphicon-user"></span> Add users</a></li>';
                    }
                ?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
              </ul>
            </div>
        </nav>
        
        <!--Content-->
        <div class="container">
            <div class="row">
                <p class="pageTitle">Cameras</p>
                
                <hr>
            </div>
            
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
                        $sql3 = "select * from cameradetails";
                        $result = $conn->query($sql3);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <tr>
                                    <td><?php echo $row["cameraID"] ?></td>
                                    <td><?php echo $row["location"] ?></td>

                                    <?php $state = $row["state"]; 
                                    $cameraID = $row["cameraID"]?>
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