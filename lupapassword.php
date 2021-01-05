<?php
    session_start();
    require_once('db_login.php');

    if (isset($_POST["submit"])){
        $valid = TRUE;
        $email = test_input($_POST['email']);
        if ($email == ''){
            $error_email = "*Mohon isi e-mail";
            $valid = FALSE;
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error_email = "*Format e-mail salah";
            $valid = FALSE;
        }
        $password = test_input($_POST['password']);
        if ($password == ''){
            $error_password = "*Mohon isi password baru";
            $valid = FALSE;
        }
        $captcha = test_input($_POST['captcha']);
        if ($captcha == ''){
            $error_captcha = "*Mohon isi kode recovery";
            $valid = FALSE;
        }
        if ($valid){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $email = (isset($_POST['email'])) ? $_POST['email'] : "";
                $password = (isset($_POST['password'])) ? $_POST['password'] : "";
                
                $query = "UPDATE penulis SET password='".md5($password)."' WHERE email='".$email."' AND recovery='".$captcha."'";
                $result = $db->query($query);
                if (!$result){
                    die ("Could not query the database: <br />". $db->error. '<br>Query:'.$query);
                }
                else{
                    $db->close();
                    header('Location: konfirmasireset.php');
                }
            }
        }
    }
?>

<?php include('templates/header.php'); ?>
    <title>ResetPassword-Aurora</title>
</head>
<body>
    <div class="login-page">
        <div class="container">
            <div class="row justify-content-center pt-5">
                <div class="col-md-9 col-lg-12 col-xl-10">
                    <div class="card o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-flex">
                                    <div class="responsive flex-grow-1 bg-login-image" style="background-image: url(assets/images/lupapass.jpg); background-size: cover; width:100%; background-position:-190px 0px; background-repeat: no-repeat; height:auto; border-radius: 25px 0px 0px 25px;"></div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4"><b>RESET PASSWORD</b></h4>
                                        </div>
                                        <form class="form-group" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                                            <div class="form-group">
                                                <label for="captcha">Kode Recovery</label>
                                                <input class="form-control form-control-user" type="text" id="captcha" name="captcha" placeholder="Kode Recovery" value="<?php if(isset($captcha)) echo $captcha;?>">
                                                <div class="error"><?php if(isset($error_captcha)) echo $error_captcha;?></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">E-Mail</label>
                                                <input class="form-control form-control-user" type="email" id="email" name="email" aria-describedby="emailHelp" placeholder="Alamat E-Mail" value="<?php if(isset($email)) echo $email;?>">
                                                <div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password Baru</label>
                                                <input class="form-control form-control-user" type="password" id="password" name="password" placeholder="Password Baru" value="">
                                                <div class="error"><?php if(isset($error_password)) echo $error_password;?></div>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-user" role="button" name="submit" value="submit">Reset Password</button>
                                            <hr>
                                        </form>
                                        <div class="text-center"><a class="small" href="login.php">Kembali ke Halaman Login!</a></div>
                                        <div class="text-center"><a class="small" href="index.php">Kembali ke Halaman Utama!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('templates/footer.php'); ?>