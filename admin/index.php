<html>
<head>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
Admin Small Blog
</title>
</head>
<body>
<script src="../global.js"></script>
<script>
let checkSign = '';

checkSign = localStorage.getItem("token");
if(checkSign == '' || checkSign == null || checkSign == undefined) {
	window.location.href = baseUrl + '/'
}
</script>
<?php 
// session_start();
// 	if($_SESSION['status']!="login"){
// 	 echo "<script>window.location.href = baseUrl + '/'</script>";
// 	}
?>
<?php
include "head.php";
?>
<?php
include "routing.php";
?>
</body>
</html>