<?php
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
            exit();

        } else {

            require_once 'database/con_db.php';            

            if(isset($_POST['Bank'])){

                $t_id  = $_POST['Bank'];
                $v1  = $_POST['v1'];
                $v2  = $_POST['v2'];
                $v3  = $_POST['v3'];
                $v4  = $_POST['v4'];
                $v5  = $_POST['v5'];
                $v6  = $_POST['v6'];
                $v7  = $_POST['v7'];
                $v8  = $_POST['v8'];

            }
?>
    
    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.php">Home</a></li>
            <li>ห้องพัก</li>
            <li>กรอกรายละเอียด</li>
            <li>สรุปการจองและการชำระเงิน</li>
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

                                <input type="hidden" class="form-control" name="v1" value="<?= $v1;?>">
                                <input type="hidden" class="form-control" name="v3" value="<?= $v3; ?>">
                                <input type="hidden" class="form-control" name="v4" value="<?= $v4; ?>">
                                <input type="hidden" class="form-control" name="v5" value="<?= $v5; ?>">
                                <input type="hidden" class="form-control" name="v6" value="<?= $v6; ?>">
                                <input type="hidden" class="form-control" name="v7" value="<?= $v7; ?>">
                                <input type="hidden" class="form-control" name="v8" value="<?= $v8; ?>">

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
                                    <button type="submit" class="btn btn-primary" name="confirm" value="<?= $t_id; ?>">ยืนยันการชำระเงิน</button>                                   
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
                    <form action="index.php?m_payment" method="post">
                        <input type="hidden" class="form-control" name="ad_name" value="<?= $v1;?>">
                        <input type="hidden" class="form-control" name="name" value="<?= $v2; ?>">
                        <input type="hidden" class="form-control" name="price" value="<?= $v3; ?>">
                        <input type="hidden" class="form-control" name="num" value="<?= $v4; ?>">
                        <input type="hidden" class="form-control" name="d_number" value="<?= $v5; ?>">
                        <input type="hidden" class="form-control" name="check_in" value="<?= $v6; ?>">
                        <input type="hidden" class="form-control" name="check_out" value="<?= $v7; ?>">

                        <button type="submit" name="ok" class="btn btn-primary" value="<?= $t_id;?>">ย้อนกลับไป.. ก่อนหน้านี้</button>

                    </form>                             
                </div>                                
            </div>
        </div>
    </section>

<?php

    if(isset($_POST['confirm'])){

            $rs_id     = rand(10000,99999);
            $m_id      = $_SESSION['m_id'];  
            $t_id      = $_POST['confirm'];
            $ad_name   = $_POST['v1'];
            $number    = $_POST['v4'];
            $d_number  = $_POST['v5'];
            $check_in  = $_POST['v6'];
            $check_out = $_POST['v7'];
            $rs_total  = $_POST['v3'];
            $pr_id  = $_POST['v8'];

            $date_reserve =   date('Y-m-d H:i:s');
            $rs_status    =   0;

            $pm_id    =     rand(100000,9999999);
            $pm_date  =     $_POST['pm_date'];
            $pm_total =     $_POST['money'];
            $img      =     file_get_contents($_FILES['img']['tmp_name']);
            $pm_status   =  1;


            try {

                $insert_rs = $conn->prepare("INSERT INTO reserve (rs_id, m_id, t_id, ad_name, number, d_number, check_in, check_out, total, date_reserve, status, pr_id) 
                                             VALUES (:rs_id, :m_id, :t_id, :ad_name, :number, :d_number, :check_in, :check_out, :total, :date_reserve, :status, :pr_id)");
                $insert_rs->bindParam(':rs_id'          ,  $rs_id);
                $insert_rs->bindParam(':m_id'           ,  $m_id);
                $insert_rs->bindParam(':t_id'           ,  $t_id);
                $insert_rs->bindParam(':ad_name'        ,  $ad_name);
                $insert_rs->bindParam(':number'         ,  $number);
                $insert_rs->bindParam(':d_number'       ,  $d_number);
                $insert_rs->bindParam(':check_in'       ,  $check_in);
                $insert_rs->bindParam(':check_out'      ,  $check_out);
                $insert_rs->bindParam(':total'          ,  $rs_total);
                $insert_rs->bindParam(':date_reserve'   ,  $date_reserve);
                $insert_rs->bindParam(':status'         ,  $rs_status);
                $insert_rs->bindParam(':pr_id'          ,  $pr_id);
                $insert_rs->execute(); 
                
                $insert_pm = $conn->prepare("INSERT INTO payment (pm_id, rs_id, total, pm_date, img, status) 
                                             VALUES (:pm_id, :rs_id, :total, :pm_date, :img, :status)");
                $insert_pm->bindParam(':pm_id'       ,  $pm_id);
                $insert_pm->bindParam(':rs_id'       ,  $rs_id);
                $insert_pm->bindParam(':total'       ,  $pm_total);
                $insert_pm->bindParam(':pm_date'     ,  $pm_date);
                $insert_pm->bindParam(':img'         ,  $img);
                $insert_pm->bindParam(':status'      ,  $pm_status);      
                $insert_pm->execute();

                require 'PHPMailer/PHPMailerAutoload.php';
             
                $mail = new PHPMailer();                  
                $mail->CharSet = "utf-8";
                $mail ->IsSmtp();

                $mailto  = "noreply@gmail.com";
                $mailSub = "มีการจองห้องพักมาใหม่่";
                $mailMsg =  "\r\n".'รหัสการจอง : '.$rs_id.
                                "\r\n".'วันที่จอง : '.$date_reserve.
                                "\r\n".'ยอดชำระทั้งหมด : '.$rs_total.
                                "\r\n".'ชำระเงินผ่าน ธนาคาร เลขที่ชำระเงิน : '.$pm_id;
                        
                $mail ->SMTPAuth = true;
                $mail ->SMTPSecure = 'tls';
                $mail ->Host = "smtp.gmail.com";
                $mail ->Port = 587; // or 587
                //$mail ->IsHTML(true);
                $mail ->Username = "watcharapongmufo27@gmail.com";
                $mail ->Password = "0989193248";
                $mail ->SetFrom("watcharapongmufo27@gmail.com", "ผู้ดูแลระบบ");
                $mail ->Subject = $mailSub;
                $mail ->Body = $mailMsg;
                $mail ->AddAddress($mailto);
                    

                if ($mail->Send()) {
                        
                    echo "<script>alert('ดำเนินการสำเสร็จ ขอบคูณที่ใช้บริการ...!!')</script>"; 
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?m_reserve\">";
                    exit;

                } else {

                    echo "<script>alert('error..!!')</script>";
                    echo"<script>window.location='javascript:history.back(-1)';</script>";
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