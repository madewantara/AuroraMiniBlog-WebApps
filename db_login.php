<?php
    $db_host='sql307.epizy.com';
    $db_database='epiz_27043269_db_blog';
    $db_username='epiz_27043269';
    $db_password='miniblogaurora';

    $db = new mysqli($db_host, $db_username, $db_password, $db_database);
    if ($db->connect_error){
        die ("Could not connect to the database: <br />. $db->connect_error");
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>