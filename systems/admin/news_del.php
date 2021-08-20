<?php
        require_once '../../database/con_db.php';

        if (isset($_GET['news_del'])) {

            $n_id = $_GET['news_del'];


            try {

                $delete = $conn->prepare("DELETE FROM news WHERE n_id = :n_id");
                $delete->bindParam(':n_id' , $n_id);

                if ($delete->execute()) {

                    echo "<script>alert('ลบข้อมูล เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?news\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>