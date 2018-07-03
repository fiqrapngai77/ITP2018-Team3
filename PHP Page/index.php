<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">

        <style>

            table{
                width:100%;
                text-align: center;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            body{
                background-image: url("img/bimg.jpg");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            #pest{
                float: right;
            }
            #submit{
                margin-left: 40px;
            }
            
        </style>

        <title>Pest Monitoring and Analysis System</title>
    </head>
    <body>
        <image id ="pest" src="img/pestbusters.jpg" alt="pest busters" height="80" width="180"/>
        <h1><i>Pest Monitoring and Analysis System</i></h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <h2>Select company to view the company's flies problem.</h2>
            <br>

            Select company:

            <select name="name">
                <?php
                $name = "";
                $servername = "den1.mysql4.gear.host";
                $username = "pestbuster";
                $password = "Bq3!-9Y6v678";
                $dbname = "pestbuster";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "select distinct companyName from fliesdetail";
                $result = $conn->query($sql);


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

            <button id = "submit" type="submit" name="subject" value="Submit">Submit</button>
            <br><br>
            <button id="state" type="submit" name="subject" value="State" disabled="true" >Camera State</button>
            
            
            <p>Note: Camera Sate = 0 -> available; Sate = 1 -> busy</p>
            
        </form>

        <br>
        <hr>

        <h2>Camera Detail:</h2>

        
        <table>
            <tr>
                <th>Camera ID</th>
                <th>Camera Name</th>
                <th>Location</th>
            </tr>

            <?php
            $sql3 = "select * from cameradetails";
            $result = $conn->query($sql3);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>

                    <tr>
                        <td><?php echo $row["cameraID"] ?></td>
                        <td><?php echo $row["cameraName"] ?></td>
                        <td><?php echo $row["location"] ?></td>
                       
                    </tr>
                    <script type="text/javascript">
                        var submitButton = document.getElementById('state');
                        if (<?php echo $row["state"] ?> == '1') {
                            submitButton.disabled = false;
                        }

                    </script>
                    <?php
                }
            } else {
                echo "0 results";
            }
            ?>
        </table>
        <?php

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            switch ($_REQUEST['subject']) {

                case 'State':
                    $sql2 = "update cameradetails set state = 0";
                    $result = $conn->query($sql2);
                    ?>

                    <script type="text/javascript">
                        var submitButton = document.getElementById('state');
                        submitButton.disabled = true;
                    </script>

                    <?php
                    break;

                case 'Submit':
                    $name = test_input($_POST["name"]);
                    ?>
                    <h2>Flies Details:</h2>
                    <h3>Company name: <?php echo $name; ?> </h3>
                    <table>
                        <tr>
                            <th>House Flies</th>
                            <th>Flesh Flies</th>
                            <th>Green Bottles Flies</th>
                            <th>Phorid or Humpbacked Flies</th>
                            <th>Flying Termites</th>
                            <th>Total Number of Flies </th>
                            <th>Date</th>

                        </tr>

                        <?php
                        $sql2 = "select COALESCE(houseFlies, 0 ) houseFlies , COALESCE(fleshFlies, 0 ) fleshFlies , COALESCE(greenBottlesFlies, 0 ) greenBottlesFlies , "
                                . "COALESCE(phoridOrHumpbackedFlies, 0 ) phoridOrHumpbackedFlies , COALESCE(flyingTermites, 0 ) flyingTermites, date, "
                                . "( COALESCE(houseFlies, 0 ) + COALESCE(fleshFlies, 0 ) + COALESCE(greenBottlesFlies, 0 )  + COALESCE(phoridOrHumpbackedFlies, 0 ) + COALESCE(flyingTermites, 0 )) total "
                                . "from fliesdetail "
                                . "where companyName='$name'";
                        $result = $conn->query($sql2);


                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <tr>
                                    <td><?php echo $row["houseFlies"] ?></td>
                                    <td><?php echo $row["fleshFlies"] ?></td>
                                    <td><?php echo $row["greenBottlesFlies"] ?></td>
                                    <td><?php echo $row["phoridOrHumpbackedFlies"] ?></td>
                                    <td><?php echo $row["flyingTermites"] ?></td>
                                    <td><?php echo $row["total"] ?></td>
                                    <td><?php echo $row["date"] ?></td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "0 results";
                        }

                        break;
                }
                ?>


            </table>

            <?php
        }
        ?>


        <?php
        $conn->close();
        ?>

    </body>
</html>
