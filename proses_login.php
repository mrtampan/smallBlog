<?php

// Use JWT TOken
include_once 'vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once 'vendor/firebase/php-jwt/src/ExpiredException.php';
include_once 'vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once 'vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;
// end Jwt token

// $koneksi = mysqli_connect("localhost", "root", "", "small_blog");
include "koneksi.php";
if(!isset($_POST['username'], $_POST['password'])){
    $fail = array("success"=>false, "message"=>"Username dan password kosong");
    header('Content-Type: application/json');
    exit(json_encode($fail));
}

$username = $_POST['username'];
$password = $_POST['password'];
// $query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$username' and a.password = '$password' ");
// $cek = mysqli_num_rows($query);


if($stmt = $koneksi->prepare("SELECT password FROM admin a where a.username = ?")){
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($passFromDB);
        $stmt->fetch();
        
        if(password_verify($password, $passFromDB)){
            
            // set your default time-zone
            date_default_timezone_set('Asia/Jakarta');

            $key = "bakekok";
            $token = array(
                "iss" => "http://example.org",
                "aud" => "http://example.com",
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "data" => array(
                    "username" => $username,
                    "password" => $passFromDB
                )
             );

            $jwt = JWT::encode($token, $key);

            http_response_code(200);

            $result = array("username"=>$username, "status"=>"login", "success"=>true, "token"=>$jwt);
            
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";

            header('Content-Type: application/json');
            echo json_encode($result);
        }else{
            echo failed("Password Salah");
        }
    }
    
} else {
    header('Content-Type: application/json');
    echo failed("Gagal Koneksi database");
}
function failed($param) {
    $fail = array("success"=>false, "message"=>$param);
    return json_encode($fail);
}
?>