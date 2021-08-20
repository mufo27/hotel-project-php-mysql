<?php

    require_once '../../database/con_db.php';

    if (isset($_GET['type_del'])) {

      $t_id    =  $_GET['type_del'];
      
      try {

        $select = $conn->prepare("SELECT t_id FROM type WHERE t_id = :t_id");
        $select->bindParam("t_id" , $t_id);
        $select->execute();

            while($row = $select->fetch(PDO::FETCH_ASSOC))
            {
              $delete_img = $conn->prepare("DELETE FROM images WHERE t_id = :t_id");
              $delete_img->bindParam(':t_id' , $row['t_id']);
              $delete_img->execute();

              $delete_room = $conn->prepare("DELETE FROM room WHERE t_id = :t_id");
              $delete_room->bindParam(':t_id' , $row['t_id']);
              $delete_room->execute();

            }

            $delete_video = $conn->prepare("DELETE FROM videos WHERE t_id = :t_id");
            $delete_video->bindParam(':t_id' , $t_id);
            $delete_video->execute();

            $delete_type = $conn->prepare("DELETE FROM type WHERE t_id = :t_id");
            $delete_type->bindParam(':t_id' , $t_id);

            if ($delete_type->execute()) {

                echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type\">";
                exit;
            }

      } catch (PDOException $e) {

          echo $e->getMessage();

      }
        
    }

    

?>