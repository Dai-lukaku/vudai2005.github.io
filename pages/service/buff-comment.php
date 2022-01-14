<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
function tinhtien($soluong,$goibuffcomment){
  if($soluong < $goibuffcomment['mincomment']){
      $error = "Min ".number_format($goibuffcomment['mincomment'])." comment";
      $tongthanhtoan = 0;
  }else if($soluong > $goibuffcomment['maxcomment']){
      $error = "Max ".number_format($goibuffcomment['maxcomment'])." comment";
      $tongthanhtoan = 0;
  }else{
      $tongthanhtoan = $goibuffcomment['rate'] * $soluong;
  }
  $tinhtien = array('tongthanhtoan' => $tongthanhtoan ,'fmtongthanhtoan' => number_format($tongthanhtoan) , 'error' => $error);
  return $tinhtien;
}
if($_GET['type'] === 'tinhtien' && is_numeric($_GET['soluong'])){
echo json_encode(tinhtien(addslashes($_GET['soluong']),$goibuffcomment));
exit;
}
if($_POST['type'] === 'thanhtoan' && is_numeric($_POST['idpost']) && is_numeric($_POST['soluong']) && $_POST['soluong'] > 0 && $_POST['noidung']){
    $idpost = addslashes($_POST['idpost']);
    $soluong = addslashes($_POST['soluong']);
    $noidung = addslashes($_POST['noidung']);
    $tinhtien = tinhtien($soluong,$goibuffcomment);
    $tongthanhtoan = $tinhtien['tongthanhtoan'];
      if($tinhtien['error']){
        echo '<script>alert("'.$tinhtien['error'].'");</script>';
      }else if(!$tongthanhtoan){
        echo '<script>alert("Thông tin thanh toán không hợp lệ");</script>';
      }else if($tongthanhtoan > $account['vnd']){
        echo '<script>alert("Bạn không đủ tiền để thanh toán");</script>';
      }else{
        mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`-'$tongthanhtoan' WHERE `username`='$username'");
        mysqli_query($conn,"INSERT INTO `buffcomment`(`id`, `idpost`, `soluong`, `noidung`, `tongthanhtoan`, `status`, `time`, `username`) VALUES (NULL,'$idpost','$soluong','$noidung','$tongthanhtoan',0,'$time','$username')");
        echo '<script>alert("Thanh toán thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-comment.html"},2000);</script>';
      }
exit; 
}
$title = "Buff comment";
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
        <input type="number" class="form-control" id="idpost" placeholder="ID bài viết" onkeyup="tinhtien();">
      </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
        <input type="number" class="form-control" id="soluong" placeholder="Số lượng" onkeyup="tinhtien();">
      </div>
          </div>
      </div>
         <div class="form-group">
           <label for="">Nội dung bình luận</label>
           <textarea class="form-control" id="noidung" rows="5" placeholder="Nhập nội dung bình luân, mỗi nội dung 1 dòng"></textarea>
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
                      <b class="text-danger">* BUFF COMMENT POST :</b>
                      <div><strong>+ Ảnh đại diện hoặc cover đã chỉnh sửa, khi lấy link trên điện thoại có thể bị lỗi, tốt nhất lấy link bằng cách bấm thẳng vào hình trên máy tính hoặc trình duyệt mobile</strong></div>
                      <div><strong>+ comment việt người dùng hoạt động</strong></div>
                      <div><strong>+ Chỉ nhận id bài viết công khai không nhập id trong Group, album, id comment, id trang cá nhân, id page,... </strong></div>
                      <div><strong>+ Một bài viết được tăng tối đa 10 lần tránh Spam</strong></div>
                      <div><strong>Không hỗ trợ tăng cho những bài chứa link web vì có thể dẫn tới spam và bị xóa bài. Nếu cố tình tạo chiến dịch mà bài viết bị xóa hệ thống sẽ không chịu trách nhiệm.</strong></div>
                      <div><strong>+ comment, Share, Comment có thể tụt và không bảo hành tụt comment</strong></div>
                      <div><strong>Ngiêm cấm Buff các ID Seeding có nội dung chưởi bậy, dìm hàng shop khác, nội dung vi phạm pháp luật, chính trị, đồi trụy... Nếu cố tình buff bạn sẽ bị trừ hết tiền và band khỏi hệ thống vĩnh viễn</strong></div>
                      <div><strong>+ Không bình luận các nội dung có biểu tượng Icon.</strong></div>
                      <div><strong>Các ngôn từ bị cấm: dm|đm|đ m|d m|địt mẹ|dit me|lol|lừađảo|conchó|trảtiền|mấtdạy|lừa đảo|con chó| trả tiền|mất dạy|lua dao|con cho|tra tien|mat day...vvv</strong></div>
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
            <th>ID post</th>
            <th>Số lượng</th>
            <th>Nội dung bình luận</th>
            <th>Trang thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `buffcomment` WHERE `username`='$username' ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idpost']; ?></td>
            <td><?= $row['soluong']; ?></td>
            <td> <textarea class="form-control" rows="5"><?=  $row['noidung']; ?></textarea></td>
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
        var noidung = $('#noidung').val();
        if(!idpost){
         alert('Vui lòng nhập ID bài viết');
         return;
        }else if(!soluong){
         alert('Vui lòng nhập số lượng');
         return;
        }else if(!noidung){
         alert('Vui lòng nhập nội dung bình luận');
         return;
        }else{
            tinhtien();
            wait('#thanhtoan',false);
            $.ajax({
                type: "POST",
                url: "#",
                data: {type:'thanhtoan',idpost,soluong,noidung},
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
  $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `buffcomment` WHERE `id`='$id' AND`username`='$username'")); 
  if($check){
    mysqli_query($conn,"DELETE FROM `buffcomment` WHERE `id`='$id' AND `username`='$username'");
    echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-comment.html"},2000);</script>';
  }else{
    echo '<script>alert("Không thể xoá ID này");</script>';
  }
}
include '../../layout/footer.php';
}
?>