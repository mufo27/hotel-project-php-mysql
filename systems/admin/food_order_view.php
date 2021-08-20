<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['food_order_view'])){

        $of_id = $_GET['food_order_view'];

        $select = $conn->prepare("SELECT of.*, r.name AS r_name FROM order_food of inner join room r ON r.r_id = of.r_id WHERE of_id = :of_id");
        $select->bindParam("of_id" , $of_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);
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
              <li class="breadcrumb-item">การสั่งซื้ออาหาร</li>
              <li class="breadcrumb-item active">ดูรายละเอียดการสั่งอาหาร</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
 
          <div class="col-md-12">

            <div class="card card-success">
              <div class="card-header">
                <h2>ดูรายละเอียดการสั่งอาหาร</h2>
              </div>

                <div class="card-body">

                    <div class="row mt-3">
                        <div class="col-4">
                            <h5>หมายเลขห้องพัก : <?= $row['r_name']; ?></h5>
                        </div>
                        <div class="col-4">
                            <h5>เลขที่สั่งอาหาร : <?= $row['of_id']; ?></h5>
                        </div>
                        <div class="col-4">
                            <h5>วันที่สั่งอาหาร  : <?= $row['d_date']; ?></h5>
                        </div>
                    </div>

                    <div class="row mt-3"></div>
                        <table id="" class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%">NO.</th>
                                    <th class="text-center" style="width: 10%">รูปภาพ</th>
                                    <th style="width: 10%">เมนู</th>
                                    <th class="text-center" style="width: 10%">ราคา</th>
                                    <th class="text-center" style="width: 10%">จำนวน</th>
                                    <th class="text-center" style="width: 10%">รวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                  
                                        $select = $conn->prepare("SELECT ofd.*, f.name, f.price, f.img FROM of_detail ofd inner join food f ON f.f_id = ofd.f_id WHERE of_id = :of_id");
                                        $select->bindParam("of_id" , $of_id);
                                        $select->execute();

                                        $i=1;
                                        while($row = $select->fetch(PDO::FETCH_ASSOC))
                                        {   
                                            $total = 0;
                                            $total += $row['sum_price'];
                                ?>

                                <tr>
                                    <td class="text-center"><?= $i++?></td>
                                    <td class="text-center">
                                      <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" width="200" height="125"/>'; ?>
                                    </td>
                                    <td><?= $row['name']; ?></td>
                                    <td class="text-center"><?= $row['price']; ?></td>
                                    <td class="text-center"><?= $row['number']; ?></td>
                                    <td class="text-center"><?= $row['sum_price']; ?></td>
                                </tr>

                                <?php
                                    }
                                ?>

                                <tr> 
                                    <td colspan="4" class="text-right">
                                        <h6>ยอดชำระเงิน รวมทั้งหมด</h6>
                                    </td>
                                    <td colspan="2" class="text-center">
                                        <h6><?= $total; ?> บาท</h6>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                </div>
            </div>

          </div>

        </div>

            <div class="row mt-2">
				<div class="col-10"></div>
				<div class="col-2">
					<div class="row">
						<button type="submit" class="btn btn-danger" name="back" onclick="history.go(-1)"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button>
					</div>
				</div>
			</div>

      </div>
    </section>

    <div class="row mt-5"></div>


                        