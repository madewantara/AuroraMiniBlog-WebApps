<?php
    session_start();
    if (!isset($_SESSION['penulis'])){
    header('Location: login.php');
}
?>
<?php
require_once('db_login.php');
$email=$_SESSION['penulis'];
$query_a = " SELECT * FROM penulis WHERE email='".$email."' ";
$result_a = $db->query($query_a);
if(!$result_a){
      die("Could not query the database: <br />". $db->error."<br>Query: ".$query_a);
  }
while($row_a = $result_a->fetch_object()){
    $idpenulis=$row_a->idpenulis;
    $name = $row_a->nama;
    $alamat = $row_a->alamat;
    $kota = $row_a->kota;
    $telp = $row_a->no_telp;
    $gambar = $row_a->gambar;
}

$post="SELECT *, count(idpost) as jumlah FROM post WHERE idpenulis='".$idpenulis."' ";
$result_post = $db->query($post);
if(!$result_post){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$post);
}
while($row = $result_post->fetch_object()){
    $jumlah=$row->jumlah;
}
?>
<?php include('templates/header.php');?>
    <title>Aurora</title>
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar nav-design navbar-expand-lg navbar-dark pt-3 pb-3">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <form class="form-inline my-2 my-lg-0" method="POST" autocomplete="on" action="hasilsearch.php">
                        <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Cari Judul Cerita" aria-label="Search">
                        <button type="submit"><img src="assets/images/search.png" class="align-middle" alt="" style="width:60%;"></button>
                    </form>
                    <div class="navbar-nav ml-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-item nav-link" href="index.php">BERANDA</a>
                            </li>
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">KATEGORI</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <?php
                                    $nama=$db->query('SELECT * FROM kategori');
                                    while($row = $nama->fetch_object()){
                                        echo '<a class="dropdown-item" href="detailkategori.php?id='.$row->idkategori.'">'.$row->nama.'</a>';
                                    }
                                    ?>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-item nav-link" href="contactus.php">KONTAK</a>
                            </li>
                            <li class="nav-item dropdown no-arrow active">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;">
                                    <span class="d-none d-lg-inline">
                                    <?php echo $name;?>
                                    </span>
                                    <?php
                                        if ($gambar==null){
                                            echo '<img class="img-profile rounded-circle ml-1" src="assets/images/logoakun.png" style="object-fit:cover; width:28px; height:28px;">';
                                        }else{
                                            echo '<img class="img-profile rounded-circle ml-1" src="data:image/jpeg;base64,'.base64_encode($gambar).'" style="object-fit:cover; width:28px; height:28px;">';
                                        } 
                                    ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="profile_penulis.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Akhir Navbar -->
    </header>


    <main class="pt-5 pb-4">
        <!-- Profile -->
        <section class="profile">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="fotoprofil"> 
                        <?php
                            if ($gambar==null){
                                echo '<img class="img-profile rounded-circle" src="assets/images/logoakun.png">';
                            }else{
                                echo '<img class="img-profile rounded-circle"src="data:image/jpeg;base64,'.base64_encode($gambar).'">';
                            } 
                            ?>
                            <a data-toggle="modal" data-target="#upload"><div class="overlay-fotoprofil rounded-circle"><h3 class="text-white">Ganti Foto</h3></div></a>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <?php
                            echo '<h2>'.$name.'<button type="button" class="btn btn-outline-secondary ml-3" data-toggle="modal" data-target="#edit_penulis"><b>Edit Profil</b></button></h2>
                            <p>Jumlah post : '.$jumlah.'</p>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#password">Ganti Password</button>
                            <a type="button" class="btn btn-primary" href="tambah_tulisan.php?id='.$idpenulis.'">+ Tambah Tulisan</a>';
                        ?>
                    </div>
                </div>
                <br><hr><br>
            </div>
        </section>
        <!-- Akhir Profile -->

        <!-- Detail Post Profile -->
        <section class="galeri-penulis">
            <div class="container">
                <div class="row">
                <?php
                    $recent=$db->query('SELECT idpost,judul,SUBSTRING(isi_post,1,60) as isipost, file_gambar, tgl_insert FROM post WHERE idpenulis="'.$idpenulis.'" ORDER BY idpost DESC');
                    $i=0;
                    while($row = $recent->fetch_object()){
                        echo '<div class="col-md-4 mb-3">';
                        echo '<div class="card" style="border-radius:0px 0px">';
                        echo '<div class="slide-img">
                        <img src="data:image/jpeg;base64,'.base64_encode($row->file_gambar).'" class="card-img-top img-fluid" alt="..." style="height:200px;">
                        </div>';
                        echo '<div class="card-body">
                            <h5 class="card-title mb-1"><a class="readmore" href="detail_post.php?id='.$row->idpost.'">'.$row->judul.'</a></h5>
                            <small>Dipost pada : '.$row->tgl_insert.'</small><br><br>
                            <a href="edit_tulisan.php?id='.$row->idpost.'" class="btn btn-info">Edit</a>
                            <a href="#delete_response"><button type="button" class="btn btn-danger" onclick="deleteTulisan('.$row->idpost.')">Delete</button></a>
                            </div>';
                        echo '</div>';
                        echo '</div>';
                        $i=$row->idpost;
                    }
                ?>
                </div>
                <div id="delete_response"> </div>
                <div id="refresh" ></div>
            </div>
        </section>
        <!-- Akhir Detail Post Profile -->
    </main>

    <!-- Modal Edit Profil -->
    <div class="modal fade" id="edit_penulis">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Profile</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <form method="POST" autocomplete="on" action="simpan.php?id=<?php echo $idpenulis; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $kota; ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No.Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $telp; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
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
    <!-- Akhir Modal Edit Profil -->

    <!-- Modal Ganti Password -->
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
                        <button type="button" class="btn btn-primary" onclick="password(<?php echo $idpenulis; ?>);"><i class="fas fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">&times; Batal</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- Akhir Modal Ganti Password -->

    <!-- Modal Ganto Foto -->
    <div class="modal fade" id="upload">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload Photo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <form method="POST" autocomplete="on" action="upload_penulis.php?id=<?php echo $idpenulis; ?>" enctype="multipart/form-data">
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
    <!-- Akhir Modal Ganti Foto -->

    <!-- Footer -->
    <footer class="page-footer text-white">
    <div class="container text-center pt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <h5 class="py-2" id="foot"><b>TENTANG KAMI</b></h5>
                <p>Aurora adalah sebuah platform yang menerima tulisan seorang penulis yang ingin menuangkan ide berupa tulisan dalam sebuah karya</p>
            </div>
            <div class="col-4">
                <h5 class="py-2" id="foot"><b>NAVIGASI</b></h5>
                <a class="text-white" id="er" href="index.php">Halaman Utama</a><br>
                <a class="text-white" id="er" href="contactus.php">Hubungi Kami</a>
            </div>
        </div>
        <div class="footer-copyright text-center py-3 pt-4">© 2020 Copyright:
            <a id="aurora" class="text-white" href="index.php">Aurora</a>
        </div>
    </div>
    </footer>
    <!-- Akhir Footer  -->
<?php include('templates/footer.php');?>