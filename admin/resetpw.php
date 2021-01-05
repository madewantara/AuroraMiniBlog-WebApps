<?php
    require_once('db_login.php');
    $id = $db->real_escape_string($_GET['id']);
    $default= "admin";
    
    $query = "UPDATE penulis SET password ='".md5($default)."' WHERE idpenulis ='".$id."'";
    $result = $db->query($query);
    
    if (!$result){
        
        echo '<div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Could
        not query the database <br>'.$db->error.'<br>query= '.$query.'</div>';
    }
    else {
        echo '<div class="alert alert-success alert-dismissible"><strong>Password telah berhasil di reset!</strong>
        <br> 
        </div>
        ';
    }
    
    
    $db->close();
?>