<?php 

// koneksi ke database


//**************************start koneksi ***************************//

//ntar ini sesuain yak
$server="localhost";
$user="root";
$pass="";
$database="dramagon";

//koneksikan ke server
$conect=mysqli_connect($server,$user,$pass,$database) or die('Error Connection Network');

// **************************end koneksi *********************************//

$hostname="http://localhost/dramagon";

?>
