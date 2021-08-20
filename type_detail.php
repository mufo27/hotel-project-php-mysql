<?php 
    require_once 'database/con_db.php';

    if(isset($_GET['type_detail'])){

        $t_id = $_GET['type_detail'];

        $select = $conn->prepare("SELECT t.*, vo.link_youtube FROM type t inner join videos vo ON vo.t_id = t.t_id WHERE t.t_id = :t_id ");
        $select->bindParam(':t_id' ,  $t_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
    }
?>

    
    <section class="breadcrumbs">
        <div class="container">

            <ol>
              <li><a href="index.html">Home</a></li>
              <li>ห้องพัก</li>
              <li>ดูเพิ่มเติม</li>
            </ol>

        </div>
    </section>    


    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="portfolio-info">

          <div class="row text-center">
              <h1><B>รูปภาพห้องพัก ทั้งหมด</B></h1>
              <?php
                    $select_img = $conn->prepare("SELECT * FROM images WHERE t_id = :t_id");
                    $select_img->bindParam(':t_id' , $row['t_id']);
                    $select_img->execute();
                    while($row_img = $select_img->fetch(PDO::FETCH_ASSOC))
                    {
              ?>         
              <div class="col-lg-4 mt-5">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_img['img']).'" width="400" height="250"/>'; ?> 
              </div>
              <?php
                    }
              ?>
          </div>

          <hr>

          <div class="row mt-5 text-center">
              <h1><B>วิดีโอ</B></h1>
            <div class="col">
              <iframe width="850" height="450" src="https://www.youtube.com/embed/<?= $row['link_youtube']; ?>"></iframe>
            </div>
          </div>

          <hr>

          <div class="row mt-5">
            <div class="col-lg-12">
                <h1><?= $row['name']?></h1>
                <h3><strong>ราคา : </strong> <?= $row['price']; ?> บาท/คืน</h3>
                <h3><strong>รายละเอียด : </strong> <?= $row['detail']?></h3>
            </div>
          </div>

        </div>

        <div class="row mt-5">  
          <div class="col-10"></div>
          <div class="col-2">
              <a href="index.php?type" class="btn btn-primary">ย้อนกลับไป.. ก่อนหน้านี้</a>                                   
          </div>
        </div>

      </div>
    </section>