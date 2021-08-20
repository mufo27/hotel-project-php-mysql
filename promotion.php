<?php

    require_once 'database/con_db.php';  

?>



    <section class="breadcrumbs">
        <div class="container">

            <ol>
              <li><a href="index.php">Home</a></li>
              <li>โปรโมชั่น</li></li>
            </ol>

        </div>
    </section>    


    <section id="blog" class="blog">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <?php
                
								if(isset($_POST['name'])){

										$name = $_POST['name'];
									  $select = $conn->prepare("SELECT * FROM promotion WHERE name LIKE '%$name%' ");
                    $select->execute();

								} else {


                      $select = $conn->prepare("SELECT * FROM promotion");
                      $select->execute();
                      
                    
              }

                while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                {
                    
            ?>
            <article class="entry">

              <div class="entry-img">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" alt="" class="img-fluid"/>'; ?>
              </div>
              
              <div class="row">
                <h2><?= $row['name']; ?></h2>
                <h5><?= $row['detail']; ?></h5>
                <h3 class="text-primary">รับส่วนลด <?= $row['discount']; ?> บาท</h3>
                </div>

              <div class="row text-center">
                  <h4 class="text-danger">เริ่มวันที่ <?= DateThai($row['d_start']); ?> - <?= DateThai($row['d_stop']); ?></h4>            
              </div>

            </article>

            <?php
              }
            ?>


          </div>

          <div class="col-lg-4">
            <div class="sidebar">
              <h3 class="sidebar-title">ค้นหา</h3>
              <div class="sidebar-item search-form">
                <form action="" method="post">
                  <input type="text" name="name">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div>
              <div class="sidebar-item categories">
                <ul>
                  <li><a href="?promotion"><h5 class="text-primary">ดูทั้งหมด</h5></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

            <div class="row mt-5">  
                <div class="col-10"></div>
                <div class="col-2">
                    <a href="index.php?home" class="btn btn-primary">ย้อนกลับไป.. ก่อนหน้านี้</a>                                   
                </div>
            </div>
      </div>
    </section>

