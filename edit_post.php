<?php
include "koneksi.php";
include "validate_token.php";
// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$gambar = $_POST['gambar'];
$linking = $_POST['linking'];
$idPost = $_POST['idPost'];
$idKategori = $_POST['id_kategori'];
$isidb = mysqli_real_escape_string($koneksi, $_POST['isi']);

session_start();
$user = $_SESSION['username'];
$posting = mysqli_query($koneksi, "UPDATE post SET judul='$judul', isi = '$isidb', img='$gambar', id_kategori='$idKategori' where id_post=$idPost ");
$query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$user' ");

if($query && $_SESSION['status']=="login"){
    $result = array("message"=>"Berhasil Mengubah Postingan", "success"=>true);
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