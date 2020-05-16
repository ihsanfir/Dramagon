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

              <select class="category">
                <option value="semua">Semua</option>
                <option value="info">informasi</option>
                <option value="forum">forum</option>
              </select>

            </div>

            <div class="container list">
                <ul class="listView">
                  <header class="kategori">
                    <box>
                      <h1>Semua</h1>
                    </box>
                  </header>

                    <li class="item" >
                      <a href="forumPage.html">
                        <div class="title">
                          <h1>
                            Warung yang enak dan murah di Balio
                        </div>
                       <div class="approving">
                           <button class="ok">
                            Ok
                           </button>
                           <button class="erase">
                            Hapus
                           </button>
                       </div>
                      </a>
                    </li>

                    
                  
                </ul>
            </div>
            <!--container list end-->
        </div>
        <!--container1 end-->
        
        <!---pagination-->
        <div class="container pagi">
          <div class="pagination">
            <a href="#">&laquo;</a>
            <a class="active" href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a>
          </div>
      </div>

      </div>

      <!--container giant-->
        <div class="container-right">
              <header>
                <div class="redDec"></div>
                <h1>APPROVE?</h1>
              </header>
           
            <a href="forumCreate.html">
            <button>
               YES
            </button>
          </a>
        </div>
          <!--container-right end-->

  


    </div>
    <!--wrapper end-->

  <div class="red-bot"></div>

</body>
</html>