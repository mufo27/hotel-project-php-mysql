    <?php session_start(); ?>

    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.html">Home</a></li>
            <li>เข้าสู่ระบบ</li>
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
                                    <h2>เข้าสู่ระบบ</h2>
                                </div>
                            </div>
                    
                            <form action="" method="post">
                                <div class="row">

                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="username" placeholder="ชื้อผู้ใช้งาน" required="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required="">
                                    </div>
                                    <div class="row mt-5 text-center">                      
                                        <button type="submit" class="btn btn-primary" name="login">ยืนยันการเข้าสู่ระบบ</button>                                   
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

        if (isset($_POST['login'])) {

            $username     =   $_POST['username'];
            $password     =   $_POST['password'];

                try {

                    $select_stmt =  $conn->prepare("SELECT username, password, status FROM members WHERE username = :username AND password = :password 
                                                    UNION 
                                                    SELECT username, password, status FROM employee WHERE username = :username AND password = :password");                                           
                    $select_stmt->bindParam(':username'  ,  $username);
                    $select_stmt->bindParam(':password'  ,  $password);
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

                        $dbusername     =   $row['username'];
                        $dbpassword     =   $row['password'];
                        $dbstatus       =   $row['status'];

                    }

                    if ($username != null AND $password != null) {

                        if ($select_stmt->rowCount() > 0) {

                            if ($username == $dbusername AND $password == $dbpassword AND $dbstatus != null) {

                                switch ($dbstatus) {

                                    case '0' :

                                        $select_em =  $conn->prepare("SELECT * FROM employee WHERE username = :username AND password = :password AND status = :status");
                                        $select_em->bindParam(":username"   ,  $username);
                                        $select_em->bindParam(":password"   ,  $password);
                                        $select_em->bindParam(":status"     ,  $dbstatus);
                                        $select_em->execute();
 
                                        while ($row_em = $select_em->fetch(PDO::FETCH_ASSOC)) {

                                            $_SESSION['em_id']        =   $row_em['em_id'];
                                            $_SESSION['username']     =   $row_em['username'];
                                            $_SESSION['f_name']       =   $row_em['f_name'];
                                            $_SESSION['status']       =   $row_em['status'];

                                            echo "<script>alert('ยินดีต้อนรับ ผู้ดูแลระบบ')</script>";
                                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=systems/admin/index.php\">";
                                        }

                                    break;

                                    case '1' :

                                        $select_em =  $conn->prepare("SELECT * FROM employee WHERE username = :username AND password = :password AND status = :status");
                                        $select_em->bindParam(":username"   ,  $username);
                                        $select_em->bindParam(":password"   ,  $password);
                                        $select_em->bindParam(":status"     ,  $dbstatus);
                                        $select_em->execute();
 
                                        while ($row_em = $select_em->fetch(PDO::FETCH_ASSOC)) {

                                            $_SESSION['em_id']        =   $row_em['em_id'];
                                            $_SESSION['username']     =   $row_em['username'];
                                            $_SESSION['f_name']       =   $row_em['f_name'];
                                            $_SESSION['status']       =   $row_em['status'];

                                            echo "<script>alert('ยินดีต้อนรับ ผู้บริหาร')</script>";
                                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=systems/admin/index.php\">";
                                        }

                                    break;

                                    case '2' :

                                        $select_em =  $conn->prepare("SELECT * FROM employee WHERE username = :username AND password = :password AND status = :status");
                                        $select_em->bindParam(":username"   ,  $username);
                                        $select_em->bindParam(":password"   ,  $password);
                                        $select_em->bindParam(":status"     ,  $dbstatus);
                                        $select_em->execute();
 
                                        while ($row_em = $select_em->fetch(PDO::FETCH_ASSOC)) {

                                            $_SESSION['em_id']        =   $row_em['em_id'];
                                            $_SESSION['username']     =   $row_em['username'];
                                            $_SESSION['f_name']       =   $row_em['f_name'];
                                            $_SESSION['status']       =   $row_em['status'];

                                            echo "<script>alert('ยินดีต้อนรับ พนักงานต้อนรับ')</script>";
                                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=systems/admin/index.php\">";
                                        }

                                    break;

                                    case '3' :

                                        $select_em =  $conn->prepare("SELECT * FROM employee WHERE username = :username AND password = :password AND status = :status");
                                        $select_em->bindParam(":username"   ,  $username);
                                        $select_em->bindParam(":password"   ,  $password);
                                        $select_em->bindParam(":status"     ,  $dbstatus);
                                        $select_em->execute();
 
                                        while ($row_em = $select_em->fetch(PDO::FETCH_ASSOC)) {

                                            $_SESSION['em_id']        =   $row_em['em_id'];
                                            $_SESSION['username']     =   $row_em['username'];
                                            $_SESSION['f_name']       =   $row_em['f_name'];
                                            $_SESSION['status']       =   $row_em['status'];

                                            echo "<script>alert('ยินดีต้อนรับ แม่บ้าน')</script>";
                                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=systems/admin/index.php\">";
                                        }

                                    break;

                                    case '4' :

                                        $select_em =  $conn->prepare("SELECT * FROM employee WHERE username = :username AND password = :password AND status = :status");
                                        $select_em->bindParam(":username"   ,  $username);
                                        $select_em->bindParam(":password"   ,  $password);
                                        $select_em->bindParam(":status"     ,  $dbstatus);
                                        $select_em->execute();
 
                                        while ($row_em = $select_em->fetch(PDO::FETCH_ASSOC)) {

                                            $_SESSION['em_id']        =   $row_em['em_id'];
                                            $_SESSION['username']     =   $row_em['username'];
                                            $_SESSION['f_name']       =   $row_em['f_name'];
                                            $_SESSION['status']       =   $row_em['status'];

                                            echo "<script>alert('ยินดีต้อนรับ ฝ่ายโภชนาการ')</script>";
                                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=systems/admin/index.php\">";
                                        }

                                    break;

                                    case '5' :

                                        $select_m =  $conn->prepare("SELECT * FROM members WHERE username = :username AND password = :password AND status = :status");
                                        $select_m->bindParam(":username"   ,  $username);
                                        $select_m->bindParam(":password"   ,  $password);
                                        $select_m->bindParam(":status"     ,  $dbstatus);
                                        $select_m->execute();
 
                                        while ($row_m = $select_m->fetch(PDO::FETCH_ASSOC)) {

                                            $_SESSION['m_id']         =   $row_m['m_id'];
                                            $_SESSION['username']     =   $row_m['username'];
                                            $_SESSION['f_name']       =   $row_m['f_name'];
                                            $_SESSION['status']       =   $row_m['status'];

                                            echo "<script>alert('ยินดีต้อนรับ สมาชิก')</script>";
                                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php\">";
                                        }

                                    break;

                                    default :
                                                echo "<script>alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง..!!')</script>";
                                                echo "<script>window.location='javascript:history.back(-1)';</script>";
                                                exit;

                                }

                            }

                        } else {

                            echo "<script>alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง..!!')</script>";
                            echo "<script>window.location='javascript:history.back(-1)';</script>";
                            exit;

                        }

                    } 

                } catch (PDOException $e) {
                    $e->getMessage();
                }
                         

        }

?>