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

if (isset($_POST["cari"])) {
  $cari = $_POST["keyword"];
  if ($cari == NULL) {
    $forum_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_pengguna, forum.id_forum, forum.isi, forum.kategori, forum.tanggal, forum.judul, forum.suka FROM pengguna INNER JOIN forum ON pengguna.id_pengguna=forum.id_pengguna WHERE 1 != 1");
  } else {
    $forum_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_pengguna, forum.id_forum, forum.isi, forum.kategori, forum.tanggal, forum.judul, forum.suka FROM pengguna INNER JOIN forum ON pengguna.id_pengguna=forum.id_pengguna WHERE isi LIKE '%" .$cari. "%'");
  }
} else {
  $forum_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_pengguna, forum.id_forum, forum.isi, forum.kategori, forum.tanggal, forum.judul, forum.suka FROM pengguna INNER JOIN forum ON pengguna.id_pengguna=forum.id_pengguna WHERE 1 != 1");
}

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
            <h1>Hasil Pencarian</h1>
          </header>

          <div class="container intro bg">
              <div class="text">
                <h2><strong>Halo Magons!</strong>
                    <br>Ini hasil pencarian mu!</h2>
              </div>
           </div>

          <!--container intro bg end--->

          <?php if(mysqli_num_rows($forum_list)) : ?>
          <div class="container list">
            <ul class="listView">
              <?php while($hasil = mysqli_fetch_array($forum_list)) : ?>
              <li class="item" >
                <a href="forum_thread.php?id_forum=<?= $hasil["id_forum"]; ?>">
                  <div class="title">
                    <h1><?= $hasil["judul"]; ?></h1>
                  </div>

                  <div class="item-stat">
                    
                    <div class="like">
                      <img src="..\img\like.png">
                      <h1><?= $hasil["suka"]; ?></h1>
                    </div>
      
                    <div class="comment-count">
                      <img src="..\img\reply.png">
                      <?php
                        $id_forum = $hasil["id_forum"]; 
                        $query_komentar = mysqli_query($conn, "SELECT * FROM komentar WHERE id_forum = $id_forum");
                        $jml_komentar = mysqli_num_rows($query_komentar);
                      ?>
                      <h1><?= $jml_komentar; ?></h1>
                    </div>
                
                    <div class="details">
                      <?php 
                        if ($hasil["gambar"] != NULL) {
                         echo '<img src="data:image/jpeg;base64,'.base64_encode( $hasil['gambar'] ).'"/>'; 
                        } else {
                          echo '<img src="..\img\user.jpg">';
                        }
                      ?>
                      <div class="name-date">
                        <h1><?= $hasil["username"]; ?></h1>
                        <br>
                        <h2><?= tanggal_indo($hasil["tanggal"]); ?></h2>
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