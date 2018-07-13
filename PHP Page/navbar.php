<!--Nav bar -->
<!--The PHP inside the li components activates if the corresponding currentPage is the same-->

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Pestbusters</a>
      </div>
      <ul class="nav navbar-nav">
        <li <?php if ($currentPage === 'Cameras') {echo 'class="active"';} ?>><a href="#"><span class="glyphicon glyphicon-camera"></span> Cameras</a></li>
        <li <?php if ($currentPage === 'Dashboard') {echo 'class="active"';} ?>><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
        <?php
            if($_SESSION['accountType'] == "superadmin"){
                echo '<li';
                if ($currentPage === 'Register') {
                    echo ' class="active" ';
                }
                echo'><a href="signUp.php"><span class="glyphicon glyphicon-user"></span> Add users</a></li>';
            }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
</nav>

