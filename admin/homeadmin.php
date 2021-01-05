<?php
  session_start();
  if(!isset($_SESSION['admin'])){
      header('Location: ../login.php');
  }
  require_once('db_login.php');
  $email = $_SESSION['admin'];
  $query_a = " SELECT * FROM admin WHERE email='".$email."' ";
  $query_b = " SELECT COUNT(idkategori) as jumlah FROM kategori ";
  $query_c = " SELECT COUNT(idpenulis) as jumlah FROM penulis ";
  $query_d = " SELECT COUNT(idpost) as jumlah FROM post ";
  $query_e = " SELECT COUNT(idnotif) as jumlah FROM notifikasi ";
  $result_a = $db->query($query_a);
  $result_b = $db->query($query_b);
  $result_c = $db->query($query_c);
  $result_d = $db->query($query_d);
  $result_e = $db->query($query_e);
  if(!$result_a){
      die("Could not query the database: <br />". $db->error."<br>Query: ".$query_a);
  }
  if(!$result_b){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_b);
  }
  if(!$result_c){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_c);
  }
  if(!$result_d){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_d);
  }
  if(!$result_e){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_e);
  }
  while($row_a = $result_a->fetch_object()){
    $idadmin = $row_a->idadmin;
    $name = $row_a->nama;
    $gambar = $row_a->gambar;
  }
  
  $row_b = $result_b->fetch_object();
  $jml_kategori = $row_b->jumlah;
  $row_c = $result_c->fetch_object();
  $jml_penulis = $row_c->jumlah;
  $row_d = $result_d->fetch_object();
  $jml_post = $row_d->jumlah;
  $row_e = $result_e->fetch_object();
  $jml_notif = $row_e->jumlah;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard - Admin</title>

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
      <li class="nav-item active">
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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
            <a href="report.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <a class="box card border-left-primary shadow h-100 py-2" href="crudkategori.php" style="text-decoration: none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kategori</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $jml_kategori;?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <a class="box card border-left-success shadow h-100 py-2" href="editpenulis.php" style="text-decoration: none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penulis</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $jml_penulis;?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <a class="box card border-left-info shadow h-100 py-2" href="#" style="text-decoration: none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Post</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $jml_post;?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-pencil-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <a class="box card border-left-warning shadow h-100 py-2" href="notifikasi.php?id=1" style="text-decoration: none;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Inbox</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $jml_notif;?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-inbox fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Data Display</h6>
                </div>
                <div class="card-body">
                  <?php
                    $query = " SELECT * FROM post GROUP BY idkategori ";
                    $result = $db->query($query);
                    if(!$result){
                        die("Could not query the database: <br />". $db->error."<br>Query: ".$query);
                    }
                    $color = array('danger','primary','success','info','warning');
                    $i = 0;
                    while($row = $result->fetch_object()){
                      $kategori = " SELECT nama FROM kategori WHERE idkategori='".$row->idkategori."' ";
                      $up = $db->query($kategori);
                      if(!$up){
                        die("Could not query the database: <br />". $db->error."<br>Query: ".$kategori);
                      }
                      $hasil_kategori = $up->fetch_object();
                      $nama_kategori = $hasil_kategori->nama;

                      $post = " SELECT COUNT(idpost) as jumlah FROM post WHERE idkategori='".$row->idkategori."' ";
                      $postt = $db->query($post);
                      if(!$postt){
                        die("Could not query the database: <br />". $db->error."<br>Query: ".$post);
                      }
                      $hasil_post = $postt->fetch_object();
                      $jumlah_post = $hasil_post->jumlah;
                      $jumlah = ($jumlah_post/$jml_post)*100;
                      echo '<h4 class="small font-weight-bold">'.$nama_kategori.'<span class="float-right">'.$jumlah_post.'</span></h4>
                            <div class="progress mb-4">
                              <div class="progress-bar bg-'.$color[$i].'" role="progressbar" style="width: '.$jumlah.'%" aria-valuenow="'.$jumlah_post.'" aria-valuemin="0" aria-valuemax="'.$jml_post.'"></div>
                            </div>';
                      $i++;
                      if($i > 4){
                        $i = 0;
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">Todo List <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah" style="float: right;">+ Tambah tugas</a></h6>
                </div>
                <ul class="list-group list-group-flush">
                  <?php
                    $query = " SELECT * FROM todo WHERE idadmin='".$idadmin."' ORDER BY deadline ";
                    $result = $db->query($query);
                    if(!$result){
                        die("Could not query the database: <br />". $db->error."<br>Query: ".$query);
                    }
                    if(mysqli_num_rows($result)==0){
                      echo '<li class="list-group-item">
                              <div class="row align-items-center no-gutters">
                                <div class="col text-center">
                                  <h6>No task available</h6>
                                </div>
                              </div>
                            </li>';
                    }
                    while($row = $result->fetch_object()){
                      echo '<li class="list-group-item">
                              <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                  <h6 class="mb-0"><strong>'.$row->tugas.'</strong></h6><span class="text-xs">'.$row->deadline.'</span></div>
                                <div class="col-auto">
                                  <a class="btn btn-sm btn-success" href="delete_task.php?id='.$row->idtodo.'"><i class="fas fa-check"></i> Finish</a>
                                </div>
                              </div>
                            </li>';
                    }
                  ?>
                </ul>
                <div class="modal fade" id="tambah">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Tambah Tugas</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      
                      <!-- Modal body -->
                      <form method="POST" autocomplete="on" action="add_task.php?id=<?php echo $idadmin; ?>">
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="tugas">Tugas</label>
                            <input type="text" class="form-control" id="tugas" name="tugas">
                          </div>
                          <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Tambah</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">&times; Batal</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center text-dark my-auto">
            <span>Copyright &copy; AURORA 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

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
