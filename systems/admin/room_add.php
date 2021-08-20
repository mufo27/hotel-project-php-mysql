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
              <li class="breadcrumb-item">ห้องพัก</li>
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
                                <label>ประเภทห้องพัก</label>
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
                        <div class="col-12">
                            <div class="form-group">
                                <label>หมายเลขห้อง</label>
                                <input type="text" class="form-control" name="name" placeholder="" required>
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

            $t_id       =  $_POST['t_id'];
            $name       =  $_POST['name'];
            $status     =  0;
            
          if (isset($name)) {

                $select_check = $conn->prepare("SELECT name FROM room WHERE name = :name");
                $select_check->bindParam("name" , $name);
				$select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbname  =  $row_check['name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($name == $dbname){

                        echo "<script>alert('มีหมายเลขห้องพัก นี้แล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                        try {

                            $insert= $conn->prepare("INSERT INTO room (t_id, name, status) VALUES (:t_id, :name, :status)");
                            $insert->bindParam(':t_id'        , $t_id);
                            $insert->bindParam(':name'        , $name);
                            $insert->bindParam(':status'      , $status);
                            
                            if ($insert->execute()) {
                                
                                echo "<script>alert('เพิ่มข้อมูล เรียบร้อย...!!')</script>";
                                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?room\">";
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


