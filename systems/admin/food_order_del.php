<?php

    require_once '../../database/con_db.php';

    if (isset($_GET['food_order_del'])) {

      $of_id  =  $_GET['food_order_del'];
      
      try {

            $select = $conn->prepare("SELECT of_id FROM of_detail WHERE of_id = :of_id");
            $select->bindParam("of_id" , $of_id);
            $select->execute();

            while($row = $select->fetch(PDO::FETCH_ASSOC))
            {

              $delete_ofd = $conn->prepare("DELETE FROM of_detail WHERE of_id = :of_id");
              $delete_ofd->bindParam(':of_id' , $row['of_id']);
              $delete_ofd->execute();

            }

            $delete_pm= $conn->prepare("DELETE FROM payment WHERE of_id = :of_id");
            $delete_pm->bindParam(':of_id' , $of_id);
            $delete_pm->execute();

            $delete_of = $conn->prepare("DELETE FROM order_food WHERE of_id = :of_id");
            $delete_of->bindParam(':of_id' , $of_id);

            if ($delete_of->execute()) {

                echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?food_order\">";
                exit;
            }

      } catch (PDOException $e) {

          echo $e->getMessage();

      }
        
    }

    

?>