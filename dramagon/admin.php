<?php 
require 'fungsi.php';
session_start();
$uname = $_SESSION["username"];

if ($uname != "admin") {
  header("Location: index.php");
  exit;
} 

$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");
$pengguna = mysqli_fetch_array($query);

if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

if(isset($_GET["kategori"])) {
  $kategori = $_GET["kategori"];
  if ($kategori == "informasi") {
    $res = mysqli_query($conn, "SELECT id_informasi as id, judul_informasi as judul, status FROM informasi WHERE status = 'moderasi' ORDER BY id_informasi ASC");
  } else if ($kategori == "forum") {
    $res = mysqli_query($conn, "SELECT id_forum as id, judul FROM forum ORDER BY id_forum ASC");
  }
} else {
  $kategori = "informasi";
  $res = mysqli_query($conn, "SELECT id_informasi as id, judul_informasi as judul, status FROM informasi WHERE status = 'moderasi' ORDER BY id_informasi ASC");
}

$jumlahDataPerHalaman = 8;
$jumlahData = mysqli_num_rows($res);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["page"])) ? $_GET["page"] : 1;
$mulai = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

if(isset($_GET["kategori"])) {
  $kategori = $_GET["kategori"];
  if ($kategori == "informasi") {
    $res = mysqli_query($conn, "SELECT id_informasi as id, judul_informasi as judul, status FROM informasi WHERE status = 'moderasi' ORDER BY id_informasi ASC LIMIT $mulai, $jumlahDataPerHalaman");
  } else if ($kategori == "forum") {
    $res = mysqli_query($conn, "SELECT id_forum as id, judul FROM forum ORDER BY id_forum ASC LIMIT $mulai, $jumlahDataPerHalaman");
  }
} else {
  $kategori = "informasi";
  $res = mysqli_query($conn, "SELECT id_informasi as id, judul_informasi as judul, status FROM informasi WHERE status = 'moderasi' ORDER BY id_informasi ASC LIMIT $mulai, $jumlahDataPerHalaman");
}

if (isset($_POST["setuju"])) {
  if (setujuInfo($_POST) > 0) {
    echo "<script>
          alert('Informasi berhasil disetujui!')
          window.location.replace('admin.php');
          </script>";
    exit;
  }
}

if (isset($_POST["tolak"])) {
  if (tolakInfo($_POST) > 0) {
    echo "<script>
          alert('Informasi ditolak!')
          window.location.replace('admin.php');
          </script>";
    exit;
  }
}

if (isset($_POST["hapus"])) {
  if (hapusForum($_POST) > 0) {
    echo "<script>
          alert('Forum berhasil dihapus!')
          window.location.replace('admin.php?kategori=".$kategori."');
          </script>";
    exit;
  }
}

?>

<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/style.css" />
  <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css" />

  <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
  <link rel="manifest" href="/favicon/site.webmanifest">
</head>

<body>

  <div class="red-top"></div>
   <?php include 'sidebar.php'; ?>
    <!-- sidebar-wrapper  -->
    <div class="wrapper">
      <div class="container giant">
        <div class="container first">
          <header >
            <div class="redDec"></div>
            <h1>Dramagon <strong>ADMIN ONLY</strong> </h1>
          </header>
          <div class="container intro bg">
              <div class="text">
                <h2><strong>Halo ADMIN!</strong>
                  <br>
                    <br>Ini tempat APPROVE Informasi</h2>
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
                <option value="admin.php?kategori=informasi" <?php if($kategori == "informasi") {echo 'selected="true"';} ?>>Informasi</option>
                <option value="admin.php?kategori=forum" <?php if($kategori == "forum") {echo 'selected="true"';} ?>>Forum</option>
              </select>

            </div>

            <div class="container list">
                <ul class="listView">
                  <header class="kategori">
                    <box>
                      <h1><?= $kategori; ?></h1>
                    </box>
                  </header>

                  <?php while($hasil = (mysqli_fetch_array($res))): ?>
                    <li class="item" >
                      <?php 
                        if ($kategori == "informasi") {
                        echo '<a href="info_page.php?id_informasi=' .$hasil["id"]. '">';
                      } else if ($kategori == "forum") {
                        echo '<a href="forum_thread.php?id_forum=' .$hasil["id"]. '">';
                      }

                      ?>
                        <div class="title">
                          <h1><?= $hasil["judul"]; ?>
                        </div>
                       <form method="post" action="">
                       <div class="approving">
                           <input type="hidden" name="id" value="<?= $hasil["id"];?>">
                           <?php
                           if ($kategori == "informasi") {
                            echo '
                            <button class="ok" type="submit" name="setuju">
                            Setuju
                           </button>
                           <button class="erase" type="submit" name="tolak">
                            Tolak
                           </button>';
                           } else if ($kategori == "forum") {
                            echo '
                            <button class="erase" type="submit" name="hapus">
                            Hapus
                            </button>';
                           }
                           ?>
                       </div>
                     </form>
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
        </div>
          <!--container-right end-->

  


    </div>
    <!--wrapper end-->

  <div class="red-bot"></div>

</body>
</html>