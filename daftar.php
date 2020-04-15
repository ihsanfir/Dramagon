<?php
require 'fungsi.php';

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
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <link rel="stylesheet" type="text/css" href="style/sidebar nav.css" />
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
            <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
              alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name">
              <strong>
                <a href="regis.html">
                  Masuk / Daftar
                </a>
              </strong>
            </span>
            <span class="user-role">Administrator</span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
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
              <a href="index.html">
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
              <a href="#">
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
      <div class="container">
        <div class="container1">
          <header >
            <h1> Buat Akun Baru</h1>
          </header>
          <div class="container2 box">
        <div class="container-form">
              <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Dramagon.<br>
                    Ayo isi formulir dibawah ini untuk menjadi seorang Magons sejati!</h1>
                </div>
            <form action ="" method="post">
                <label for="email">Alamat Email</label><br>
                <input type="text" id="email" name="email"><br>

                <label for="password">Password</label><br>
                <input type="password" id="password" name="password"><br>
                
                <label for="k_password">Konfirmasi Password</label><br>
                <input type="password" id="k_password" name="k_password"><br>
                <br>
                <label for="username">Username Magons</label><br>
                <input type="text" id="username" name="username">
                <div class="text">
                    <h3>
                        Username Magons adalah nama unik kamu di web magons. Jadi tunggu apa lagi ayo isi!
                        *Bisa diganti kok
                    </h3>
                </div>
                <hr>
                <button type="submit" class="registerbtn" name="daftar">Daftar</button>
            
            </form>
        
            </div>

          </div>
        </div>
        <!--container1-->
        
        

      </div>
      <!--container-->
            <div class="container-right">
            ini ada container nganggur rencananya mau dikasih gambar apa gitu biar menarik
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