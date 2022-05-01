<?php 
error_reporting();
$connect = file_get_contents("../.env");
$dbjson = json_decode($connect);
$koneksi = mysqli_connect($dbjson->host, $dbjson->username, $dbjson->password, $dbjson->db);
// include "../koneksi.php";
  $halaman = 9;
  $page = isset($_GET["pages"]) ? (int)$_GET["pages"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = "";
  if(isset($_GET['search'])){
    $search = $_GET["search"];
    $result = mysqli_query($koneksi, "SELECT a.id_post, a.judul, a.isi, a.img, a.linking, b.nama AS namaKategori FROM post a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori WHERE judul LIKE '%$search%' OR b.nama LIKE '%$search%' ");
  }else {
    $result = mysqli_query($koneksi, "SELECT * FROM post ");
  }
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);
  $prevPage = ($page<=1) ? 1 : $page-1;
  $nextPage = $page+1;
  $query = "";
  if(isset($_GET["search"])){
    $search = $_GET["search"];
    $query = mysqli_query($koneksi, "SELECT a.id_post, a.judul, a.isi, a.img, a.linking, b.nama AS namaKategori FROM post a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori WHERE judul LIKE '%$search%' OR b.nama LIKE '%$search%' ORDER BY id_post DESC LIMIT $mulai, $halaman");
    // $query = mysqli_query($koneksi, "SELECT * FROM post WHERE judul LIKE '%$search%' ORDER BY id_post DESC LIMIT $mulai, $halaman");
  } else{
    $query = mysqli_query($koneksi, "SELECT a.id_post, a.judul, a.isi, a.img, a.linking, b.nama AS namaKategori FROM post a LEFT JOIN kategori b ON a.id_kategori = b.id_kategori ORDER BY id_post DESC LIMIT $mulai, $halaman");
  }           
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