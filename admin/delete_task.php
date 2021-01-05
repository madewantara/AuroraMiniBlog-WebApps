<?php
    require_once('db_login.php');
    $id = $_GET['id'];

    $query = " DELETE FROM todo WHERE idtodo='".$id."' ";
    $result = $db->query($query);
    if(!$result){
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
    }
    else{
        echo '<div class="alert alert-success alert-dismissible">
            <strong>Success!</strong> Task has been finished.<br>
            </div>';
    }
    header("location: homeadmin.php");
    $db->close();
?>