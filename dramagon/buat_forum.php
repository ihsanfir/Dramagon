<?php 
require 'fungsi.php';

session_start();
if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

$uname = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");

$pengguna = mysqli_fetch_array($query);

if( isset($_POST["kirim"]) ) {
    if( buatForum($_POST) > 0) {
        echo "<script>alert('Forum berhasil ditambahkan !');</script>";
        header("Location: forum_list.php");
    }

    $error = true;
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
            <h1>Buat Thread</h1>
          </header>
          <div class="container second bg">

            <form class="threadCreate" method="post" action="">
                <input type="hidden" name="id_pengguna" value="<?= $pengguna["id_pengguna"]; ?>">
                <input type="hidden" name="nama" value="<?= $pengguna["nama"]; ?>">
                <input type="text" name="judul_forum" placeholder="Isi judul disini...">
                <br>
                <textarea id="styled" name = "isi_forum" placeholder="Isi tulisan kamu disini..."></textarea>
                <button type="submit" name="kirim">
                kirim</button>
            </form>
            <!-- sementara diluar form-->
          </div>
        </div>
        <!--container1-->
        
      </div>
      <!--container-->
        <div class="container-right">
       container nganggur
        </div>
          <!--container-right end-->

    </div>
    <!--wrapper end-->
       
  <div class="red-bot"></div>

</body>
</html>