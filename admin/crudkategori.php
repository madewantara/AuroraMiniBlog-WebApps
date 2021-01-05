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
        $idadmin = $row_a->idadmin;
        $name = $row_a->nama;
        $gambar = $row_a->gambar;
    }
?>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Penulis - Admin</title>

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
            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-dark">Data Kategori</h1>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">+ Tambah Kategori</button><br><br>
                        
                            <table class="table table-striped">
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>

                                <?php
                                
                                    $query= "SELECT * FROM kategori ORDER BY idkategori";
                                    $result = $db->query($query);
                                    if (!$result){
                                        die ("Could not query the database: <br/>".$db->error."<br>Query: ".$query);
                                    }

                                    $i=1;
                                    while ($row = $result->fetch_object()){
                                        echo '<tr>';
                                        echo '<td class="text-center">'.$i.'</td>';
                                        echo '<td class="pl-5">'.$row->nama.'</td>';
                                        
                                        echo '<td class="text-center"><a type="button" class="btn btn-warning btn-sm edit" href="edit_kategori.php?id='
                                        .$row->idkategori.'">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm text-white" onclick="deleteKategori('
                                            .$row->idkategori.')">Delete</button>
                                            </td>';
                                        echo "</tr>";
                                        
                                        $i++;
                                    }

                                    echo '</table>';
                                    echo '<br/>';

                                    ?>
                                    </table>
                                    <div id="delete_response">
                                    
                                        
                                    </div>
                                    <div id="refresh" ></div>
                            </div>
                        </div>
                    </div>              
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only" onclick="reload();">Close</span></button>
                                    
                                </div>
                                <form method="GET" autocomplete="on" >
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Nama kategori</label>
                                            <input type="text" class="form-control" id="name" name="name" >
                                        </div>
                                        <div id="add_response"></div>
                                        <div id="refresh1"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="add_kategori(); refresh1();">Tambah
                                            </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    </div>
                                </form>
                            </div>
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
    <script src="ajaxcrudkat.js"></script>
</body>
</html>
<?php
  $db->close();
?>