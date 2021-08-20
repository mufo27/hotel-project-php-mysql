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
              <li class="breadcrumb-item active">การชำระเงินค่าห้องพัก</li>
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
                      <th class="text-center" style="width: 10%">เลขที่ใบชำระเงิน</th>
                      <th class="text-center" style="width: 10%">เลขที่การจอง</th>
                      <th class="text-center" style="width: 10%">รวมยอดชำระ</th>
                      <th class="text-center" style="width: 10%">สถานะจอง</th>
                      <th class="text-center" style="width: 10%">วิธีชำระเงิน</th>
                      <th class="text-center" style="width: 10%">ออกใบเสร็จ</th>
                      <th class="text-center" style="width: 10%"></th>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $select = $conn->prepare("SELECT pm.*, rs.status AS rs_status FROM payment pm inner join reserve rs ON rs.rs_id = pm.rs_id ORDER BY rs.status ASC");
                    $select->execute();

                    $i = 1;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                    {               
                ?>
                  <tr>
                      <td class="text-center"><?= $i++?></td>
                      <td class="text-center"><?= $row['pm_id']; ?></td>
                      <td class="text-center"><?= $row['rs_id']; ?></td>
                      <td class="text-center"><?= $row['total']; ?></td>
                      <td class="text-center">
                          <?php if($row['rs_status'] == '0') { ?><span class="badge badge-warning">รอการตรวจสอบ</span><?php } ?>
                          <?php if($row['rs_status'] == '1') { ?><span class="badge badge-primary">ยืนยันการจอง</span><?php } ?>
                          <?php if($row['rs_status'] == '2') { ?><span class="badge badge-success">เข้าพักแล้ว</span><?php } ?>
                      </td>
                      <td class="text-center">
                          <?php if($row['rs_status'] == '0' AND $row['status'] >= '1') { ?><a href="index.php?check_pay=<?= $row['rs_id'];?>"><span class="badge badge-warning">คลิก..!! ตรวจสอบหลักฐาน</span></a><?php } ?>
                          <?php if($row['rs_status'] >= '1' AND $row['status'] == '1') { ?><span class="badge badge-success">ธนาคาร</span><?php } ?>
                          <?php if($row['rs_status'] >= '1' AND $row['status'] == '2') { ?><span class="badge badge-primary">PAYPAL</span><?php } ?>
                      </td>
                      <td class="text-center">
                      <?php if($row['rs_status'] >= '1') { ?><a href="index.php?print_pay=<?= $row['rs_id']; ?>&pm_id=<?= $row['pm_id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-file-pdf"></i> Print PDF</a><?php } ?>
                      </td>
                      <td class="text-center">
                        <form action="" method="post" enctype="multipart/form-data">
                          <?php if($row['rs_status'] === '0'){ ?><button class="btn bg-primary btn-sm" type="submit" name="ok" value="<?= $row['rs_id']; ?>"><i class="fas fa-check"></i> ยืนยันการชำระเงิน</button><?php } ?>
                          <?php if($row['rs_status'] >= '1'){ ?><button class="btn bg-danger btn-sm" type="submit" name="cancel" value="<?= $row['rs_id']; ?>"><i class="fas fa-times"></i> ยกเลิกการชำระเงิน</button><?php } ?>
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

            $rs_id    =  $_POST['ok'];
            $status   =  1;

            try {

                $update = $conn->prepare("UPDATE reserve SET status = :status WHERE rs_id = :rs_id");
                $update->bindParam(':rs_id'  , $rs_id);
                $update->bindParam(':status' , $status);

                if ($update->execute()) {
                    
                    echo "<script>alert('ยืนยันการชำระเงิน เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p4\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

        if (isset($_POST['cancel'])) {

            $rs_id    =  $_POST['cancel'];
            $status   =  0;

            try {

                $update = $conn->prepare("UPDATE reserve SET status = :status WHERE rs_id = :rs_id");
                $update->bindParam(':rs_id'  , $rs_id);
                $update->bindParam(':status' , $status);

                if ($update->execute()) {
                    
                    echo "<script>alert('ยกเลิกการชำระเงิน เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p4\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>
    