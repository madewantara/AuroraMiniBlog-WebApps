<?php
    require_once('db_login.php');
    $id = $_GET['id'];
    $nama = $db->real_escape_string($_POST['name']);
    $query = "UPDATE kategori SET nama ='".$nama."' WHERE idkategori ='".$id."'";
    $result = $db->query($query);
    if (!$result){
        
        echo '<div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Could
        not query the database <br>'.$db->error.'<br>query= '.$query.'</div>';
    }
    else {
        echo '<div class="alert alert-success alert-dismissible"><strong>Success!</strong>
        Data has been edited.<br> 
        </div>
        ';
    }
    header("location: crudkategori.php");
    $db->close();
?>