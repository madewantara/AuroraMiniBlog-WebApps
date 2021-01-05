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
        }
    }

    $search = $_POST['search'];
?>
<?php include('templates/header.php');?>
<title>Aurora</title>
</head>
<body>
<header>
    <!-- Navbar -->
    <nav class="navbar nav-design navbar-expand-lg navbar-dark pt-3 pb-3">
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
        <section class="mt-5">
            <div class="container">
                <h2 class="kategori-name">Hasil Pencarian</h2>
            </div>
        </section>
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row justify-content-center">
                <?php
                    $recent=$db->query('SELECT post.idpost,post.judul,SUBSTRING(post.isi_post,1,350) as isipost, post.file_gambar, post.tgl_insert, penulis.nama as namapenulis FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis WHERE post.judul LIKE "%'.$search.'%" ORDER BY idpost DESC');
                    while($row = $recent->fetch_object()){
                        echo '
                        <div class="col-md-8 mt-3 mb-3">
                            <div class="card card-design">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="slide-img">
                                            <img src="data:image/jpeg;base64,'.base64_encode($row->file_gambar).'" class="img-fluid" alt="..." style="height:350px;">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h2 class="card-title mb-1 ">'.$row->judul.'</h2>
                                            <p>'.$row->isipost.'...</p>
                                            <div class="row">
                                                <div class="col-md-8">                   
                                                    <small>Dipost pada : '.$row->tgl_insert.'<br>Penulis : '.$row->namapenulis.'</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="detail_post.php?id='.$row->idpost.'" class="read-btn">Baca</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                ?>
                </div>
            </div>
        </section>
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
    <!-- Akhir Footer  -->
<?php include('templates/footer.php');?>