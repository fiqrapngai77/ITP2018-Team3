<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

if($_SESSION['accountType'] != "superadmin"){
    header("Location: cameras.php");
}

$currentPage = "Notifications";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Notifications</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/mainStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="javascript/dashboardJS.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
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
            
            <div class="row">
                <!--Table to view the fly counts for the selected company-->
                <table id="dashboardTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Request Type</th>
                        <th>Username</th>
                        <th colspan="2">Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                        $requestQuery = "SELECT * FROM requests";
                        $result = $conn->query($requestQuery);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                
                                ?>

                                <tr id="<?php echo $username?>">
                                    <td><?php echo $row["requestType"] ?></td>
                                    <td><?php echo $row["username"] ?></td>
                                    <td>            
                                        <form method="post" action="resetPassword.php">
                                            <input style="display: none;" name="username" value="<?php echo $row["username"] ?>"/>
                                            <button type="submit" class="btn btn-primary" >Reset Password</button>

                                        </form>
                                        <button class="btn btn-danger remove" style="position: relative; left: 130px; bottom: 33px;">Delete</button>
                                    </td>
                                    <td></td>
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
    
    <script type="text/javascript">
        $(".remove").click(function(){
            var id = $(this).parents("tr").attr("id");


            if(confirm('Are you sure you want to remove this notification?'))
            {
                $.ajax({
                   url: 'deleteNotification.php',
                   type: 'GET',
                   data: {ID: id},
                   error: function() {
                        alert('Something is wrong');
                   },
                   success: function() {
                        $("#"+id).remove();
                        alert("Notification successfully removed");  
                   }
                });
            }
        });


    </script>
    
</html>