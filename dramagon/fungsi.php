<?php 

// koneksi ke database
$conn = mysqli_connect("localhost","root","","dramagon");

function daftar($data) {
    global $conn;

    $username = stripslashes($data["uname"]);
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
    mysqli_query($conn, "INSERT INTO pengguna VALUES('','$username','$password', '','$email','','','')");
    
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

function edit($data) {
    global $conn;

    $id = $data["id"];
    $username = stripslashes($data["username"]);
    $nama = $data["nama"];
    $email = $data["email"];
    $telpon = $data["notelp"];
    $jenkel = $data["jk"];
    $tanggalLahir = $data["tl"]; 

    // cek username yg sudah dipakai
    $result = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");
    $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");
    $pengguna = mysqli_fetch_array($query);

    if ( $username == $pengguna["username"] ) {
        $cek = 1;
    }

    if( !mysqli_fetch_assoc($result) && $cek!=1) {
        echo "<script>
                alert('username sudah dipakai!')
            </script>";
        return false;
    }


    // update pengguna ke database
    mysqli_query($conn, "UPDATE pengguna SET
            username = '$username',
            nama = '$nama',
            email = '$email',
            telpon = '$telpon',
            jenkel = '$jenkel',
            tanggalLahir = '$tanggalLahir'
        WHERE id = $id");
    
    return 1;
}

?>