<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="index.php">โรงแรมธาราบีส<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php?home">Home</a></li>
          <li><a class="nav-link scrollto " href="index.php?type">ห้องพัก</a></li>
          <li><a class="nav-link scrollto" href="index.php?news">ข่าวสารประชาสัมพันธ์</a></li>
          <li><a class="nav-link scrollto " href="index.php?promotion">โปรโมชั่น</a></li>
          

          <?php if(isset($_SESSION['status'])){?>

          <li class="dropdown"><a href="#"><span>บัญชี <?= $_SESSION['f_name']; ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="index.php?m_profile">ข้อมูลส่วนตัว</a></li>
              <li><a href="index.php?m_reserve">รายการจองห้องพัก</a></li>
              <li><a href="index.php?m_food">รายการอาหาร</a></li>
            </ul>
          </li>
          
          <?php } ?>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <?php if(isset($_SESSION['status'])){?>

        <a href="logout.php" class="get-started-btn1 scrollto">ออกจากระบบ</a>
        
      <?php } else {?>

        <a href="index.php?login" class="get-started-btn scrollto">เข้าสู่ระบบ</a>
        <a href="index.php?register" class="get-started-btn1 scrollto">สมัครสมาชิก</a>

      <?php } ?>

    </div>
  </header><!-- End Header -->