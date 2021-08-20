<?php 

    if(isset($_SESSION['status']) == "")
    {
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
        exit();

    } else {

	        require_once 'database/con_db.php';  

?>
    <section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.html">Home</a></li>
            <li>รายการสั่งอาหาร</li>
            </ol>

        </div>
    </section>

    <section id="blog" class="blog">
        <div class="aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="blog-comments">
                        <div class="reply-form">

                            <div class="row">
                                <div class="section-title">
                                    <h2>รายการสั่งอาหาร</h2>
                                </div>
                            </div>
                    
                            <div class="row">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">หมายเลขห้องพัก</th>
                                        <th class="text-center">วันที่-เวลา สั่ง</th>
                                        <th class="text-center">เลขที่ใบสั่งอาหาร</th>
                                        <th class="text-center">เลขที่ใบชำระเงิน</th>
                                        <th class="text-center">ยอดชำระเงิน</th>
                                        <th class="text-center">สถานะอาหาร</th>
                                        <th class="text-center">สถานะชำระเงิน</th>
                                        <th class="text-center">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $select = $conn->prepare("SELECT of.*, pm.pm_id, pm.status AS pm_status, pm.total AS pm_total, r.name FROM reserve rs inner join order_food of ON of.rs_id = rs.rs_id inner join payment pm ON pm.of_id = of.of_id inner join room r ON r.r_id = of.r_id WHERE rs.m_id = :m_id");
                                        $select->bindParam("m_id"   , $_SESSION['m_id']);
                                        $select->execute();
                                        
                                        $i = 1;
                                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                                        {

                                ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['name']; ?></td>
                                        <td class="text-center"><?= Datethai1($row['d_date']); ?></td>
                                        <td class="text-center"><?= $row['of_id']; ?></td>
                                        <td class="text-center"><?= $row['pm_id']; ?></td>
                                        <td class="text-center"><?= $row['total']; ?></td>
                                        <td class="text-center">
                                            <?php if($row['status'] == '0'){ ?><span class="text-danger">ยังไม่ได้รับอาหาร</span><?php } ?>
                                            <?php if($row['status'] == '1'){ ?><span class="text-primary">ได้รับอาหารแล้ว</span><?php } ?>
                                        </td>
                                        
                                        <td class="text-center">
                                            <?php if($row['pm_status'] == '0' AND !isset($row['pm_total'])){ ?><span class="text-danger">ยังไม่ชำระเงิน</span><?php } ?>
                                            <?php if($row['pm_status'] == '0' AND isset($row['pm_total'])){ ?><span class="text-warning">รอการยืนยัน</span><?php } ?>
                                            <?php if($row['pm_status'] == '1'){ ?><span class="text-success">ชำระแล้ว (ธนาคาร)</span><?php } ?>
                                            <?php if($row['pm_status'] == '2'){ ?><span class="text-primary">ชำระแล้ว (PAYPAL)</span><?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?m_detail_food=<?= $row['of_id']; ?>&pm_id=<?= $row['pm_id']; ?>" class="text-primary"><h4>คลิก..!!</h4></a>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
        }
?>