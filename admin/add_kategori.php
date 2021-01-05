<?php
    require_once('db_login.php');
    $name = $db->real_escape_string($_GET['name']);

    $query = "INSERT INTO kategori (nama) VALUES ('".$name."')";
    $result = $db->query($query);
    
    if (!$result){
        
        echo '<div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Could
        not query the database <br>'.$db->error.'<br>query= '.$query.'</div>';
    }
    else {
        echo '<div class="alert alert-success alert-dismissible"><strong>Success!</strong>
        Data has been added.<br> 
        
        </div>
        ';
    }
    $db->close();
?>