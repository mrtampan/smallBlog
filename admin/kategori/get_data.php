<?php 

$connect = file_get_contents("../../.env");
$dbjson = json_decode($connect);
$koneksi = mysqli_connect($dbjson->host, $dbjson->username, $dbjson->password, $dbjson->db);
// include "../../koneksi.php";
  $halaman = 10;
  $page = isset($_GET["pages"]) ? (int)$_GET["pages"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($koneksi, "SELECT * FROM kategori");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);
  $prevPage = ($page<=1) ? 1 : $page-1;
  $nextPage = $page+1;
  $query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC LIMIT $mulai, $halaman");
  $jsonData['data'] = array();
  $jsonData = array("halaman" => $halaman, "page" => $page, "totalPage" => $pages, "perPost" => $total, "nextPage" => $nextPage, "prevPage" => $prevPage);
  while ($data = mysqli_fetch_assoc($query)) {
    $jsonData['data'][] = array(
        "id_kategori" => $data['id_kategori'],
        "nama" => $data['nama'],
    );
  }

  header('Content-Type: application/json');
  echo json_encode($jsonData);

?>