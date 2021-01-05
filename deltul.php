<?php
    require_once('db_login.php');
    $id = $db->real_escape_string($_GET['id']);

    
    $query = "DELETE FROM post WHERE idpost='".$id."'";
    $result = $db->query($query);
    
    if (!$result){
        
        echo '<div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Could
        not query the database <br>'.$db->error.'<br>query= '.$query.'</div>';
    }
    else {
        echo '<div class="alert alert-success alert-dismissible"><strong>Success!</strong>
        Data has been deleted.<br>
        </div>
        ';
        echo '<script>refresh();</script>';
        
    }
    
    
    $db->close();
?>