    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.html">Home</a></li>
            <li>ข่าวสารประชาสัมพันธ์</li>
            </ol>

        </div>
    </section>  

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="section-title">
          <h2>ข่าวสารประชาสัมพันธ์</h2>
        </div>

        <?php

              require_once 'database/con_db.php';  

              $select = $conn->prepare("SELECT * FROM news");
              $select->execute();

              while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
              {   
        ?>

        <div class="portfolio-info">
          <div class="row gy-4">

            <div class="col-lg-8">
                <div class="swiper-slide swiper-slide-prev">
                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" width="800" height="450"/>'; ?>
                </div>
            </div>

            <div class="col-lg-4">           
              <div class="portfolio-description">
                <h2>หัวข้อข่าว : <?= $row['name']; ?></h2>
                <h5>รายละเอียด :</h5>
                <p><?= $row['detail']; ?></p>
              </div>
            </div>

          </div>
        </div>

            <br>
            <hr> 
            <br>

        <?php
              }
        ?>

      </div>
    </section>

    