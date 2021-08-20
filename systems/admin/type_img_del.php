<?php

    require_once '../../database/con_db.php';

    if (isset($_GET['type_img_del'])) {

        $i_id   =  $_GET['type_img_del'];
        $t_id   =  $_GET['t_id'];
      
        try {

            $delete = $conn->prepare("DELETE FROM images WHERE i_id = :i_id");
            $delete->bindParam(':i_id' , $i_id);

            if ($delete->execute()) {

                echo "<script>alert('ลบรูปภาพ เรียบร้อย...!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type_img=$t_id\">";
                exit;
            }

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
        
    }

    

?>