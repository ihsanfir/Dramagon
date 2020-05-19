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

if (isset($_GET["kategori"])) {
  $kategori = $_GET["kategori"];
  if ($kategori == "semua") {
    $res = mysqli_query($conn, "SELECT * FROM forum");
  } else {
    $res = mysqli_query($conn, "SELECT * FROM forum WHERE kategori='$kategori'");
  }
} else {
  $kategori = "semua";
  $res = mysqli_query($conn, "SELECT * FROM forum");
}

$jumlahDataPerHalaman = 6;
$jumlahData = mysqli_num_rows($res);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["page"])) ? $_GET["page"] : 1;
$mulai = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

if (isset($kategori) && $kategori != "semua") {
  $forum_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_pengguna, forum.id_forum, forum.kategori, forum.tanggal, forum.judul FROM pengguna INNER JOIN forum ON pengguna.id_pengguna=forum.id_pengguna WHERE kategori = '$kategori' ORDER BY id_forum DESC LIMIT $mulai, $jumlahDataPerHalaman");
} else {
  $forum_list = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_pengguna, forum.id_forum, forum.kategori, forum.tanggal, forum.judul FROM pengguna INNER JOIN forum ON pengguna.id_pengguna=forum.id_pengguna ORDER BY id_forum DESC LIMIT $mulai, $jumlahDataPerHalaman");
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

  <div class="red-top"></div>

  <?php include 'sidebar.php'; ?>

    <div class="wrapper">
      <div class="container giant">
        <div class="container first">

          <header >
            <div class="redDec"></div>
            <h1>Forum Dramagon</h1>
          </header>

          <div class="container intro bg">
              <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Forum Dramagon.<br>
                    <br>Ini tempat kita ngobrol-ngobrol asik!</h2>
              </div>
           </div>

          <!--container intro bg end--->
            
          <div class="container filter bg ">
              <header>
                <h1>
                  Urutkan:
                </h1>
              </header>

              <select class="category" onchange="location = this.value;">
                <option value="forum_list.php?kategori=semua" <?php if(!isset($kategori) || $kategori == 'semua') {echo 'selected="true"';} ?>>Semua</option>
                <option value="forum_list.php?kategori=umum" <?php if($kategori == 'umum') {echo 'selected="true"';} ?>>Umum</option>
                <option value="forum_list.php?kategori=makanan" <?php if($kategori == 'makanan') {echo 'selected="true"';} ?>>Makanan</option>
                <option value="forum_list.php?kategori=hobi" <?php if($kategori == 'hobi') {echo 'selected="true"';} ?>>Hobi</option>
                <option value="forum_list.php?kategori=teknologi" <?php if($kategori == 'teknologi') {echo 'selected="true"';} ?>>Teknologi</option>
                <option value="forum_list.php?kategori=olahraga" <?php if($kategori == 'olahraga') {echo 'selected="true"';} ?>>Olahraga</option>
                <option value="forum_list.php?kategori=lifestyle" <?php if($kategori == 'lifestyle') {echo 'selected="true"';} ?>>Lifestyle</option>
                <option value="forum_list.php?kategori=otomotif" <?php if($kategori == 'otomotif') {echo 'selected="true"';} ?>>Otomotif</option>
              </select>
           </div>

          <div class="container list">
            <ul class="listView">
              <header class="kategori">
                <box>
                  <h1><?php 
                  if ( !isset($kategori) || $kategori == 'semua') {
                    echo "Semua";
                  }
                  else {
                    echo $kategori;
                  }
                  ?></h1>
                </box>
              </header>
                  
              <?php while($hasil = mysqli_fetch_array($forum_list)) : ?>
              <li class="item" >
                <a href="forum_thread.php?id_forum=<?= $hasil["id_forum"]; ?>">
                  
                  <div class="title">
                    <h1><?= $hasil["judul"]; ?></h1>
                  </div>

                  <div class="item-stat">
                    
                    <div class="like">
                      <img src="..\img\like.png">
                      <?php
                      $forums = $hasil["id_forum"];
                      $res_suka = mysqli_query($conn, "SELECT id_suka FROM suka WHERE forums = $forums") or die(mysqli_error());
                      $hasil_suka = mysqli_num_rows($res_suka);
                      ?>
                      <h1><?= $hasil_suka; ?></h1>
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
        <!--container list end-->
      </div>
      <!--container1 end-->

        <!---pagination-->
        <div class="container pagi">
          <div class="pagination">
            <?php if( $halamanAktif > 1 ): ?>
              <a href="?kategori=<?= $kategori; ?>&page=<?= $halamanAktif - 1; ?>">&laquo;</a>
            <?php endif; ?>

            <?php for($i=1; $i<=$jumlahHalaman; $i++) : ?>
              <?php if ($i == $halamanAktif) : ?>
                <a class="active" href="?kategori=<?= $kategori; ?>&page=<?= $i; ?>"><?= $i; ?></a>
              <?php else : ?>
               <a href="?kategori=<?= $kategori; ?>&page=<?= $i; ?>"><?= $i; ?></a>
              <?php endif; ?>
            <?php endfor; ?>
            
            <?php if( $halamanAktif < $jumlahHalaman ): ?>
              <a href="?kategori=<?= $kategori; ?>&page=<?= $halamanAktif + 1; ?>">&raquo;</a>
            <?php endif; ?>
          </div>
        </div>
        

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