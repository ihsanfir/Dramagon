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

$res_forum = mysqli_query($conn, "SELECT * FROM forum ORDER BY id_forum DESC LIMIT 0, 3");
$res_info = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id_informasi DESC LIMIT 0, 4")

?>


<!DOCTYPE HTML>
<html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css?v=<?= time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css?v=<?= time(); ?>" />
  </head>

<body>

  <div class="red-top"></div>
  <?php include 'sidebar.php'; ?>
    <div class="wrapper">
      <div class="container giant">
        <div class="container first">
          <header >
            <div class="redDec"></div>
            <h1>Dramagon</h1>
          </header>
          <div class="container intro bg">
           Selamat Datang di Dramagon!
          </div>
        </div>
        <!--container1-->
        
        <div class="container first">
          <header>
            <div class="redDec"></div>
            <h1>Informasi Terkini Seputar Dramaga</h1>
          </header> 

            <div class="flex-information">
              <?php while($hasil = mysqli_fetch_array($res_info)): ?>
              <div class="card">
                <div class="card-text">
                  <h2><?= $hasil["judul_informasi"]; ?></h2>
                  <h5><?= tanggal_indo($hasil["tanggal_informasi"]); ?></h5>
                  <p>
                  <?php
                    $isi = strip_tags($hasil["isi_informasi"]);
                    if (strlen($isi) > 200) {
                      // potong isi
                      $potongisi = substr($isi, 0, 200);
                      $akhir = strrpos($potongisi, ' ');

                      //
                      $isi = $akhir? substr($potongisi, 0, $akhir) : substr($potongisi, 0);
                      $isi .= ' ... <a href="info_page.php?id_informasi=' .$hasil["id_informasi"]. '">Read More</a>';
                    }
                    echo $isi;
                  ?>
                  </p>
                </div>
              </div>
              </a>
              <?php endwhile; ?>
          </div>
        </div>
        <!--container1-->

      </div>
      <!--container-->


            <div class="container-right">
              <div class="ads">
                <h2>SPACE IKLAN</h1>
              </div>

              <div class="sidebar-right">
                <header>
                  <div class="redDec"></div>
                  <h1>Forum</h1>
                </header>
                <?php while ($forum = mysqli_fetch_array($res_forum)): ?>
                  <a href="forum_thread.php?id_forum=<?= $forum["id_forum"] ?>"><?= $forum["judul"] ?></a>
                <?php endwhile; ?>
              </div>
          </div>
          <!--container-right end-->

    </div>
    <!--wrapper end-->

  <div class="red-bot"></div>

</body>
</html>
