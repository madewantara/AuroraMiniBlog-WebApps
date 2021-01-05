<html>
<head>
    <title>Kategori -- Admin</title>
    <meta charset="utf-8">
    <script src="ajaxcrudkat.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/crudkategori.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body > 

<?php   
    session_start();
    require_once('db_login.php');
    $email = $_SESSION['penulis'];
    $query_a = " SELECT * FROM penulis WHERE email='".$email."' ";
    $result= $db->query($query_a);
    if (!$result){
        die ("error ");
    }
    while ($row=$result->fetch_object()){
        $idpenulis = $row->idpenulis;
    }
    $result->free();
        ?>
        
    <div class="card">
        <div class="card-header">Data Tulisan</div>
        <div class="card-body">
            <br>
            <a type="button" class="btn btn-primary" href="tambah_tulisan.php?id=<?php echo $idpenulis ?>" >Buat tulisan baru +</a><br><br><br>
                        
            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal dibuat</th>
                    <th>Pembaruan terakhir</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php
                
                    $query= "SELECT * FROM post  WHERE idpenulis=".$idpenulis." ORDER BY judul";
                    $result = $db->query($query);
                    if (!$result){
                        die ("Could not query the database: <br/>".$db->error."<br>Query: ".$query);
                    }

                    $i = 1;
                    while ($row = $result->fetch_object()){
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$row->judul.'</td>';
                        $query="SELECT nama FROM kategori WHERE idkategori='".$row->idkategori."'";
                        $hasil = $db->query($query);
                        $raw = $hasil ->fetch_object();
                        echo '<td>'.$raw->nama.'</td>';
                        $hasil ->free();
                        echo '<td>'.$row->tgl_insert.'</td>';
                        echo '<td>'.$row->tgl_update.'</td>';
                        echo '<td style="object-fit:cover; max-width:150px;"><img src=data:image/jpeg;base64,".base64_encode('.$row->file_gambar.')."></td>';
                        echo '<td><a type="button" class="btn btn-warning btn-sm " href="edit_tulisan.php?id='
                        .$row->idpost.'">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteTulisan('
                            .$row->idpost.')">Delete</button>
                            </td>';
                        echo "</tr>";
                        
                        $i++;
                    }

                    echo '</table>';
                    echo '<br/>';
                    
                    $result->free();
                    $db->close();

                    ?>
                    <br>
                    </table>
                    <div id="delete_response"> </div>
                        
                   
                    <div id="refresh" ></div>
            </div>
        </div>


<script src="ajaxcrudkat.js"></script>
</body>
</html>
