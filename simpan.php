<?php
    require_once('db_login.php');
    $nama = $db->real_escape_string($_POST['nama']);
    $alamat = $db->real_escape_string($_POST['alamat']);
    $kota = $db->real_escape_string($_POST['kota']);
    $email = $db->real_escape_string($_POST['email']);
    $telp = $db->real_escape_string($_POST['no_telp']);
    $password = $db->real_escape_string($_POST['password']);
    $session = $_GET['id'];

    $query = " UPDATE penulis SET nama='".$nama."', email='".$email."', password='".md5($password)."', alamat='".$alamat."',kota='".$kota."',no_telp='".$telp."' WHERE idpenulis='".$session."' ";
    $result = $db->query($query);
    if(!$result){
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
    }
    else{
        echo '<div class="alert alert-success alert-dismissible">
            <strong>Success!</strong> Data has been saved.<br>
            </div>';
    }
    header("location: profile_penulis.php");
    $db->close();
?>