<?php 
require 'fungsi.php';

session_start();
if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
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
            <h1>Forum Dramagon</h1>
          </header>
          <div class="container intro bg">
              <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Forum Dramagon.<br>
                    <br>Ini tempat kita ngobrol-ngobrol asik!</h2>
              </div>
            </div>
          <!--container second bg end--->

            <div class="container list">
                <ul class="listView">
                  <?php 
                  $res = mysqli_query($conn, "SELECT * FROM forum ORDER BY id_forum DESC");
                  while($hasil = mysqli_fetch_array($res)) {
                    echo "<li class='item'>";
                        echo "<h1>";
                            echo $hasil["judul"];
                        echo "</h1>";
                        echo "<h2>";
                            echo $hasil["tanggal"];
                        echo "</h2>";
                        echo "<h1>";
                            echo $hasil["nama"];
                        echo "</h1>";
                        echo "<a href='forum_thread.php?id_forum=";
                        echo $hasil["id_forum"]; 
                        echo "'>Lebih Lanjut</a>";
                    echo "</li>";
                    }
                  ?>
                </ul>
            </div>
            <!--container list end-->
        </div>
        <!--container1-->
        
        

      </div>
      <!--container-->
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
       
        </div>
        <!--main end-->
     
      </div>
      <!--body end-->

  
  </div>

  <div class="red-bot"></div>

</body>
</html>