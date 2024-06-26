<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BHENT Management System - Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/login.js" defer></script>

</head>

<body class="bg-gradient-custom">
     <!--Custom Loaders-->
     <div class="loader">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <div class="container">
        <div id="feedback"></div>
        <!-- Outer Row -->
        <div class="row justify-content-center"  id="nes">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="login-form" method="POST" action='api/master_v2.php'>
                                        <div class="form-group">
                                           <label for="role">Login as: </label>
                                           <select name="role" id="role" class="form-control">
                                            <option value=""></option>
                                            <option value="1">Admin</option>
                                            <option value="2">Co-Admin</option>
                                            <option value="3">User</option>
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Username: </label>
                                            <input type="text" class="form-control form-control-user"
                                                id="un" aria-describedby="usernameHelp"
                                                placeholder="Enter Your Username...">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Password: </label>
                                            <input type="password" class="form-control form-control-user"
                                                id="pwd" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>