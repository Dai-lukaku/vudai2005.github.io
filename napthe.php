<?php
// Đạo nhái từ nhiều nguồn bởi to9xvn
// trang web: https://dailysieure.com
// facebook: https://dailysieure.com/to9xvn
include 'core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); 
    exit;
}
include 'layout/header.php';
$idtk = $datatk['id'];

/////////////////////////
//  Anti Bug hack by to9xvn //
// Xoá đi hoặc sửa nếu bị bug thì mình k chịu trách nhiệm //
///////////////////////// GET
 foreach($_GET as $var => $value) {
   
    $_GET["$var"]= strip_tags(mysqli_real_escape_string($ketnoi, $value));
}

// POST
foreach($_POST as $var => $value) {
 
    $_POST["$var"] =strip_tags(mysqli_real_escape_string($ketnoi, $value));
} 

// $_SESSION
foreach($_SESSION as $var => $value) {
    
    $_SESSION["$var"]= strip_tags(mysqli_real_escape_string($ketnoi, $value));

} 

// $_COOKIE
foreach($_COOKIE as $var => $value) {
 
    $_COOKIE["$var"]= strip_tags(mysqli_real_escape_string($ketnoi, $value));
}


date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_POST['submit'])) {
    if (!isset($_POST['telco']) || !isset($_POST['amount']) || !isset($_POST['serial']) || !isset($_POST['code'])) {
        $err = 'Bạn cần nhập đầy đủ thông tin';
    } else {
        $telco = $_POST['telco'];
        $amount = $_POST['amount'];
        $serial = $_POST['serial'];
        $code = $_POST['code'];
        
		$command = 'charging';  // Nap the

        require_once('to9xvn_tsr.php'); 

        $request_id = rand(100000000, 999999999); /// Order id của bạn, ví dụ này lấy ngẫu nhiên để test

            $dataPost = array();
			$dataPost['partner_id'] = $partner_id;
			$dataPost['request_id'] = $request_id;
			$dataPost['telco'] = $telco;
			$dataPost['amount'] = $amount;
			$dataPost['serial'] = $serial;
			$dataPost['code'] = $code;
			$dataPost['command'] = $command;
			$sign = creatSign($partner_key, $dataPost);
			$dataPost['sign'] = $sign;
			
            $data = http_build_query($dataPost);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            curl_setopt($ch, CURLOPT_REFERER, $actual_link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            $obj = json_decode($result);

            if ($obj->status == 99) {
                //Gửi thẻ thành công, đợi duyệt.
                echo '<pre>';
                //print_r($obj);
                
                
                	mysqli_query($ketnoi, "INSERT INTO to9xvn_napthenhanh SET 
	`uid` = '".$idtk."',
	`sotien` = '".$amount."',
	`seri` = '".$serial."',
	`code` = '".$code."',
	`loaithe` = '".$telco."',
	`tinhtrang` = '0',
	`noidung` = '".$sign." nạp thẻ ".$tranid." ',
	`time` = '".time()."'") or exit;
                
                
                
                echo '</pre>';
            } elseif($obj->status == 1) {
                //Thành công
                echo '<pre>';
                // print_r($obj);
                echo '</pre>';
            }elseif($obj->status == 2) {
                //Thành công nhưng sai mệnh giá
                echo '<pre>';
              //  print_r($obj);
                echo '</pre>';
            }elseif($obj->status == 3) {
                //Thẻ lỗi
                echo '<pre>';
              //  print_r($obj);
                echo '</pre>';
            }elseif($obj->status == 4) {
                //Bảo trì
                echo '<pre>';
              //  print_r($obj);
                echo '</pre>';
			}else{
				//Lỗi
                echo '<pre>';
              //  print_r($obj);
                echo '</pre>';
			}

        
    }
  
$tbcmmm = $obj->message;
   
    if($tbcmmm){
  	echo "<script>alert('".$tbcmmm."')</script>";  
}
    
}










?>
		



<section class="main-slider">
<link rel="stylesheet" href="http://buitodemo.cf/giaodien02/css/style.css"/><section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical" style="background-position: center 0px;">
<div class="container">
<div class="row">
<h1 class="page-title">
NẠP TIỀN VÀO TÀI KHOẢN</h1>
<div class="breadcrumbs">

</div>
</div>
</div>
</section>
<div class="sa-mainsa">

<section class="single-team ptb150">
<div class="container">
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-8" style="float:none;margin:0 auto;">
            <form method="POST" action="">
                <div class="form-group">
                    <label>Loại thẻ:</label>
                    <select class="form-control" name="telco">
                        <option value="">-- Chọn loại thẻ --</option>
                     <option value="VIETTEL">Viettel</option>
                        <option value="MOBIFONE">Mobifone</option>
                        
                        <option value="VINAPHONE">Vinaphone</option>
                        
                        <option value="GATE">Gate</option>
                        <option value="ZING">Zing</option>
                        <option value="MEGACARD">Megacard</option>
                        <option value="BIT">BIT</option>
                        <option value="GARENA">Garena</option>
                    </select>
                </div>


                <div class="form-group">
                    <label>Mệnh giá:</label>
                    <select class="form-control" name="amount">
                        <option value="">-- Chọn mệnh giá --</option>
                        <option value="10000">10,000đ</option>
                        <option value="20000">20,000đ</option>
                        <option value="30000">30,000đ</option>
                        <option value="50000">50,000đ</option>
                        <option value="100000">100,000đ</option>
                        <option value="200000">200,000đ</option>
                        <option value="300000">300,000đ</option>
                        <option value="500000">500,000đ</option>
                        <option value="1000000">1,000,000đ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Số seri:</label>
                    <input type="text" class="form-control" name="serial"/>
                </div>
                <div class="form-group">
                    <label>Mã thẻ:</label>
                    <input type="text" class="form-control" name="code"/>
                </div>
                <div class="form-group">
                    <?php echo (isset($err)) ? '<div class="alert alert-danger" role="alert">' . $err . '</div>' : ''; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block" name="submit">NẠP NGAY</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>






<?php

/// Source Code Được viết bởi HOÀNG MINH THUẬN - TOMDZ
/// LIÊN HỆ ĐẶT MUA CODE WWW.FACEBOOK.COM/THUANKENYS
/// KHÔNG XÓA DÒNG NÀY ĐỂ TÔN TRỌNG BẢN QUYỀN TÁC GIẢ


?>

 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        
<script type="text/javascript">
setInterval(function(){
   $('#my_to9xvn').load('napthels.php');
}, 2000) /* time in milliseconds (ie 2 seconds)*/
</script>
<div id="my_to9xvn"></div> 


<!-- Phần hiển thị Nick -->
</div>
</div>


</div>
</div>
</div>


</section>

<br><br><br><br><br><br>

<?php


// include 'layout/footer.php';
// không bật footer tránh lỗi css