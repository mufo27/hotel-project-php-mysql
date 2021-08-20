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
              <li class="breadcrumb-item active">สมาชิก</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
            <a href="index.php?member_add" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>

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
                      <th class="text-center" style="width: 10%">รหัสสมาชิก</th>
                      <th style="width: 10%">ชื่อผู้ใช้งาน</th>
                      <th style="width: 10%">รหัสผ่าน</th> 
                      <th style="width: 20%">ชื่อ-สกุล</th>
                      <th style="width: 15%">E-mail</th>
                      <th class="text-center" style="width: 10%">เบอร์โทร</th>
                      <th class="text-center" style="width: 10%"></th>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $select = $conn->prepare("SELECT * FROM members");
                    $select->execute();

                    $i = 1;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                    {               
                ?>
                  <tr>
                      <td class="text-center"><?= $i++?></td>
                      <td class="text-center"><?= $row['m_id']; ?></td>
                      <td><?= $row['username']; ?></td>
                      <td><?= $row['password']; ?></td>
                      <td><?= $row['f_name']; ?></td>
                      <td><?= $row['email']; ?></td>
                      <td class="text-center"><?= $row['phone']; ?></td>
                      <td class="text-center">
                          <a href="index.php?member_edit=<?= $row['m_id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                          <a href="index.php?member_del=<?= $row['m_id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
    