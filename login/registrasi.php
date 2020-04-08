<?php
require 'functions.php';

if( isset($_POST["daftar"])) {
    if(registrasi($_POST) > 0 ) {
        echo"<script>
                alert('user baru berhasil ditambahkan!');
            </script>";
    }
    else {
        echo mysqli_error($conect);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Registrasi</title>
    <style>
        label{
            display: block;
        }
    </style>
</head>
<body>

<h1>Halaman Registrasi</h1>
    
<form action="" method="post">
<ul>    
    <li>
        <label for="username">Username :</label>
        <input type="text" name="username" id="username">        
    </li>
    <li>
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama">
    </li>
    <li>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password">
    </li>
    <li>
        <label for="password2">Konfirmasi Password :</label>
        <input type="password" name="password2" id="password2">
    </li>
    <li>
        <label for="no_telpon">No.Telpon :</label>
        <input type="text" name="no_telpon" id="no_telpon">
    </li>
    <li>
        <button type="submit" name="daftar">Daftar</button>
    </li>
</ul>
</form>

</body>
</html>
