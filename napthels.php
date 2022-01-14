<?php
// Đạo nhái từ nhiều nguồn bởi to9xvn
// trang web: https://dailysieure.com
// facebook: https://dailysieure.com/to9xvn
include 'core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); 
    exit;
}
if($_SESSION['username'] === $config['username']){
    
    $to9xvn_thongbao = ' <font color="red">Bạn là admin nên nhìn thấy toàn bộ lịch sử của tất cả mọi người</font>';
    $to9xvn01 = ' <th>ID nạp</th>';
    
}




?><div class="col-md-12">
<div class="sa-mainsa">
<div class="container">
<div class="sa-lprod">
<div class="sa-lpmain">
<div class="sa-lsnmain clearfix">Lịch sử 30 thẻ đã nạp gần nhất  <?=$to9xvn_thongbao;?>
<div class="sa-ls-table table-responsive">
<table class="table">
<thead>
   <tr>
	   <th>ID</th>
	 <?=$to9xvn01;?>
	   <th>Mệnh giá</th>
	 
	   <th>Serial</th>
	   <th>Mã Thẻ</th>
	   <th>Loại thẻ</th>
	     <th>Tình Trạng</th>
	   <th>Thời gian</th>
   </tr>
</thead>
<tbody>
<?php
$idtk = $datatk['id'];
if($_SESSION['username'] === $config['username']){ // to9xvn: nếu là ad thì xem full
 $kq_result = mysqli_query($ketnoi, "SELECT * FROM `to9xvn_napthenhanh`  ORDER by ID DESC LIMIT 30");   
}else{
$kq_result = mysqli_query($ketnoi, "SELECT * FROM `to9xvn_napthenhanh` WHERE uid = '".$idtk."' ORDER by ID DESC LIMIT 30");
}
while($get = mysqli_fetch_assoc($kq_result)){
?>
<tr>
   <th scope="row">#<?php echo $get['ID']; ?></th>
  <?php if($_SESSION['username'] === $config['username']){ ?>
    <th scope="row">#<?php echo $get['uid']; ?></th>
  <?php } ?>
   <td><?php echo number_format($get['sotien']); ?><sup>vnđ</sub></td>
   
   <td><?php echo $get['seri']; ?></td>
   <td><?php echo $get['code']; ?></td>
   <td><?php echo $get['loaithe']; ?></td>
   <td style="color:orange;font-weight: 900;" ><?php echo get_string_tinhtrangthe($get['tinhtrang']); ?></td>
   <td><?php echo date("d/m/Y H:i", $get['time']); ?></td>
</tr> 
<?php } ?>
</tbody>
</table>