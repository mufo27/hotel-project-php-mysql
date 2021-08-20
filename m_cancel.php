<?php

    if(isset($_SESSION['status']) == "")
    {
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
        exit();

    } else {

        require_once 'database/con_db.php';

        if (isset($_GET['m_cancel'])) {

            $rs_id  =  $_GET['m_cancel'];
            
            try {

                    $delete_pm= $conn->prepare("DELETE FROM payment WHERE rs_id = :rs_id");
                    $delete_pm->bindParam(':rs_id' , $rs_id);
                    $delete_pm->execute();

                    $delete_rs = $conn->prepare("DELETE FROM reserve WHERE rs_id = :rs_id");
                    $delete_rs->bindParam(':rs_id' , $rs_id);

                    if ($delete_rs->execute()) {

                        echo "<script>alert('ยกเลิกการจอง เรียบร้อย...!!')</script>";
                        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?m_reserve\">";
                        exit;
                    }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }
        }
    }
    
?>