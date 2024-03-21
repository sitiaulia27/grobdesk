<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include 'function_sidebar.php'; ?>
</head>
<body>
  
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin.php" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light ml"><h3><b>Grobdesk</b></h3></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar6.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profil_admin.php" class="d-block">
          <?php sidebar(); ?>
          </a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          <li class="nav-item">
            <a href="roleMenu.php" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Access Menu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="category_index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Category Ticket
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Ticket Data
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="data_ticket.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Ticket</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="your_unsolved_tickets.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Your Unsolved Tickets</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="unassigned_tickets.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Unassigned Tickets</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="all_unsolved_tickets.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Unsolved Tickets</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="recently_updated_tickets.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recently Updated Tickets</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="recently_solved_tickets.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recently Solved Tickets</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="delete_tickets.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Delete Tickets</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="assigned_tickets.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Assigned Tickets</p>
                    </a>
                  </li>
                </ul>


          <li class="nav-item">
            <a href="user_menu.php" class="nav-link">
            <i class='nav-icon fas fa-user'></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="macro_index.php" class="nav-link">
            <i class='nav-icon fas fa-comments'></i>
              <p>
                Macro
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="customer_replay.php" class="nav-link">
            <i class='nav-icon fas fa-comment'></i>
              <p>
                Message Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
            <i class='nav-icon fas fa-sign-out-alt'></i>
              <p>
                Logout
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

</body>
</html>
