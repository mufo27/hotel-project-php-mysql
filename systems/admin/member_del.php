<?php
        require_once '../../database/con_db.php';

        if (isset($_GET['member_del'])) {

            $m_id = $_GET['member_del'];


            try {

                $delete = $conn->prepare("DELETE FROM members WHERE m_id = :m_id");
                $delete->bindParam(':m_id' , $m_id);

                if ($delete->execute()) {

                    echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?member\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>