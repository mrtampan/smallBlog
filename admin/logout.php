<script>
localStorage.clear();
</script>
<?php
session_start();
session_destroy();
header("location:../");
?>
