<?php 
require 'fungsi.php';

session_start();
if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

$id_forum = $_GET["id_forum"];
$res = mysqli_query($conn, "SELECT * FROM forum WHERE id_forum = $id_forum") or die(mysqli_error());
$hasil = mysqli_fetch_array($res);

if ( isset($_POST["kirim"]) ) {
  if ( tambahKomentar($_POST) > 0) {
    echo "<script>alert('komentar berhasil ditambahkan');</script>";
    $id_forum = $_POST["id_forum"];
    header("Location: forum_thread.php?id_forum=$id_forum");
  }
}


?>

<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/style.css" />
  <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css" />
</head>

<body>

  <div class="red-top"></div>

      <!--sidebar-->
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
          <div class="border">
            <div class="sidebar-brand">
              <a >Logo Dramagon</a>
            </div>
        </div>
        <div class="border">
          <div class="sidebar-header">
            <div class="user-pic">
              <img class="img-responsive img-rounded" src="../img/user.jpg"
                alt="User picture">
            </div>
              <div class="user-info">
                <span class="user-name">
                  <?php
                  if ( !isset($_SESSION["username"]) ) {
                  echo "<strong>";
                  echo "<a href='masuk.php'>
                        Masuk / Daftar
                        </a>";
                  echo "</strong>";
                  }
                  else {
                    echo "<strong>";
                    echo "<a href='akun.php'>" . $_SESSION["username"] . "</a>";
                    echo "</strong>";
                  }
                  ?>
                </span>
                <span class="user-role">
                  <?php
                  if ($_SESSION["username"] == "admin") {
                    echo "Administration";
                  }
                  else 
                    echo "Pengguna";
                  ?>
                </span>
              <span class="user-status">
                <i class="fa fa-circle"></i>
                <span>Online</span>
              </span>
              <span class="logout"><a href="index.html">Keluar</a></span>
            </div>
          </div>
        </div>
        <!-- sidebar-header  -->
        <div class="border">
          <div class="sidebar-search">
            <div>
              <input type="search" placeholder="Search...">
            </div>
          </div>
        </div>
        <!-- sidebar-search  -->
        <div class="border">
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>Umum</span>
            </li>

            <li class="sidebar-list">
              <a href="index.php">
                <span>Beranda</span>
              </a>
            </li>
            
            <li class="sidebar-list">
              <a href="#">
                <span>Promosi</span>
              </a>
            </li>
            
            <li class="sidebar-list">
              <a href="#">
                <span>Informasi</span>
              </a>
            </li>
            
            <li class="sidebar-list">
              <a href="forum_list.php">
                <span>Forum</span>
              </a>
            </li>
        
          </ul>

        </div>
        <!-- sidebar-menu  -->
        </div>

      </div>
      <!-- sidebar-content  -->
    
    </nav>
    <!-- sidebar-wrapper  -->

    <div class="wrapper">
      <div class="container giant">
        <div class="container first">
          <header >
            <h1>Thread</h1>
          </header>
          <div class="container thread flex bg">

            <div class="container forum-stat">
              <img src="..\img\user.jpg">

              <div class="rate">
                <input type="image" class="rate-up" src="..\img\rateup.png" />
                <h1>41</h1>
                <input type="image" class="rate-down" src="..\img\ratedown.png" />
              </div>

              <div class="fav">
                <img src="..\img\fav.png">
                <h2>8</h2>
              </div>

              <?php
              echo '<div class="komentar">';
                echo "<h2>Komentar</h2>";
                $total = mysqli_query($conn, "SELECT COUNT(id_komentar) FROM komentar WHERE id_forum = $id_forum") or die(mysqli_error());
                $arr = mysqli_fetch_array($total);
                $jml_komen = $arr["COUNT(id_komentar)"];
                echo "<h2>" .$jml_komen. "</h2>";
              echo "</div>";
              ?>

            </div>

            <?php
            echo '<div class="container forum-main">';
              echo "<h1>" . $hasil["judul"] . "</h1>";

              echo "<h2>oleh <strong>" .$hasil["nama"] . "</strong> " . $hasil["tanggal"]. "</h2>";

              echo '<div class="kategori">
                      <box class="kat">Hewan</box>
                      <box class="kat">Hobi</box>
                      <box class="kat">Peliharaan</box>
                    </div>';

              echo '<div class="bagi-ubah">
                <img src="..\img\share.png">
                <h2>Bagikan</h2>';

                echo '<img src="..\img\edit.png">
                <h2>Ubah</h2>';
              echo "</div>";

              echo "<hr>";

              echo "<text>";
                echo "<p>" . $hasil["isi"] .
                "</p>";
              echo "</text>
            </div>
        </div>";
        ?>

        <!--container2-->
        <form method="post" action="">
        <div class="container second bg kiri">
          <div class="kolom-komentar">
            <div class="kotak">
              <h1>Komentar</h1>
              <input type="hidden" name="id_forum" value="<?= $hasil["id_forum"]; ?>">
              <input type="hidden" name="id_pengguna" value="<?=  $hasil["id_pengguna"]; ?>">
              <input type="hidden" name="nama" value="<?=  $hasil["nama"]; ?>">
              <textarea class="thread-komentar" placeholder="Isi komentar kamu disini..." name="isi_komentar"></textarea>
            </div>
            <button type="submit" name="kirim">
              <h1>kirim</h1>
            </button>
          </div>
        </div>
        </form>

        <div class="container second flex-row">
        <?php
          $komen = mysqli_query($conn, "SELECT * FROM komentar WHERE id_forum = $id_forum ORDER BY tanggal DESC") or die(mysqli_error());
            while ($komentar = mysqli_fetch_array($komen)) {
              echo '<div class="comment-list bg">
                      <div class="comment-list img-box">
                      <img src="..\img\user.jpg">
                      </div>';
                    echo "<text>";
                    echo "<h2>oleh <strong> " . $komentar["nama"] . "</strong>, " . $komentar["tanggal"] . "</h2>";
                    echo "<p>" . $komentar["isi"] . "</p>";
                    echo "</text>";    
                    echo "</div>";
      } ?>
      </div>
      <!--container-->

      </div>

        <div class="container-right">
            <div class="sidebar-right header bg">
                <h1>Ingin Buat Thread?</h1>
            </div>
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