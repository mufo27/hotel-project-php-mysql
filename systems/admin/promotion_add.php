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
              <li class="breadcrumb-item">โปรโมชั่น</li>
              <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
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
                <h2>ฟอร์มเพิ่มข้อมูล</h2>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>ชื่อโปรโมชั่น</label>
                                <input type="text" class="form-control" name="name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea name="detail" id="editor1"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>ประเภทห้องพัก (ที่ต้องการจัดโปรโมชั่น)</label>
                                <select name="t_id" class="form-control" required>
                                    <option value="">-- เลือก --</option>
                                    <?php 	
                                          $select = $conn->prepare("SELECT * FROM type");
                                          $select->execute();
                                          while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                                          { 
                                    ?>
                                    <option value="<?= $row['t_id']; ?>"> <?= $row['name']; ?> </option>
                                    <?php } ?>
                                </select>             
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>ส่วนลด</label>
                                <input type="text" class="form-control" name="discount" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>วันที่เริ่ม โปรโมชั่น</label>
                                <input type="date" class="form-control" name="d_start" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>วันที่สิ้นสุด โปรโมชั่น</label>
                                <input type="date" class="form-control" name="d_stop" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input id="chooseFile" type="file" class="form-control" name="img" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="imgGallery"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="add"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

        if (isset($_POST['add'])) {

            $name       =  $_POST['name'];
            $detail     =  $_POST['detail'];
            $t_id       =  $_POST['t_id'];
            $discount   =  $_POST['discount'];
            $d_start    =  $_POST['d_start'];
            $d_stop     =  $_POST['d_stop'];
            $img        =  file_get_contents($_FILES['img']['tmp_name']);
            
          if (isset($name)) {

                $select_check = $conn->prepare("SELECT name FROM promotion WHERE name = :name");
                $select_check->bindParam("name" , $name);
				$select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbname  =  $row_check['name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($name == $dbname){

                        echo "<script>alert('มีชื่อโปรโมชั่นนี้แล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                        try {

                            $insert= $conn->prepare("INSERT INTO promotion (name, detail, t_id, discount, d_start, d_stop, img) VALUES (:name, :detail, :t_id, :discount, :d_start, :d_stop, :img)");
                            $insert->bindParam(':name'        , $name);
                            $insert->bindParam(':detail'      , $detail);
                            $insert->bindParam(':t_id'        , $t_id);
                            $insert->bindParam(':discount'    , $discount);
                            $insert->bindParam(':d_start'     , $d_start);
                            $insert->bindParam(':d_stop'      , $d_stop);
                            $insert->bindParam(':img'         , $img);
                            
                            if ($insert->execute()) {
                                
                                echo "<script>alert('เพิ่มข้อมูล เรียบร้อย...!!')</script>";
                                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?promotion\">";
                                exit;
                            }

                        } catch (PDOException $e) {
            
                            echo $e->getMessage();
            
                        }
                    
                } 

            } else {

                echo "<script>alert('เกิดข้อผิดพลาด..!!')</script>";
                echo"<script>window.location='javascript:history.back(-1)';</script>";

            }
            
        }

?>


