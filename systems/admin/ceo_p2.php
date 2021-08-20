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
              <li class="breadcrumb-item active">การเข้าพัก</li>
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
                            <th class="text-center" style="width: 10%">หมายเลขห้องพัก</th>
                            <th class="text-center" style="width: 10%">เช็คอิน</th>
                            <th class="text-center" style="width: 10%">เช้คเอาท์</th>
                            <th class="text-center" style="width: 10%">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $select = $conn->prepare("SELECT rs.*, t.name AS t_name FROM reserve rs inner join type t On t.t_id = rs.t_id WHERE rs.status >= 2");
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
                            <td><?= $row['t_name']; ?></td>
                            <td class="text-center"><?= $row['number']; ?></td>
                            <td class="text-center">
                                <?php while ($row_r = $select_r->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <?= $row_r['name']; ?>,
                                <?php } ?>
                            </td>
                            <td class="text-center"><?= DateThai($row['check_in']); ?></td>
                            <td class="text-center"><?= DateThai($row['check_out']); ?></td>
                            <td class="text-center">
                                <?php if($row['status'] === '2'){ ?><span class="badge badge-success">check in</span><?php } ?>
                                <?php if($row['status'] === '3'){ ?><span class="badge badge-danger">check out</span><?php } ?>
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
    