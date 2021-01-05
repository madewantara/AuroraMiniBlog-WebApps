<?php include('templates/header.php'); ?>
    <title>Register-Aurora</title>
</head>
<body>
    <div class="login-page">
        <div class="container pt-5">
            <div class="row justify-content-center pt-5">
                <div class="col-md-9 col-lg-12 col-xl-10">
                    <div class="card o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-2 h4"><b>REGISTRASI BERHASIL</b></h4><br>
                                        <img src="assets/images/checklist1.png" alt="checklist" style="width:20%;"><br><br><br>
                                    </div>
                                    <div class="text-center">
                                        <h5 class="h5"><b>PERHATIAN!!!</b></h6>
                                        <p>Berikut adalah recovery code untuk melakukan reset password :</p>
                                        <div id="konfirmasi"><?php echo $_GET['code'];?></div><br>
                                    </div>
                                    <div class="text-center">
                                        <a href="login.php" class="btn btn-block btn-user" role="button">OK</a>
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