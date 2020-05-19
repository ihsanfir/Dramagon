<?php
require 'fungsi.php';

session_start();
$uname = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");
$pengguna = mysqli_fetch_array($query);

if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

if( isset($_POST["kirim"]) ) {
    if( buatInformasi($_POST) > 0) {
      echo "<script>alert('Informasi sedang dalam moderasi!');</script>";
    }

    $error = true;
}

?>

<!DOCTYPE HTML>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/style.css?v=<?= time(); ?>"/>
  <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css?v=<?= time(); ?>"/>

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
            <h1>Buat Informasi</h1>
          </header>
          <div class="container bg">

            <form class="threadCreate" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id_pengguna" value="<?= $pengguna["id_pengguna"]?>">
                <input type="text" name="judul_info" placeholder="Isi judul berita disini..." required>
                <br>
                <textarea id="styled" name="isi_info" placeholder="Isi detail berita disini..." required></textarea>
                
              <div class="flex">
                <div class="bungkus-button">
                    <div class="add-photo">
                      <img src="..\img\add-image.png"/>
                        <input type="file" name="image"/>
                    </div>
                </div>

                <div class="bungkus-button kirim">
                      <button type="submit" name="kirim">
                        Buat Informasi
                      </button>
                </div>
              </div>
            </div>
          <!--container bg end-->
        </div>
        <!--container1-->
      </form>
      </div>
      <!--container-->
        <div class="container-right">
        </div>
          <!--container-right end-->
    </div>
    <!--wrapper end-->
  <div class="red-bot"></div>
</body>
</html>