<?php
$connect = file_get_contents(".env");
$dbjson = json_decode($connect);
$koneksi = mysqli_connect($dbjson->host, $dbjson->username, $dbjson->password, $dbjson->db);
// include "koneksi.php";
include "validate_token.php";
// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$gambar = $_POST['gambar'];
$idKategori = $_POST['id_kategori'];
$linking = $_POST['linking'];
$isidb = mysqli_real_escape_string($koneksi, $_POST['isi']);
$datePost = date("Y-m-d H:i:s");

session_start();
$user = $_SESSION['username'];
$posting = mysqli_query($koneksi, "INSERT INTO post (judul, isi, img, linking, id_kategori, create_date) VALUES ('$judul', '$isidb', '$gambar', '$linking', '$idKategori', '$datePost')");
$query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$user' ");

if($query && $_SESSION['status']=="login"){
    $result = array("message"=>"Berhasil Simpan Postingan", "success"=>true);
    $posting;
    $statusQuery = $posting;
    if(!$statusQuery){
        $rest = array("message"=>"Gagal", "success"=>false);
        echo json_encode($rest);
    }else {
        header('Content-Type: application/json');
        echo json_encode($result);

    }
    
} else {
    $errorSql = mysqli_error($koneksi);
    $fail = array("success"=>false, "error"=>$errorSql);
    header('Content-Type: application/json');
    echo json_encode($fail);
}
?>