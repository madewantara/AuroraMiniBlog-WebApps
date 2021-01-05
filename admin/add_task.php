<?php
    require_once('db_login.php');
    $tugas = $db->real_escape_string($_POST['tugas']);
    $deadline = $db->real_escape_string($_POST['deadline']);
    $idadmin = ($_GET['id']);

    $query = " INSERT INTO todo (tugas, deadline, idadmin) VALUES('".$tugas."','".$deadline."','".$idadmin."') ";
    $result = $db->query($query);
    if(!$result){
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
    }
    else{
        echo '<div class="alert alert-success alert-dismissible">
            <strong>Success!</strong> Task has been added.<br>
            </div>';
    }
    header("location: homeadmin.php");
    $db->close();
?>