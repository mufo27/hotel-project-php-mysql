<?php 
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
            exit();

        } else { 

            require_once 'database/con_db.php';            

            $t_id = $_GET['m_broom'];

            $select = $conn->prepare("SELECT * FROM type WHERE t_id = :t_id");
            $select->bindParam("t_id"   , $t_id);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC);

?>
    
    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.php">Home</a></li>
            <li>ห้องพัก</li>
            <li>กรอกรายละเอียด</li>
            </ol>

        </div>
    </section>
    
    <section id="blog" class="blog">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="blog-comments">
                        <div class="reply-form">

                            <div class="row">
                                <div class="section-title">
                                    <h2>กรอกรายละเอียด</h2>
                                </div>
                            </div>

                                      
                    
                            <form action="index.php?m_payment" method="post">
                                <div class="row">

                                    <h4>
                                        <?= $row['name']; ?>
                                        <input type="hidden" class="form-control" name="name" value="<?= $row['name']; ?>">
                                        <input type="hidden" class="form-control" name="price" value="<?= $row['price']; ?>">
                                    </h4>
                                
                                    <label>จำนวนห้อง</label>
                                    <div class="col-md-6 form-group">
                                        <input type="number" class="form-control" name="num" min="1" required="">
                                    </div>
                                    <label>จำนวนวันเข้าพัก</label>
                                    <div class="col-md-6 form-group">
                                        <input type="number" class="form-control" name="d_number" min="1" required="">
                                    </div>
                                    <label>เช็คอิน</label>
                                    <div class="col-md-12 form-group">
                                        <input type="date" class="form-control" name="check_in" required="">
                                    </div>     
                                    <label>เช็คเอาท์</label>
                                    <div class="col-md-12 form-group">
                                        <input type="date" class="form-control" name="check_out"  required="">
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <h4>เข้าสู่ระบบโดย : <?= $_SESSION['f_name']; ?></h4>
                                </div>

                                <div class="row mt-5">

                                    
                                    <h4>ข้อมูลผู้ติดต่อ</h4>

                                    <div class="row mt-3"></div>
                                    
                                    <label>ชื่อ-สกุล ผู้เข้าพัก</label>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="ad_name" value="<?= $_SESSION['f_name']; ?>" required="">
                                    </div>
    
                                    <div class="row mt-5 text-center">                      
                                        <button type="submit" class="btn btn-primary" name="ok" value="<?= $row['t_id']; ?>">ดำเนินการต่อ</button>  
                                    </div>
                                </div>

                                <div class="row mt-5"></div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">  
                <div class="col-10"></div>
                <div class="col-2">
                    <a href="index.php?type" class="btn btn-primary">ย้อนกลับไป.. ก่อนหน้านี้</a>                                   
                </div>
            </div>
        </div>
    </section>

<?php
        }
?>