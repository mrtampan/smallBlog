<?php 
include "../koneksi.php";

$idPost = $_GET['edit'];
$edit = mysqli_query($koneksi, "SELECT * FROM post WHERE id_post=$idPost");
while ($data = mysqli_fetch_assoc($edit)) {  
  $jsonData = array(
    "id_post" => $data['id_post'],
    "judul" => $data['judul'],
    "isi" => $data['isi'],
    "img" => $data['img'],
    "linking" => $data['linking']
  );
  
  header('Content-Type: application/json');
  echo json_encode($jsonData);

}