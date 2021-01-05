<?php
require_once('../db_login.php');

$queryResult = $db->query("SELECT * FROM kategori");
$result = array();

while ($row = mysqli_fetch_object($queryResult)) {
    $F["idkategori"] = $row->idkategori;
    $F["namakategori"] = $row->nama;
    $F["gambar"] = base64_encode($row->gambar);

    array_push($result, $F);
}

echo json_encode($result);
mysqli_close($db);
?>