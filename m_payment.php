<?php
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
            exit();

        } else {

                require_once 'database/con_db.php';   

                if(isset($_POST['ok'])){

                    $t_id      = $_POST['ok'];
                    $ad_name   = $_POST['ad_name'];
                    $name      = $_POST['name'];
                    $price     = $_POST['price'];
                    $num       = $_POST['num'];
                    $d_number  = $_POST['d_number'];
                    $check_in  = $_POST['check_in'];
                    $check_out = $_POST['check_out'];

                    $select = $conn->prepare("SELECT * FROM promotion WHERE t_id = :t_id ");
                    $select->bindParam(':t_id' ,  $t_id);
                    $select->execute();
                    $row = $select->fetch(PDO::FETCH_ASSOC);
                    $discount = 0;
                    $pr_id = $row['pr_id'];

                }


?>



<section class="breadcrumbs">
        <div class="container">

            <ol>
            <li><a href="index.php">Home</a></li>
            <li>ห้องพัก</li>
            <li>กรอกรายละเอียด</li>
            <li>สรุปการจองและการชำระเงิน</li>
            </ol>

        </div>
    </section>
    
    <section id="blog" class="blog">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="blog-comments">
                    <div class="reply-form">

                        <div class="row">
                            <div class="section-title">
                                <h2>สรุปการจองและการชำระเงิน</h2>
                            </div>
                        </div>

                                

                        <form action="index.php?m_pay" method="post">

                            <input type="hidden" class="form-control" name="v1" value="<?= $ad_name;?>">
                            <input type="hidden" class="form-control" name="v2" value="<?= $name; ?>">
                            <input type="hidden" class="form-control" name="v4" value="<?= $num; ?>">
                            <input type="hidden" class="form-control" name="v5" value="<?= $d_number; ?>">
                            <input type="hidden" class="form-control" name="v6" value="<?= $check_in; ?>">
                            <input type="hidden" class="form-control" name="v7" value="<?= $check_out; ?>">
                            <input type="hidden" class="form-control" name="v8" value="<?= $pr_id; ?>">

                            <div class="row">
                                <div class="col-6 mt-3">
                                    <h4>ชื่อ-สกุล ผู้เข้าพัก</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= $ad_name; ?></h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>ประเภทห้องพัก</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= $name; ?></h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>ราคาห้องพัก</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= $price; ?> บาท/คืน</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>จำนวนห้อง</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= $num; ?> ห้อง</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>จำนวนวันเข้าพัก</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= $d_number; ?> วัน</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>เช็คอิน</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= DateThai($check_in); ?></h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>เช็คเอาท์</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= DateThai($check_out); ?></h4>
                                </div> 
 
                                <?php 
                                        if(isset($row['t_id']))
                                        { 
                                            $discount = $row['discount'];

                                ?>
                                <div class="col-6 mt-3">
                                    <h4>โปรโมชั่น <?= $row['name']; ?></h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: <?= $row['discount']; ?> บาท</h4>
                                </div> 
                                <?php
                                        } else {
                                ?>

                                <div class="col-6 mt-3">
                                    <h4>โปรโมชั่น</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <h4>: ไม่มี</h4>
                                </div> 
                                <?php
                                        }
                                ?>
                                
                                
                                <hr class="mt-3">

                                <div class="col-6 mt-3">
                                    <h4>รวมยอดชำระ ทั้งหมด</h4>
                                </div>
                                <div class="col-6 mt-3">
                                    <?php 
                                        $total = $price * $num * $d_number - $discount;
                                    ?>
                                    <h4>: <?= $total; ?> บาท</h4>
                                    <input type="hidden" class="form-control" name="v3" value="<?= $total; ?>">
                                </div>
                            </div>  

                            <div class="row mt-5">
                                <div class="row mt-5 text-center">     
                                    <div class="col-6">
                                        <div class="row">
                                            <button type="submit" name="Bank" value="<?= $t_id; ?>" class="btn btn-primary">ชำระเงินด้วย ธนาคาร</button>                                   
                                        </div>
                                    </div> 
                        </form> 
                                    <div class="col-6">

                                        <div id="paypal-button-container"></div>

                                        <script src="https://www.paypal.com/sdk/js?client-id=AVffUIV1LnVntBSFl41L9-V0R8Qn4FXkZ6Go0qrZPkgEc9BTFVPNnnqhjSQ1emJk54SqBYh_Rc72G6Xb&currency=THB"></script>

                                        <script>
                                        paypal.Buttons({
                                            style: {
                                                layout :'horizontal'
                                            },
                                            createOrder: function(data, actions) {
                                            return actions.order.create({
                                                purchase_units: [{
                                                amount: {
                                                    value: '<?= $total; ?>',
                                                    currency: 'THB'
                                                }
                                                }]
                                            });
                                            },
                                            onApprove: function(data, actions) {
                                            return actions.order.capture().then(function(details) {
                                                window.location.href='index.php?m_paypal=<?= $t_id; ?>&ad_name=<?= $ad_name; ?>&rs_total=<?= $total; ?>&number=<?= $num; ?>&d_number=<?= $d_number; ?>
                                                                                &check_in=<?= $check_in; ?>&check_out=<?= $check_out; ?>&pr_id=<?= $pr_id; ?>';
                                            });
                                            
                                            }
                                        }).render('#paypal-button-container');
                                        </script>

                                    </div>                                                 
                                </div>
                            </div>

                            <div class="row mt-5"></div>

                            </div>
                        

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">  
                <div class="col-10"></div>
                <div class="col-2">
                    <a href="index.php?m_broom=<?= $t_id; ?>" class="btn btn-primary">ย้อนกลับไป.. ก่อนหน้านี้</a>                                   
                </div>
            </div>
        </div>
    </section>

<?php
        }
?>

