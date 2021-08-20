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
            <li>รายละเอียด</li>
            </ol>

        </div>
    </section>
    
    <section id="blog" class="blog">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-comments">
                      <div class="reply-form">

                            <div class="row">
                                <div class="section-title">
                                    <h2>รายละเอียด รายการสั่งอาหาร</h2>
                                </div>
                            </div>
                      

                            <div class="row">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">รายการอาหาร</th>
                                            <th class="text-center">ราคา</th>
                                            <th class="text-center">จำนวน</th>
                                            <th class="text-center">ยอดชำระ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            if(isset($_GET['m_detail_food']))
                                            {
                                                $of_id = $_GET['m_detail_food'];
                                                $pm_id = $_GET['pm_id'];
                                                
                                                $select_pm = $conn->prepare("SELECT total FROM payment WHERE pm_id = :pm_id");
                                                $select_pm->bindParam("pm_id"   , $pm_id);
                                                $select_pm->execute();
                                                $row_pm = $select_pm->fetch(PDO::FETCH_ASSOC);

                                                $select = $conn->prepare("SELECT ofd.*, f.name, f.price , of.total FROM of_detail ofd inner join food f ON f.f_id = ofd.f_id inner join order_food of ON of.of_id = ofd.of_id WHERE ofd.of_id = :of_id");
                                                $select->bindParam("of_id"   , $of_id);
                                                $select->execute();                                       
                                            
                                            }
                                            
                                            $i = 1;
                                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                                            { 
                                                $total = $row['total'];

                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $row['name']; ?></td>
                                            <td class="text-center"><?= $row['price']; ?></td>
                                            <td class="text-center"><?= $row['number']; ?></td>
                                            <td class="text-center"><?= $row['sum_price']; ?></td>
                                        </tr>

                                    <?php } ?>
                                    <tr> 
                                        <td colspan="4" class="text-end"> 
                                            <h4>ยอดชำระเงิน รวมทั้งหมด</h4>
                                        </td>
                                        <td class="text-center"><?= $total; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>  
                            
                            <?php if(!isset($row_pm['total'])) { ?>
                            <div class="row mt-5">  

                                <div class="col-2"></div>
                                <div class="col-4">
                                        <div class="row"> 
                                            <a href="index.php?m_pay_food=<?= $pm_id; ?>" class="btn btn-primary">ชำระเงินด้วย ธนาคาร</a> 
                                        </div>                              
                                </div> 

                                <div class="col-4">

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
                                                window.location.href='index.php?m_paypal_food=<?= $pm_id; ?>&total=<?= $total; ?>';
                                            });
                                            
                                            }
                                        }).render('#paypal-button-container');
                                        </script>

                                </div> 
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">  
                <div class="col-10"></div>
                <div class="col-2">
                    <a href="index.php?m_food" class="btn btn-primary">ย้อนกลับไป.. ก่อนหน้านี้</a>                                   
                </div>
            </div>
        </div>
    </section>

<?php
      }
?>