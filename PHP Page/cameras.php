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
        <link rel="stylesheet" type="text/css" href="css/mainStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<<<<<<< HEAD
        <script type="text/javascript" src="javascript/camerasJS.js"></script>
=======
>>>>>>> 81f4c7d68c10e5c9cb000965d01af5f458bc39b9
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
            
            <!--Table showing all the cameras-->
            <div class="row">
                <a href="addCamera.php"><button type="submit" class="btn btn-success">Add Camera</button></a>
                <br><br>
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Camera Name</th>
                        <th>Location</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $cameraQuery = "SELECT * FROM cameradetails";
                        $result = $conn->query($cameraQuery);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $state = $row["state"]; 
                                $cameraID = $row["cameraID"];
                                $cameraName = $row["cameraName"];
                                $location = $row["location"];
                                ?>

                                <tr id="<?php echo $cameraID?>" >
                                    <td><?php echo  $cameraName?></td>
                                    <td><?php echo  $location?></td>

                                    
                                    
                                    <!--Button to start analysis-->
                                    
                                    
                                    <td>
                                        
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"><button type="submit" style="float: left; margin-right: 5px;" name="camera" value="<?php echo $cameraID?>" id="<?php echo $cameraID?>" class="btn btn-success" <?php if($state == 1){echo "disabled='true'";}?>>Start</button></form>
                                        <!--Edit Button-->
                                        <a href="editCamera.php?cameraID=<?php echo $cameraID ?>"><button type="submit" name="edit" value="<?php echo $cameraID?>" id="edit<?php echo $cameraID?>" class="btn btn-warning">Edit</button></a>
                                   
                                        <!--Delete Button-->
                                        <button class="btn btn-danger remove">Delete</button>
                                    </td>

                                </tr>
                                <?php
                            }
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
    
<<<<<<< HEAD
    <script>
=======
    <script type="text/javascript">
>>>>>>> 81f4c7d68c10e5c9cb000965d01af5f458bc39b9
        $(".remove").click(function(){
            var id = $(this).parents("tr").attr("id");


            if(confirm('Are you sure you want to remove this camera?'))
            {
                $.ajax({
                   url: 'deleteCamera.php',
                   type: 'GET',
                   data: {cameraID: id},
                   error: function() {
                        alert('Something is wrong');
                   },
                   success: function() {
                        $("#"+id).remove();
                        alert("Camera successfully removed");  
                   }
                });
            }
        });
<<<<<<< HEAD
=======


>>>>>>> 81f4c7d68c10e5c9cb000965d01af5f458bc39b9
    </script>
</html>