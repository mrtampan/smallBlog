<?php 
error_reporting();
include "../koneksi.php";
  $halaman = 10;
  $page = isset($_GET["pages"]) ? (int)$_GET["pages"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $kat = $_GET['kategori'];
  $result = mysqli_query($koneksi, "SELECT a.id_post, a.judul, a.isi, a.img, a.linking, b.nama AS namaKategori FROM post a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori WHERE b.nama = '$kat'  ORDER BY id_post DESC");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);
  $prevPage = ($page<=1) ? 1 : $page-1;
  $nextPage = $page+1;
  $query = "";
  $query = mysqli_query($koneksi, "SELECT a.id_post, a.judul, a.isi, a.img, a.linking, b.nama AS namaKategori FROM post a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori WHERE b.nama = '$kat' ORDER BY id_post DESC");           
  $jsonData['data'] = array();
  $jsonData = array("halaman" => $halaman, "page" => $page, "totalPage" => $pages, "perPost" => $total, "nextPage" => $nextPage, "prevPage" => $prevPage);
  while ($data = mysqli_fetch_assoc($query)) {
    $jsonData['data'][] = array(
        "id_post" => $data['id_post'],
        "judul" => $data['judul'],
        "isi" => $data['isi'],
        "img" => $data['img'],
        "linking" => $data['linking'],
        "kategori" => $data['namaKategori']
    );
  }

  header('Content-Type: application/json');
  echo json_encode($jsonData);

?>