<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../login.php');
    }
    require_once('db_login.php');
    $email = $_SESSION['admin'];
    $query_a = " SELECT * FROM admin WHERE email='".$email."' ";
    $result_a = $db->query($query_a);
    if(!$result_a){
        die("Could not query the database: <br />". $db->error."<br>Query: ".$query_a);
    }
    while($row_a = $result_a->fetch_object()){
        $id_session = $row_a->idadmin;
        $name = $row_a->nama;
        $gambar = $row_a->gambar;
        $email = $row_a->email;
        $password = $row_a->password;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/logo.png">

</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" style="background-color: #44318d" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="homeadmin.php">
            <div class="sidebar-brand-icon">
            <img src="../assets/images/logo.png">
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="homeadmin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data Management</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="crudkategori.php">Kategori</a>
                <a class="collapse-item" href="editpenulis.php">Penulis</a>
            </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

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
                <nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow" style="background-color:#d93f87">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-white-600 small">
                            <?php echo $name;?>
                            </span>
                            <?php
                                echo '<img class="img-profile rounded-circle" src="data:image/jpeg;base64,'.base64_encode($gambar).'" style="object-fit:cover;">';
                            ?>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
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
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-body text-center">
                                    <?php
                                        echo    '<img class="rounded-circle" src="data:image/jpeg;base64,'.base64_encode($gambar).'" data-toggle="modal" data-target="#upload" style="object-fit:cover; width:200px; height:200px">';
                                        echo    '<div class="card-body">
                                                    <h3>'.$name.'</h3>
                                                    <h6>'.$email.'</h6>
                                                    <br>
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit"><i class="far fa-edit"></i> Edit Profile</button>
                                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#password"><i class="fas fa-key"></i> Change Password</button>
                                                </div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="upload">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Upload Photo</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <form method="POST" autocomplete="on" action="upload.php?id=<?php echo $id_session; ?>" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" id="img" name="img" accept="image/*">
                                </div>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Upload</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">&times; Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="edit">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Profile</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <form method="POST" autocomplete="on" action="simpan.php?id=<?php echo $id_session; ?>">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $name; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required> 
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">&times; Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="password">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Change Password</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <form method="POST" autocomplete="on">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="lama">Password Lama</label>
                                    <input type="password" class="form-control" id="lama" name="lama" required>
                                </div>
                                <div class="form-group">
                                    <label for="baru">Password baru</label>
                                    <input type="password" class="form-control" id="baru" name="baru" required> 
                                </div>
                                <div class="form-group">
                                    <label for="baru">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="baru2" name="baru2" required> 
                                </div>
                                <div id="password-response"></div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="password(<?php echo $id_session; ?>);"><i class="fas fa-check"></i> Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">&times; Batal</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center text-dark my-auto">
                    <span>Copyright &copy; AURORA 2020</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../logout.php">Logout</a>
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

    <!-- Page level custom scripts -->
    <script src="admin.js"></script>
</body>
</html>
<?php
    $db->close();
?>