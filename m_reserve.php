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
            <li>รายการจองห้องพัก</li>
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
                                    <h2>รายการจองห้องพัก</h2>
                                </div>
                            </div>
                    
                            <div class="row">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th class="text-center" style="width: 5%">ลำดับ</th>
                                    <th class="text-center" style="width: 10%">เลขที่การจอง</th>
                                    <th style="width: 15%">ชื่อผู้เข้าพัก</th>
                                    <th style="width: 15%">ประเภทห้องพัก</th>
                                    <th class="text-center" style="width: 7%">ราคา/คืน</th>
                                    <th class="text-center" style="width: 7%">จำนวน/ห้อง</th>
                                    <th class="text-center" style="width: 8%">รวมยอดชำระ</th>
                                    <th class="text-center" style="width: 10%">สถานะการจอง</th>
                                    <th class="text-center" style="width: 10%">สถานะชำระเงิน</th>
                                    <th class="text-center" style="width: 10%">รายละเอียด</th>
                                    <th class="text-center" style="width: 10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $select = $conn->prepare("SELECT rs.*, t.name , t.price, pm.status AS pm_status FROM reserve rs inner join type t ON rs.t_id = t.t_id  inner join payment pm ON pm.rs_id = rs.rs_id WHERE rs.m_id = :m_id");
                                        $select->bindParam("m_id"   , $_SESSION['m_id']);
                                        $select->execute();

                                        $i = 1;
                                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                                        {

                                ?>
                                    <tr>
                                        <th class="text-center"><?= $i++; ?></th>
                                        <td class="text-center"><?= $row['rs_id']; ?></td>
                                        <td><?= $row['ad_name']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td class="text-center"><?= $row['price']; ?></td>
                                        <td class="text-center"><?= $row['number']; ?></td>
                                        <td class="text-center"><?= $row['total'];  ?></td>
                                        <td class="text-center">
                                            <?php if($row['status'] == '0'){ ?><span class="text-warning">รอการยืนยัน</span><?php } ?>
                                            <?php if($row['status'] == '1'){ ?><span class="text-primary">จองสำเร็จ</span><?php } ?>
                                            <?php if($row['status'] == '2'){ ?><span class="text-success">check in</span><?php } ?>
                                            <?php if($row['status'] == '3'){ ?><span class="text-danger">check out</span><?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($row['pm_status'] == '1'){ ?><span class="text-success">ชำระแล้ว (ธนาคาร)</span><?php } ?>
                                            <?php if($row['pm_status'] == '2'){ ?><span class="text-primary">ชำระแล้ว (PAYPAL)</span><?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?m_detail=<?= $row['rs_id']; ?>" class="text-primary"> <h4>คลิก..!!</h4></a>
                                        </td>
                                        <td class="text-center">
                                            <?php if($row['status'] == '0'){ ?><a href="index.php?m_cancel=<?= $row['rs_id']; ?>" class="get-started-btn1 scrollto">ยกเลิก</a><?php } ?>
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