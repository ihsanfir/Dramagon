<?php
//mengabaikan error yang muncul pada browser
error_reporting(0);
//sesi dimulai
session_start();

//panggil koneksi untuk menghubungkan ke database
include "functions.php"; //ntar sesuain ya foldernya atau filenya san



// function input terdapat di file koneksi.php

 $username = mysqli_real_escape_string($conect, $_POST['uname']);
 $pass = mysqli_real_escape_string($conect, $_POST['password']);
 $pass_md5= md5($pass);

  if(isset($_POST['login'])){
    //cek usename gaboleh kosong
    if($username == ""){
    $er_user="Username Kosong!";
    }
    //cek password gaboleh kosong
    elseif($pass == ""){
    $er_pass="Password Kosong!";
    }
    else{
    //cek apakah user terdaftar atau tidak di database
    $sql_cek=mysqli_query($conect, "SELECT * FROM pengguna where username='$username' and password='$pass_md5'");
    $cek_user=mysqli_num_rows($sql_cek);
     //jika username dan password tidak terdaftar di database
    if($cek_user == "0"){
    $er_user="Username dan Password tidak valid";
    }
    else{

        //jika username dan password terdaftar di database maka akan menuju halaman home.php
    //$_SESSION['data_admin']=$username;
    echo "<script>alert('Welcome Magons! !');document.location='index.php'</script>"; //ntar tulung ganti lokasinya san

     }
   }
 }

?>

<!DOCTYPE HTML>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style/style_login.css" />
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
              <img class="img-responsive img-rounded" src="../img/user.jpg"
                alt="User picture">
            </div>
            <div class="user-info">
              <span class="user-name">
                <strong>
                  <a href="login.php">
                    Masuk
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
            <h1> Login Ke Akun Kamu</h1>
          </header>
          <div class="container2 box">
        <div class="container-form">
            <!-- <div class="text">
                <h2><strong>Halo Magons!</strong> Selamat datang di Dramagon.<br>
                    Yuk Login!</h1>
                </div> -->
                <form action="" method="post">
                <div class="container-form">  <!--Form yang username-->
                <label for="uname">Username Magons</label><br>
                <input type="text" id="uname" name="uname" maxlength="40" value="<?php echo $_POST['uname'];?>" autofocus>
                   </div><!--/form-username-->

                   <?php echo $er_user;?> <!--kalo eror(gadiisi)-->

                <div class="container-form"> <!--Form yang password-->
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" value="<?php echo $_POST['password'];?>" maxlength="15">
                <br>
                        </div><!--/form-password-->
                   <?php echo $er_pass;?> <!--ngecek kalo password kosong-->
                <br>
                <span>Belum Punya Akun? Yuk</span>
                <a href="#">
                <span>Daftar!</span>
                </a>
                <hr>
                <button class="loginbtn" type="submit" name="login">Log In</button>
            
            </form>
        
            </div>

          </div>
        </div>
        <!--container1-->
        
        

      </div>
      <!--container-->
            <div class="container-right">
            Container Tambahan
            <br>
            Container Tambahan
            <br>
            Container Tambahan
            <br>
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
