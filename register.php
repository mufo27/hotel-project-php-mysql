    <?php session_start(); ?>

    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.html">Home</a></li>
            <li>สมัครสมาชิก</li>
            </ol>

        </div>
    </section>
    
    <section id="blog" class="blog">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="blog-comments">
                        <div class="reply-form">

                            <div class="row">
                                <div class="section-title">
                                    <h2>สมัครสมาชิก</h2>
                                </div>
                            </div>
                    
                            <form action="" method="post">
                                <div class="row">

                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="f_name" placeholder="ชื่อ-สกุล" required="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="phone" placeholder="เบอร์โทร" required="">
                                    </div>           
                                    <div class="col-md-12 form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="username" placeholder="ชื้อผู้ใช้งาน" required="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="password" class="form-control" name="c_password" placeholder="ยืนยันรหัสผ่าน" required="">
                                    </div>
                                    <div class="row mt-5 text-center">                      
                                        <button type="submit" class="btn btn-primary" name="register">ยืนยันการสมัครสมาชิก</button>                                   
                                    </div>

                                    <div class="row mt-5"></div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row mt-5"></div>
    <div class="row mt-5"></div>
    

<?php 

        
        require_once('database/con_db.php');

        if (isset($_POST['register'])) {

            $m_id         =   rand(510,599);
            $f_name       =   $_POST['f_name'];
            $phone        =   $_POST['phone'];
            $email        =   $_POST['email'];
            $username     =   $_POST['username'];
            $password     =   $_POST['password'];
            $c_password   =   $_POST['c_password'];
            $status       =   5;

            if ($password !== $c_password) {

                echo "<script>alert('ยืนยันรหัสผ่าน ไม่ตรงกัน...!!')</script>";
                echo "<script>window.location='javascript:history.back(-1)';</script>";
                exit;            

            } else {

                $select_check = $conn->prepare("SELECT username FROM members WHERE username = :username");
                $select_check->bindParam("username" , $username);
				$select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {
                    
                    $dbusername   =  $row_check['username'];
                }

                if ($select_check->rowCount() > 0) {

                    if ($username == $dbusername){

                        echo "<script>alert('มีชื่อผู้ใช้งานนี้ อยู่ในระบบแล้ว!!')</script>";
                        echo "<script>window.location='javascript:history.back(-1)';</script>";
                        exit;         

                    } 

                } else {

                    try {

                        $insert_m = $conn->prepare("INSERT INTO members (m_id, f_name, phone, email, username, password, status) VALUES (:m_id, :f_name, :phone, :email, :username, :password, :status)");
                        $insert_m->bindParam(':m_id'     ,  $m_id);
                        $insert_m->bindParam(':f_name'   ,  $f_name);
                        $insert_m->bindParam(':phone'    ,  $phone);
                        $insert_m->bindParam(':email'    ,  $email);
                        $insert_m->bindParam(':username' ,  $username);
                        $insert_m->bindParam(':password' ,  $password);
                        $insert_m->bindParam(':status'   ,  $status);

                        if ($insert_m->execute()) {
                            
                            echo "<script>alert('สมัครสมาชิก สำเร็จ...!!')</script>";
                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
                            exit;           

                        }

                    } catch (PDOException $e) {
        
                        echo $e->getMessage();
        
                    }
                } 

            } 

        }

?>
