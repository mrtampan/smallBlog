<script>
localStorage.clear();
</script>
<?php
error_reporting(0);
session_start();
session_destroy();
echo "<script>window.location.href = baseUrl + '/'</script>";
// header("location:../");
?>
