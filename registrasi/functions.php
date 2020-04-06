<?php 

// koneksi ke database
$conn = mysqli_connect("localhost","root","","belajarphp");

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $nama = $data["nama"];
    $password = $data["password"];
    $password2 = $data["password2"];
    $no_telpon = $data["no_telpon"];

    // cek username yg sudah dipakai
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

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
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$nama','$no_telpon')");
    
    return mysqli_affected_rows($conn);
}

?>