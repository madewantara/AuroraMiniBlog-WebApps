<?php
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

        $password = test_input($_POST['password']);
        if ($password == ''){
            $error_password = "*Password wajib diisi";
            $valid = FALSE;
        }

        $address = test_input($_POST['address']);
        if ($address == ''){
            $error_address = "*Alamat wajib diisi";
            $valid = FALSE;
        }

        $city = $_POST['city'];
        if ($city == '' || $city == 'none'){
            $error_city = "*Kota/Kabupaten wajib diisi";
            $valid = FALSE;
        }

        $email = test_input($_POST['email']);
        if ($email == ''){
            $error_email = "*E-mail wajib diisi";
            $valid = FALSE;
        }

        $telp = test_input($_POST['telp']);
        if ($telp == ''){
            $error_telp = "*Nomor telepon wajib diisi";
            $valid = FALSE;
        }
        elseif (!preg_match("/^[0-9]*$/", $telp)){
            $error_telp = "*Isi dengan angka";
            $valid = FALSE;
        }

        $captcha = $_GET['code'];

        if ($valid){
            $address = $db->real_escape_string($address);
            $query="INSERT INTO penulis (nama,password,alamat,kota,email,no_telp,recovery) VALUES ('".$name."','".md5($password)."','".$address."','".$city."','".$email."','".$telp."','".$captcha."')";
            $result = $db->query($query);
            if (!$result){
                die ("Could not query the database: <br />". $db->error. '<br>Query:'.$query);
            }
            else{
                header("Location:konfirmasiakun.php?code= $captcha");
                $db->close();
            }
        }
    }
?>

<?php include('templates/header.php'); ?>
    <title>Register-Aurora</title>
</head>
<body>
    <?php
        require_once('db_login.php');
        $query = "SELECT * FROM kota";
        $result = $db->query($query);
    ?>
    <div class="register-page">  
        <div class="container py-5">
            <div class="card o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4"><b>REGISTRASI PENULIS</b></h4>
                                </div>
                                <form name="formRegistrasi" method="POST" autocomplete="on" action="">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control form-control-user" type="text" id="name" placeholder="Nama Lengkap" name="name" value="<?php if (isset($name)) echo $name;?>">
                                        <div class="error"><?php if(isset($error_name)) echo $error_name;?></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="email">E-Mail</label>
                                            <input class="form-control form-control-user" type="email" id="email" aria-describedby="emailHelp" placeholder="Alamat E-Mail" name="email" value="<?php if (isset($email)) echo $email;?>">
                                            <div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="password">Password</label>
                                            <input class="form-control form-control-user" type="password" id="password" placeholder="Password" name="password" value="<?php if (isset($password)) echo $password;?>">
                                            <div class="error"><?php if(isset($error_password)) echo $error_password;?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control form-control-user" name="address" id="address" placeholder="Alamat" rows="5"><?php if (isset($address)) echo $address;?></textarea>
                                        <div class="error"><?php if(isset($error_address)) echo $error_address;?></div>
                                    </div>
                                    <div class="form-group form-control-user">
                                        <label for="city">Kota/Kabupaten</label>
                                        <select name="city" id="city" class="form-control form-control-user" onchange="other()" required >
                                            <option value="none" <?php if (isset($city)) echo 'selected="true"';?>>--Kota/Kabupaten--</option>
                                            <?php while($row = $result->fetch_object()){ ?>
                                                <option> <?php echo $row->namakota?> </option>';
                                            <?php } ?>
                                            <option value="other" <?php if (isset($city) && $city == "") echo 'selected="true"';?>>Other : </option>
                                        </select>
                                        <div class="error"><?php if(isset($error_city)) echo $error_city;?></div>
                                    </div>
                                    <div class="form-group" id="other" name="other"></div>
                                    <div class="form-group form-control-user">
                                        <label for="telp">Nomor Telepon</label>
                                        <input class="form-control form-control-user" type="text" id="telp" placeholder="Nomor Telepon" name="telp" value="<?php if (isset($telp)) echo $telp;?>">
                                        <div class="error"><?php if(isset($error_telp)) echo $error_telp;?></div>
                                    </div>
                                    <div></div>
                                    <button type="submit" class="btn" name="submit" value="submit">Daftar Akun</button>
                                    <a href="login.php" class="btn">Cancel</a> 
                                    <hr>
                                </form>
                                <div class="text-center"><a class="small" href="login.php">Sudah Memiliki Akun? Login!</a></div>
                                <div class="text-center"><a class="small" href="index.php">Kembali ke Halaman Utama!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('templates/footer.php'); ?>
<?php $db->close();?>