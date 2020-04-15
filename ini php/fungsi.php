<?php 

// koneksi ke database
$conn = mysqli_connect("localhost","root","","dramagon");

function daftar($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = $data["password"];
    $k_password = $data["k_password"];
    $email = $data["email"];

    // cek username yg sudah dipakai
    $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('username sudah dipakai!')
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $k_password) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
              </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO pengguna VALUES('','$username','$password', '$email')");
    
    return mysqli_affected_rows($conn);
}

function masuk($data) {
    global $conn;

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");

    // cek username
    if ( mysqli_num_rows($result) === 1 ) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"]) ) {
            return 1;
        }
    }
}
?>