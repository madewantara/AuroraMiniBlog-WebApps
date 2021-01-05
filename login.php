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
            $error_password = "*Mohon isi password";
            $valid = FALSE;
        }
        if ($valid){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $email = (isset($_POST['email'])) ? $_POST['email'] : "";
                $password = (isset($_POST['password'])) ? $_POST['password'] : "";
                
                $query_a = "SELECT * FROM admin WHERE email='".$email."' AND password='".md5($password)."'" ;
                $result_a = $db->query($query_a);
                $query_p = "SELECT * FROM penulis WHERE email='".$email."' AND password='".md5($password)."'";
                $result_p = $db->query($query_p);
                if (!$result_a || !$result_p){
                    die ("Could not query the database: <br />". $db->error);
                }
                else{
                    if ($result_a->num_rows > 0){
                        $row = $result_a->fetch_object();
                        $_SESSION['admin'] = $email;
                        header("location: admin/homeadmin.php");
                    }
                    else if ($result_p->num_rows > 0){
                        $row = $result_p->fetch_object();
                        $_SESSION['penulis'] = $email;
                        header("location:index.php");
                    }
                    else{
                        $error = '<span class="error">E-Mail dan Password Tidak Sesuai</span>';
                    }
                }
                $db->close();
            }
        }
    }

    $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
    function generate_string($input, $strength = 5) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
    }
    $captcha_string = generate_string($permitted_chars, 5);
?>

<?php include('templates/header.php'); ?>
    <title>Login-Aurora</title>
</head>
<body>
    <section class="login-page">
        <div class="container">
            <div class="row justify-content-center box-login">
                <div class="col-md-9 col-lg-12 col-xl-10">
                    <div class="card o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-flex">
                                    <div class="responsive flex-grow-1 bg-login-image" style="background-image: url(assets/images/login.jpg); width:100%; background-position:-100px 0px; background-repeat: no-repeat; height:auto; border-radius: 25px 0px 0px 25px; object-fit: cover;"></div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h4 class="text-dark mb-4 h4"><b>LOGIN</b></h4>
                                        </div>
                                        <form class="form-group" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                                            <div class="form-group">
                                                <label for="email">E-Mail</label>
                                                <input class="form-control form-control-user" type="email" id="email" name="email" aria-describedby="emailHelp" placeholder="Alamat E-Mail" value="<?php if(isset($email)) echo $email;?>">
                                                <div class="error"><?php if(isset($error_email)) echo $error_email;?></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input class="form-control form-control-user" type="password" id="password" name="password" placeholder="Password" value="">
                                                <div class="error"><?php if(isset($error_password)) echo $error_password;?></div>
                                            </div>
                                            <div class="error text-center"><?php if(isset($error)) echo $error;?></div><br>
                                            <button type="submit" class="btn btn-block btn-user" role="button" name="submit" value="submit">Login</button>
                                            <hr>
                                        </form>
                                        <div class="text-center"><a class="small" href="lupapassword.php">Lupa Password?</a></div>
                                        <div class="text-center"><a class="small" href="register.php?code=<?php echo $captcha_string?>">Buat Akun!</a></div>
                                        <div class="text-center"><a class="small" href="index.php">Kembali ke Halaman Utama!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include('templates/footer.php'); ?>