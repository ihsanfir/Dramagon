<!DOCTYPE HTML>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../style/style.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" type="text/css" href="../style/sidebar nav.css?v=<?php echo time(); ?>" />
</head>

<body>

  <div class="red-top"></div>

  <?php include 'sidebar.php'; ?>

    <div class="wrapper">
      <div class="container giant">
        <div class="container first">

          <header >
            <div class="redDec"></div>
            <h1>Hasil Pencarian</h1>
          </header>

          <div class="container intro bg">
              <div class="text">
                <h2><strong>Halo Magons!</strong>
                    <br>Ini hasil pencarian mu!</h2>
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
              <option value="forum_list.php?kategori=semua" <?php if($kategori == 'semua') {echo 'selected="true"';} ?>>Semua</option>
                <option value="forum_list.php?kategori=forum" <?php if($kategori == 'semua') {echo 'selected="true"';} ?>>Forum</option>
                <option value="forum_list.php?kategori=info" <?php if($kategori == 'umum') {echo 'selected="true"';} ?>>Informasi</option>
  
              </select>
           </div>

          <div class="container list">
            <ul class="listView">
              <header class="kategori">
                <box>
                  <h1><?= $kategori; ?></h1>
                </box>
              </header>
                  
              <?php while($hasil = mysqli_fetch_array($forum_list)) : ?>
              <li class="item" >
                <a href="forum_thread.php?id_forum=<?= $hasil["id_forum"]; ?>">
                  
                  <div class="title">
                    <h1><?= $hasil["judul"]; ?></h1>
                  </div>

                  <div class="item-stat">
                    
                    <div class="like">
                      <img src="..\img\like.png">
                      <h1><?= $hasil["suka"]; ?></h1>
                    </div>
      
                    <div class="comment-count">
                      <img src="..\img\reply.png">
                      <?php
                        $id_forum = $hasil["id_forum"]; 
                        $query_komentar = mysqli_query($conn, "SELECT * FROM komentar WHERE id_forum = $id_forum");
                        $jml_komentar = mysqli_num_rows($query_komentar);
                      ?>
                      <h1><?= $jml_komentar; ?></h1>
                    </div>
                
                    <div class="details">
                      <?php 
                        if ($hasil["gambar"] != NULL) {
                         echo '<img src="data:image/jpeg;base64,'.base64_encode( $hasil['gambar'] ).'"/>'; 
                        } else {
                          echo '<img src="..\img\user.jpg">';
                        }
                      ?>
                      <div class="name-date">
                        <h1><?= $hasil["username"]; ?></h1>
                        <br>
                        <h2><?= tanggal_indo($hasil["tanggal"]); ?></h2>
                      </div>
                    </div>

                  </div>  
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
              <a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
            <?php endif; ?>

            <?php for($i=1; $i<=$jumlahHalaman; $i++) : ?>
              <?php if ($i == $halamanAktif) : ?>
                <a class="active" href="?page=<?= $i; ?>"><?= $i; ?></a>
              <?php else : ?>
               <a href="?page=<?= $i; ?>"><?= $i; ?></a>
              <?php endif; ?>
            <?php endfor; ?>
            
            <?php if( $halamanAktif < $jumlahHalaman ): ?>
              <a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
            <?php endif; ?>
          </div>
        </div>
        

      </div>
      <!--container giant-->
        <div class="container-right">
            <div class="ads">
              <h2>SPACE IKLAN</h2>
            </div>
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

</body>
</html>