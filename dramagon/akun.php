<?php 
require 'fungsi.php';
global $conn;
session_start();
$uname = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");
$pengguna = mysqli_fetch_array($query);

if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

if( isset($_POST["simpan"])) {
    if(edit($_POST) > 0 ) {
        $_SESSION["username"] = $_POST["username"];
        echo"<script>
                alert('Perubahan berhasil disimpan')
                window.location.replace('akun.php');
            </script>";
        exit;
    } else {
      echo"<script>
                alert('Tidak ada perubahan')
                window.location.replace('akun.php');
            </script>";
    }
}

if (isset($_POST["Hapus"])) {
  if(hapusFoto($_POST) > 0) {
    header("Location: akun.php");
  }
}

if ( isset($_POST["Upload"]) ) {

  $file = $_FILES['image']['tmp_name'];
  if (!isset($file) ){
    $notif =  "Pilih file gambar";
  }

  else {
      $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $image_name = addslashes($_FILES['image']['name']);
      $image_size = getimagesize($_FILES['image']['tmp_name']);
      $id_pengguna = $pengguna["id_pengguna"];

      if ($image_size == false) {
        $notif =  "File yang dipilih bukan gambar";
      } else {
          if (!$insert = mysqli_query($conn, "UPDATE pengguna SET
                  gambar = '$image'
                  WHERE id_pengguna = $id_pengguna")) {
                    $notif =  "Gagal upload gambar";
                  } else {
                    header("Location: akun.php");
                    $notif =  "gambar berhasil di upload";
                  }
      }
  }
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/style.css?v=<?= time(); ?>" />
  <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css?v=<?= time(); ?>" />

  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
  <link rel="manifest" href="/favicon/site.webmanifest">
</head>

<body>

  <div class="red-top"></div>
  
  <?php include 'sidebar.php'; ?>

    <div class="wrapper">
      <div class="container giant">
        <div class="container first">
          <header >
            <h1>Akun Magons</h1>
          </header>
          <div class="container bg">
            <div class="container fotoAkun">
                <form action="" method="post" enctype="multipart/form-data">
                  <?php 
                    if ($pengguna["gambar"] != NULL) {
                      echo '<img class="foto" src="data:image/jpeg;base64,'.base64_encode( $pengguna['gambar'] ).'"/>'; 
                    } else {
                      echo '<img class="foto" src="..\img\user.jpg"/>';
                    }
                  ?>
                  <input type="hidden" name="id_pengguna" value="<?= $pengguna["id_pengguna"]; ?>">
                  <input type="file" name="image" required>
                  <button type="submit" name="Upload">
                    Ubah Foto Akun
                  </button>
                  <br><br>
                </form>
                <form action="" method="post">
                  <input type="hidden" name="id_pengguna" value="<?= $pengguna["id_pengguna"]; ?>">
                  <button type="submit" name="Hapus">
                      Hapus Foto Akun
                  </button>
                </form>
                <br>
                <h1><strong>
                <?php
                  if( isset($notif)) {
                    echo $notif;
                    $notif = "";
                  }
                ?>
                </strong></h1>
            </div>
        <div class="container form">
              <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Dramagon.<br>
                    Isi data akun Magons kamu dibawah ya!</h1>
              </div>
            <form action ="" method="post">
                <input type="hidden" name="id_pengguna" value="<?= $pengguna["id_pengguna"]; ?>">
                <input type="hidden" name="username_lama" value="<?= $pengguna["username"]; ?>">

                <label for="username">Username Magons</label><br>
                <input type="text" id="username" name="username" value="<?= $pengguna["username"]; ?>">
                
                <label for="nama">Nama</label><br>
                <input type="text" id="nama" name="nama" value="<?= $pengguna["nama"]; ?>">

                <label for="email">Email</label><br>
                <input type="text" id="email" name="email" value="<?= $pengguna["email"]; ?>">

                <label for="notelp">Nomor Telpon</label><br>
                <input type="text" id="notelp" name="notelp" value="<?= $pengguna["telpon"]; ?>">
                
                <h1>Jenis Kelamin</h1>
                <input type="radio" id="laki" name="jk" value="laki" <?php 
                if ( $pengguna["jenkel"]=="" ) {
                  echo "checked";
                }
                else if($pengguna["jenkel"]=='laki') {echo "checked"; }?> >
                <label for="male">Laki-laki</label>
                <input type="radio" id="perempuan" name="jk" value="perempuan" <?php if($pengguna["jenkel"]=='perempuan') {echo "checked"; }?> >
                <label for="perempuan">Perempuan</label><br>

                <label for="tl">Tanggal Lahir:</label>
                <input type="date" id="tl" name="tl" value="<?= $pengguna["tanggalLahir"]; ?>">
   
                <button type="submit" class="registerbtn" name="simpan">Simpan</button>
    

            </form>
            <br>
            <h1>Ingin ubah password? <a href="gantipass.php">Klik Disini!</a></h1> 
             
            </div>

          </div>
        </div>
        <!--container1-->
        
        

      </div>
      <!--container-->
            <div class="container-right">
            </div>
          <!--container-right end-->

    </div>
    <!--wrapper end-->
       
        </div>
        <!--main end-->
     
      </div>
      <!--body end-->

  
  </div>

  <div class="red-bot"></div>

</body>
</html>