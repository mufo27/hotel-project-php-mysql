<?php
      if(isset($_SESSION['status']) == "")
      {
          echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
          exit();

      } else {

        require_once 'database/con_db.php';  


        if(isset($_GET['m_detail']))
        {
            $rs_id = $_GET['m_detail'];
            $select = $conn->prepare("SELECT r.*, t.name , t.price, pm.status AS pm_status FROM reserve r inner join type t ON r.t_id = t.t_id  inner join payment pm ON pm.rs_id = r.rs_id WHERE r.rs_id = :rs_id");
            $select->bindParam("rs_id"   , $rs_id);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC);
        }
                                        
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
                                    <h2>รายละเอียด การจองห้องพัก</h2>
                                </div>
                            </div>
                      

                            <div class="row">
                                <div class="col-3 mt-3">
                                    <h4>วันที่จอง</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= DateThai1($row['date_reserve']); ?></h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>เลขที่การจอง</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= $row['rs_id']; ?></h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>ชื่อผู้เข้าพัก</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= $row['ad_name']; ?></h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>ประเภทห้องพัก</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= $row['name']; ?></h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>ราคา/คืน</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= $row['price']; ?> บาท</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>จำนวน/ห้อง</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= $row['number']; ?> ห้อง</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>จำนนวน/วันเข้าพัก</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= $row['d_number']; ?> วัน</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>ยอดชำระ</h4>
                                </div>
                                <div class="col-3 mt-3">
                                    <h4>: <?= $row['rs_id']; ?></h4>
                                </div>
                               
                            </div>  
                          
                        

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">  
                <div class="col-10"></div>
                <div class="col-2">
                    <a href="index.php?m_reserve" class="btn btn-primary">ย้อนกลับไป.. ก่อนหน้านี้</a>                                   
                </div>
            </div>
        </div>
    </section>

<?php
      }
?>