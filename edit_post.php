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

session_start();
$user = $_SESSION['username'];
$posting = mysqli_query($koneksi, "UPDATE post SET judul='$judul', isi = '$isi', img='$gambar', id_kategori='$idKategori' where id_post=$idPost ");
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

        unlink($linking . ".html");
        $tailwind = "<link rel='stylesheet'
        href='codesnip.css'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link href='https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css' rel='stylesheet'>";
        $head = file_get_contents("head.php");
        $myfile = fopen($linking . ".html", "w") or die("Unable to open file!");
        $txt = $tailwind;
        fwrite($myfile, $txt);
        $txt = "<body class='bg-gray-300'>";
        fwrite($myfile, $txt);
        $txt = $head;
        fwrite($myfile, $txt);
        $txt = "<div class='container mx-auto bg-gray-100 rounded p-4 h-auto'><h1 class='my-3 text-3xl font-bold'>" . $judul . "</h1><div class='clear-both'></div>";
        fwrite($myfile, $txt);
        $txt = "<div class='flex justify-center mb-3'><img class='object-contain h-48 w-full' src='" . $gambar . "' alt='" . $judul . "' /></div><div class='clear-both'></div>";
        fwrite($myfile, $txt);
        $txt = $isi . "</div></body>";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    
} else {
    $errorSql = mysqli_error($koneksi);
    $fail = array("success"=>false, "error"=>$errorSql);
    header('Content-Type: application/json');
    echo json_encode($fail);
}
?>