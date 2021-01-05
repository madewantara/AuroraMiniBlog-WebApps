<?php
require_once('../db_login.php');

$queryResult = $db->query("SELECT post.idpost,post.judul,post.isi_post,post.file_gambar, post.tgl_insert,post.idkategori, penulis.nama as namapenulis, kategori.nama as namakategori FROM post JOIN penulis ON post.idpenulis=penulis.idpenulis JOIN kategori ON post.idkategori=kategori.idkategori ORDER BY idpost DESC LIMIT 6");
$result = array();

while ($row = mysqli_fetch_object($queryResult)) {
    $F["id"] = $row->idpost;
    $F["judul"] = $row->judul;
    $F["penulis"] = $row->namapenulis;
    $F["isi"] = $row->isi_post;
    $F["tgl"] = $row->tgl_insert;
    $F["idkategori"] = $row->idkategori;
    $F["namakategori"] = $row->namakategori;
    $F['gambar'] = base64_encode($row->file_gambar);

    array_push($result, $F);
}

echo json_encode($result);
mysqli_close($db);
?>