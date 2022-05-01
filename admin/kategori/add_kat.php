<?php
$connect = file_get_contents("../../.env");
$dbjson = json_decode($connect);
$koneksi = mysqli_connect($dbjson->host, $dbjson->username, $dbjson->password, $dbjson->db);
// include "../../koneksi.php";
include "../../validate_token.php";
$nama = $_POST['nama'];

session_start();
$user = $_SESSION['username'];
$kategori = mysqli_query($koneksi, "INSERT INTO kategori (nama) VALUES ('$nama')");
$query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$user' ");

if($query && $_SESSION['status']=="login"){
    $result = array("message"=>"Berhasil Simpan Kategori", "success"=>true);
    $kategori;

    header('Content-Type: application/json');
    echo json_encode($result);
    
} else {
    $errorSql = mysqli_error($koneksi);
    $fail = array("success"=>false, "error"=>$errorSql);
    header('Content-Type: application/json');
    echo json_encode($fail);
}
?>