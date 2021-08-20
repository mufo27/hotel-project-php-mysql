<?php 
        
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
            exit();

        }  else { 

            require_once 'database/con_db.php';            

            $m_id = $_SESSION['m_id'];

            try {

                $select = $conn->prepare("SELECT * FROM members WHERE m_id = :m_id");
                $select->bindParam("m_id"   , $m_id);
                $select->execute();
                $row = $select->fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 

?>
    
    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.html">Home</a></li>
            <li>ข้อมูลส่วนตัว</li>
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
                                    <h2>ข้อมูลส่วนตัว</h2>
                                </div>
                            </div>
                    
                            <form action="" method="post">
                                <div class="row">

                                    <label>ชื่อ-สกุล</label>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="f_name" value="<?= $row['f_name']; ?>">
                                    </div>
                                    <label>เบอร์โทร</label>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="phone" value="<?= $row['phone']; ?>">
                                    </div>        
                                    <label>E-Mail</label>
                                    <div class="col-md-12 form-group">
                                        <input type="email" class="form-control" name="email" value="<?= $row['email']; ?>">
                                    </div>
                                    <label>ชื่อผู้ใช้งาน</label>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="username" value="<?= $row['username']; ?>">
                                    </div>
                                    <label>รหัสผ่าน</label>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="password" value="<?= $row['password']; ?>">
                                    </div>
                                    <div class="row mt-5 text-center">                      
                                        <button type="submit" class="btn btn-primary" name="update" value="<?= $row['m_id']; ?>">ยืนยันการเปลี่ยนแปลงข้อมูลส่วนตัว</button>                                   
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

    
<?php

    if (isset($_POST['update'])) {

        $m_id         =   $_POST['update'];
        $f_name       =   $_POST['f_name'];
        $phone        =   $_POST['phone'];
        $email        =   $_POST['email'];
        $username     =   $_POST['username'];
        $password     =   $_POST['password'];

        try {

            $update = $conn->prepare("UPDATE members SET  f_name    = :f_name,
                                                        phone     = :phone,
                                                        email     = :email,
                                                        username  = :username,
                                                        password  = :password

                                                        WHERE m_id = :m_id ");
            $update->bindParam(':m_id'      , $m_id);
            $update->bindParam(':f_name'    , $f_name);
            $update->bindParam(':phone'     , $phone);
            $update->bindParam(':email'     , $email);
            $update->bindParam(':username'  , $username);
            $update->bindParam(':password'  , $password);
        

            if ($update->execute()) {
                
                echo "<script>alert('อัพเดทข้อมูลส่วนตัว เรียบร้อย...!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?m_profile\">";
                exit;
            }

        } catch (PDOException $e) {

            echo $e->getMessage();

        } 
        
    }

?>


<?php
        }
?>