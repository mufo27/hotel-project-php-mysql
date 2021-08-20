<?php
       require_once '../../database/con_db.php';

       if($_GET['welcom_p3'] != ""){

            $rs_id = $_GET['welcom_p3'];
            $number = $_GET['number'];
            $t_id = $_GET['t_id'];
            $ad_name = $_GET['ad_name'];
  
            $select = $conn->prepare("SELECT r.*,t.name AS t_name FROM type t inner join room r ON t.t_id = r.t_id WHERE r.t_id = :t_id ORDER BY r.name ASC");
            $select->bindParam(':t_id' ,  $t_id);
            $select->execute();

        } else {

            if(isset($_POST['name'])){

                $name = $_POST['name'];

                if($name === 'ว่าง'){

                    $select = $conn->prepare("SELECT r.*,t.name AS t_name FROM type t inner join room r ON t.t_id = r.t_id  WHERE status = 0 ORDER BY r.name ASC");
                    $select->execute();

                } else if($name === 'ไม่ว่าง'){

                    $select = $conn->prepare("SELECT r.*,t.name AS t_name FROM type t inner join room r ON t.t_id = r.t_id  WHERE status = 1 ORDER BY r.name ASC");
                    $select->execute();
                    
                } else { 

                    $select = $conn->prepare("SELECT r.*,t.name AS t_name FROM type t inner join room r ON t.t_id = r.t_id  WHERE r.name LIKE '%$name%' ORDER BY r.name ASC");
                    $select->execute();
                    
                }
    
            } else {

                $select = $conn->prepare("SELECT r.*,t.name AS t_name FROM type t inner join room r ON t.t_id = r.t_id ORDER BY r.name ASC");
                $select->execute();

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

              <?php  if($_GET['welcom_p3'] != ""){ ?>
              <li class="breadcrumb-item ">การจองห้องพัก (สมาชิก)</li>
              <li class="breadcrumb-item active">จัดการห้องพัก</li>
              <?php } else { ?>
              <li class="breadcrumb-item active">ห้องพัก</li>
              <?php } ?>

            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-solid">
                <h3 class="text-center mt-3"></h3>
                <?php  if($_GET['welcom_p3'] == ""){ ?>

                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-5">

                            <form action="" method="post">
                            <div class="input-group">
                                <input class="form-control form-control-sidebar" type="text" name="name" placeholder="ค้นหา" aria-label="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-fw fa-search"></i></button>
                                </div>
                            </div>
                            </form>
                            
                        </div>
                    </div>
                    <?php } ?>


                    <div class="card-body pb-0">

                        <?php  if($_GET['welcom_p3'] != ""){ ?>
                        <div class="row">
                            <div class="col">
                                <h3>ผู้เข้าพัก : <?= $ad_name; ?> <br> จองไว้ : <?= $number; ?> ห้อง</h3>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="row mt-3">
                            <?php

                                $i = 1;
                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                                {               
                                    $ch = $row['rs_id'];

                                    $select_rs = $conn->prepare("SELECT ad_name FROM reserve WHERE rs_id = :ch ");
                                    $select_rs->bindParam(':ch' ,  $ch);
                                    $select_rs->execute();
                                    $row_rs = $select_rs->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">

                                <div class="card-header text-muted border-bottom-0"></div>

                                <div class="card-body pt-0">
                                <div class="row mt-3">
                                    <div class="col-4 text-center">
                                        <i class="fas fa-hotel fa-3x"></i>
                                        <div class="mt-3">
                                            <?php if($row['status'] == 0) {?><h4 class="text-success"><b>ว่าง</b></h4><?php } ?>
                                            <?php if($row['status'] == 1) {?><h4 class="text-danger"><b>ไม่ว่าง</b></h4><?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <h6><b>ประเภท : <?= $row['t_name'];?></b></h6>
                                        <p class="text-muted text-sm"><b>หมายเลข :  <?= $row['name'];?></b></p>
                                        <?php if($row['status'] == 1) {?><p class="text-muted text-sm"><b>ผู้เข้าพัก :  <?= $row_rs['ad_name']; ?></b></p><?php } ?>
                                        
                                        <?php  if($_GET['welcom_p3'] != ""){ ?>
                                            <form action="" method="post" enctype="multipart/form-data">
                                            <?php if($row['status'] == 1) {?>
                                                <button type="submit" class="btn btn-danger btn-sm" name="out" value="<?= $row['r_id']; ?>"><i class="fas fa-window-close"></i> check out</button>
                                            <?php } ?>
                                            <?php if($row['status'] == 0) {?>
                                                <button type="submit" class="btn btn-success btn-sm" name="in" value="<?= $row['r_id']; ?>"><i class="fas fa-check-circle"></i> check in</button>
                                            <?php } ?>
                                            </form>
                                        <?php } ?>

                                    </div>
                                </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center">
                                       
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
                        <?php  if($_GET['welcom_p3'] != ""){ ?>
						<a href="index.php?welcom_p1" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</a>
                        <?php } else { ?>
                        <a href="index.php?welcom_p3" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</a>
                        <?php } ?>

					</div>
				</div>
			</div>

    <div class="row mt-5"></div>

<?php

    if (isset($_POST['in'])) {

      
        $r_id     =  $_POST['in'];
        $r_status   =  1;
        $rs_status  =  2;

        $sql = "SELECT count(rs_id) FROM room WHERE rs_id = '$rs_id' ";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();

        
        if($count == $number){

            echo "<script>alert('check in ห้องพักครบตามจำนวนที่จองแล้ว..!!')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p1\">";
            exit;

        } else {
            try {

                $update_r = $conn->prepare("UPDATE room SET rs_id = :rs_id, status = :r_status WHERE r_id = :r_id");
                $update_r->bindParam(':r_id'      , $r_id);
                $update_r->bindParam(':rs_id'     , $rs_id);
                $update_r->bindParam(':r_status' , $r_status);
                $update_r->execute();
    
                $update_rs = $conn->prepare("UPDATE reserve SET status = :rs_status WHERE rs_id = :rs_id");
                $update_rs->bindParam(':rs_id'     , $rs_id);
                $update_rs->bindParam(':rs_status' , $rs_status);
    
                if ($update_rs->execute()) {
                    
                    echo "<script>alert('Check in เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p3=$rs_id&number=$number&t_id=$t_id\">";
                    exit;
                }
    
            } catch (PDOException $e) {
    
                echo $e->getMessage();
    
            }
        }
              
    }

    if (isset($_POST['out'])) {

        $r_id      =  $_POST['out'];
        $rss_id    =  null;
        $r_status  =  0;
        $rs_status  =  3;
        
        try {

            $update_r = $conn->prepare("UPDATE room SET rs_id = :rss_id, status = :r_status WHERE r_id = :r_id");
            $update_r->bindParam(':r_id'      , $r_id);
            $update_r->bindParam(':rss_id'    , $rss_id);
            $update_r->bindParam(':r_status'  , $r_status);
            $update_r->execute();

            $update_rs = $conn->prepare("UPDATE reserve SET status = :rs_status WHERE rs_id = :rs_id");
            $update_rs->bindParam(':rs_id'     , $rs_id);
            $update_rs->bindParam(':rs_status' , $rs_status);

            if ($update_rs->execute()) {
                
                echo "<script>alert('Check out เรียบร้อย...!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p3=$rs_id&number=$number&t_id=$t_id\">";
                exit;
            }

        } catch (PDOException $e) {

            echo $e->getMessage();

        } 
        
    }


?>
