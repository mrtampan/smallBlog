<?php
// include "koneksi.php";
$connect = file_get_contents(".env");
$dbjson = json_decode($connect);
$koneksi = mysqli_connect($dbjson->host, $dbjson->username, $dbjson->password, $dbjson->db);
// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");


// session_start();
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

$txt = "<url>
<loc>${host}/pos/" . $data['linking'] . "</loc>
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