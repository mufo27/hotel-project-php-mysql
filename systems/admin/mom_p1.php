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
              <li class="breadcrumb-item active">การจองห้องพัก</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
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
                            <th class="text-center" style="width: 10%">เลขที่การจอง</th> 
                            <th style="width: 10%">ชื่อผู้เข้าพัก</th>
                            <th style="width: 10%">ประเภทห้องพัก</th>
                            <th class="text-center" style="width: 10%">จำนวน/ห้อง</th>
                            <th class="text-center" style="width: 10%">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $select = $conn->prepare("SELECT rs.*, t.name AS t_name, t.price FROM reserve rs inner join type t On t.t_id = rs.t_id WHERE status <= 1");
                            $select->execute();

                            $i = 1;
                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                            {      
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++?></td>
                            <td class="text-center"><?= $row['rs_id']; ?></td>
                            <td><?= $row['ad_name']; ?></td>
                            <td><?= $row['t_name']; ?></td>
                            <td class="text-center"><?= $row['number']; ?></td>
                            <td class="text-center">
                                <?php if($row['status'] === '0'){ ?><span class="badge badge-warning">รอการตรวจสอบ</span><?php } ?>
                                <?php if($row['status'] === '1'){ ?><span class="badge badge-primary">ยืนยันการจอง</span><?php } ?>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                
                </div>
            </div>
          </div>

      </div>
      

    </section>
    