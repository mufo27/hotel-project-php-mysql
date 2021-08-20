<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['promotion_edit'])){

        $pr_id = $_GET['promotion_edit'];

        $select = $conn->prepare("SELECT pr.*, t.name AS t_name FROM promotion pr inner join type t On pr.t_id = t.t_id WHERE pr_id = :pr_id ");
        $select->bindParam(':pr_id' ,  $pr_id);
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
              <li class="breadcrumb-item">โปรโมชั่น</li>
              <li class="breadcrumb-item active">แก้ไขข้อมูล</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
 
          <div class="col-md-12">

            <div class="card card-info">
              <div class="card-header">
                <h2>ฟอร์มแก้ไขข้อมูล</h2>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>ชื่อโปรโมชั่น</label>
                                <input type="text" class="form-control" name="name" value="<?= $row['name'];?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea name="detail" id="editor1"><?= $row['detail'];?></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>ประเภทห้องพัก (ที่ต้องการจัดโปรโมชั่น)</label>
                                <select name="t_id" class="form-control" required>
                                    <option value="<?= $row['t_id']; ?>">-- <?= $row['t_name']; ?> --</option>
                                    <?php 	
                                          $select_type = $conn->prepare("SELECT * FROM type");
                                          $select_type->execute();
                                          while ($row_type  = $select_type->fetch(PDO::FETCH_ASSOC)) 
                                          { 
                                    ?>
                                    <option value="<?= $row_type['t_id']; ?>"> <?= $row_type['name']; ?> </option>
                                    <?php } ?>
                                </select>             
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>ส่วนลด</label>
                                <input type="text" class="form-control" name="discount" value="<?= $row['discount'];?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>วันที่เริ่ม โปรโมชั่น</label>
                                <input type="date" class="form-control" name="d_start" value="<?= $row['d_start'];?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>วันที่สิ้นสุด โปรโมชั่น</label>
                                <input type="date" class="form-control" name="d_stop" value="<?= $row['d_stop'];?>">
                            </div>
                        </div>
                        <div class="col-5 text-center">
                            <div class="form-group">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" width="250" height="150"/>'; ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input id="chooseFile" type="file" class="form-control" name="img">
                            </div>
                        </div>
                        <div class="col-5 text-center">
                            <div class="form-group">
                                <div class="imgGallery"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row['pr_id'];?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

    <script> CKEDITOR.replace( 'editor1' );</script>

<?php 

        if (isset($_POST['edit'])) {

            $pr_id      =  $_POST['edit'];
            $name       =  $_POST['name'];
            $detail     =  $_POST['detail'];
            $t_id       =  $_POST['t_id'];
            $discount   =  $_POST['discount'];
            $d_start    =  $_POST['d_start'];
            $d_stop     =  $_POST['d_stop'];
            $img    =  file_get_contents($_FILES['img']['tmp_name']);
            
            try {

                $update = $conn->prepare("UPDATE promotion SET name = :name, detail = :detail, t_id = :t_id, discount = :discount, d_start = :d_start, d_stop = :d_stop, img = :img WHERE pr_id = :pr_id");
                $update->bindParam(':pr_id'       , $pr_id);
                $update->bindParam(':name'        , $name);
                $update->bindParam(':detail'      , $detail);
                $update->bindParam(':t_id'        , $t_id);
                $update->bindParam(':discount'    , $discount);
                $update->bindParam(':d_start'     , $d_start);
                $update->bindParam(':d_stop'      , $d_stop);
                $update->bindParam(':img'         , $img);
                
                if ($update->execute()) {
                    
                    echo "<script>alert('แก้ไขข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?promotion\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }
            
        }

?>


