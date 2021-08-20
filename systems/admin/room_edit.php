<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['room_edit'])){

        $r_id = $_GET['room_edit'];

        $select = $conn->prepare("SELECT r.*, t.name AS t_name FROM room r inner join type t On r.t_id = t.t_id WHERE r_id = :r_id ");
        $select->bindParam(':r_id' ,  $r_id);
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
              <li class="breadcrumb-item">ห้องพัก</li>
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
                        <div class="col-12">
                            <div class="form-group">
                                <label>หมายเลขห้อง</label>
                                <input type="text" class="form-control" name="name" value="<?= $row['name'];?>">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row['r_id'];?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

            $r_id      =  $_POST['edit'];
            $t_id      =  $_POST['t_id'];
            $name      =  $_POST['name'];

            try {

                $update = $conn->prepare("UPDATE room SET t_id = :t_id, name = :name WHERE r_id = :r_id");
                $update->bindParam(':r_id'        , $r_id);
                $update->bindParam(':t_id'        , $t_id);
                $update->bindParam(':name'        , $name);
                
                if ($update->execute()) {
                    
                    echo "<script>alert('แก้ไขข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?room\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }
            
        }

?>


