
<?php
    require_once('db_login.php');
    $id = $db->real_escape_string($_GET['id']);

    echo '<div class="alert alert-warning alert-dismissible"><strong>Apakah kamu yakin ingin menghapus kategori tersebut?</strong>
        <br> <button class="btn btn-warning  btn-sm " data-dismiss="alert"  
        >Tidak</button>
        <a class="btn btn-danger btn-sm text-white" 
        onclick="delkat('.$id.'); refresh();">Ya</a>  
        ';
    
    $db->close();
?>