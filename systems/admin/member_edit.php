<?php 
    require_once '../../database/con_db.php';

    if(isset($_GET['member_edit'])){

        $m_id = $_GET['member_edit'];

        $select = $conn->prepare("SELECT * FROM members WHERE m_id = :m_id ");
        $select->bindParam(':m_id' ,  $m_id);
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
              <li class="breadcrumb-item">สมาชิก</li>
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
                                <label>ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control" name="username" value="<?= $row['username'];?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>รหัสผ่าน</label>
                                <input type="password" class="form-control" name="password" value="<?= $row['password'];?>">
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label>ชื่อ-สกุล</label>
                                <input type="text" class="form-control" name="f_name" value="<?= $row['f_name'];?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" name="email" value="<?= $row['email'];?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>เบอร์โทร</label>
                                <input type="text" class="form-control" name="phone" value="<?= $row['phone'];?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row['m_id'];?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

        if (isset($_POST['edit'])) {

            $m_id      =  $_POST['edit'];
            $username   =  $_POST['username'];
            $password   =  $_POST['password'];
            $f_name     =  $_POST['f_name'];
            $email      =  $_POST['email'];
            $phone      =  $_POST['phone'];

            try {

                $update = $conn->prepare("UPDATE members SET   username   = :username,
                                                                password   = :password,
                                                                f_name     = :f_name,
                                                                email      = :email,
                                                                phone      = :phone

                                                            WHERE m_id = :m_id" );
                $update->bindParam(':m_id'      , $m_id);
                $update->bindParam(':username'  , $username);
                $update->bindParam(':password'  , $password);
                $update->bindParam(':f_name'    , $f_name);
                $update->bindParam(':email'     , $email);
                $update->bindParam(':phone'     , $phone);

                if ($update->execute()) {
                    
                    echo "<script>alert('แก้ไขข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?member\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
            
        }

?>


