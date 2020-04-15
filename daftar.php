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

  https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg

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