<?php
    require_once('db_login.php');
    $id = $db->real_escape_string($_POST['id']);

    $query = " SELECT idnotif,nama,email,judulnotif as judul,isinotif as isi FROM notifikasi WHERE idnotif=".$id." ";
    $result = $db->query($query);
    if(!$result){
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
    }
    else{
        while($row = $result->fetch_object()){
            echo    '<div class="text-left">
                        <div class="container">
                            <h3><b>'.$row->judul.'</b></h3>
                            <h6>'.$row->nama.' &lt;'.$row->email.'&gt;</h6>
                        </div>
                        <hr>
                        <div class="container">
                            <p>'.$row->isi.'</p>
                        </div>
                    </div>';
        }
    }
    $db->close();
?>