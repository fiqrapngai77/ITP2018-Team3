<!--Nav bar -->
<!--The PHP inside the li components activates if the corresponding currentPage is the same-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="javascript/navbarJS.js"></script>

<nav class="navbar navbar-inverse">
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
          <li><a href="#" data-toggle="modal" data-target="#logoutModal"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div> 
</nav>

<!-- Small modal -->
<div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <img src="img/pestbusters.jpg" style="width: 30%">
        <h4>Log Out <i class="fa fa-lock"></i></h4>
      </div>
      <div class="modal-body">
        <p><i class="fa fa-question-circle"></i> Are you sure you want to log-out from the system? <br /></p>
        <div class="actionsBtns">
            <button class="btn btn-default btn-primary js-logout" data-dismiss="modal" >Log out</button>
            <button class="btn btn-default" data-dismiss="modal">Cancel</button>            
        </div>
      </div>
    </div>
  </div>
</div>

