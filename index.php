<?php session_start();                           
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
  <?php include('h.php'); ?>

</head>

<body>

  <?php include('menu_top.php'); ?>


  <?php 
        
        if(empty($_GET)){
          include "home.php";
        }
          if(isset($_GET['home'])) {
            include "home.php";
          }
          if(isset($_GET['news'])) {
            include "news.php";
          }
          if(isset($_GET['promotion'])) {
            include "promotion.php";
          }
          if(isset($_GET['type'])) {
            include "type.php";
          }
          if(isset($_GET['type_detail'])) {
            include "type_detail.php";
          }
          if(isset($_GET['login'])) {
            include "login.php";
          }
          if(isset($_GET['register'])) {
            include "register.php";
          }

          if(isset($_GET['m_profile'])) {
            include "m_profile.php";
          }
          if(isset($_GET['m_reserve'])) {
            include "m_reserve.php";
          }
          if(isset($_GET['m_food'])) {
            include "m_food.php";
          }
          if(isset($_GET['m_payment'])) {
            include "m_payment.php";
          }
          if(isset($_GET['m_pay'])) {
            include "m_pay.php";
          }
          if(isset($_GET['m_paypal'])) {
            include "m_paypal.php";
          }
          if(isset($_GET['m_detail'])) {
            include "m_detail.php";
          }
          if(isset($_GET['m_broom'])) {
            include "m_broom.php";
          }
          if(isset($_GET['m_detail_food'])) {
            include "m_detail_food.php";
          }
          if(isset($_GET['m_pay_food'])) {
            include "m_pay_food.php";
          }
          if(isset($_GET['m_paypal_food'])) {
            include "m_paypal_food.php";
          }
          if(isset($_GET['m_cancel'])) {
            include "m_cancel.php";
          }
      ?>


  <?php include('f.php'); ?>

</body>

</html>