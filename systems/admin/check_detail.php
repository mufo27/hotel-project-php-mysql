<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['check_detail'])){

        $rs_id = $_GET['check_detail'];

        $select = $conn->prepare("SELECT rs.*, t.name, t.price FROM reserve rs inner join type t ON t.t_id = rs.t_id WHERE rs_id = :rs_id ");
        $select->bindParam(':rs_id' ,  $rs_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

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
              <li class="breadcrumb-item">การจองห้องพัก</li>
              <li class="breadcrumb-item active">ดูเพิ่มเติม</li>
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
                  <h2>วันที่จอง : <?= Datethai1($row['date_reserve']);?></h2>
                  <h2>เลขที่การจอง : <?= $row['rs_id'];?></h2>
                  <h2>ชื่อผู้เข้าพัก : <?= $row['ad_name'];?></h2>
                  <h2>ประเภท :  <?= $row['name'];?></h2>
                  <h2>ราคา :  <?= $row['price'];?> บาท</h2>
                  <h2>จำนวน :  <?= $row['number'];?> ห้อง</h2>
                  <h2>ยอดชำระ :  <?= $row['total'];?> บาท</h2>
                  <h2>check in : <?= Datethai($row['check_in']);?></h2>
                  <h2>check out : <?= Datethai($row['check_in']);?></h2>
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
    