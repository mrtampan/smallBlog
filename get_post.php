<?php 
include "koneksi.php";

$linkingName = $_GET['linking'];
$onePost = mysqli_query($koneksi, "SELECT a.id_post, a.judul, a.isi, a.img, a.linking, b.id_kategori FROM post a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori WHERE a.linking=$linkingName");
while ($data = mysqli_fetch_assoc($onePost)) {  
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