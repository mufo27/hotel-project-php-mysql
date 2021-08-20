<?php
     require_once '../../database/con_db.php';

     if(isset($_GET['type_edit'])){
 
         $t_id = $_GET['type_edit'];
 
         $select = $conn->prepare("SELECT t.*, vo.link_youtube FROM type t inner join videos vo ON vo.t_id = t.t_id WHERE t.t_id = :t_id");
         $select->bindParam(':t_id' ,  $t_id);
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
              <li class="breadcrumb-item">ประเภทห้อพัก</li>
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
                        <div class="col-6">
                            <div class="form-group">
                                <label>ชื่อประเภทห้องพัก</label>
                                <input type="text" class="form-control" name="name" value="<?= $row['name'];?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>ราคา/คืน</label>
                                <input type="text" class="form-control" name="price" value="<?= $row['price'];?>">
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
                                <label>วิดิโอ (ลิงค์ youtube)</label>
                                <input type="text" class="form-control" name="link_youtube" value="<?= $row['link_youtube'];?>">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="edit" value="<? $row['t_id']; ?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

            $t_id    =  $_POST['edit'];
            $name    =  $_POST['name'];
            $detail  =  $_POST['detail'];
            $price   =  $_POST['price'];
            $link_youtube = $_POST['link_youtube'];

            try {

                $update_t = $conn->prepare("UPDATE type SET name = :name, detail = :detail, price= :price WHERE t_id = :t_id");
                $update_t->bindParam(':t_id'   , $t_id);
                $update_t->bindParam(':name'   , $name);
                $update_t->bindParam(':detail' , $detail);
                $update_t->bindParam(':price' , $price);
                $update_t->execute();

                $update_vo = $conn->prepare("UPDATE videos SET link_youtube = :link_youtube WHERE t_id = :t_id");
                $update_vo->bindParam(':t_id'         , $t_id);
                $update_vo->bindParam(':link_youtube' , $link_youtube);

                if ($update_vo->execute()) {
                    
                    echo "<script>alert('แก้ไขข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 

        }

?>


