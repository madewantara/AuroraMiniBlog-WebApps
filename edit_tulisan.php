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
        $idpost=$_GET['id']; 
        $query_post = " SELECT * FROM post WHERE idpost='".$idpost."' ";
        $result_post = $db->query($query_post);
        if(!$result_post){
            die("Could not query the database: <br />". $db->error."<br>Query: ".$query_post);
        }
        while($row_post = $result_post->fetch_object()){
            $judul=$row_post->judul;
            $idkategori=$row_post->idkategori;
            $isipost = $row_post->isi_post;
            $image = $row_post->file_gambar;
        }
        date_default_timezone_set('Asia/Jakarta');
        $timezone = date("Y-m-d");

        if(isset($_POST["submit"])){
            $valid = TRUE; //flag validasi
            $judul = test_input($_POST['judul']);
            if($judul == ''){
                $error_judul = "Tolong mengisi judul post";
                $valid = FALSE;
            }
            
            $isi = test_input($_POST['isi']);
            if($isi == ''){
                $error_isi = "Tolong mengisi isi post";
                $valid = FALSE;
            }
            $kategori = $_POST['kategori'];
            if($kategori == '' ){
                $error_kategori = "Tolong pilih kategori terlebih dahulu";
                $valid = FALSE;
            }
            if ($valid){
                if($_FILES['img']['size'] == 0){
                    $query="UPDATE post SET judul='".$judul."', isi_post='".$isi."',idkategori='".$kategori."',tgl_update='".$timezone."' WHERE idpost='".$idpost."'";
                
                    $result = $db->query($query);
                    if (!$result){
                        die ("Could not query the database: <br>".$db->error.'<br>Query:' .$query);
                    }
                    else{
                        $db->close();
                        header('Location: profile_penulis.php');
                        
                    }
                    
                }
                else{
                    $image = addslashes(file_get_contents($_FILES['img']['tmp_name']));
                    $query="UPDATE post SET judul='".$judul."', isi_post='".$isi."',idkategori='".$kategori."',tgl_update='".$timezone."',file_gambar='".$image."' WHERE idpost='".$idpost."'";
                
                    $result = $db->query($query);
                    if (!$result){
                        die ("Could not query the database: <br>".$db->error.'<br>Query:' .$query);
                    }
                    else{
                        $db->close();
                        header('Location: profile_penulis.php');
                        
                    }
                }
            
            }
        }
        
    ?>

<?php include('templates/header.php');?>
    <title>Edit Tulisan-Aurora</title>
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
        <!-- Akhir navbar -->
    </header>


    <main class="pt-5 pb-5">
        <!-- Edit Tulisan -->
        <section>
            <div class="container">
                <div class="card">
                    <div class="card-header">Edit Post</div>
                    <div class="card-body">
                        <form method="POST" autocomplete="on" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="judul">Judul:</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="<?php if (isset($judul)) echo $judul;?>">
                                <div class="error"><?php if(isset($error_judul)) echo $error_judul;?></div>
                            </div>
                            <div class="form-group">
                                <label for="isi">Isi Post:</label>
                                <textarea class="form-control" name="isi" id="isi" rows="5"><?php if (isset($isipost)) echo $isipost;?></textarea>
                                <div class="error"><?php if(isset($error_isi)) echo $error_isi;?></div>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    
                                    <?php 
                                        echo '<option value="" >--Pilih Kategori--</option>';
                                        $query="SELECT * FROM kategori";
                                        $result = $db->query($query);
                                        if (!$result){
                                            die ("Could not query the database: <br />". $db->error);
                                        }
                                        while ($row = $result->fetch_object()){
                                            $idkat = $row->idkategori;
                                            echo '<option value="'.$idkat.'"';
                                            if($idkategori==$idkat) echo 'selected';
                                            echo '>'.$row->nama.'</option>';
                                        }
                                    ?>
                                </select>
                                <div class="error"><?php if (isset($error_kategori)) echo $error_kategori;?></div>
                            </div>
                            <div class="form-group">
                                <label for="img">Gambar:</label><br>
                                <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($image).''?>" style="width: 250px;"><br><br>
                                <input type="file" id="img" name="img" accept="image/*">
                            </div>
                            
                            <br>
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                            <a href="profile_penulis.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div> 
            </div>
        </section>
    <!-- Akhir Edit Tulisan -->
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
