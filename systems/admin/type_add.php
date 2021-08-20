<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">ประเภทห้อพัก</li>
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
                        <div class="col-6">
                            <div class="form-group">
                                <label>ชื่อประเภทห้องพัก</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>ราคา/คืน</label>
                                <input type="text" class="form-control" name="price" required>
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
                                <label>วิดิโอ (ลิงค์ youtube)</label>
                                <input type="text" class="form-control" name="link_youtube" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input id="chooseFile" type="file" class="form-control" name="img[]" multiple required>
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

    <div class="row mt-5"></div>


    <script> CKEDITOR.replace( 'editor1' );</script>

<?php 

        if (isset($_POST['add'])) {

            require_once '../../database/con_db.php';

            $name    =  $_POST['name'];
            $detail  =  $_POST['detail'];
            $price   =  $_POST['price'];
            $link_youtube = $_POST['link_youtube'];

            if (isset($name)) {

                $select_check = $conn->prepare("SELECT name FROM news WHERE name = :name");
                $select_check->bindParam("name" , $name);
				$select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbname  =  $row_check['name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($name == $dbname){

                        echo "<script>alert('มีหัวข้อข่าวนี้แล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                        try {

                            $insert= $conn->prepare("INSERT INTO type (name, detail, price) VALUES (:name, :detail, :price)");
                            $insert->bindParam(':name'    , $name);
                            $insert->bindParam(':detail'  , $detail);
                            $insert->bindParam(':price'     , $price);
                            $insert->execute();
                            $t_id = $conn->lastInsertId();

                            if(array_filter($_FILES['img']['tmp_name'])){

                                foreach($_FILES['img']['tmp_name'] as $key => $val){

                                    $img = file_get_contents($_FILES['img']['tmp_name'][$key]);

                                    $insert_img = $conn->prepare("INSERT INTO images (img, t_id) VALUES (:img, :t_id)");
                                    $insert_img->bindParam(':img'     , $img);
                                    $insert_img->bindParam(':t_id'   ,  $t_id);
                                    $insert_img->execute();

                                }
                            }


                            $insert_vedio = $conn->prepare("INSERT INTO videos (link_youtube, t_id) VALUES (:link_youtube, :t_id)");
                            $insert_vedio->bindParam(':link_youtube' , $link_youtube);
                            $insert_vedio->bindParam(':t_id'        , $t_id);
                                              
                            
                            if ($insert_vedio->execute()) {
                                
                                echo "<script>alert('เพิ่มข้อมูล เรียบร้อย...!!')</script>";
                                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type\">";
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


