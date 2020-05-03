<?php
include "../../koneksi.php";
include "../../validate_token.php";
// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");
$idKategori = $_POST['id_kategori'];

session_start();
$user = $_SESSION['username'];
$delete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori=$idKategori");
$query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$user' ");

if($query && $_SESSION['status']=="login"){
    $result = array("message"=>"Berhasil menghapus postingan", "success"=>true);
    $delete;
    header('Content-Type: application/json');
    echo json_encode($result);
    
} else {
    $errorSql = mysqli_error($koneksi);
    $fail = array("success"=>false, "error"=>$errorSql);
    header('Content-Type: application/json');
    echo json_encode($fail);
}
?>