<?php
// include "koneksi.php";
$connect = file_get_contents(".env");
$dbjson = json_decode($connect);
$koneksi = mysqli_connect($dbjson->host, $dbjson->username, $dbjson->password, $dbjson->db);
include "validate_token.php";
// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");
$idPost = $_POST['id_post'];
$linking = $_POST['linking'];

session_start();
$user = $_SESSION['username'];
$delete = mysqli_query($koneksi, "DELETE FROM post WHERE id_post=$idPost");
$query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$user' ");

if($query && $_SESSION['status']=="login"){
    $result = array("message"=>"Berhasil menghapus postingan", "success"=>true);
    $delete;
    $statusQuery = $delete;
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