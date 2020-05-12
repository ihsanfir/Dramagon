<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

echo "<script>alert('Anda berhasil keluar!');</script>";
header("Location: masuk.php");

?>