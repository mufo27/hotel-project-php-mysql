<?php
        require_once '../../database/con_db.php';

        if (isset($_GET['food_del'])) {

            $f_id = $_GET['food_del'];


            try {

                $delete = $conn->prepare("DELETE FROM food WHERE f_id = :f_id");
                $delete->bindParam(':f_id' , $f_id);

                if ($delete->execute()) {

                    echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?food\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>