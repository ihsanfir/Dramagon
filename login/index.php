<?php
//mengabaikan error yang muncul pada browser
error_reporting(0);
//sesi dimulai
session_start();
//panggil koneksi.php untuk menghubungkan ke database
include "functions.php";



// function input terdapat di file koneksi.php

 $username = mysqli_real_escape_string($conect, $_POST['username']);
 $pass = mysqli_real_escape_string($conect, $_POST['password']);
 $pass_md5= md5($pass);

  if(isset($_POST['login'])){
    if($username == ""){
    $er_user="<div class='alert alert-warning alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>
    <strong>Username Kosong !</strong> <br> Username harus diisi</div>";
    }
    elseif($pass == ""){
    $er_pass="<div class='alert alert-warning alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span></button>
    <strong>Password Kosong !</strong> <br> Isikan Password</div>";
    }
    else{
    //cek apakah user terdaftar atau tidak di database
    $sql_cek=mysqli_query($conect, "SELECT * FROM user where username='$username' and password='$pass_md5'");
    $cek_user=mysqli_num_rows($sql_cek);
    if($cek_user == "0"){
        //jika username dan password tidak terdaftar di database
    $er_user="<div class='alert alert-danger alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button><strong>Login Gagal !</strong> <br>Username dan Password tidak valid</div>";
    }
    else{

        //jika username dan password terdaftar di database maka akan menuju halaman home.php
    //$_SESSION['data_admin']=$username;
    echo "<script>alert('Welcome Magons! !');document.location='home.php'</script>";

     }
   }
 }
  if(isset($_POST['register'])){
 	echo "<script>alert('Please Register !');document.location='registrasi.php'</script>";
 }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="<?php echo $iweb['katakunci'];?>">
        <meta name="description" content="<?php echo $iweb['deskripsi'];?>" />
        <meta name="author" content="<?php echo $iweb['pembuat'];?>">
        <title><?php echo $iweb['nama_website'];?></title>
        <link rel="Shortcut Icon" href="<?php echo $hostname;?>/assets/images/logo/<?php echo $iweb['logo'];?>" type="image/x-icon" />
        <!-- Bootstrap core CSS -->
        <link href="<?php echo $hostname;?>/assets/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles template ini-->
        <link href="<?php echo $hostname;?>/assets/css/style_admin.css" rel="stylesheet">
        <!-- Custom Fonts Awesome-->
        <link href="<?php echo $hostname;?>/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
    <div class="container"> <!-- start container -->
         <div class="row"><!-- start row -->
              <div class="col-lg-12"><!-- start col lg 12-->
                   <div class="login"><!-- start class login -->
                        <h1><i class="fa fa-key fa-fw"></i> LOGIN TO DRAMAGON</h1>
                   <hr>

                   <!-- start form login -->
                   <form action="" method="post">
                   <div class="form-group"><!--start form-group-->
                        <label>Username</label>
                        <div class="input-group input-group-sm"><span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                        <input type="text" name="username" placeholder="Username" class="form-control" maxlength="40" value="<?php echo $_POST['username'];?>" autofocus>
                        </div>
                   </div><!--/form-group-->

                   <?php echo $er_user;?>

                   <div class="form-group"><!--start form-group-->
                        <label>Password</label>
                        <div class="input-group  input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span><input id="pass1" type="password" name="password" placeholder="Password" class="form-control" value="<?php echo $_POST['password'];?>" maxlength="15">
                        </div>
                        </div><!--/form-group-->
                   <?php echo $er_pass;?>

                   <hr>
                   <button class="btn btn-primary btn-sm btn-block" type="submit" name="login">Log In</button>
                   <hr>
                   <button class="btn btn-primary btn-sm btn-block" type="submit" name="register">Register</button>
                   </form>
                   <!-- end form login -->
		</div><!-- end class login -->
	</div><!-- end col lg 12 -->
 </div><!-- end row -->
</div><!-- end container -->

        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo $hostname;?>/assets/js/jquery.min.js"></script>
        <script src="<?php echo $hostname;?>/assets/js/bootstrap.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo $hostname;?>/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>