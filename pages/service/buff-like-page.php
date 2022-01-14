<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
function tinhtien($soluong,$goibufflikepage){
  $tongthanhtoan = $goibufflikepage['rate'] * $soluong;
  $tinhtien = array('tongthanhtoan' => $tongthanhtoan ,'fmtongthanhtoan' => number_format($tongthanhtoan));
  return $tinhtien;
}
if($_GET['type'] === 'tinhtien'){
$key = array_search($_GET['soluong'],$goibufflikepage['soluong']);
if($key){
   echo json_encode(tinhtien(addslashes($_GET['soluong']),$goibufflikepage));
}
exit;
}
if($_POST['type'] === 'thanhtoan' && is_numeric($_POST['idpage']) && is_numeric($_POST['soluong']) && $_POST['soluong'] > 0 && array_search($_POST['soluong'],$goibufflikepage['soluong'])){
    $idpage = addslashes($_POST['idpage']);
    $name = addslashes($_POST['name']);
    $soluong = addslashes($_POST['soluong']);
    $tinhtien = tinhtien($soluong,$goibufflikepage);
    $tongthanhtoan = $tinhtien['tongthanhtoan'];
      if(!$tongthanhtoan){
        echo '<script>alert("Thông tin thanh toán không hợp lệ");</script>';
      }else if($tongthanhtoan > $account['vnd']){
        echo '<script>alert("Bạn không đủ tiền để thanh toán");</script>';
      }else{
        mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`-'$tongthanhtoan' WHERE `username`='$username'");
        mysqli_query($conn,"INSERT INTO `bufflikepage`(`id`, `idpage`, `name`, `soluong`, `tongthanhtoan`, `status`, `time`, `username`) VALUES (NULL,'$idpage','$name','$soluong','$tongthanhtoan',0,'$time','$username')");
        echo '<script>alert("Thanh toán thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-like-page.html"},2000);</script>';
      }
exit; 
}
$title = "Buff like page";
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
        <input type="texttext" class="form-control" id="idpage" placeholder="ID PAGE" onkeyup="tinhtien();">
      </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
        <input type="text" class="form-control" id="name" placeholder="Tên page" onkeyup="tinhtien();">
      </div>
          </div>
      </div>
      <div class="form-group">
        <select class="form-control" id="soluong" onchange="tinhtien()">
                   <option value=""> -- Chọn số lượng like page --</option>
    
                   <?php for($i = 1; $i<= count($goibufflikepage['soluong']); $i++){ ?>
                   <option value="<?= $goibufflikepage['soluong'][$i] ?>"> <?= number_format($goibufflikepage['soluong'][$i]) ?> like</option>
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
                      <b class="text-danger">* BUFF LIKE PAGE :</b>
                      <div><strong>+ Fanpage phải lập trên 2 tuần, không được giới hạn độ tuổi, quốc gia</strong></div>
                      <div><strong>+ Nội dung page không vi phạm chính sách của Facebook, bán các chất cấm, vũ khí, sex...</strong></div>
                      <div><strong>+ Thời gian tăng 1000 Like sẽ hoàn thành trong từ 2-3 ngày</strong></div>
                      <div><strong>+ LikePage người Việt, Thật</strong></div>
                      <div><strong>+ Like page sẽ được bảo hành trong 15 ngày nếu tuột quá 20%</strong></div>
                      <div><strong>+ (domain) không lấy bất cứ thông tin đăng nhập gì của bạn, nên sẽ không Bảo hành khi page bạn xảy ra vấn đề</strong></div>
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
            <th>ID page</th>
            <th>Tên page</th>
            <th>Số lượng</th>
            <th>Trang thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `bufflikepage` WHERE `username`='$username' ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idpage']; ?></td>
            <td><?= $row['name']; ?></td>
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
        var idpage = $('#idpage').val();
        var name = $('#name').val();
        var soluong = $('#soluong').val();
        if(!idpage){
         alert('Vui lòng nhập ID page');
         return;
        }else if(!name){
         alert('Vui lòng nhập tên page');
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
                data: {type:'thanhtoan',idpage,name,soluong},
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
  $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `bufflikepage` WHERE `id`='$id' AND`username`='$username'")); 
  if($check){
    mysqli_query($conn,"DELETE FROM `bufflikepage` WHERE `id`='$id' AND `username`='$username'");
    echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/buff-like-page.html"},2000);</script>';
  }else{
    echo '<script>alert("Không thể xoá ID này");</script>';
  }
}
include '../../layout/footer.php';
}
?>