<?php
        require_once '../../database/con_db.php';

        if (isset($_GET['promotion_del'])) {

            $pr_id = $_GET['promotion_del'];


            try {

                $delete = $conn->prepare("DELETE FROM promotion WHERE pr_id = :pr_id");
                $delete->bindParam(':pr_id' , $pr_id);

                if ($delete->execute()) {

                    echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?promotion\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>