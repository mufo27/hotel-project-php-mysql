<?php 
		require_once '../../database/con_db.php';        
        $select_sum = $conn->prepare("SELECT sum(total) AS sum_all FROM payment");
        $select_sum->execute();
        $row_sum = $select_sum->fetch(PDO::FETCH_ASSOC);
        
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
              <li class="breadcrumb-item active">รายรับ</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- <div class="row">
          <div class="col-6"> -->

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
                <h3 class="text-center">สรุป รายรับทั้งหมด = <?= $row_sum['sum_all']; ?> บาท</h3>

                <div class="card-body p-0">
                <table id="mytable" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">NO.</th>
                            <th class="text-center" style="width: 10%">เลขที่ใบชำระเงิน</th>
                            <th class="text-center" style="width: 10%">เลขที่การจอง</th> 
                            <th class="text-center" style="width: 10%">วันที่ชำระเงิน</th>
                            <th class="text-center" style="width: 10%">ยอดเงินที่ชำระ</th>
                            <th class="text-center" style="width: 10%">วิธีการชำระเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $select = $conn->prepare("SELECT * FROM payment");
                            $select->execute();

                            $i = 1;
                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                            {    
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++?></td>
                            <td class="text-center"><?= $row['pm_id']; ?></td>
                            <td class="text-center"><?= $row['rs_id']; ?></td>
                            <td class="text-center"><?= DateThai1($row['pm_date']); ?></td>
                            <td class="text-center"><?= $row['total']; ?></td>
                            <td class="text-center">
                                <?php if($row['status'] === '1'){ ?><span class="badge badge-success">ธนาคาร</span><?php } ?>
                                <?php if($row['status'] === '2'){ ?><span class="badge badge-primary">PAYPAL</span><?php } ?>
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

          <!-- <div class="col-6">
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
                <h3 class="text-center">สรุป รายรับค่าอาหาร= <?= $row_sum['sum_all']; ?> บาท</h3>

                <div class="card-body p-0">
                <table id="mytable2" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">NO.</th>
                            <th class="text-center" style="width: 10%">เลขที่ใบชำระเงิน</th>
                            <th class="text-center" style="width: 10%">เลขที่การจอง</th> 
                            <th class="text-center" style="width: 10%">วันที่ชำระเงิน</th>
                            <th class="text-center" style="width: 10%">ยอดเงินที่ชำระ</th>
                            <th class="text-center" style="width: 10%">วิธีการชำระเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $select = $conn->prepare("SELECT * FROM payment");
                            $select->execute();

                            $i = 1;
                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                            {      
                                $sum = 0;
                                $sum += $row['total'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++?></td>
                            <td class="text-center"><?= $row['pm_id']; ?></td>
                            <td class="text-center"><?= $row['rs_id']; ?></td>
                            <td class="text-center"><?= DateThai($row['pm_date']); ?></td>
                            <td class="text-center"><?= $row['total']; ?></td>
                            <td class="text-center">
                                <?php if($row['status'] === '1'){ ?><span class="badge badge-success">ธนาคาร</span><?php } ?>
                                <?php if($row['status'] === '2'){ ?><span class="badge badge-primary">PAYPAL</span><?php } ?>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                
                </div>
            </div>
          </div> -->
      </div>
      

    </section>
    