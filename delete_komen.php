<?php 
    require_once('db_login.php');
    $idkomentar = $_GET['idkom'];
    $idpost = $_GET['idpost'];
    $query ="DELETE FROM komentar WHERE idkomentar='".$idkomentar."'";
    $result = $db->query($query);
    if (!$result){
        echo '<div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Could
        not query the database <br>'.$db->error.'<br>query= '.$quereh.'</div>';
    }
    


?>