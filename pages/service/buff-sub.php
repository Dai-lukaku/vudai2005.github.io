<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
function tinhtien($loai,$soluong,$goibuffsub){
  $tongthanhtoan = $goibuffsub['rate'][$loai] * $soluong;
  $tinhtien = array('tongthanhtoan' => $tongthanhtoan ,'fmtongthanhtoan' => number_format($tongthanhtoan));
  return $tinhtien;
}
if($_GET['type'] === 'tinhtien'){
$loai = $goibuffsub['loai'][$_GET['loai']];
$key = array_search($_GET['soluong'],$goibuffsub['soluong']);
if($loai && $key){
   echo json_encode(tinhtien(addslashes($_GET['loai']),$key,$goibuffsub));
}
exit;
}
if($_POST['type'] === 'thanhtoan' && $_POST['idprofile'] && is_numeric($_POST['loai']) && is_numeric($_POST['soluong']) && $_POST['soluong'] > 0 && $goibuffsub['loai'][$_POST['loai']] && array_search($_POST['soluong'],$goibuffsub['soluong'])){
    $idprofile = addslashes($_POST['idprofile']);
    $loai = addslashes($_POST['loai']);
    $soluong = addslashes($_POST['soluong']);
    $key = array_search($soluong,$goibuffsub['soluong']);
    $tinhtien = tinhtien($_POST['loai'],$key,$goibuffsub);
    $tongthanhtoan = $tinhtien['tongthanhtoan'];
      if(!$tongthanhtoan){
        echo '<script>alert("Thông tin thanh toán không hợp lệ");</script>';
      }else if($tongthanhtoan > $account['vnd']){
        echo '<script>alert("Bạn không đủ tiền để thanh toán");</script>';
      }else{
        mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`-'$tongthanhtoan' WHERE `username`='$username'");
        mysqli_query($conn,"INSERT INTO `buffsub`(`id`, `idprofile`, `loai`, `soluong`, `tongthanhtoan`, `status`, `time`, `username`) VALUES (NULL,'$idprofile','$loai','$soluong','$tongthanhtoan',0,'$time','$username')");
        echo '<script>alert("Thanh toán thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-sub.html"},2000);</script>';
      }
exit; 
}
$title = "Buff sub profile";
include '../../layout/header.php';
?>
<div class="row">
    <div class="col-md-6">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm ID <?= $title; ?></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
         <div class="row">
          <div class="col-md-6">
          <div class="form-group">
        <input type="TEXT" class="form-control" id="idprofile" placeholder="ID profile" onkeyup="tinhtien();">
      </div>
          </div>
         <div class="col-md-6">
         <div class="form-group">
               <div class="form-group">
            <select class="form-control" id="loai" onchange="tinhtien()">
                   <option value=""> -- Chọn loại sub --</option>
                   <option value="1"> <?= $goibuffsub['loai'][1] ?></option>
                   <option value="2"> <?= $goibuffsub['loai'][2] ?></option>
                   <option value="3"> <?= $goibuffsub['loai'][3] ?></option>                         
             </select>
        </div> 
      </div>
          </div>
      </div>
         <div class="form-group">
            <select class="form-control" id="soluong" onchange="tinhtien()">
                   <option value=""> -- Chọn số lượng sub --</option>
    
                   <?php for($i = 1; $i<= count($goibuffsub['soluong']); $i++){ ?>
                   <option value="<?= $goibuffsub['soluong'][$i] ?>"> <?= number_format($goibuffsub['soluong'][$i]) ?> sub</option>
                   <?php } ?>
             </select>
        </div>                 
      <div class="form-group">
             <label class="active">Tổng Thanh Toán: <font color="red"><b id="tongthanhtoan">0</b></font> VNĐ</label>
           </div>
      <div class="form-group text-center">
          <button type="button" class="btn btn-primary" id="thanhtoan" onclick="thanhtoan();"><i class="fa fa-shopping-cart"></i> Thanh toán</button>
      </div>
                        </div>
                    </div>
    </div>
    <div class="col-md-6">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Chú ý</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
              <div>
                  <p>
                      <b class="text-danger">* BUFF SUB PROFILE :</b>
                      <div><strong>+ Phải cài đặt năm sinh trong thông tin cá nhân trên Facebook của bạn sao cho đủ 18 tuổi tính đến năm hiện tại (tức là năm sinh phải từ 2000 về trước)</strong></div>
                      <div><strong>+ Phải cài đặt năm sinh trong thông tin cá nhân trên Facebook của bạn sao cho đủ 18 tuổi tính đến năm hiện tại (tức là năm sinh phải từ 2000 về trước)</strong></div>
                      <div><strong>+ Phải cài đặt năm sinh trong thông tin cá nhân trên Facebook của bạn sao cho đủ 18 tuổi tính đến năm hiện tại (tức là năm sinh phải từ 2000 về trước)</strong></div>
                      <div><strong>+ Bạn cần thiết lập mục Cài đặt tài khoản trong Facebook của bạn ở phần Quyền riêng tư như sau:</strong></div>
                      <div><strong>+Ai có thể liên hệ với tôi (Ai có thể gửi lời mời kết bạn đến bạn) chỉnh thành Mọi người</strong></div>
                      <div><strong>+ Ai có thể liên hệ với tôi (Ai có thể gửi lời mời kết bạn đến bạn) chỉnh thành Mọi người</strong></div>
                      <div><strong>+ Ai có thể xem bạn bè của tôi : công khai</strong></div>
                      <div><strong>+ Ai có thể gửi lời mời kết bạn : công khai</strong></div>
                      <div><strong>+ Loại 1 : tốc độ nhanh lên luôn lập tức</strong></div>
                       <div><strong>+ Loại 2 : tốc độ chậm 1-2 ngày</strong></div>
                        <div><strong>+ Loại 3: tốc độ chậm 1-3 ngày</strong></div>
                         <div><strong>+ Sub Loại 3 sẽ bảo hành 1 tháng nếu đơn nào tụt quá 10% . inbox admin để được hỗ trợ bảo hành</strong></div>
                          <div><strong>+ Để công khai viền màu đỏ - lấy nick clone ( nick không có bạn bè chung , không là bạn bè ) mới check được</strong></div>
                          <div><strong>+ Để công khai viền màu đỏ - lấy nick clone ( nick không có bạn bè chung , không là bạn bè ) mới check được</strong></div>
                          <div><strong>+ Bạn có thể lên google seach hỏi cách để công khai </strong></div>
                          <div><strong>+ Sẽ có thông báo nếu bạn chưa để công khai.( báo với khách hàng để mở công khai )</strong></div>
                          <div><strong>+ Sau khi làm đầy đủ hệ thống sẽ tự tăng trở lại không cần báo admin</strong></div>
                  </p>
              </div>
                        </div>
                    </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Danh sách ID</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">

            <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>#</th>
            <th>Thời gian</th>
            <th>ID TĂNG SUB</th>
            <th>Loại</th>
            <th>Số lượng</th>
            <th>Trang thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `buffsub` WHERE `username`='$username' ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idprofile']; ?></td>
            <td><?php
            if($row['loai'] == 1) echo $goibuffsub['loai'][1];
            if($row['loai'] == 2) echo $goibuffsub['loai'][2];
            if($row['loai'] == 3) echo $goibuffsub['loai'][3];
            ?></td>
            <td><?= number_format($row['soluong']); ?> sub</td>
            <td>
            <button type="button" class="btn btn-primary">
            <?php
            if($row['status'] == 0) echo "Đang chạy";
            if($row['status'] == 1) echo "Đã hoàn thành";
            if($row['status'] == 2) echo "Huỷ đơn";
            ?>
            </button>
            </td>
            <td>
            <a href="?type=xoa&id=<?= $row['id']; ?>" class="btn btn-danger">Xoá</a>
            </td>
           </tr>
            <?php } ?>
        </tbody>
        </table>
            </div>

        </div>
    </div>
</div>
</div>
<script>
    function tinhtien() {
        var loai = $('#loai').val();
        var soluong = $('#soluong').val();
        $.get('#',{type:'tinhtien',loai,soluong},function (response) {
         if(response.error){
          alert(response.error);
          $('#tongthanhtoan').html(0);
          return;
         }else{
            if(parseInt(response.tongthanhtoan)){
             $('#tongthanhtoan').html(response.fmtongthanhtoan);                   
            }
         }
        },"json");
    }
    function thanhtoan(){
        var idprofile = $('#idprofile').val();
        var loai = $('#loai').val();
        var soluong = $('#soluong').val();
        if(!idprofile){
         alert('Vui lòng nhập ID profile');
         return;
        }else if(!loai){
         alert('Vui lòng chọn loại sub');
         return;
        }else if(!soluong){
         alert('Vui lòng chọn số lượng sub');
         return;
        }else{
            tinhtien();
            wait('#thanhtoan',false);
            $.ajax({
                type: "POST",
                url: "#",
                data: {type:'thanhtoan',idprofile,loai,soluong},
                dataType: "text",
                success: function (response) {
                    $('#ketqua').html(response);
                    wait('#thanhtoan',true,'<i class=\"fa fa-shopping-cart\"></i> Thanh toán');
                }
            });
        }
    }
</script>
<?php
if($_GET['type'] === 'xoa' && $_GET['id']){
  $id = addslashes($_GET['id']);
  $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `buffsub` WHERE `id`='$id' AND`username`='$username'")); 
  if($check){
    mysqli_query($conn,"DELETE FROM `buffsub` WHERE `id`='$id' AND `username`='$username'");
    echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-sub.html"},2000);</script>';
  }else{
    echo '<script>alert("Không thể xoá ID này");</script>';
  }
}
include '../../layout/footer.php';
}
?>