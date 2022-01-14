<?php
include 'core/config.php';
if(isset($_SESSION['username'])){
include 'pages/trang-chu.php';
}else{
 include 'pages/dang-nhap.php';  
}