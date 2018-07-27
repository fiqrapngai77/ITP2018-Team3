<!--Nav bar -->
<!--The PHP inside the li components activates if the corresponding currentPage is the same-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/navbarStyleSheet.css">
<script type="text/javascript" src="javascript/navbarJS.js"></script>

<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Pestbusters</a>
      </div>
      <ul class="nav navbar-nav">
        <li <?php if ($currentPage === 'Cameras') {echo 'class="active"';} ?>><a href="cameras.php"><span class="glyphicon glyphicon-camera"></span> Cameras</a></li>
        <li <?php if ($currentPage === 'Dashboard') {echo 'class="active"';} ?>><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
        <?php
            if($_SESSION['accountType'] == "superadmin"){
                echo '<li';
                if ($currentPage === 'User Management') {
                    echo ' class="active" ';
                }
                echo'><a href="manageUser.php"><span class="glyphicon glyphicon-user"></span> Manage Users</a></li>';
            }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php
            $countQuery = "SELECT COUNT(*) as total FROM requests";
            $countResult = $conn->query($countQuery);
            $data = $countResult->fetch_assoc();
            $total = $data['total'];
          ?>
          <li>
              <a class="dropdown-toggle" data-toggle="dropdown" href='#'>
                <span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['currentUser']; if ($total!=0 && $_SESSION['accountType'] == "superadmin"){echo " (".$total.")";}?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                  <li><a href="changePassword.php">Change Password</a></li>
                  <?php
                  
                    if($_SESSION['accountType'] == "superadmin"){
                        echo "<li><a href='notifications.php'>Notifications ";
                        if($total!=0){
                            echo "(".$total.")";  
                        }
                          
                        echo "</a></li>";
                    }
                ?>
                  <li><a href="logout.php">Log out</a></li>
              </ul>
          
      </ul>
    </div> 
</nav>

