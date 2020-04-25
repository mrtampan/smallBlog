<?php

// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");
include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$username' and a.password = '$password' ");
$cek = mysqli_num_rows($query);


if($query && $cek > 0){
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    $result = array("username"=>$username, "status"=>"login", "success"=>true);
    
    header('Content-Type: application/json');
    echo json_encode($result);
    
} else {
    $fail = array("success"=>false);
    header('Content-Type: application/json');
    echo json_encode($fail);
}
?>