<?php 

// koneksi ke database


//**************************start koneksi ***************************//

//set koneksi ke server sesuai host, user, password dan database
$server="localhost";
$user="root";
$pass="";
$database="belajarphp";

//koneksikan ke server
$conect=mysqli_connect($server,$user,$pass,$database) or die('Error Connection Network');

// **************************end koneksi *********************************//

//*********************pengaturan lainnya*****************************//

//buat parameter untuk mempercepat penulisan url misal https://www.dramagons.com atau http://localhost/folderweb
$hostname="http://localhost/belajarphp";


function registrasi($data) {
    global $conect;

    $username = strtolower(stripslashes($data["username"]));
    $nama = $data["nama"];
    $password = $data["password"];
    $password2 = $data["password2"];
    $no_telpon = $data["no_telpon"];

    // cek username yg sudah dipakai
    $result =mysqli_query($conect, "SELECT * FROM user WHERE username='$username'")or die(mysqli_error());

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah dipakai!')
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    // enkripsi password
    $password = md5($password);

    // tambahkan userbaru ke database
    mysqli_query($conect, "INSERT INTO user VALUES('','$username','$password','$nama','$no_telpon')");
    
    return mysqli_affected_rows($conect);
}

?>
