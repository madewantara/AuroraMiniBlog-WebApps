<?php
    require_once('db_login.php');
    $id = $_GET['id'];
    $image = addslashes(file_get_contents($_FILES['img']['tmp_name']));

    $query = " UPDATE admin SET gambar='".$image."' WHERE idadmin='".$id."' ";
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