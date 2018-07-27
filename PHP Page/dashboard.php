<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    header("Location: index.php?user=false");
    
}

$currentPage = "Dashboard";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
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
                <label>Select Company:</label>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <select name="name" class="form-control" style="width:auto;" onChange="this.form.submit()">
                            <option value="default">Select a company</option>
                            <?php
                            $companyNameQuery = "SELECT DISTINCT companyName FROM fliesdetail";
                            $result = $conn->query($companyNameQuery);


                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    ?>

                                    <option value="<?php echo $row["companyName"] ?>"><?php echo $row["companyName"] ?></option>
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>

                        </select>
                    </div>
                </form>
                
                <!--Table to view the fly counts for the selected company-->
                <table id="dashboardTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>House Flies</th>
                        <th>Flesh Flies</th>
                        <th>Green Bottles Flies</th>
                        <th>Phorid or Humpbacked Flies</th>
                        <th>Flying Termites</th>
                        <th>Total Number of Flies </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                        function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
        }
                      
                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                      
                        $name = test_input($_POST["name"]);    
                            
                        $sql2 = "select id, COALESCE(houseFlies, 0 ) houseFlies , COALESCE(fleshFlies, 0 ) fleshFlies , COALESCE(greenBottlesFlies, 0 ) greenBottlesFlies , "
                                . "COALESCE(phoridOrHumpbackedFlies, 0 ) phoridOrHumpbackedFlies , COALESCE(flyingTermites, 0 ) flyingTermites, date, "
                                . "( COALESCE(houseFlies, 0 ) + COALESCE(fleshFlies, 0 ) + COALESCE(greenBottlesFlies, 0 )  + COALESCE(phoridOrHumpbackedFlies, 0 ) + COALESCE(flyingTermites, 0 )) total "
                                . "from fliesdetail "
                                . "where companyName='$name' AND date IS NOT NULL "
                                . "order by id asc";
                                
                        $result = $conn->query($sql2);


                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <tr>
                                    <td><?php echo $row["date"] ?></td>
                                    <td><?php echo $row["houseFlies"] ?></td>
                                    <td><?php echo $row["fleshFlies"] ?></td>
                                    <td><?php echo $row["greenBottlesFlies"] ?></td>
                                    <td><?php echo $row["phoridOrHumpbackedFlies"] ?></td>
                                    <td><?php echo $row["flyingTermites"] ?></td>
                                    <td><?php echo $row["total"] ?></td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "0 results";
                        }
                            
                     }   
                
                ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </body>
    
</html>