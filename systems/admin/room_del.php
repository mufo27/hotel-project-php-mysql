<?php
        require_once '../../database/con_db.php';

        if (isset($_GET['room_del'])) {

            $r_id = $_GET['room_del'];


            try {

                $delete = $conn->prepare("DELETE FROM room WHERE r_id = :r_id");
                $delete->bindParam(':r_id' , $r_id);

                if ($delete->execute()) {

                    echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?room\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>