<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../login.php');
    }
    $id = $_GET['id'];
    require_once('db_login.php');
    $email = $_SESSION['admin'];
    $query_a = " SELECT * FROM admin WHERE email='".$email."' ";
    $query_b = " SELECT COUNT(idnotif) as idnotif FROM notifikasi ";
    $result_a = $db->query($query_a);
    $result_b = $db->query($query_b);
    if(!$result_a){
        die("Could not query the database: <br />". $db->error."<br>Query: ".$query_a);
    }
    if(!$result_b){
        die("Could not query the database: <br />". $db->error."<br>Query: ".$query_b);
    }
    while($row_a = $result_a->fetch_object()){
        $id_session = $row_a->idadmin;
        $name = $row_a->nama;
        $gambar = $row_a->gambar;
        $email = $row_a->email;
        $password = $row_a->password;
    }
    while($row_b = $result_b->fetch_object()){
        $jml_notif = $row_b->idnotif;
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

    <title>Inbox - Admin</title>

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-dark">Inbox</h1>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="card shadow mb-3" style="min-height: 550px;">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-5">
                                            <ul class="list-group list-group-flush">
                                                <?php
                                                $page = $id * 4 - 4;
                                                    $query = " SELECT idnotif,nama,waktu,SUBSTRING(judulnotif,1,30) as judul, SUBSTRING(isinotif,1,40) as isi FROM notifikasi ORDER BY idnotif DESC LIMIT ".$page.",4";
                                                    $result = $db->query($query);
                                                    if(!$result){
                                                        die("Could not query the database: <br />". $db->error."<br>Query: ".$query);
                                                    }
                                                    while($row = $result->fetch_object()){
                                                        echo    '<a class="list-group-item text-left mb-0 pb-0" href="#" style="color: black; text-decoration: none; border: 1px rgba(0, 0, 0, 0.1); border-style: none solid none none;" onclick="notif('.$row->idnotif.')">
                                                                    <div class="container">
                                                                        <h6><b>'.$row->nama.'</b></h6>
                                                                        <h6>'.$row->judul.'<span class="text-xs float-right">'.$row->waktu.'</span></h6>
                                                                        <p>'.$row->isi.'</p>
                                                                    </div>
                                                                    <hr>
                                                                </a>';
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col-7" style="min-height: 500px;">
                                            <div id="notif" style="color: black;">
                                                <span class="notif">Pilih notifikasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="pagination justify-content-center">
                    <?php
                        echo '<li class="page-item"><a class="page-link" href="'; 
                        $prev = $id-1;
                        $next = $id+1;
                        if($id>1) echo 'notifikasi.php?id='.$prev; else echo '#'; 
                        echo '">Previous</a></li>';
                        $i = 1;
                        echo '<li class="page-item'; if($id==$i) echo ' active'; echo '"><a class="page-link" href="notifikasi.php?id='.$i.'">1</a></li>';
                        while ($jml_notif-4>0){
                            $jml_notif = $jml_notif-4;
                            $i++;
                            echo '<li class="page-item'; if($id==$i) echo ' active'; echo '"><a class="page-link" href="notifikasi.php?id='.$i.'">'.$i.'</a></li>';
                        }
                        echo '<li class="page-item"><a class="page-link" href="';
                        if($id<$i) echo 'notifikasi.php?id='.$next; else echo'#';
                        echo '">Next</a></li>';
                    ?>
                    </ul>
                </div>
            </div>
            
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
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