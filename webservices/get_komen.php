<?php
require_once('../db_login.php');

$queryResult = $db->query("SELECT * FROM komentar");
$result = array();

while ($row = mysqli_fetch_object($queryResult)) {
    $F["id"] = $row->idpost;
    $F["idkomentar"] = $row->idkomentar;
    $F["komentar"] = $row->isi;
    array_push($result, $F);
}

echo json_encode($result);
mysqli_close($db);
?>