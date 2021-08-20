<?php 
		require_once '../../database/con_db.php';        

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
              <li class="breadcrumb-item active">การชำระเงินค่าอาหาร</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- Default box -->
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
          <table id="mytable" class="table table-striped projects">
              <thead>
                  <tr>
                      <th class="text-center" style="width: 5%">NO.</th>
                      <th class="text-center" style="width: 10%">เลขที่ใบสั่งอาหาร</th>
                      <th class="text-center" style="width: 10%">เลขที่ใบชำระเงิน</th>
                      <th class="text-center" style="width: 10%">รวมยอดชำระ</th>
                      <th class="text-center" style="width: 10%">สถานะการชำระเงิน</th>
                      <th class="text-center" style="width: 10%">วิธีชำระเงิน</th>
                      <th class="text-center" style="width: 10%">ออกใบเสร็จ</th>
                      <th class="text-center" style="width: 10%"></th>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $select = $conn->prepare("SELECT pm.*, of.total AS of_total FROM payment pm inner join order_food of ON of.of_id = pm.of_id ORDER BY pm.status ASC");
                    $select->execute();

                    $i = 1;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                    {               
                        if($row['status'] == '1'){
                          $show = 'ธนาคาร';
                        }
                        if($row['status'] == '2'){
                            $show = 'PAYPAL';
                        }
                ?>
                  <tr>
                      <td class="text-center"><?= $i++?></td>
                      <td class="text-center"><?= $row['of_id']; ?></td>
                      <td class="text-center"><?= $row['pm_id']; ?></td>
                      <td class="text-center"><?= $row['of_total']; ?></td>
                      <td class="text-center">
                          <?php if($row['status'] == '0' AND !isset($row['total'])) { ?><span class="badge badge-danger">ยังไม่ชำระเงิน</span><?php } ?>
                          <?php if($row['status'] == '0' AND isset($row['total'])) { ?><span class="badge badge-warning">รอการตรวจสอบ</span><?php } ?>
                          <?php if($row['status'] >= '1') { ?><span class="badge badge-primary">ชำระเงินแล้ว </span><?php } ?>
                      </td>
                      <td class="text-center">
                          <?php if($row['status'] == '0' AND !isset($row['total'])) { ?><span class="badge badge-danger">รอแจ้งหลักฐาน</span><?php } ?>
                          <?php if($row['status'] == '0' AND isset($row['total'])) { ?><a href="index.php?check_pay_food=<?= $row['of_id'];?>"><span class="badge badge-warning">คลิก..!! ตรวจสอบหลักฐาน</span></a><?php } ?>
                          <?php if($row['status'] == '1') { ?><a href="index.php?check_pay_food=<?= $row['of_id'];?>"><span class="badge badge-success">ธนาคาร</span></a><?php } ?>
                          <?php if($row['status'] == '2') { ?><a href="index.php?check_pay_food=<?= $row['of_id'];?>"><span class="badge badge-primary">PAYPAL</span></a><?php } ?>
                      </td>
                      <td class="text-center">
                          <?php if($row['status'] >= '1') { ?><a href="index.php?print_food=<?= $row['of_id']; ?>&pm_id=<?= $row['pm_id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> Print PDF</a><?php } ?>
                      </td>
                      <td class="text-center">
                        <form action="" method="post" enctype="multipart/form-data">
                          <?php if($row['status'] == '0' AND isset($row['total'])){ ?><button class="btn bg-primary btn-sm" type="submit" name="ok" value="<?= $row['pm_id']; ?>"><i class="fas fa-check"></i> ยืนยันการชำระเงิน</button><?php } ?>
                          <?php if($row['status'] == '1'){ ?><button class="btn bg-danger btn-sm" type="submit" name="cancel" value="<?= $row['pm_id']; ?>"><i class="fas fa-times"></i> ยกเลิกการชำระเงิน</button><?php } ?>
                        </form>
                      </td>
                  </tr>
                <?php
                    }
                ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>

<?php

        if (isset($_POST['ok'])) {

            $pm_id    =  $_POST['ok'];
            $status   =  1;

            try {

                $update = $conn->prepare("UPDATE payment SET status = :status WHERE pm_id = :pm_id");
                $update->bindParam(':pm_id'  , $pm_id);
                $update->bindParam(':status' , $status);

                if ($update->execute()) {
                    
                    echo "<script>alert('ยืนยันการชำระเงิน เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p5\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

        if (isset($_POST['cancel'])) {

            $pm_id    =  $_POST['cancel'];
            $status   =  0;

            try {

                $update = $conn->prepare("UPDATE payment SET status = :status WHERE pm_id = :pm_id");
                $update->bindParam(':pm_id'  , $pm_id);
                $update->bindParam(':status' , $status);

                if ($update->execute()) {
                    
                    echo "<script>alert('ยกเลิกการชำระเงิน เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p5\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>
    