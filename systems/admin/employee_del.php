<?php
        require_once '../../database/con_db.php';

        if (isset($_GET['employee_del'])) {

            $em_id = $_GET['employee_del'];
            $status = $_GET['status'];


            try {

                $delete = $conn->prepare("DELETE FROM employee WHERE em_id = :em_id");
                $delete->bindParam(':em_id' , $em_id);

                if ($delete->execute()) {

                    echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?employee=$status\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>