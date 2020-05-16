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
$id_informasi = $_GET["id_informasi"];
$query = mysqli_query($conn, "SELECT * FROM informasi INNER JOIN pengguna WHERE id_informasi = $id_informasi");
$res = mysqli_fetch_array($query);

?>
<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/style.css?v=<?= time();?>" />
  <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css?v=<?= time();?>" />

  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
  <link rel="manifest" href="/favicon/site.webmanifest">
</head>

<body>

  <div class="red-top"></div>
    <?php include 'sidebar.php'; ?>
    <!-- sidebar-wrapper  -->
    <div class="wrapper">
      <div class="container giant">
        <div class="container first">
          <header >
            <div class="redDec"></div>
            <h1>INFORMASI</h1>
          </header>

          <div class="container first">
            <div class="laman-info">
              <div class="laman-text">
              <center><h1><?= $res["judul_informasi"]; ?></h1></center>
                <br>
                <h3>By <?= $res["nama"]; ?></h3>
                <h3>Published On : <?= tanggal_indo($res["tanggal_informasi"]); ?></h3>
                <center>
                <?php 
                  if($res["gambar_informasi"] != NULL) {
                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $res['gambar_informasi'] ).'" width="750px" height="auto"/>'; 
                  }
                ?>
                </center>
                <br>
                <p align="justify"><?= $res["isi_informasi"]; ?></p>
              </div>
            </form>
            </div>
          </div>
        </div>
        <!--container1-->
      </div>
      <!--container-->
        <div class="container-right">
          <div class="ads">
            <h2>SPACE IKLAN</h2>
           </div>
        </div>
          <!--container-right end-->
    </div>
    <!--wrapper end-->
       
  <div class="red-bot"></div>

</body>
</html>