<?php
include "koneksi.php";
// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");


session_start();
$query = mysqli_query($koneksi, "SELECT * FROM post ");
$host = $_SERVER['SERVER_NAME'];

$result = array("message"=>"Berhasil Generate Sitemap", "success"=>true);
$sitemap = fopen("sitemap.xml", "w") or die("Unable to open file!");
$txt = "<?xml version='1.0' encoding='UTF-8'?>
<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>";
fwrite($sitemap, $txt);
$txt = "<url>
<loc>${host}</loc>
<lastmod>" . (new DateTime(date('Y-m-d H:i:s')))->format('c') . "</lastmod>
<priority>1.0</priority>
</url>";
fwrite($sitemap, $txt);
while ($data = mysqli_fetch_assoc($query)) {

    //   $jsonData['data'][] = array(
//       "id_post" => $data['id_post'],
//       "judul" => $data['judul'],
//       "isi" => $data['isi'],
//       "img" => $data['img'],
//       "linking" => $data['linking'],
//       "kategori" => $data['namaKategori']
//   );

$txt = "<url>
<loc>${host}/" . $data['linking'] . ".html</loc>
<lastmod>" . (new DateTime($data['create_date']))->format('c') . "</lastmod>
<priority>1.0</priority>
</url>";
fwrite($sitemap, $txt);

}
$txt = "</urlset>";
fwrite($sitemap, $txt);
fclose($sitemap);

header('Content-Type: application/json');
echo json_encode($result);

?>