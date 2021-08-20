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
              <li class="breadcrumb-item active">สั่งซื้ออาหาร</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
            <a href="index.php?food_order_add&act=add" class="btn btn-success btn-lg"><i class="fas fa-location-arrow"></i> สั่งอาหาร</a>

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
                      <th class="text-center" style="width: 10%"></th>
                      <th class="text-center" style="width: 10%">หมายเลขห้อง</th>
                      <th class="text-center" style="width: 10%">เลขที่สั่งอาหาร</th>
                      <th class="text-center" style="width: 10%">วันที่สั่งอาหาร</th>
                      <th class="text-center" style="width: 10%">ยอดชำระทั้งหมด</th>
                      <th class="text-center" style="width: 10%"></th>
                  </tr>
              </thead>
              <tbody>
                <?php

                    $select = $conn->prepare("SELECT of.*, r.name AS r_name FROM order_food of inner join room r ON r.r_id = of.r_id ORDER BY status ASC");
                    $select->execute();

                    $i = 1;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                    {               
                ?>
                  <tr>
                      <td class="text-center"><?= $i++?></td>
                      <td class="text-center">
                        <form action="" method="post" enctype="multipart/form-data">
                          <?php 
                                  if($row['status'] === '0')
                                  { 
                          ?>

                                  <button class="btn bg-primary btn-sm" type="submit" name="ok" value="<?= $row['of_id']; ?>">
                                      <i class="fas fa-hand-point-right"></i> แจ้งเสริฟอาหาร
                                  </button>
                                  
                          <?php 
                                  } else {
                          ?>

                                  <button class="btn bg-danger btn-sm" type="submit" name="cancel" value="<?= $row['of_id']; ?>">
                                      <i class="fas fa-trash-alt"></i> ยกเลิก
                                  </button>

                          <?php
                                  }
                          ?>
                        </form>
                      </td>
                      <td class="text-center"><?= $row['r_name']; ?></td>
                      <td class="text-center"><?= $row['of_id']; ?></td>
                      <td class="text-center"><?= DateThai1($row['d_date']); ?></td>
                      <td class="text-center"><?= $row['total']; ?></td>
                      
                      <td class="text-center">
                          <a href="index.php?food_order_view=<?= $row['of_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                          <!-- <a href="index.php?food_order_edit=<?= $row['of_id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a> -->
                          <a href="index.php?food_order_del=<?= $row['of_id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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

            $of_id    =  $_POST['ok'];
            $status   =  1;

            try {

                $update = $conn->prepare("UPDATE order_food SET status = :status WHERE of_id = :of_id");
                $update->bindParam(':of_id'  , $of_id);
                $update->bindParam(':status' , $status);

                if ($update->execute()) {
                    
                    echo "<script>alert('แจ้งเสริฟอาหาร เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?food_order\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

        if (isset($_POST['cancel'])) {

            $of_id    =  $_POST['cancel'];
            $status   =  0;

            try {

                $update = $conn->prepare("UPDATE order_food SET status = :status WHERE of_id = :of_id");
                $update->bindParam(':of_id'  , $of_id);
                $update->bindParam(':status' , $status);

                if ($update->execute()) {
                    
                    echo "<script>alert('ยกเลิกการเสริฟอาหาร  เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?food_order\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>