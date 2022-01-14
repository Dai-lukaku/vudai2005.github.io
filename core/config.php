<?php
error_reporting(0);
ob_start();
session_start();
define('HACKER','PRO TÍNH LÀM GÌ ?');
define('SERVERNAME','localhost');
define('USERNAME','phandinh_linhcoder');
define('PASSWORD','Tragiang12345');
define('DATABASE','phandinh_linhcoder');
$conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die("Không Thể Kết Nối Database");
mysqli_set_charset($conn,"utf8");
$root = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$time = time();
$date = date('d/m/Y - H:i:s');
$config = array(
    'domain' => 'PhanDinhHung.Store',
    'idfb' => '1590544333',
    'phone' => '01040701976',
    'admin' => 'Phan Đình Hưng',
    'admin2' => 'Hoàng Nguyễn Thị Mỹ Phương',
    'username' => 'kkkkkk',
    'baotri' => 'abc', // nội dung bảo trì
);

// PHANDINHHUNG
if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];
   $account = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `users` WHERE `username`='".$username."'"));

}
include 'goi-dich-vu.php';
 
 $ketnoi = $conn;   $datatk = $account; // đoạn này của to9xvn
 
function get_string_tinhtrangthe($tinhtrangthe) {
switch ($tinhtrangthe) {
case 0:
$str = '<span class="btn btn-warning form-fontrol">Chờ xử lý</span>';
break;
case 1:
$str = '<span class="btn btn-success form-fontrol">Nạp Thành Công</span>';
break;
case 2:
$str = '<div class="btn" style="background-color:red;color:#fff; ">Thẻ Sai</div>';
break;
default:
$str = '<span class="btn btn-danger form-fontrol">Lỗi Chưa Xác Định</span>';
break;
}
return $str;
}
