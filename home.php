<section id="hero" class="d-flex align-items-center">

    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <div class="row text-center">
        <div class="col-xl-12">
          <h1>ยินดีต้อน <?php if(isset($_SESSION['status'])){?>สมาชิก คุณ : <?= $_SESSION['f_name']; ?> <?php } ?></h1>
          <h1>เข้าสู่เว็บไซต์โรงแรมธาราบีส</h1>
          <a href="index.php?type" class="btn-get-started scrollto">จองห้องทันที</a>
        </div>
      </div>
    </div>

  </section>