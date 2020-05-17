<?php
session_start();
// cek sudah login atau belum
if ( isset($_SESSION["username"]) ) {
  header("Location: index.php");
  exit;
}

require 'fungsi.php';
// cek login berhasil atau tidak
if( isset($_POST["masuk"]) ) {
    if( masuk($_POST) > 0) {
        $_SESSION["username"] = $_POST["username"];
        echo "<script>
          alert('Selamat Datang Magons :)')
          window.location.replace('index.php');
          </script>";
        exit;
    }
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
                <a href="daftar.php">
                  Daftar
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
            <div class="redDec"></div>
            <h1>Silahkan Masuk Magons!</h1>
          </header>
       
          <div class="container intro bg">
          <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Dramagon.<br>
                    Isi data akun Magons kamu dibawah ya!</h1>
              </div>
           </div>

            <div class="container bg">
        <div class="container form left">
          
            <form action ="" method="post">
                <label for="username">Username Magons</label><br>
                <input type="text" id="username" name="username" required>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
                <div class="text">
                </div>
                <button type="submit" class="registerbtn" name="masuk">Masuk</button>
    

            </form>
        
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