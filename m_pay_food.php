<?php
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
            exit();

        } else {

            require_once 'database/con_db.php';            

            if(isset($_GET['m_pay_food'])){

                $pm_id  = $_GET['m_pay_food'];

            }
?>
    
    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.php">Home</a></li>
            <li>รายการสั่งอาหาร</li>
            <li>รายละเอียด</li>
            <li>ชำระเงินธนาคาร</li>
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
                                    <h2>ชำระเงินด้วยธนาคาร</h2>
                                </div>
                            </div>                                                    
                    
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="row">

                                    <label>วันที่ โอนเงิน</label>
                                    <div class="col-md-12 form-group">
                                        <input type="datetime-local" class="form-control" name="pm_date" required="">
                                    </div>
                                    <label>จำเงินที่ โอนเงิน</label>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" name="money" required="">
                                    </div>
                                    <label>รูปภาพ หลักฐาน(สลิปโอน)</label>
                                    <div class="col-md-12 form-group">
                                        <input type="file" class="form-control" name="img"  required="">
                                    </div>
                                </div>

                                <div class="row mt-5">  
                                    <button type="submit" class="btn btn-primary" name="confirm" value="<?= $pm_id; ?>">ยืนยันการชำระเงิน</button>                                   
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
                    <button type="submit" class="btn btn-primary" name="back" onclick="history.go(-1)"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับไป.. ก่อนหน้านี้</button>   
                </div>                                
            </div>
        </div>
    </section>

<?php

    if(isset($_POST['confirm'])){

            
        $pm_id      =     $_POST['confirm'];
        $pm_date    =     $_POST['pm_date'];
        $total      =     $_POST['money'];
        $img        =     file_get_contents($_FILES['img']['tmp_name']);
        $status     =  0;

        try {

            $update = $conn->prepare("UPDATE payment SET pm_date = :pm_date, total = :total, img = :img, status = :status WHERE pm_id = :pm_id");
            $update->bindParam(':pm_id'      , $pm_id);
            $update->bindParam(':pm_date'    , $pm_date);
            $update->bindParam(':total'      , $total);
            $update->bindParam(':img'        , $img);
            $update->bindParam(':status'     , $status);
            
            if ($update->execute()) {
                
                echo "<script>alert('ชำระเงินผ่าน ธนาคาร เรียบร้อย...!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?m_food\">";
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