<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['check_pay_food'])){

        $of_id = $_GET['check_pay_food'];

        $select = $conn->prepare("SELECT * FROM payment WHERE of_id = :of_id ");
        $select->bindParam(':of_id' ,  $of_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if($row['status'] === '0' OR $row['status'] === '1'){
            $show = 'ธนาคาร';
        }
        if($row['status'] === '2'){
            $show = 'PAYPAL';
        }
    }

?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">การชำระเงินค่าอาหาร</li>
              <li class="breadcrumb-item active">ตรวจสอบหลักฐาน</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-2">

        </div>
        <div class="col-8">
        <div class="card">
        <div class="card-header">

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <div class="row mt-3"></div>

        <div class="card-body p-0">
         
          <div class="row mt-5">
              <div class="col-2"></div>
              <div class="col-10">
                  <?php if(isset($row['img'])) { ?>
                    <div class="text-star">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" width="550" height="450"/>'; ?>
                    </div>
                  <?php } ?>
                  <h2 class="mt-5">เลขที่ใบสั่งอาหาร : <?= $row['of_id'];?></h2>
                  <h2>เลขที่ใบชำระเงิน : <?= $row['pm_id'];?></h2>
                  <h2>ช่องทางการชำระเงิน : <?= $show;?></h2>
                  <h2>วัน-เวลา โอนเงิน : <?= Datethai1($row['pm_date']);?></h2>
                  <h2>จำนวนเงินที่โอน : <?= $row['total'];?> บาท</h2>
              </div>
          </div>
        </div>
        <div class="row mt-5"></div>
        
      </div>
        </div>
      </div>
      <!-- /.card -->
      <div class="row mt-2">
              <div class="col-10"></div>
              <div class="col-2">
                <div class="row">
                  <button type="submit" class="btn btn-danger" name="back" onclick="history.go(-1)"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button>
                </div>
              </div>
            </div>
    </section>

    <div class="row mt-5"></div>
    