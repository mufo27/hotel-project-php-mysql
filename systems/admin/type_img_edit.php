<?php
        require_once '../../database/con_db.php';

        if(isset($_GET['type_img_edit'])){

            $i_id = $_GET['type_img_edit'];
            $t_id = $_GET['t_id'];

            $select = $conn->prepare("SELECT * FROM images WHERE i_id = :i_id");
            $select->bindParam(':i_id' ,  $i_id);
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
              <li class="breadcrumb-item active">แก้ไขรูปภาพ</li>
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
                <h2>ฟอร์มแก้ไขรูปภาพ</h2>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                        <div class="col-5 text-center">
                            <div class="form-group">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" width="350" height="250"/>'; ?>
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
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row['i_id'];?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

if (isset($_POST['edit'])) {

    $i_id    =  $_POST['edit'];
    $img     =  file_get_contents($_FILES['img']['tmp_name']);

    try {

        $update = $conn->prepare("UPDATE images SET img = :img WHERE i_id = :i_id");
        $update->bindParam(':i_id'   , $i_id);
        $update->bindParam(':img'    , $img);

        if ($update->execute()) {
            
            echo "<script>alert('แก้ไขรุปภาพ เรียบร้อย...!!')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type_img=$t_id\">";
            exit;
        }

    } catch (PDOException $e) {

        echo $e->getMessage();

    } 
    
}

?>


