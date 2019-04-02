<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php">Salary Processing</a>
      </div>

      <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $user->getUsername() ?>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-user">
                        <li><a href="edit-user.php?id=<?php echo $user->getUserId() ?>"><i class="fa fa-user fa-fw"></i> Edit User Profile</a></li>
                        <li class="divider"></li>
                        <li>
                              <a href="includes/scripts/logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                        </li>
                  </ul>
            </li>
      </ul>
      <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                  <ul class="nav" id="side-menu">
                        <li>
                              <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                              <a href="salary-processing.php"><i class="fa fa-edit fa-fw"></i> Claim Salary</a>
                        </li>
                  </ul>
            </div>
      </div>
</nav>