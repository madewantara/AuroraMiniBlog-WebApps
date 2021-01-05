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
        $idpenulis=$row_a->idpenulis;
        $name = $row_a->nama;
        $alamat = $row_a->alamat;
        $kota = $row_a->kota;
        $telp = $row_a->no_telp;
        $gambar = $row_a->gambar;  
    }
}?>
<?php include('templates/header.php');?>
    <title>Aurora</title>
</head>
<body>
    <header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark pt-3 pb-3">
        <div class="container">
                <?php
                    if(!isset($_SESSION['penulis'])){
                        echo '<a class="navbar-brand" href="index.php"><img src="assets/images/logo.png"></a>
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
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
                                            $nama=$db->query('SELECT * FROM kategori');
                                            while($row = $nama->fetch_object()){
                                                echo '<a class="dropdown-item" href="detailkategori.php?id='.$row->idkategori.'">'.$row->nama.'</a>';
                                            }
                        echo                '</div>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-item nav-link" href="#formContact">KONTAK</a>
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
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';                                     
                                            $nama=$db->query('SELECT * FROM kategori');
                                            while($row = $nama->fetch_object()){
                                                echo '<a class="dropdown-item" href="detailkategori.php?id='.$row->idkategori.'">'.$row->nama.'</a>'; 
                                            }                                                                    
                        echo            '</div>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-item nav-link" href="#formContact">KONTAK</a>
                                    </li>
                                    <li class="nav-item dropdown no-arrow active">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase;">
                                            <span class="d-none d-lg-inline">';
                                            echo $name;
                                            
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

    <!-- Carousel -->
    <div class="carousel-header">
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/carousel1.jpg" class="d-block w-100" alt="carousel">
                    <div class="carousel-caption text-dark">
                        <h3 class="text-white"><b>INSPIRASI</b></h3>
                        <p class="text-white">Lingkungan dan suasana yang nyaman merupakan salah satu hal penting dalam menemukan inspirasi</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/carousel2.jpg" class="d-block w-100" alt="carousel">
                    <div class="carousel-caption text-dark">
                        <h3 class="text-white"><b>MENCOBA</b></h3>
                        <p class="text-white">COBA MENULIS!!! Kita tidak akan pernah tau kemampuan kita sebelum mencoba.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/carousel3.jpg" class="d-block w-100" alt="carousel">
                    <div class="carousel-caption text-dark">
                        <h3 class="text-white"><b>BATASAN</b></h3>
                        <p class="text-white">Tidak ada kata terlalu tua atau terlalu muda untuk mulai menulis</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- Akhir Carousel -->
    </header>

    <main>
        <!-- Recent post -->
        <section class=" recent-post pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h2 class="mb-3 kategori-name">Post Terbaru</h2>
                    </div>
                    <div class="col-12">
                        <div id="carouselExampleIndicators2" class="carousel slide carousel-multi-item mb-3" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <?php
                                            $recent=$db->query('SELECT post.idpost,post.judul,SUBSTRING(post.isi_post,1,60) as isipost, post.file_gambar, post.tgl_insert, penulis.nama as namapenulis FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis ORDER BY idpost DESC LIMIT 2');
                                            $i=0;
                                            while($row = $recent->fetch_object()){
                                                echo '<div class="col-md-6 mb-3">';
                                                echo '<div class="card">';
                                                echo '<div class="slide-img">
                                                <img src="data:image/jpeg;base64,'.base64_encode($row->file_gambar).'" class="card-img-top img-fluid" alt="...">
                                                </div>';
                                                echo '<div class="card-body">
                                                    <h5 class="card-title mb-1">'.$row->judul.'</h5>
                                                    <p>'.$row->isipost.'...</p>
                                                    <div class="row">
                                                        <div class="col-md-8">                   
                                                            <small>Dipost pada : '.$row->tgl_insert.'<br>Penulis : '.$row->namapenulis.'</small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="detail_post.php?id='.$row->idpost.'" class="read-btn">Baca</a>
                                                        </div>
                                                    </div>
                                                    </div>';
                                                echo '</div>';
                                                echo '</div>';
                                                $i=$row->idpost;
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php
                                            $recent=$db->query('SELECT post.idpost,post.judul,SUBSTRING(post.isi_post,1,60) as isipost, post.file_gambar, post.tgl_insert, penulis.nama as namapenulis FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis WHERE idpost<'.$i.' ORDER BY idpost DESC LIMIT 2');
                                            while($row = $recent->fetch_object()){
                                                echo '<div class="col-md-6 mb-3">';
                                                echo '<div class="card">';
                                                echo '<div class="slide-img">
                                                <img src="data:image/jpeg;base64,'.base64_encode($row->file_gambar).'" class="card-img-top img-fluid" alt="...">
                                                </div>';
                                                echo '<div class="card-body">
                                                    <h5 class="card-title mb-1">'.$row->judul.'</h5>
                                                    <p>'.$row->isipost.'...</p>
                                                    <div class="row">
                                                        <div class="col-md-8">                   
                                                            <small>Dipost pada : '.$row->tgl_insert.'<br>Penulis : '.$row->namapenulis.'</small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="detail_post.php?id='.$row->idpost.'" class="read-btn">Baca</a>
                                                        </div>
                                                    </div>
                                                    </div>';
                                                echo '</div>';
                                                echo '</div>';
                                                $i=$row->idpost;
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php
                                            $recent=$db->query('SELECT post.idpost,post.judul,SUBSTRING(post.isi_post,1,60) as isipost, post.file_gambar, post.tgl_insert, penulis.nama as namapenulis FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis WHERE idpost<'.$i.' ORDER BY idpost DESC LIMIT 2');
                                            while($row = $recent->fetch_object()){
                                                echo '<div class="col-md-6 mb-3">';
                                                echo '<div class="card">';
                                                echo '<div class="slide-img">
                                                <img src="data:image/jpeg;base64,'.base64_encode($row->file_gambar).'" class="card-img-top img-fluid" alt="...">
                                                </div>';
                                                echo '<div class="card-body">
                                                    <h5 class="card-title mb-1">'.$row->judul.'</h5>
                                                    <p>'.$row->isipost.'...</p>
                                                    <div class="row">
                                                        <div class="col-md-8">                   
                                                            <small>Dipost pada : '.$row->tgl_insert.'<br>Penulis : '.$row->namapenulis.'</small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="detail_post.php?id='.$row->idpost.'" class="read-btn">Baca</a>
                                                        </div>
                                                    </div>
                                                    </div>';
                                                echo '</div>';
                                                echo '</div>';
                                                $i=$row->idpost;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <a class="mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev"><img class="slide-btn" src="assets/images/arrow-leftblk.png" alt="kiri" srcset="" style="width:40px;"></a>
                        <a class="mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next"><img class="slide-btn" src="assets/images/arrow-rightblk.png" alt="kanan" srcset="" style="width:40px;"></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of recent post -->
    
    <!-- Kategori -->
    <section class="kategori">
        <div class="container pb-5">
        <h1 class="text-center" style="color:white; padding:40px;">Kategori</h1>
            <div class="row no-gutters text-white pb-5">
                <?php
                $query_kategori = " SELECT * FROM kategori ";
                $result = $db->query($query_kategori);
                if(!$result){
                    die("Could not query the database: <br />". $db->error."<br>Query: ".$query_kategori);
                }
                while($row = $result->fetch_object()){
                    echo '<div class="col-lg-4 text-center">
                            <a class="box text-white" href="detailkategori.php?id='.$row->idkategori.'">
                            <div class="caption-content">
                                <h2>'.$row->nama.'</h2>
                            </div>
                            <img class="img-fluid image" src="data:image/jpeg;base64,'.base64_encode($row->gambar).'">
                            <div class="overlay"></div>
                            </a>
                        </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Akhir Kategori -->

    <!-- post/kategori -->
    <section class=" category-post pt-5 pb-5">
        <div class="container">
            <?php
            $kategori=$db->query('SELECT * FROM post GROUP BY idkategori');
            while($row = $kategori->fetch_object()){
                $idkategori = $row->idkategori;
                $nama=$db->query('SELECT nama FROM kategori WHERE idkategori='.$idkategori.'')->fetch_object()->nama;
                echo '<div class="row">';
                echo '<div class="col-md-6">
                        <h2 class="kategori-name">Kategori '.$nama.'</h2>
                    </div>
                    <div class="col-md-6 pt-2">
                        <a class="seemore" href="detailkategori.php?id='.$idkategori.'" >Lihat Semua</a>
                    </div>';
                $recent=$db->query('SELECT post.idpost,post.judul,SUBSTRING(post.isi_post,1,60) as isipost, post.file_gambar, post.tgl_insert, penulis.nama as namapenulis FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis WHERE idkategori='.$row->idkategori.' ORDER BY idpost DESC LIMIT 3');
                while($row = $recent->fetch_object()){
                    echo '<div class="col-md-4 mt-3 mb-3">';
                    echo '<div class="card card-design">';
                    echo '<div class="slide-img">
                    <img src="data:image/jpeg;base64,'.base64_encode($row->file_gambar).'" class="card-img-top img-fluid" alt="..." style="height:200px;">
                    </div>';
                    
                    echo '<div class="card-body">
                        <h5 class="card-title mb-1 ">'.$row->judul.'</h5>
                        <p>'.$row->isipost.'...</p>
                        <div class="row">
                            <div class="col-md-8">                   
                                <small>Dipost pada : '.$row->tgl_insert.'<br>Penulis : '.$row->namapenulis.'</small>
                            </div>
                            <div class="col-md-4">
                                <a href="detail_post.php?id='.$row->idpost.'" class="read-btn">Baca</a>
                            </div>
                        </div>
                        </div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </section>
    </main>
    <!-- akhir post kategori -->
    <!-- footer -->
    <?php
        if (isset($_POST['submit'])) {
            $valid = TRUE;
            $name = test_input($_POST['name']);
            if ($name == ''){
                $error_name = "*Nama wajib diisi";
                $valid = FALSE;
            }
            elseif (!preg_match("/^[a-zA-Z ]*$/", $name)){
                $error_name = "*Isi dengan huruf dan spasi";
                $valid = FALSE;
            }

            $email = test_input($_POST['email']);
            if ($email == ''){
                $error_email = "*E-mail wajib diisi";
                $valid = FALSE;
            }

            $judul = test_input($_POST['judul']);
            if ($judul == ''){
                $error_judul = "*Judul wajib diisi";
                $valid = FALSE;
            }

            $pesan = test_input($_POST['pesan']);
            if ($pesan == ''){
                $error_pesan = "*Pesan wajib diisi";
                $valid = FALSE;
            }

            if ($valid){
                $name = $db->real_escape_string($name);
                $email = $db->real_escape_string($email);
                $judul = $db->real_escape_string($judul);
                $pesan = $db->real_escape_string($pesan);
                $query="INSERT INTO notifikasi (email, judulnotif, isinotif) VALUES ('".$email."','".$judul."','".$pesan."')";
                $result = $db->query($query);
                if (!$result){
                    die ("Could not query the database: <br />". $db->error. '<br>Query:'.$query);
                }
                else{
                    echo '<script>refresh();</script>';
                }
                $db->close();
                unset($name);
                unset($email);
                unset($judul);
                unset($pesan);
            }
        }
    ?>
    <footer class="page-footer">
        <div class="container pt-3">
            <div class="row">
                <div class="col-3">
                    <h5 class="font-weight-bold text-uppercase mt-3 mb-4 post-name">Tentang Kami</h5>
                    <p class="text-white">Aurora adalah sebuah platform yang menerima tulisan seorang penulis yang ingin menuangkan ide berupa tulisan dalam sebuah karya</p>
                    <!-- <ul class="list-unstyled">
                        <li>
                            <a href="#">Link 1</a>
                        </li>
                        <li>
                            <a href="#">Link 2</a>
                        </li>
                        <li>
                            <a href="#">Link 3</a>
                        </li>
                        <li>
                            <a href="#">Link 4</a>
                        </li>
                    </ul> -->
                </div>
                <div class="col-md-1"></div>
                <div class="col-8">
                    <form id="formContact" name="formContact" method="POST" autocomplete="on" action="">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="font-weight-bold text-uppercase mt-3 mb-4 post-name">Kontak</h5>
                                <div class="form-group">
                                    <label for="name">Nama</label> 
                                    <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama" value="<?php if (isset($name)) echo $name;?>">
                                    <div class="error"><?php if(isset($error_name)) echo $error_name;?></div>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail" value="<?php if (isset($email)) echo $email;?>">
                                    <div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
                                </div>
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="<?php if (isset($judul)) echo $judul;?>">
                                    <div class="error"><?php if(isset($error_judul)) echo $error_judul;?></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <br><br>
                                <div class="form-group pt-3">
                                    <label for="pesan">Pesan</label>
                                    <textarea type="text" class="form-control" id="pesan" name="pesan" placeholder="Pesan" rows="5"><?php if (isset($pesan)) echo $pesan;?></textarea>
                                    <div class="error"><?php if(isset($error_pesan)) echo $error_pesan;?></div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-light" name="submit" value="submit" style="color:#ffb223; font-weight:500; border-radius:50px; padding:6px 15px">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center py-3" >© 2020 Copyright:
            <a href="index.php">Aurora</a>
        </div>
    </footer>
    <!-- akhir footer -->
<?php include('templates/footer.php'); ?>