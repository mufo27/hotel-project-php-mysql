<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['check_in'])){

        $r_id = $_GET['check_in'];
        $t_id = $_GET['t_id'];

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
              <li class="breadcrumb-item">ห้องพัก</li>
              <li class="breadcrumb-item active">Check in</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              </div>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">                   
                        <div class="col-12">
                            <div class="form-group">
                                <label>ชื่อผู้เข้าพัก</label>
                                <select name="rs_id" class="form-control" required>
                                    <option value="">-- เลือก --</option>
                                    <?php 	
                                          $select = $conn->prepare("SELECT rs_id, ad_name FROM reserve WHERE t_id = :t_id");
                                          $select->bindParam(':t_id' ,  $t_id);
                                          $select->execute();
                                          while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                                          { 
                                    ?>
                                    <option value="<?= $row['rs_id']; ?>"><?= $row['ad_name']; ?> </option>
                                    <?php } ?>
                                </select>             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="in" value="<?=  $r_id; ?>"><i class="fas fa-check-circle"></i> ยืนยัน</button>
                  <button type="reset" class="btn btn-warning"><i class="fas fa-undo"></i> รีเซ็ต</button>
                </div>
              </form>
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

<?php

    if (isset($_POST['in'])) {

        $r_id     =  $_POST['in'];
        $rs_id    =  $_POST['rs_id'];
        $r_status   =  1;
        $rs_status  =  2;
        
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
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?welcom_p3\">";
                exit;
            }

        } catch (PDOException $e) {

            echo $e->getMessage();

        } 
        
    }


?>
