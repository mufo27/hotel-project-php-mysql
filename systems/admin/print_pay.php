<?php 
		require_once '../../database/con_db.php'; 
        
        if(isset($_GET['print_pay'])){

            $rs_id = $_GET['print_pay'];
            $pm_id = $_GET['pm_id'];
    
            $select = $conn->prepare("SELECT rs.*, t.name, t.price, pr.name AS pr_name, pr.discount FROM reserve rs inner join type t ON t.t_id = rs.t_id inner join promotion pr ON pr.pr_id = rs.pr_id WHERE rs_id = :rs_id ");
            $select->bindParam(':rs_id' ,  $rs_id);
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
              <li class="breadcrumb-item active">ออกใบเสร็จค่าห้องพัก</li>
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
                    ใบเสร็จค่าห้องพัก
                    <br>
                    วันที่ <?= DateThai(date("Y-m-d")) ;?>
                    </h4>
                </div>
              </div>
        
              <hr>

              <div class="row mt-5">
                <div class="col-4">
                  <p class="lead">เลขที่การจอง : <?= $row['rs_id']; ?></p>
                </div>
                <div class="col-4">
                  <p class="lead">วันที่จอง : <?= $row['date_reserve']; ?></p>
                </div>
                <div class="col-4">
                  <p class="lead">ลูกค้า : <?= $row['ad_name']; ?></p>
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
              
              <hr>
              
              <div class="row mt-5">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">ประเภทห้องพัก</th>
                                    <td class="text-right"><?= $row['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>ราคา</th>
                                    <td class="text-right"><?= $row['price']; ?> บาท</td>
                                </tr>
                                <tr>
                                    <th>จำนวนห้อง</th>
                                    <td class="text-right"><?= $row['number']; ?> ห้อง</td>
                                </tr>
                                <tr>
                                    <th>จำนวนวันที่พัก</th>
                                    <td class="text-right"><?= $row['d_number']; ?></td>
                                </tr>
                                <tr>
                                    <th>check in</th>
                                    <td class="text-right"><?= Datethai($row['check_in']); ?></td>
                                </tr>
                                <tr>
                                    <th>check out</th>
                                    <td class="text-right"><?= Datethai($row['check_out']); ?> วัน</td>
                                </tr>
                                <?php if(isset($row['pr_id'])) { ?> 
                                <tr>
                                    <th>โปรโมชั่น <?= $row['pr_name']; ?></th>
                                    <td class="text-right">
                                        ส่วนลด <?= $row['discount']; ?> บาท
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th>รวมยอดชำระทั้งหมด</th>
                                    <td class="text-right"><?= $row['total']; ?> ห้อง</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>

     
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