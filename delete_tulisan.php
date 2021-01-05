
<?php
    require_once('db_login.php');
    $id = $db->real_escape_string($_GET['id']);

    echo '<div class="alert alert-warning alert-dismissible"><strong>Apakah kamu yakin ingin menghapus post ini?</strong>
        <br> <a class="btn btn-warning btn-sm " data-dismiss="alert" 
        >Tidak</a>
        <a class="btn btn-danger btn-sm" 
        onclick="deltul('.$id.'); redirect();">Ya</a>  
        ';
    
    
    $db->close();
?>