<?php
session_start();
require_once('db_login.php');

if(isset($_SESSION['penulis'])){
    $email=$_SESSION['penulis'];
    $query_a = " SELECT * FROM penulis WHERE email='".$email."' ";
    $result_a = $db->query($query_a);
    if(!$result_a){
        die("Could not query the database: <br />". $db->error."<br>Query: ".$query_a);
    }
    while($row_a = $result_a->fetch_object()){
        $namalogin = $row_a->nama;
        $gambar = $row_a->gambar; 
        $idlogin = $row_a->idpenulis; 
    }
}

$idpost=$_GET['id'];
$query_post = " SELECT * FROM post WHERE idpost='".$idpost."' ";
$result_post = $db->query($query_post);
if(!$result_post){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_post);
}
while($row_post = $result_post->fetch_object()){
    $judul=$row_post->judul;
    $isipost = $row_post->isi_post;
    $gambarpost = $row_post->file_gambar;
    $tglinsert = $row_post->tgl_insert;
    $idpenulis_post = $row_post->idpenulis;
    $idkategori_post = $row_post->idkategori;
}
$query_penulis = " SELECT * FROM penulis WHERE idpenulis='".$idpenulis_post."' ";
$result_penulis = $db->query($query_penulis);
if(!$result_penulis){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_penulis);
}
while($row_penulis = $result_penulis->fetch_object()){
    $namapenulis=$row_penulis->nama;
    $emailpenulis=$row_penulis->email;
    $foto=$row_penulis->gambar;
}

$query_kategori = " SELECT * FROM kategori WHERE idkategori='".$idkategori_post."' ";
$result_kategori = $db->query($query_kategori);
if(!$result_kategori){
    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_kategori);
}
while($row_kategori = $result_kategori->fetch_object()){
    $namakategori=$row_kategori->nama;
}
?>

<?php include('templates/header.php');?>
    <title>Post-Aurora</title>
</head>
<body>
    <!-- Navbar -->
    <header>
    <nav class="navbar nav-design navbar-expand-lg navbar-dark pt-3 pb-3">
        <div class="container">
                <?php
                    if(!isset($_SESSION['penulis'])){
                        echo '<a class="navbar-brand" href="index.php"><img src="assets/images/logo.png"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Cari Cerita" aria-label="Search">
                                    <button type="submit"><img src="assets/images/search.png" class="align-middle" alt="" style="width:60%;"></button>
                                </form>
                            <div class="navbar-nav ml-auto">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-item nav-link" href="index.php">BERANDA</a>
                                    </li>
                                    <li class="nav-item dropdown active">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">KATEGORI</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                                            $nama=$db->query('SELECT * FROM kategori');
                                            while($row = $nama->fetch_object()){
                                                echo '<a class="dropdown-item" href="detailkategori.php?id='.$row->idkategori.'">'.$row->nama.'</a>';
                                            }
                        echo                '</div>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-item nav-link" href="contactus.php">KONTAK</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-item btn btn-light ml-2" href="login.php" style="color:#ffb223; font-weight:500; border-radius:50px; padding:6px 15px">MASUK</a>
                                    </li>
                                </ul>
                            </div>';
                    }else{
                        echo '<a class="navbar-brand" href="index.php"><img src="assets/images/logo.png"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Cari Cerita" aria-label="Search">
                                    <button type="submit"><img src="assets/images/search.png" class="align-middle" alt="" style="width:60%;"></button>
                                </form>
                            <div class="navbar-nav ml-auto">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-item nav-link" href="index.php">BERANDA</a>
                                    </li>
                                    <li class="nav-item dropdown active">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">KATEGORI</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';                                     
                                            $nama=$db->query('SELECT * FROM kategori');
                                            while($row = $nama->fetch_object()){
                                                echo '<a class="dropdown-item" href="detailkategori.php?id='.$row->idkategori.'">'.$row->nama.'</a>'; 
                                            }                                                                    
                        echo            '</div>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-item nav-link" href="contactus.php">KONTAK</a>
                                    </li>
                                    <li class="nav-item dropdown no-arrow active">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;">
                                            <span class="d-none d-lg-inline">';
                                                echo ''.$namalogin.'';
                        echo '              </span>';
                                                if ($gambar==null){
                                                    echo '<img class="img-profile rounded-circle ml-1" src="assets/images/logoakun.png" style="object-fit:cover; width:28px; height:28px;">';
                                                }else{
                                                    echo '<img class="img-profile rounded-circle ml-1" src="data:image/jpeg;base64,'.base64_encode($gambar).'" style="object-fit:cover; width:28px; height:28px;">';
                                                } 
                        echo                '</a>
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
                            </div>';
                    }
                ?>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->
    </header>

    <main>
        <div class="container">
            <!-- Gambar Post -->
            <section>
                <div class="hero">
                    <?php
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($gambarpost).'" class="" alt="gambarpost"';
                    ?>
                </div>
            </section>
            <!-- Akhir Gambar Post -->

            <!-- Detail Post -->
            <section>
                <div class="post">
                    <div class="row">
                        <!-- Detail Post -->
                        <div class="col-md-9">
                            <div class="detailpost">
                                <div class="titlepost">
                                    <?php
                                        echo '<h2>'.$judul.'</h2>
                                        <small>Kategori : '.$namakategori.'</small>';
                                    ?>
                                </div>
                                <hr>
                                <div class="isipost">
                                    <?php
                                        echo '<p>'.$isipost.'</p>';
                                    ?>
                                </div>
                            </div>
                            <hr class="py-3">
                            <?php  
                    $query = "SELECT * FROM komentar WHERE idpost='".$idpost."' ORDER BY tgl_update";
                    $kiw = $db->query($query);
                    if (!isset($idlogin)){
                        $idlogin='';
                    }
                    while ($rew= $kiw->fetch_object()){
                        echo '<div class="komentar col-md-9">';
                        $idp = $rew->idpenulis;
                        $idk = $rew->idkomentar;
                        
                        
                        if ($idp != '0'){
                            
                            $kueri = "SELECT * FROM penulis WHERE idpenulis='".$idp."'";
                            $hasil = $db->query($kueri);
                            $raw = $hasil->fetch_object(); 
                            $fotoprof = $raw->gambar;
                            echo '<div class="media border p-3 mb-3">';
                            if ($fotoprof == ''){
                                echo '<img src="assets/images/logoakun.png" alt="'.$raw->nama.'" class="mr-3 rounded-circle" style="width:60px; height:60px; object-fit: cover;">';
                            }
                            else {
                                echo '<img src="data:image/jpeg;base64,'.base64_encode($fotoprof).'" alt="'.$raw->nama.'" class="mr-3 rounded-circle" style="width:60px; height:60px; object-fit: cover;">';
                            }
                            echo '<div class="media-body" >';
                            if (($idlogin == $idp) || ($idlogin == $idpenulis_post)){
                                echo '<button type="button" class="btn btn-danger btn-sm float-right" onclick="deleteKomen('.$idk.','.$idpost.'); refresh3();">Delete</button>';
                            }
                            echo '<h5>'.$raw->nama.' <small style="font-size: 10pt;"><i> Posted on '.$rew->tgl_update.'</i></small></h5>';
                            echo '<p>'.$rew->isi.'</p>';
                            echo '</div></div>';
                        }
                        else {
                            echo '<div class="media border p-3 mb-3">';
                            echo '<img src="assets/images/logoakun.png" alt="Anonymous" class="mr-3 rounded-circle" style="width:60px; height:60px; object-fit: cover;">';
                            echo '<div class="media-body">';
                            echo '<h5>Anonymous <small style="font-size: 10pt;"><i> Posted on '.$rew->tgl_update.'</i></small></h5>';
                            echo '<p>'.$rew->isi.'</p>';
                            echo '</div></div>';
                        }
                        echo '</div>';
                    }
                ?>
                <form class="p-3 mb-5">
                    <textarea class="form-control" id="comment" placeholder="Tuliskan komentar..."></textarea>
                    <?php 
                        
                        $idpos = $_GET['id'];
                    ?>
                    <br>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm float-right" name="submit" onclick="<?php echo 'addKomen('.$idpos.','.$idlogin.'); refresh3()'?>">Komentar</button>
                    </div>  
                </form>
                <div id="add_komen" class="mb-3"></div>
                <div id="refresh" class="mb-3"></div>
                        </div>
                        <!-- Sidebar -->
                        <div class="col-md-3">
                                <?php
                                    echo '
                                    <div class="tentang">
                                        <div class="box-judul">Tentang Penulis</div>
                                        <div class="tentang-penulis">';  
                                            if ($foto==null){
                                                echo '<img class="img-profile rounded-circle" src="assets/images/logoakun.png">';
                                            }else{
                                                echo '<img class="img-profile rounded-circle" src="data:image/jpeg;base64,'.base64_encode($foto).'">';
                                            } 
                                        echo '<div>
                                                <h3>'.$namapenulis.'</h3>
                                                <p>'.$emailpenulis.'</p>
                                            </div>
                                        </div> 
                                    ';
                                    echo '
                                    <div class="rpost">
                                        <div class="box-judul">Post Terbaru Penulis</div>
                                    
                                        <div class="rpost-recent">';
                                            $rpost = " SELECT * FROM post WHERE idpenulis='".$idpenulis_post."' ORDER BY idpost DESC LIMIT 3";
                                            $result_rpost = $db->query($rpost);
                                            while($row_rpost = $result_rpost->fetch_object()){
                                                echo '
                                                <a class="readmore" href="detail_post.php?id='.$row_rpost->idpost.'"><b>'.$row_rpost->judul.'</b></a>
                                                <hr>';
                                            }
                                    echo '
                                        </div>
                                    </div>';
                                    
                                ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Akhir Detail Post -->
        </div>                            
    </main>


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
    <!-- Akhir Footer -->
<?php include('templates/footer.php'); ?>