<?php 
$connect = file_get_contents("../.env");
$dbjson = json_decode($connect);
$koneksi = mysqli_connect($dbjson->host, $dbjson->username, $dbjson->password, $dbjson->db);
// include "../koneksi.php";
  $query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
  $jsonData['data'] = array();
  while ($data = mysqli_fetch_assoc($query)) {
    $jsonData['data'][] = array(
        "id_kategori" => $data['id_kategori'],
        "nama" => $data['nama'],
    );
  }

  header('Content-Type: application/json');
  echo json_encode($jsonData);

?>