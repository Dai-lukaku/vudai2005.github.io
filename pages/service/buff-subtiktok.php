<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
function tinhtien($soluong,$goibuffsubtiktok){
  if($soluong < $goibuffsubtiktok['minsubtiktok']){
      $error = "Min ".number($goibuffsubtiktok['minsubtiktok'])." sub";
      $tongthanhtoan = 0;
  }else if($soluong > $goibuffsubtiktok['maxsubtiktok']){
      $error = "Max ".number($goibuffsubtiktok['maxsubtiktok'])." sub";
      $tongthanhtoan = 0;
  }else{
      $tongthanhtoan = $goibuffsubtiktok['rate'] * $soluong;
  }
  $tinhtien = array('tongthanhtoan' => $tongthanhtoan ,'fmtongthanhtoan' => number_format($tongthanhtoan) , 'error' => $error);
  return $tinhtien;
}
if($_GET['type'] === 'tinhtien' && is_numeric($_GET['soluong'])){
echo json_encode(tinhtien(addslashes($_GET['soluong']),$goibuffsubtiktok));
exit;
}
if($_POST['type'] === 'thanhtoan' && ($_POST['idpost']) && is_numeric($_POST['soluong']) && $_POST['soluong'] > 0){
    $idpost = addslashes($_POST['idpost']);
    $soluong = addslashes($_POST['soluong']);
    $tinhtien = tinhtien($soluong,$goibuffsubtiktok);
    $tongthanhtoan = $tinhtien['tongthanhtoan'];
      if($tinhtien['error']){
        echo '<script>alert("'.$tinhtien['error'].'");</script>';
      }else if(!$tongthanhtoan){
        echo '<script>alert("Thông tin thanh toán không hợp lệ");</script>';
      }else if($tongthanhtoan > $account['vnd']){
        echo '<script>alert("Bạn không đủ tiền để thanh toán");</script>';
      }else{
        mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`-'$tongthanhtoan' WHERE `username`='$username'");
        mysqli_query($conn,"INSERT INTO `buffsubtiktok`(`id`, `idpost`, `soluong`, `tongthanhtoan`, `status`, `time`, `username`) VALUES (NULL,'$idpost','$soluong','$tongthanhtoan',0,'$time','$username')");
        echo '<script>alert("Thanh toán thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-subtiktok.html"},2000);</script>';
      }
exit; 
}
$title = "Buff Sub TikTok";
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
        <input type="text" class="form-control" id="idpost" placeholder="Link Trang Cá Nhân " onkeyup="tinhtien();">
      </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
        <input type="number" class="form-control" id="soluong" placeholder="Số lượng(min 10)" onkeyup="tinhtien();">
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
                      <b class="text-danger">* BUFF SUB TIKTOK :</b>
                      <div><strong>+ Một link được tăng tối đa 10 lần tránh Spam</strong></div>
                      <div><strong>Ngiêm cấm Buff các link có nội dung chưởi bậy, dìm hàng shop khác, nội dung vi phạm pháp luật, chính trị, đồi trụy... Nếu cố tình buff bạn sẽ bị trừ hết tiền và band khỏi hệ thống vĩnh viễn</strong></div>
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
            <h5>Danh sách link</h5>
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
            <th>Link</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `buffsubtiktok` WHERE `username`='$username' ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idpost']; ?></td>
            <td><?= $row['soluong']; ?></td>
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
        var soluong = $('#soluong').val();
        $.get('#',{type:'tinhtien',soluong},function (response) {
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
        var idpost = $('#idpost').val();
        var soluong = $('#soluong').val();
        if(!idpost){
         alert('Vui lòng nhập ID bài viết');
         return;
        }else if(!soluong){
         alert('Vui lòng nhập số lượng');
         return;
        }else{
            tinhtien();
            wait('#thanhtoan',false);
            $.ajax({
                type: "POST",
                url: "#",
                data: {type:'thanhtoan',idpost,soluong},
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
  $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `buffsubtiktok` WHERE `id`='$id' AND`username`='$username'")); 
  if($check){
    mysqli_query($conn,"DELETE FROM `buffsubtiktok` WHERE `id`='$id' AND `username`='$username'");
    echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-subtiktok.html"},2000);</script>';
  }else{
    echo '<script>alert("Không thể xoá ID này");</script>';
  }
}
include '../../layout/footer.php';
}
?>