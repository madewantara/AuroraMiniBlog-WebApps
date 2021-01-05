<?php
    require_once("db_login.php");
    $idpost = $_GET['post'];
    $idpenulis = $_GET['penulis'];
    date_default_timezone_set('Asia/Jakarta');
    $tgl_update = date("Y-m-d H:i:s"); 
    $isipost = $_GET['isi'];
    
    $quereh= "INSERT INTO komentar (idpost,idpenulis,isi,tgl_update) VALUES ('".$idpost."','".$idpenulis."','".$isipost."','".$tgl_update."')";
    $gege = $db->query($quereh);
    if (!$gege) {
        echo '<div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Could
        not query the database <br>'.$db->error.'<br>query= '.$quereh.'</div>';
    }



?>