 <!--sidebar-->
 <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="border">
          <div class="sidebar-brand">
            <img src="..\img\logo.png">
          </div>
      </div>
      <div class="border">
        <div class="sidebar-header">
          <div class="user-pic">
          <?php 
            if($pengguna["gambar"] != NULL) {
              echo '<img src="data:image/jpeg;base64,'.base64_encode( $pengguna['gambar'] ).'"/>'; 
            } else {
              echo '<img src="..\img\user.jpg"/>';
            }
          ?>
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
                echo "<a href='akun.php'>" . $_SESSION["username"] . "</a>";
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
            <span class="logout"><a href="logout.php">Keluar</a></span>
          </div>
        </div>
      </div>
        <!-- sidebar-header  -->
        <form action="search_page.php" method="post">
        <div class="border">
          <div class="sidebar-search">
            <div>
                <input type="search" placeholder="Cari..." name="keyword">
                <button type="submit" name="cari">
                  <img src="..\img\search.png">
                </button>
            </div>
          </div>
        </div>
        </form>
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
              <a href="info_list.php">
                <span>Informasi</span>
              </a>
            </li>
            
            <li class="sidebar-list">
              <a href="forum_list.php">
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