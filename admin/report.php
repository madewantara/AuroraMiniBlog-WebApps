<?php
	require_once('db_login.php');
	$query_b = " SELECT COUNT(idkategori) as jumlah FROM kategori ";
	$query_c = " SELECT COUNT(idpenulis) as jumlah FROM penulis ";
	$query_d = " SELECT COUNT(idpost) as jumlah FROM post ";
	$result_b = $db->query($query_b);
	$result_c = $db->query($query_c);
	$result_d = $db->query($query_d);
	if(!$result_b){
		die("Could not query the database: <br />". $db->error."<br>Query: ".$query_b);
	}
	if(!$result_c){
		die("Could not query the database: <br />". $db->error."<br>Query: ".$query_c);
	}
	if(!$result_d){
		die("Could not query the database: <br />". $db->error."<br>Query: ".$query_d);
	}
	
	$row_b = $result_b->fetch_object();
	$jml_kategori = $row_b->jumlah;
	$row_c = $result_c->fetch_object();
	$jml_penulis = $row_c->jumlah;
	$row_d = $result_d->fetch_object();
	$jml_post = $row_d->jumlah;
    header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Blog.xls");
?>
<!DOCTYPE html>
<html lang="en">

<head>
</head>
<body>
    <h2>GO-BLOG<br/>Data Report</h2>
	<table>
		<tr>
			<th colspan="2">Database</th>
		</tr>
		<tr>
			<th>Data</th>
			<th>Jumlah</th>
		</tr>
		<?php
			echo '<tr>
					<td>Kategori</td>
					<td>'.$jml_kategori.'</td>
				</tr>
				<tr>
					<td>Penulis</td>
					<td>'.$jml_penulis.'</td>
				</tr>
				<tr>
					<td>Post</td>
					<td>'.$jml_post.'</td>
				</tr>'
		?>
	</table>
	<br/>
	<table>
		<tr>
			<th colspan="2">Post Per Kategori</th>
		</tr>
		<tr>
			<th>Kategori</th>
			<th>Jumlah Post</th>
		</tr>
		<?php
			$data = " SELECT kategori.nama as nama, COUNT(post.idpost) as jumlah FROM kategori INNER JOIN post ON kategori.idkategori = post.idkategori ";
			$result = $db->query($data);
			if(!$result){
				die("Could not query the database: <br />". $db->error."<br>Query: ".$data);
			}
			while($row = $result->fetch_object()){
				echo '<tr>
						<td>'.$row->nama.'</td>
						<td>'.$row->jumlah.'</td>
					</tr>';
			}
		?>
    </table>
</body>
</html>