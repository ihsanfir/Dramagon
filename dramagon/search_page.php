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

if (isset($_GET["cari"])) {
  $cari = $_GET["keyword"];
  $info_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, informasi.id_informasi, informasi.id_pengguna, informasi.judul_informasi, informasi.tanggal_informasi, informasi.isi_informasi FROM informasi INNER JOIN pengguna ON pengguna.id_pengguna = informasi.id_pengguna WHERE judul_informasi LIKE '%" .$cari. "' OR isi_informasi LIKE '%" .$cari. "%'");
  $forum_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_forum, forum.id_pengguna, forum.judul, forum.isi, forum.kategori, forum.tanggal FROM forum INNER JOIN pengguna ON pengguna.id_pengguna = forum.id_pengguna WHERE judul LIKE '%" .$cari. "%' OR isi LIKE '%" .$cari. "%'");
} else {
  $info_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, informasi.id_informasi, informasi.id_pengguna, informasi.judul_informasi, informasi.tanggal_informasi, informasi.isi_informasi FROM informasi INNER JOIN pengguna ON pengguna.id_pengguna = informasi.id_pengguna WHERE 1 != 1");
  $forum_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_forum, forum.id_pengguna, forum.judul, forum.isi, forum.kategori, forum.tanggal FROM forum INNER JOIN pengguna ON pengguna.id_pengguna = forum.id_pengguna WHERE 1 != 1");
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
            <div class="redDec"></div>
            <h1>Hasil Pencarian Informasi</h1>
          </header>

          <?php if(mysqli_num_rows($info_list)) : ?>
          <div class="container list">
            <ul class="listView">
            <?php while($hasil_info = mysqli_fetch_array($info_list)) : ?>
              <li class="item" >
                <a href="info_page.php?id_informasi=<?= $hasil_info["id_informasi"]; ?>">
                  <div class="title">
                    <h1><?= $hasil_info["judul_informasi"];?></h1>
                  </div>

                  <div class="item-stat">
                    <div class="details">
                        <img src="..\img\user.jpg">
                      <div class="name-date">
                        <h1><?= $hasil_info["username"]; ?></h1>
                        <br>
                        <h2><?= $hasil_info["tanggal_informasi"]; ?></h2>
                      </div>
                    </div>
                  </div>  
                </a>
              </li>
          <?php endwhile; ?>
            </ul>
        </div>
          <?php else:?>
          <br>
          <h1><strong>Pencarian tidak ada!</strong></h1>
          <?php endif; ?>
        <!--container list end-->
      </div>

          <div class="container first">
            <header>
              <div class="redDec"></div>
              <h1>Hasil Pencarian Forum</h1>
            </header>

          <?php if(mysqli_num_rows($forum_list)) : ?>
          <div class="container list">
            <ul class="listView">
              <?php while($hasil_forum = mysqli_fetch_array($forum_list)) : ?>
              <li class="item" >
                <a href="forum_thread.php?id_forum=<?= $hasil_forum["id_forum"]; ?>">
                  <div class="title">
                    <h1><?= $hasil_forum["judul"]; ?></h1>
                  </div>

                  <div class="item-stat">
                    
                    <div class="like">
                      <img src="..\img\like.png">
                      <?php
                      $forums = $hasil_forum["id_forum"];
                      $res_suka = mysqli_query($conn, "SELECT id_suka FROM suka WHERE forums = $forums") or die(mysqli_error());
                      $hasil_suka = mysqli_num_rows($res_suka);
                      ?>
                      <h1><?= $hasil_suka; ?></h1>
                    </div>
      
                    <div class="comment-count">
                      <img src="..\img\reply.png">
                      <?php
                        $id_forum = $hasil_forum["id_forum"]; 
                        $query_komentar = mysqli_query($conn, "SELECT * FROM komentar WHERE id_forum = $id_forum");
                        $jml_komentar = mysqli_num_rows($query_komentar);
                      ?>
                      <h1><?= $jml_komentar; ?></h1>
                    </div>
                
                    <div class="details">
                      <?php 
                        if ($hasil_forum["gambar"] != NULL) {
                         echo '<img src="data:image/jpeg;base64,'.base64_encode( $hasil_forum['gambar'] ).'"/>'; 
                        } else {
                          echo '<img src="..\img\user.jpg">';
                        }
                      ?>
                      <div class="name-date">
                        <h1><?= $hasil_forum["username"]; ?></h1>
                        <br>
                        <h2><?= tanggal_indo($hasil_forum["tanggal"]); ?></h2>
                      </div>
                    </div>

                  </div>  
                </a>
              </li>
              <?php endwhile; ?>      
            </ul>
          </div>

          <?php else:?>
          <br>
          <h1><strong>Pencarian tidak ada!</strong></h1>
          <?php endif; ?>

        <!--container list end-->
      </div>
      <!--container1 end-->

      </div>
      <!--container giant-->
        <div class="container-right">
            <div class="ads">
              <h2>SPACE IKLAN</h2>
            </div>
            <header>
              <div class="redDec"></div>
              <h1>Ingin Buat Thread?</h1>
            </header>
           
            <a href="buat_forum.php">
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