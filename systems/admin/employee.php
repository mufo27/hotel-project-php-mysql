<?php 
		require_once '../../database/con_db.php';        
    
    if(isset($_GET['employee'])){

      $status = $_GET['employee'];

      if($status == '0'){

          $show = 'ผู้ดูแลระบบ';

      } else if($status == '1'){

          $show = 'ผู้บริหาร';

      } else if($status == '2'){

          $show = 'พนักงานต้อนรับ';

      } else if($status == '3'){

          $show = 'แม่บ้าน';

      } else if ($status == '4'){

          $show = 'ฝ่ายโภชนาการ';

      } else {

          $show = 'error';

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
              <li class="breadcrumb-item active">พนักงาน / <?= $show; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <?php if($_SESSION['status'] == '0'){ ?>
            <a href="index.php?employee_add=<?= $status; ?>" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>
            <?php } ?>
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
                      <th class="text-center" style="width: 10%">รหัสพนักงาน</th>
                      <th style="width: 10%">ชื่อผู้ใช้งาน</th>
                      <th style="width: 10%">รหัสผ่าน</th> 
                      <th style="width: 20%">ชื่อ-สกุล</th>
                      <th style="width: 15%">E-mail</th>
                      <th class="text-center" style="width: 10%">เบอร์โทร</th>
                      <th class="text-center" style="width: 10%">ตำแหน่ง</th>
                      <?php if($_SESSION['status'] == '0'){ ?>
                      <th class="text-center" style="width: 10%"></th>
                      <?php } ?>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $select = $conn->prepare("SELECT * FROM employee WHERE status = :status ");
                    $select->bindParam(':status' ,  $status);
                    $select->execute();

                    $i = 1;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                    {               
                ?>
                  <tr>
                      <td class="text-center"><?= $i++?></td>
                      <td class="text-center"><?= $row['em_id']; ?></td>
                      <td><?= $row['username']; ?></td>
                      <td><?= $row['password']; ?></td>
                      <td><?= $row['f_name']; ?></td>
                      <td><?= $row['email']; ?></td>
                      <td class="text-center"><?= $row['phone']; ?></td>
                      <td class="text-center">
                          <?php if($row['status'] == '0') { ?><span class="badge badge-success">ผู้ดูแลระบบ</span><?php } ?>
                          <?php if($row['status'] == '1') { ?><span class="badge badge-primary">ผู้บริหาร</span><?php } ?>
                          <?php if($row['status'] == '2') { ?><span class="badge badge-info">พนักงานต้อนรับ</span><?php } ?>
                          <?php if($row['status'] == '3') { ?><span class="badge badge-warning">แม่บ้าน</span><?php } ?>
                          <?php if($row['status'] == '4') { ?><span class="badge badge-danger">ฝ่ายโภชนาการ</span><?php } ?>
                      </td>
                      <?php if($_SESSION['status'] == '0'){ ?>
                      <td class="text-center">
                          <a href="index.php?employee_edit=<?= $row['em_id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                          <a href="index.php?employee_del=<?= $row['em_id']; ?>&status=<?= $status; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                      </td>
                      <?php } ?>
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
    