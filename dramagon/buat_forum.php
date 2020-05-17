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

if( isset($_POST["kirim"]) ) {
    if( buatForum($_POST) > 0) {
        $last_id = buatForum($_POST);
        echo "<script>
          alert('Forum kamu telah berhasil dibuat!')
          window.location.replace('forum_thread.php?id_forum=".$last_id."');
          </script>";
          exit;
    }
    else {
      echo "<script>alert('Forum kamu gagal dibuat!');</script>";
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
    <?php include 'sidebar.php'; ?>
    <div class="wrapper">
      <div class="container giant">
        <div class="container first">
          <header >
            <h1>Buat Thread</h1>
          </header>
          <div class="container bg">

            <form class="threadCreate" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id_pengguna" value="<?= $pengguna["id_pengguna"]; ?>">
                <input type="text" name="judul_forum" placeholder="Isi judul disini..." required>
                <br>
                <textarea id="styled" name = "isi_forum" placeholder="Isi tulisan kamu disini..." required></textarea>
              
            <div class="flex">
              <div class="bungkus-button">
                  <div class="add-photo">
                     <img src="..\img\add-image.png"/>
                    <input type="file" name="image">
                  </div>
              </div>
              
              <div class="bungkus-button kirim">
                    <button type="submit" name="kirim">
                      Buat Forum
                    </button>
              </div>
            </div>
            
          </div>
          <!--container bg end-->
        </div>
        <!--container first-->      
      </div>
      <!--container-->
        <div class="container-right">
          <div class="filter bg">
            <header>
              Pilih Kategori
            </header>
              <select class="category" name="kategori">
                <option value="umum">Umum</option>
                <option value="makanan">Makanan</option>
                <option value="hobi">Hobi</option>
              </select>
            </form>
          </div>
        </div>
          <!--container-right end-->

    </div>
    <!--wrapper end-->
       
  <div class="red-bot"></div>

</body>
</html>