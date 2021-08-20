<?php 
        session_start();  
        
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=../../index.php?login\">";
            exit();
        } 
        else
        {
               
?>

<!DOCTYPE html>
<html lang="en">
<head>

      <?php include('h.php'); ?>
      <script src="../ckeditor/ckeditor.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">


  <?php include('menu_top.php'); ?>

  <?php include('menu_left.php'); ?>
  
  <div class="content-wrapper">

    <?php 
      
      if(empty($_GET)){
        include "dashboard.php";
      }
        if(isset($_GET['dashboard'])) {
          include "dashboard.php";
        }

        if(isset($_GET['profile'])) {
          include "profile.php";
        }
        
          if(isset($_GET['employee'])) {
            include "employee.php";
          }
          if(isset($_GET['employee_add'])) {
            include "employee_add.php";
          }
          if(isset($_GET['employee_edit'])) {
            include "employee_edit.php";
          }
          if(isset($_GET['employee_del'])) {
            include "employee_del.php";
          }

            if(isset($_GET['member'])) {
              include "member.php";
            }
            if(isset($_GET['member_add'])) {
              include "member_add.php";
            }
            if(isset($_GET['member_edit'])) {
              include "member_edit.php";
            }
            if(isset($_GET['member_del'])) {
              include "member_del.php";
            }

            if(isset($_GET['welcom_p1'])) {
              include "welcom_p1.php";
            }
            if(isset($_GET['welcom_p2'])) {
              include "welcom_p2.php";
            }
            if(isset($_GET['welcom_p3'])) {
              include "welcom_p3.php";
            }           
            if(isset($_GET['welcom_p4'])) {
              include "welcom_p4.php";
            }
            if(isset($_GET['welcom_p5'])) {
              include "welcom_p5.php";
            }
            if(isset($_GET['print_pay'])) {
              include "print_pay.php";
            }
            if(isset($_GET['print_food'])) {
              include "print_food.php";
            }
            
            if(isset($_GET['check_pay'])) {
              include "check_pay.php";
            }
            if(isset($_GET['check_in'])) {
              include "check_in.php";
            }
            if(isset($_GET['check_pay_food'])) {
              include "check_pay_food.php";
            }
            if(isset($_GET['check_detail'])) {
              include "check_detail.php";
            }
            
              if(isset($_GET['news'])) {
                include "news.php";
              }
              if(isset($_GET['news_add'])) {
                include "news_add.php";
              }
              if(isset($_GET['news_edit'])) {
                include "news_edit.php";
              }
              if(isset($_GET['news_del'])) {
                include "news_del.php";
              }

                if(isset($_GET['promotion'])) {
                  include "promotion.php";
                }
                if(isset($_GET['promotion_add'])) {
                  include "promotion_add.php";
                }
                if(isset($_GET['promotion_edit'])) {
                  include "promotion_edit.php";
                }
                if(isset($_GET['promotion_del'])) {
                  include "promotion_del.php";
                }

                  if(isset($_GET['type'])) {
                    include "type.php";
                  }
                  if(isset($_GET['type_add'])) {
                    include "type_add.php";
                  }
                  if(isset($_GET['type_edit'])) {
                    include "type_edit.php";
                  }
                  if(isset($_GET['type_del'])) {
                    include "type_del.php";
                  }
                  if(isset($_GET['type_img'])) {
                    include "type_img.php";
                  }
                  if(isset($_GET['type_img_add'])) {
                    include "type_img_add.php";
                  }
                  if(isset($_GET['type_img_edit'])) {
                    include "type_img_edit.php";
                  }
                  if(isset($_GET['type_img_del'])) {
                    include "type_img_del.php";
                  }

                    if(isset($_GET['room'])) {
                      include "room.php";
                    }
                    if(isset($_GET['room_add'])) {
                      include "room_add.php";
                    }
                    if(isset($_GET['room_edit'])) {
                      include "room_edit.php";
                    }
                    if(isset($_GET['room_del'])) {
                      include "room_del.php";
                    }

                      if(isset($_GET['ceo_p1'])) {
                        include "ceo_p1.php";
                      }
                      if(isset($_GET['ceo_p2'])) {
                        include "ceo_p2.php";
                      }
                      if(isset($_GET['ceo_p3'])) {
                        include "ceo_p3.php";
                      }

                      if(isset($_GET['mom_p1'])) {
                        include "mom_p1.php";
                      }
                      if(isset($_GET['mom_p2'])) {
                        include "mom_p2.php";
                      }

                        if(isset($_GET['food'])) {
                          include "food.php";
                        }
                        if(isset($_GET['food_add'])) {
                          include "food_add.php";
                        }
                        if(isset($_GET['food_edit'])) {
                          include "food_edit.php";
                        }
                        if(isset($_GET['food_del'])) {
                          include "food_del.php";
                        }

                        if(isset($_GET['food_order'])) {
                          include "food_order.php";
                        }
                        if(isset($_GET['food_order_add'])) {
                          include "food_order_add.php";
                        }
                        if(isset($_GET['food_order_view'])) {
                          include "food_order_view.php";
                        }
                        if(isset($_GET['food_order_edit'])) {
                          include "food_order_edit.php";
                        }
                        if(isset($_GET['food_order_del'])) {
                          include "food_order_del.php";
                        }
                      
        
 
        
    ?>


  </div>

	<?php include('f.php'); ?>

</body>
</html>

<?php 
        } 
?>