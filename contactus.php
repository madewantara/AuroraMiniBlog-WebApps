<?php
    session_start();
    require_once('db_login.php');

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
            $query="INSERT INTO notifikasi (nama, email, judulnotif, isinotif) VALUES ('".$name."','".$email."','".$judul."','".$pesan."')";
            $result = $db->query($query);
            if (!$result){
                die ("Could not query the database: <br />". $db->error. '<br>Query:'.$query);
            }
            else{
                $notif = 
                    '
                    <img src="checklist1.png" alt="success" style="width:10%;">
                    <br><br>
                    <span class="notif text-success">PESAN BERHASIL DIKIRIM</span><br>
                    <span class="notif text-danger">Halaman akan direfresh dalam 3 detik</span>
                    ';
                header("Refresh:3");
            }
            $db->close();
        }
    }
    
    if(isset($_SESSION['penulis'])){
        $email=$_SESSION['penulis'];
        $query_a = " SELECT * FROM penulis WHERE email='".$email."' ";
        $result_a = $db->query($query_a);
        if(!$result_a){
            die("Could not query the database: <br />". $db->error."<br>Query: ".$query_a);
        }
        while($row_a = $result_a->fetch_object()){
            $name = $row_a->nama;
            $gambar = $row_a->gambar;  
        }
    }
?>


<?php include('templates/header.php');?>
    <title>Contact-Aurora</title>
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
                                                    echo ''.$name.'';
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
        <!-- Contact Page -->
        <section class="contact-page mb-5 mt-5">
            <div id="section">
                <div class="container" id="us">
                    <div>
                        <h1 class="text-center font-weight-bold">HUBUNGI KAMI</h1>
                        <p class="mb-4 text-center">Kami hadir untuk selalu menjalin komunikasi dengan Anda</p><br>
                    </div>
                    <div class="text-center">
                        <img src="assets/images/contact.png" alt="contact">
                    </div>
                    <br><br>
                    <div>
                        <div id="ntcu" class="notif text-center"><?php if(isset($notif)) echo $notif;?></div><br>
                    </div>
                    <h4>Yuk Ngobrol!</h4>
                    <form name="formContact" method="POST" autocomplete="on" action="">
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
                        <div class="form-group">
                            <label for="pesan">Pesan</label>
                            <textarea type="text" class="form-control" id="pesan" name="pesan" placeholder="Pesan" rows="5"><?php if (isset($pesan)) echo $pesan;?></textarea>
                            <div class="error"><?php if(isset($error_pesan)) echo $error_pesan;?></div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-block btn-user" role="button" name="submit" value="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Akhir Contact Page -->
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

    <?php include('templates/footer.php'); ?>