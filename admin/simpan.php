<?php
    require_once('db_login.php');
    $nama = $db->real_escape_string($_POST['nama']);
    $email = $db->real_escape_string($_POST['email']);
    $session = $_GET['id'];

    $query = " UPDATE admin SET nama='".$nama."', email='".$email."' WHERE idadmin='".$session."' ";
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
    header("location: profile.php");
    $db->close();
?>