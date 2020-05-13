<?php
require 'fungsi.php';
session_start();
// cek sudah login atau belum
if ( isset($_SESSION["username"]) ) {
  header("Location: index.php");
  exit;
}


if( isset($_POST["daftar"])) {
    if(daftar($_POST) > 0 ) {
        echo"<script>
                alert('user baru berhasil ditambahkan!');
            </script>";
    }
    else {
        echo mysqli_error($conn);
    }
}

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

      <!--sidebar-->
      <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
          <div class="border">
            <div class="sidebar-brand">
              <img src="..\img\logo.png">
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
                <strong>
                  <a href="masuk.php">
                    Masuk
                  </a>
                </strong>
              </span>
              <span class="user-role">Pengguna</span>
              <span class="user-status">
                <i class="fa fa-circle"></i>
                <span>Offline</span>
              </span>
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
                <a href="info_list.php">
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
              <h1>Silahkan Masuk Magons!</h1>
            </header>
            <div class="container second bg">
        <div class="container form left">
              <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Dramagon.<br>
                    Ayo isi formulir dibawah ini untuk menjadi seorang Magons sejati!</h1>
              </div>
            <form action="" method="post">
                <label for="email">Alamat Email</label><br>
                <input type="text" id="email" name="email" required><br>

                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
                
                <label for="k_password">Konfirmasi Password</label><br>
                <input type="password" id="k_password" name="k_password" required><br>
                <br>
                <label for="uname">Username Magons</label><br>
                <input type="text" id="uname" name="uname" placeholder="maksimal 10 karakter" required>
                <div class="text">
                    <h3>
                        Username Magons adalah nama unik kamu di web magons. Jadi tunggu apa lagi ayo isi!
                        *Bisa diganti kok
                    </h3>
                </div>
                <br>
                <button type="submit" class="registerbtn" name="daftar">Daftar</button>
            
            </form>
            <p>
              Sudah punya akun Magons?
            </p>
            <a href="masuk.php">
              Klik disini!
            </a>
            </div>

          </div>
        </div>
        <!--container1-->
        
        

      </div>
      <!--container-->
            <div class="container-right">
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
