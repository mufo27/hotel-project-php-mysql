<?php 
    if(isset($_SESSION['status']) == "")
    {
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
        exit();

    } else {

        require_once 'database/con_db.php'; 

        if (isset($_GET['m_paypal'])) {

            $rs_id     = rand(10000,99999);
            $m_id      = $_SESSION['m_id'];  
            $t_id      = $_GET['m_paypal'];
            $ad_name   = $_GET['ad_name'];
            $number    = $_GET['number'];
            $d_number  = $_GET['d_number'];
            $check_in  = $_GET['check_in'];
            $check_out = $_GET['check_out'];
            $rs_total  = $_GET['rs_total'];
            $pr_id     = $_GET['pr_id'];
            $date_reserve =   date('Y-m-d H:i:s');
            $rs_status    =   0;

            $pm_id     = rand(100000,9999999);
            $pm_date   = date('Y-m-d H:i:s');
            $pm_status = 2;

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
                
                $insert_pm = $conn->prepare("INSERT INTO payment (pm_id, rs_id, total, pm_date, status) 
                                             VALUES (:pm_id, :rs_id, :total, :pm_date, :status)");
                $insert_pm->bindParam(':pm_id'       ,  $pm_id);
                $insert_pm->bindParam(':rs_id'       ,  $rs_id);
                $insert_pm->bindParam(':total'       ,  $rs_total);
                $insert_pm->bindParam(':pm_date'     ,  $pm_date);
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
                            "\r\n".'ชำระเงินผ่าน PAYPAL เลขที่ชำระเงิน : '.$pm_id;
                        
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
                        
                    echo "<script>alert('ชำระเงินผ่านระบบ PAYPAL สำเร็จ...!! ขอบคูณที่ใช้บริการ...!!')</script>"; 
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