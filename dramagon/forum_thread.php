<?php 
require 'fungsi.php';

session_start();
$uname = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");
$pengguna = mysqli_fetch_array($query);
$id_pengguna = (int)$pengguna["id_pengguna"];
if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

$res_komen = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");
$hasil_comment = mysqli_fetch_array($res_komen);
$id_forum = $_GET["id_forum"];
$res = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, forum.id_pengguna, forum.gambar as gambar_forum, forum.id_forum, forum.isi, forum.judul, forum.kategori, forum.tanggal FROM pengguna INNER JOIN forum ON pengguna.id_pengguna = forum.id_pengguna WHERE id_forum = $id_forum") or die(mysqli_error());
$hasil = mysqli_fetch_array($res);

$komen = mysqli_query($conn, "SELECT pengguna.id_pengguna, pengguna.username, pengguna.gambar, komentar.id_pengguna, komentar.tanggal, komentar.isi, komentar.id_forum FROM pengguna INNER JOIN komentar ON pengguna.id_pengguna=komentar.id_pengguna WHERE id_forum = $id_forum ORDER BY id_komentar DESC") or die(mysqli_error());
$total = mysqli_query($conn, "SELECT * FROM komentar WHERE id_forum = $id_forum") or die(mysqli_error());
$jml_komen = mysqli_num_rows($total);

if ( isset($_POST["kirim"]) ) {
  if ( tambahKomentar($_POST) > 0) {
    $id_forum = $_POST["id_forum"];
    header("Location: forum_thread.php?id_forum=$id_forum");
  }

  else {
    echo "<script>alert('Komentar gagal ditambahkan!');</script>";
  }
}

$res_suka = mysqli_query($conn, "SELECT id_suka FROM suka WHERE forums = $id_forum");
$hasil_suka = mysqli_num_rows($res_suka);
if (isset($_GET["tipe"], $_GET["id_forum"])) {
  $tipe = $_GET["tipe"];
  $id = (int)$_GET["id_forum"];
  if ($tipe == "forum") {
    $query_suka = "
    INSERT INTO suka (users, forums)
    SELECT {$id_pengguna}, {$id_forum} FROM forum
    WHERE EXISTS(
      SELECT id_forum FROM forum WHERE id_forum = {$id_forum}) AND
      NOT EXISTS(SELECT id_suka FROM suka
        WHERE users = {$id_pengguna} AND forums = {$id_forum})
        LIMIT 1";
    mysqli_query($conn, $query_suka) or die(mysqli_error());
    header("Location: forum_thread.php?id_forum=$id_forum");
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
</head>

<body>

  <div class="red-top"></div>
  <?php include 'sidebar.php'; ?>

    <div class="wrapper">
      <div class="container giant">
        <div class="container first">
          <header >
            <div class="redDec"></div>
            <h1>Thread</h1>
          </header>

          <div class="container thread">
            <div class="container thread-stat">
            <?php 
              if ($hasil["gambar"] != NULL) {
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $hasil['gambar'] ).'"/>';
              } else {
                echo '<img src="..\img\user.jpg">';
            } ?>
                <div class="like">
                    <a href="forum_thread.php?tipe=forum&id_forum=<?=  $id_forum;?>">
                      <img src="..\img\like.png">
                    </a>
                    <h1><?= $hasil_suka; ?></h1>
                </div>

                <div class="comment-count">
                  <img src="..\img\reply.png">
                  <h1><?= $jml_komen ?></h1>
                </div>
            </div>

            <div class="container thread-main">
            <h1><?= $hasil["judul"]?></h1>
              <h2>oleh <strong><?= $hasil["username"]; ?>, </strong> <?= tanggal_indo($hasil["tanggal"]); ?></h2>
                
              <div class="container category">
                  <box class="kat"><h1><?= $hasil["kategori"]; ?></h1></box>
                </div>
              <div class="share-edit">
                <div onclick="myFunction()" class="share">
                  <img src="..\img\share.png">
                  <h2>Bagikan</h2>
                </div>
                <div style="display: none;" class="share-drop" id="share-drop">
                  <h2>
                    Link:
                  </h2>
                  <a>
                    forum_thread?id_forum=<?= $hasil["id_forum"]; ?>
                  </a>
                </div>
                <script>
                  function myFunction() {
                  var x = document.getElementById("share-drop");
                  if (x.style.display === "none") {
                    x.style.display = "block";
                  } else {
                    x.style.display = "none";
                  }
                }
                </script>

                </div>

                <hr>
                <?php if($hasil["gambar_forum"] != NULL): ?>
                <div class="thread-img">
                  <?php echo '<img id="myBtn" src="data:image/jpeg;base64,'.base64_encode( $hasil['gambar_forum'] ).'"/>'; ?>
                </div>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                <?php echo '<img id="myBtn" src="data:image/jpeg;base64,'.base64_encode( $hasil['gambar_forum'] ).'"/>';                ?>
                <span class="close">&times;</span>  
                </div>
                </div>
                <?php endif; ?>
                <text>
                  <p><?= $hasil["isi"]; ?></p>
                </text>
            </div>
        </div>
        <!--container thread end-->
        <form method="post" action="">
        <div class="container first bg kiri">
          <div class="container comment">
            <div class="kotak">
              <h1>Komentar</h1>
              <input type="hidden" name="id_forum" value="<?= $hasil["id_forum"]; ?>">
              <input type="hidden" name="id_pengguna" value="<?=  $hasil_comment["id_pengguna"]; ?>">
              <textarea class="thread-komentar" placeholder="Isi komentar kamu disini..." name="isi_komentar" required></textarea>
            </div>
            <button type="submit" name="kirim">
              <h1>kirim</h1>
            </button>
          </div>
        </div>
        </form>

        <div class="container flex-col">
          <?php while ($komentar = mysqli_fetch_array($komen)) : ?>
            <div class="comment-item bg">
                <div class="comment-item img-box">
                <?php 
                if ($komentar["gambar"] != NULL) {
                  echo '<img src="data:image/jpeg;base64,'.base64_encode( $komentar['gambar'] ).'"/>';
                } else {
                  echo '<img src="..\img\user.jpg">';
                }

                ?>
                </div>
                  <text>
                    <h2>oleh <strong><?= $komentar["username"] ?></strong>, <?= tanggal_indo($komentar["tanggal"]); ?></h2>
                      <p><?= $komentar["isi"]; ?></p>
                  </text>    
            </div>
          <?php endwhile; ?>
        </div>
      </div>
      <!--container-->

      </div>

      <!--container giant-->
      <div class="container-right">
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
  <script src="..\ini js\script.js"></script>
</body>
</html>