<?php
    require_once('db_login.php');
    $id = $db->real_escape_string($_GET['id']);
    $query = "SELECT * FROM penulis WHERE idpenulis='".$id."'";
    $result = $db->query($query);
    if (!$result){
        die ("Could not query the database: <br/>".$db->error."<br>Query: ".$query);
    }

                   
    while ($row = $result->fetch_object()){
        echo '<div class="alert alert-warning alert-dismissible"><strong>Apakah kamu yakin ingin mereset password milik '.$row->nama.'?</strong>
            <br> <a class="btn btn-warning btn-sm" 
            href="editpenulis.php">Tidak</a>
            <a class="btn btn-danger text-white btn-sm" 
            onclick="reset('.$id.')">Ya</a>  
            ';
    }
    $db->close();
?>