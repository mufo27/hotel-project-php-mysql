


                                    <?php

        require_once 'database/con_db.php';   

        if (isset($_GET['m_payment'])) {

            $t_id         =   $_POST['ok'];
            $name         =   $_POST['name'];

            $price        =   $_POST['price'];

            $number       =   $_POST['num'];
            $d_number     =   $_POST['d_number'];
            $ad_name      =   $_POST['ad_name'];
            $check_in     =   $_POST['check_in'];
            $check_out    =   $_POST['check_out'];

            $total = $price * $d_number * $number;

            $m_id         =   $_SESSION['m_id'];  
            $date_reserve =   date('Y-m-d');
            $status       =   1;

            try {
    
                $insert = $conn->prepare("INSERT INTO reserve (t_id, nuber, d_number, ad_name, check_in, check_out, m_id, date_reserve, status, total) 
                                            VALUES (:t_id, :nuber, :d_number, :ad_name, :check_in, :check_out, :m_id, date_reserve, :status, :total)");
                $insert->bindParam(':t_id'        ,  $t_id);
                $insert->bindParam(':number'      ,  $number);
                $insert->bindParam(':d_number'    ,  $d_number);
                $insert->bindParam(':ad_name'     ,  $ad_name);
                $insert->bindParam(':check_in'    ,  $check_in);
                $insert->bindParam(':check_out'   ,  $check_out);
                $insert->bindParam(':m_id'        ,  $m_id);
                $insert->bindParam(':date_reserve',  $date_reserve);
                $insert->bindParam(':status'      ,  $status);
                $insert->bindParam(':total'       ,  $total);
    
                if ($insert->execute()) {
                    
                    echo "<script>alert('จองห้องพัก เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?m_payment\">";
                    exit;           
    
                }
    
            } catch (PDOException $e) {
    
                echo $e->getMessage();
    
            }

        }

?>

<!-- <div id="paypal-button-container"></div>

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
                                                window.location.href='index.php?m_pay=<?= $row_pm['pm_id']; ?>&number=<?= $pay_total; ?>';
                                            });
                                            
                                            }
                                        }).render('#paypal-button-container');
                                        </script>
                                -->

            print_r("<br>");
            print_r("<br>");
            print_r("<br>");
            print_r("<br>");
            print_r("<br>");
            print_r("<br>");

            print_r($rs_id);
            print_r("<br>");
            print_r($ad_name);
            print_r("<br>");
            print_r($t_id);
            print_r("<br>");
            print_r($price);
            print_r("<br>");
            print_r($number);
            print_r("<br>");
            print_r($d_number);
            print_r("<br>");
            print_r($check_in);
            print_r("<br>");
            print_r($check_out);
            print_r("<br>");
            print_r($rs_total);
            print_r("<br>");
            
            print_r($m_id);
            print_r("<br>");
            print_r($date_reserve);
            print_r("<br>");
            print_r($rs_status);
            print_r("<br>");

            print_r($pm_id);
            print_r("<br>");
            print_r($pm_date);
            print_r("<br>");
            print_r($pm_total);
            print_r("<br>");
            print_r($img);
            print_r("<br>");
            print_r($pm_status);