<?php
    require_once('db_login.php');
    $id = $db->real_escape_string($_POST['id']);
    $lama = $db->real_escape_string($_POST['lama']);
    $baru = $db->real_escape_string($_POST['baru']);
    $baru2 = $db->real_escape_string($_POST['baru2']);

    $query = " SELECT password FROM admin WHERE idadmin='".$id."' ";
    $result = $db->query($query);
    if(!$result){
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
    }
    else{
        $row = $result->fetch_object();
        if($lama == "" || $baru == "" || $baru2 == ""){
            echo '<div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Please fill all the fields.<br>
                    </div>';
        }
        else if(md5($lama) != $row->password){
            echo '<div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Password lama anda salah.<br>
                    </div>';
        }
        else if($baru != $baru2){
            echo '<div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Konfirmasi password anda salah.<br>
                    </div>';
        }
        else{
            $query = " UPDATE admin SET password='".md5($baru)."' WHERE idadmin='".$id."' ";
            $result = $db->query($query);
            if(!$result){
                echo '<div class="alert alert-danger alert-dismissible">
                        <strong>Error!</strong> Could not query the database<br>'.$db->error. '<br>query = '.$query.'</div>';
            }
            else{
                echo '<div class="alert alert-success alert-dismissible">
                        <div class="mb-2"><strong>Success!</strong> Data has been saved.</div>
                        <button type="submit" class="btn btn-sm btn-primary">OK</button>
                    </div>';
            }
        }
    }
    $db->close();
?>