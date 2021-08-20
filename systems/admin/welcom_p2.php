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
              <li class="breadcrumb-item active">การจองห้องพัก (เอเจนซี่)</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
        <a href="index.php?welcom_p2_add" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>

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
                      <th class="text-center" style="width: 10%">เลขที่การจอง</th>
                      <th style="width: 10%">ชื่อผู้เข้าพัก</th>
                      <th style="width: 10%">ประเภท</th>
                      <th class="text-center" style="width: 7%">จำนวนห้อง</th>
                      <th class="text-center" style="width: 10%">หมายเลขห้อง</th>
                      <th class="text-center" style="width: 5%">สถานะ</th>
                      <th class="text-center" style="width: 15%"></th>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $select = $conn->prepare("SELECT rs.*, t.name , t.price, pm.status AS pm_status FROM reserve rs inner join type t ON rs.t_id = t.t_id  inner join payment pm ON pm.rs_id = rs.rs_id ORDER BY rs.status ASC");
                    $select->execute();

                    $i = 1;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                    {               
                      $select_r = $conn->prepare("SELECT * FROM room WHERE rs_id = :rs_id");
                      $select_r->bindParam("rs_id"   , $row['rs_id']);
                      $select_r->execute();
                ?>
                  <tr>
                      <td class="text-center"><?= $i++?></td>
                      <td class="text-center"><?= $row['rs_id']; ?></td>
                      <td><?= $row['ad_name']; ?></td>
                      <td><?= $row['name']; ?></td>
                      <td class="text-center"><?= $row['number']; ?></td>
                      <td class="text-center">
                          <?php while ($row_r = $select_r->fetch(PDO::FETCH_ASSOC)){ ?>
                              <?= $row_r['name']; ?> 
                          <?php } ?>
                      </td>
                      <td class="text-center">
                          <?php if($row['status'] == '0') { ?><span class="badge badge-warning">รอยืนยันชำระเงิน</span><?php } ?>
                          <?php if($row['status'] == '1') { ?><span class="badge badge-primary">จองแล้ว</span><?php } ?>
                          <?php if($row['status'] == '2') { ?><span class="badge badge-success">check in</span><?php } ?>
                          <?php if($row['status'] == '3') { ?><span class="badge badge-danger">check out</span><?php } ?>
                      </td>
                      <td class="text-center">
                          <a href="index.php?check_detail=<?= $row['rs_id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> ดูเพิ่มเติม</a>
                          <?php if($row['status'] != '0') { ?><a href="index.php?welcom_p3=<?= $row['rs_id']; ?>&number=<?= $row['number']; ?>&t_id=<?= $row['t_id']; ?>&ad_name=<?= $row['ad_name']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-hotel"></i> จัดการห้องพัก</a><?php } ?>
                      </td>    
                  </tr>
                <?php
                    }
                ?>
              </tbody>
          </table>
        </div>

      </div>


    </section>
