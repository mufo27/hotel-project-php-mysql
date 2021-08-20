<?php 
		require_once '../../database/con_db.php'; 
        
        if(isset($_GET['print_food'])){

            $of_id = $_GET['print_food'];
            $pm_id = $_GET['pm_id'];
    
            $select = $conn->prepare("SELECT of.*, r.name FROM order_food of inner join room r ON r.r_id = of.r_id WHERE of_id = :of_id ");
            $select->bindParam(':of_id' ,  $of_id);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC);

            $select_pm = $conn->prepare("SELECT * FROM payment WHERE pm_id = :pm_id ");
            $select_pm->bindParam(':pm_id' ,  $pm_id);
            $select_pm->execute();
            $row_pm = $select_pm->fetch(PDO::FETCH_ASSOC);

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
              <li class="breadcrumb-item active">ออกใบเสร็จค่าอาหาร</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-6">
                  <h4>
                    <b>โรงแรมธาราบีส</b>
                    <br>
                    ที่อยู่ เลขที่ 64 ถ.ทหาร อ.เมือง จ.อุดรธานี 
                    <br>
                    รหัสไปรษณีย์ 41000
                  </h4>
                </div>

                <div class="col-6">

                    <h4 class="float-right">
                    ออกใบเสร็จค่าอาหาร
                    <br>
                    วันที่ <?= DateThai(date("Y-m-d")) ;?>
                    </h4>
                </div>
              </div>
        
              <hr>

              <div class="row mt-5">
                <div class="col-4">
                  <p class="lead">เลขที่ใบสั่งอาหาร: <?= $row['rs_id']; ?></p>
                </div>
                <div class="col-4">
                  <p class="lead">วันที่จอง : <?= $row['d_date']; ?></p>
                </div>
                <div class="col-4">
                  <p class="lead">ห้อง : <?= $row['name']; ?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <p class="lead">เลขที่ใบชำระเงิน : <?= $row_pm['pm_id']; ?></p>
                </div>
                <div class="col-4">
                  <p class="lead">วันที่ชำระเงิน : <?= $row_pm['pm_date']; ?></p>
                </div>
                <div class="col-4">
                  <p class="lead">
                      วิธีชำระเงิน : 
                      <?php if($row_pm['status'] == '1'){ ?> ธนาคาร <?php } ?>
                      <?php if($row_pm['status'] == '2'){ ?> PAYPAL <?php } ?>
                    </p>
                </div>
              </div>
              
              <div class="row mt-5">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">ลำดับ</th>
                            <th style="width: 35%">รายการอาหาร</th>
                            <th class="text-center" style="width: 10%">ราคา</th>
                            <th class="text-center" style="width: 10%">จำนวน</th>
                            <th class="text-center" style="width: 10%">ยอดรวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $select_ofd = $conn->prepare("SELECT ofd.*, f.name, f.price FROM of_detail ofd inner join food f ON f.f_id = ofd.f_id WHERE of_id = :of_id ");
                            $select_ofd->bindParam(':of_id' ,  $of_id);
                            $select_ofd->execute();
                            
                            $i=1;
                            while($row_ofd = $select_ofd->fetch(PDO::FETCH_ASSOC))
                            {
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++?></td>
                            <td><?= $row_ofd['name']; ?></td>
                            <td class="text-center"><?= $row_ofd['price']; ?></td>
                            <td class="text-center"><?= $row_ofd['number']; ?></td>
                            <td class="text-center"><?= $row_ofd['sum_price']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr> 
                            <td colspan="4" class="text-right"> 
                                <h4>ยอดชำระเงิน รวมทั้งหมด</h4>
                            </td>
                            <td class="text-center"><?= $row['total']; ?></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>

              <hr>
     
              <div class="row mt-3">
                <div class="col-12  text-right">
                    <h2>ลงชื่อ : โรงแรมธาราบีส</h2>
                </div>
              </div>

              <div class="row no-print">
                <div class="col-12">
                <button type="submit" class="btn btn-success" name="back" onClick="window.print()"><i class="fas fa-print"></i> print</button>
                  
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <div class="row mt-2">
              <div class="col-10"></div>
              <div class="col-2">
                <div class="row">
                  <button type="submit" class="btn btn-danger" name="back" onclick="history.go(-1)"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button>
                </div>
              </div>
            </div>

    <div class="row mt-5"></div>