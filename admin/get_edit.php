<?php 
include "../koneksi.php";

$idPost = $_GET['edit'];
$edit = mysqli_query($koneksi, "SELECT a.id_post, a.judul, a.isi, a.img, a.linking, b.id_kategori FROM post a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori WHERE a.id_post=$idPost");
while ($data = mysqli_fetch_assoc($edit)) {  
  $jsonData = array(
    "id_post" => $data['id_post'],
    "judul" => $data['judul'],
    "isi" => $data['isi'],
    "img" => $data['img'],
    "linking" => $data['linking'],
    "id_kategori" => $data['id_kategori']
  );
  
  header('Content-Type: application/json');
  echo json_encode($jsonData);

}