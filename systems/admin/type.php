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
              <li class="breadcrumb-item active">ประเภทห้องพัก</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
            <a href="index.php?type_add" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> เพิ่มข้อมูล</a>

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
                      <th class="text-center" style="width: 10%">วิดีโอ</th>
                      <th class="text-center" style="width: 15%">รูปภาพ</th>
                      <th style="width: 20%">ประเภทห้องพัก</th>
                      <th style="width: 20%">รายละเอียด</th>
                      <th class="text-center" style="width: 10%">ราคา/คืน</th>
                      <th class="text-center" style="width: 10%">จำนวนห้องพัก</th>
                      <th class="text-center" style="width: 10%"></th>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $select = $conn->prepare("SELECT t.*, vo.link_youtube FROM type t inner join videos vo ON vo.t_id = t.t_id");
                    $select->execute();

                    $i = 1;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                    {             
                      $check = $row['t_id'];
                      $sql = "SELECT count(*) FROM room WHERE t_id = '$check' ";
                      $res = $conn->query($sql);
                      $count = $res->fetchColumn();  

                ?>
                  <tr>
                      <td class="text-center"><?= $i++?></td>
                      <td class="text-center">
                          <iframe width="200" height="100"
                            src="https://www.youtube.com/embed/<?= $row['link_youtube']; ?>">
                          </iframe>
                      </td> 
                      <td class="text-center">
                          <a href="index.php?type_img=<?= $row['t_id']?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"> ดูรูปภาพ</i></a>                      
                      </td>
                      <td><?= $row['name']; ?></td>
                      <td><?= $row['detail']; ?></td>
                      <td class="text-center"><?= $row['price']; ?></td>
                      <td class="text-center"><?= $count; ?></td>
                      <td class="text-center">
                          <a href="index.php?type_edit=<?= $row['t_id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                          <a href="index.php?type_del=<?= $row['t_id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
    