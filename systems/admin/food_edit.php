<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['food_edit'])){

        $f_id = $_GET['food_edit'];

        $select = $conn->prepare("SELECT * FROM food WHERE f_id = :f_id ");
        $select->bindParam(':f_id' ,  $f_id);
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
              <li class="breadcrumb-item">อาหาร</li>
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
                                <label>ชื่ออาหาร</label>
                                <input type="text" class="form-control" name="name" value="<?= $row['name'];?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>ราคา</label>
                                <input type="text" class="form-control" name="price" value="<?= $row['price'];?>">
                            </div>
                        </div>
                        <div class="col-5 text-center">
                            <div class="form-group">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" width="250" height="150"/>'; ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>เปลี่ยนรูปภาพ</label>
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
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row['f_id'];?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

            $f_id    =  $_POST['edit'];
            $name    =  $_POST['name'];
            $price   =  $_POST['price'];
            $img     =  file_get_contents($_FILES['img']['tmp_name']);

            try {

                $update = $conn->prepare("UPDATE food SET name = :name, price = :price, img = :img WHERE f_id = :f_id");
                $update->bindParam(':f_id'   , $f_id);
                $update->bindParam(':name'   , $name);
                $update->bindParam(':price' , $price);
                $update->bindParam(':img'    , $img);

                if ($update->execute()) {
                    
                    echo "<script>alert('แก้ไขข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?food\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
            
        }

?>


