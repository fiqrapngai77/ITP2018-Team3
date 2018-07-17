<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

if(isset($_GET['registered'])){
        $message = "User has been successfully registered";
}

$currentPage = "Users Management";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Users Management</title>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/camerasStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <a href="signUp.php"><button type="submit" class="btn btn-success">Add User</button></a>
                <br>
                <!--Message (if applicable)-->
                <small id="errorMessage"><?php if(isset($message)){echo $message;} ?></small>
                
                <table class="table table-hover">
                                        
                    <thead>
                      <tr>
                        <th>User ID</th>
                        <th>Account Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $userQuery = "SELECT * FROM users WHERE accountType != 'superadmin' ";
                        $result = $conn->query($userQuery);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['ID'];
                                $name = $row['user'];
                                ?>

                                <tr id="<?php echo $id?>" >
                                    <td><?php echo  $id?></td>
                                    <td><?php echo  $name?></td>
                                    
                                    <td>
                                   
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
    
    <script type="text/javascript">
        $(".remove").click(function(){
            var id = $(this).parents("tr").attr("id");


            if(confirm('Are you sure you want to remove this user from the system?'))
            {
                $.ajax({
                   url: 'deleteUser.php',
                   type: 'GET',
                   data: {ID: id},
                   error: function() {
                        alert('Something is wrong');
                   },
                   success: function() {
                        $("#"+id).remove();
                        alert("User successfully removed");  
                   }
                });
            }
        });


    </script>
</html>