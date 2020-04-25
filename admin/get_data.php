<?php 
include "../koneksi.php";
  $halaman = 10;
  $page = isset($_GET["pages"]) ? (int)$_GET["pages"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysqli_query($koneksi, "SELECT * FROM post");
  $total = mysqli_num_rows($result);
  $pages = ceil($total/$halaman);
  $prevPage = ($page<=1) ? 1 : $page-1;
  $nextPage = $page+1;            
  $query = mysqli_query($koneksi, "SELECT * FROM post ORDER BY id_post DESC LIMIT $mulai, $halaman")or die(mysqli_error);
  $jsonData['data'] = array();
  $jsonData = array("halaman" => $halaman, "page" => $page, "totalPage" => $pages, "perPost" => $total, "nextPage" => $nextPage, "prevPage" => $prevPage);
  while ($data = mysqli_fetch_assoc($query)) {
    $jsonData['data'][] = array(
        "id_post" => $data['id_post'],
        "judul" => $data['judul'],
        "isi" => $data['isi'],
        "img" => $data['img'],
        "linking" => $data['linking']
    );
  }

  header('Content-Type: application/json');
  echo json_encode($jsonData);

?>