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
                                <label>ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control" name="username" placeholder="" required>
                                <input type="hidden" class="form-control" name="status"  value="<?= $status; ?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>รหัสผ่าน</label>
                                <input type="password" class="form-control" name="password" placeholder="" required>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label>ชื่อ-สกุล</label>
                                <input type="text" class="form-control" name="f_name" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>เบอร์โทร</label>
                                <input type="text" class="form-control" name="phone" placeholder="" required>
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



<?php 

        if (isset($_POST['add'])) {

            require_once '../../database/con_db.php';

            $m_id       =  rand(10000,99999);
            $username   =  $_POST['username'];
            $password   =  $_POST['password'];
            $f_name     =  $_POST['f_name'];
            $email      =  $_POST['email'];
            $phone      =  $_POST['phone'];
            $status     =  5;


            if (isset($username)) {

                $select_check = $conn->prepare("SELECT username, f_name FROM members WHERE username = :username OR f_name = :f_name");
                $select_check->bindParam("username" , $username);
                $select_check->bindParam("f_name" , $f_name);
				$select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbusername   =  $row_check['username'];
                    $dbf_name     =  $row_check['f_name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($username == $dbusername){

                        echo "<script>alert('มีชื่อผู้ใช้งานนี้ อยู่ในระบบแล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                    if ($f_name == $dbf_name){

                        echo "<script>alert('มีชื่อ-สกุล ผู้ใช้งานนี้ อยู่ในระบบแล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                        try {

                            $insert= $conn->prepare("INSERT INTO members (m_id, username, password, f_name, email, phone, status) 
                                                                VALUES (:m_id, :username, :password, :f_name, :email, :phone, :status)");
                            $insert->bindParam(':m_id'      , $m_id);
                            $insert->bindParam(':username'  , $username);
                            $insert->bindParam(':password'  , $password);
                            $insert->bindParam(':f_name'    , $f_name);
                            $insert->bindParam(':email'     , $email);
                            $insert->bindParam(':phone'     , $phone);
                            $insert->bindParam(':status'    , $status);
                            
                            if ($insert->execute()) {
                                
                                echo "<script>alert('เพิ่มข้อมูล เรียบร้อย...!!')</script>";
                                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?member\">";
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


