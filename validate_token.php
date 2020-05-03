<?php
// Use JWT TOken
include "koneksi.php";
include_once 'vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once 'vendor/firebase/php-jwt/src/ExpiredException.php';
include_once 'vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once 'vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;
// end Jwt token

$jwt = isset($_POST['token']) ? $_POST['token'] : "";

if($jwt){
    try{
        $key = "bakekok";
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        http_response_code(200);

        $dataUser = $decoded->data->username;
        $dataPass = $decoded->data->password;

        $query = mysqli_query($koneksi, "SELECT * FROM admin a where a.username = '$dataUser' and a.password = '$dataPass' ");
        $cek = mysqli_num_rows($query);
        
        if($cek < 0){
            $fail = array("success"=>false, "message"=>"Akses ditolak");
            exit($fail);
        }
        // echo json_encode(array(
        //     "message" => "Access dibolehkan",
        //     "data" => $decoded->data
        // ));
    }catch(Exception $e){
        header('Content-Type: application/json');
        $fail = array("success"=>false, "error"=>$e->getMessage(), "message"=>"Akses ditolak");
        exit(json_encode($fail));
    }
}else{
    $fail = array("success"=>false, "message"=>"Akses ditolak");
    exit(json_encode($fail));
}
?>