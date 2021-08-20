<?php
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
            exit();

        } else {

            require_once 'database/con_db.php';            


            if(isset($_GET['m_paypal_food'])){

                $pm_id      =   $_GET['m_paypal_food'];
                $total      =   $_GET['total'];
                $pm_date    =   date('Y-m-d H:i:s');
                $status     =   2;
                

                try {

                    $update = $conn->prepare("UPDATE payment SET pm_date = :pm_date, total = :total, status = :status WHERE pm_id = :pm_id");
                    $update->bindParam(':pm_id'      , $pm_id);
                    $update->bindParam(':pm_date'    , $pm_date);
                    $update->bindParam(':total'      , $total);
                    $update->bindParam(':status'     , $status);
                    
                    if ($update->execute()) {
                        
                        echo "<script>alert('ชำระเงินผ่าน PAYPAL เรียบร้อย...!!')</script>";
                        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?m_food\">";
                        exit;
                    }

                } catch (PDOException $e) {

                    echo $e->getMessage();

                }
                         
            }

        }
?>