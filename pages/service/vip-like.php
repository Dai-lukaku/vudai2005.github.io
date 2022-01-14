<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
function tinhtien($hsd,$loai,$goiVipLike){
  if($loai == 1){
    $loaiVip = $goiVipLike['loai'][1];
  }else if($loai == 2){
    $loaiVip = $goiVipLike['loai'][2];
  }else if($loai == 3){
    $loaiVip = $goiVipLike['loai'][3];
  }else if($loai == 4){
    $loaiVip = $goiVipLike['loai'][4];
  }
  if($hsd == 30){
    $tongthanhtoan = $loaiVip * 1;
    $time_die = time() + 2592000 * 1;
  }else if($hsd == 60){
    $tongthanhtoan = $loaiVip * 2;
    $time_die = time() + 2592000 * 2;
  }else if($hsd == 90){
    $tongthanhtoan = $loaiVip * 3;
    $time_die = time() + 2592000 * 3;
  }
  $tinhtien = array('tongthanhtoan' => $tongthanhtoan ,'fmtongthanhtoan' => number_format($tongthanhtoan), 'time_die' => $time_die);
  return $tinhtien;
}
if($_GET['type'] === 'tinhtien' && is_numeric($_GET['hsd']) && is_numeric($_GET['loai'])){
echo json_encode(tinhtien(addslashes($_GET['hsd']),addslashes($_GET['loai']),$goiVipLike));
exit;
}
if($_POST['type'] === 'thanhtoan' && is_numeric($_POST['idvip']) && is_string($_POST['name']) && is_numeric($_POST['hsd']) && is_numeric($_POST['loai'])){
  $idvip = addslashes($_POST['idvip']);
  $name = addslashes($_POST['name']);
  $hsd = addslashes($_POST['hsd']);
  $loai = addslashes($_POST['loai']);
  $tinhtien = tinhtien($hsd,$loai,$goiVipLike);
  $tongthanhtoan = $tinhtien['tongthanhtoan'];
  $time_die = $tinhtien['time_die'];
  if(!$tongthanhtoan){
    echo '<script>alert("Thông tin thanh toán không hợp lệ");</script>';
  }else if($tongthanhtoan > $account['vnd']){
    echo '<script>alert("Bạn không đủ tiền để thanh toán");</script>';
  }else{
    mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`-'$tongthanhtoan' WHERE `username`='$username'");
    mysqli_query($conn,"INSERT INTO `viplike`(`id`, `idvip`, `name`, `hsd`, `loai`, `time_die`, `status`, `time`, `username`) VALUES (NULL,'$idvip','$name','$hsd','$loai','$time_die',0,'$time','$username')");
    echo '<script>alert("Thanh toán thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/vip-like.html"},2000);</script>';
  }
 exit;
}
$title = "Vip like";
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
        <input type="number" class="form-control" id="idvip" placeholder="ID Facebook">
      </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
        <input type="text" class="form-control" id="name" placeholder="Họ tên Facebook">
      </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-6">
          <div class="form-group">
            <select class="form-control" id="hsd" onchange="tinhtien()">
                   <option value=""> -- Chọn thời hạn --</option>
                   <option value="<?= $goiVipLike['hsd'][1] ?>"> <?= $goiVipLike['hsd'][1] ?> ngày</option>
                   <option value="<?= $goiVipLike['hsd'][2] ?>"> <?= $goiVipLike['hsd'][2] ?> ngày</option>
                   <option value="<?= $goiVipLike['hsd'][3] ?>"> <?= $goiVipLike['hsd'][3] ?> ngày</option>                         
             </select>
        </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <select class="form-control" id="loai" onchange="tinhtien()">
                   <option value=""> -- Chọn gói like --</option>
                   <option value="1"> VIPLIKE1 - 50 Like / Post - <?= number_format($goiVipLike['loai'][1]) ?> VNĐ / <?= $goiVipLike['hsd'][1] ?> ngày</option>
                   <option value="2"> VIPLIKE2 - 100 Like / Post - <?= number_format($goiVipLike['loai'][2]) ?> VNĐ / <?= $goiVipLike['hsd'][1] ?> ngày</option>
                   <option value="3"> VIPLIKE3 - 200 Like / Post - <?= number_format($goiVipLike['loai'][3]) ?> VNĐ / <?= $goiVipLike['hsd'][1] ?> ngày</option>
                   <option value="4"> VIPLIKE4 - 300 Like / Post - <?= number_format($goiVipLike['loai'][4]) ?> VNĐ / <?= $goiVipLike['hsd'][1] ?> ngày</option>                         
             </select>
        </div>
          </div>
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
                  - VD : Gói Viplike bạn chỉ cài 1 lần là sử dụng trong 30 ngày, mỗi lần đăng bài viết, hệ thống sẽ tự động quét và tăng like mà không cần phải làm gì thêm.
                  </p>
                  <p>
                      <b class="text-danger">*Lưu ý Viplike:</b>
                      <div><strong>1/ Profile phải để chế độ công khai</strong></div>
                      <div><strong>2/ Tối đa 1 ngày được 5 bài viết</strong></div>
                      <div><strong>3/ Hệ thống chỉ tăng Like cho các bài viết đăng mới, không hỗ trợ các bài viết thêm hình ảnh vào album đã có sẵn.</strong></div>
                      <div><strong>4/ Các nguyên nhân không lên like có thể do: bài viết chứa link, thay đổi cover, ảnh đại diện, bài viết không để công khai...</strong></div>
                      <div><strong>5/ Like có thể tụt và không bảo hành tụt like</strong></div>
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
            <th>ID Facebook</th>
            <th>Họ tên</th>
            <th>Hạn sử dụng</th>
            <th>Loại</th>
            <th>Ngày hết hạn</th>
            <th>Trang thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `viplike` WHERE `username`='$username' ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idvip']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['hsd']; ?> ngày</td>
            <td><?php
  if($row['loai'] == 1){
    echo $goiVipLike['nameVip'][1];
  }else if($row['loai'] == 2){
    echo $goiVipLike['loai'][2];
  }else if($row['loai'] == 3){
    echo $goiVipLike['nameVip'][3];
  }else if($row['loai'] == 4){
    echo $goiVipLike['nameVip'][4];
  }
  ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time_die']); ?></td>
            <td>
            <button type="button" class="btn btn-primary">
            <?php
            if($row['status'] == 0) echo "Đang chạy";
            if($row['status'] == 1) echo "Đã hoàn thành";
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
        var hsd = $('#hsd').val();
        var loai = $('#loai').val();
        $.get('#',{type:'tinhtien',hsd,loai},function (response) {
          if(parseInt(response.tongthanhtoan)){
             $('#tongthanhtoan').html(response.fmtongthanhtoan);                   
          }
        },"json");
    }
    function thanhtoan(){
        var idvip = $('#idvip').val();
        var name = $('#name').val();
        var hsd = $('#hsd').val();
        var loai = $('#loai').val();
        if(!idvip){
         alert('Vui lòng nhập ID Facebook');
         return;
        }else if(!name){
         alert('Vui lòng nhập họ tên Facebook');
         return;
        }else if(!hsd){
         alert('Vui lòng chọn hạn sử dụng');
         return;
        }else if(!loai){
         alert('Vui lòng chọn gói VIP');
         return;
        }else{
            tinhtien();
            wait('#thanhtoan',false);
            $.ajax({
                type: "POST",
                url: "#",
                data: {type:'thanhtoan',idvip,name,hsd,loai},
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
  $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `viplike` WHERE `id`='$id' AND`username`='$username'")); 
  if($check){
    mysqli_query($conn,"DELETE FROM `viplike` WHERE `id`='$id' AND `username`='$username'");
    echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/vip-like.html"},2000);</script>';
  }else{
    echo '<script>alert("Không thể xoá ID này");</script>';
  }
}
include '../../layout/footer.php';
}
?>