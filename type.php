<?php

    require_once 'database/con_db.php';  

?>



    <section class="breadcrumbs">
        <div class="container">

            <ol>
              <li><a href="index.php">Home</a></li>
              <li>ห้องพัก</li></li>
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
									  $select = $conn->prepare("SELECT * FROM type WHERE name LIKE '%$name%' ");
                    $select->execute();

								} else {

              
                    if($_GET['type'] >= '1'){

                      $select = $conn->prepare("SELECT * FROM type WHERE t_id = :t_id");
                      $select->bindParam(':t_id' , $_GET['type']);
                      $select->execute();

                    } else {

                      $select = $conn->prepare("SELECT * FROM type");
                      $select->execute();
                      
                    }
              }

                while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                {
                    $check = $row['t_id'];
                    $sql = "SELECT count(*) FROM room WHERE t_id = '$check' AND status = 0 ";
                    $res = $conn->query($sql);
                    $count = $res->fetchColumn();

                    $select_img = $conn->prepare("SELECT * FROM images WHERE t_id = :t_id");
                    $select_img->bindParam(':t_id' ,  $check);
                    $select_img->execute();
                    $row_img = $select_img->fetch(PDO::FETCH_ASSOC);
            ?>
            <article class="entry">

              <div class="entry-img">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_img['img']).'" alt="" class="img-fluid"/>'; ?>

              </div>
              

              <h2 class="entry-title"><?= $row['name']; ?></h2>

              <p><?= $row['detail']; ?></p>

              <div class="row text-end">
                  <p class="text-danger">เหลืออีก <?= $count; ?> ห้อง!</p>            
              </div>

              <div class="row">

                <div class="col-6">
                  <a href="index.php?type_detail=<?= $row['t_id']; ?>" class="btn btn-success"> ดูเพิ่มเติม</a>
                </div>

                <div class="col-6 text-end">

                  <?php if(isset($_SESSION['status'])){?>

                    <a href="index.php?m_broom=<?= $row['t_id']; ?>" class="btn btn-warning">เลือกทันที</a>

                  <?php } else { ?>

                    <a href="index.php?login" class="btn btn-warning">เลือกทันที</a>

                  <?php } ?>
                     
                </div>

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

              <h3 class="sidebar-title">ประเภทห้องพัก</h3>
              <div class="sidebar-item categories">
                <ul>

                  <li><a href="?type"> ดูทั้งหมด</a></li>

                  <?php
                
                      $select_t = $conn->prepare("SELECT * FROM type");
                      $select_t->execute();

                      while ($row_t = $select_t->fetch(PDO::FETCH_ASSOC)) 
                      {
                  ?>

                  <li><a href="?type=<?= $row_t['t_id'];?>"> <?= $row_t['name'];?></a></li>
                  
                  <?php
                    }
                  ?>

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

