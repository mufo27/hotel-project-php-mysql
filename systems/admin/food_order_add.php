<?php 
    
    $f_id = $_GET['food_order_add'];
    $act = $_GET['act'];

    if ($act == 'add' && !empty($f_id)) 
    {

        if (isset($_SESSION['food_order_add'][$f_id])) {

            $_SESSION['food_order_add'][$f_id]++;

        } else {

            $_SESSION['food_order_add'][$f_id] = 1;

        }

    }

    if ($act == 'remove' && !empty($f_id)) 
    {
        unset($_SESSION['food_order_add'][$f_id]);
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
              <li class="breadcrumb-item active">เลือกอาหาร</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">

      <div class="row">

            <div class="col-5">
                <div class="card card-solid">
                    <h3 class="text-center mt-3">รายการอาหารที่เลือก</h3>
                    <div class="card-body pb-0">

                    <form action="" method="post">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <select name="r_id" class="form-control" required>
                                        <option value="">- เลือกหมายเลขห้องพัก -</option>
                                        <?php 	
                                            require_once '../../database/con_db.php';

                                            $select = $conn->prepare("SELECT * FROM room WHERE status = 1");
                                            $select->execute();
                                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                                            {
                                                $rs_id = $row['rs_id'];
                                        ?>
                                        <option value="<?= $row['r_id']; ?>"> <?= $row['name']; ?></option>                                   
                                        <?php } ?>
                                    </select>     
                                    <input type="hidden"  name="rs_id" value="<?= $rs_id; ?>">
                                </div>
                            </div>
                        </div>

                        <?php 
                                if (empty($_SESSION['food_order_add'])) 
                                {  
                        ?>
                            <h3 class="text-center text-danger">
                                <i class="nav-icon fas fa-hamburger fa-2x nav-icon"></i>
                                ยังไม่ได้เลือกอาหาร
                            </h3>

                        <?php
                                } else {
                        ?>
                        <div class="row mt-3"></div>
                        <table id="" class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%">NO.</th>
                                    <th class="text-center" style="width: 10%">เมนู</th>
                                    <th class="text-center" style="width: 10%">ราคา</th>
                                    <th class="text-center" style="width: 10%">จำนวน</th>
                                    <th class="text-center" style="width: 10%">รวม</th>
                                    <th class="text-center" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                        $i  =  1;
                                        $k =  0;
                                        
                                        $sum    =  0;
                                        $total  =  0;

                                        foreach ($_SESSION['food_order_add'] as $f_id => $qty) 
                                        {
                                            $select_of = $conn->prepare("SELECT * FROM food WHERE f_id = :f_id");
                                            $select_of->bindParam("f_id" , $f_id);
                                            $select_of->execute();
                                            $row_of = $select_of->fetch(PDO::FETCH_ASSOC);

                                            $sum = $row_of['price'] * $qty;
                                            $total += $sum;
                                ?>

                                <tr>
                                    <td class="text-center">
                                        <?= $i++?>
                                        <input type="hidden"  name="k[]" value="<?= $k++; ?>">
                                    </td>
                                    <td class="text-center">
                                        <?= $row_of['name']; ?>
                                        <input type="hidden"  name="f_id[]" value="<?= $row_of['f_id']; ?>">
                                    </td>
                                    <td class="text-center"><?= $row_of['price']; ?></td>
                                    <td class="text-center">
                                        <span><input type="number" name="amount[<?= $f_id?>];" value="<?= $qty; ?>" min="0"  class="form-control"></span>
                                        <input type="hidden"  name="qty[]" value="<?= $qty; ?>">
                                    </td>
                                    <td class="text-center">
                                        <?= $sum; ?>
                                        <input type="hidden"  name="sum_price[]" value="<?= $sum; ?>">
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?food_order_add=<?= $row_of['f_id'];?>&act=remove" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                    </td>
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
                                        <input type="hidden"  name="total" value="<?= $total; ?>">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                            <div class="row mt-3">
                                <div class="col-2"></div>
                                <div class="col-4">
                                    <div class="single-input">
                                        <button  type="submit" name="update" value="update" class="btn btn-info btn-sm"><i class="fas fa-undo-alt"></i> รีเฟรช</button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="single-input">
                                        <button type="submit" name="send" value="" class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i> ยืนยันการสั่ง</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3"></div>
                    </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-7">
                <div class="card card-solid">
                <h3 class="text-center mt-3">รายการอาหารทั้งหมด</h3>

                    <div class="card-body pb-0">
                    <div class="row">
                        <?php

                            $select = $conn->prepare("SELECT * FROM food");
                            $select->execute();

                            $i = 1;
                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                            {               
                        ?>
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">

                            <div class="card-header text-muted border-bottom-0"></div>

                            <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6 text-center">
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" alt="user-avatar" class="img-circle img-fluid"/>'; ?>
                                </div>
                                <div class="col-12">
                                    <h2 class="lead"><b><?= $row['name'];?></b></h2>
                                    <p class="text-muted text-sm"><b>ราคอาหาร </b> <?= $row['price'];?> <b>บาท</b></p>
                                </div>
                            </div>
                            </div>
                            <div class="card-footer">
                            <div class="text-center">
                                <a href="?food_order_add=<?= $row['f_id']?>&act=add" class="btn btn-sm btn-warning">
                                <i class="fas fa-hand-pointer"></i> เลือกอาหาร
                                </a>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            
                </div>
                
            </div>

            
      </div>

    </section>

            <div class="row mt-2">
				<div class="col-10"></div>
				<div class="col-2">
					<div class="row">
						<a href="index.php?food_order" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</a>
					</div>
				</div>
			</div>

    <div class="row mt-5"></div>

    
<?php
    if(isset($_POST['update'])){

        $act = $_POST['update'];

        if ($act === 'update') 
        {
            $amount_array = $_POST['amount'];
            foreach ($amount_array as $f_id => $amount) 
            {
                $_SESSION['food_order_add'][$f_id] = $amount;
            }
        }

        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?food_order_add&act=add\">";

    }

    if(isset($_POST['send'])){

        $check      =  $_POST['k'];

        //เก็บข้อมูลลงตาราง order_food
        $of_id    =  rand(10000,99999);
        $rs_id    =  $_POST['rs_id'];
        $r_id     =  $_POST['r_id'];
        $d_date   =  date('Y-m-d H:i:s');
        $total    =  $_POST['total'];
        $em_id    =  $_SESSION['em_id'];  

        //เก็บข้อมูลลงตาราง of_detail
        $f_id       =  $_POST['f_id'];
        $number     =  $_POST['qty'];
        $sum_price  =  $_POST['sum_price'];

        //เก็บข้อมูลลงตาราง payment
        $pm_id      =  rand(100000,9999999);
        $status  =  0;


        try {

            $insert_of = $conn->prepare("INSERT INTO order_food (of_id, rs_id, r_id, d_date, total, em_id, status) VALUES (:of_id, :rs_id, :r_id, :d_date, :total, :em_id, :status)");
            $insert_of->bindParam(':of_id'    ,  $of_id);
            $insert_of->bindParam(':rs_id'    ,  $rs_id);
            $insert_of->bindParam(':r_id'     ,  $r_id);
            $insert_of->bindParam(':d_date'   ,  $d_date);
            $insert_of->bindParam(':total'    ,  $total);
            $insert_of->bindParam(':em_id'    ,  $em_id);
            $insert_of->bindParam(':status'   ,  $status);
            $insert_of->execute();

            foreach($check as $i)
            {
                $insert_odf = $conn->prepare("INSERT INTO of_detail (of_id, f_id, number, sum_price) VALUES (:of_id, :f_id, :number, :sum_price)");
                $insert_odf->bindParam(':of_id'       ,  $of_id);
                $insert_odf->bindParam(':f_id'        ,  $f_id[$i]);
                $insert_odf->bindParam(':number'      ,  $number[$i]);
                $insert_odf->bindParam(':sum_price'   ,  $sum_price[$i]);
                $insert_odf->execute();
            }     
            
            $insert_pm = $conn->prepare("INSERT INTO payment (pm_id, of_id, status) VALUES (:pm_id, :of_id, :status)");
            $insert_pm->bindParam(':pm_id'    ,  $pm_id);
            $insert_pm->bindParam(':of_id'    ,  $of_id);
            $insert_pm->bindParam(':status'   ,  $status);      

            if ($insert_pm->execute()) {
                    
                echo "<script>alert('สั่งรายการอาหาร เรียบร้อย...!!')</script>"; 
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?food_order\">";
                exit;

            } else {

                echo "<script>alert('error..!!')</script>";
                echo"<script>window.location='javascript:history.back(-1)';</script>";
                exit;

            }  
   

        } catch (PDOException $e) {

            echo $e->getMessage();

        }


        
    }
?>