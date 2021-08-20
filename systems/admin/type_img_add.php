<?php
        require_once '../../database/con_db.php';

        if(isset($_GET['type_img_add'])){

            $t_id = $_GET['type_img_add'];

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
              <li class="breadcrumb-item">ประเภทห้องพัก</li>
              <li class="breadcrumb-item">รูปภาพ</li>
              <li class="breadcrumb-item active">เพิ่มรูปภาพ</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
 
          <div class="col-md-12">

            <div class="card card-warning">
              <div class="card-header">
                <h2>ฟอร์มเพิ่มรูปภาพ</h2>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input id="chooseFile" type="file" class="form-control" name="img[]" multiple>
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
                  <button type="submit" class="btn btn-success" name="add" value="<?= $t_id;?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

    <div class="row mt-5"></div>


    <script> CKEDITOR.replace( 'editor1' );</script>


<?php 

        if (isset($_POST['add'])) {

            $t_id = $_POST['add'];

            try {

                if(array_filter($_FILES['img']['tmp_name'])){

                    foreach($_FILES['img']['tmp_name'] as $key => $val){

                        $img = file_get_contents($_FILES['img']['tmp_name'][$key]);

                        $insert_img = $conn->prepare("INSERT INTO images (img, t_id) VALUES (:img, :t_id)");
                        $insert_img->bindParam(':img'     , $img);
                        $insert_img->bindParam(':t_id'   ,  $t_id);
                        $insert_img->execute();

                    }
                }
                
                if (isset($insert_img)) {
                    
                    echo "<script>alert('เพิ่มรูปภาพ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type_img=$t_id\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }
            
        }

?>




