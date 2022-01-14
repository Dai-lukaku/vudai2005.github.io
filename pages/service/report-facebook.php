<?php
include '../../core/config.php';
if(!isset($_SESSION['username'])){
    header("location: /"); exit;
}else{   
    function tinhtien($loai,$goiReport){
  $tongthanhtoan = $goiReport['rate'][$loai];
  $tinhtien = array('tongthanhtoan' => $tongthanhtoan ,'fmtongthanhtoan' => number_format($tongthanhtoan));
  return $tinhtien;
}
if($_GET['type'] === 'tinhtien' && is_numeric($_GET['loai'])){
echo json_encode(tinhtien(addslashes($_GET['loai']),$goiReport));
exit;
}
if($_POST['type'] === 'thanhtoan' && $_POST['idrip'] && $_POST['ib'] && is_numeric($_POST['loai'])){
  $idrip = addslashes($_POST['idrip']);
  $ib = addslashes($_POST['ib']);
  $loai = addslashes($_POST['loai']);
  $tinhtien = tinhtien($loai,$goiReport);
  $tongthanhtoan = $tinhtien['tongthanhtoan'];
  if(!$tongthanhtoan){
    echo '<script>alert("Thông tin thanh toán không hợp lệ");</script>';
  }else if($tongthanhtoan > $account['vnd']){
    echo '<script>alert("Bạn không đủ tiền để thanh toán");</script>';
  }else{
    mysqli_query($conn,"UPDATE `users` SET `vnd`=`vnd`-'$tongthanhtoan' WHERE `username`='$username'");
    mysqli_query($conn,"INSERT INTO `report`(`id`, `idrip`, `ib`, `loai`, `status`,`tongthanhtoan`,`time`, `username`) VALUES (NULL,'$idrip','$ib','$loai',0,'$tongthanhtoan','$time','$username')");
    echo '<script>alert("Thanh toán thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/report-facebook.html"},2000);</script>';
  }
 exit;
}
$title = "Xoá tài khoản Facebook";
include '../../layout/header.php';
?>
<div class="row">
    <div class="col-md-6">
    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Thêm Link</h5>
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
       <div class="form-group">
        <input type="text" class="form-control" id="idrip" placeholder="ID Facebook hoặc Url" onkeyup="tinhtien();">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="ib" placeholder="ID Facebook hoặc SĐT, Zalo để Admin liên hệ" onkeyup="tinhtien();">
      </div>
      <div class="form-group">
            <select class="form-control" id="loai" onchange="tinhtien()">
                   <option value=""> -- Chọn loại report --</option>
                   <option value="1"> <?= $goiReport['loai'][1] ?></option>
                   <option value="2"> <?= $goiReport['loai'][2] ?></option>
                   <option value="3"> <?= $goiReport['loai'][3] ?></option>                         
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
                      <b class="text-danger">* CHÚ Ý :</b>
                      <div><strong>+FACEBOOK DƯỚI 1.000 NGƯỜI THEO DÕI CHỌN LOẠI 1</strong></div>
                      <div><strong>+FACEBOOK TRÊN 1.000 NGƯỜI THEO DÕI CHỌN LOẠI 2</strong></div>
                      <div><strong>+XÓA TÀI KHOẢN VĨNH VIỄN CHỌN LOẠI 3</strong></div>
                      <div><strong>+BẢO HÀNH 1 NGÀY NẾU FB CÒN TỒN TẠI</strong></div>
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
            <th>ID , Url Report</th>
            <th>Thông tin liên hệ</th>
            <th>Loại Report</th>
            <th>Trang thái</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conn,"SELECT * FROM `report` WHERE `username`='$username' ORDER BY id DESC");
            $stt = 0;
            while($row = mysqli_fetch_array($query)){ 
                ++$stt;
            ?>
           <tr>
            <td><?= $stt; ?></td>
            <td><?= date('d/m/Y - H:i:s',$row['time']); ?></td>
            <td><?= $row['idrip']; ?></td>
            <td><?= $row['ib']; ?></td>
            <td><?php 
            if($row['loai'] == 1) echo $goiReport['loai'][1];
            if($row['loai'] == 2) echo $goiReport['loai'][2];
            if($row['loai'] == 3) echo $goiReport['loai'][3];?></td>
            <td>
            <button type="button" class="btn btn-primary">
            <?php
            if($row['status'] == 0) echo "Đang chờ xử lý";
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
        $.get('#',{type:'tinhtien',loai},function (response) {
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
        var idrip = $('#idrip').val();
        var ib = $('#ib').val();
        var loai = $('#loai').val();
        if(!idrip){
         alert('Vui lòng nhập ID cần Report');
         return;
        }else if(!ib){
         alert('Vui lòng nhập ID FB hoặc SĐT Zalo');
         return;
        }else if(!loai){
         alert('Vui lòng chọn loại Report');
         return;
        }else{
            tinhtien();
            wait('#thanhtoan',false);
            $.ajax({
                type: "POST",
                url: "#",
                data: {type:'thanhtoan',idrip,ib,loai},
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
  $check = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `report` WHERE `id`='$id' AND`username`='$username'")); 
  if($check){
    mysqli_query($conn,"DELETE FROM `report` WHERE `id`='$id' AND `username`='$username'");
    echo '<script>alert("Xoá thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "/dich-vu/report-facebook.html"},2000);</script>';
  }else{
    echo '<script>alert("Không thể xoá ID này");</script>';
  }
}
include '../../layout/footer.php';
}
?>