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

    <title>EAFC 24 | Search Page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/search.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">

    <!--Imported JS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <!--Own JS-->
    <script src="js/search.js" type="module" defer></script>

</head>

<body id="page-top">
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
                <div class="sidebar-brand-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EAFC <sup>24</sup></div>
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

            <li class="nav-item">
                <a class="nav-link collapsed" href="fifa23.php" target="_blank" >
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>FIFA 23 Data</span>
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
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card mb-4 py-3 border-left-primary shadow h-100 " id="main-cards">
                                <div class="card-body">
                                    <form action="api/master_v2.php" id="searchUser" method="POST">
                                        <div class="form-group">
                                            <label for="term"></label>
                                            <input type="text" class="form-control" placeholder="Search.." id="un" name="un">
                                        </div>
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card mb-4 py-3 shadow h-100 " id="main-cards">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Match Summary</h6>
                                </div>
                                <div class="card-body">
                                    <div id="match-calculate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card mb-4 py-3 shadow h-100 " id="main-cards">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Debt Summary</h6>
                                </div>
                                <div class="card-body">
                                    <div id="debt-calculate"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card mb-4 py-3 shadow h-100 " id="main-cards">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daily Stats</h6>
                                </div>
                                <div class="card-body">
                                    <div id="daily-stats-calculate"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card mb-4 py-3 shadow h-100 " id="main-cards">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">latest Matches</h6>
                                </div>
                                <div class="card-body">
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
                                            <tbody id="latest-lost-individual">
                                              
                                            </tbody>
                                          </table>
                                    </div><!--table responsive-->
                                </div>
                            </div>
                        </div><!--column-->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card mb-4 py-3 shadow h-100 " id="main-cards">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">latest Transactions</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Desc</th>
                                                <th scope="col">Match Id</th>

                                              </tr>
                                            </thead>
                                            <tbody id="recent-transactions-individual">
                                              
                                            </tbody>
                                          </table>
                                    </div><!--table responsive-->
                                </div>
                            </div>
                        </div><!--column-->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card mb-4 py-3 shadow h-100 " id="main-cards">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Indebt Transactions</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Reason</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Date Of Issue</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>

                                              </tr>
                                            </thead>
                                            <tbody id="recent-indebt-individual">
                                              
                                            </tbody>
                                          </table>
                                    </div><!--table responsive-->
                                </div>
                            </div>
                        </div><!--column-->
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

    <!--View Today Won Individual Match Modal-->
    <div class="modal fade" id="won" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Won Matches Today</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="wonMatchesDetails">
            
            </div>
        </div>
        </div>
    </div>

    <!--View Today Lost Individual Match Modal-->
    <div class="modal fade" id="lost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lost Matches Today</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="lostMatchesDetails">
            
            </div>
        </div>
        </div>
    </div>

    <!--View Today Won Individual Match Modal-->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class='table-responsive'>
						<table class='table table-striped'>
                            <thead>
                                <tr>
                                    <th scope="col" class="font-weight-bold">#</th>
                                    <th scope="col" class="font-weight-bold">Name</th>
                                    <th scope="col" class="font-weight-bold">Method</th>
                                    <th scope="col" class="font-weight-bold">Desc</th>
                                    <th scope="col" class="font-weight-bold">Time</th>
                                    <th scope="col" class="font-weight-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody id="trDetailsShow">
                                
                            </tbody>
                        </table>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Already Leaving?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="api/master_v2.php" id="logout-btn" class="btn btn-danger" type="button">Logout</a>
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

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>



</body>

</html>