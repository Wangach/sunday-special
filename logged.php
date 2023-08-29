<?
include 'api/session_checker.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="John Wangaruro Kimani">

    <title>Sunday Special Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <!--Imported JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <!--Own JS-->
    <script src="js/process.js" type="module" defer></script>

</head>

<body id="page-top">
    <!--Custom Loaders-->
    <div class="loader">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="logged.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Sun Special Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="logged.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="search.php" >
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Search</span>
                </a>
                
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" >
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Transactions</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" >
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Charts</span>
                </a>
                
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" >
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <!-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a> -->
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?echo $admin;?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" id="dropdown-menu"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2" id="main-cards">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Games Played (Total)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="t-looser"
                                            data-start_from="0"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2" id="main-cards">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Games Played (Today)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">150</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-5 col-lg-7">
                            <div class="card shadow mb-4" id="main-cards">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Games Played Overview</h6>
                                    <!-- <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-7 col-lg-5">
                            <div class="card shadow mb-4" id="main-cards">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Select Action</h6>
                                        <!-- <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Dropdown Header:</div>
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div> -->
                                    </div>
                                <div class="row p-5">
                                    <div class="col-lg-6 mt-2">
                                        <div class="card shadow" id="mini-cards" data-toggle="modal" data-target="#looser">
                                            <div class="card-body text-center inline">
                                                Looser
                                                <i class="fas fa-poll fa-1x text-danger ml-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <div class="card shadow" id="mini-cards" data-toggle="modal" data-target="#fair">
                                            <div class="card-body text-center">
                                                Fair
                                                <i class="fas fa-hourglass-half fa-1x text-info ml-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <div class="card shadow" id="mini-cards" data-toggle="modal" data-target="#pay">
                                            <div class="card-body text-center">
                                                Make Payment
                                                <i class="fas fa-money-check-alt fa-1x text-warning ml-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 mt-4">
                                        <div class="card shadow" id="mini-cards" data-toggle="modal" data-target="#gameweek">
                                            <div class="card-body text-center">
                                                Create User
                                                <i class="fas fa-user-plus fa-1x text-primary ml-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-4">
                                        <div class="card shadow" id="mini-cards" data-toggle="modal" data-target="#debtor">
                                            <div class="card-body text-center">
                                                Indebt
                                                <i class="fas fa-exchange-alt fa-1x text-dark ml-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4" id="main-cards">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Recent Looser Games</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th scope="col">Players</th>
                                            <th scope="col">Teams</th>
                                            <th scope="col">Score Line</th>
                                            <th scope="col">Outcome</th>
                                            <th scope="col">Match ID</th>
                                          </tr>
                                        </thead>
                                        <tbody id="latest-lost">
                                          
                                        </tbody>
                                      </table>
                                </div><!--table responsive-->
                            </div>

                        </div>

                        <div class="col-lg-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4" id="main-cards">
                                <div class="card-header py-3 organize">
                                    <h6 class="m-0 font-weight-bold text-primary">Recent Fair Games</h6>
                                    <button class='btn btn-primary' id='pay-all' type='button'>
                                    Pay All <span class="badge badge-light" id="tu">6</span>
                                </button>
                                </div>
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                <th scope="col">Teams</th>
                                                <th scope="col">Score Line</th>
                                                <th scope="col">Payment Status</th>
                                                <th scope="col">Match ID</th>
                                                <th scope="col">Action</th>
                                              </tr>
                                            </thead>
                                            <tbody id="latest-fair">
                                              
                                            </tbody>
                                          </table>
                                    </div><!--responsive-->
                                </div>
                            </div>

                            <!-- Approach -->
                            <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div>
                            </div> -->

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Broad Horizons Ent
                            <script>
                                let d = new Date;
                                let cyr = d.getFullYear();

                                document.write(cyr);
                            </script>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Change theme Button-->
    <a>
        <div class="fas fa-moon" id="theme-btn"></div>
    </a>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-----------------------
    ---------Modals----------
    ------------------------>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="api/master.php" id="logout-btn" class="btn btn-danger" type="button">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!--Looser Modal-->
    <div class="modal fade" id="looser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">FIFA 23 Looser Pay</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="api/master.php" id="looser-form" method="POST">
                  <div class="form-group">
                      <label for="homp">Home Player:</label>
                      <input type="text" class="form-control" placeholder="Enter Home Player Name..." id="hp" name="hp" required>
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="awap">Away Player:</label>
                      <input type="text" class="form-control" placeholder="Enter Away Player Name..." id="ap" name="ap" required>
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="homet">Home Team:</label>
                      <input type="text" class="form-control" placeholder="Enter Home Team..." id="ht" name="ht" required>
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="awat">Away Team:</label>
                      <input type="text" class="form-control" placeholder="Enter Away Team..." id="at" name="at" required>
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="homsc">Home Score:</label>
                      <input type="number" class="form-control" placeholder="Home Player Score..." id="hsc" name="hsc" required>
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="awasc">Away Score:</label>
                      <input type="number" class="form-control" placeholder="Away Player Score..." id="asc" name="asc" required>
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="matchty">Match Type:</label>
                      <select name="matchType" id="mtyp" class="form-control">
                          <option value=""></option>
                          <option value="hut">Half Time</option>
                          <option value="fut">Full Time</option>
                          <option value="nus">Nusu nusu</option>
                          <option value="sul">Super Looser</option>
                          <option value="ssl">Super Super Looser</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="awasc">Coupon:</label>
                      <input type="text" class="form-control" placeholder="Apply Code..." id="coup" name="coup" value="cst" required>
                  </div><!--/.form-group/-->
                  <button type="submit" id="looser-btn" class="btn btn-primary" name="recordm">Record</button>
                  <button type="button" id="clear-looser" class="btn btn-warning" disabled="true">Clear</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!--Fair Modal-->
      <div class="modal fade" id="fair" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">FIFA 23 Fair Play</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="api/master.php" id="fair-form" method="POST">
                  <div class="form-group">
                      <label for="homet">Team 1:</label>
                      <input type="text" class="form-control" placeholder="Enter Home Team..." id="fht" name="ht">
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="awat">Team 2:</label>
                      <input type="text" class="form-control" placeholder="Enter Away Team..." id="fat" name="at">
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="homsc">Home Score:</label>
                      <input type="number" class="form-control" placeholder="Home Player Score..." id="fhsc" name="fhsc">
                  </div><!--/.form-group/-->
                  <div class="form-group">
                      <label for="awasc">Away Score:</label>
                      <input type="number" class="form-control" placeholder="Away Player Score..." id="fasc" name="Fasc">
                  </div><!--/.form-group/-->
                  <button type="submit" id="fair-btn" class="btn btn-primary" name="fairrec">Record</button>
                  <button type="button" id="clear-fair" class="btn btn-warning" disabled="true">Clear</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!--Create User Modal-->
      <div class="modal fade" id="gameweek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="api/master.php" id="user-form" method="POST">
                    <div class="form-group">
                        <label for="name">UserName: </label>
                        <input type="text" placeholder="User's Name..." class="form-control" id="jina" name="jina">
                    </div><!--form-group-->
                    <div class="form-group">
                        <label for="alias">Alias: </label>
                        <input type="text" placeholder="System Name..." class="form-control" id="alias" name="alias">
                    </div><!--form-group-->
                    <div class="form-group">
                        <label for="phone">Phone Number: </label>
                        <input type="number" placeholder="Phone..." class="form-control" id="ph" name="ph">
                    </div><!--form-group-->
                    <div class="form-group">
                        <label for="fav">Fav Team:</label>
                        <input type="text" placeholder="Eg Arsenal..." class="form-control" id="ftm" name="ftm">
                    </div><!--form-group-->
                    <div class="form-group">
                        <label for="uno">Limit: </label>
                        <input type="number" placeholder="100..." class="form-control" id="un" name="un">
                    </div><!--form-group-->

                    <button type="submit" class="btn btn-info" id="f2-user"><i class="fas fa-user-plus"></i></button>
                    
                </form>
            </div>
          </div>
        </div>
      </div>

      <!--Transactions Modal-->
      <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="api/master.php" id="payments-form" method="POST">
                    <div class="form-group">
                        <select name="txnType" id="txntyp" class="form-control">
                            <option value=""></option>
                            <option value="cr">Credit</option>
                            <option value="db">Debit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Transactor: </label>
                        <input type="text" class="form-control" id="trname" placeholder="Transactor..." name="cusjina">
                    </div>
                    <div class="form-group">
                        <label for="mode">Payment Method</label>
                        <select name="txnMode" id="txnmode" class="form-control">
                            <option value=""></option>
                            <option value="cs">Cash</option>
                            <option value="mp">Mobile Money (Mpesa, Airtel Money, Tkash)</option>
                            <option value="bnk">Bank</option>
                            <option value="ot">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Amount: </label>
                        <input type="number" class="form-control" id="tramt" placeholder="Amount..." name="kiwango">
                    </div>
                    <div class="form-group">
                        <label for="name">Description: </label>
                        <input type="text" class="form-control" id="trds" placeholder="Description..." name="maelezo">
                    </div>
                    <button type="submit" class="btn btn-info" id="pay">Submit</button>
                    <button type="button" id="clear-transact" class="btn btn-danger" disabled="true">Clear</button>
                </form>
            </div>
            <div id="results">
               
            </div>
          </div>
        </div>
      </div>

       <!--Debt Search Modal-->
       <div class="modal fade" id="debtor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Indebt</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="api/master.php" id="indebt" method="POST">
                    <div class="form-group">
                        <label for="trname">Enter Name:</label>
                        <input type="text" class="form-control" placeholder="Name..." id="dn" name="dn">
                    </div><!--/.form-group/-->
                    <div class="form-group">
                        <label for="trname">Reason:</label>
                        <input type="text" class="form-control" placeholder="Eg Coffee, AOB..." id="drxn" name="drxn">
                    </div><!--/.form-group/-->
                    <div class="form-group">
                        <label for="trname">Amount:</label>
                        <input type="number" class="form-control" placeholder="Eg 10, 50, 100...." id="damt" name="damt">
                    </div><!--/.form-group/-->
                    <button type="submit" id="txn-btn" class="btn btn-primary" name="indebt"><i class="fas fa-dollar-sign"></i></button>
                    <button type="button" id="clear-indebt" class="btn btn-danger" disabled="true"><i class="fas fa-trash"></i></button>
                </form>
            </div>
          </div>
        </div>
      </div>


      <!--GameWeek Modal-->
      <div class="modal fade" id="gw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add GW</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="api/master.php" id="debt-search" method="POST">
                    <div class="form-group">
                        <label for="start">Start Date:</label>
                        <input type="date" class="form-control" id="strt" name="strt" placeholder="Start Date">
                    </div><!--/.form-group/-->
                    <div class="form-group">
                        <label for="start">End Date:</label>
                        <input type="date" class="form-control" id="ende" name="ende" placeholder="End Date">
                    </div><!--/.form-group/-->
                    <button type="submit" id="f2-txn-btn" class="btn btn-primary" name="initgw"><i class="fas fa-dollar-sign"></i></button>
                </form>
            </div>
          </div>
        </div>
      </div>

       <!--ViewMatch Modal-->
       <div class="modal fade" id="viewMatchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Match Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="in_details">
               
            </div>
          </div>
        </div>
      </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

</body>

</html>