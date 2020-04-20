<?php 
require 'fungsi.php';
global $conn;

session_start();
if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

if( isset($_POST["simpan"])) {
    if(edit($_POST) > 0 ) {
        $_SESSION["username"] = $_POST["username"];
        echo"<script>
                alert('Perubahan berhasil disimpan');
            </script>";

    }
    else {
        echo mysqli_error($conn);
    }
}

$uname = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");

$pengguna = mysqli_fetch_array($query);
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
                echo $_SESSION["username"];
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
      <div class="container giant">
        <div class="container first">
          <header >
            <h1>Akun Magons</h1>
          </header>
          <div class="container second bg">
            <div class="container fotoAkun">
                <img class="foto" src="../img/user.jpg"
                alt="User picture">
            </div>
        <div class="container form">
              <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Dramagon.<br>
                    Isi data akun Magons kamu dibawah ya!</h1>
              </div>
            <form action ="" method="post">
                <input type="hidden" name="id" value="<?= $pengguna["id"]; ?>">

                <label for="username">Username Magons</label><br>
                <input type="text" id="username" name="username" value="<?= $pengguna["username"]; ?>">
                
                <label for="nama">Nama</label><br>
                <input type="text" id="nama" name="nama" value="<?= $pengguna["nama"]; ?>">

                <label for="email">Email</label><br>
                <input type="text" id="email" name="email" value="<?= $pengguna["email"]; ?>">

                <label for="notelp">Nomor Telfon</label><br>
                <input type="text" id="notelp" name="notelp" value="<?= $pengguna["telpon"]; ?>">
                
                <h1>Jenis Kelamin</h1>
                <input type="radio" id="laki" name="jk" value="laki" <?php if($pengguna["jenkel"]=='laki') {echo "checked"; }?> >
                <label for="male">Laki-laki</label>
                <input type="radio" id="perempuan" name="jk" value="perempuan" <?php if($pengguna["jenkel"]=='perempuan') {echo "checked"; }?> >
                <label for="perempuan">Perempuan</label><br>

                <label for="tl">Tanggal Lahir:</label>
                <input type="date" id="tl" name="tl" value="<?= $pengguna["tanggalLahir"]; ?>">
   
                <button type="submit" class="registerbtn" name="simpan">Simpan</button>
    

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