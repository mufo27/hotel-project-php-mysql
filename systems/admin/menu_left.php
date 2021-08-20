  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <?php 
          if($_SESSION['status'] == '0'){
              $show = 'ผู้ดูแลระบบ';
          } else if($_SESSION['status'] == '1'){
              $show = 'ผู้บริหาร';
          } else if($_SESSION['status'] == '2'){
              $show = 'พนักงานต้อนรับ';
          } else if($_SESSION['status'] == '3'){
              $show = 'แม่บ้าน';
          } else if($_SESSION['status'] == '4'){
              $show = 'ฝ่ายโภชนาการ';
          } else {
              $show = 'error';
          }
      ?>
      <div class="text-center">
        <h2 class="brand-text font-weight-light"><?=  $show; ?></h2>
      </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-header"><h4>MENU</h4></li>

        <li class="nav-header"></li>

        <li class="nav-item menu-open">
          <a href="index.php?dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        
        <li class="nav-header"></li>

        <li class="nav-header"><h4>จัดการข้อมูล</h4></li>

        <li class="nav-header"></li>

        <li class="nav-item">
          <a href="index.php?profile" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p class="text">ส่วนตัว</p>
          </a>
        </li>

        <?php if($_SESSION['status'] == '0' || $_SESSION['status'] == '1'){ ?>

        <?php if($_SESSION['status'] == '1'){ ?>
        <li class="nav-header"><h4>รายงานข้อมูล</h4></li>
        <?php } ?>

        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users nav-icon"></i>
              <p>
                พนักงาน
                <i class="fas fa-angle-left right text-info"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?employee=0" class="nav-link">
                    <i class="fas fa-arrow-right nav-icon"></i>
                    <p>ผู้ดูแลระบบ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?employee=1" class="nav-link">
                    <i class="fas fa-arrow-right nav-icon"></i>
                    <p>ผู้บริหาร</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?employee=2" class="nav-link">
                    <i class="fas fa-arrow-right nav-icon"></i>
                    <p>พนักงานต้อนรับ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?employee=3" class="nav-link">
                    <i class="fas fa-arrow-right nav-icon"></i>
                    <p>แม่บ้าน</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?employee=4" class="nav-link">
                    <i class="fas fa-arrow-right nav-icon"></i>
                    <p>ฝ่ายโภชนาการ</p>
                  </a>
                </li>
              </ul>

        </li>
        <?php } ?>

        <?php if($_SESSION['status'] == '0'){ ?>               
        <li class="nav-item">
          <a href="index.php?news" class="nav-link">
            <i class="nav-icon fas fa-newspaper nav-icon"></i>
            <p class="text">ข่าวสารประชาสัมพันธ์</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?promotion" class="nav-link">
            <i class="nav-icon fas fa-percentage"></i>
            <p class="text">โปรโมชั่น</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?type" class="nav-link">
            <i class="nav-icon fas fa-hotel"></i>
            <p class="text">ประเภทห้องพัก</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?room" class="nav-link">
            <i class="nav-icon fas fa-igloo"></i>
            <p class="text">ห้องพัก</p>
          </a>
        </li>
        <?php } ?>

        <?php if($_SESSION['status'] == '1'){ ?>
        <li class="nav-item">
          <a href="index.php?ceo_p1" class="nav-link">
            <i class="nav-icon fas fa-file-alt nav-icon"></i>
            <p class="text">การจองห้องพัก</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?ceo_p2" class="nav-link">
            <i class="nav-icon fas fa-file-alt nav-icon"></i>
            <p class="text">การเข้าพัก</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?ceo_p3" class="nav-link">
            <i class="nav-icon fas fa-donate nav-icon"></i>
            <p class="text">รายรับ</p>
          </a>
        </li>
        <?php } ?>

        <?php if($_SESSION['status'] == '2'){ ?>
        <li class="nav-item">
          <a href="index.php?member" class="nav-link">
            <i class="nav-icon fas fa-users nav-icon"></i>
            <p class="text">สมาชิก</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="index.php?welcom_p1" class="nav-link">
            <i class="nav-icon fas fa-list-alt nav-icon"></i>
            <p class="text">การจองห้องพัก (สมาชิก)</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="index.php?welcom_p2" class="nav-link">
            <i class="nav-icon fas fa-address-book nav-icon"></i>
            <p class="text">การจองห้องพัก (เอเจนซี่)</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="index.php?welcom_p3" class="nav-link">
            <i class="nav-icon fas fa-hotel nav-icon"></i>
            <p class="text">ห้องพัก</p>
          </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-donate nav-icon"></i>
              <p>
                การชำระเงิน
                <i class="fas fa-angle-left right text-info"></i>
              </p>
            </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?welcom_p4" class="nav-link">
                    <i class="fas fa-hotel nav-icon"></i>
                    <p>ค่าห้องพัก</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?welcom_p5" class="nav-link">
                    <i class="fas fa-hamburger nav-icon"></i>
                    <p>ค่าอาหาร</p>
                  </a>
                </li>
              </ul>
        </li>
      
        <?php } ?>

        <?php if($_SESSION['status'] == '3'){ ?>
        <li class="nav-header"><h4>รายงานชื่อลูกค้า</h4></li>

        <li class="nav-item">
          <a href="index.php?mom_p1" class="nav-link">
            <i class="nav-icon fas fa-file-alt nav-icon"></i>
            <p class="text">ที่จะเข้าพัก</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?mom_p2" class="nav-link">
            <i class="nav-icon fas fa-file-alt nav-icon"></i>
            <p class="text">ที่เข้าพักแล้ว</p>
          </a>
        </li>
        <?php } ?>

        <?php if($_SESSION['status'] == '4'){ ?>
          <li class="nav-item">
          <a href="index.php?food" class="nav-link">
            <i class="nav-icon fas fa-hamburger nav-icon"></i>
            <p class="text">เมนูอาหาร</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?food_order" class="nav-link">
            <i class="nav-icon fas fa-location-arrow nav-icon"></i>
            <p class="text">สั่งอาหาร</p>
          </a>
        </li>
        <?php } ?>


          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="../../logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
              <p class="text">ออกจากระบบ</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>