<?php 
require 'fungsi.php';
global $conn;

session_start();
$uname = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$uname'");
$pengguna = mysqli_fetch_array($query);
if ( !isset($_SESSION["username"]) ) {
  header("Location: masuk.php");
  exit;
}

if ( isset($_POST["gantiPass"]) ) {
    if(gantiPass($_POST) == 1 ) {
        echo"<script>
            alert('Password berhasil diganti');
        </script>";
    }

    else if(gantiPass($_POST) == 0 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
            </script>";
    }

    else if(gantiPass($_POST) == 99) {
        echo "<script>
                    alert('password lama salah');
                </script>";
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
            <h1>Akun: Ubah Password</h1>
          </header>
          <div class="container bg">
        
        <div class="container form left">
              <div class="text">
                <h2>Ubah password kamu dengan mengisi password lama. Dan masukan password baru kamu!</h2>
              </div>
            <form action ="" method="post">
                
                <input type="hidden" name="id_pengguna" value="<?= $pengguna["id_pengguna"]; ?>">
                <label for="passwordLama">Password Lama</label><br>
                <input type="password" id="passwordLama" name="passwordLama"><br>

                <label for="passwordBaru">Password Baru</label><br>
                <input type="password" id="passwordBaru" name="passwordBaru"><br>

                <label for="konfirmPass">Konfirmasi Password Baru</label><br>
                <input type="password" id="konfirmPass" name="konfirmPass"><br>
         
   
                <button type="submit" class="registerbtn" name="gantiPass">Ganti Password</button>
    
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