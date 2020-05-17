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

$jumlahDataPerHalaman = 6;
$res = mysqli_query($conn, "SELECT * FROM informasi WHERE status = 'disetujui'");
$jumlahData = mysqli_num_rows($res);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["page"])) ? $_GET["page"] : 1;
$mulai = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$info_list = mysqli_query($conn, "SELECT * FROM informasi WHERE status = 'disetujui' ORDER BY id_informasi DESC LIMIT $mulai, $jumlahDataPerHalaman");

?>

<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/style.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css?v=<?php echo time(); ?>" />

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
            <div class="redDec"></div>
            <h1>Informasi Terkini Seputar Dramaga</h1>
          </header>
         
          <!--container1-->

          <div class="container first">

            <?php while($hasil = mysqli_fetch_array($info_list)): ?>
            <div class="card-info">
              <div class="listinfo">
              <a href="info_page.php?id_informasi=<?= $hasil["id_informasi"]; ?>">
                  <div class="card-text">
                    <h2><?= $hasil["judul_informasi"]; ?></h2>
                    <h5><?= tanggal_indo($hasil["tanggal_informasi"]); ?></h5>
                      <p>
                        <?php
                        $isi = strip_tags($hasil["isi_informasi"]);
                        if (strlen($isi) > 500) {
                          // potong isi
                          $potongisi = substr($isi, 0, 500);
                          $akhir = strrpos($potongisi, ' ');

                          //
                          $isi = $akhir? substr($potongisi, 0, $akhir) : substr($potongisi, 0);
                          $isi .= ' ...';
                        }
                        echo $isi;
                        ?>
                      </p>
                  </div>
              </div>
              <br>
              <a href="info_page.php?id_informasi=<?= $hasil["id_informasi"]; ?>">Read more</a>
            </div>
            <?php endwhile; ?>
            
          </div>
        </div>
        <!--container1-->
        
        <!---pagination-->
        <div class="container pagi">
          <div class="pagination">
            <?php if( $halamanAktif > 1 ): ?>
              <a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
            <?php endif; ?>

            <?php for($i=1; $i<=$jumlahHalaman; $i++) : ?>
              <?php if ($i == $halamanAktif) : ?>
                <a class="active" href="?page=<?= $i; ?>"><?= $i; ?></a>
              <?php else : ?>
               <a href="?page=<?= $i; ?>"><?= $i; ?></a>
              <?php endif; ?>
            <?php endfor; ?>
            
            <?php if( $halamanAktif < $jumlahHalaman ): ?>
              <a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
            <?php endif; ?>
          </div>
        </div>


      </div>
      <!--container-->
      <div class="container-right">
        <div class="ads">
          <h2>SPACE IKLAN</h2>
        </div>

        <header>
          <div class="redDec"></div>
          <h1>Ingin Buat Informasi?</h1>
        </header>

        <a href="buat_info.php">
          <button>
              buat sekarang!
          </button>
        </a>

      </div>
      <!--container-right end-->


    </div>
    <!--wrapper end-->

  <div class="red-bot"></div>

</body>
</html>